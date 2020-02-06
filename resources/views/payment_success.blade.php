@extends('layouts.app')
@section('content')
    @if($success)
        @php
            if (!empty($payment)) {
                $gift_title = (!empty($payment->gift)) ? $payment->gift->title : '';
                $gift_partner = (!empty($payment->partner)) ? $payment->partner->title : '';
            } else {
                $gift_title = '';
                $gift_partner = '';
            }
        @endphp
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
                    <div class="text-center mb-4">
                        <i class="fas fa-check-circle" style="font-size: 60px; color: green;"></i>
                    </div>
                    <p>Поздравляем, {{ $payment->user->first_name }}, Ваша оплата на сумму {{ $payment->sum }}тг прошла успешно!</p>
                    <p><strong>Вы выиграли приз</strong>: {{ $gift_title }} от <strong>{{ $gift_partner }}</strong>. </p>
                    <p>Также Вам поступит sms с кодом, которое необходимо предъявить партнёру для получения подарка</p>


                    <p><strong>Внимание!</strong></p>
                    <p>Если оплата не прошла, нажмите эту <a href="{{ route('payment_status', ['id' => $payment->id]) }}" class="btn btn-success">Проверить</a></p>


                    <p>Sms код партнёр сравнивает с кодом в кабинете, нажимает кнопку "Вручил" и выдаёт приз</p>
                </div>

                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

        @push('scripts')
            <script>
                setTimeout(function(){
                    $("#thank_you").modal();
                }, 2000);
        </script>
        @endpush
    @endif
@stop