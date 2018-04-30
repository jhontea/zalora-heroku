@extends('layouts.landing-dashboard')

@section('section')
Dashboard
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big text-center">
                                    <i class="ti-tag"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Items</p>
                                    {{ count($userItems) }}
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <a href="{{ route('dashboard.items') }}">View your items</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big text-center">
                                    <i class="ti-announcement"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Update</p>
                                    {{ count($countUserNotif) }}
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <a href="{{ route('dashboard.update-log') }}">View log update</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Graphic -->
        <div class="row">
            <!-- Active -->
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Items</h4>
                        <p class="category">Active or Inactive</p>
                    </div>
                    <div class="content">
                        <div id="chartActIn" class="ct-chart ct-perfect-fourth"></div>

                        <div class="footer">
                            <div class="chart-legend">
                                <i class="fa fa-circle text-info"></i> Active
                                <i class="fa fa-circle text-warning"></i> Inactive
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Category -->
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Categories</h4>
                        <p class="category">Item Categories</p>
                    </div>
                    <div class="content">
                        <div id="chartCategory" class="ct-chart ct-perfect-fourth"></div>

                        <div class="footer">
                            <div class="chart-legend">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Graphic -->
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){

        demo.initChartist();

        @if(\Session::has('login-notif'))
        $.notify({
            icon: 'ti-user',
            message: "{!! \Session::pull('login-notif') !!}"

        },{
            type: 'success',
            timer: 300
        });
        @endif

        Chartist.Pie('#chartActIn', {
          labels: ['{{ $actIn->active }}','{{ $actIn->inactive }}'],
          series: [ {{ $actIn->active }}, {{ $actIn->inactive }}]
        });

        Chartist.Bar('#chartCategory', {
            labels: [
                @foreach($countCategories as $category)
                    '{{ $category->category }}',
                @endforeach
            ],
            series: [
                @foreach($countCategories as $category)
                    {{ $category->total }},
                @endforeach
            ]
        }, {
            distributeSeries: true
        });

        var data = {
            labels: ['Bananas', 'Apples', 'Grapes'],
            series: [20, 15, 40]
        };

        var options = {
            labelInterpolationFnc: function(value) {
                return value[0]
            }
        };

        var responsiveOptions = [
            ['screen and (min-width: 640px)', {
                chartPadding: 130,
                labelOffset: 100,
                labelDirection: 'explode',
                labelInterpolationFnc: function(value) {
                return value;
                }
            }],
            ['screen and (min-width: 1024px)', {
                labelOffset: 60,
                chartPadding: 20
            }]
        ];

        // new Chartist.Pie('#chartCategory', data, options, responsiveOptions);

    });
</script>
@endsection