@extends('layouts.app')
@section('content')
    <div class="container emp-profile">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
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
            </div>
            <div class="col-md-8">
                <div class="profile-head">
                    <h5>
                        {{ Auth::user()->first_name }}
                    </h5>
                    <h6>
                        {{ Auth::user()->address }}
                    </h6>
                    <p class="proile-rating">RANKINGS : <span>8/10</span></p>

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Профиль</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Мои призы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Оплата</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work" style="display: none;">
                    <p>WORK LINK</p>
                    <a href="">Website Link</a><br/>
                    <a href="">Bootsnipp Profile</a><br/>
                    <a href="">Bootply Profile</a>
                    <p>SKILLS</p>
                    <a href="">Web Designer</a><br/>
                    <a href="">Web Developer</a><br/>
                    <a href="">WordPress</a><br/>
                    <a href="">WooCommerce</a><br/>
                    <a href="">PHP, .Net</a><br/>
                </div>
            </div>
            <div class="col-md-8">
                @yield('user')
            </div>
        </div>
    </div>
@stop