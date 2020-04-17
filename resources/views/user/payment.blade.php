@extends('user.user')
@section('user')
    <h4>Оплатит онлайн</h4>
    <cloud-payment-form :partners="{{ json_encode($partners) }}"></cloud-payment-form>

    <hr>
    <h4>Мои оплаты</h4>
    <table class="table table-bordered" style="margin-top: 50px;">
        <thead>
        <th>ID</th>
        <th>Партнер</th>
        <th>Сумма</th>
        <th>Статус</th>
        <th>Действие</th>
        </thead>
        <tbody>
        @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->partner->title }}</td>
                <td>{{ $payment->sum }}</td>
                <td>{{ $payment->status }}</td>
                <td>
                    @if($payment->status != 'ok')
                        <a href="{{ route('payment_status', ['id' => $payment->id]) }}" class="btn btn-success">Проверить</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
