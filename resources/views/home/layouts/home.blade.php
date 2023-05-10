
<!DOCTYPE html>
<html lang="fa" class="class="no-js"">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Verna.ir - @yield('title')</title>
  <link href="{{ asset('/css/home.css') }}" rel="stylesheet">
  @yield('style')

  {!! SEO::generate() !!}

</head>

<body>
    <div class="wrapper text-center">

        <div id="overlayer"></div>
        <span class="loader"></span>


        @include('home.sections.header')

        @include('home.sections.mobile_off_canvas')

        @yield('content')

        @include('home.sections.footer')
    </div>


  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('/js/home/jquery-1.12.4.min.js') }}"></script>
  <script src="{{ asset('/js/home/plugins.js') }}"></script>
  <script src="{{ asset('/js/home.js') }}"></script>
  <script src="{{ asset('/js/rating.js') }}"></script>
  @yield('script')

  <script>
    $(window).load(function() {
        $(".loader").delay(1000).fadeOut("slow");
        $("#overlayer").delay(1000).fadeOut("slow");
    })
  </script>

  @include('sweetalert::alert')
{{--
  {!!  GoogleReCaptchaV3::init() !!} --}}

</body>

</html>
