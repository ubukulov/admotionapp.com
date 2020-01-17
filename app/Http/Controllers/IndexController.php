<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\Partner;
use App\Models\Payment;
use App\Models\UserGift;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Paybox\Pay\Facade as Paybox;

class IndexController extends BaseController
{
    public function welcome()
    {
        return view('welcome', ['partners' => Partner::all()]);
    }

    public function logout()
    {
        Auth::logout();
        Auth::guard('partner')->logout();
        return redirect()->route('home');
    }

    public function partners()
    {
        return view('partners', ['partners' => Partner::all()]);
    }

    public function partner($id)
    {
        $partner = Partner::findOrFail($id);
        return view('partner', compact('partner'));
    }

    public function paybox(Request $request)
    {
        $amount = (int) $request->input('amount');
        $paybox = new Paybox();
        $paybox->merchant->id = env('PG_MERCHANT_ID');
        $paybox->merchant->secretKey = env('PG_SALT');
        $paybox->order->description = 'test order';
        $paybox->order->amount = $amount;

        if($paybox->init()) {
            header('Location:' . $paybox->redirectUrl);
            exit();
        }
    }

    public function payment_success()
    {

    }

    public function payment_status($id)
    {
        $paybox = new Paybox();
        //set required properties
        $paybox->getMerchant()
            ->setId(env('PG_MERCHANT_ID'))
            ->setSecretKey(env('PG_SALT'));

        $paybox->order->id = $id;
        $paymentStatus = $paybox->getStatus();
        if ($paymentStatus == 'ok') {
            $payment = Payment::findOrFail($id);
            if ($payment) {
                DB::beginTransaction();
                try {
                    $payment->status = 'ok';
                    $payment->save();

                    $sum = (int) $payment->sum;

                    $result = Gift::where(['partner_id' => $payment->partner_id])->get();
                    $gifts = $result->shuffle();
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
                                $gift->save();
                                $payment->gift_id = $gift->id;
                                $payment->save();
                                break;
                            }
                        }
                    }
                    DB::commit();
                    return redirect()->back();
                } catch (\Exception $e) {
                    DB::rollBack();
                    dd($e);
                }
            }
        }
    }
}
