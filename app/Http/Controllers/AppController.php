<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use PDF;
use App\PaymentsHistory;
use Illuminate\Validation\Rule;
/*
use FacebookAds\Api;
use FacebookAds\Object\AdSet;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdSetFields;
use FacebookAds\Object\Fields\AdAccountFields;
use FacebookAds\Object\Fields\CampaignFields;
use FacebookAds\Object\Campaign;
use LaravelFacebookAds\Clients\Facebook;*/
// use LaravelFacebookAds\Clients\Facebook;
// use LaravelFacebookAds\Services\FacebookAdsService;
// use Edbizarro\LaravelFacebookAds\Facades\FacebookAds;


use Facebook\Facebook;

class AppController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	protected $facebookClient;

	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
    dd(env('ACT_ID'));
      $appId = '232405977635045';
      $appSecret = '499ef46003c22a8da41437f90cb1df40';
      $person_id = '101270874301166';
      $userAccessToken = 'EAADTXzu9mOUBAH8ZB0xyJQncMnWbjgoYmsNlI6QyKqppZCOncCc34oq49luCSuQQ37Q4NMIg1A3cl9Pn36kPoVe8yOcgnOcNXyomQOku7SktgznPvOARNjyl0k5Vqkf2sgY40MJmqHrTybA7uVu6ZCdYGFhgRcZD';
      $access_token = 'EAADTXzu9mOUBAEar9vtBTF5uzj5cJ2CjbqAlPzW35I5uyX4AHocpBJMqx23Ns0S9E86mYW05e3DEfosFhH4wZBFqko0E1BY3qDdWscVe5WyeNkTtd3ZA97f16w25acWKmz5mXmJybHmixoQLXrBhzA2grXdjJrJwtVatohqBkRJtX4j3bfiB596xD9hzNbap5OtPIBga4tmjWH9rv9dhzA8QU4vHxGTmB0vSiqegZDZD';
      $ACT_ID = '314812122614814';

      $fb = new Facebook([
        'app_id' => $appId,
        'app_secret' => $appSecret,
        'default_graph_version' => 'v2.10',
        'default_access_token' => $access_token, // optional
      ]);
      try {
          // Returns a `Facebook\FacebookResponse` object
          $response = $fb->get('/PROFitdev/feed',$access_token);
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }
        $graphNode = $response->getGraphNode();
        dd($graphNode);

      // Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
        $helper = $fb->getPageTabHelper();
        dd($helper);
        // $helper = $fb->getJavaScriptHelper();
        // $helper = $fb->getCanvasHelper();
        // $helper = $fb->getPageTabHelper();

      try {
        // Get the \Facebook\GraphNodes\GraphUser object for the current user.
        // If you provided a 'default_access_token', the '{access-token}' is optional.
        // $response = $fb->get("/$person_id/", $access_token);
        $accessToken = $helper->getAccessToken();
      } catch(\Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(\Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }

      // $me = $response->getGraphUser();
      dd($accessToken);
      exit();
		  return view('dashboard');

	}

	public function accountMemberView() {
		$end_payment = date("Y-m-d", strtotime(Auth::user()->payment_end_date));
        $user = Auth::user();
        $PaymentsHistory = PaymentsHistory::where('user_id' , Auth::id())->get();
        $amount = (int)$PaymentsHistory[0]->amount;
		return view('dashboard.accountMemberView', compact('end_payment', 'amount','PaymentsHistory','user'));
	}

    public function changeProfile(Request $request,User $user){
        $validator = Validator::make($request->input('input'), [
            'first_name' => 'required|alpha|min:3|max:255',
            'last_name' => 'required|alpha|min:3|max:255',
            'email' => ['required','email',
                    Rule::unique('users')->ignore(Auth::id())
                ],
            'current_password' => 'sometimes|required|min:6|current_password',
            'password' => 'sometimes|required|min:6|confirmed',
            'password_confirmation' => 'sometimes|required|min:6'
        ]);

        if($validator->fails()){
             $errors = $validator->errors();
            return response()->json($errors);
        }else{
            $data = $request->input('input');
            $user->where('id', Auth::id())
                 ->update([
                        'first_name' => $data['first_name'],
                        'last_name' => $data['last_name'],
                        'email' => $data['email'],
                    ]);
            if(isset($request->input('input')['password'])){
                $user->where('id',Auth::id())->update(['password' => Hash::make($data['password'])]);
            }
            return response()->json('success');
        }
    }

    public function createPDF($payer_id){
      $user = Auth::user();
      $payment = PaymentsHistory::where(['user_id' => Auth::id(),'payer_id'=>$payer_id])->get()[0];
      // return view("dashboard.pdf",compact('payment','user'));
      $pdf = PDF::loadView('dashboard.pdf', compact('payment','user'));
      return $pdf->download("$payer_id.pdf");
    }



}
