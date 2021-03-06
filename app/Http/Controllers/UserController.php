<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\PaymentResource;
use Auth;

class UserController extends BaseController
{
    public function cabinet()
    {
        return view('user.cabinet', ['user' => Auth::user()]);
    }

    public function profile(Request $request)
    {
        Auth::user()->update($request->all());
        return redirect()->route('user.cabinet');
    }

    public function gifts()
    {
        $gifts = Auth::user()->gifts;
        return view('user.gifts', compact('gifts'));
    }

    public function payment_form()
    {
        $payments = Auth::user()->payments;
        return view('user.payment', compact('payments'));
    }

    public function payment(Request $request)
    {
        $sum = (int) $request->input('amount');
        $partner_id = $request->input('partner_id');
        $payment = Payment::create([
            'user_id' => Auth::user()->id,
            'partner_id' => $partner_id,
            'sum' => $sum
        ]);

        if ($payment) {
            PaymentResource::withoutWrapping();
            return new PaymentResource($payment);
            /*$pg_merchant_id = 511867;
            $pg_salt = 'y7crxXTrz6SXKPNd';

            $request = [
                'pg_merchant_id'=> $pg_merchant_id,
                'pg_amount' => $sum,
                'pg_salt' => $pg_salt,
                'pg_order_id' => $lastInsertId,
                'pg_description' => 'Описание заказа',
                'pg_success_url' => 'https://admotionapp.com/payment',
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
            exit();*/
        } else {
            dd("Ошибка сервера");
        }
    }
}
