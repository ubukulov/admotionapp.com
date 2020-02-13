@extends('partner.partner')
@section('partner')
    <a href="{{ route('create.gift') }}"><i class="fa fa-edit"></i>&nbsp;Добавить приз</a> <br><br>
    <table class="table table-bordered table-striped">
        <thead>
        <th>Номер</th>
        <th>Приз</th>
        <th>Описание</th>
        <th>Условия</th>
        <th>Кол-во</th>
        <th>SMS_CODE</th>
        <th>Статус</th>
        <th>Дата</th>
        </thead>
        <tbody>
        @foreach($partner->gifts as $gift)
            <tr>
                <td>{{ $gift->id }}</td>
                <td>
                    <img src="{{ $gift->img() }}" alt="" align="left">&nbsp;{{ $gift->title }}
                </td>
                <td>
                    {{ $gift->description }}
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