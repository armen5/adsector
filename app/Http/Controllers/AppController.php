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

use FacebookAds\Api;
use FacebookAds\Object\AdSet;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdSetFields;
use FacebookAds\Object\Fields\AdAccountFields;
use FacebookAds\Object\Fields\CampaignFields;
use FacebookAds\Object\Campaign;
use LaravelFacebookAds\Clients\Facebook;
// use LaravelFacebookAds\Clients\Facebook;
// use LaravelFacebookAds\Services\FacebookAdsService;
use Edbizarro\LaravelFacebookAds\Facades\FacebookAds;

class AppController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	protected $facebookClient;

	public function __construct(Facebook $facebookClient) {
		$this->middleware('auth');
        $this->facebookClient = $facebookClient;
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

        $app_id = env('FB_ADS_APP_ID');
        $app_secret = env('FB_ADS_APP_SECRET');
        $access_token = "EAAIf2dIi7ikBABtt13RnREkR6Pzk4tOgc6GOEh6EiikySGep8GgNHFKrRwgOXvmWYdxTxjyZCMckmC0e6EXAlKRmQvMGEZBNyzOek8WMZBMZByZCVgZAWIYphiCLFLbY2ElB5QgUK46Re1gS6J9NjelgErVaZAE8UNZB6HBFCxI2pprJDqZAWMs65XTc4liLZC8vKDb1wWnacHfVQYZCOXwDnMUtBZCoOBfrTlUo62l21rxTsgZDZD";
        $account_id = env('ACT_ID');

        Api::init($app_id, $app_secret, $access_token);

        $client = $this->facebookClient;
        // dd($client->account($account_id)->ads());

        

        $account = new AdAccount($account_id);
        // dd($account->read());

        FacebookAds::init($access_token);
        $ads = FacebookAds::adAccounts()->all()->map(function ($adAccount) {
        return $adAccount->ads(
              [
                  'name',
                  'account_id',
                  'account_status',
                  'balance',
                  'campaign',
                  'campaign_id',
                  'status'
              ]
          );
        });
        // dd($ads);


		return view('dashboard');
        $account = new AdAccount($account_id);

        $fields = array(
            CampaignFields::ID,
            CampaignFields::NAME,
            CampaignFields::START_TIME,
            CampaignFields::STOP_TIME,
            CampaignFields::SPEND_CAP,
            'effective_status'
        );

        $params = array(
            'effective_status' => array(
                Campaign::STATUS_ACTIVE
            ),
        );

        $campaignSets = $account->getCampaigns($fields, $params);
        dd($campaignSets);
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
