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

    .ct-series-a .ct-line,
    .ct-series-a .ct-point {
        stroke: rgb(0,0,0);
    }

    .ct-series-b .ct-line,
    .ct-series-b .ct-point {
        stroke: #B33C12;
    }

    .chart-legend .text-info {
        color: rgb(0,0,0);
    }

    .text-info, .text-info:hover {
        color: rgb(0,0,0);
    }

    .chart-legend .text-warning {
        color: #B33C12;
    }

    .text-warning, .text-warning:hover {
        color: #B33C12;
    }

    /* chartist plugin tooltip css */
    .chartist-tooltip {
        position: absolute;
        display: inline-block;
        opacity: 0;
        min-width: 5em;
        padding: .5em;
        background: #F4C63D;
        color: #453D3F;
        font-family: Oxygen,Helvetica,Arial,sans-serif;
        font-weight: 700;
        text-align: center;
        pointer-events: none;
        z-index: 1;
        -webkit-transition: opacity .2s linear;
        -moz-transition: opacity .2s linear;
        -o-transition: opacity .2s linear;
        transition: opacity .2s linear; 
    }

    .chartist-tooltip:before {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        width: 0;
        height: 0;
        margin-left: -15px;
        border: 15px solid transparent;
        border-top-color: #F4C63D; 
    }
    
    .chartist-tooltip.tooltip-show {
        opacity: 1; 
    }

    .grayscale {
        -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
        filter: grayscale(100%);
    }
</style>
@endsection

@section('section')
Item - {{ $data->title }}
@endsection

@section('content')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-5" style="padding-bottom: 15px;">
                        <div class="card card-user">
                            <div class="image" style="height: 100%;width: 100%;margin-left: auto;margin-right: auto;">
                                <figure><img src="{{ $data->image_link }}" alt="..."/></figure>
                            </div>
                            <div class="content" style="min-height: 100px;">
                                <!-- @if($data->discount)
                                <span class="centered-over-image">{{ $data->discount }}%</span>
                                @endif -->
                                <div class="author" style="margin-top: 0px;">
                                  <h4 class="title">{{ $data->title }}<br />
                                     <a href="#scrape"><p style="color: rgb(0,0,0);">{{ $data->brand }}</p></a>
                                  </h4>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">{{ $data->title }} - {{ $data->brand }}</h4>
                                <p class="category">Item price logs</p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart"></div>

                                <div class="footer">
                                    <div class="chart-legend">
                                        <i class="fa fa-circle text-info"></i> Price
                                        <i class="fa fa-circle text-warning"></i> Price Discount
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="ti-check"></i> Data information certified
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection

<?php
    foreach ($priceLogs as $log) {
        $date[] = strftime('%e %b %Y', strtotime($log->created_at));
        $price[] = $log->price;
        $priceDiscount[] = $log->price_discount;
    }
?>

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        var data = {
          labels: [
            @foreach($date as $d)
            '{{ $d }}',
            @endforeach 
          ],
          series: [
            [
                @foreach($price as $p)
                { meta: 'price', value: {!! $p !!} },
                @endforeach 
            ],
            [
                @foreach($priceDiscount as $pd)
                { meta: 'price discount', value: {!! $pd !!} },
                @endforeach    
            ]
          ]
        };

        var options = {
            seriesBarDistance: 20,
            axisX: {
                showGrid: false,
            },
            axisY: {
                offset: 60
            },
            height: "245px"
        };

        var responsiveOptions = [
          ['screen and (max-width: 640px)', {
            seriesBarDistance: 5,
            axisX: {
              labelInterpolationFnc: function (value) {
                return value[0];
              }
            }
          }]
        ];
        
        var plugins = {
            plugins: [
                Chartist.plugins.tooltip()
            ]
        }

        Chartist.Line('#chartActivity', data, options, responsiveOptions, plugins);

        // var chart = Chartist.Line('#chartActivity', {
        // labels: [1, 2, 3],
        // series: [
        //     [
        //     {meta: 'description', value: 1},
        //     {meta: 'description', value: 5},
        //     {meta: 'description', value: 3}
        //     ],
        //     [
        //     {meta: 'other description', value: 2},
        //     {meta: 'other description', value: 4},
        //     {meta: 'other description', value: 2}
        //     ]
        // ]
        // }, {
        // plugins: [
        //     Chartist.plugins.tooltip()
        // ]
        // });
    });
</script>
@endsection