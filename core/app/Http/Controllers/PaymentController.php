<?php

namespace App\Http\Controllers;

use App\Models\Deposits;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Gateway;
use App\Models\Settings;
use App\Models\Currency;
use Session;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;

class PaymentController extends Controller
{

    public function depositConfirm(Request $request)
    {
        $user=User::find(Auth::user()->id);
        $gnl = Settings::first();
        $track = Session::get('Track');
        $data = Deposits::where('trx', $track)->orderBy('id', 'DESC')->first();
        $currency=Currency::whereStatus(1)->first();
        if (is_null($data)) {
            return redirect()->route('user.fund')->with('alert', 'Invalid Deposit Request');
        }
        if ($data->status != 0) {
            return redirect()->route('user.fund')->with('alert', 'Invalid Deposit Request');
        }
        $gatewayData = Gateway::where('id', $data->gateway_id)->first();
        if ($data->gateway_id == 101) {
            $title = $gatewayData->name;
            $paypal['amount'] = $data->amount;
            $paypal['sendto'] = $gatewayData->val1;
            $paypal['track'] = $track;
            return view('user.payment.paypal', compact('paypal', 'gnl', 'currency', 'title'));
        } elseif ($data->gateway_id == 102) {
            $title = $gatewayData->name;
            $perfect['amount'] = $data->amount;
            $perfect['value1'] = $gatewayData->val1;
            $perfect['value2'] = $gatewayData->val2;
            $perfect['track'] = $track;
            return view('user.payment.perfect', compact('perfect', 'gnl', 'currency', 'title'));
        } elseif ($data->gateway_id == 103) {
            $stripe['value1'] = $gatewayData->val1;
            $stripe['value2'] = $gatewayData->val2;
            $title = $gatewayData->name;
            return view('user.payment.stripe', compact('track', 'title', 'stripe'));
        } elseif ($data->gateway_id == 104) {
            $title = $gatewayData->name;
            return view('user.payment.skrill', compact('title', 'gnl', 'currency', 'gatewayData', 'data'));
        } elseif ($data->gateway_id == 106) {
            $vogue['amount'] = $data->amount;
            $vogue['value1'] = $gatewayData->val1;
            $vogue['value2'] = $gatewayData->val2;
            $vogue['track'] = $track;
            $title = $gatewayData->name;
            return view('user.payment.vogue', compact('vogue', 'title', 'gnl', 'currency', 'gatewayData', 'data'));
        } elseif ($data->gateway_id == 107) {
            $paystack['amount'] = $data->amount;
            $paystack['value1'] = $gatewayData->val1;
            $paystack['value2'] = $gatewayData->val2;
            $check['track'] = $track;
            $title = $gatewayData->name;
            return view('user.payment.paystack', compact('paystack', 'track', 'title', 'gnl', 'currency', 'gatewayData', 'data'));
        } elseif ($data->gateway_id == 108) {
            $flutter['amount'] = $data->amount;
            $flutter['value1'] = $gatewayData->val1;
            $flutter['value2'] = $gatewayData->val2;
            $flutter['track'] = $track;
            $title = $gatewayData->name;
            return view('user.payment.flutter', compact('flutter', 'title', 'gnl', 'currency', 'gatewayData', 'data'));
        } 

    }


    //IPN Functions //////

    public function ipnstripe(Request $request)
    {
        $track = Session::get('Track');
        $data = Deposits::where('trx', $track)->orderBy('id', 'DESC')->first();
        $gate = Gateway::where('id', 103)->first();
        $depo['user_id'] = Auth::id();
        $depo['gateway_id'] = $gate->id;
        $depo['amount'] = $request->amount + $charge;
        $depo['charge'] = $charge;
        $depo['trx'] = str_random(16);
        $depo['secret'] = str_random(8);
        $depo['status'] = 0;
        Deposits::create($depo);
        $currency=Currency::whereStatus(1)->first();
        $this->validate($request,
            [
                'cardNumber' => 'required',
                'cardM' => 'required',
                'cardY' => 'required',
                'cardCVC' => 'required',
            ]);

        $cc = $request->cardNumber;
        $m = $request->cardM;
        $y = $request->cardY;
        $cvc = $request->cardCVC;
        $cnts = $data->amount;

        $gatewayData = Gateway::find(103);
        $gnl = Settings::first();

        Stripe::setApiKey($gatewayData->val2);

        try {
            $token = Token::create(array(
                "card" => array(
                    "number" => "$cc",
                    "exp_month" => $m,
                    "exp_year" => $y,
                    "cvc" => "$cvc"
                )
            ));

            try {
                $charge = Charge::create(array(
                    'card' => $token['id'],
                    'currency' => $currency->name,
                    'amount' => $cnts*100,
                    'description' => 'Account funding',
                ));

                if ($charge['status'] == 'succeeded') {
                    //Update User Data
                    return redirect()->route('deposit.verify', ['id' => $data->secret]);
                }
            } catch (\Stripe\Exception\CardException $e) {
                return back()->with('alert', $e->getMessage());
            }

        } catch (\Stripe\Exception\CardException $e) {
            return back()->with('alert', $e->getMessage());
        }

    }


    public function ipnCoinPayBtc(Request $request)
    {
        $track = $request->custom;
        $status = $request->status;
        $amount2 = floatval($request->amount2);
        $currency2 = $request->currency2;

        $data = Deposits::where('trx', $track)->orderBy('id', 'DESC')->first();
        $bcoin = $data->btc_amo;
        if ($status >= 100 || $status == 2) {
            if ($currency2 == "BTC" && $data->status == '0' && $data->btc_amo <= $amount2) {
                return redirect()->route('deposit.verify', ['id' => $data->secret]);
            }
        }
    }

}
