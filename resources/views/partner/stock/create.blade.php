@extends('partner.partner')
@section('partner')
    <h4>Добавление акции</h4>
    <hr>
    <create-stock :cats="{{ json_encode($cats) }}"></create-stock>
@stop