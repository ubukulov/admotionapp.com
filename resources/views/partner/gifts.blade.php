@extends('partner.partner')
@section('partner')
    <h4>Акция - {{ $stock->title }}</h4>

    <hr>

    <a href="{{ route('create.gift', ['id' => $stock->id]) }}"><i class="fa fa-edit"></i>&nbsp;Добавить приз</a> <br><br>
    <table class="table table-bordered table-striped">
        <thead>
        <th>Приз</th>
        <th>Условия</th>
        <th>Кол-во</th>
        <th>SMS_CODE</th>
        <th>Статус</th>
        <th>Дата</th>
        </thead>
        <tbody>
        @foreach($stock->gifts as $gift)
            <tr>
                <td>
                    <div>
                        <img style="margin-right: 10px;" src="{{ $gift->img() }}" alt="">&nbsp;
                    </div>

                    <div>
                        # {{ $gift->id }}
                        {{ $gift->title }}
                    </div>
                </td>
                <td>
                    {{ $gift->condition() }}
                </td>
                <td>
                    {{ $gift->quantity }} &nbsp;шт.
                </td>
                <td>{{ $gift->sms_code }}</td>
                <td>
                    @if($gift->active == 1) Активно @endif
                    @if($gift->active == 0) Не активно @endif
                </td>
                <td>
                    {{ date("d.m.Y H:i", strtotime($gift->created_at)) }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
