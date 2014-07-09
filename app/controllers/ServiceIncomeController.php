<?php

class ServiceIncomeController extends BaseController
{

    public function __construct()
    {
        // Turn on CSRF protection
        $this->beforeFilter('csrf', array('on' => 'post'));
        // Turn on auth on ajax request
        $this->beforeFilter('jsondenied');
    }

    /**
     * Save new income
     *
     * POST    /services/income
     *
     * @internal Input $data
     *
     * @return Response::json
     */
    public function postSave()
    {
        $data = Input::all();
        $validator = Validator::make($data, ServiceIncome::$roles);

        if ($validator->passes()) {
            if (empty($data['id'])) {
                // Check duplicate

                $income = new ServiceIncome();

                $income->service_id  = $data['service_id'];
                $income->hospcode    = Auth::user()->hospcode;
                $income->provider_id = Auth::user()->provider_id;
                $income->user_id     = Auth::id();
                $income->income_id   = $data['income_id'];
                $income->price       = $data['price'];
                $income->qty         = $data['qty'];

                $isDuplicate = ServiceIncome::isDuplicate($data['service_id'], $data['income_id'])->count();

                if ($isDuplicate) {
                    $json = ['ok' => 0, 'error' => 'รายการซ้ำ'];
                } else {
                    try {
                        $income->save();
                        $json = ['ok' => 1];
                    } catch (Exception $e) {
                        $json = ['ok' => 0, 'error' => $e->getMessage()];
                    }
                }
            } else {
                $income = ServiceIncome::find($data['id']);

                $income->price = $data['price'];
                $income->qty = $data['qty'];

                try {
                    $income->save();
                    $json = ['ok' => 1];
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
     * Get income list
     *
     * GET    /services/income
     *
     * @internal int $service_id The ID of service
     *
     * @return Response::json
     */
    public function getList()
    {
        $service_id = Input::get('service_id');
        $callback = Input::get('callback');
        $rs = ServiceIncome::getList($service_id)->get();

        $json = ['ok' => 1, 'rows' => $rs];

        return Response::json($json)->setCallback($callback);
    }

    /**
     * Delete income
     *
     * DELETE    /services/income
     *
     * @internal int $id The id of income
     *
     * @return Response::json
     */
    public function deleteRemove()
    {
        $id = Input::get('id');

        $income = ServiceIncome::find((int) $id);

        if ($income) {
            try {
                $income->delete();
                $json = ['ok' => 1];
            } catch (Exception $e) {
                $json = ['ok' => 0, 'error' => $e->getMessage()];
            }
        } else {
            $json = ['ok' => 0, 'error' => 'ไม่พบรายการที่ต้องการลบ'];
        }

        return Response::json($json);
    }


}