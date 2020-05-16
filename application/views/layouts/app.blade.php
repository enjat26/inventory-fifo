<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Sistem Inventory Barang</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/') ?>/bootstrap-4.4.1-dist/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/') ?>/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="<?php echo base_url('assets/vendor/') ?>/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
	<link href="<?php echo base_url('assets/vendor/') ?>/datatables/css/dataTables.bootstrap4.css" rel="stylesheet">
	<link href="<?php echo base_url('assets/vendor/') ?>/datepicker/datepicker.css" rel="stylesheet">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/components.css">
    @stack('style')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            @include('layouts.partials.navbar')
            @include('layouts.partials.sidebar')
            

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    @yield('content')
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left"> Copyright &copy; 2020 <div class="bullet"></div> Universitas Banten Jaya</div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="<?php echo base_url('assets/vendor') ?>/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url('assets/vendor') ?>/bootstrap-4.4.1-dist/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/vendor') ?>/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets/vendor') ?>/datatables/js/dataTables.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets/vendor') ?>/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url('assets/vendor') ?>/datepicker/datepicker.js"></script>
    <script src="<?php echo base_url('assets/vendor') ?>/jquery-nicescroll-3.7.6/jquery-nicescroll-3.7.6.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/stisla.js"></script>

    <!-- Template JS File -->
    <script src="<?php echo base_url('assets') ?>/js/scripts.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/custom.js"></script>
    <script>
	$(document).ready( function () {
            $('#datatable').DataTable();

            $('.datepicker').datepicker({
                autoclose:true
            });
        });

    </script>
    @stack('scripts')
</body>
</html>
