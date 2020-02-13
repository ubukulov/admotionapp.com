@extends('partner.partner')
@section('partner')
    <h4>Профиль</h4>
    <form action="{{ route('partner.update.profile', ['id' => $partner->id]) }}" method="post">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Наименование организации" name="title" value="{{ $partner->title }}">
        </div>

        <div class="form-group">
            <input type="text" class="form-control" disabled value="{{ $partner->phone }}">
        </div>

        <div class="form-group">
            <input type="text" class="form-control" placeholder="Адрес" name="address" value="{{ $partner->address }}">
        </div>

        <div class="form-group">
            <input type="email" class="form-control" placeholder="Ваш Email" name="email" value="{{ $partner->email }}">
        </div>

        <div class="form-group">
            <textarea name="description" cols="30" rows="5" placeholder="Описание" class="form-control">{{ $partner->description }}</textarea>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" placeholder="Скидка" name="discount" value="{{ $partner->discount }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Обновить профиль</button>
        </div>
    </form>
@stop