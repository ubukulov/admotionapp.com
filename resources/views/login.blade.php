@extends('layouts.app')
@section('content')
    <div class="col-md-4">
        <form action="{{ route('authenticate') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Как вы хотите авторизоваться?</label>
                <select name="user_type" class="form-control">
                    <option value="1">Пользователь</option>
                    <option value="2">Партнер</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" id="phone_number" class="form-control" name="phone" required placeholder="Ваш телефон">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" required placeholder="Ваш пароль">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Войти</button>
            </div>
        </form>
    </div>
    @push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script>
        $("#phone_number").mask("+7 999 999 9999");
    </script>
    @endpush
@stop