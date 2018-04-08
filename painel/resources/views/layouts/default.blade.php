<!DOCTYPE html>
<html lang="en">
    @include('includes.head')
    <body>
        <!-- ADDS TOPBAR -->
        @include('includes.topbar')
        <section>
            <!-- ADDS SIDEBAR -->
            @include('includes.sidebar')
            <div class="mainpanel">
                @yield('content')
            </div>
        </section>
        <!-- FOOTER -->
        @include('includes.footer')
        <!-- EXTRA JS SCRIPTS -->
        <script src="/assets/js/AjaxSetup.js"></script>
        @yield('extra_scripts')
    </body>
</html>