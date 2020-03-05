<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>



    @include('layouts.partials.style')
    @yield('style')
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('layouts.partials.nav')

        @include('layouts.partials.sidebar')

        <div class="content-wrapper">
            <section class="content-header">
                @yield('content-header')
            </section>

            <section class="content">
                @yield('content')
            </section>
        </div>

        @include('layouts.partials.footer')
    </div>


    @yield('modal')
    <div class="modal modal-default fade" id="modal-loading" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body text-center">
            <div style="display: inline-block;">
                <i class="fa fa-refresh fa-spin" aria-hidden="true" style="font-size: 60px;"></i>
            </div>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    {{-- toast --}}
    <div id="toast" class="alert  alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4>Alert!</h4>
     <p></p>
    </div>

    @include('layouts.partials.script')
</body>
</html>
