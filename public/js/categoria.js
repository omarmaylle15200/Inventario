

document.addEventListener("DOMContentLoaded", async function (event) {
  obtenerTodos();
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
