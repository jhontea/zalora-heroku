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