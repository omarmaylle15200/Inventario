
var tblCliente = document.getElementById("tblCliente");
var tblClienteData

const btnNuevo = document.getElementById("btnNuevo")
const tCliente = document.getElementById("tCliente")

const txtNumeroDocumento= document.getElementById("txtNumeroDocumento");
const txtNombre = document.getElementById("txtNombre");
const txtDireccion = document.getElementById("txtDireccion");
const txtEmail = document.getElementById("txtEmail");
const txtTelefono = document.getElementById("txtTelefono");
const cboEsActivo = document.getElementById("cboEsActivo");
const divActivo = document.getElementById("divActivo");

const btnGuardar = document.getElementById("btnGuardar")

var mdlCliente = new bootstrap.Modal(document.getElementById("mdlCliente"), {});

var idCliente = 0;

document.addEventListener("DOMContentLoaded", async function (event) {
  limpiar();

  inicializarTabla();
  let clientes = await obtenerTodos();
  pintarTablaCliente(clientes);
});


async function obtenerTodos() {
  let request = await fetch(`./cliente/obtenerTodos`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}
async function pintarTablaCliente(clientes) {

  if (tblClienteData) tblClienteData.destroy()
  inicializarTabla();

  for (const cliente of clientes) {
    let item = []
    item.push(cliente.numeroDocumento)
    item.push(cliente.nombre)
    item.push(cliente.direccion)
    item.push(cliente.email)
    item.push(cliente.telefono)
    item.push(`<div class="d-flex justify-content-center">
    <button class="btn btn-${(cliente.esActivo ? "success" : "danger")}">${(cliente.esActivo ? "Activo" : "Desactivo")}</button>
    </div>`)
    item.push(`<div class="d-flex justify-content-center">
      <button class="btn btn-warning btn-mini" onClick="editar(${cliente.idCliente})"><i class="fa-solid fa-pen-to-square"></i></button>
    </div>`)
    tblClienteData.rows.add(item);
  }
}
function inicializarTabla() {
  tblClienteData = new simpleDatatables.DataTable(tblCliente, {
    data: {
      "headings": [
        "Número Documento",
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
  idCliente = id;
  limpiar();

  let cliente = await obtenerPorId();
  txtNumeroDocumento.value = cliente.numeroDocumento;
  txtNombre.value = cliente.nombre;
  txtDireccion.value = cliente.direccion;
  txtEmail.value = cliente.email;
  txtTelefono.value = cliente.telefono;
  cboEsActivo.value = cliente.esActivo ? 1 : 0;

  mdlCliente.show();
}

async function obtenerPorId() {
  let request = await fetch(`./cliente/obtenerPorId`, {
    method: 'POST',
    body: JSON.stringify({
      idCliente: idCliente
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

  if (idCliente == 0) {
    divActivo.style.display="none";
    tCliente.innerText = "Nuevo";
    btnGuardar.innerText = "Registrar";
    return;
  }
  divActivo.style.display="block";
  tCliente.innerText = "Edición";
  btnGuardar.innerText = "Modificar";
}

async function registrar(cliente) {
  let request = await fetch(`./cliente/registrar`, {
    method: 'POST',
    body: JSON.stringify(cliente),
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}

async function modificar(cliente) {
  let request = await fetch(`./cliente/modificar`, {
    method: 'POST',
    body: JSON.stringify(cliente),
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
  idCliente = 0;
  limpiar();
  mdlCliente.show();
})

btnGuardar.addEventListener("click", async function (e) {

  let cliente = {
    idCliente: idCliente,
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
    title: `${idCliente == 0 ? "Registrar" : "Modificar"}`,
    text: `¿Estás seguro de que deseas ${idCliente == 0 ? "registrar" : "modificar"} cliente?`,
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
  if (idCliente == 0) response = await registrar(cliente)
  else response = await modificar(cliente)

  if (!response.status) {
    swal("", response.message, "warning");
    return;
  }
  swal("", response.message, "success");
  mdlCliente.hide();

  let clientes = await obtenerTodos();
  pintarTablaCliente(clientes);

})