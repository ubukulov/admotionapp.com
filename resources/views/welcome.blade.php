@extends('layouts.app')
@section('content')
    @foreach($stocks as $stock)
        <div class="col-md-3">
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
@stop