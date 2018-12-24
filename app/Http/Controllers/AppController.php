<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use LaravelFacebookAds\Clients\Facebook;
// use LaravelFacebookAds\Services\FacebookAdsService;
// use Edbizarro\LaravelFacebookAds\Facades\FacebookAds;

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $facebookClient;

    public function __construct()
    {
        $this->middleware('auth');
        // $this->facebookClient = $facebookClient;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('dashboard');
    }


}
