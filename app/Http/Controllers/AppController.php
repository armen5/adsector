<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\PaymentsHistory;
use Illuminate\Validation\Rule;

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
        $email = Auth::user()->email;
        $amount = 249;
        $data = PaymentsHistory::where('user_id' , Auth::id())->get();
		return view('dashboard.accountMemberView', compact('end_payment', 'first_name', 'last_name','email','amount','data'));
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



}
