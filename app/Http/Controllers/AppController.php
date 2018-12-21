<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use LaravelFacebookAds\Clients\Facebook;
// use LaravelFacebookAds\Services\FacebookAdsService;
use Edbizarro\LaravelFacebookAds\Facades\FacebookAds;

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
        $client = $this->facebookClient;
        $token = '514487839054408|ePSZsNBYsGNkpMEHwLuj95vwEwk';
        $accountId = 'act_383633855778169';
        // FacebookAds::init($token);
        // $ads = FacebookAds::adAccounts()->all()->map(function ($adAccount) {
        // return $adAccount->ads(
        //       [
        //           'name',
        //           'account_id',
        //           'account_status',
        //           'balance',
        //           'campaign',
        //           'campaign_id',
        //           'status'
        //       ]
        //   );
        // });

        // dd($ads);

        // $ads = $client->instance();
        // $ads = $client->account($accountId)->ads();
        // dd($ads);

        return view('dashboard');
    }
}
