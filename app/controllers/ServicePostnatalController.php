<?php


class ServicePostnatalController extends BaseController {
    public function __construct()
    {
        // Turn on CSRF protection
        $this->beforeFilter('csrf', array('on' => 'post'));
        // Turn on auth on ajax request
        $this->beforeFilter('jsondenied');
    }

   public function postSave()
   {
       if (Request::ajax()) {

           $data = Input::all();

           $validator = Validator::make($data, ServicePostnatal::$roles);
           if ($validator->passes()) {
               if (!empty($data['id'])) { // update
                   $postnatal = ServicePostnatal::find($data['id']);
               } else { // new
                   $postnatal = new ServicePostnatal;
                   $postnatal->service_id = $data['service_id'];
                   $postnatal->person_id = $data['person_id'];
                   $postnatal->hospcode = Auth::user()->hospcode;
               }

               $postnatal->user_id = Auth::id();
               $postnatal->gravida = $data['gravida'];
               $postnatal->result = $data['result'];
               $postnatal->service_place = $data['service_place'];
               $postnatal->uterus_level = $data['uterus_level'];
               $postnatal->provider_id = $data['provider_id'];
               $postnatal->amniotic_fluid = $data['amniotic_fluid'];
               $postnatal->tits = $data['tits'];
               $postnatal->albumin = $data['albumin'];
               $postnatal->sugar = $data['sugar'];
               $postnatal->perineal = $data['perineal'];
               $postnatal->advice = $data['advice'];

               try {
                   $postnatal->save();
                   $json = ['ok' => 1, 'id' => $postnatal->id];
               }
               catch (Exception $ex) {
                   $json = ['ok' => 0, 'error' => $ex->getMessage()];
               }
           } else {
               $json = ['ok' => 0, 'error' => 'ข้อมูลไม่ครบถ้วน/ไม่สมบูรณ์ กรุณาตรวจสอบ'];
           }

       } else {
           $json = ['ok' => 0, 'error' => 'Not ajax request'];
       }

       return Response::json($json);
   }

    public function deleteRemove()
    {
        if (Request::ajax()) {
            $id = Input::get('id');
            $postnatal = ServicePostnatal::find($id);

            try {
                $postnatal->delete();
                $json = ['ok' => 1];
            } catch (Exception $ex) {
                $json = ['ok' => 0, 'error' => $ex->getMessage()];
            }
        } else {
            $json = ['ok' => 0, 'error' => 'Not ajax request'];
        }

        return Response::json($json);
    }
} 