<?php


namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Omnipay\Omnipay;
use PHPUnit\Exception;
use Nette\Utils\Random;
use App\Models\Recharge;
use Faker\Provider\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PayPalPaymentController extends Controller

{
    private $gateway;

    public function __construct()
    {
        $gateway1 = Omnipay::create('PayPal_Express');


        $gateway1->setUsername('sb-vpcms21975520_api1.business.example.com');
        $gateway1->setPassword('YSJASYLTR44CMXST');
        $gateway1->setSignature('AIsNObN1SyNNjqJjWf1oEu4qD6WYAAFzyPYHt.2lRLj4X8fj6L4UgBhX');
        $gateway1->setTestMode(true);

        $this->gateway = $gateway1;
    }

    public function pay(Request $request)
    {
        try {
            $payment = Recharge::insertGetId([
                'value' => $request->input('amount'),
                'user_id' => '0',
                'date' => Carbon::now(),
                'recharge_code' => 'abc',
                'payment_type' => 0,
                'status' => 0,
                'note' => 'abc',
            ]);
            $response = $this->gateway->purchase(array(
                'amount' => $request->input('amount'),
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => route('success.payment', ['id' => $payment]),
                'cancelUrl' => route('cancel.payment')
            ))->send();
            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $error) {
            return $error->getMessage();
        }
    }

    public function success(Request $request, $id)
    {
        $payment = Recharge::find($id);
        if ($request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'amount' => Recharge::find($id)->value
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                $arr = $response->getData();
                $time = Carbon::now();

                $payment->user_id = Auth::id();
                $payment->date = $time;
                $payment->recharge_code = $request->input('PayerID') . '-' . Random::generate(5);
                $payment->payment_type = 1;
                $payment->status = 1;
                $payment->fee = $arr['PAYMENTINFO_0_FEEAMT'];
                $payment->note = 'Nap tien ' . $time->format('H:i d/m/Y');
                $payment->save();

                $money = 24.855 * ($payment->value - $arr['PAYMENTINFO_0_FEEAMT']);

                $user = User::find(Auth::id());

                $user->money += $money;

                $user->save();

                if (Auth::user()->role_id !== 3) {
                    return redirect()->route('backend_get_form_recharge')->with('recharge_success', 'Nạp tiền thành công');
                } else {
                    return redirect()->route('getRecharge')->with('recharge_success', 'Nạp tiền thành công');
                }
            } else {
                if (Auth::user()->role_id !== 3) {
                    return redirect()->route('backend_get_form_recharge')->with('recharge_error', 'Nạp tiền thất bại');
                } else {
                    return redirect()->route('getRecharge')->with('recharge_error', 'Nạp tiền thất bại');
                }
            }
        } else {
            if (Auth::user()->role_id !== 3) {
                return redirect()->route('backend_get_form_recharge')->with('recharge_error', 'Nạp tiền thất bại');
            } else {
                return redirect()->route('getRecharge')->with('recharge_error', 'Nạp tiền thất bại');
            }
        }
    }

    public function error()
    {
        return redirect()->route('backend_get_form_recharge')->with('recharge_error', 'Nạp tiền thất bại');
    }
}
