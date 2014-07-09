<?php
/**
 * @package Controller
 * @author Satit Rianpit <rianpit@gmail.com>
 * @since Version 1.0.0
 * @version 1.0.0
 * @copyright 2014 - 2014
 */

class ServicesController extends BaseController
{
    // Default layout
    protected $layout = 'layouts.default';

    /**
     * Constructor function
     *
     */
    public function __construct()
    {
        // Turn on CSRF protection
        $this->beforeFilter('csrf', array('on' => 'post'));
        // Turn on auth on ajax request
        $this->beforeFilter('jsondenied', [
            'except' => ['getIndex', 'getRegister', 'getEntries']
        ]);

        $this->beforeFilter('auth', ['only' => ['getIndex', 'getRegister', 'getEntries']]);
    }

    /**
     * Service index
     *
     * GET    /services
     */
    public function getIndex()
    {
        $clinics = Clinic::getActive()->get();

        $this->layout->title = 'การให้บริการ';
        $this->layout->content = View::make('services.index', [
            'clinics' => $clinics
        ]);
    }

    /**
     * Register service
     *
     * GET    /services/register
     */
    public function getRegister()
    {
        $clinics = Clinic::getActive()->get();
        $ins = Insurance::getActive()->get();

        $this->layout->content = View::make('services.register', [
            'clinics' => $clinics,
            'ins' => $ins
        ]);

        $this->layout->title = 'ลงทะเบียนส่งตรวจ';
    }

    /**
     * Save service
     *
     * POST /services/save
     */
    public function postSave()
    {
        if (Request::ajax()) {
            $data = Input::all();

            $validator = Validator::make($data, Service::$roles);

            if ($validator->passes()) {
                try {
                    //do save
                    $s = new Service;

                    $s->hospcode = Auth::user()->hospcode;
                    $s->person_id = $data['pid'];
                    $s->service_date = Helpers::toMySQLDate($data['service_date']);
                    $s->service_time = $data['service_time'];
                    $s->location = $data['service_location'];
                    $s->intime = $data['service_intime'];
                    $s->type_in = $data['service_type_in'];
                    $s->service_place = $data['service_place'];
                    $s->priority = $data['service_priority'];
                    $s->clinic_id = $data['service_clinic'];
                    $s->doctor_room_id = $data['service_doctor_room'];
                    $s->provider_id = Auth::user()->provider_id;
                    $s->user_id = Auth::id();

                    //save opd screen
                    $sc = new Screening();
                    $sc->hospcode = Auth::user()->hospcode;
                    $sc->cc = $data['service_cc'];
                    //$sc->person_id = $data['pid'];

                    //save insurance
                    $ins = new ServiceInsurance();

                    //$ins->person_id      = $data['pid'];
                    $ins->insurance_id = $data['service_ins'];
                    $ins->insurance_code = $data['service_ins_code'];
                    $ins->hospmain = $data['service_ins_main'];
                    $ins->hospsub = $data['service_ins_sub'];
                    $ins->start_date = Helpers::toMySQLDate($data['service_ins_start']);
                    $ins->expire_date = Helpers::toMySQLDate($data['service_ins_expire']);
                    $ins->hospcode = Auth::user()->hospcode;

                    DB::transaction(function () use ($s, $sc, $ins) {
                        $s->save();

                        $ins->service_id = $s->id;
                        $sc->service_id = $s->id;

                        $sc->save();
                        $ins->save();
                    });

                    $json = ['ok' => 1];
                } catch (Exception $ex) {
                    $json = ['ok' => 0, 'error' => $ex->getMessage()];
                }
            } else {
                $json = ['ok' => 0, 'error' => 'ข้อมูลไม่ถูกต้องตามรูปแบบ กรุณาตรวจสอบ'];
            }
        } else {
            $json = ['ok' => 0, 'error' => 'Not ajax request'];
        }

        return Response::json($json);
    }

    /**
     * Get service list
     *
     * GET    /services/list
     *
     * @internal date $startDate Start date
     * @internal date $endDate Stop date
     * @internal string $callback Callback
     * @internal int $clinic Clinic id
     *
     * @return   Response::json
     */
    public function getList()
    {
        $start_date = Input::get('startDate');
        $end_date = Input::get('endDate');
        $callback = Input::get('callback');
        $clinic = Input::get('clinic');

        $start_date = Helpers::toMySQLDate($start_date);
        $end_date = Helpers::toMySQLDate($end_date);

        $services = DB::table('services as v')
            ->select(
                'v.id', 'v.service_date', 'v.service_time', 'p.cid',
                'p.fname', 'p.lname', 'p.birthdate', 'i.insurance_name',
                'vi.insurance_code', 'i.export_code as ins_export_code',
                'sc.cc', 'pr.fname as provider_fname', 'pr.lname as provider_lname',
                't.name as title_name'
            )
            ->leftJoin('person as p', 'p.id', '=', 'v.person_id')
            ->leftJoin('service_insurances as vi', 'vi.service_id', '=', 'v.id')
            ->leftJoin('service_screenings as sc', 'sc.service_id', '=', 'v.id')
            ->leftJoin('providers as pr', 'pr.id', '=', 'v.provider_id')
            ->leftJoin('insurances as i', 'i.id', '=', 'vi.insurance_id')
            ->leftJoin('person_title as t', 't.id', '=', 'p.title_id')
            ->whereBetween('v.service_date', [$start_date, $end_date])
            ->where('v.hospcode', Auth::user()->hospcode);

        try {
            if ($clinic == '0') {
                $rs = $services->get();
            } else {
                $rs = $services->where('v.clinic_id', $clinic)->get();
            }

            $arr = [];

            foreach ($rs as $v) {
                $obj = new stdClass();
                $obj->visit_id = $v->id;
                $obj->service_date = $v->service_date;
                $obj->service_time = $v->service_time;
                $obj->cid = $v->cid;
                $obj->fullname = $v->title_name . $v->fname . ' ' . $v->lname;
                $obj->birthdate = $v->birthdate;
                $obj->ins_code = $v->insurance_code;
                $obj->ins_name = '[' . $v->ins_export_code . '] ' . $v->insurance_name;
                $obj->cc = $v->cc;
                $obj->diag = '';
                $obj->provider_name = $v->provider_fname . ' ' . $v->provider_lname;

                $arr[] = $obj;
            }

            $json = ['ok' => 1, 'rows' => $arr];

        } catch (Exception $ex) {
            $json = ['ok' => 0, 'error' => $ex->getMessage()];
        }

        return Response::json($json)->setCallback($callback);
    }

    /**
     * Search service
     *
     * POST    /services/search
     *
     * @internal int $pid Person id
     * @internal string $callback Callback value
     *
     * @return Response::json
     */
    public function postSearch()
    {
        $callback = Input::get('callback');
        $pid = Input::get('pid');

        if (isset($pid)) {

            $visits = DB::table('services as v')
                ->select(
                    'v.id', 'v.service_date', 'v.service_time', 'p.cid', 'p.fname', 'p.lname',
                    'p.birthdate', 'i.name as insurance_name', 'vi.insurance_code', 'i.export_code as ins_export_code',
                    'sc.cc', 'pr.fname as provider_fname', 'pr.lname as provider_lname', 't.name as title_name'
                )
                ->leftJoin('person as p', 'p.id', '=', 'v.pid')
                ->leftJoin('visit_insurance as vi', 'vi.visit_id', '=', 'v.id')
                ->leftJoin('screening as sc', 'sc.visit_id', '=', 'v.id')
                ->leftJoin('provider as pr', 'pr.id', '=', 'v.provider_id')
                ->leftJoin('ref_insurance as i', 'i.id', '=', 'vi.insurance_id')
                ->leftJoin('ref_person_title as t', 't.id', '=', 'p.title_id')
                ->where('v.pid', $pid)
                ->where('v.hospcode', Auth::user()->hospcode)
                ->get();

            $arr = [];

            foreach ($visits as $v) {
                $obj = new stdClass();
                $obj->visit_id = $v->id;
                $obj->service_date = $v->service_date;
                $obj->service_time = $v->service_time;
                $obj->cid = $v->cid;
                $obj->fullname = $v->title_name . $v->fname . ' ' . $v->lname;
                $obj->birthdate = $v->birthdate;
                $obj->ins_code = $v->insurance_code;
                $obj->ins_name = '[' . $v->ins_export_code . '] ' . $v->insurance_name;
                $obj->cc = $v->cc;
                $obj->diag = '';
                $obj->provider_name = $v->provider_fname . ' ' . $v->provider_lname;

                $arr[] = $obj;
            }

            $json = ['ok' => 1, 'rows' => $arr];
        } else {
            $json = ['ok' => 0, 'msg' => 'กรุณาระบุคำค้นหา'];
        }

        return Response::json($json)->setCallback($callback);
    }

    /**
     * Service detail
     *
     * GET    /services/entries/{id}
     *
     * @param int $id Service id
     *
     * @return View
     */
    public function getEntries($id = null)
    {

        $service = DB::table('services as v')
            ->select(
                'v.*', 'vi.insurance_code', 'vi.hospmain', 'vi.hospsub',
                'i.export_code as insurance_export_code', 'i.insurance_name',
                'p.fname', 'p.lname'
            )
            ->leftJoin('service_insurances as vi', 'vi.service_id', '=', 'v.id')
            ->leftJoin('insurances as i', 'i.id', '=', 'vi.insurance_id')
            ->leftJoin('providers as p', 'p.id', '=', 'v.provider_id')
            ->where('v.id', $id)
            ->first();

        if ($service) {

            $person = DB::table('person as p')
                ->select(
                    'p.fname', 'p.lname', 'p.id', 'p.cid', 'p.birthdate', 'p.sex',
                    't.typearea', 'p.home_id', 'pt.name as title_name', 't.typearea'
                )
                ->leftJoin('person_typearea as t', 't.cid', '=', 'p.cid')
                ->leftJoin('person_title as pt', 'pt.id', '=', 'p.title_id')
                ->where('t.hospcode', Auth::user()->hospcode)
                ->where('p.id', $service->person_id)
                ->first();

            $this->layout->title = 'ข้อมูลการให้บริการ';
            $this->layout->content = View::make('services.entries', [
                'person' => $person,
                'service' => $service
            ]);

        } else {
            return View::make('errors.404');
        }
    }

    /**
     * Update servcie screening
     *
     * POST    /services/screenings
     *
     * @internal    Input
     *
     * @return      Response::json
     */
    public function postScreenings()
    {
        $data = Input::all();
        $validator = Validator::make($data, Screening::$roles);

        if ($validator->passes()) {
            $sc = Screening::find((int)$data['screen_id']);
            $service = Service::find((int)$data['service_id']);

            if ($service) {
                $service->locked = $data['locked'];
                $service->service_status_id = $data['service_status'];

                $sc->cc = $data['cc'];
                $sc->body_temp = $data['body_temp'];
                $sc->sbp = $data['sbp'];
                $sc->dbp = $data['dbp'];
                $sc->pr = $data['pr'];
                $sc->rr = $data['rr'];
                $sc->smoking = $data['smoking'];
                $sc->drinking = $data['drinking'];
                $sc->weight = $data['weight'];
                $sc->height = $data['height'];
                $sc->waist = $data['waist'];
                $sc->pe = $data['pe'];
                $sc->ill_history = $data['ill_history'];
                $sc->ill_history_detail = $data['ill_history_detail'];
                $sc->operate_history = $data['operate_history'];
                $sc->operate_history_detail = $data['operate_history_detail'];
                $sc->mind_strain = $data['mind_strain'];
                $sc->mind_work = $data['mind_work'];
                $sc->mind_family = $data['mind_family'];
                $sc->mind_other = $data['mind_other'];
                $sc->mind_other_detail = $data['mind_other_detail'];
                $sc->risk_ht = $data['risk_ht'];
                $sc->risk_dm = $data['risk_dm'];
                $sc->risk_stoke = $data['risk_stoke'];
                $sc->risk_other = $data['risk_other'];
                $sc->risk_other_detail = $data['risk_other_detail'];
                $sc->lmp = $data['lmp'];
                $sc->lmp_start = !empty($data['lmp_start']) ? Helpers::toMySQLDate($data['lmp_start']) : '';
                $sc->lmp_finished = !empty($data['lmp_finished']) ? Helpers::toMySQLDate($data['lmp_finished']) : '';
                $sc->consult_drug = $data['consult_drug'];
                $sc->consult_activity = $data['consult_activity'];
                $sc->consult_food = $data['consult_food'];
                $sc->consult_appoint = $data['consult_appoint'];
                $sc->consult_exercise = $data['consult_exercise'];
                $sc->consult_complication = $data['consult_complication'];
                $sc->consult_other = $data['consult_other'];
                $sc->consult_other_detail = $data['consult_other_detail'];

                try {
                    DB::transaction(function () use ($sc, $service) {
                        $service->save();
                        $service->touch();

                        $sc->save();
                    });

                    $json = array('ok' => 1);
                } catch (Exception $ex) {
                    $json = ['ok' => 0, 'error' => $ex->getMessage()];
                }
            } else {
                $json = ['ok' => 0, 'error' => 'ไม่พบข้อมูลการรับบริการ (อาจถูกลบก่อนทำการบันทึก)'];
            }
        } else $json = ['ok' => 0, 'error' => 'ข้อมูลไม่สมบูรณ์ กรุณาตรวจสอบ'];

        return Response::json($json);
    }

    /**
     * Save new refer out
     *
     * POST    /services/refer-out
     *
     * @internal Input $data
     *
     * @return Response::json
     */
    public function postReferOut()
    {
        $data = Input::all();

        $validator = Validator::make($data, ServiceReferOut::$roles);

        if ($validator->passes()) {
            if (empty($data['refer_id'])) {
                try {
                    $refer = new ServiceReferOut();

                    $refer->service_id = $data['service_id'];
                    $refer->hospcode = Auth::user()->hospcode;
                    $refer->user_id = Auth::id();
                    $refer->provider_id = $data['provider_id'];
                    $refer->refer_date = Helpers::toMySQLDate($data['refer_date']);
                    $refer->cause_id = $data['cause_id'];
                    $refer->diagnosis_code = $data['diag_code'];
                    $refer->to_hospital = $data['to_hospital'];
                    $refer->expire_date = Helpers::toMySQLDate($data['expire_date']);
                    $refer->description = $data['description'];

                    $refer->save();
                    $json = ['ok' => 1, 'id' => $refer->id];
                } catch (Exception $ex) {
                    $json = ['ok' => 0, 'error' => $ex->getMessage()];
                }
            } else {
                try {
                    $refer = ServiceReferOut::find((int)$data['refer_id']);

                    $refer->service_id = $data['service_id'];
                    $refer->hospcode = Auth::user()->hospcode;
                    $refer->user_id = Auth::id();
                    $refer->provider_id = $data['provider_id'];
                    $refer->refer_date = Helpers::toMySQLDate($data['refer_date']);
                    $refer->cause_id = $data['cause_id'];
                    $refer->diagnosis_code = $data['diag_code'];
                    $refer->to_hospital = $data['to_hospital'];
                    $refer->expire_date = Helpers::toMySQLDate($data['expire_date']);
                    $refer->description = $data['description'];

                    $refer->save();

                    $json = ['ok' => 1, 'id' => $refer->id];
                } catch (Exception $ex) {
                    $json = ['ok' => 0, 'error' => $ex->getMessage()];
                }
            }
        } else {
            $json = ['ok' => 0, 'error' => 'ข้อมูลไม่ถูกต้อง หรือ ไม่สมบูรณ์ กรุณาตรวจสอบ'];
        }

        return Response::json($json);
    }

    /**
     * Delete refer out
     *
     * DELETE    /services/refer-out
     *
     * @internal int $id
     *
     * @return Response::json
     */
    public function deleteReferOut()
    {
        $id = Input::get('id');
        $refer = ServiceReferOut::find($id);

        if ($refer) {
            try {
                $refer->delete();
                $json = ['ok' => 1];
            } catch (Exception $ex) {
                $json = ['ok' => 0, 'error' => $ex->getMessage()];
            }
        } else {
            $json = ['ok' => 0, 'error' => 'ไม่พบรายการที่ต้องการลบ'];
        }

        return Response::json($json);
    }

    public function postNutrition()
    {
        if (Request::ajax()) {
            $data = Input::all();
            $validator = Validator::make($data, ServiceNutrition::$roles);

            if ($validator->passes()) {
                $nutri = ServiceNutrition::where('service_id', '=', $data['service_id'])->first();

                $nutrition = null;

                if ($nutri) {
                    $nutrition = ServiceNutrition::find($nutri->id);
                } else {
                    $nutrition = new ServiceNutrition;
                }

                $nutrition->hospcode = Auth::user()->hospcode;
                $nutrition->user_id = Auth::id();
                $nutrition->provider_id = $data['provider_id'];
                $nutrition->service_id = $data['service_id'];
                $nutrition->weight = $data['weight'];
                $nutrition->height = $data['height'];
                $nutrition->head_circum = $data['head_circum'];
                $nutrition->food = $data['food'];
                $nutrition->bottle = $data['bottle'];
                $nutrition->age_weight_score = $data['age_weight_score'];
                $nutrition->age_height_score = $data['age_height_score'];
                $nutrition->weight_height_score = $data['weight_height_score'];
                $nutrition->child_develop = $data['child_develop'];

                try {
                    $nutrition->save();
                    $json = ['ok' => 1];
                } catch (Exception $ex) {
                    $json = ['ok' => 0, 'error' => $ex->getMessage()];
                }

            } else {
                $json = ['ok' => 0, 'error' => 'ข้อมูลไม่ครบถ้วน กรุณาตรวจสอบ'];
            }

        } else {
            $json = ['ok' => 0, 'error' => 'Not ajax request.'];
        }

        return Response::json($json);
    }

}