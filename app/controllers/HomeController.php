<?php

/**
 * Class HomeController
 *
 * @author      Satit Rianpit <rianpit@gmail.com>
 * @copyright   2013-2015 by Maha Sarakahm Hospital <http://www.mkh.go.th>
 * @since       1.0
 */
class HomeController extends BaseController {

	/**
  * Default layout
  */
	protected $layout = 'layouts.default';

	/**
	 * Constructor function
	 *
	 */
	public function __construct()
	{
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	public function showWelcome()
	{
    	$this->layout->content = View::make('home');
	}

	public function getDetail()
	{
		return View::make('hello.world');
	}


}
