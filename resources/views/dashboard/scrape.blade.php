@extends('layouts.landing-dashboard')

@section('section')
Scrape
@endsection

@section('content')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Scrape Zalora Url</h4>
                            </div>
                            <div class="content">
                                {!! Form::open() !!}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Url</label>
                                                <input name="url" type="text" class="form-control border-input" placeholder="https://zalora.co.id/..." value="">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Scrape</button>
                                    </div>
                                    <div class="clearfix"></div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div id="scrape" class="row">
                    @if($data)
                    <!-- Scrape Result -->
                    <div class="col-lg-8 col-md-5">
                        <div class="card card-user">
                            <div class="image" style="height: 100%;width: 30%;margin-left: auto;margin-right: auto;padding-top: 20px;">
                                <img src="{{ $data['image_link'] }}" alt="..."/>
                            </div>
                            <div class="content" style="min-height: 100px;">
                                <div class="author" style="margin-top: 0px;">
                                  <h4 class="title">{{ $data['title'] }}<br />
                                     <a href="#scrape"><p style="color: rgb(0,0,0);">{{ $data['brand'] }}</p></a>
                                     <small>{{ $data['sku'] }}</small>
                                  </h4>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <h5>
                                            @if($data['price'] == $data['price_discount'])
                                            Rp {{ number_format($data['price'], 0, ',', '.') }}<br />
                                            @else
                                            <strike>Rp {{ number_format($data['price'], 0, ',', '.') }}</strike><br />
                                            @endif
                                            <small>Price</small></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>
                                            @if($data['price'] == $data['price_discount'])
                                            -<br />
                                            @else
                                            <span class="text-danger">Rp {{ number_format($data['price_discount'], 0, ',', '.') }}</span> <br />
                                            @endif
                                            <small>Price Discount</small>
                                        </h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>
                                            @if($data['discount'])
                                            {{ $data['discount'] }}%<br />
                                            @else
                                            -<br />
                                            @endif
                                            <small>Discount</small></h5>
                                    </div>
                                </div>
                                {!! Form::open(['url' => 'dashboard/scrape/store', 'style' => 'margin-bottom: 14px;', 'id' => 'store']) !!}
                                {!! Form::hidden('url', $data['url']) !!}
                                {!! Form::hidden('sku', $data['sku']) !!}
                                {!! Form::hidden('brand', $data['brand']) !!}
                                {!! Form::hidden('title', $data['title']) !!}
                                {!! Form::hidden('price', $data['price']) !!}
                                {!! Form::hidden('price_discount', $data['price_discount']) !!}
                                {!! Form::hidden('image_link', $data['image_link']) !!}
                                {!! Form::hidden('segment', $data['segment']) !!}
                                {!! Form::hidden('category', $data['category']) !!}
                                {!! Form::hidden('discount', $data['discount']) !!}
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info btn-fill btn-wd">Save</button>
                                </div>
                                {!! Form::close() !!}
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End Scrape Result -->
                    @endif
                </div>
            </div>
        </div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        @if(\Session::has('errorURL'))
        $.notify({
            icon: 'ti-face-sad',
            message: "{{ \Session::pull('errorCode') }} - {{ \Session::pull('errorURL') }}"

        },{
            type: 'danger'
        });
        @endif

        $('#store').submit(function (event) {
            event.preventDefault()

            var dataForm = $(this).serialize()
            $.ajax({
                type: "POST",
                url: "scrape/store",
                data: dataForm,
                dataType: "json",
                success: function(data) {
                    $.notify({
                        icon: data.icon,
                        message: data.message

                    },{
                        type: data.alert
                    });
                },
                error: function(data) {
                    $.notify({
                        icon: data.responseJSON.icon,
                        message: data.responseJSON.message

                    },{
                        type: 'danger'
                    });
                }
            });
        });
    });
</script>
@endsection