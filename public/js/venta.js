
var tblVenta = document.getElementById("tblVenta");
var tblVentaData

var tblVentaDetalle = document.getElementById("tblVentaDetalle");
var tblVentaDetalleData

var mdlVentaDetalle= new bootstrap.Modal(document.getElementById("mdlVentaDetalle"), {});

var idProducto = 0;

document.addEventListener("DOMContentLoaded", async function (event) {

  inicializarTablaVenta();
  let ventas = await obtenerTodos();
  console.log(ventas)
  pintarTablaVenta(ventas);

});

async function obtenerTodos() {
  let request = await fetch(`./venta/obtenerTodos`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}

function pintarTablaVenta(ventas) {

  if (tblVentaData) tblVentaData.destroy()
  inicializarTablaVenta();

  for (const venta of ventas) {
    let item = []
    item.push(venta.tipoDocumentoVenta.descripcion)
    item.push(venta.idVenta)
    item.push(venta.cliente.nombre)
    item.push(venta.total)
    item.push(venta.fechaRegistro)
    item.push(`<div class="d-flex justify-content-center">
      <button class="btn btn-primary" onclick="verDetalle('${venta.idVenta}')"><i class="fa-sharp fa-solid fa-eye"></i></button>
    </div>`)
    tblVentaData.rows.add(item);
  }
}

function inicializarTablaVenta() {
  tblVentaData = new simpleDatatables.DataTable(tblVenta, {
    data: {
      "headings": [
        "Documento Venta",
        "Numero Venta",
        "Cliente",
        "Total",
        "Fecha Registro",
        ""
      ],
      "data": [
      ]
    }
  });
}

async function obtenerVentaDetalle(idVenta) {
  let request = await fetch(`./venta/obtenerVentaDetalle`, {
    method: 'POST',
    body: JSON.stringify({
      idVenta: idVenta
    }),
    headers: {
      'Content-Type': 'application/json'
    }
  });
  let response = await request.json();
  return response;
}

function pintarTablaVentaDetalle(ventasDetalle) {

  if (tblVentaDetalleData) tblVentaDetalleData.destroy()
  inicializarTablaVentaDetalle();

  for (const ventaDetalle of ventasDetalle) {
    let item = []
    item.push(ventaDetalle.item)
    item.push(`${ventaDetalle.producto.codigo} :: ${ventaDetalle.producto.descripcion}`)
    item.push(ventaDetalle.cantidad)
    item.push(ventaDetalle.precio)
    item.push(ventaDetalle.subTotal)
    tblVentaDetalleData.rows.add(item);
  }
}

function inicializarTablaVentaDetalle() {
  tblVentaDetalleData = new simpleDatatables.DataTable(tblVentaDetalle, {
    data: {
      "headings": [
        "Item",
        "Producto",
        "Cantidad",
        "Precio",
        "Sub Total"
      ],
      "data": [
      ]
    }
  });
}

async function verDetalle(idVenta) {

  let ventasDetalle = await obtenerVentaDetalle(idVenta);
  console.log(ventasDetalle);
  pintarTablaVentaDetalle(ventasDetalle);

  mdlVentaDetalle.show();
}
