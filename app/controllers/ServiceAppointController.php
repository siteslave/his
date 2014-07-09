<?php

class ServiceAppointController extends BaseController
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
     * Save new appointment
     *
     * POST    /service-appoint/save
     *
     * @internal Input $data
     *
     * @return Response::json
     */
    public function postSave()
    {
        $data = Input::all();
        $validator = Validator::make($data, ServiceAppointment::$roles);

        if ($validator->passes()) {
            //is duplicate
            $isDuplicate = ServiceAppointment::isDuplicate(
                (int) $data['service_id'],
                (int) $data['appoint_id'],
                $data['appoint_date']
            )->count();

            if ($isDuplicate) {
                $json = ['ok' => 0, 'msg' => 'ข้อมูลซำ้ซ้อน กรุณาตรวจสอบ'];
            } else {
                $ap = new ServiceAppointment();

                $ap->service_id      = $data['service_id'];
                $ap->hospcode        = Auth::user()->hospcode;
                $ap->user_id         = Auth::id();
                $ap->provider_id     = $data['provider_id'];
                $ap->appoint_type_id = $data['appoint_id'];
                $ap->appoint_date    = Helpers::toMySQLDate($data['appoint_date']);
                $ap->appoint_time    = $data['appoint_time'];
                $ap->clinic_id       = $data['clinic_id'];

                try {
                    $ap->save();
                    $json = ['ok' => 1];
                } catch (Exception $ex) {
                    $json = ['ok' => 0, 'error' => $ex->getMessage()];
                }
            }
        } else {
            $json = ['ok' => 0, 'error' => 'ข้อมูลไม่สมบูรณ์ กรุณาตรวจสอบ'];
        }

        return Response::json($json);

    }

    /**
     * Get appoint list
     *
     * GET    /service-appoint/list
     *
     * @internal int $service_id
     *
     * @return Response::json
     */
    public function getList()
    {
        $service_id = Input::get('service_id');
        $callback = Input::get('callback');

        $rs = ServiceAppointment::getList($service_id)->get();
        $json = ['ok' => 1, 'rows' => $rs];

        return Response::json($json)->setCallback($callback);
    }

    /**
     * Delete appointment
     *
     * DELETE    /service-appoint/remove
     *
     * @internal int $id
     *
     * @return Response::json
     */
    public function deleteRemove()
    {
        $id = Input::get('id');

        $appoint = ServiceAppointment::find($id);

        try {
            $appoint->delete();
            $json = ['ok' => 1];
        } catch (Exception $ex) {
            $json = ['ok' => 0, 'error' => $ex->getMessage()];
        }

        return Response::json($json);
    }

}
