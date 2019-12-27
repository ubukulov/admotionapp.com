@extends('user.user')
@section('user')
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <form action="{{ route('user.profile') }}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" value="{{ $user->first_name }}" name="first_name" placeholder="Ваше имя">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" value="{{ $user->last_name }}" name="last_name" placeholder="Ваше фамилия">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" value="{{ $user->patronymic }}" name="patronymic" placeholder="Ваше отчество">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" value="{{ $user->phone }}" name="phone" placeholder="Ваш телефон">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" value="{{ $user->address }}" name="address" placeholder="Ваш адрес">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;Сохранить</button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <table class="table table-bordered">
                <thead>
                <th>ID</th>
                <th>Наименование</th>
                <th>Партнер</th>
                <th>Кол-во</th>
                </thead>
                <tbody>
                @foreach($user->gifts as $gift)
                <tr>
                    <td>{{ $gift->id }}</td>
                    <td><img width="40" src="{{ $gift->gift->img() }}" alt="">&nbsp;&nbsp;{{ $gift->gift->title }}</td>
                    <td>{{ $gift->gift->partner->title }}</td>
                    <td>{{ $gift->qty }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            <h4>Оплатит онлайн</h4>
            <form action="{{ route('user.payment') }}" method="post">
                @csrf
                <div class="form-group">
                    <input type="number" min="1" name="sum" class="form-control" required>
                </div>

                <div class="form-group">
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

            <br>
            <hr>
            <table class="table table-bordered" style="margin-top: 50px;">
                <thead>
                    <th>ID</th>
                    <th>Партнер</th>
                    <th>Сумма</th>
                    <th>Статус</th>
                    <th>Действие</th>
                </thead>
                <tbody>
                @foreach($user->payments as $payment)
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
        </div>
    </div>
@stop
