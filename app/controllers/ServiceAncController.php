<?php

class ServiceAncController extends BaseController
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
     * Get screen anc detail
     *
     * POST /service-anc/screen
     *
     * @internal int $service_id The service id
     *
     * @return Response::json
     */

    public function postScreen()
    {
        if (Request::ajax()) {
            $data = Input::all();

            $validator = Validator::make($data, ServiceAnc::$roles);

            if ($validator->passes()) {

                if (!empty($data['id'])) { // Update
                    $anc = ServiceAnc::find($data['id']);
                } else { // New
                    $anc = new ServiceAnc;
                    $anc->hospcode   = Auth::user()->hospcode;
                    $anc->service_id = $data['service_id'];
                    $anc->person_id = $data['person_id'];
                }

                $anc->ga               = $data['ga'];
                $anc->gravida          = $data['gravida'];
                $anc->anc_result       = $data['anc_result'];
                $anc->uterus_level_id  = $data['uterus_level_id'];
                $anc->baby_position_id = $data['baby_position_id'];
                $anc->baby_lead_id     = $data['baby_lead_id'];
                $anc->baby_heart_sound = $data['baby_heart_sound'];
                $anc->is_headache      = $data['is_headache'];
                $anc->is_swollen       = $data['is_swollen'];
                $anc->is_sick          = $data['is_sick'];
                $anc->is_bloodshed     = $data['is_bloodshed'];
                $anc->is_thyroid       = $data['is_thyroid'];
                $anc->is_cramp         = $data['is_cramp'];
                $anc->is_baby_flex     = $data['is_baby_flex'];
                $anc->is_urine         = $data['is_urine'];
                $anc->is_leucorrhoea   = $data['is_leucorrhoea'];
                $anc->is_heart_disease = $data['is_heart_disease'];
                $anc->user_id          = Auth::id();

                try {
                    $anc->save();
                    $json = ['ok' => 1, 'id' => $anc->id];
                } catch (Exception $ex) {
                    $json = ['ok' => 0, 'error' => $ex->getMessage()];
                }

            } else {
                $json = ['ok' => 0, 'error' => $validator->messages()];
            }

            return Response::json($json);

        } else { // not ajax request
            App::abort(404);
        }
    }

    /**
     * Save vaccine
     *
     * POST /service-anc/vaccine
     * @return mixed
     */
    public function postVaccine()
    {
        if (Request::ajax()) {
            $data = Input::all();

            $validator = Validator::make($data, ServiceAncVaccine::$roles);

            if ($validator->passes()) {
                // check is duplicate
                $isDuplicate = ServiceAncVaccine::isDuplicate($data['service_id'], $data['vaccine_id'])->count();

                if (!$isDuplicate) {
                    $vaccine = new ServiceAncVaccine;
                    $vaccine->hospcode    = Auth::user()->hospcode;
                    $vaccine->user_id     = Auth::id();
                    $vaccine->vaccine_id  = $data['vaccine_id'];
                    $vaccine->provider_id = $data['provider_id'];
                    $vaccine->service_id  = $data['service_id'];
                    $vaccine->lot = $data['lot'];
                    $vaccine->expire_date = Helpers::toMySQLDate($data['expire_date']);
                    $vaccine->person_id = $data['person_id'];
                    $vaccine->gravida = $data['gravida'];

                    try {
                        $vaccine->save();
                        $json = ['ok' => 1, 'id' => $vaccine->id];
                    } catch (Exception $ex) {
                        $json = ['ok' => 0, 'error' => $ex->getMessage()];
                    }
                } else {
                    $json = ['ok' => 0, 'error' => 'รายการวัคซีนซ้ำ กรุณาตรวจสอบ'];
                }

            } else {
                $json = ['ok' => 0, 'error' => $validator->messages()];
            }

            return Response::json($json);

        } else {
            return App::abort(404);
        }
    }

    /**
     * Remove anc vaccine
     *
     * DELETE   /service-anc/vaccine
     *
     * @internal int $id The vaccine id.
     *
     * @return Response::json
     */

    public function deleteVaccine()
    {
        if (Request::ajax()) {

            $id = Input::get('id');
            $vaccine = ServiceAncVaccine::find($id);

            try {
                $vaccine->delete();
                $json = ['ok' => 1];
            } catch (Exception $ex) {
                $json = ['ok' => 0, 'error' => $ex->getMessage()];
            }

        } else {
            $json = ['ok' => 0, 'error' => 'Not ajax request.'];
        }

        return Response::json($json);
    }

}