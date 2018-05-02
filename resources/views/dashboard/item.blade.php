@extends('layouts.landing-dashboard')

@section('styles')
<style>
    .centered-over-image {
        position: absolute;
        top: 3%;
        left: 95%;
        transform: translate(-50%, -50%);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        font-size: 12px;
        color: #fff;
        line-height: 50px;
        text-align: center;
        background: #000;
        margin-bottom: 10px;
    }

    /* Opacity #2 */
    .hover12 figure {
        background: #2c2c2c;
    }
    .hover12 figure img {
        opacity: 1;
        -webkit-transition: .3s ease-in-out;
        transition: .3s ease-in-out;
    }
    .hover12 figure:hover img {
        opacity: .8;
    }

    .grayscale {
        -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
        filter: grayscale(100%);
    }

    .card-user .author {
        text-align: center;
        text-transform: none;
        height: 10px;
    }
</style>
@endsection

@section('section')
All Items
@endsection

@section('content')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                @if ($userItems)
                    @foreach ($userItems as $data)
                    <div class="col-lg-3 col-md-5 col-sm-4" style="padding-bottom: 15px;">
                        <div class="card card-user" @if(!$data->is_active) style="background-color: lightgray"  @endif>
                            <div class="image hover12" style="height: 100%;width: 100%;margin-left: auto;margin-right: auto;">
                                <a href="{{ 'items/'.$data->sku }}">
                                    <figure><img @if(!$data->is_active) class="grayscale" @endif src="{{ $data->image_link }}" alt="..."/></figure>
                                </a>
                            </div>
                            <div class="content" style="min-height: 100px;">
                                @if($data->discount)
                                <span class="centered-over-image">{{ $data->discount }}%</span>
                                @endif
                                <div class="author" style="margin-top: 0px;">
                                  <h4 class="title">{{ $data->title }}<br />
                                     <a href="#scrape"><p style="color: rgb(0,0,0);">{{ $data->brand }}</p></a>
                                  </h4>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 style="font-size: 1em">
                                            @if($data->price == $data->price_discount)
                                            Rp {{ number_format($data->price, 0, ',', '.') }}<br />
                                            @else
                                            <strike>Rp {{ number_format($data->price, 0, ',', '.') }}</strike><br />
                                            @endif
                                            <small>Price</small></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 style="font-size: 1em">
                                            @if($data->price == $data->price_discount)
                                            -<br />
                                            @else
                                            <span class="text-danger">Rp {{ number_format($data->price_discount, 0, ',', '.') }}</span> <br />
                                            @endif
                                            <small>Price Discount</small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
                </div>
            </div>
        </div>
@endsection