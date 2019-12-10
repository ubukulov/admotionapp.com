@extends('partner.partner')
@section('partner')
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <form action="{{ route('partner.update.profile', ['id' => $partner->id]) }}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="{{ $partner->title }}">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="phone" value="{{ $partner->phone }}">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="address" value="{{ $partner->address }}">
                </div>

                <div class="form-group">
                    <input type="email" class="form-control" name="email" disabled value="{{ $partner->email }}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Обновить профиль</button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <a href="{{ route('create.gift') }}"><i class="fa fa-edit"></i>&nbsp;Добавить приз</a> <br><br>
            <table class="table table-bordered table-striped">
                <thead>
                <th>Номер</th>
                <th>Приз</th>
                <th>Описание</th>
                <th>Условия</th>
                <th>Кол-во</th>
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
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
    </div>
@stop