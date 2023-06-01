
var tblProducto = document.getElementById("tblProducto");
var tblProductoData

const btnNuevo = document.getElementById("btnNuevo")
const tProducto = document.getElementById("tProducto")

const txtCodigo = document.getElementById("txtCodigo");
const txtNombre = document.getElementById("txtNombre");
const txtDescripcion = document.getElementById("txtDescripcion");
const txtPrecioCompra = document.getElementById("txtPrecioCompra");
const txtPrecioVenta = document.getElementById("txtPrecioVenta");
const txtCantidad = document.getElementById("txtCantidad");
const cboCategoria = document.getElementById("cboCategoria");
const cboProveedor = document.getElementById("cboProveedor");
const cboEsActivo = document.getElementById("cboEsActivo");
const divActivo = document.getElementById("divActivo");

const btnGuardar = document.getElementById("btnGuardar")

var mdlProducto = new bootstrap.Modal(document.getElementById("mdlProducto"), {});

var idProducto = 0;

document.addEventListener("DOMContentLoaded", async function (event) {
  selectPicker('#cboCategoria');
  selectPicker('#cboProveedor');

  inicializarTabla();
  let productos = await obtenerTodos();
  pintarTablaProducto(productos);

  let categorias = await obtenerCategorias();
  pintarCategorias(categorias);
  $("#cboCategoria").selectpicker("refresh");

  let proveedores = await obtenerProveedores();
  pintarProveedores(proveedores);
  $("#cboProveedor").selectpicker("refresh");

  limpiar();
});


async function obtenerTodos() {
  let request = await fetch(`./producto/obtenerTodos`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}

function pintarTablaProducto(productos) {

  if (tblProductoData) tblProductoData.destroy()
  inicializarTabla();

  for (const producto of productos) {
    let item = []
    item.push(producto.codigo)
    item.push(producto.nombre)
    item.push(producto.descripcion)
    item.push(producto.precioCompra)
    item.push(producto.precioVenta)
    item.push(producto.cantidad)
    item.push(`<div class="d-flex justify-content-center">
    <button class="btn btn-${(producto.esActivo ? "success" : "danger")}">${(producto.esActivo ? "Activo" : "Desactivo")}</button>
    </div>`)
    item.push(`<div class="d-flex justify-content-center">
      <button class="btn btn-warning btn-mini" onClick="editar(${producto.idProducto})"><i class="fa-solid fa-pen-to-square"></i></button>
    </div>`)
    tblProductoData.rows.add(item);
  }
}

function inicializarTabla() {
  tblProductoData = new simpleDatatables.DataTable(tblProducto, {
    data: {
      "headings": [
        "Código",
        "Nombre",
        "Descripción",
        "Precio Compra",
        "Precio Venta",
        "Cantidad",
        "Estado",
        ""
      ],
      "data": [
      ]
    }
  });
}
async function editar(id) {
  idProducto = id;
  limpiar();

  let producto = await obtenerPorId();
  txtCodigo.value = producto.codigo
  txtNombre.value = producto.nombre
  txtDescripcion.value = producto.descripcion
  txtPrecioCompra.value = producto.precioCompra
  txtPrecioVenta.value = producto.precioVenta
  txtCantidad.value = producto.cantidad
  $('#cboCategoria').selectpicker('destroy');;
  cboCategoria.value = producto.idCategoria;
  selectPicker('#cboCategoria');
  $('#cboProveedor').selectpicker('destroy');;
  cboProveedor.value = producto.idProveedor;
  selectPicker('#cboProveedor');
  cboEsActivo.value = producto.esActivo ? 1 : 0;

  mdlProducto.show();
}

async function obtenerPorId() {
  let request = await fetch(`./producto/obtenerPorId`, {
    method: 'POST',
    body: JSON.stringify({
      idProducto: idProducto
    }),
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}

function validar() {
  let lstRequired = []
  var controles = document.querySelectorAll("[required]");
  controles.forEach(control => {
    if (control.value == "") {
      lstRequired.push(true);
      control.classList.add("is-invalid");
      if (control.tagName == 'SELECT') control.parentNode.classList.add("is-invalid");
      return;
    }
    control.classList.remove("is-invalid");
    if (control.tagName == 'SELECT') control.parentNode.classList.remove("is-invalid");
  });
  return lstRequired;
}

function validarControl(e) {
  if (e.value == "") {
    e.classList.add("is-invalid");
    if (e.tagName == 'SELECT') e.parentNode.classList.add("is-invalid");
    return;
  }
  e.classList.remove("is-invalid");
  if (e.tagName == 'SELECT') e.parentNode.classList.remove("is-invalid");
}

function limpiar() {

  txtCodigo.value = ""
  txtNombre.value = ""
  txtDescripcion.value = ""
  txtPrecioCompra.value = ""
  txtPrecioVenta.value = ""
  txtCantidad.value = ""
  cboEsActivo.value = 0;

  $('#cboCategoria').selectpicker('destroy');;
  cboCategoria.value = null;
  selectPicker('#cboCategoria');
  $('#cboProveedor').selectpicker('destroy');;
  cboProveedor.value = null;
  selectPicker('#cboProveedor');


  txtCodigo.classList.remove("is-invalid")
  txtNombre.classList.remove("is-invalid")
  txtDescripcion.classList.remove("is-invalid")
  txtPrecioCompra.classList.remove("is-invalid")
  txtPrecioVenta.classList.remove("is-invalid")
  txtCantidad.classList.remove("is-invalid")

  if (idProducto == 0) {
    divActivo.style.display = "none";
    tProducto.innerText = "Nuevo";
    btnGuardar.innerText = "Registrar";
    return;
  }
  divActivo.style.display = "block";
  tProducto.innerText = "Edición";
  btnGuardar.innerText = "Modificar";
}

async function registrar(producto) {
  let request = await fetch(`./producto/registrar`, {
    method: 'POST',
    body: JSON.stringify(producto),
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}

async function modificar(producto) {
  let request = await fetch(`./producto/modificar`, {
    method: 'POST',
    body: JSON.stringify(producto),
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}

async function obtenerCategorias() {
  let request = await fetch(`./categoria/obtenerActivos`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}
function pintarCategorias(categorias) {
  cboCategoria.innerHTML = ""
  for (const categoria of categorias) {
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode(`${categoria.nombre}`));
    opt.value = categoria.idCategoria;
    cboCategoria.appendChild(opt);
  }
}
async function obtenerProveedores() {
  let request = await fetch(`./proveedor/obtenerActivos`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}
function pintarProveedores(proveedores) {
  cboProveedor.innerHTML = ""
  for (const proveedor of proveedores) {
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode(`${proveedor.nombre}`));
    opt.value = proveedor.idProveedor;
    cboProveedor.appendChild(opt);
  }
}

const selectPicker = (cbo) => {
  $(cbo).selectpicker({
    noneSelectedText: ':: Seleccionar ::',
    selectAllText: 'Todos',
    deselectAllText: 'Ninguno',
    actionsBox: true,
    noneResultsText: 'Sin Resultados'
  });
}

//Eventos
var controles = document.querySelectorAll("[required]");
controles.forEach(control => {
  control.addEventListener("keyup", function (e) {
    validarControl(e.target);
  })
  control.addEventListener("change", function (e) {
    validarControl(e.target);
  })
});

btnNuevo.addEventListener("click", async function (e) {
  idProducto = 0;
  limpiar();
  mdlProducto.show();
})

btnGuardar.addEventListener("click", async function (e) {
  let producto = {
    idProducto: idProducto,
    codigo: txtCodigo.value,
    nombre: txtNombre.value,
    descripcion: txtDescripcion.value,
    precioCompra: txtPrecioCompra.value,
    precioVenta: txtPrecioVenta.value,
    cantidad: txtCantidad.value,
    idCategoria: cboCategoria.value,
    idProveedor: cboProveedor.value,
    esActivo: cboEsActivo.value == 1 ? true : false,
    idUsuarioRegistro: usuario.idUsuario,
    idUsuarioModificacion: usuario.idUsuario
  }

  if ((validar()).length > 0) return;

  const willSave = await swal({
    title: `${idProducto == 0 ? "Registrar" : "Modificar"}`,
    text: `¿Estás seguro de que deseas ${idProducto == 0 ? "registrar" : "modificar"} producto?`,
    icon: "info",
    buttons: {
      cancel: {
        text: "Cancelar",
        value: false,
        visible: true,
        closeModal: true,
      },
      confirm: {
        text: "OK",
        value: true,
        visible: true,
        closeModal: true
      },
    }
  });

  if (!willSave) return;

  let response;
  if (idProducto == 0) response = await registrar(producto)
  else response = await modificar(producto)

  if (!response.status) {
    swal("", response.message, "warning");
    return;
  }
  swal("", response.message, "success");
  mdlProducto.hide();

  let productos = await obtenerTodos();
  pintarTablaProducto(productos);

})