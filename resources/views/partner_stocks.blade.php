@extends('layouts.app')
@section('content')
    <div class="col-md-2">
        <div class="pt_bk">
            <div class="pt_im">
                <img src="{{ $partner->img() }}" alt="">
                {{--@if(!empty($partner->discount))--}}
                {{--<div class="discount_val">{{ $partner->discount }}</div>--}}
                {{--@endif--}}
            </div>
            <div class="pt_info">
                <div class="pt_title">
                    <i class="fas fa-building"></i>&nbsp;{{ $partner->title }}
                </div>
                <div class="pt_phone">
                    <i class="fas fa-mobile-alt"></i>&nbsp;{{ $partner->phone }}
                </div>
                @if(Auth::check())
                    <div class="pr_pay" style="margin-top: 50px; border: 1px dashed #ccc; padding: 10px;">
                        <h4>Форма оплаты</h4>
                        <form action="{{ route('paybox.pay') }}" method="post">
                            @csrf
                            <input type="hidden" name="partner_id" value="{{ $partner->id }}">
                            <div class="form-group">
                                <input type="number" required min="1" class="form-control" name="amount" placeholder="Введите сумму">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Оплатить</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-10">

        <div class="pt_content">
            <div class="pt_desc">
                {{ $partner->description }}
            </div>
        </div>
    </div>

    <hr>

    <div class="col-md-12 mt-5">
        <div class="row">
            @foreach($partner->stocks as $stock)
                <div class="col-md-2">
                    <div class="pt_bk">
                        <a href="{{ route('stock.show', ['id' => $stock->id]) }}">
                            <div class="pt_im">
                                <img src="{{ $stock->img() }}" alt="">
                                @if(!empty($stock->discount))
                                    <div class="discount_val">{{ $stock->discount }}</div>
                                @endif
                            </div>
                        </a>
                        <div class="pt_info">
                            <div class="pt_title">
                                <a href="{{ route('stock.show', ['id' => $stock->id]) }}">
                                    {{ $stock->title }}
                                </a>
                            </div>
                            <div class="pt_address">
                                <a href="{{ route('stock.show', ['id' => $stock->id]) }}" class="btn btn-dark">подробное</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop
