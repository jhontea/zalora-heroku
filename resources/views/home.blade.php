@extends('layouts.landing')

@section('content')
        <!-- Home Banner -->
        <div class="page-header clear-filter" filter-color="black">
            <div class="page-header-image" data-parallax="true" style="background-image: url('{{ asset('img/pexels-photo-432059.jpeg') }}');">
            </div>
            <div class="container">
                <div class="content-center brand">
                    <img class="n-logo" src="{{ asset('vendor/now/assets/img/now-logo-rotate.png ') }}" alt="">
                    <h1 class="h1-seo">Zalora Scraper</h1>
                    <h3>A web that log zalora price daily</h3>
                </div>
            </div>
        </div>
        <!-- End Home Banner -->
        <div class="main">
            <div class="section section-images">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="hero-images-container">
                                <img src="{{ asset('vendor/now/assets/img/hero-image-1-cust.png') }}" alt="">
                            </div>
                            <div class="hero-images-container-1">
                                <img src="{{ asset('vendor/now/assets/img/hero-image-2-cust.png') }}" alt="">
                            </div>
                            <div class="hero-images-container-2">
                                <img src="{{ asset('vendor/now/assets/img/hero-image-3-cust.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- About -->
            <div id="#section-about-us" class="section section-about-us">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto text-center">
                            <h2 class="title">Who we are?</h2>
                            <h5 class="description">A web scraping tool that is easy to use.
Zalora Scraper is a web scraping tool for zalora's product. With our advanced web scraper, extracting data is as easy as clicking the data you need.</h5>
                        </div>
                    </div>
                    <div class="separator separator-primary"></div>
                    <div class="section-story-overview">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="image-container image-left" style="background-image: url('{{ asset('img/pexels-photo-241544.jpeg') }}')"></div>
                            </div>
                            <div class="col-md-5">
                                <div class="image-container image-right" style="background-image: url('{{ asset('img/pexels-photo-264471.jpeg') }}')"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End About -->

            <!-- Feature -->
            <div id="#section-feature" class="section section-feature" data-background-color="black">
                <div class="container text-center">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto text-center">
                            <h2 class="title" style="margin-bottom: 5px;">Everything you need</h2>
                        </div>
                    </div>
                    <div class="separator separator-primary" style="margin-bottom: 50px;"></div>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-neutral btn-icon btn-lg btn-round" type="button">
                                <i class="now-ui-icons arrows-1_cloud-download-93" style="color: #2c2c2c"></i>
                            </button><br>
                            <h3 style="margin-bottom: 5px;">Cloud-based</h3>
                            <p>Collect and store data on our servers automatically.</p>
                        </div>
                        <div class="col">
                            <button class="btn btn-neutral btn-icon btn-lg btn-round" type="button">
                                <i class="now-ui-icons loader_gear" style="color: #2c2c2c"></i>
                            </button><br>
                            <h3 style="margin-bottom: 5px;">IP Rotation</h3>
                            <p>Use a fleet of proxies while scraping a website.</p>
                        </div>
                        <div class="col">
                            <button class="btn btn-neutral btn-icon btn-lg btn-round" type="button">
                                <i class="now-ui-icons tech_watch-time" style="color: #2c2c2c"></i>
                            </button><br>
                            <h3 style="margin-bottom: 5px;">Scheduled Collection</h3>
                            <p>Get a new set of data daily, weekly, monthly, etc.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Feature -->

            <!-- Pricing -->
            <!-- <div id="#section-pricing" class="section section-pricing text-center">
                <div class="container">
                    <h2 class="title">Pricing</h2>
                    <div class="team">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="team-player">
                                    <h4 class="title">Free Plan</h4>
                                    <p class="category text-primary">Basic</p>
                                    <p class="description">You can write here details about one of your team members. You can give more details about what they do. Feel free to add some
                                        <a href="#">links</a> for people to be able to follow them outside the site.</p>
                                    <a href="#pablo" class="btn btn-primary btn-icon btn-round"><i class="fa fa-twitter"></i></a>
                                    <a href="#pablo" class="btn btn-primary btn-icon btn-round"><i class="fa fa-instagram"></i></a>
                                    <a href="#pablo" class="btn btn-primary btn-icon btn-round"><i class="fa fa-facebook-square"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="team-player">
                                    <h4 class="title">Paid Plan</h4>
                                    <p class="category text-primary">Premium</p>
                                    <p class="description">You can write here details about one of your team members. You can give more details about what they do. Feel free to add some
                                        <a href="#">links</a> for people to be able to follow them outside the site.</p>
                                    <a href="#pablo" class="btn btn-primary btn-icon btn-round"><i class="fa fa-twitter"></i></a>
                                    <a href="#pablo" class="btn btn-primary btn-icon btn-round"><i class="fa fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- End Pricing -->
        </div>
@endsection

@section('scripts')
<script>
    function scrollToDownload() {

        if ($('.section-download').length != 0) {
            $("html, body").animate({
                scrollTop: $('.section-download').offset().top
            }, 1000);
        }
    }

    function scrollToAbout() {

        if ($('.section-about-us').length != 0) {
            $("html, body").animate({
                scrollTop: $('.section-about-us').offset().top
            }, 1000);
        }
    }

    function scrollToFeature() {

        if ($('.section-feature').length != 0) {
            $("html, body").animate({
                scrollTop: $('.section-feature').offset().top
            }, 1000);
        }
    }

    function scrollToPricing() {

        if ($('.section-pricing').length != 0) {
            $("html, body").animate({
                scrollTop: $('.section-pricing').offset().top
            }, 1000);
        }
    }
</script>
@endsection