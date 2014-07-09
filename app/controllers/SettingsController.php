<?php

/**
 * SettingsController
 */
class SettingsController extends BaseController
{
    protected $layout = 'layouts.settings';

    function __construct()
    {
        // Enable auth on request
        $this->beforeFilter('auth', ['only' => ['getIndex']]);

        // Check user type
        $this->beforeFilter(function() {
            if (Auth::user()->user_type != 1) {
                if (Request::ajax()) {
                    return Response::json([
                                'ok' => 0,
                                'error' => 'Permission denied.'
                            ]);
                } else {
                    return View::make('errors.denied');
                }
            }
        });
    }

    /**
     * Index page
     *
     * GET    /settings, /settings/index
     */
    public function getIndex()
    {
        $this->layout->title = 'หน้าหลัก';
        $this->layout->content = View::make('settings.index');
    }

    /**
     * Save vaccine lot
     *
     * POST    /settings/vaccine-lots
     *
     * @internal Input
     *
     * @return Response::json
     */
    public function postVaccineLots()
    {
        if (Request::ajax()) {
            $data = Input::all();
            $validator = Validator::make($data, VaccineLots::$roles);

            if ($validator->passes()) {

				$vaccine = null;
				$id = Input::get('id');

				if (!empty($id)) { // update
					$vaccine = VaccineLots::find(Input::get('id'));
				} else { // new
					$vaccine = new VaccineLots;
					$vaccine->vaccine_id = Input::get('vaccine_id');
				}
				
				$vaccine->lot        = Input::get('lot');
                $vaccine->user_id    = Auth::id();
                $vaccine->hospcode   = Auth::user()->hospcode;
                $vaccine->expire_date = Helpers::toMySQLDate(Input::get('expire_date'));
				
				if (empty($data['id'])) {
	                $isDuplicate = VaccineLots::isDuplicate(
	                    $data['vaccine_id'], Input::get('lot')
	                )->count();

	                if ($isDuplicate) {
	                    $json = ['ok' => 0, 'error' => 'รายการซ้ำ'];
	                } else {
	                    try {
	                        $vaccine->save();
	                        $json = ['ok' => 1, 'id' => $vaccine->id];
	                    } catch (Exception $ex) {
	                        $json = ['ok' => 0, 'error' => $ex->getMessage()];
	                    }
	                }
				} else {
                    try {
                        $vaccine->save();
                        $json = ['ok' => 1, 'id' => $vaccine->id];
                    } catch (Exception $ex) {
                        $json = ['ok' => 0, 'error' => $ex->getMessage()];
                    }
				}
            } else {
                $json = ['ok' => 0, 'error' => $validator->messages()];
            }
        } else {
            $json = ['ok' => 0, 'error' => 'Not ajax request.'];
        }

        return Response::json($json);
    }

    /**
     * Get vaccine's lot
     *
     * GET    /settings/vaccine-lots
     *
     * @return Response::json()
     */
    public function getVaccineLots()
    {

        if (Request::ajax()) {
            $vaccines = VaccineLots::join('vaccines', 'vaccine_lots.vaccine_id', '=', 'vaccines.id')
                ->select(
                    'vaccines.name', 'vaccines.th_name', 'vaccines.export_code', 'vaccine_lots.id',
                    'vaccine_lots.vaccine_id', 'vaccine_lots.lot', 'vaccine_lots.expire_date'
                )
                ->where('vaccine_lots.hospcode', '=', Auth::user()->hospcode)
                ->get();

//            $rs = Vaccine::all();
//            $vaccines = [];
//
//            foreach($rs as $r) {
//                $obj = new stdClass();
//                $obj->id = $r->id;
//                $obj->name = $r->name;
//                $obj->th_name = $r->th_name;
//                $obj->export_code = $r->export_code;
//                $obj->lots = VaccineLots::where('vaccine_id', '=', $r->id);
//
//                $vaccines[] = $obj;
//            }

            $json = ['ok' => 1, 'rows' => $vaccines];
        } else {
            $json = ['ok' => 0, 'error' => 'Not ajax request.'];
        }

        return Response::json($json)->setCallback(Input::get('callback'));

    }
}
