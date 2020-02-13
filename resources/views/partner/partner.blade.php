@extends('layouts.app')
@section('content')
    <div class="col-md-2">
        <div class="profile-img">
            @if(empty(Auth::guard('partner')->user()->image))
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
            @else
                <img src="{{ asset('uploads/partners/'.Auth::guard('partner')->user()->image) }}" alt="partner logo">
            @endif
            <form action="{{ route('partner.change.image') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="file btn btn-sm btn-primary">
                    Изменить
                    <input onchange="form.submit()" type="file" name="file" class="form-control"/>
                </div>
            </form>

            <div class="text-left mt-4">
                <h5>
                    {{ Auth::guard('partner')->user()->title }}
                </h5>
                <h6>
                    {{ Auth::guard('partner')->user()->address }}
                </h6>
                <p class="proile-rating">RANKINGS : <span>8/10</span></p>
            </div>
        </div>



        <hr>

        <div class="profile-work" style="padding: 0px !important;">
            <p>МЕНЮ</p>
            <a href="{{ route('partner.cabinet') }}">Профиль</a><br/>
            <a href="{{ route('partner.stocks') }}">Список акции</a><br/>
            <p>ЗАКАЗЫ</p>
            <a href="{{ route('partner.orders') }}">Список заказов</a><br/>
            {{--<a href="">Web Developer</a><br/>--}}
            {{--<a href="">WordPress</a><br/>--}}
            {{--<a href="">WooCommerce</a><br/>--}}
            <a href="{{ route('logout') }}">Выход</a><br/>
        </div>
    </div>
    <div class="col-md-10">
        @yield('partner')
    </div>
@stop