<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

// use LaravelFacebookAds\Clients\Facebook;
// use LaravelFacebookAds\Services\FacebookAdsService;
// use Edbizarro\LaravelFacebookAds\Facades\FacebookAds;

class AppController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	protected $facebookClient;

	public function __construct() {
		$this->middleware('auth');
		// $this->facebookClient = $facebookClient;
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		return view('dashboard');
	}
	public function accountMemberView() {
		$end_payment = date("Y-m-d", strtotime(Auth::user()->payment_end_date));
		$first_name = Auth::user()->first_name;
		$last_name = Auth::user()->last_name;
		return view('dashboard.accountMemberView', compact('end_payment', 'first_name', 'last_name'));
	}

}
