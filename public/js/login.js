
const btnIniciarSesion = document.getElementById("btnIniciarSesion");

document.addEventListener("DOMContentLoaded", async function (event) {

  console.log("d")

});

btnIniciarSesion.addEventListener("click", function (e) {
  e.preventDefault();
  iniciarSesion()
})

async function iniciarSesion() {
  let request = await fetch(`./login/authenticate`, {
    method: 'POST',
    body: JSON.stringify({
      numeroDocumento: "omar",
      clave: ""
    }),
    headers: {
      'Content-Type': 'application/json'
    }
  });
  console.log(await request.text())

}