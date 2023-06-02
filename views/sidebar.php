 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

   <ul class="sidebar-nav" id="sidebar-nav">

     <li class="nav-item">
       <a class="nav-link " href="<?php echo constant('URL'); ?>main">
         <i class="bi bi-grid"></i>
         <span>Inicio</span>
       </a>
     </li>

     <li class="nav-item">
       <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
         <i class="bi bi-menu-button-wide"></i><span>Mantenedor</span><i class="bi bi-chevron-down ms-auto"></i>
       </a>
       <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
         <li>
           <a href="<?php echo constant('URL'); ?>categoria">
             <i class="bi bi-circle"></i><span>Categoria</span>
           </a>
         </li>
         <li>
           <a href="<?php echo constant('URL'); ?>proveedor">
             <i class="bi bi-circle"></i><span>Proveedor</span>
           </a>
         </li>
         <li>
           <a href="<?php echo constant('URL'); ?>producto">
             <i class="bi bi-circle"></i><span>Producto</span>
           </a>
         </li>
         <li>
           <a href="<?php echo constant('URL'); ?>cliente">
             <i class="bi bi-circle"></i><span>Cliente</span>
           </a>
         </li>
       </ul>
     </li>
     <li class="nav-item">
       <a class="nav-link collapsed" data-bs-target="#components-nav2" data-bs-toggle="collapse" href="#">
         <i class="bi bi-menu-button-wide"></i><span>Venta</span><i class="bi bi-chevron-down ms-auto"></i>
       </a>
       <ul id="components-nav2" class="nav-content collapse " data-bs-parent="#sidebar-nav2">
         <li>
           <a href="<?php echo constant('URL'); ?>venta/nuevo">
             <i class="bi bi-circle"></i><span>nueva</span>
           </a>
         </li>
         <li>
           <a href="<?php echo constant('URL'); ?>venta">
             <i class="bi bi-circle"></i><span>ventas</span>
           </a>
         </li>
       </ul>
     </li>

   </ul>

 </aside><!-- End Sidebar-->