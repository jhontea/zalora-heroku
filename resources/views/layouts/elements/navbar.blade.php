    <nav class="navbar navbar-expand-lg bg-black fixed-top navbar-transparent " color-on-scroll="400">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="{{ asset('/') }}">
                    <img class="n-logo" src="{{ asset('vendor/now/assets/img/now-logo-rotate.png ') }}" alt="" style="width: 15%;padding-right: 15px;">
                    Zalora Scrapper
                </a>
                <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="{{ asset('vendor/now/assets/img/blurred-image-1.jpg') }}">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" onclick="scrollToAbout()">
                            <i class="now-ui-icons business_badge"></i>
                            <p>About</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" onclick="scrollToFeature()">
                            <i class="now-ui-icons business_bulb-63"></i>
                            <p>Feature</p>
                        </a>
                    </li>
                    @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link btn btn-neutral-2" href="{{ asset('logout') }}">
                            <p>LOGOUT</p>
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link btn btn-neutral-2" href="{{ asset('login') }}">
                            <p>LOGIN</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-neutral-2" href="{{ asset('register') }}">
                            <p>REGISTER</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>