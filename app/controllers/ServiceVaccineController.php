<?php

class ServiceVaccineController extends BaseController {

    public function __construct()
    {
        // Turn on CSRF protection
        $this->beforeFilter('csrf', array('on' => 'post'));
        // Turn on auth on ajax request
        $this->beforeFilter('jsondenied');
    }

    /**
     * Save vaccine
     *
     * @internal Input
     *
     * @return Response::json
     */
    public function postSave()
    {
        $data = Input::all();

        // validator
        $validator = Validator::make($data, ServiceVaccine::$roles);

        if ($validator->passes()) {

            // check exist
            $isDuplicate = ServiceVaccine::isDuplicate($data['service_id'], $data['vaccine_id'])->count();

            if ($isDuplicate) {
                $json = ['ok' => 0, 'error' => 'รายการวัคซีนซ้ำ กรุณาตรวจสอบ'];
            } else {
                $epi = new ServiceVaccine;
                $epi->service_id = $data['service_id'];
                $epi->person_id = $data['person_id'];
                $epi->hospcode = Auth::user()->hospcode;
                $epi->user_id = Auth::id();
                $epi->provider_id = $data['provider_id'];
                $epi->vaccine_id = $data['vaccine_id'];
                $epi->vaccine_place = $data['vaccine_place'];
                $epi->vaccine_lot = $data['vaccine_lot'];
                $epi->vaccine_expire_date = Helpers::fromThaiToMySQLDate($data['vaccine_expire_date']);

                try {
                    $epi->save();
                    $json = ['ok' => 1, 'id' => $epi->id];
                } catch (Exception $ex) {
                    $json = ['ok' => 0, 'error' => $ex->getMessage()];
                }
            }

        } else {
            $json = ['ok' => 0, 'error' => 'ข้อมูลไม่ครบถ้วน กรุณาตรวจสอบ'];
        }

        return Response::json($json);
    }

    /**
     * Remove service vaccine
     *
     * @internal int $id
     *
     * @return Response::json
     */
    public function deleteRemove()
    {
        if (Request::ajax()) {
            // service vaccine id
            $id = Input::get('id');
            // try to delete
            try {
                $vaccine = ServiceVaccine::find($id);
                $vaccine->delete(); // do delete
                $json = ['ok' => 1];
            } catch (Exception $ex) { // error
                $json = ['ok' => 0, 'error' => $ex->getMessage()];
            }

        } else {
            $json = ['ok' => 0, 'error' => 'Not ajax requrst.'];
        }
        // return json
        return Response::json($json);
    }
} 