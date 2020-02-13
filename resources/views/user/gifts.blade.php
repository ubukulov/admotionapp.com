@extends('user.user')
@section('user')
    <h4>Мои призы</h4>
    <table class="table table-bordered">
        <thead>
        <th>ID</th>
        <th>Наименование</th>
        <th>Партнер</th>
        <th>Кол-во</th>
        <th>Дата</th>
        </thead>
        <tbody>
        @foreach($gifts as $gift)
            <tr>
                <td>{{ $gift->id }}</td>
                <td><img width="40" src="{{ $gift->gift->img() }}" alt="">&nbsp;&nbsp;{{ $gift->gift->title }}</td>
                <td>{{ $gift->gift->partner->title }}</td>
                <td>{{ $gift->qty }}</td>
                <td>{{ date("d.m.Y H:i", strtotime($gift->updated_at)) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop