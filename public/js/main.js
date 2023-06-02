const usuario = JSON.parse(localStorage.getItem("usuario"))
const spUsuario = document.getElementById("spUsuario")
const hUsuario = document.getElementById("hUsuario")
const spPerfil = document.getElementById("spPerfil")

const btnSalir = document.getElementById("btnSalir")

var URLHost = window.location.protocol + "//" + window.location.host + "/Inventario";

document.addEventListener("DOMContentLoaded", async function (event) {
  spUsuario.innerHTML = `${usuario.nombre} ${usuario.apellidoPaterno} ${usuario.apellidoMaterno}`;
  hUsuario.innerHTML = ``;
  spPerfil.innerHTML = ``;

});

btnSalir.addEventListener("click", async function (e) {

  const close = await swal({
    title: `Salir`,
    text: `¿Estás seguro de que deseas salir`,
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
  if (!close) return;

  location.href = `${URLHost}`;

})

function soloNumero(e) {
  key = e.keyCode || e.which || e.keyCode
  if (key < 48 || key > 57) {
    e.preventDefault()
    return false;
  }
  return true;
}

function sinEspacio(e) {
  key = e.keyCode || e.which || e.keyCode
  if (key == 32) {
    e.preventDefault()
    return false;
  }
  return true;
}

(function () {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach(e => e.addEventListener(type, listener))
    } else {
      select(el, all).addEventListener(type, listener)
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Sidebar toggle
   */
  if (select('.toggle-sidebar-btn')) {
    on('click', '.toggle-sidebar-btn', function (e) {
      select('body').classList.toggle('toggle-sidebar')
    })
  }

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Initiate tooltips
   */
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })

})();