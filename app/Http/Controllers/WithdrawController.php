<?php

namespace App\Http\Controllers;

use App\Mail\ForgotOtp;
use App\Models\User;
use App\Models\Withdraw;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use PayPal\Api\Currency;
use PayPal\Api\Payout;
use PayPal\Api\PayoutItem;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class WithdrawController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(config('paypal.client_id'), config('paypal.secret'))
        );
        $this->apiContext->setConfig(config('paypal.settings'));
    }

    public function get_form_withdraw()
    {
        return view('admin.withdraw.withdraw', []);
    }

    public function getCode(Request $request)
    {
        $model = new User();

        $user = $model->checkAndRetunUser($request->id);
        if ($user) {
            $result = $model->updateUser([
                'confirmation_code' => rand(100000, 999999),
                'confirmation_code_expired_in' => Carbon::now()->addSecond(180)
            ], $user->id);
            try {
                Mail::to($result->email)->send(new ForgotOtp($result));
                return response()->json([
                    'status' => 'success'
                ], 200);
            } catch (\Exception $err) {
                return response()->json([
                    'status' => 'error'
                ], 500);
            }
        }
    }

    public function withdraw(Request $request)
    {
        if (User::where('confirmation_code', $request->code)->first()) {
            $uri = 'https://api.sandbox.paypal.com/v1/oauth2/token';
            $client_id = config('paypal.client_id');
            $secret = config('paypal.secret');
            $client = new Client();
            $response = $client->request('POST', $uri, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Accept-Language' => 'en_US',
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'body' => 'grant_type=client_credentials',
                'auth' => [$client_id, $secret, 'basic']
            ]);

            $data = json_decode($response->getBody(), true);
            $access_token = $data['access_token'];

            $money = $request->money / 24.855;

            $type = 'USD';

            $arr = array('value' => $money, 'currency' => $type);
            $temp = json_encode($arr);
            $payouts = new Payout();

            $senderBatchHeader = new PayoutSenderBatchHeader();
            $senderBatchHeader->setSenderBatchId(uniqid())->setEmailSubject('Bạn có đơn rút tiền');
            $senderItem = new PayoutItem();
            $senderItem->setRecipientType('Email')
                ->setNote('Cảm ơn bạn đã thực hiện giao dịch ' . Carbon::now()->format('h:i d/m/Y'))
                ->setReceiver($request->email)
                ->setSenderItemId(rand(100, 999))
                ->setAmount(new Currency($temp));

            $payouts->setSenderBatchHeader($senderBatchHeader)->addItem($senderItem);

            $request2 = clone $payouts;

            try {
                DB::beginTransaction();
                $output = $payouts->create(['sync_mode' => 'false'], $this->apiContext);

                $result = json_decode($output);
                $request3 = $result->links[0]->href;
                $client2 = new Client();

                $response2 = $client2->request('GET', $request3, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $access_token,
                        'Content-Type' => 'application/json'
                    ]
                ]);

                $data2 = json_decode($response2->getBody(), true);

                $value['fee'] = $data2['batch_header']['fees']['value'];
                $value['money'] = $data2['batch_header']['amount']['value'];
                $withdraw = new Withdraw();
                $withdraw->user_id = Auth::id();
                $withdraw->address_balance = $request->email;
                $withdraw->fee = $value['fee'];
                $withdraw->money = $value['money'];
                $withdraw->save();

                $user = User::find(Auth::id());
                $user->confirmation_code = '';
                $user->money = $user->money - (($value['money'] + $value['fee']) * 24.855);
                $user->save();

                DB::commit();
                return redirect()->back()->with('success', 'Rút tiền thành công');
            } catch (\Exception $e) {

                DB::rollBack();
                return redirect()->back()->with('error', 'Có lỗi xảy ra vui lòng thử lại');
                exit(1);
            }
        }

        return redirect()->back()->with('error', 'Mã xác minh không chính xác');
    }

    public function list()
    {
        $withdraws = Withdraw::select('*')->where('user_id', Auth::id())->paginate(10);
        return view('admin.withdraw.list', [
            'withdraws' => $withdraws
        ]);
    }
}
