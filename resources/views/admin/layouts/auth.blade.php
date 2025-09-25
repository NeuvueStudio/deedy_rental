<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Streamline your business with our advanced CRM template. Easily integrate and customize to manage sales, support, and customer interactions efficiently. Perfect for any business size">
    <meta name="keywords"
        content="Advanced CRM template, customer relationship management, business CRM, sales optimization, customer support software, CRM integration, customizable CRM, business tools, enterprise CRM solutions">
    <meta name="author" content="Dreams Technologies">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/assets/css/style.css" id="app-style">
    <link rel="stylesheet" href="/assets/plugins/datatables/css/dataTables.bootstrap5.min.css">
</head>


<body class="account-page bg-white">

    <!-- Begin Wrapper -->
    <div class="main-wrapper">

        @yield('content')

    </div>
    <!-- End Wrapper -->

    <!-- jQuery -->
    <script src="assets/js/jquery-3.7.1.min.js" type="text/javascript"></script>

    <!-- Bootstrap Core JS -->
    <script src="assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>

    <!-- Main JS -->
    <script src="assets/js/script.js" type="text/javascript"></script>

   
</body>

</html>
