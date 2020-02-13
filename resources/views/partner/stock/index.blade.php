@extends('partner.partner')
@section('partner')
    <div class="row">
        <div class="col-md-6">
            <h4>Список акции</h4>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('partner.stock.create') }}"><i class="fa fa-edit"></i>&nbsp;Добавить</a>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <th>№</th>
        <th>Наименование</th>
        <th>Телефон</th>
        <th>Краткое описание</th>
        <th>Начало</th>
        <th>Конец</th>
        <th>Статус</th>
        <th>Дата</th>
        </thead>
        <tbody>
        @foreach($stocks as $stock)
            <tr>
                <td>{{ $stock->id }}</td>
                <td>
                    <span>{{ $stock->title }}</span>
                </td>
                <td>
                    {{ $stock->phone }}
                </td>
                <td>
                    {{ $stock->short_description }}
                </td>
                <td>
                    {{ date('d.m.Y', strtotime($stock->start)) }}
                </td>
                <td>
                    {{ date('d.m.Y', strtotime($stock->end)) }}
                </td>
                <td>
                    @if($stock->active == 0) Не активен @endif
                    @if($stock->active == 1) Активно @endif
                </td>
                <td>
                    {{ date("d.m.Y", strtotime($stock->created_at)) }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop