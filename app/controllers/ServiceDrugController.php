<?php

class ServiceDrugController extends BaseController
{

    public function __construct()
    {
        // Turn on CSRF protection
        $this->beforeFilter('csrf', array('on' => 'post'));
        // Turn on auth on ajax request
        $this->beforeFilter('jsondenied');
    }


    /**
     * Save new drug
     *
     * POST    /service-drug/save
     *
     * @internal Input $data The input of data for diag
     *
     * @return Response::json
     */
    public function postSave()
    {
        $data = Input::all();
        $validator = Validator::make($data, ServiceDrug::$roles);

        if ($validator->passes()) {

            if (empty($data['id'])) {
                $isExist = ServiceDrug::isExist($data['service_id'], $data['drug_id'])->count();

                if ($isExist) {
                    $json = ['ok' => 0, 'error' => 'รายการนี้ซ้ำ'];
                } else {
                    $drug = new ServiceDrug();

                    $drug->service_id  = $data['service_id'];
                    $drug->hospcode    = Auth::user()->hospcode;
                    $drug->provider_id = Auth::user()->provider_id;
                    $drug->user_id     = Auth::id();
                    $drug->drug_id     = $data['drug_id'];
                    $drug->usage_id    = $data['usage_id'];
                    $drug->price       = $data['price'];
                    $drug->qty         = $data['qty'];

                    try {
                        $drug->save();
                        $json = ['ok' => 1, 'id' => $drug->id];
                    } catch (Exception $ex) {
                        $json = ['ok' => 0, 'error' => $ex->getMessage()];
                    }
                }
            } else {
                $drug = ServiceDrug::find((int) $data['id']);

                $drug->user_id  = Auth::id();
                $drug->drug_id  = $data['drug_id'];
                $drug->usage_id = $data['usage_id'];
                $drug->price    = $data['price'];
                $drug->qty      = $data['qty'];

                try {
                    $drug->save();
                    $json = ['ok' => 1, 'id' => $drug->id];
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
     * Get diag list
     *
     * GET    /service-drug/list
     *
     * @internal int $service_id
     *
     * @return Response::json
     */
    public function getList()
    {
        $service_id = Input::get('service_id');
        $callback   = Input::get('callback');
        $rs         = ServiceDrug::getList($service_id)->get();
        $json       = ['ok' => 1, 'rows' => $rs];

        return Response::json($json)->setCallback($callback);
    }

    /**
     * Delete drug
     *
     * DELETE    /service-drug/remove
     *
     * @internal int $id
     *
     * @return Response::json
     */
    public function deleteRemove()
    {
        $id = Input::get('id');

        $drug = ServiceDrug::find((int) $id);

        if ($drug) {
            try {
                $drug->delete();
                $json = ['ok' => 1];
            } catch (Exception $ex) {
                $json = ['ok' => 0, 'error' => $ex->getMessage()];
            }
        } else {
            $json = ['ok' => 0, 'error' => 'ไม่พบรายการที่ต้องการลบ'];
        }

        return Response::json($json);
    }

    /**
     * Delete drug all
     *
     * DELETE    /service-drug/remove-all
     *
     * @internal int $service_id
     *
     * @return Response::json
     */
    public function deleteRemoveAll()
    {
        $service_id = Input::get('service_id');

        $drug = ServiceDrug::where('service_id', '=', $service_id);

        try {
            $drug->delete();
            $json = ['ok' => 1];
        } catch (Exception $ex) {
            $json = ['ok' => 0, 'error' => $ex->getMessage()];
        }

        return Response::json($json);
    }
}