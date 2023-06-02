<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Venta</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?php echo constant('URL'); ?>public/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo constant('URL'); ?>public/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://kit.fontawesome.com/93e6a6a9bf.js" crossorigin="anonymous"></script>

    <!-- Template Main CSS File -->
    <link href="<?php echo constant('URL'); ?>public/css/style.css" rel="stylesheet">

</head>

<body>
    <?php require 'views/header.php'; ?>
    <?php require 'views/sidebar.php'; ?>

    <main id="main" class="main">

        <!-- <div class="pagetitle">
            <h1>Producto</h1>
        </div> -->

        <section class="section dashboard">
            <div class="row mt-2">
                <div class="col-12">
                    <table id="tblVenta">
                    </table>
                </div>
            </div>
        </section>

        <div class="modal" tabindex="-1" id="mdlVentaDetalle">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tProducto">Detalle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-2">
                            <div class="col-12">
                                <table id="tblVentaDetalle">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <?php require 'views/footer.php'; ?>

    <!-- Vendor JS Files -->
    <script src="<?php echo constant('URL'); ?>public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo constant('URL'); ?>public/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?php echo constant('URL'); ?>public/vendor/tinymce/tinymce.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    <!-- Template Main JS File -->
    <script src="<?php echo constant('URL'); ?>public/js/main.js"></script>

    <script src="<?php echo constant('URL'); ?>public/js/venta.js"></script>


</body>

</html>