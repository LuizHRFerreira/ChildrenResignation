<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!--begin::Fonts-->
            <link
            rel="stylesheet"
            href="{{ asset('css/source-sans.css') }}"
            integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
            crossorigin="anonymous"
        />
        <!--end::Fonts-->
        <!--begin::Third Party Plugin(OverlayScrollbars)-->
        <link
            rel="stylesheet"
            href="{{ asset('css/overlayscrollbars.min.css') }}"
        />
        <!--end::Third Party Plugin(OverlayScrollbars)-->
        <!--begin::Third Party Plugin(Bootstrap Icons)-->
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
            integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
            crossorigin="anonymous"
        />
        <!--end::Third Party Plugin(Bootstrap Icons)-->
        <!--begin::Required Plugin(AdminLTE)-->
        <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}" />
        <!--end::Required Plugin(AdminLTE)-->

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="layout-fixed sidebar-expand-lg sidebar-mini bg-body-tertiary" data-bs-theme="dark">
        @inertia
        <!--begin::Script-->
        <!--begin::Third Party Plugin(OverlayScrollbars)-->
        <script src="{{ asset('js/overlayscrollbars.browser.es6.min.js') }}"></script>
        <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
        <script src="{{ asset('js/adminlte.js') }}"></script>
        <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
        <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                theme: Default.scrollbarTheme,
                autoHide: Default.scrollbarAutoHide,
                clickScroll: Default.scrollbarClickScroll,
                },
            });
            }
        });
        </script>
        <!--end::OverlayScrollbars Configure-->
        <!--end::Script-->
    </body>
    <script>
       
    </script>
</html>
