<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
    <title>Admotionapp.com</title>
</head>
<body>
    <div id="app">
        <div class="container-fluid">
            @include('pattern.header')

            <div class="content">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>

        <div class="footer">
            <!-- Modal -->
            {{--<div class="modal fade" id="quick_pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('paybox.pay') }}" method="post">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Форма быстрой оплаты</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="partner_id" placeholder="ID партнера" required>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="amount" required placeholder="Сумма">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" @if(Auth::check()) value="{{ Auth::user()->phone }}" @endif class="form-control" name="phone" required placeholder="Ваш номер телефона">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer text-center">
                                <button type="submit" id="pay" class="btn btn-success">Оплатить сейчас</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>--}}
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>--}}
    {{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>--}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://widget.cloudpayments.ru/bundles/cloudpayments"></script>
    <script>
        this.pay = function () {
            var widget = new cp.CloudPayments();
            widget.charge({ // options
                    publicId: 'pk_21387d1b5966c5fae5df1f7a58bf8',  //id из личного кабинета
                    description: 'Пример оплаты (деньги сниматься не будут)', //назначение
                    amount: 10, //сумма
                    currency: 'KZT', //валюта
                    invoiceId: '1234567', //номер заказа  (необязательно)
                    accountId: 'user@example.com', //идентификатор плательщика (необязательно)
                    skin: "mini", //дизайн виджета
                    data: {
                        myProp: 'myProp value' //произвольный набор параметров
                    }
                },
                function (options) { // success
                    //действие при успешной оплате
                },
                function (reason, options) { // fail
                    //действие при неуспешной оплате
                });
        };
        // $('#pay').click(pay);
    </script>
    @stack('scripts')
</body>
</html>
