<?php

class ServiceDiagnosisController extends BaseController
{

    public function __construct()
    {
        // Turn on CSRF protection
        $this->beforeFilter('csrf', array('on' => 'post'));
        // Turn on auth on ajax request
        $this->beforeFilter('jsondenied');
    }

    /**
     * Save diagnosis
     *
     * POST    /service-diagnosis/save
     *
     * @internal    Input
     *
     * @return      Response::json
     */
    public function postSave()
    {
        $data = Input::all();
        $validator = Validator::make($data, ServiceDiagnosis::$roles);

        if ($validator->passes()) {
            // check has principle diagnosis
            $hasPrinciple = ServiceDiagnosis::hasPrincipleDiagnosis($data['service_id'])->count();

            if ($hasPrinciple || $data['diagnosis_type_code'] == '1') {
                # is duplicate
                $count = ServiceDiagnosis::duplicateDiagnosis($data['service_id'], $data['diagnosis_code'])->count();

                if ($count) {
                    $json = ['ok' => '0', 'error' => 'รายการซ้ำ'];
                } else {
                    # principle diag exist

                    $diag                      = new ServiceDiagnosis();
                    $diag->diagnosis_code      = $data['diagnosis_code'];
                    $diag->diagnosis_type_code = $data['diagnosis_type_code'];
                    $diag->service_id          = $data['service_id'];
                    $diag->user_id             = Auth::id();
                    $diag->hospcode            = Auth::user()->hospcode;

                    if ($data['diagnosis_type_code'] == '1') {
                        $principle = ServiceDiagnosis::hasPrincipleDiagnosis($data['service_id'])->count();

                        if ($principle) {
                            $json = ['ok' => 0, 'error' => 'มีการระบุ Principle diagnosis ก่อนหน้านี้แล้ว กรุณาเลือกประเภทใหม่'];
                        } else {
                            try {
                                $diag->save();
                                $json = ['ok' => 1, 'id' => $diag->id];
                            } catch (Exception $e) {
                                $json = ['ok' => 0, 'error' => $e->getMessage()];
                            }
                        }
                    } else {
                        try {
                            $diag->save();
                            $json = ['ok' => 1, 'id' => $diag->id];
                        } catch (Exception $ex) {
                            $json = ['ok' => 0, 'error' => $ex->getMessage()];
                        }
                    }

                }
            } else {
                $json = ['ok' => 0, 'error' => 'กรุณาระบุ Priniciple diagnosis ก่อนทำการบันทึกรหัสอื่นๆ'];
            }
        } else {
            $json = ['ok' => 0, 'error' => 'ข้อมูลไม่ครบ กรุณาตรวจสอบ'];
        }

        return Response::json($json);
    }

    /**
     * Remove diagnosis
     *
     * DELETE  /service-diagnosis/remove
     *
     * @internal integer $id Service diagnosis id
     *
     * @return Response::json
     */
    public function deleteRemove()
    {
        $diag = ServiceDiagnosis::where('id', (int) Input::get('id'));

        if ($diag) {
            try {
                $diag->delete();
                $json = ['ok' => 1];
            } catch (Exception $ex) {
                $json = ['ok' => 0, 'error' => $ex->getMessage()];
            }
        } else {
            $json = ['ok' => 0, 'error' => 'ไม่พบรหัสที่ต้องการลบ กรุณาตรวจสอบ'];
        }

        return Response::json($json);
    }
} 