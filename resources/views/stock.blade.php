@extends('layouts.app')
@section('content')
    <div class="col-md-2">
        <div class="pt_bk">
            <div class="pt_im">
                <img src="{{ $stock->img() }}" alt="">
                {{--@if(!empty($partner->discount))--}}
                {{--<div class="discount_val">{{ $partner->discount }}</div>--}}
                {{--@endif--}}
            </div>
            <div class="pt_info">
                <div class="pt_title">
                    <i class="fas fa-building"></i>&nbsp;{{ $stock->title }}
                </div>
                <div class="pt_phone">
                    <i class="fas fa-mobile-alt"></i>&nbsp;{{ $stock->phone }}
                </div>
                @if(Auth::check())
                <div class="pr_pay" style="margin-top: 50px; border: 1px dashed #ccc; padding: 10px;">
                    <h4>Форма оплаты</h4>
                    <form action="{{ route('paybox.pay') }}" method="post">
                        @csrf
                        <input type="hidden" name="partner_id" value="{{ $stock->partner->id }}">
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
                {{ $stock->full_description }}
            </div>

            <div class="info">
                <table class="table table-bordered table-striped">
                    <thead>
                    <th>Приз</th>
                    <th>Краткое описание</th>
                    <th>Условия</th>
                    <th>Кол-во</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    </thead>
                    <tbody>
                    @foreach($stock->gifts as $gift)
                        <tr>
                            <td width="200">
                                <div><img src="{{ $gift->img() }}" alt=""></div>
                                <div>
                                    #{{ $gift->id." ".$gift->title }}
                                </div>

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
@stop
