<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Omnipay\Omnipay;
use App\Models\Payment;
use Stripe\Card;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class PaymentController extends Controller
{
    // subscriptions methods
    function __construct()
    {
        $this->middleware('auth');
    }

    public function payment()
    {
        $avialiblePlans = [
            'price_1Hy0pzJ0sVnCIXiw40hTOpks' => "Chimie - month",
            'price_1Hy0pzJ0sVnCIXiw3o8uDdr3' => "Chimie - week",
        ];

        $data = [
            'intent' => auth()->user()->createSetupIntent(),
            'plans' => $avialiblePlans
        ];

        return view('payment')->with($data);
    }

    public function subscribe(Request $request)
    {
        $user = auth()->user();
        $paymentMethod = $request->payment_method;

        $planId = $request->plan;
        $user->newSubscription('main', $planId)->add();

        return response(['status' => 'success']);
    }


    public function index()
    {
        return view('payment');
    }


    // one pay methods

    public function charge(Request $request)
    {
        /** @var TYPE_NAME $user */
        $user = Auth::user()->id;
        //dd($request->cost, $user, $request->message_id);

        if ($request->input('stripeToken')) {

            $gateway = Omnipay::create('Stripe');
            $gateway->setApiKey(env('STRIPE_SECRET'));

            $token = $request->input('stripeToken');

            $response = $gateway->purchase([
                'amount' => $request->cost,
                'currency' => env('STRIPE_CURRENCY'),
                'token' => $token,
            ])->send();

            if ($response->isSuccessful()) {
                // payment was successful: insert transaction data into the database
                $arr_payment_data = $response->getData();

                $isPaymentExist = Payment::where('payment_id', $arr_payment_data['id'])->first();

                if(!$isPaymentExist)
                {
                    $payment = new Payment;
                    $payment->payment_id = $arr_payment_data['id'];
                    $payment->user_id = $user;
                    $payment->message_id = $request->message_id;
                    $payment->amount = $request->cost;
                    $payment->currency = env('STRIPE_CURRENCY');
                    $payment->payment_status = $arr_payment_data['status'];
                    $payment->save();
                }

                // test with ID --->>>  return "Payment is successful. Your payment id is: ". $arr_payment_data['id'];
                return view ('messages.successful')->withMessage('Your payment id is:' . $arr_payment_data['id']);

            } else {
                // payment failed: display message to customer
                return $response->getMessage();
            }
        }

    }


    //save data for future payments
    public function save(Request $request)
    {
        $user = User::find($request->user_id);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        if(isset($request->stripeToken)) {
            $token = $request->stripeToken;

            $customer = Customer::create(array(
                "source" => $token,
                "description" => $user->name. " " .$user->surname
            ));

            $user->stripe_id = $customer->id;

            $user->update();
            //dd("Customer is saved");
            return back()->with('message', 'Les données de paiement sont enregistrées');
        }

/*        if(isset($request->stripeToken)) {
            $token = $request->stripeToken;
            //dd("TOKEN IS ".$token);
            //  Create the charge on Stripe's servers - this will charge the user's card
            try {
                $charge = Charge::create(array(
                    "amount" => 100, // amount in cents, again
                    "currency" => env('STRIPE_CURRENCY'),
                    "source" => $token,
                    "description" => "Initial charge"
                ));

                $customer = Customer::create(array(
                    "source" => $token,
                    "description" => "Initial customer"
                ));

                $user->stripe_id = $customer->id;

                $user->update();

                dd("Card & Customer is saved");
            } catch(Card $e) {
                // The card has been declined
            }
        }*/
    }



    //pay 100
    public function testpay(Request $request)
    {

        $user = User::find($request->user_id);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        Charge::create(array(
             "amount" => 45000, // amount in cents, again
             "currency" => env('STRIPE_CURRENCY'),
             "customer" => $user->stripe_id
          ));

        dd('YOU pay 450');

    }

}
