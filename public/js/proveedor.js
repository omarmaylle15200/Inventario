
var tblProveedor = document.getElementById("tblProveedor");
var tblProveedorData

const btnNuevo = document.getElementById("btnNuevo")
const tProveedor = document.getElementById("tProveedor")

const txtNumeroDocumento= document.getElementById("txtNumeroDocumento");
const txtNombre = document.getElementById("txtNombre");
const txtDireccion = document.getElementById("txtDireccion");
const txtEmail = document.getElementById("txtEmail");
const txtTelefono = document.getElementById("txtTelefono");
const cboEsActivo = document.getElementById("cboEsActivo");
const divActivo = document.getElementById("divActivo");

const btnGuardar = document.getElementById("btnGuardar")

var mdlProveedor = new bootstrap.Modal(document.getElementById("mdlProveedor"), {});

var idProveedor = 0;

document.addEventListener("DOMContentLoaded", async function (event) {
  limpiar();

  inicializarTabla();
  let proveedores = await obtenerTodos();
  pintarTablaProveedor(proveedores);
});


async function obtenerTodos() {
  let request = await fetch(`./proveedor/obtenerTodos`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}
async function pintarTablaProveedor(proveedores) {

  if (tblProveedorData) tblProveedorData.destroy()
  inicializarTabla();

  for (const proveedor of proveedores) {
    let item = []
    item.push(proveedor.numeroDocumento)
    item.push(proveedor.nombre)
    item.push(proveedor.direccion)
    item.push(proveedor.email)
    item.push(proveedor.telefono)
    item.push(`<div class="d-flex justify-content-center">
    <button class="btn btn-${(proveedor.esActivo ? "success" : "danger")}">${(proveedor.esActivo ? "Activo" : "Desactivo")}</button>
    </div>`)
    item.push(`<div class="d-flex justify-content-center">
      <button class="btn btn-warning btn-mini" onClick="editar(${proveedor.idProveedor})"><i class="fa-solid fa-pen-to-square"></i></button>
    </div>`)
    tblProveedorData.rows.add(item);
  }
}
function inicializarTabla() {
  tblProveedorData = new simpleDatatables.DataTable(tblProveedor, {
    data: {
      "headings": [
        "RUC",
        "Nombre",
        "Direccion",
        "Email",
        "Telefono",
        "Estado",
        ""
      ],
      "data": [
      ]
    }
  });
}
async function editar(id) {
  idProveedor = id;
  limpiar();

  let proveedor = await obtenerPorId();
  txtNumeroDocumento.value = proveedor.numeroDocumento;
  txtNombre.value = proveedor.nombre;
  txtDireccion.value = proveedor.direccion;
  txtEmail.value = proveedor.email;
  txtTelefono.value = proveedor.telefono;
  cboEsActivo.value = proveedor.esActivo ? 1 : 0;

  mdlProveedor.show();
}

async function obtenerPorId() {
  let request = await fetch(`./proveedor/obtenerPorId`, {
    method: 'POST',
    body: JSON.stringify({
      idProveedor: idProveedor
    }),
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}

async function validar() {
  let lstRequired = []
  var controles = document.querySelectorAll("[required]");
  controles.forEach(control => {
    if (control.value == "") {
      lstRequired.push(true);
      control.classList.add("is-invalid");
      return;
    }
    control.classList.remove("is-invalid");
  });
  return lstRequired;
}
async function validarControl(e) {
  if (e.value == "") {
    e.classList.add("is-invalid");
    return;
  }
  e.classList.remove("is-invalid");
}

function limpiar() {

  txtNumeroDocumento.value = ""
  txtNombre.value = ""
  txtDireccion.value = ""
  txtEmail.value = ""
  txtTelefono.value = ""
  cboEsActivo.value = 0;
  
  txtNumeroDocumento.classList.remove("is-invalid")
  txtNombre.classList.remove("is-invalid")
  txtEmail.classList.remove("is-invalid")

  if (idProveedor == 0) {
    divActivo.style.display="none";
    tProveedor.innerText = "Nuevo";
    btnGuardar.innerText = "Registrar";
    return;
  }
  divActivo.style.display="block";
  tProveedor.innerText = "Edición";
  btnGuardar.innerText = "Modificar";
}

async function registrar(proveedor) {
  let request = await fetch(`./proveedor/registrar`, {
    method: 'POST',
    body: JSON.stringify(proveedor),
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}

async function modificar(proveedor) {
  let request = await fetch(`./proveedor/modificar`, {
    method: 'POST',
    body: JSON.stringify(proveedor),
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}
//Eventos
var controles = document.querySelectorAll("[required]");
controles.forEach(control => {
  control.addEventListener("keyup", function (e) {
    validarControl(e.target);
  })
});

btnNuevo.addEventListener("click", async function (e) {
  idProveedor = 0;
  limpiar();
  mdlProveedor.show();
})

btnGuardar.addEventListener("click", async function (e) {

  let proveedor = {
    idProveedor: idProveedor,
    numeroDocumento: txtNumeroDocumento.value,
    nombre: txtNombre.value,
    direccion: txtDireccion.value,
    email: txtEmail.value,
    telefono: txtTelefono.value,
    esActivo: cboEsActivo.value == 1 ? true : false,
    idUsuarioRegistro: usuario.idUsuario,
    idUsuarioModificacion: usuario.idUsuario
  }

  if ((await validar()).length > 0) return;

  const willSave = await swal({
    title: `${idProveedor == 0 ? "Registrar" : "Modificar"}`,
    text: `¿Estás seguro de que deseas ${idProveedor == 0 ? "registrar" : "modificar"} proveedor?`,
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
  if (idProveedor == 0) response = await registrar(proveedor)
  else response = await modificar(proveedor)

  if (!response.status) {
    swal("", response.message, "warning");
    return;
  }
  swal("", response.message, "success");
  mdlProveedor.hide();

  let proveedores = await obtenerTodos();
  pintarTablaProveedor(proveedores);

})