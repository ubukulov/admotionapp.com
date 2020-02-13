@extends('user.user')
@section('user')
    <h4>Оплатит онлайн</h4>
    <form action="{{ route('user.payment') }}" method="post">
        @csrf
        <div class="form-group">
            <input type="number" min="1" name="sum" class="form-control" placeholder="Введите сумму" required>
        </div>

        <div class="form-group">
            <label>Выберите партнера</label>
            <select name="partner_id" class="form-control">
                @foreach($partners as $partner)
                    <option value="{{ $partner->id }}">{{ $partner->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Оплатить сейчас</button>
        </div>
    </form>
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