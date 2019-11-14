@extends('layouts.app')
@section('content')
    @foreach($partners as $partner)
        <div class="col-md-3">
            <div class="pt_bk">
                <a href="{{ route('partner.show', ['id' => $partner->id]) }}">
                    <div class="pt_im">
                        <img src="{{ $partner->img() }}" alt="">
                        <div class="discount_val">-70%</div>
                    </div>
                </a>
                <div class="pt_info">
                    <div class="pt_title">
                        <a href="{{ route('partner.show', ['id' => $partner->id]) }}">
                            <i class="fas fa-building"></i>&nbsp;{{ $partner->title }}
                        </a>
                    </div>
                    <div class="pt_address">
                        <i class="fas fa-map-marker-alt"></i>&nbsp;{{ $partner->address }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@stop