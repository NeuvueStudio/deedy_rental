<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Deals Dashboard | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Streamline your business with our advanced CRM template. Easily integrate and customize to manage sales, support, and customer interactions efficiently. Perfect for any business size">
    <meta name="keywords"
        content="Advanced CRM template, customer relationship management, business CRM, sales optimization, customer support software, CRM integration, customizable CRM, business tools, enterprise CRM solutions">
    <meta name="author" content="Dreams Technologies">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/img/favicon.png">

    <!-- Apple Icon -->
    <link rel="apple-touch-icon" href="/assets/img/apple-icon.png">

    <!-- Theme Config Js -->
    <script src="/assets/js/theme-script.js" type="??text/javascript"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="/assets/plugins/tabler-icons/tabler-icons.min.css">

    <!-- Simplebar CSS -->
    <link rel="stylesheet" href="/assets/plugins/simplebar/simplebar.min.css">

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="/assets/plugins/datatables/css/dataTables.bootstrap5.min.css">

    <!-- Daterangepicker CSS -->
    <link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="/assets/css/style.css" id="app-style">
    <link rel="stylesheet" href="/assets/css/dropzone.min.css" id="app-style">

    @yield('styles')
</head>

<body>

    <div class="main-wrapper">
        @include('admin.parts.header')
        @include('admin.parts.sidebar')

        <div class="page-wrapper">
            @yield('content')
            @include('admin.parts.footer')
        </div>
    </div>

    <!-- jQuery -->
    <script src="/assets/js/jquery-3.7.1.min.js" type="text/javascript"></script>

    <!-- Bootstrap Core JS -->
    <script src="/assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>

    <!-- Simplebar JS -->
    <script src="/assets/plugins/simplebar/simplebar.min.js" type="text/javascript"></script>

    <!-- Datatable JS -->
    <script src="/assets/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/datatables/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>

    <!-- Daterangepicker JS -->
    <script src="/assets/js/moment.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

    <!-- Apexchart JS -->
    <script src="/assets/plugins/apexchart/apexcharts.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/apexchart/chart-data.js" type="text/javascript"></script>

    <!-- Custom Json Js -->
    {{-- <script src="/assets/json/deals-project.js" type="text/javascript"></script> --}}
    <script src="/assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
    <script src="/assets/js/dropzone.min.js" type="text/javascript"></script>
    <!-- Main JS -->
    <script src="/assets/js/script.js" type="text/javascript"></script>
    <script>
        $('.data').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            pageLength: 10,
            language: {
                paginate: {
                    next: '<i class="ti ti-chevron-right"></i>',
                    previous: '<i class="ti ti-chevron-left"></i>'
                }
            }
        });
    </script>
    <script>
        // Disable auto-discovery so Dropzone doesn't attach automatically
        Dropzone.autoDiscover = false;

        // Create a Dropzone instance for a specific element
        const myDropzone = new Dropzone("#my-dropzone", {
            url: "#",
            autoProcessQueue: false, // DO NOT auto-upload
            maxFilesize: 5, // Maximum file size in MB
            acceptedFiles: "image/*", // Only images
            addRemoveLinks: true, // Show "Remove file" link
            dictDefaultMessage: "Drag & drop images here or click to upload",
            init: function() {
                this.on("success", (file, response) => {
                    console.log("File uploaded:", file.name);
                });
                this.on("error", (file, errorMessage) => {
                    console.error("Upload error:", errorMessage);
                });
            }
        });
    </script>

    @yield('scripts')
</body>

</html>
