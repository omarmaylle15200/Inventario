<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?php echo constant('URL'); ?>public/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo constant('URL'); ?>public/vendor/simple-datatables/style.css" rel="stylesheet">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Template Main CSS File -->
    <link href="./public/css/style.css" rel="stylesheet">

</head>

<body>
    <?php require 'views/header.php'; ?>
    <?php require 'views/sidebar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Inicio</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Bienvenido
                        </div>
                        <div class="card-body">
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <?php require 'views/footer.php'; ?>

    <!-- Vendor JS Files -->
    <script src="<?php echo constant('URL'); ?>public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo constant('URL'); ?>public/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?php echo constant('URL'); ?>public/vendor/tinymce/tinymce.min.js"></script>

    <!-- Template Main JS File -->
    <script src="./public/js/main.js"></script>


</body>

</html>