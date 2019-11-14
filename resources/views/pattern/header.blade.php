<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Главная <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Категории
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Еда</a>
                        <a class="dropdown-item" href="#">Развлечение</a>
                        <a class="dropdown-item" href="#">Красота</a>
                        <a class="dropdown-item" href="#">Спорт</a>
                        <a class="dropdown-item" href="#">Здоровье</a>
                        <a class="dropdown-item" href="#">Услуги</a>
                        <a class="dropdown-item" href="#">Продукты</a>
                        <a class="dropdown-item" href="#">Для авто</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('partners') }}">Партнеры</a>
                </li>
                <li class="nav-item">
                    @if(Auth::check())
                        <a class="nav-link" href="{{ route('user.cabinet') }}">Кабинет</a>
                    @endif

                    @if(Auth::guard('partner')->check())
                        <a class="nav-link" href="{{ route('partner.cabinet') }}">Кабинет</a>
                    @endif
                </li>

                <li class="nav-item">
                    @if(!Auth::check() && !Auth::guard('partner')->check())
                        <a class="nav-link" href="{{ route('user.login') }}">Войти</a>
                    @else
                        <a class="nav-link" href="{{ route('logout') }}">Выход</a>
                    @endif
                </li>
                @if(!Auth::check() && !Auth::guard('partner')->check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.register') }}">Зарегистрироваться</a>
                </li>
                @endif
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</header>