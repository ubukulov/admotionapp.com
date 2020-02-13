@extends('layouts.app')
@section('content')
    <div class="col-md-2">
        <div class="profile-img mb-3">
            @if(empty(Auth::user()->image))
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
            @else
                <img src="{{ asset('uploads/partners/'.Auth::user()->image) }}" alt="partner logo">
            @endif
            <form action="{{ route('partner.change.image') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="file btn btn-lg btn-primary">
                    Изменить фото
                    <input onchange="form.submit()" type="file" name="file" class="form-control"/>
                </div>
            </form>
        </div>

        <div class="profile-head">
            <h5>
                {{ Auth::user()->first_name }}
            </h5>
            <h6>
                {{ Auth::user()->address }}
            </h6>
            <p class="proile-rating">RANKINGS : <span>8/10</span></p>


        </div>

        <div class="profile-work" style="padding: 0px;">
            <p>МЕНЮ</p>
            <a href="{{ route('user.cabinet') }}">Профиль</a><br/>
            <a href="{{ route('user.gifts') }}">Мои призы</a><br/>
            <a href="{{ route('user.payment_form') }}">Оплата</a>
            {{--<p>SKILLS</p>--}}
            {{--<a href="">Web Designer</a><br/>--}}
            {{--<a href="">Web Developer</a><br/>--}}
            {{--<a href="">WordPress</a><br/>--}}
            {{--<a href="">WooCommerce</a><br/>--}}
            {{--<a href="">PHP, .Net</a><br/>--}}
        </div>
    </div>
    <div class="col-md-10">
        @yield('user')
    </div>
@stop