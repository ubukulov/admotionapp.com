@extends('partner.partner')
@section('partner')
    <form action="{{ route('store.gift') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="stock_id" value="{{ $stock_id }}">
        <div class="form-group">
            <input type="text" name="title" class="form-control" required placeholder="Наименование приза">
        </div>

        <div class="form-group">
            <textarea name="description" class="form-control" cols="30" rows="4" required placeholder="Описание"></textarea>
        </div>

        <div class="form-group">
            <input type="file" name="file" class="form-control" required>
        </div>

        <div class="form-group">
            <input type="number" name="from" class="form-control" placeholder="От">
        </div>

        <div class="form-group">
            <input type="number" name="to" class="form-control" placeholder="До">
        </div>

        <div class="form-group">
            <input type="number" name="quantity" required class="form-control" placeholder="Количество призов">
        </div>
        
        <div class="form-group">
            <select name="active" class="form-control">
                <option value="1">Активно</option>
                <option value="0">Не активно</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </form>
@stop
