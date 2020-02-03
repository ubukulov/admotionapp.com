@extends('layouts.app')
@section('content')
    <div class="col-md-3">
        <div class="pt_bk">
            <div class="pt_im">
                <img src="{{ $partner->img() }}" alt="">
                @if(!empty($partner->discount))
                <div class="discount_val">{{ $partner->discount }}</div>
                @endif
            </div>
            <div class="pt_info">
                <div class="pt_title">
                    <i class="fas fa-building"></i>&nbsp;{{ $partner->title }}
                </div>
                <div class="pt_address">
                    <i class="fas fa-map-marker-alt"></i>&nbsp;{{ $partner->address }}
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
    <div class="col-md-9">
        <div class="pt_content">
            <div class="pt_desc">
                {{ $partner->description }}
            </div>

            <div class="info">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Список призов</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <th>Номер</th>
                            <th>Приз</th>
                            <th>Описание</th>
                            <th>Условия</th>
                            <th>Кол-во</th>
                            <th>Статус</th>
                            <th>Дата</th>
                            </thead>
                            <tbody>
                            @foreach($partner->gifts as $gift)
                                <tr>
                                    <td>{{ $gift->id }}</td>
                                    <td>
                                        <img src="{{ $gift->img() }}" alt="" align="left">&nbsp;{{ $gift->title }}
                                    </td>
                                    <td>
                                        {{ $gift->description }}
                                    </td>
                                    <td>
                                        {{ $gift->condition() }}
                                    </td>
                                    <td>
                                        {{ $gift->quantity }} &nbsp;шт.
                                    </td>
                                    <td>
                                        @if($gift->active == 1) Активно @endif
                                        @if($gift->active == 0) Не активно @endif
                                    </td>
                                    <td>
                                        {{ date("d.m.Y H:i", strtotime($gift->created_at)) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
