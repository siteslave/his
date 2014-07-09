<?php

class PagesController extends BaseController
{

    public function __construct()
    {
        $this->beforeFilter('timeout');
    }

    /**
     * Service screening
     *
     * POST    /pages/service-screenings
     *
     * @internal int    $service_id    Service id
     * @return   View
     */
    public function postServiceScreenings()
    {

        $service_id = Input::get('service_id');
        $services   = Service::where('id', (int)$service_id)->first();
        $screen     = $services->screening()->first();
        $status     = ServiceStatus::all();

        return View::make('pages.services.screening')
            ->with('status', $status)
            ->with('services', $services)
            ->with('screen', $screen);

    }

    /**
     * Service diagnosis
     *
     * POST    /pages/service-diagnosis
     *
     * @internal int    $service_id    Service id
     * @return   View
     */
    public function postServiceDiagnosis()
    {
        $service_id = Input::get('service_id');

        $diag       = ServiceDiagnosis::getList($service_id)->get();
        $diagtype   = DiagnosisType::getActive()->get(['code', 'name']);

        return View::make('pages.services.diagnosis')
            ->with('diag', $diag)
            ->with('diagtype', $diagtype);
    }

    /**
     * Service procedures
     *
     * POST    /pages/service-procedures
     *
     * @return   view
     */
    public function postServiceProcedures()
    {
        $providers = Provider::getActive()->get(['id', 'fname', 'lname']);

        return View::make('pages.services.procedure')
            ->with('providers', $providers);
    }

    /**
     * Service income
     *
     * POST    /pages/service-incomes
     *
     * @return   view
     */
    public function postServiceIncomes()
    {
        return View::make('pages.services.income');
    }

    /**
     * Service drug
     *
     * POST    /pages/service-drugs
     *
     * @return   view
     */
    public function postServiceDrugs()
    {
        return View::make('pages.services.drug');
    }

    /**
     * Service appointments
     *
     * POST    /pages/service-appoint
     *
     * @return   View
     */
    public function postServiceAppoint()
    {
        $clinics   = Clinic::getActive()->get();
        $appoints  = AppointType::getActive()->get();
        $providers = Provider::getActive()->get(['id', 'fname', 'lname']);

        return View::make('pages.services.appointment')
            ->with('clinics', $clinics)
            ->with('appoints', $appoints)
            ->with('providers', $providers);
    }

    /**
     * Service refer out
     *
     * POST    /pages/service-refer-out
     *
     * @internal int    $service_id    Service id
     * @return   View
     */
    public function postServiceReferOut()
    {
        $service_id = Input::get('service_id');

        $refer      = ServiceReferOut::getDetail($service_id)->first();
        $providers  = Provider::getActive()->get(['id', 'fname', 'lname']);
        $cause      = DB::table('refer_cause')->get();

        return View::make('pages.services.referout')
            ->with('providers', $providers)
            ->with('cause', $cause)
            ->with('refer', $refer);
    }

    /**
     * Service screening
     *
     * POST    /pages/service-accidents
     *
     * @internal int    $service_id    Service id
     * @return   View
     */
    public function postServiceAccidents()
    {
        $service_id = Input::get('service_id');

        $accident   = ServiceAccident::getDetail($service_id)->first();

        $type       = DB::table('accident_type')->get(['id', 'th_name', 'export_code']);
        $place      = DB::table('accident_place')->get();
        $typein     = DB::table('accident_type_in')->get();
        $vehicle    = DB::table('accident_vehicle')->get();

        return View::make('pages.services.accident', [
            'type'     => $type,
            'accident' => $accident,
            'place'    => $place,
            'typein'   => $typein,
            'vehicle'  => $vehicle
        ]);
    }

    public function postServiceAnc()
    {
        $isExist = Pregnancy::where('person_id', '=', Input::get('person_id'))
            ->where('hospcode', '=', Auth::user()->hospcode)
            ->count();

        if ($isExist) {
            $gravida = Pregnancy::getGA(Input::get('person_id'))->get(['gravida']);

            $baby_leads     = DB::table('anc_baby_leads')->get();
            $baby_positions = DB::table('anc_baby_positions')->get();
            $uterus_levels  = DB::table('anc_uterus_levels')->get();
            $vaccines       = DB::table('vaccines')->where('is_anc', '=', 'Y')
                                ->get(['id', 'name', 'th_name', 'export_code']);
            $anc_vaccines   = DB::table('service_anc_vaccines as av')
                                ->select(
                                    'av.id', 'av.provider_id', 'v.name', 'v.th_name',
                                    'p.fname', 'p.lname', 'av.lot', 'av.expire_date'
                                )
                                ->leftJoin('vaccines as v', 'v.id', '=', 'av.vaccine_id')
                                ->leftJoin('providers as p', 'p.id', '=', 'av.provider_id')
                                ->where('av.service_id', '=', Input::get('service_id'))
                                ->get();

            $all_services = ServiceAnc::where(
                    'service_anc.person_id', '=', Input::get('person_id')
                )
                ->select(
                    'service_anc.*', 'providers.fname', 'providers.lname', 'services.service_date',
                    'hospitals.hmain', 'hospitals.hname'
                )
                ->join('services', 'services.id', '=', 'service_anc.service_id')
                ->leftJoin('providers', 'providers.id', '=', 'service_anc.provider_id')
                ->leftJoin('hospitals', 'hospitals.hmain', '=', 'service_anc.hospcode')
                ->get();
            //$vaccines = [];
            //foreach ($vaccine_anc as $v) $vaccines[$v->id] = '['.$v->export_code.'] ' . $v->th_name;

            $uterus = [];
            foreach ($uterus_levels as $u) $uterus[$u->id] = $u->name;

            $gravidas = [];
            foreach ($gravida as $g) $gravidas[$g->gravida] = $g->gravida;

            $positions = [];
            foreach ($baby_positions as $p) $positions[$p->id] = $p->name;
            $leads = [];
            foreach ($baby_leads as $l) $leads[$l->id] = $l->name;

            $providers = Provider::getActive()->get(['id', 'fname', 'lname']);
            $provider = [];
            foreach ($providers as $p) $provider[$p->id] = $p->fname . ' ' . $p->lname;

            $anc = DB::table('service_anc')->where('service_id', '=', Input::get('service_id'))->first();

            return View::make('pages.services.anc')
                ->with('uterus', $uterus)
                ->with('leads', $leads)
                ->with('positions', $positions)
                ->with('providers', $provider)
                ->with('gravidas', $gravidas)
                ->with('vaccines', $vaccines)
                ->with('anc_vaccines', $anc_vaccines)
                ->with('anc', $anc)
                ->with('all_services', $all_services);
        } else {
            return View::make('pages.pregnancies.not-register');
        }
    }
    /**
     * Pregnancy detail
     *
     * POST    /pages/pregnancy-detail
     *
     * @internal int $id Pregnancy id
     * @return   View
     */
    public function postPregnancyDetail()
    {
        $id = Input::get('id');
        $preg = Pregnancy::where('id', $id)->first();
        $risk = PregnancyRisk::where('pregnancy_id', '=', $id)->first();

        if ($preg) {
            $providers = Provider::getActive()->get();
            $arr_provider = [];
            foreach ($providers as $p) $arr_provider[$p->id] = $p->fname . ' ' . $p->lname;

            return View::make('pages.pregnancies.detail')
                ->with('providers', $arr_provider)
                ->with('preg', $preg)
                ->with('risk', $risk);
        } else {
            return View::make('errors.404');
        }
    }

    /**
     * Pregnancy list
     *
     * GET    /pages/pregnancy-list
     *
     * @internal int    $pregnancy_id    Pregnancy id
     * @return   View
     */
    public function getPregnanciesList()
    {
        return View::make('pages.pregnancies.list');
    }

    public function getPregnanciesSearch()
    {
        return View::make('pages.pregnancies.search');
    }

    public function postPregnanciesAnc()
    {
        $person_id = Input::get('person_id');
        $gravida = Input::get('gravida');

        $coverages = AncCoverage::where('anc_coverages.person_id', '=', $person_id)
            ->select('anc_coverages.*', 'hospitals.hmain', 'hospitals.hname')
            ->join('hospitals', 'hospitals.hmain', '=', 'anc_coverages.service_place')
            ->where('anc_coverages.hospcode', '=', Auth::user()->hospcode)
            ->get();

        $service = ServiceAnc::where('service_anc.person_id', '=', $person_id)
            ->select('service_anc.*', 'providers.fname', 'providers.lname', 'services.service_date')
            ->join('services', 'services.id', '=', 'service_anc.service_id')
            ->leftJoin('providers', 'providers.id', '=', 'service_anc.provider_id')
            ->where('service_anc.gravida', '=', $gravida)
            ->where('service_anc.hospcode', '=', Auth::user()->hospcode)
            ->get();

        $all_services = ServiceAnc::where('service_anc.person_id', '=', $person_id)
            ->select(
                'service_anc.*', 'providers.fname', 'providers.lname', 'services.service_date',
                'hospitals.hmain', 'hospitals.hname'
            )
            ->join('services', 'services.id', '=', 'service_anc.service_id')
            ->leftJoin('providers', 'providers.id', '=', 'service_anc.provider_id')
            ->leftJoin('hospitals', 'hospitals.hmain', '=', 'service_anc.hospcode')
            ->where('service_anc.gravida', '=', $gravida)
            ->get();

        return View::make('pages.pregnancies.anc')
            ->with('services', $service)
            ->with('coverages', $coverages)
            ->with('all_services', $all_services);
    }

	/***************************************************************************
	* FP
	***************************************************************************/
	public function postServiceFp()
	{
        $providers = Provider::getActive()->get();
		$fptypes = DB::table('fp_types')->get();
        $arr_provider = [];

        foreach ($providers as $p) $arr_provider[$p->id] = $p->fname . ' ' . $p->lname;

		$fp = ServiceFp::where('service_id', '=', Input::get('service_id'))
				->select(
					'service_fp.*', 'providers.lname', 'providers.fname',
					'fp_types.name as fp_type_name', 'fp_types.export_code'
				)
				->leftJoin('fp_types', 'fp_types.id', '=', 'service_fp.fp_type_id')
				->leftJoin('providers', 'providers.id', '=', 'service_fp.provider_id')
				->get();

		return View::make('pages.services.fp')
			->with('providers', $arr_provider)
			->with('fptypes', $fptypes)
			->with('fp', $fp);
	}

	/**
	 * Nutrition
	 */

	public function postServiceNutrition()
	{
        $service = Service::where('id', '=', Input::get('service_id'))->first();

        $person = Person::where('id', '=', $service->person_id)
            ->select('birthdate')
            ->first();

        $age = Helpers::countAgeService($person->birthdate, $service->service_date);

        if ($age->year > 18) {
            return View::make('errors.warning')
                ->with('message', 'อายุไม่ได้อยู่ในช่วงที่จะต้องทำการให้บริการตรวจภาวะโภชนาการ (อายุต้องอยู่ระหว่าง 1-18 ปี)');
        } else {
            $providers = Provider::getActive()->get();
            $arr_provider = [];

            foreach ($providers as $p)
                $arr_provider[$p->id] = $p->fname . ' ' . $p->lname;

            $screen = Screening::where('service_id', '=', Input::get('service_id'))
                ->first();

            $nutri = ServiceNutrition::where('service_id', '=', Input::get('service_id'))->first();
            $aws = DB::table('nutrition_age_weight_score')->get();
            $ahs = DB::table('nutrition_age_height_score')->get();
            $whs = DB::table('nutrition_weight_height_score')->get();
            $child = DB::table('nutrition_child_develop')->get();
            $food = DB::table('nutrition_food')->get();
            $bottle = DB::table('nutrition_bottle')->get();

            return View::make('pages.services.nutrition')
                ->with('providers', $arr_provider)
                ->with('screen', $screen)
                ->with('nutri', $nutri)
                ->with('aws', $aws)
                ->with('ahs', $ahs)
                ->with('whs', $whs)
                ->with('child', $child)
                ->with('food', $food)
                ->with('bottle', $bottle);
        }
	}

    public function postServiceVaccine()
    {

        $vaccines = ServiceVaccine::where('service_vaccines.service_id', '=', Input::get('service_id'))
            ->select(
                'service_vaccines.id', 'service_vaccines.vaccine_lot', 'service_vaccines.vaccine_expire_date',
                'providers.fname', 'providers.lname', 'vaccines.name', 'vaccines.th_name'
            )
            ->leftJoin('providers', 'providers.id', '=', 'service_vaccines.provider_id')
            ->leftJoin('vaccines', 'vaccines.id', '=', 'service_vaccines.vaccine_id')
            ->get();

        $vaccine_all = ServiceVaccine::select(
                'service_vaccines.id', 'service_vaccines.vaccine_lot', 'service_vaccines.vaccine_expire_date',
                'providers.fname', 'providers.lname', 'vaccines.name', 'vaccines.th_name',
                'hospitals.hmain', 'hospitals.hname'
            )
            ->leftJoin('providers', 'providers.id', '=', 'service_vaccines.provider_id')
            ->leftJoin('vaccines', 'vaccines.id', '=', 'service_vaccines.vaccine_id')
            ->leftJoin('hospitals', 'hospitals.hmain', '=', 'service_vaccines.hospcode')
            ->get();

        $service = Service::where('id', '=', Input::get('service_id'))->first();

        $person = Person::where('id', '=', $service->person_id)
            ->select('birthdate')
            ->first();

        $age = Helpers::countAgeService($person->birthdate, $service->service_date);

        $providers = Provider::getActive()->get();
        $arr_provider = [];

        foreach ($providers as $p)
            $arr_provider[$p->id] = $p->fname . ' ' . $p->lname;

        return View::make('pages.services.vaccine')
            ->with('providers', $arr_provider)
            ->with('age', $age)
            ->with('vaccines', $vaccines)
            ->with('vaccine_all', $vaccine_all);
    }

    /**
     * Postnatal
     */

    public function postServicePostnatal()
    {
        $isExist = Pregnancy::where('person_id', '=', Input::get('person_id'))
            ->where('hospcode', '=', Auth::user()->hospcode)
            ->count();

        if ($isExist) {

            $gravida = Pregnancy::getGA(Input::get('person_id'))->get(['gravida']);
            $gravidas = [];

            foreach ($gravida as $g) $gravidas[$g->gravida] = $g->gravida;

            $providers = Provider::getActive()->get();
            $arr_provider = [];

            foreach ($providers as $p)
                $arr_provider[$p->id] = $p->fname . ' ' . $p->lname;

            $postnatal = ServicePostnatal::where('service_id', '=', Input::get('service_id'))->first();

            $services = ServicePostnatal::where('service_postnatals.person_id', '=', Input::get('person_id'))
                ->select('service_postnatals.*', 'providers.fname', 'providers.lname', 'services.service_date')
                //->where('service_postnatals.gravida', '=', Input::get('gravida'))
                ->where('service_postnatals.hospcode', '=', Auth::user()->hospcode)
                ->leftJoin('providers', 'providers.id', '=', 'service_postnatals.provider_id')
                ->join('services', 'services.id', '=', 'service_postnatals.service_id')
                ->orderBy('services.service_date')
                ->get();

            return View::make('pages.services.postnatal')
                ->with('providers', $arr_provider)
                ->with('postnatal', $postnatal)
                ->with('gravidas', $gravidas)
                ->with('services', $services);

        } else {
            return View::make('pages.pregnancies.not-register');
        }
    }

    public function postPregnanciesPostnatal()
    {
        $postnatal = ServicePostnatal::where('service_postnatals.person_id', '=', Input::get('person_id'))
            ->select('service_postnatals.*', 'providers.fname', 'providers.lname', 'services.service_date')
            ->where('service_postnatals.gravida', '=', Input::get('gravida'))
            ->where('service_postnatals.hospcode', '=', Auth::user()->hospcode)
            ->leftJoin('providers', 'providers.id', '=', 'service_postnatals.provider_id')
            ->join('services', 'services.id', '=', 'service_postnatals.service_id')
            ->orderBy('services.service_date')
            ->get();

        $coverages = PostnatalCoverage::where('postnatal_coverages.person_id', '=', Input::get('person_id'))
            ->select('postnatal_coverages.*', 'hospitals.hname')
            ->where('postnatal_coverages.hospcode', '=', Auth::user()->hospcode)
            ->where('postnatal_coverages.gravida', '=', Input::get('gravida'))
            ->leftJoin('hospitals', 'hospitals.hmain', '=', 'postnatal_coverages.service_place')
            ->orderBy('postnatal_coverages.service_date')
            ->get();

        $postnatal_all = ServicePostnatal::where('service_postnatals.person_id', '=', Input::get('person_id'))
            ->select(
                'service_postnatals.*', 'providers.fname', 'providers.lname', 'services.service_date',
                'hospitals.hmain', 'hospitals.hname'
            )
            ->where('service_postnatals.gravida', '=', Input::get('gravida'))
            ->leftJoin('providers', 'providers.id', '=', 'service_postnatals.provider_id')
            ->leftJoin('hospitals', 'hospitals.hmain', '=', 'service_postnatals.hospcode')
            ->join('services', 'services.id', '=', 'service_postnatals.service_id')
            ->orderBy('services.service_date')
            ->get();

        return View::make('pages.pregnancies.postnatal')
            ->with('postnatals', $postnatal)
            ->with('coverages', $coverages)
            ->with('postnatal_all', $postnatal_all);
    }

    /***************************************************************************
     * Settings
     **************************************************************************/

     public function getSettingsVaccine()
     {
         $arr_vaccine = [];

         $vaccine_all = VaccineLots::join('vaccines', 'vaccine_lots.vaccine_id', '=', 'vaccines.id')
             ->select(
                 'vaccines.name', 'vaccines.th_name', 'vaccines.export_code', 'vaccine_lots.id',
                 'vaccine_lots.vaccine_id', 'vaccine_lots.lot', 'vaccine_lots.expire_date'
             )
             ->where('vaccine_lots.hospcode', '=', Auth::user()->hospcode)
             ->get();

		 $vaccines = DB::table('vaccines')->get();
         foreach($vaccines as $v) $arr_vaccine[$v->id] = '[' . $v->name . '] ' . $v->th_name;

         return View::make('pages.settings.vaccines')
             ->with('vaccines', $arr_vaccine)
             ->with('vaccine_all', $vaccine_all);
     }

}
