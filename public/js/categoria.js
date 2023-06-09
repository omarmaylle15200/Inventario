
var tblCategoria = document.getElementById("tblCategoria");
var tblCategoriaData

const btnNuevo = document.getElementById("btnNuevo")
const tCategoria = document.getElementById("tCategoria")

const txtNombre = document.getElementById("txtNombre");
const txtDescripcion = document.getElementById("txtDescripcion");
const cboEsActivo = document.getElementById("cboEsActivo");
const divActivo = document.getElementById("divActivo");

const btnGuardar = document.getElementById("btnGuardar")

var mdlCategoria = new bootstrap.Modal(document.getElementById("mdlCategoria"), {});

var idCategoria = 0;

document.addEventListener("DOMContentLoaded", async function (event) {
  limpiar();

  inicializarTabla();
  let categorias = await obtenerTodos();
  pintarTablaCategoria(categorias);
});


async function obtenerTodos() {
  let request = await fetch(`./categoria/obtenerTodos`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}
async function pintarTablaCategoria(categorias) {

  if (tblCategoriaData) tblCategoriaData.destroy()
  inicializarTabla();

  for (const categoria of categorias) {
    let item = []
    item.push(categoria.codigo)
    item.push(categoria.nombre)
    item.push(categoria.descripcion)
    item.push(`<div class="d-flex justify-content-center">
    <button class="btn btn-${(categoria.esActivo ? "success" : "danger")}">${(categoria.esActivo ? "Activo" : "Desactivo")}</button>
    </div>`)
    item.push(`<div class="d-flex justify-content-center">
      <button class="btn btn-warning btn-mini" onClick="editar(${categoria.idCategoria})"><i class="fa-solid fa-pen-to-square"></i></button>
    </div>`)
    tblCategoriaData.rows.add(item);
  }
}
function inicializarTabla() {
  tblCategoriaData = new simpleDatatables.DataTable(tblCategoria, {
    data: {
      "headings": [
        "Código",
        "Nombre",
        "Descripción",
        "Estado",
        ""
      ],
      "data": [
      ]
    }
  });
}
async function editar(id) {
  idCategoria = id;
  limpiar();

  let categoria = await obtenerPorId();
  txtNombre.value = categoria.nombre;
  txtDescripcion.value = categoria.descripcion;
  cboEsActivo.value = categoria.esActivo ? 1 : 0;

  mdlCategoria.show();
}

async function obtenerPorId() {
  let request = await fetch(`./categoria/obtenerPorId`, {
    method: 'POST',
    body: JSON.stringify({
      idCategoria: idCategoria
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

  txtNombre.value = ""
  txtDescripcion.value = ""
  cboEsActivo.value = 0;
  
  txtNombre.classList.remove("is-invalid")
  txtDescripcion.classList.remove("is-invalid")

  if (idCategoria == 0) {
    divActivo.style.display="none";
    tCategoria.innerText = "Nuevo";
    btnGuardar.innerText = "Registrar";
    return;
  }
  divActivo.style.display="block";
  tCategoria.innerText = "Edición";
  btnGuardar.innerText = "Modificar";
}

async function registrar(categoria) {
  let request = await fetch(`./categoria/registrar`, {
    method: 'POST',
    body: JSON.stringify(categoria),
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}

async function modificar(categoria) {
  let request = await fetch(`./categoria/modificar`, {
    method: 'POST',
    body: JSON.stringify(categoria),
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
  idCategoria = 0;
  limpiar();
  mdlCategoria.show();
})

btnGuardar.addEventListener("click", async function (e) {

  let categoria = {
    idCategoria: idCategoria,
    nombre: txtNombre.value,
    descripcion: txtDescripcion.value,
    esActivo: cboEsActivo.value == 1 ? true : false,
    idUsuarioRegistro: usuario.idUsuario,
    idUsuarioModificacion: usuario.idUsuario
  }

  if ((await validar()).length > 0) return;

  const willSave = await swal({
    title: `${idCategoria == 0 ? "Registrar" : "Modificar"}`,
    text: `¿Estás seguro de que deseas ${idCategoria == 0 ? "registrar" : "modificar"} categoría?`,
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
  if (idCategoria == 0) response = await registrar(categoria)
  else response = await modificar(categoria)

  if (!response.status) {
    swal("", response.message, "warning");
    return;
  }
  swal("", response.message, "success");
  mdlCategoria.hide();

  let categorias = await obtenerTodos();
  pintarTablaCategoria(categorias);

})