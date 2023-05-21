
const btnIniciarSesion = document.getElementById("btnIniciarSesion");
const txtUsuario = document.getElementById("txtUsuario");
const txtClave = document.getElementById("txtClave");

document.addEventListener("DOMContentLoaded", async function (event) {

});

btnIniciarSesion.addEventListener("click", function (e) {

  if(txtUsuario.value==""){
    swal("Completar campo usuario","","info");
    return;
  }
  if(txtClave.value==""){
    swal("Completar campo clave","","info");
    return;
  }
  iniciarSesion()
})

async function iniciarSesion() {
  let request = await fetch(`./login/authenticate`, {
    method: 'POST',
    body: JSON.stringify({
      numeroDocumento: txtUsuario.value,
      clave: txtClave.value
    }),
    headers: {
      'Content-Type': 'application/json'
    }
  });
  console.log(await request.json())

}

txtClave.addEventListener("keypress",function(e){
  let key=e.keyCode||e.charCode || e.which;
  if(key==32){
    e.preventDefault();
  }  
})

txtUsuario.addEventListener("keypress",function(e){
  let key=e.keyCode||e.charCode || e.which;
  if(key==32){
    e.preventDefault();
  } 
  if(key<48 || key>57){
    e.preventDefault();
  }   
})
