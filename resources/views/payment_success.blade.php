@extends('layouts.app')
@section('content')

    <div class="col-md-12">
        <div class="mb-3 text-center">
            <i class="fas fa-check-circle" style="font-size: 60px; color: green;"></i>
        </div>

        <div style="font-size: 20px; text-align: center;">
            Поздравляем, оплата прошла успешно!
        </div>
    </div>

    @if($success)
    <!-- Modal -->
    <div class="modal" id="thank_you" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Поздравляем, оплата прошла успешно!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>Вы выиграли приз: большая чашка капучино от Coffeedelia. </p>
                    <p>Также Вам поступит sms с кодом, которое необходимо предъявить партнёру для получения подарка</p>

                    <p>Sms код партнёр сравнивает с кодом в кабинете, нажимает кнопку "Вручил" и выдаёт приз</p>
                </div>

                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    @endif
@stop