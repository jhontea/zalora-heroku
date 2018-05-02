@extends('layouts.landing-dashboard')

@section('section')
Update Log
@endsection

@section('styles')
<style>
    .card-gray {
        background-color: lightgray;
        color: gray;
    }
</style>
@endsection

@section('content')
        <div class="content">
            <div class="container-fluid">
            @if (count($items))
                @foreach($items as $item)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="content">
                                <div class="typo-line">
                                    <h5>
                                        <a href="{{ 'items/'.$item->sku }}">
                                            <img class="category" src="{{ $item->image_link }}" style="width: 10%;">
                                        </a>
                                        <strong>{{ $item->brand }}</strong> <br>
                                        {{ $item->title }} <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                Price
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                Rp {{ number_format($item->price_prev , 0, ',', '.') }}
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1">
                                                ->
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                Rp {{ number_format($item->price_now , 0, ',', '.') }}
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1">
                                                <i class="ti-arrow-{{ $item->price_status }}"></i>
                                            </div>
                                        </div>  

                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                Price Discount
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                Rp {{ number_format($item->price_discount_prev , 0, ',', '.') }}
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1">
                                                ->
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                Rp {{ number_format($item->price_discount_now , 0, ',', '.') }}
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1">
                                                <i class="ti-arrow-{{ $item->price_discount_status }}"></i>
                                            </div>
                                        </div>  

                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                Discount
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                {{ $item->discount_prev }} %
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1">
                                                ->
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                {{ $item->discount_now }} %
                                            </div>
                                        </div>  
                                        <small>{{ $item->created_at }}</small> <br>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            There are no updated price log
            @endif
            </div>
        </div>
@endsection