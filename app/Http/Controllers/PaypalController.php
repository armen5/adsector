<?php

namespace App\Http\Controllers;

use App\PaymentsHistory;
use Illuminate\Http\Request;
// create plan
// Used to process plans
// use PayPal\Api\ChargeModel;
// use PayPal\Api\Currency;
// use PayPal\Api\MerchantPreferences;
// use PayPal\Api\PaymentDefinition;
// use PayPal\Api\Plan;
// use PayPal\Api\Patch;
// use PayPal\Api\PatchRequest;
// use PayPal\Common\PayPalModel;
// use PayPal\Rest\ApiContext;
// use PayPal\Auth\OAuthTokenCredential;

use Illuminate\Support\Facades\Auth;
use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\Plan;
use PayPal\Auth\OAuthTokenCredential;
// use to process billing agreements
use PayPal\Rest\ApiContext;
use PayPal\Api\AgreementStateDescriptor;
use PHPUnit\TextUI\ResultPrinter;


class PaypalController extends Controller {
	private $apiContext;
	private $mode;
	private $client_id;
	private $secret;
	private $plan_id;

	// Create a new instance with our paypal credentials
	public function __construct() {
		// Detect if we are running in live mode or sandbox
		if (config('paypal.settings.mode') == 'live') {
			$this->client_id = config('paypal.live_client_id');
			$this->secret = config('paypal.live_secret');
			$this->plan_id = env('PAYPAL_LIVE_PLAN_ID', '');
		} else {
			$this->client_id = config('paypal.sandbox_client_id');
			$this->secret = config('paypal.sandbox_secret');
			$this->plan_id = env('PAYPAL_SANDBOX_PLAN_ID', '');
		}

		// Set the Paypal API Context/Credentials
		$this->apiContext = new ApiContext(new OAuthTokenCredential($this->client_id, $this->secret));
		$this->apiContext->setConfig(config('paypal.settings'));
	}

	public function paypalRedirect() {
		// Create new agreement
		$agreement = new Agreement();
		$agreement->setName('Adsector Monthly Subscription Agreement')
			->setDescription('Premium subscription')
			->setStartDate(\Carbon\Carbon::now()->addMinutes(5)->toIso8601String());

		// Set plan id
		$plan = new Plan();
		$plan->setId($this->plan_id);
		$agreement->setPlan($plan);

		// Add payer type
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');
		$agreement->setPayer($payer);

		try {
			// Create agreement
			$agreement = $agreement->create($this->apiContext);
			// Extract approval URL to redirect user
			$approvalUrl = $agreement->getApprovalLink();
			return redirect($approvalUrl);
		} catch (PayPal\Exception\PayPalConnectionException $ex) {
			echo $ex->getCode();
			echo $ex->getData();
			die($ex);
		} catch (Exception $ex) {
			die($ex);
		}

	}

	public function paypalReturn(Request $request) {

		$token = $request->token;
		$agreement = new \PayPal\Api\Agreement();
		$start_date = date('Y-m-d h:i:s');
		$time = strtotime($start_date);
		$end_date = date("Y-m-d h:i:s", strtotime("+1 month", $time));
		try {
			// Execute agreement
			$result = $agreement->execute($token, $this->apiContext);
			$user = Auth::user();
			$user->payment_verified = '1';
			$user->payment_start_date = $start_date;
			$user->payment_end_date = $end_date;
			if (isset($result->id)) {
				$user->paypal_agreement_id = $result->id;
			}
			$user->save();
			PaymentsHistory::create([
				"user_id" => Auth::id(),
				"payments_id" => $result->id,
				"description" => $result->description,
				"date" => $start_date,
				"payer_id" => $result->payer->payer_info->payer_id,
				"payment_method" => $result->payer->payment_method,
				"amount" => $result->plan->payment_definitions[0]->amount->value,
				"country_code" => $result->shipping_address->country_code,
				"postal_code" => $result->shipping_address->postal_code,
				"currency_code" => $result->plan->currency_code,

			]);
			return redirect('/dashboard');

		} catch (\PayPal\Exception\PayPalConnectionException $ex) {
			echo 'You have either cancelled the request or your session has expired';
		}
	}

	public function create_plan() {
		// Create a new billing plan
		$plan = new Plan();
		$plan
			->setName('Premium subscription')
			->setDescription('Monthly Subscription to the Adsector')
			->setType('infinite');

		// Set billing plan definitions
		$paymentDefinition = new PaymentDefinition();
		$paymentDefinition->setName('Regular Payments')
			->setType('REGULAR')
			->setFrequency('Month')
			->setFrequencyInterval('1')
			->setAmount(new Currency(array('value' => 249, 'currency' => 'USD')));

		// Set merchant preferences
		$merchantPreferences = new MerchantPreferences();
		$merchantPreferences->setReturnUrl('http://adsector.loc/subscribe/paypal/return')
			->setCancelUrl('http://adsector.loc/subscribe/paypal/return')
			->setAutoBillAmount('yes')
			->setInitialFailAmountAction('CONTINUE')
			->setMaxFailAttempts('0');

		$plan->setPaymentDefinitions(array($paymentDefinition));
		$plan->setMerchantPreferences($merchantPreferences);

		//create the plan
		try {
			$createdPlan = $plan->create($this->apiContext);

			try {
				$patch = new Patch();
				$value = new PayPalModel('{"state":"ACTIVE"}');
				$patch->setOp('replace')
					->setPath('/')
					->setValue($value);
				$patchRequest = new PatchRequest();
				$patchRequest->addPatch($patch);
				$createdPlan->update($patchRequest, $this->apiContext);
				$plan = Plan::get($createdPlan->getId(), $this->apiContext);

				// Output plan id
				echo 'Plan ID:' . $plan->getId();
			} catch (PayPal\Exception\PayPalConnectionException $ex) {
				echo $ex->getCode();
				echo $ex->getData();
				die($ex);
			} catch (Exception $ex) {
				die($ex);
			}
		} catch (PayPal\Exception\PayPalConnectionException $ex) {
			echo $ex->getCode();
			echo $ex->getData();
			die($ex);
		} catch (Exception $ex) {
			die($ex);
		}
	}
    public function paymentCancel(){
        // # Reactivate an agreement
        //
        // This sample code demonstrate how you can reactivate a billing agreement, as documented here at:
        // https://developer.paypal.com/docs/api/#suspend-an-agreement
        // API used: /v1/payments/billing-agreements/<Agreement-Id>/suspend
        // Retrieving the Agreement object from Suspend Agreement Sample to demonstrate the List
        /** @var Agreement $suspendedAgreement */
        $suspendedAgreement = new Agreement();
        $suspendedAgreement->setId(Auth::user()->paypal_agreement_id);
        //Create an Agreement State Descriptor, explaining the reason to suspend.
        $agreementStateDescriptor = new AgreementStateDescriptor();
        $agreementStateDescriptor->setNote("Reactivating the agreement");
        try {
            $suspendedAgreement->cancel($agreementStateDescriptor, $this->apiContext);
            // Lets get the updated Agreement Object
            $agreement = Agreement::get($suspendedAgreement->getId(), $this->apiContext);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            // \ResultPrinter::printResult("Reactivate the Agreement", "Agreement", $agreement->getId(), $suspendedAgreement, $ex);
            exit(1);
        }
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
       // printResult("Reactivate the Agreement", "Agreement", $agreement->getId(), $suspendedAgreement, $agreement);
        dd($agreement);
    }

}