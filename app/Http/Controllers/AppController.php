<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use LaravelFacebookAds\Clients\Facebook;
use LaravelFacebookAds\Services\FacebookAdsService;


class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $facebookClient;

    public function __construct(Facebook $facebookClient)
    {
        $this->middleware('auth');
        $this->facebookClient = $facebookClient;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = $this->facebookClient;

        $accountId = 'act_383633855778169';

        // $ads = $client->instance();
        $ads = $client->account($accountId)->ads();
        dd($ads);

        return view('dashboard');
    }
}
