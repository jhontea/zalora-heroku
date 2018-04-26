<!DOCTYPE html>
<html lang="en">

@include('layouts.elements-dashboard.page-styles')

<body>

<div class="wrapper">
    <!-- Sidebar -->
    @include('layouts.elements-dashboard.sidebar')
    <!-- End Sidebar -->

    <div class="main-panel">
        <!-- Navbar -->
        @include('layouts.elements-dashboard.navbar')
        <!-- End Navbar -->

        @yield('content')

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                </nav>
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, Zalora Scraper</a>
                </div>
            </div>
        </footer>

    </div>
</div>


</body>

@include('layouts.elements-dashboard.page-scripts')

</html>
