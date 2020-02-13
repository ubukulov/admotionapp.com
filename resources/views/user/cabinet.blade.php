@extends('user.user')
@section('user')
    <h4>Профиль</h4>
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
            <input type="text" class="form-control" value="{{ $user->phone }}" disabled>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" value="{{ $user->address }}" name="address" placeholder="Ваш адрес">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;Сохранить</button>
        </div>
    </form>
@stop
