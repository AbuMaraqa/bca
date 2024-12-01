<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>
        @yield('title')
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <script src="https://kit.fontawesome.com/ea80c6f30c.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    {{--    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> --}}
    {{--    <script src="https://kit.fontawesome.com/ea80c6f30c.js" crossorigin="anonymous"></script> --}}
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.6') }}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->

    <style>
        @font-face {
            font-family: Tajawal;
            src: url("{{ asset('fonts/Tajawal/Tajawal-Medium.ttf') }}");
        }

        * {
            font-family: Tajawal, sans-serif !important;
        }

        #editor {
            font-family: 'Tajawal', sans-serif;
            /* تأكد من تطبيق الخط على محرر Quill */
        }

        .fa,
        .fas,
        .far,
        .fal,
        .fab {
            font-family: 'Font Awesome 5 Free' !important;
        }

        .ql-toolbar {
            border: 1px solid #ccc;
            /* إضافة حد لشريط الأدوات */
            padding: 5px;
            /* إضافة بعض المساحة حول الأزرار */
        }

        .ql-toolbar button {
            width: 30px;
            /* تأكد من أن الأزرار لها عرض */
            height: 30px;
            /* تأكد من أن الأزرار لها ارتفاع */
            font-size: 14px;
            /* حجم خط مناسب */
        }

        .ql-toolbar .ql-active {
            background: #e0e0e0;
            /* لون خلفية للأزرار النشطة */
        }

        .ql-toolbar .ql-list {
            color: #000;
            /* تأكد من أن لون النص واضح */
        }

        /* Container styling to make the select look like Bootstrap's form-control */
        .select-control {
            display: block;
            width: 100%;
            padding: 0.75rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        /* Optional: hover and focus effects */
        .select-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-xs {
            padding: 4px 8px;
            font-size: 12px;
            line-height: 1.5;
            border-radius: 5px;
        }
    </style>
    @yield('style')
</head>

<body class="g-sidenav-show rtl bg-gray-200">
    @include('layouts.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        @include('layouts.navbar')
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @include('layouts.content')
            @include('layouts.footer')
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/fullcalendar.min.js') }}"></script>
    <!-- Kanban scripts -->
    <script src="{{ asset('assets/js/plugins/dragula/dragula.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jkanban/jkanban.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
    <!-- Github buttons -->
    {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.0.6') }}"></script>

    @yield('script')
</body>

</html>
