<?php

/**
 * Class ApisController
 *
 * @author      Satit Rianpit <rianpit@gmail.com>
 * @copyright   2013-2015 by Maha Sarakahm Hospital <http://www.mkh.go.th>
 * @since       1.0
 */
class ApisController extends BaseController
{

    /**
     * Constructor function
     *
     */
    public function __construct()
    {
        $this->beforeFilter('denied');
        $this->beforeFilter(
            function () {
                if (!Request::ajax()) {
                    Response::json(['ok' => 0, 'error' => 'Not ajax request'])
                        ->setCallback(Input::get('callback'));
                }
            }
        );
    }

    /**
     * Search Hospital
     *
     * URI  GET /apis/hospitals
     *
     * @internal int $page
     * @internal int $page_limit
     * @internal string $callback
     *
     * @return json
     *
     */
    public function getHospitals()
    {

        $callback = Input::get('callback');
        $query = Input::get('query');
        $page = Input::get('page');
        $page_limit = Input::get('page_limit');

        $start = $page == 1 ? 0 : ($page * $page_limit) - 1;

        $result = DB::table('hospitals')
            ->select('hmain', 'hname')
            ->where('hmain', 'like', '%' . $query . '%')
            ->orWhere('hname', 'like', '%' . $query . '%')
            ->skip($start)
            ->take($page_limit)
            ->get();

        $total = DB::table('hospitals')
            ->select('hmain', 'hname')
            ->where('hmain', 'like', '%' . $query . '%')
            ->orWhere('hname', 'like', '%' . $query . '%')
            ->count();

        $json = array(
            'ok'    => 1,
            'rows'  => $result,
            'total' => $total
        );

        return Response::json($json)->setCallback($callback);
    }

    /**
     * Search hospitals
     *
     * GET    /apis/doctor-rooms
     *
     * @internal int        $clinic_id    Clinic id
     * @internal string     $callback     Callback variable
     *
     * @return   Response::json
     */
    public function getDoctorRooms()
    {
        $callback = Input::get('callback');
        $clinic_id = Input::get('clinic_id');

        $doctor_rooms = DB::table('doctor_rooms')
            ->where('clinic_id', $clinic_id)
            ->get();

        $json = ['ok' => 1, 'rows' => $doctor_rooms];

        return Response::json($json)->setCallback($callback);
    }

    /**
     * Search diagnosis
     *
     * GET     /apis/diagnosis
     *
     * @internal    int    $page        Current page
     * @internal    int    $page_limit  Number of record per page
     * @internal    string $callback    Callback variable
     *
     * @return      Response::json
     */
    public function getDiagnosis()
    {

        $callback = Input::get('callback');
        $page = Input::get('page');
        $page_limit = Input::get('page_limit');

        $start = $page == 1 ? 0 : ($page * $page_limit) - 1;

        $condition = Input::get('query');

        $result = DB::table('diagnosis')
            ->select('code', 'desc_r')
            ->where('valid', 'T')

            ->Where(
                function ($query) use ($condition) {
                    $query
                        ->where('code', 'like', $condition . '%')
                        ->orWhere('desc_r', 'like', '%' . $condition . '%');
                }
            )
            ->skip($start)
            ->take($page_limit)
            ->get();

        $total = DB::table('diagnosis')
            ->where('valid', 'T')
            ->Where(
                function ($query) use ($condition) {
                    $query
                        ->where('code', 'like', $condition . '%')
                        ->orWhere('desc_r', 'like', '%' . $condition . '%');
                }
            )
            ->count();

        $json = array(
            'ok'    => 1,
            'rows'  => $result,
            'total' => $total
        );

        return Response::json($json)->setCallback($callback);
    }

    /**
     * Search procedures
     *
     * GET    /apis/procedures
     *
     * @internal int    $page        Current page number
     * @internal int    $page_limit  Number of records pre page
     * @internal string $callback    Callback
     *
     * @return   Response::json
     */
    public function getProcedures()
    {

        $callback = Input::get('callback');

        $page = Input::get('page');
        $page_limit = Input::get('page_limit');
        $query = Input::get('query');
        $type = Input::get('t');

        $start = $page == 1 ? 0 : ($page * $page_limit) - 1;

        $result = DB::table('procedures')
            ->select('id', 'name', 'price')
            ->where('is_active', 'Y')
            ->where('procedure_type', $type)
            ->where('name', 'like', '%' . $query . '%')
            ->skip($start)
            ->take($page_limit)
            ->get();

        $total = DB::table('procedures')
            ->where('is_active', 'Y')
            ->where('procedure_type', $type)
            ->where('name', 'like', '%' . $query . '%')
            ->count();

        $json = [
            'ok'    => 1,
            'rows'  => $result,
            'total' => $total
        ];

        return Response::json($json)->setCallback($callback);
    }

    /**
     * Search procedure position
     *
     * GET    /apis/procedure-positions
     *
     * @internal int    $id        Current page number
     * @internal string $callback    Callback
     *
     * @return   Response::json
     */
    public function getProcedurePositions()
    {
        $callback = Input::get('callback');
        $procedure_id = Input::get('id');

        $result = DB::table('procedure_positions')
            ->where('procedure_id', (int)$procedure_id)
            ->get();

        $json = ['ok' => 1, 'rows' => $result];

        return Response::json($json)->setCallback($callback);
    }

    /**
     * Search procedures
     *
     * GET    /apis/incomes
     *
     * @internal int    $page        Current page number
     * @internal int    $page_limit  Number of records pre page
     * @internal string $callback    Callback
     *
     * @return   Response::ajax
     */
    public function getIncomes()
    {
        $callback = Input::get('callback');

        $page = Input::get('page');
        $page_limit = Input::get('page_limit');
        $query = Input::get('query');

        $start = $page == 1 ? 0 : ($page * $page_limit) - 1;

        $result = DB::table('incomes')
            ->select('id', 'name', 'price')
            ->where('is_active', 'Y')
            ->where('name', 'like', '%' . $query . '%')
            ->skip($start)
            ->take($page_limit)
            ->get();

        $total = DB::table('incomes')
            ->where('is_active', 'Y')
            ->where('name', 'like', '%' . $query . '%')
            ->count();

        $json = [
            'ok'    => 1,
            'rows'  => $result,
            'total' => $total
        ];

        return Response::json($json)->setCallback($callback);
    }

    /**
     * Search drugs
     *
     * GET    /apis/drugs
     *
     * @internal string $query       Query string
     * @internal int    $page        Current page number
     * @internal int    $page_limit  Number of records pre page
     * @internal string $callback    Callback
     *
     * @return   json
     */
    public function getDrugs()
    {

        $callback = Input::get('callback');
        $page = Input::get('page');
        $page_limit = Input::get('page_limit');

        $query = Input::get('query');

        $start = $page == 1 ? 0 : ($page * $page_limit) - 1;

        $result = DB::table('drugs')
            ->select('id', 'name', 'price')
            ->where('is_active', 'Y')
            ->where('name', 'like', '%' . $query . '%')
            ->skip($start)
            ->take($page_limit)
            ->get();

        $total = DB::table('drugs')
            ->where('is_active', 'Y')
            ->where('name', 'like', '%' . $query . '%')
            ->count();

        $json = [
            'ok'    => 1,
            'rows'  => $result,
            'total' => $total
        ];

        return Response::json($json)->setCallback($callback);
    }

    /**
     * Search procedures
     *
     * GET    /apis/drug-usages
     *
     * @internal string $query       Query string
     * @internal int    $page        Current page number
     * @internal int    $page_limit  Number of records pre page
     * @internal string $callback    Callback
     *
     * @return   json
     */
    public function getDrugUsages()
    {

        $page = Input::get('page');
        $page_limit = Input::get('page_limit');
        $callback = Input::get('callback');

        $query = Input::get('query');

        $start = $page == 1 ? 0 : ($page * $page_limit) - 1;

        $result = DB::table('drugusages')
            ->select('id', 'code')
            //->where('is_active', 'Y')
            ->where('code', 'like', $query . '%')
            ->skip($start)
            ->take($page_limit)
            ->get();

        $total = DB::table('drugusages')
            //->where('is_active', 'Y')
            ->where('code', 'like', $query . '%')
            ->count();

        $json = [
            'ok'    => 1,
            'rows'  => $result,
            'total' => $total
        ];

        return Response::json($json)->setCallback($callback);
    }

    /**
     * Get vaccine lot
     *
     * GET    /apis/vaccine-lot
     *
     * @internal int $service_id The service id
     * @internal string $callback The callback
     *
     * @return Response::json
     */
    public function getVaccineLot()
    {
        $vaccine_id = Input::get('vaccine_id');
        $callback   = Input::get('callback');

        $result     = VaccineLots::where('vaccine_id', '=', $vaccine_id)
                        ->where('hospcode', '=', Auth::user()->hospcode)
                        ->get();

        $json       = ['ok' => 1, 'rows' => $result];

        return Response::json($json)->setCallback($callback);
    }

    public function getVaccine()
    {
        $t = Input::get('t');
        $callback = Input::get('callback');

        if (empty($t)) { // get all
            $json = ['ok' => 0, 'error' => 'กรุณาระบุประเภทของวัคซีน'];
        } else {
            if ($t == 1) { // WBC
                $vaccines = Vaccine::getWbc()->get();
            } elseif ($t == 2) { // STUDENT
                $vaccines = Vaccine::getStudent()->get();
            } else { // OTHER not ANC
                $vaccines = Vaccine::getOther()->get();
            }

            $json = ['ok' => 1, 'rows' => $vaccines];
        }

        return Response::json($json)->setCallback($callback);
    }
}
