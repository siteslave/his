<?php
/**
 * User Controller
 *
 * @author 		Satit Rianpit <rianpit@gmail.com>
 * @copyright 	2014 - 2014 by Satit Rianpit
 * @since  		1.0.0
 */

class UserController extends BaseController {

	protected $layout = 'layouts.login';

	/**
	 * Constructor function
	 *
	 */
	public function __construct()
	{
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Redirect::to('login');
	}

	/**
	 * Login page
	 *
	 * @return  Response
	 */
	public function login()
	{
        if (Auth::check()) {
            return Redirect::to('/');
        } else {
            $this->layout->content = View::make('users.login');
        }
	}

  /**
   * Check user login
   *
   * @internal param string $email Email
   * @internal param string $password Password
   * @return Response
   */
	public function checkLogin()
	{
    $email = Input::get('email');
    $password = Input::get('password');

    $data = array(
      'email' => $email,
      'password' => $password);

    if (Auth::attempt($data))
    {
        // $user = User::where('email', $email)->first();
        //
        // Session::put('email', $email);
        // Session::put('hospcode', $user->hospcode);
        // Session::put('provider_id', $user->provider_id);
        // Session::put('user_id', $user->id);

      return Redirect::intended('/');
    }
    else
    {
    	return Redirect::to('login');
    }
	}

	/**
	 * Logout
	 *
	 * @return  Response
	 */
	public function logout()
	{
    // Session::forget('email');
    // Session::forget('hospcode');
    //
		Auth::logout();
    // Redirect to login page.
		return Redirect::to('login');
	}
}
