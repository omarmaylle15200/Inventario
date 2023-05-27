
var tblCategoria=document.getElementById("tblCategoria");
var tblCategoriaData

document.addEventListener("DOMContentLoaded", async function (event) {
  obtenerTodos();
  inicializarTabla();
});


async function obtenerTodos() {
  let request = await fetch(`./categoria/obtenerTodos`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    }
  });
  console.log(await request.json())
}

async function inicializarTabla(){
  tblCategoriaData = new simpleDatatables.DataTable(tblCategoria);

}
