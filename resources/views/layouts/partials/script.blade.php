{{-- Compile Assets --}}
{{-- <script src="{{ mix('js/app.js') }}"></script> --}}
{{-- AdminLTE --}}

{{-- <script src="{{ mix('js/admin-lte.js') }}"></script> --}}
{{-- Datatables --}}
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->

<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

{{-- CKEditor --}}
{{-- <script type="text/javascript" src="https://cdn.ckeditor.com/4.9.2/full-all/ckeditor.js"></script> --}}
{{-- Select2 --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> --}}
{{-- Custom --}}
@yield('script')
