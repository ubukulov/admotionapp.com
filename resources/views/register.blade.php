@extends('layouts.app')
@section('content')
    <div class="col-md-4">
        <form action="{{ route('registration') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Как вы хотите зарегистрироваться?</label>
                <select name="user_type" class="form-control">
                    <option value="1">Пользователь</option>
                    <option value="2">Партнер</option>
                </select>
            </div>

            <div class="form-group">
                <input type="text" id="phone_number" name="phone" class="form-control" required placeholder="Ваш телефон">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Ваш пароль">
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" checked id="gridCheck">
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
    @push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script>
        $("#phone_number").mask("+7 999 999 9999");
    </script>
    @endpush
@stop