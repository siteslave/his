<?php

class ServiceAccidentController extends BaseController
{

    public function __construct()
    {
        // Turn on CSRF protection
        $this->beforeFilter('csrf', array('on' => 'post'));
        // Turn on auth on ajax request
        $this->beforeFilter('jsondenied');
    }


    /**
     * Save new accident
     *
     * POST    /service-accident/save
     *
     * @internal Input $data
     *
     * @return Response::json
     */
    public function postSave()
    {
        $data = Input::all();
        $validator = Validator::make($data, ServiceAccident::$roles);

        if ($validator->passes()) {
            if (empty($data['id'])) {
                $acc = new ServiceAccident();

                $acc->hospcode            = Auth::user()->hospcode;
                $acc->user_id             = Auth::id();
                $acc->service_id          = $data['service_id'];
                $acc->accident_date       = Helpers::toMySQLDate($data['accident_date']);
                $acc->accident_time       = $data['accident_time'];
                $acc->accident_type_id    = $data['accident_type_id'];
                $acc->accident_place_id   = $data['accident_place_id'];
                $acc->accident_type_in_id = $data['accident_type_in_id'];
                $acc->traffic             = $data['traffic'];
                $acc->accident_vehicle_id = $data['accident_vehicle_id'];
                $acc->alcohol             = $data['alcohol'];
                $acc->nacrotic_drug       = $data['nacrotic_drug'];
                $acc->belt                = $data['blet'];
                $acc->helmet              = $data['helmet'];
                $acc->airway              = $data['airway'];
                $acc->stop_bleed          = $data['stop_bleed'];
                $acc->splint              = $data['splint'];
                $acc->fluid               = $data['fluid'];
                $acc->urgency             = $data['urgency'];
                $acc->coma_eye            = $data['coma_eye'];
                $acc->coma_speak          = $data['coma_speak'];
                $acc->coma_movement       = $data['coma_movement'];

                try {
                    $acc->save();
                    $json = ['ok' => 1, 'id' => $acc->id];
                } catch (Exception $ex) {
                    $json = ['ok' => 0, 'error' => $ex->getMessage()];
                }
            } else {
                $acc = ServiceAccident::find($data['id']);

                $acc->user_id = Auth::id();
                $acc->accident_date       = Helpers::toMySQLDate($data['accident_date']);
                $acc->accident_time       = $data['accident_time'];
                $acc->accident_type_id    = $data['accident_type_id'];
                $acc->accident_place_id   = $data['accident_place_id'];
                $acc->accident_type_in_id = $data['accident_type_in_id'];
                $acc->traffic             = $data['traffic'];
                $acc->accident_vehicle_id = $data['accident_vehicle_id'];
                $acc->alcohol             = $data['alcohol'];
                $acc->nacrotic_drug       = $data['nacrotic_drug'];
                $acc->belt                = $data['blet'];
                $acc->helmet              = $data['helmet'];
                $acc->airway              = $data['airway'];
                $acc->stop_bleed          = $data['stop_bleed'];
                $acc->splint              = $data['splint'];
                $acc->fluid               = $data['fluid'];
                $acc->urgency             = $data['urgency'];
                $acc->coma_eye            = $data['coma_eye'];
                $acc->coma_speak          = $data['coma_speak'];
                $acc->coma_movement       = $data['coma_movement'];

                try {
                    $acc->save();
                    $json = ['ok' => 1, 'id' => $acc->id];
                } catch (Exception $ex) {
                    $json = ['ok' => 0, 'error' => $ex->getMessage()];
                }
            }
        } else {
            $json = ['ok' => 0, 'error' => 'ข้อมูลไม่ถูกรูปแบบ หรือ ไม่สมบูรณ์ กรุณาตรวจสอบ'];
        }

        return Response::json($json);
    }

    /**
     * Delete accident data
     *
     * DELETE    /service-accident/remove
     *
     * @internal int $id
     *
     * @return Response::json
     */
    public function deleteRemove()
    {
        $id = Input::get('id');
        $acc = ServiceAccident::find($id);

        if ($acc) {
            try {
                $acc->delete();
                $json = ['ok' => 1];
            } catch (Exception $ex) {
                $json = ['ok' => 0, 'error' => $ex->getMessage()];
            }
        } else {
            $json = ['ok' => 0, 'error' => 'ไม่พบรายการที่ต้องการลบ'];
        }

        return Response::json($json);
    }

}