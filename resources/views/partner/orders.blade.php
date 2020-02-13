@extends('partner.partner')
@section('partner')
    <h4>Список заказов</h4>
    <table class="table table-bordered table-striped">
        <thead>
        <th>№</th>
        <th>Клиент</th>
        <th>Телефон</th>
        <th>Приз</th>
        <th>Сумма</th>
        <th>Статус</th>
        <th>Дата</th>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>
                    <span>{{ $order->first_name }}</span> <br>
                    <span>{{ $order->email }}</span>
                </td>
                <td>
                    {{ $order->phone }}
                </td>
                <td>
                    {{ $order->gift_title }}
                </td>
                <td>
                    {{ $order->sum }}
                </td>
                <td>
                    @if($order->status == 'processing') Впроцессе @endif
                    @if($order->status == 'ok') Успешно @endif
                </td>
                <td>
                    {{ date("d.m.Y H:i", strtotime($order->updated_at)) }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop