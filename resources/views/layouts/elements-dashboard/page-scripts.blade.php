<!--   Core JS Files   -->
<script src="{{ asset('vendor/paper-dashboard/assets/js/jquery-1.10.2.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/paper-dashboard/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="{{ asset('vendor/paper-dashboard/assets/js/bootstrap-checkbox-radio.js') }}"></script>

<!--  Charts Plugin -->
<script src="{{ asset('vendor/paper-dashboard/assets/js/chartist.min.js') }}"></script>
<script src="{{ asset('vendor/paper-dashboard/assets/js/chartist-tooltips.js') }}"></script>

<!--  Notifications Plugin    -->
<script src="{{ asset('vendor/paper-dashboard/assets/js/bootstrap-notify.js') }}"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="{{ asset('vendor/paper-dashboard/assets/js/paper-dashboard.js') }}"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('vendor/paper-dashboard/assets/js/demo.js') }}"></script>

@yield('scripts')