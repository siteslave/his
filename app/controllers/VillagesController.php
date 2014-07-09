<?php
/**
 * User Controller
 *
 * @author 		Satit Rianpit <rianpit@gmail.com>
 * @copyright 	2014 - 2014 by Satit Rianpit
 * @since  		1.0.0
 */

class VillagesController extends BaseController {

  protected $layout = 'layouts.default';

  /**
   * Constructor function
   *
   */
  public function __construct()
  {
    $this->beforeFilter('csrf', array('on' => 'post'));
    //$this->beforeFilter('auth', array('only' => array()));
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function getIndex()
  {
    $villages = Village::where('hospcode', Session::get('hospcode'))
                ->get();

    $this->layout->content = View::make('sheets.villages', array(
      'villages' => $villages
    ));
  }

  public function getHome()
  {
    if(!Auth::check())
    {
      $json = array('ok' => 0, 'msg' => 'Please login.');
    }
    else
    {
      $village_id = Input::get('village_id');
      $callback = Input::get('callback');

      $home = DB::table('home')
              ->join('ref_home_house_type', 'ref_home_house_type.id', '=', 'home.house_type_id')
              ->select('ref_home_house_type.name', 'home.address', 'home.house_code', 'home.id')
              ->where('home.village_id', $village_id)
              ->orderBy('home.address', 'asc')
              ->get();

      $json = array(
        'ok' => 1,
        'rows' => $home
      );
    }

    return Response::json($json)->setCallback($callback);

    //return $callback . '(' . json_encode($json) . ')';
  }

  public function getPerson()
  {
    if (Auth::check())
    {
      $home_id = Input::get('home_id');
      $callback = Input::get('callback');

      $person = DB::table('person')
                ->where('person.home_id', $home_id)
                ->select(
                    'person.id', 'person.fname', 'person.lname', 'person.sex',
                    'person.birthdate', 'person.cid',
                    'ref_person_title.name as title_name'
                )
                ->leftJoin('ref_person_title', 'ref_person_title.id', '=', 'person.title_id')
                ->orderBy('person.fname', 'asc')
                ->orderBy('person.lname', 'asc')
                ->get();

      $json = array('ok' => 1, 'rows' => $person);
    }
    else
    {
      $json = array('ok' => 0, 'msg' => 'Please login.');
    }

    return Response::json($json)->setCallback($callback);
  }

}
