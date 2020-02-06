@extends('layouts.app')
@section('content')
    @if($success)
        @php
            if (!empty($payment)) {
                $gift_title = (!empty($payment->gift)) ? $payment->gift->title : '';
                $gift_partner = (!empty($payment->partner)) ? $payment->partner->title : '';
            } else {
                $gift_title = '';
                $gift_partner = '';
            }
        @endphp

        <div class="col-md-12">
            <div class="text-center" style="width: 700px; margin: 0 auto; max-width: 100%;">
                <div class="text-center mb-4">
                    <i class="fas fa-check-circle" style="font-size: 60px; color: green;"></i>
                </div>
                <p>Поздравляем, {{ $payment->user->first_name }}, Ваша оплата на сумму {{ $payment->sum }}тг прошла успешно!</p>
                <p><strong>Вы выиграли приз</strong>: {{ $gift_title }} от <strong>{{ $gift_partner }}</strong>. </p>
                <p>Также Вам поступит sms с кодом, которое необходимо предъявить партнёру для получения подарка</p>


                <p><strong>Внимание!</strong>&nbsp;&nbsp; оплата не прошла, нажмите эту &nbsp;&nbsp;<a href="{{ route('payment_status', ['id' => $payment->id]) }}" class="btn btn-success">Проверить</a></p>


                <p>Sms код партнёр сравнивает с кодом в кабинете, нажимает кнопку "Вручил" и выдаёт приз</p>
            </div>
        </div>
    @endif
@stop