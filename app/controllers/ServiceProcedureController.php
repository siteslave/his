<?php

class ServiceProcedureController extends BaseController
{

    public function __construct()
    {
        // Turn on CSRF protection
        $this->beforeFilter('csrf', array('on' => 'post'));
        // Turn on auth on ajax request
        $this->beforeFilter('jsondenied');
    }


    /**
     * Save procedure
     *
     * @url         POST    /service-procedure/save
     *
     * @internal    Input
     *
     * @return      Response::json
     */
    public function postSave()
    {
        $data = Input::all();
        $validator = Validator::make($data, ServiceProcedure::$roles);

        if ($validator->passes()) {

            $procedure = new ServiceProcedure();

            $procedure->service_id            = $data['service_id'];
            $procedure->hospcode              = Auth::user()->hospcode;
            $procedure->user_id               = Auth::id();
            $procedure->procedure_id          = $data['procedure_id'];
            $procedure->procedure_position_id = $data['position_id'];
            $procedure->start_time            = $data['start_time'];
            $procedure->finished_time         = $data['finished_time'];
            $procedure->provider_id           = $data['provider_id'];
            $procedure->price                 = $data['price'];

            $oldData = ServiceProcedure::hasOldData($data['service_id'], $data['procedure_id'])->first();

            if ($oldData) {
                if ($data['position_id'] == $oldData->procedure_position_id) {
                    $json = ['ok' => 0, 'error' => 'รายการซ้ำ'];
                } else {
                    try {
                        $procedure->save();
                        $json = ['ok' => 1, 'id' => $procedure->id];
                    } catch (Exception $ex) {
                        $json = ['ok' => 0, 'error' => $ex->getMessage()];
                    }
                }
            } else {
                try {
                    $procedure->save();
                    $json = ['ok' => 1, 'id' => $procedure->id];
                } catch (Exception $e) {
                    $json = ['ok' => 0, 'error' => $e->getMessage()];
                }
            }
        } else {
            $json = ['ok' => 0, 'error' => 'ข้อมูลไม่ครบถ้วนกรุณาตรวจสอบอีกครั้ง'];
        }

        return Response::json($json);
    }

    /**
     * Get procedure list
     *
     * GET    /service-procedure/list
     *
     * @internal int $service_id
     *
     * @return Response::json
     */
    public function getList()
    {
        $service_id = Input::get('service_id');
        $callback   = Input::get('callback');

        $rs         = ServiceProcedure::getList($service_id)->get();
        $json       = ['ok' => 1, 'rows' => $rs];

        return Response::json($json)->setCallback($callback);
    }

    /**
     * Delete procedure
     *
     * DELETE    /service-procedure/remove
     *
     * @internal int $id Procedure id
     *
     * @return Response::json
     */
    public function deleteRemove()
    {
        $id = Input::get('id');

        $procedure = ServiceProcedure::where('id', (int) $id);

        if ($procedure) {
            try {
                $procedure->delete();
                $json = ['ok' => 1];
            } catch (Exception $e) {
                $json = ['ok' => 0, 'error' => $e->getMessage()];
            }
        } else {
            $json = ['ok' => 0, 'error' => 'ไม่พบรหัสที่ต้องการลบ กรุณาตรวจสอบ'];
        }

        return Response::json($json);
    }

    /**
     * Save procedure for dental
     *
     * POST    /service-procedure/dental-save
     *
     * @internal Input
     *
     * @return Response::json
     */
    public function postDentalSave()
    {
        $data = Input::all();

        $validator = Validator::make($data, ServiceProcedureDental::$roles);

        if ($validator->passes()) {
            // Check duplicate

            $procedure = new ServiceProcedureDental();

            $procedure->service_id   = $data['service_id'];
            $procedure->hospcode     = Auth::user()->hospcode;
            $procedure->user_id      = Auth::id();
            $procedure->procedure_id = $data['procedure_id'];
            $procedure->tcount       = $data['tcount'];
            $procedure->rcount       = $data['rcount'];
            $procedure->dcount       = $data['dcount'];
            $procedure->tcode        = $data['tcode'];
            $procedure->provider_id  = $data['provider_id'];
            $procedure->price        = $data['price'];

            $isDuplicate = ServiceProcedureDental::isDuplicate((int) $data['service_id'], (int) $data['procedure_id'])->count();

            if ($isDuplicate) {
                $json = ['ok' => 0, 'error' => 'รายการซ้ำ'];
            } else {
                try {
                    $procedure->save();
                    $json = ['ok' => 1, 'id' => $procedure->id];
                } catch (Exception $e) {
                    $json = ['ok' => 0, 'error' => $e->getMessage()];
                }
            }
        } else {
            $json = ['ok' => 0, 'error' => 'ข้อมูลไม่ครบถ้วนกรุณาตรวจสอบอีกครั้ง'];
        }

        return Response::json($json);
    }

    /**
     * Get procedure dental list
     *
     * GET    /service-procedure/dental-list
     *
     * @internal int $service_id
     *
     * @return Response::json
     */
    public function getDentalList()
    {
        $service_id = Input::get('service_id');
        $callback   = Input::get('callback');

        $rs         = ServiceProcedureDental::getList($service_id)->get();

        $json       = ['ok' => 1, 'rows' => $rs];

        return Response::json($json)->setCallback($callback);
    }

    /**
     * Delete procedure dental
     *
     * DELETE    /service-procedure/dental-remove
     *
     * @internal int $id
     *
     * @return Response::json
     */
    public function deleteDentalRemove()
    {
        $id = Input::get('id');

        $procedure = ServiceProcedureDental::find($id);

        if ($procedure) {
            try {
                $procedure->delete();
                $json = ['ok' => 1];
            } catch (Exception $e) {
                $json = ['ok' => 0, 'error' => $e->getMessage()];
            }
        } else {
            $json = ['ok' => 0, 'error' => 'ไม่พบรหัสที่ต้องการลบ กรุณาตรวจสอบ'];
        }

        return Response::json($json);
    }

}