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

    div#preloader { position: fixed; left: 0; top: 0; z-index: 999; width: 100%; height: 100%; opacity: 0.5; overflow: visible; background: #333 url('http://files.mimoymima.com/images/loading.gif') no-repeat center center; }
</style>
@endsection

@section('section')
All Items
@endsection

@section('content')
        <div id="preloader" style="display: none"></div>

        <div class="content">
            <div class="container-fluid">
            
            <div class="content">
                <div class="row">
                    <!-- Category -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Category</label>
                            <select id="catID">
                                <option value="">Select a Category</option>
                                @foreach($categories as $key => $value)
                                <option class="option" value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Sort -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sort</label>
                            <select id="sortID">
                                <option value="">Select Sort</option>
                                <option class="option" value="asc">Lowest discount</option>
                                <option class="option" value="desc">Highest discount</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

                <div id="productData" class="row">
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
                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 15px;">
                        {{ $userItems->links() }}
                    </div>
                @endif
                </div>
            </div>
        </div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){
  var filters = [];

  $('#catID').on('change', function() {
    var cat = this.value;
    filters['category'] = cat;
    $('#preloader').show();
    getData('category', cat)
  });

  $('#sortID').on('change', function() {
    var sorting = this.value;
    filters['sorting'] = sorting;
    $('#preloader').show();
    getData('sorting', sorting)
  });
  
  function getData(type, value) {
    var params = '';
    var iterate = 0;

    for (key in filters) {
        if (iterate == 0) {
            params = '?' + key + '=' + filters[key]
        } else {
            params += '&' + key + '=' + filters[key]
        }
        iterate++
        console.log(params)
    }

    var cat = value
    var sorting = 'asc'

    $.ajax({
      type: 'get',
      dataType: 'html',
      url: '{{ url('/dashboard/items/filter') }}' + params,
      success:function(response){  
        $('#preloader').hide();      
        $("#productData").html(response);
      },
      complete: function(){
        $('#preloader').hide(); 
      }
    });
  }
});
</script>
@endsection