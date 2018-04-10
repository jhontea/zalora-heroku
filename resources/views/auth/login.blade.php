<!DOCTYPE html>
<html lang="en">

@include('layouts.elements.page-styles')

<body class="login-page sidebar-collapse">
    <div class="page-header" filter-color="black">
        <div class="page-header-image" style="background-image:url({{ asset('img/pexels-photo-60342.jpeg') }})"></div>
        <div class="container">
            <!-- Notif -->
            @if(Session::has('message'))
            <div class="alert alert-{{ Session::pull('status') }}" role="alert">
                <div class="container">
                    <div class="alert-icon">
                        <i class="now-ui-icons {{ Session::pull('icon') }}"></i>
                    </div>
                    <strong>{{ Session::pull('notif') }}</strong> {{ Session::pull('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="now-ui-icons ui-1_simple-remove"></i>
                        </span>
                    </button>
                </div>
            </div>
            @endif
            <!-- End Notif -->
            <div class="col-md-4 content-center">
                <div class="card card-login card-plain">
                    <form class="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="header header-primary text-center">
                            <div class="logo-container">
                                <a href="{{ asset('/') }}">
                                    <img src="{{ asset('vendor/now/assets/img/now-logo-rotate.png ') }}" alt="">
                                </a>
                            </div>
                            <h2 class="title">Login</h2>
                        </div>
                        <div class="content">
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons ui-1_email-85"></i>
                                </span>
                                <input name="email" type="text" class="form-control" placeholder="Email">
                            </div>
                            @if ($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons objects_key-25"></i>
                                </span>
                                <input name="password" type="password" placeholder="Password" class="form-control" />
                            </div>
                            @if ($errors->has('password'))
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        <div class="footer text-center">
                            <button type="submit" class="btn btn-primary-2 btn-round btn-lg btn-block">Login</button>
                        </div>
                        <div class="pull-left">
                            <h6>
                                <a href="{{ asset('register') }}" class="link">Create Account</a>
                            </h6>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="copyright">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, Designed by
                    <a href="http://www.invisionapp.com" rel="nofollow" target="_blank" style="color: #fff">Invision</a>. Coded by
                    <a href="https://www.creative-tim.com" rel="nofollow" target="_blank" style="color: #fff">Creative Tim</a>.
                </div>
            </div>
        </footer>
    </div>
</body>
@include('layouts.elements.page-scripts')

</html>