
var tblCategoria = document.getElementById("tblCategoria");
var tblCategoriaData
var mdlCategoria = new bootstrap.Modal(document.getElementById("mdlCategoria"), {});

var idCategoria=0;

document.addEventListener("DOMContentLoaded", async function (event) {
  await inicializarTabla();
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
  for (const categoria of categorias) {
    let item = []
    item.push(categoria.codigo)
    item.push(categoria.nombre)
    item.push(categoria.descripcion)
    item.push(categoria.esActivo?"Activo":"Desactivo")
    item.push(`<div class="d-flex justify-content-center">
      <button class="btn btn-warning btn-mini" onClick="editar(${categoria.idCategoria})"><i class="fa-solid fa-pen-to-square"></i></button>
    </div>`)
    tblCategoriaData.rows.add(item);
  }
}
async function inicializarTabla() {
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
async function editar(id){
  idCategoria=id;

  let categoria=await obtenerPorId();
  

  mdlCategoria.show();
}

async function obtenerPorId() {
  let request = await fetch(`./categoria/obtenerTodos`, {
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

async function validar(){



}
async function validarControl(){
  
  

}
var controles=document.querySelectorAll("[required]");
controles.forEach(control => {
  control.addEventListener("keyup",function(e){

  })
});