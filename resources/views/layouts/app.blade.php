<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta http-equiv="Permissions-Policy" content="interest-cohort=()">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('lorekeeper.settings.site_name', 'Lorekeeper') }} -@yield('title')</title>

  <!-- Primary Meta Tags -->
  <meta name="title"
    content="{{ config('lorekeeper.settings.site_name', 'Lorekeeper') }} -@yield('title')"
  >
  <meta name="description"
    content="@if (View::hasSection('meta-desc')) @yield('meta-desc') @else {{ config('lorekeeper.settings.site_desc', 'A Lorekeeper ARPG') }} @endif"
  >

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ config('app.url', 'http://localhost') }}">
  <meta property="og:image"
    content="@if (View::hasSection('meta-img')) @yield('meta-img') @else {{ asset('images/meta-image.png') }} @endif"
  >
  <meta property="og:title"
    content="{{ config('lorekeeper.settings.site_name', 'Lorekeeper') }} -@yield('title')"
  >
  <meta property="og:description"
    content="@if (View::hasSection('meta-desc')) @yield('meta-desc') @else {{ config('lorekeeper.settings.site_desc', 'A Lorekeeper ARPG') }} @endif"
  >

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="{{ config('app.url', 'http://localhost') }}">
  <meta property="twitter:image"
    content="@if (View::hasSection('meta-img')) @yield('meta-img') @else {{ asset('images/meta-image.png') }} @endif"
  >
  <meta property="twitter:title"
    content="{{ config('lorekeeper.settings.site_name', 'Lorekeeper') }} -@yield('title')"
  >
  <meta property="twitter:description"
    content="@if (View::hasSection('meta-desc')) @yield('meta-desc') @else {{ config('lorekeeper.settings.site_desc', 'A Lorekeeper ARPG') }} @endif"
  >

  <!-- No AI scraping directives -->
  <meta name="robots" content="noai">
  <meta name="robots" content="noimageai">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/site.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap4-toggle.min.js') }}"></script>
    <script src="{{ asset('js/tinymce.min.js') }}"></script>
    <script src="{{ asset('js/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('js/selectize.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui-timepicker-addon.js') }}"></script>
    <script src="{{ asset('js/croppie.min.js') }}"></script>

    <!-- Scripts for wheel of fortune dailies -->
    <script src="{{ asset('js/winwheel.min.js') }}"></script>
    <script src="{{ asset('js/tweenmax.min.js') }}"></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito"
    rel="stylesheet"
    type="text/css"
  >

  <!-- Styles -->
  <link href="{{ asset('css/vendor/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/vendor/lorekeeper.css') }}" rel="stylesheet">

  {{-- Font Awesome --}}
  <link href="{{ asset('css/vendor/all.min.css') }}" rel="stylesheet">

  {{-- jQuery UI --}}
  <link href="{{ asset('css/vendor/jquery-ui.min.css') }}" rel="stylesheet">

  {{-- Bootstrap Toggle --}}
  <link href="{{ asset('css/vendor/bootstrap4-toggle.min.css') }}" rel="stylesheet">

  <link href="{{ asset('css/vendor/lightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/vendor/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/vendor/jquery-ui-timepicker-addon.css') }}" rel="stylesheet">
  <link href="{{ asset('css/vendor/croppie.css') }}" rel="stylesheet">
  <link href="{{ asset('css/vendor/selectize.bootstrap4.css') }}" rel="stylesheet">

  @if (file_exists(public_path() . '/css/custom.css'))
    <link href="{{ asset('css/vendor/custom.css') }}" rel="stylesheet">
  @endif
  {{-- CUSTOM CSS --}}
  <link href="{{ asset('css/sitewide.css') }}" rel="stylesheet">

</head>

<body>
  <div id="app">

    <main id="main-app" class="{{ View::hasSection('sidebar') ? 'has-sidebar' : '' }}">

      {{-- Header Logo --}}
      <a id="site-logo-header" href="{{ url('/') }}">
        <picture>
          <source srcset="{{ asset('images/somnivores/raw/logo_raw.png') }}"
            media="(min-width: 992px)"
          />
          <source srcset="{{ asset('images/somnivores/logo.png') }}" media="(min-width: 600px)" />
          <img src="{{ asset('images/somnivores/logo.png') }}" alt="" />
        </picture>
      </a>

      {{-- Navbar --}}
      @include('layouts._nav')

      {{-- Sidebar Container --}}
      <div id="sidebar-container">
        {{-- Mobile Sidebar (conditional) --}}
        @if (View::hasSection('sidebar'))
          <div id="site-mobile-header">
            <button class="btn btn-sm btn-outline-dark" id="mobileMenuButton">
              Menu
              <i class="fas fa-caret-right ml-1"> </i>
            </button>
          </div>
        @endif
        {{-- Actual Sidebar --}}
        <ul id="sidebar" class="sidebar">
          @yield('sidebar')
        </ul>
      </div>

      {{-- Main Content --}}
      <div id="main-content" class="main-content p-4">
        @if (Auth::check() && !Config::get('lorekeeper.extensions.navbar_news_notif'))
          @if (Auth::user()->is_news_unread)
            <div class="alert alert-info">
              <a href="{{ url('news') }}">There is a new news post!</a>
            </div>
          @endif
          @if (Auth::user()->is_sales_unread)
            <div class="alert alert-info">
              <a href="{{ url('sales') }}">There is a new sales post!</a>
            </div>
          @endif
        @endif
        @include('flash::message')
        @yield('content')

        @include('layouts._footer')
      </div>

    </main>


        @include('layouts._terms_modal')

        <div class="modal fade" id="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title h5 mb-0"></span>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>

    @yield('scripts')
    <script>
      $(function() {
        $('[data-toggle="tooltip"]').tooltip({
          html: true
        });
        $('.cp').colorpicker();
        tinymce.init({
          selector: '.wysiwyg',
          height: 500,
          menubar: false,
          convert_urls: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen spoiler',
            'insertdatetime media table paste code help wordcount'
          ],
          toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | spoiler-add spoiler-remove | removeformat | code',
          content_css: [
            '{{ asset('css/vendor/app.css') }}',
            '{{ asset('css/vendor/lorekeeper.css') }}'
          ],
          spoiler_caption: 'Toggle Spoiler',
          target_list: false
        });
        var $siteMobileHeader = $('#site-mobile-header');
        var $mobileMenuButton = $('#mobileMenuButton');
        var $sidebar = $('#sidebar');
        $('#mobileMenuButton').on('click', function(e) {
          e.preventDefault();
          $siteMobileHeader.toggleClass('active');
          $sidebar.toggleClass('active');
        });

        $('.inventory-log-stack').on('click', function(e) {
          e.preventDefault();
          loadModal("{{ url('items') }}/" + $(this).data('id') + "?read_only=1", $(this).data(
            'name'));
        });

        $('.spoiler-text').hide();
        $('.spoiler-toggle').click(function() {
          $(this).next().toggle();
        });
      });
    </script>
  </div>
</body>

</html>
