<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $data['title'] }}</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/web/imgs/logo_favicon.png" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/css/plugins/slider-range.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/css/main.css') }}" />
</head>

<body>

    <!-- Custom Preloader -->
    <!--<div id="preloader">
        <img src="/web/imgs/dd_preloader.gif" alt="Loading..." class="loader-img">
    </div>-->
    <?php
    if (!isset($countries)) {
        $countries = [];
    }
    
    ?>


    <main class="main">
        @include('web.parts.header')
        @yield('content')
        @include('web.parts.footer')
    </main>
    <!-- Modal Structure -->
    



    <!-- Vendor JS-->
    <script src="{{ asset('web/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('web/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('web/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('web/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('web/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('web/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('web/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('web/js/plugins/slider-range.js') }}"></script>
    <script src="{{ asset('web/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('web/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('web/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('web/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('web/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('web/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('web/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('web/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('web/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('web/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('web/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('web/js/main.js') }}"></script>
    <script src="{{ asset('web/js/shop.js') }}"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-auth-compat.js"></script>

    @yield('custom_script')
    <script>
        $(document).ready(function() {
            $('#searchInput').on('focus', function() {
                $('#searchPopup').show();
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('#searchPopup, #searchInput').length) {
                    $('#searchPopup').hide();
                }
            });
        });
    </script>
    <script>
        // Save recent searches in localStorage
        $('#searchInput').on('keypress', function(e) {
            if (e.which == 13) { // On Enter
                let query = $(this).val().trim();
                if (!query) return;

                let recent = JSON.parse(localStorage.getItem('recentSearches') || '[]');

                // Avoid duplicates
                recent = recent.filter(item => item !== query);
                recent.unshift(query); // add to front
                if (recent.length > 10) recent.pop(); // limit to 10

                localStorage.setItem('recentSearches', JSON.stringify(recent));
                showRecentSearches(); // update display
            }
        });

        // Display recent searches
        function showRecentSearches() {
            let recent = JSON.parse(localStorage.getItem('recentSearches') || '[]');
            let container = $('#recentSearchContainer');
            container.empty();

            if (recent.length === 0) {
                container.html('<span class="text-muted">No recent searches</span>');
                return;
            }

            recent.forEach(item => {
                container.append(`
                <span class="badge bg-light text-dark recent-search-item" style="cursor:pointer;" data-query="${item}">
                    ${item}
                </span>
            `);
            });

            // Handle clicks on recent search badges
            $('.recent-search-item').on('click', function() {
                const query = $(this).data('query');
                window.location.href = `/shop?search=${encodeURIComponent(query)}`;
            });

            // Handle clicks on recent search badges
            $('.popular_search').on('click', function() {
                const query = $(this).data('query');
                window.location.href = `/shop?search=${encodeURIComponent(query)}`;
            });

        }

        // Initialize on page load
        $(document).ready(function() {
            showRecentSearches();
        });
    </script>
</body>
</html>