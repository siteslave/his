<?php
/**
 * User Controller
 *
 * @author  Satit Rianpit <rianpit@gmail.com>
 * @copyright   2014 - 2014 by Satit Rianpit
 * @since  1.0.0
 */

class PersonController extends BaseController {

    protected $layout = 'layouts.default';

    /**
     * Constructor function
     *
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        //$this->beforeFilter('auth', array('only' => array('showEdit')));
        $this->beforeFilter(function() {
            if (!Auth::check()) {
                if (Request::ajax) {
                    return Response::json(['ok' => 0, 'error' => 'Please login']);
                } else {
                    return View::make('errors.denied');
                }
            }
        });
    }

    public function showEdit($pid)
    {
        //$person = DB::table('person')->where('id', $pid)->first();
        $person = Person::find($pid)->first();

        if ($person)
        {
            $titles = DB::table('ref_person_title')
                //->where('is_active', 'Y')
                ->get();

            $mstatus     = DB::table('ref_person_mstatus')->get();
            $occupations = DB::table('ref_person_occupation')
                //->where('is_active', 'Y')
                ->get();
            $educations         = DB::table('ref_person_education')->get();
            $nations            = DB::table('ref_person_nation')->get();
            $races              = DB::table('ref_person_race')->get();
            $religions          = DB::table('ref_person_religion')->get();
            $fstatus            = DB::table('ref_person_fstatus')->get();
            $vstatus            = DB::table('ref_person_vstatus')->get();
            $discharge_status   = DB::table('ref_person_discharge_status')->get();
            $rhgroup            = DB::table('ref_person_rhgroup')->get();
            $abogroup           = DB::table('ref_person_abogroup')->get();
            $labors             = DB::table('ref_person_labor')->get();
            $typeareas          = DB::table('ref_person_typearea')->get();
            $insurances         = DB::table('ref_insurance')->get();

            //get insurance
            $insurances_detail  = Utils::getCurrentInsurance($pid);

            $this->layout->content = View::make('person.edit', array(
                'person'            => $person,
                'titles'            => $titles,
                'mstatus'           => $mstatus,
                'occupations'       => $occupations,
                'educations'        => $educations,
                'nations'           => $nations,
                'races'             => $races,
                'religions'         => $religions,
                'fstatus'           => $fstatus,
                'vstatus'           => $vstatus,
                'discharge_status'  => $discharge_status,
                'abogroup'          => $abogroup,
                'rhgroup'           => $rhgroup,
                'labors'            => $labors,
                'typeareas'         => $typeareas,
                'insurances'        => $insurances,
                'insurances_detail' => $insurances_detail
            ));
        }
        else
        {
            App::abort(404);
        }

    }

    private function _searchByFirstName($firstname)
    {
        $result = DB::table('person as p')
            ->select('p.fname', 'p.lname', 'p.id', 'p.cid', 'p.birthdate', 'p.sex', 't.typearea', 'p.home_id')
            ->join('person_typearea as t', 't.cid', '=', 'p.cid')
            ->where('p.fname', 'like', $firstname . '%')
            ->where('t.hospcode', Auth::user()->hospcode)
            ->take(20)
            ->get();

        return $result;
    }

    private function _searchByLastName($lastname)
    {
        $result = DB::table('person as p')
            ->select('p.fname', 'p.lname', 'p.id', 'p.cid', 'p.birthdate', 'p.sex', 't.typearea', 'p.home_id')
            ->join('person_typearea as t', 't.cid', '=', 'p.cid')
            ->where('t.hospcode', Auth::user()->hospcode)
            ->where('lname', 'like', $lastname . '%')
            ->take(20)
            ->get();

        return $result;
    }

    private function _searchByFirstNameAndLastName($firstname, $lastname)
    {
        $result = DB::table('person as p')
            ->select('p.fname', 'p.lname', 'p.id', 'p.cid', 'p.birthdate', 'p.sex', 't.typearea', 'p.home_id')
            ->join('person_typearea as t', 't.cid', '=', 'p.cid')
            ->where('t.hospcode', Auth::user()->hospcode)
            ->where('fname', 'like', $firstname . '%')
            ->where('lname', 'like', $lastname . '%')
            ->take(20)
            ->get();

        return $result;
    }

    private function _searchByCID($cid)
    {
        $result = DB::table('person as p')
            ->select('p.fname', 'p.lname', 'p.id', 'p.cid', 'p.birthdate', 'p.sex', 't.typearea', 'p.home_id')
            ->join('person_typearea as t', 't.cid', '=', 'p.cid')
            ->where('t.hospcode', Auth::user()->hospcode)
            ->where('p.cid', $cid)
            ->take(20)
            ->get();

        return $result;
    }

    public function getSearch()
    {
        $query = Input::get('query');
        $callback = Input::get('callback');

        if (empty($query)) {
            $json = ['ok' => 0, 'error' => 'No query for search, please assign word for search.'];
        } else {
            /**
             * Search by CID
             */
            if (is_numeric($query))
            {
                $result = $this->_searchByCID($query);
            }
            else
            {
                #$query = explode(" ", $query);
                $query = preg_split('/[\s,]+/', $query);

                if (count($query) > 1)
                {
                    //search by lastname
                    if (empty($query[0]))
                    {
                        $result = $this->_searchByLastName($query[1]);
                    }
                    else
                    {
                        $fname = $query[0]; //first name
                        $lname = $query[1]; //last name

                        //search by lastname
                        if (strlen($fname) == 0)
                        {
                            $result = $this->_searchByLastName($lname);
                        }
                        //search by firstname
                        else if (strlen($lname) == 0)
                        {
                            $result = $this->_searchByFirstName($fname);
                        }
                        //search by firstname and lastname
                        else
                        {
                            $result = $this->_searchByFirstNameAndLastName($fname, $lname);
                        }

                    }
                }
                //search by firstname
                else
                {
                    $result = $this->_searchByFirstName($query[0]);
                }
            }

            $rows = [];

            foreach ($result as $r)
            {
                $obj = new stdClass();
                $obj->cid = $r->cid;
                $obj->fullname = $r->fname . ' ' . $r->lname;
                $obj->birthdate = $r->birthdate;
                $obj->sex = $r->sex;
                $obj->person_id = $r->id;
                $obj->address = Utils::getShortAddress($r->home_id);
                $obj->typearea = $r->typearea;
                $obj->home_id = $r->home_id;

                $rows[] = $obj;
            }

            $json = ['ok' => 1, 'rows' => $rows];
        }

        return Response::json($json)->setCallback($callback);
    }

    /**
     * Upload picture
     */

    public function doUploadPicture()
    {
        $data = Input::all();

        if(Auth::check())
        {
            $validate = Validator::make(
                $data,
                array('image' => array('required', 'mimes:jpeg,bmp,png'))
            );

            if ($validate->passes())
            {
                $destination = public_path() . '/uploads';

                $file = Input::file('image');
                $file_extension = $file->getClientOriginalExtension();
                $new_file       = Input::get('cid') . $file_extension;
                $uploaded       = $file->move($destination, $new_file);

                if ($uploaded)
                {
                    $json = array('ok' => 1);
                }
                else
                {
                    $json = array('ok' => 0, 'msg' => 'ไม่สามารถอัปโหลดไฟล์ได้');
                }
            }
            else
            {
                $messages = $validate->messages();
                $json = array('ok' => 0, 'msg' => $messages->first('image'));
            }

        }
        else
        {
            $json = array('ok' => 0, 'msg' => 'Please login.');
        }

        return Response::json($json)->setCallback(Input::get('callback'));
    }
    
}
