<!DOCTYPE html>
<html lang="en">

@include('layouts.elements.page-styles')

<body class="index-page sidebar-collapse">
    <!-- Navbar -->
    @include('layouts.elements.navbar')
    <!-- End Navbar -->
    <div class="wrapper">
        
        @yield('content')
        
        <!-- Footer -->
        <footer class="footer" data-background-color="black">
            <div class="container">
                <div class="copyright">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, Designed by
                    <a href="http://www.invisionapp.com" target="_blank">Invision</a>. Coded by
                    <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
                </div>
            </div>
        </footer>
        <!-- End Footer -->
    </div>
</body>
@include('layouts.elements.page-scripts')
</html>