<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="assets/img/logo.png" alt="">
      <span class="d-none d-lg-block">Inventario</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li>

      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <span class="d-none d-md-block dropdown-toggle ps-2" id="spUsuario">K. Anderson</span>
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header" style="display: none;">
            <h6 id="hUsuario"></h6>
            <span id="spPerfil"></span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <div class="d-grid gap-1">
              <button class="btn btn-secondary btn-block" id="btnSalir">
                <i class="bi bi-box-arrow-right"></i>
                <span>Salir</span>
              </button>
            </div>
          </li>
        </ul>
      </li>

    </ul>
  </nav>

</header>