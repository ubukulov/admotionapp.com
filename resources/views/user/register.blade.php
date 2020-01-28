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
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        *подтверждая регистрацию, Вы автоматически соглашаетесь с <a href="/files/Оферта_сайта_admotionapp.com.docx" target="_blank">публичной офертой</a>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Зарегистрироваться</button>
            </div>
        </form>
    </div>
@stop