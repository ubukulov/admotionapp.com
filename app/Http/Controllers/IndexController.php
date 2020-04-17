<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\Partner;
use App\Models\Payment;
use App\Models\Stock;
use App\Models\UserGift;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Paybox\Pay\Facade as Paybox;
use Illuminate\Support\Str;

class IndexController extends BaseController
{
    public function welcome()
    {
        $stocks = Stock::all();
        return view('welcome', compact('stocks'));
    }

    public function partners()
    {
        return view('partners', ['partners' => Partner::all()]);
    }

    public function partner($id)
    {
        $partner = Partner::findOrFail($id);
        return view('partner_stocks', compact('partner'));
    }

    public function paybox(Request $request)
    {
        dd($request->all());
        $amount = (int) $request->input('amount');
        $partner_id = (int) $request->input('partner_id');
        $user_id = Auth::user()->id;


        /*$payment = Payment::create([
            'user_id' => $user_id,
            'partner_id' => $partner_id,
            'sum' => $amount
        ]);

        if ($payment) {
            $lastInsertId = $payment->id;

            $pg_merchant_id = 511867;
            $pg_salt = 'y7crxXTrz6SXKPNd';

            $request = [
                'pg_merchant_id'=> $pg_merchant_id,
                'pg_amount' => $amount,
                'pg_salt' => $pg_salt,
                'pg_order_id' => $lastInsertId,
                'pg_description' => 'Описание заказа',
                'pg_success_url' => 'https://admotionapp.com/payment?pg_order_id='.$lastInsertId,
                'pg_failure_url' => 'https://admotionapp.com/payment/error',
            ];

//        $request['pg_testing_mode'] = 1; //add this parameter to request for testing payments

            //if you pass any of your parameters, which you want to get back after the payment, then add them. For example:
            $request['client_name'] = (empty(Auth::user()->first_name)) ? 'Admotion' : Auth::user()->first_name;
            $request['partner_id'] = $partner_id;
            $request['client_address'] = (empty(Auth::user()->address)) ? 'Earth Planet' : Auth::user()->address;

            //generate a signature and add it to the array
            ksort($request); //sort alphabetically
            array_unshift($request, 'payment.php');
            array_push($request, $pg_salt); //add your secret key (you can take it in your personal cabinet on paybox system)


            $request['pg_sig'] = md5(implode(';', $request));

            unset($request[0], $request[1]);

            $query = http_build_query($request);
            //redirect a customer to payment page
            header('Location: https://api.paybox.money/payment.php?'.$query);
            exit();
        } else {
            dd("Ошибка сервера");
        }*/
    }

    public function payment_success()
    {
        $success = false;
        $payment = null;
        if (isset($_GET['pg_order_id']) && $_GET['pg_order_id']) {
            $last_payment_id = $_GET['pg_order_id'];
            $payment = Payment::findOrFail($last_payment_id);
            if ($status = $this->getPayoxStatus($last_payment_id)) {
                if ($status == 'ok') {
                    $this->payment_status($last_payment_id);
                    $success = true;
                }
            }
        }
        return view('payment_success', compact('success', 'payment'));
    }

    public function getPayoxStatus($id)
    {
        $paybox = new Paybox();
        //set required properties
        $paybox->getMerchant()
            ->setId(env('PG_MERCHANT_ID'))
            ->setSecretKey(env('PG_SALT'));

        $paybox->order->id = $id;
        return $paybox->getStatus();
    }

    public function payment_status($id)
    {
        $paymentStatus = $this->getPayoxStatus($id);

        if ($paymentStatus == 'ok') {
            $payment = Payment::findOrFail($id);
            if ($payment && $payment->status != 'ok') {
                DB::beginTransaction();
                try {
                    $payment->status = 'ok';
                    $payment->save();

                    $sum = (int) $payment->sum;

                    $result = Gift::where(['partner_id' => $payment->partner_id])->get();
                    $gifts = $result->shuffle();
                    // сгенерируем случайный код
                    $sms_code = Str::random(6);
                    foreach ($gifts->all() as $gift) {
                        $from = (int) $gift->from;
                        $to = (int) $gift->to;
                        $quantity = (int) $gift->quantity;

                        if (empty($from) && !empty($to)) {
                            if ($sum <= $to && $quantity > 0) {
                                UserGift::create([
                                    'gift_id' => $gift->id, 'user_id' => $payment->user_id, 'qty' => 1
                                ]);
                                $gift->quantity--;
                                $gift->sms_code = $sms_code;
                                $gift->save();
                                $payment->gift_id = $gift->id;
                                $payment->save();
                                break;
                            }
                        }
                        if (!empty($from) && empty($to)) {
                            if ($sum >= $from && $quantity > 0) {
                                UserGift::create([
                                    'gift_id' => $gift->id, 'user_id' => $payment->user_id, 'qty' => 1
                                ]);
                                $gift->quantity--;
                                $gift->sms_code = $sms_code;
                                $gift->save();
                                $payment->gift_id = $gift->id;
                                $payment->save();
                                break;
                            }
                        }
                        if (!empty($from) && !empty($to)) {
                            if ($sum >= $from && $sum <= $to && $quantity > 0) {
                                UserGift::create([
                                    'gift_id' => $gift->id, 'user_id' => $payment->user_id, 'qty' => 1
                                ]);
                                $gift->quantity--;
                                $gift->sms_code = $sms_code;
                                $gift->save();
                                $payment->gift_id = $gift->id;
                                $payment->save();
                                break;
                            }
                        }
                    }

                    $client = new \SoapClient('https://smsc.kz/sys/soap.php?wsdl');
                    $msg = "Платеж успешно прошло. Ваш код: $sms_code";
                    $client->send_sms(array('login' => 'Admotion', 'psw' => '!Q2w3e$R', 'phones'=> $payment->user->phone, 'mes' => $msg, 'sender' => 'admotionapp'));

                    DB::commit();
                    return redirect()->back();
                } catch (\Exception $e) {
                    DB::rollBack();
                    dd($e);
                }
            }
        }
    }

    public function send_me_test_sms($phone)
    {
        $sms_code = Str::random(6);
        $client = new \SoapClient('https://smsc.kz/sys/soap.php?wsdl');
        $msg = "Платеж успешно прошло. Ваш код: $sms_code";
        $res = $client->send_sms(array('login' => 'Admotion', 'psw' => '!Q2w3e$R', 'phones'=> $phone, 'mes' => $msg, 'sender' => 'admotionapp'));
        var_dump($res);
    }

    public function stock_show($id)
    {
        $stock = Stock::findOrFail($id);
        return view('stock', compact('stock'));
    }
}
