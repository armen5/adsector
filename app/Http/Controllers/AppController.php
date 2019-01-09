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
use FacebookAds\Object\Ad;
use FacebookAds\Object\AdSet;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdFields;
use FacebookAds\Object\Fields\AdSetFields;
use FacebookAds\Object\Fields\AdAccountFields;
use FacebookAds\Object\Fields\CampaignFields;

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
      $fb = new Facebook([
        'app_id' => $appId,
        'app_secret' => $appSecret,
        'default_graph_version' => 'v2.10'
      ]);//init facebook 
      
      $init = Api::init($appId,$appSecret,$access_token);//bussines facebook init
      $init->setDefaultGraphVersion("3.2.");
      // echo "<pre>"; var_dump($fb); die;
try {
  // Returns a `FacebookFacebookResponse` object
  $response = $fb->get(
    "/$user_id/adaccounts",
    $access_token
  );
} catch(FacebookExceptionsFacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(FacebookExceptionsFacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$graphNode = $response->getGraphEdge();
dd($graphNode);

        $ad = new Ad($ACT_ID);
        $ad->read(array(
          AdFields::NAME,
          AdFields::ID
          
        ));

        // Output Ad name.
        dd($ad);
      $user = new AdUser('me');
      $user->read(array(AdUserFields::ID));

      $accounts = $user->getAdAccounts(array(
        AdAccountFields::ID,
        AdAccountFields::NAME,
      ));

      // Print out the accounts
      echo "Accounts:\n";
      foreach($accounts as $account) {
        echo $account->id . ' - ' .$account->name."\n";
      }

      // Grab the first account for next steps (you should probably choose one)
      $account = (count($accounts)) ? $accounts->getObjects()[0] : null;
      echo "\nUsing this account: ";
      echo $account->id."\n";






        $account = new AdAccount('act_299062770747180');
        $ads = $account->getAds(array(
          AdFields::NAME,
          AdFields::FILENAME
        ));

        dd($ads);die;
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
