<?php

class ServiceFpController extends BaseController
{

    /**********************************************************
     * ANC
     **********************************************************/

    public function __construct()
    {
        // Turn on CSRF protection
        $this->beforeFilter('csrf', array('on' => 'post'));
        // Turn on auth on ajax request
        $this->beforeFilter('jsondenied');
    }

    /**
     * Save FP service
     *
     * POST /service-fp/save
     *
     * @internal Input
     *
     * @return Response::json
     */

    public function postSave()
    {
        if (Request::ajax()) {

            $data = Input::all();
            $validator = Validator::make($data, ServiceFp::$roles);

            if ($validator->passes()) {

                // check duplicate
                $isDuplicate = ServiceFp::isDuplicate($data['service_id'], $data['fp_type_id'])->count();

                if ($isDuplicate) {
                    $json = ['ok' => 0, 'error' => 'รายการซ้ำ กรุณาตรวจสอบ'];
                } else {
                    $fp = new ServiceFp;
                    $fp->hospcode = Auth::user()->hospcode;
                    $fp->user_id = Auth::id();
                    $fp->service_id = $data['service_id'];
                    $fp->fp_type_id = $data['fp_type_id'];
                    $fp->provider_id = $data['provider_id'];

                    try {
                        $fp->save();
                        $json = ['ok' => 1, 'id' => $fp->id];
                    } catch (Exception $ex) {
                        $json = ['ok' => 0, 'error' => $ex->getMessage()];
                    }
                }

            } else {
                $json = ['ok' => 0, 'error' => 'ข้อมูลไม่สมบูรณ์ กรุณาตรวจสอบ'];
            }

        } else {
            $json = ['ok' => 0, 'error' => 'Not ajax request.'];
        }

        return Response::json($json);
    }

    /**
     * Remove FP
     *
     * DELETE   /service-fp/remove
     *
     * @internal int $id
     *
     * @return Response::json
     */

    public function deleteRemove()
    {
        if (Request::ajax()) {

            $id = Input::get('id');

            try {
                $fp = ServiceFp::find($id);
                $fp->delete();
                $json = ['ok' => 1];
            } catch(Exception $ex) {
                $json = ['ok' => 0, 'error' => $ex->getMessage()];
            }

        } else {
            $json = ['ok' => 0, 'error' => 'Not ajax request.'];
        }

        return Response::json($json);
    }

}