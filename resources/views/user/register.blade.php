@extends('layouts.app')
@section('content')
    <div class="col-md-6">
        <form action="{{ route('user.registration') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="name" required placeholder="Ваш ник">
            </div>

            <div class="form-group">
                <input type="email" class="form-control" name="email" required placeholder="Email">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Пароль">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Зарегистрироваться</button>
            </div>
        </form>
    </div>
@stop