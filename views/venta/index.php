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
    <link href="./public/css/style.css" rel="stylesheet">

</head>

<body>
    <?php require 'views/header.php'; ?>
    <?php require 'views/sidebar.php'; ?>

    <main id="main" class="main">

        <!-- <div class="pagetitle">
            <h1>Producto</h1>
        </div> -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-2 mb-2">
                                <div class="col-md-2">
                                    <label for="txtNumeroDocumento" class="form-label">Número Documento</label>
                                    <input type="text" class="form-control" id="txtNumeroDocumento" maxlength="11" required>
                                    <div class="invalid-feedback">
                                        Completar campo
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="txtNombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="txtNombre" disabled>
                                    <div class="invalid-feedback">
                                        Completar campo
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtTelefono" class="form-label">Telefono</label>
                                    <input type="text" class="form-control" id="txtTelefono" disabled>
                                    <div class="invalid-feedback">
                                        Completar campo
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="txtDireccion" class="form-label">Direccion</label>
                                    <input type="text" class="form-control" id="txtDireccion" disabled>
                                    <div class="invalid-feedback">
                                        Completar campo
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="txtEmail" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="txtEmail" disabled>
                                    <div class="invalid-feedback">
                                        Completar campo
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mt-2">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="txtProducto" class="form-label">Código Producto</label>
                                    <!-- <select id="cboProducto" data-live-search="true" class="form-control">
                                    </select> -->
                                    <input type="text" class="form-control" id="txtProducto" required list="dlProducto" autocomplete="off">
                                    <datalist id="dlProducto" >
                                    </datalist>
                                    <div class="invalid-feedback">
                                        Completar campo
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <table id="tblVentaDetalle">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mt-1 mb-1">
                                    <label for="cboTipoDocumentoVenta" class="form-label">Documento</label>
                                    <select id="cboTipoDocumentoVenta" data-live-search="true" class="form-control">
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtTotal" class="form-label">Total</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" class="form-control" id="txtTotal" disabled>
                                </div>
                                <div class="col-md-12 mt-4 d-flex justify-content-center">
                                    <button class="btn btn-primary" id="btnGuardar">Registrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <div class="modal" tabindex="-1" id="mdlCliente">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tCliente">Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-2 mb-2">
                            <div class="col-md-4">
                                <label for="txtNumeroDocumento" class="form-label">Número Documento</label>
                                <input type="text" class="form-control" id="txtNumeroDocumento" maxlength="11" required>
                                <div class="invalid-feedback">
                                    Completar campo
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="txtNombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="txtNombre" required>
                                <div class="invalid-feedback">
                                    Completar campo
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="txtDireccion" class="form-label">Direccion</label>
                                <input type="text" class="form-control" id="txtDireccion">
                                <div class="invalid-feedback">
                                    Completar campo
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="txtEmail" class="form-label">Email</label>
                                <input type="text" class="form-control" id="txtEmail" required>
                                <div class="invalid-feedback">
                                    Completar campo
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="txtTelefono" class="form-label">Telefono</label>
                                <input type="text" class="form-control" id="txtTelefono">
                                <div class="invalid-feedback">
                                    Completar campo
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btnGuardar">Registrar</button>
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
    <script src="./public/js/main.js"></script>
    <script src="./public/js/venta.js"></script>


</body>

</html>