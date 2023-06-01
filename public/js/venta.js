var tblVentaDetalle = document.getElementById("tblVentaDetalle");
var tblVentaDetalleData

const txtNumeroDocumento = document.getElementById("txtNumeroDocumento");
const txtNombre = document.getElementById("txtNombre");
const txtDireccion = document.getElementById("txtDireccion");
const txtEmail = document.getElementById("txtEmail");
const txtTelefono = document.getElementById("txtTelefono");

const txtProducto = document.getElementById("txtProducto");
const dlProducto = document.getElementById("dlProducto");
//const cboProducto= document.getElementById("cboProducto");

const cboTipoDocumentoVenta = document.getElementById("cboTipoDocumentoVenta");
const txtTotal = document.getElementById("txtTotal");
const btnGuardar = document.getElementById("btnGuardar")

var mdlCliente = new bootstrap.Modal(document.getElementById("mdlCliente"), {});

var productos = []
var total=0.00;

document.addEventListener("DOMContentLoaded", async function (event) {

  inicializarTablaVentaDetalle();

  let tiposDocumentoVenta=await obtenerTiposDocumentoVenta();
  pintarTiposDocumentoVenta(tiposDocumentoVenta);

  limpiar();

});

function pintarTablaProducto() {
  if (tblVentaDetalle) tblVentaDetalleData.destroy()
  inicializarTablaVentaDetalle();
  let position = 1;
  total=0.00
  for (const producto of productos) {
    let item = []
    let subtotal=Number.parseFloat(producto.cantidad*producto.precioVenta).toFixed(2)
    item.push(position)
    item.push(producto.codigo)
    item.push(producto.nombre)
    item.push(producto.cantidad)
    item.push(producto.precioVenta)
    item.push(subtotal)
    item.push(`<div class="d-flex justify-content-center">
      <button class="btn btn-danger" onclick="eliminarProducto('${producto.codigo}')"><i class="fa-sharp fa-solid fa-trash"></i></button>
    </div>`)
    tblVentaDetalleData.rows.add(item);
    position++
    total+=Number.parseFloat(subtotal)
  }
  txtTotal.value=total;
}

function inicializarTablaVentaDetalle() {
  tblVentaDetalleData = new simpleDatatables.DataTable(tblVentaDetalle, {
    data: {
      "headings": [
        "Item",
        "Código",
        "Nombre",
        "Cantidad",
        "Precio Venta",
        "Sub Total",
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
  txtNumeroDocumento.value = producto.codigo
  txtNombre.value = producto.nombre
  txtDireccion.value = producto.descripcion
  txtEmail.value = producto.precioCompra
  txtTelefono.value = producto.precioVenta
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

  txtNumeroDocumento.value = ""
  txtNombre.value = ""
  txtDireccion.value = ""
  txtEmail.value = ""
  txtTelefono.value = ""


  // $('#cboProducto').selectpicker('destroy');;
  // cboProducto.value = null;
  // selectPicker('#cboProducto');
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

async function obtenerClientePorNumeroDocumento(numeroDocumento) {
  let request = await fetch(`./cliente/obtenerPorNumeroDocumento`, {
    method: 'POST',
    body: JSON.stringify({
      numeroDocumento: numeroDocumento
    }),
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}
async function obtenerProductosPorValor(valor) {
  let request = await fetch(`./producto/obtenerPorValor`, {
    method: 'POST',
    body: JSON.stringify({
      valor: valor
    }),
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}

async function obtenerProductos() {
  let request = await fetch(`./producto/obtenerActivos`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}

function pintarProductos(productos) {
  cboProducto.innerHTML = ""
  for (const producto of productos) {
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode(`${producto.codigo} / ${producto.nombre} / ${producto.cantidad}`));
    opt.value = producto.idProducto;
    cboProducto.appendChild(opt);
  }
}

async function obtenerProductoPorCodigo(codigo) {
  let request = await fetch(`./producto/obtenerPorCodigo`, {
    method: 'POST',
    body: JSON.stringify({
      codigoProducto: codigo
    }),
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}

function eliminarProducto(codigoProducto) {
  productos = productos.filter(item => item.codigo != codigoProducto)
  pintarTablaProducto();
}

const selectPicker = (cbo) => {
  $(cbo).selectpicker({
    noneSelectedText: ':: Seleccionar ::',
    selectAllText: 'Todos',
    deselectAllText: 'Ninguno',
    actionsBox: true,
    noneResultsText: 'Sin Resultados',
    size: 5
  });
}

async function obtenerTiposDocumentoVenta() {
  let request = await fetch(`./venta/obtenerTiposDocumentoVenta`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}

function pintarTiposDocumentoVenta(tiposDocumentoVenta) {
  cboTipoDocumentoVenta.innerHTML = ""
  for (const tipoDocumentoVenta of tiposDocumentoVenta) {
    var opt = document.createElement("option");
    opt.appendChild(document.createTextNode(`${tipoDocumentoVenta.descripcion}`));
    opt.value = tipoDocumentoVenta.idTipoDocumentoVenta;
    cboTipoDocumentoVenta.appendChild(opt);
  }
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

btnGuardar.addEventListener("click", async function (e) {
  let producto = {
    idTipoDocumentoVenta: cboTipoDocumentoVenta.value,
    idCliente: txtNombre.value,
    total: 0,
    idUsuarioRegistro: usuario.idUsuario,
    ventaDetalle: []
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

txtNumeroDocumento.addEventListener("keypress", async function (e) {
  let key = e.keyCode || e.charCode || e.which;

  if (key != 13) {
    soloNumero(e)
    sinEspacio(e)
  }

  if (key == 13) {
    let cliente = await obtenerClientePorNumeroDocumento(txtNumeroDocumento.value);
    if (cliente.idCliente == null) {
      swal("", "Cliente no existe", "info");
      return
    }
    txtNombre.value = cliente.nombre;
    txtDireccion.value = cliente.direccion;
    txtEmail.value = cliente.email;
    txtTelefono.value = cliente.telefono;
  }
})


txtProducto.addEventListener("keyup", async function (e) {
  let key = e.keyCode || e.charCode || e.which;
  if (key == undefined) return;

  dlProducto.innerHTML = "";
  let productos = await obtenerProductosPorValor(txtProducto.value);
  productos.forEach(function (item) {
    var option = document.createElement('option');
    option.value = `${item.codigo}/${item.nombre}`;
    option.setAttribute("data-id", item.idProducto)
    dlProducto.appendChild(option);
  });
})
txtProducto.addEventListener("change", async function (e) {
  let productoValue = txtProducto.value.split('/')

  let producto = await obtenerProductoPorCodigo(productoValue[0]);

  txtProducto.value = "";
  let cantidad = await swal({
    title: `Cantidad`,
    content: {
      element: 'input',
      attributes: {
        type: "number",
        max: producto.cantidad
      }
    }
  });
  if (cantidad=="") {
    swal("", "Debe ingresar cantidad", "info");
    return
  }
  if (cantidad > producto.cantidad) {
    swal("", "Cantidad excede actual", "info");
    return
  }

  producto.cantidad=cantidad;
  productos.push(producto)
  pintarTablaProducto();

})