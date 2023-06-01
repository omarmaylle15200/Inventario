<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Producto</title>
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
            <div class="row mt-2">
                <div class="col">
                    <button type="button" class="btn btn-primary" id="btnNuevo">Nuevo</button>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <table id="tblProducto">
                    </table>
                </div>
            </div>
        </section>

        <div class="modal" tabindex="-1" id="mdlProducto">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tProducto">Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-2 mb-2">
                            <div class="col-md-4">
                                <label for="txtCodigo" class="form-label">Código</label>
                                <input type="text" class="form-control" id="txtCodigo" maxlength="11" required>
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
                            <div class="col-md-12">
                                <label for="txtDescripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="txtDescripcion" required>
                                <div class="invalid-feedback">
                                    Completar campo
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="txtPrecioCompra" class="form-label">Precio compra</label>
                                <input type="number" class="form-control" id="txtPrecioCompra" required step="0.01" min="0">
                                <div class="invalid-feedback">
                                    Completar campo
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="txtPrecioVenta" class="form-label">Precio Venta</label>
                                <input type="number" class="form-control" id="txtPrecioVenta" required step="0.01" min="0">
                                <div class="invalid-feedback">
                                    Completar campo
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="txtCantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" id="txtCantidad" required>
                                <div class="invalid-feedback">
                                    Completar campo
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="cboCategoria" class="form-label">Categoria</label>
                                <select id="cboCategoria" data-live-search="true" required>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="cboProveedor" class="form-label">Proveedor</label>
                                <select id="cboProveedor" data-live-search="true" required>
                                </select>
                            </div>
                            <div class="col-md-6" id="divActivo">
                                <label for="cboEsActivo" class="form-label">Estado</label>
                                <select class="form-select" id="cboEsActivo">
                                    <option value="1">Activo</option>
                                    <option value="0">Desactivo</option>
                                </select>
                            </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btnGuardar">Registrar</button>
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

    <script src="./public/js/producto.js"></script>


</body>

</html>