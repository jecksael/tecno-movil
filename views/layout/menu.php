<?php


    if(session_status()==2){


    $items = array(
      "0" => array (
        "route" => "/entrada",
        "text"  => "Inicio"
      ),
      "1" => array (
        "route" => "/clientes",
        "text"  => "Clientes"
      ),
    );
    $inventario = array (
      "0" => array (
      "text" => "Inventario"
      )
    );
    $itemInv = array (
      "0" => array (
        "route" => "/inventario/newPro",
        "text"  => "Registrar Producto"),
      "1" => array (
        "route" => "/inventario/listPro",
        "text"  => "Lista de Productos"),
      "2" => array (
        "route" => "/inventario/ajuPre",
        "text"  => "Ajuste de Precios")
    );
    $itemCompra = array (
      "0" => array (
        "route" => "/compras",
        "text"  => "Realizar Compra"),
      "1" => array (
        "route" => "/compras/reporte",
        "text"  => "Reportes de Compras")
    );

    $itemVenta = array (
      "0" => array (
        "route" => "/venta",
        "text"  => "Realizar Venta"),
      "1" => array (
        "route" => "/venta/reporte",
        "text"  => "Reporte de Ventas")
    );

    $itemRepa = array (
      "0" => array (
        "route" => "/reparacion",
        "text"  => "Nueva Reparación"),
      "1" => array (
        "route" => "/reparacion/reparacion_espera",
        "text"  => "Buscar Reparación")
    );

    $itemReporte = array (
      "0" => array (
        "route" => "/reporte/reparacion",
        "text"  => "Reporte de Reparaciones"),
      "1" => array (
        "route" => "/reporte/ganancia",
        "text"  => "Reporte de Ganancias")
    );

  $itemUsuAdmin = array (

    "0" => array (
      "route" => "/usuario/perfil",
      "text"  => "Perfil",
      "class" => "fa fa-user fa-fw"),

    "1" => array (
      "route" => "/usuario",
      "text"  => "Usuarios",
      "class" => "fa fa-users fa-fw"),
    "2" => array (
      "route" => "/empresa",
      "text"  => "Ajuste de la Empresa",
      "class" => "fa fa-cog fa-fw")

  );

  $itemUsuDefa = array (

    "0" => array (
      "route" => "/usuario/perfil",
      "text"  => "Perfil",
      "class" => "fa fa-user fa-fw"),

  );  
  $itemUsuTecn = array (
    "0" => array (
      "route" => "/inventario/listPro",
      "text"  => "Inventario"),
    "1" => array (
      "route" => "/reparacion/reparacion_espera_tecn",
      "text"  => "Reparacion por Realizar"),
    "2" => array (
      "route" => "/reparacion/reparacion_realizada_tecn",
      "text"  => "Reparacion por Entregar"),
    "3" => array (
      "route" => "/reporte/reporte_tecn",
      "text"  => "Reporte")

  );
  $itemUsuVende = array (
    "0" => array (
      "route" => "/inventario/listPro",
      "text"  => "Inventario"),
    "1" => array (
      "route" => "/venta",
      "text"  => "Ventas"),
    "2" => array (
      "route" => "/reparacion",
      "text"  => "Recepción de Telefono"),
    "3" => array (
      "route" => "/reparacionvende",
      "text"  => "Entrega de Telefono"));

      if($_SESSION['cargo'] == 1 ){
 ?>
<!-- MENU ADMINISTRADOR -->
<nav class="navbar navbar-default navbar-fixed-top" >
  <div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class=""></span>
          <span class="fa fa-navicon" style="color:white;"></span>
        </button>
      <a class="navbar-brand" href="/entrada">ADMIN SERV V.1</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
      <?php
        foreach ($items as $key) {
          $url = explode('/',URL);
          $class = ('/'.$url[1] == $key['route']) ? 'active' : '';
          echo '<li class="'.$class.'"> <a href="'.$key['route'].'">'.$key['text'].'</a></li>';
        }?>
        <!-- INVENTARIO -->
        <li class="dropdown ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Inventario <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
              foreach ($itemInv as $key ) {
                echo '<li><a href="'.$key["route"].'">'.$key["text"].'</a></li>';
              }

            ?>
          </ul>
        </li>
        <!-- COMPRAS -->

        <li class="dropdown ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Compras <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
              foreach ($itemCompra as $key ) {
                echo '<li><a href="'.$key["route"].'">'.$key["text"].'</a></li>';
              }

            ?>
          </ul>
        </li>

        <!-- VENTAS -->

        <li class="dropdown ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ventas <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
              foreach ($itemVenta as $key ) {
                echo '<li><a href="'.$key["route"].'">'.$key["text"].'</a></li>';
              }

            ?>
          </ul>
        </li>

        <!-- REPARACIONSE -->

        <li class="dropdown ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reparaciones <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
              foreach ($itemRepa as $key ) {
                echo '<li><a href="'.$key["route"].'">'.$key["text"].'</a></li>';
              }

            ?>
          </ul>
        </li>

        <!-- REPORTES -->

        <li class="dropdown ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reportes <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
              foreach ($itemReporte as $key ) {
                echo '<li><a href="'.$key["route"].'">'.$key["text"].'</a></li>';
              }

            ?>
          </ul>
        </li>
      </ul>

        <!-- DATOS DEL USUARIO -->
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <span class="nom_usu"><?php echo $_SESSION['nombre']  ?> </span> <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <?php
                foreach ($itemUsuAdmin as $key ) {
                  echo '<li><a href="'.$key["route"].'"><i class="'.$key['class'].'"></i> '.$key["text"].'</a></li>';
                }

              ?>
                <li><a href="" data-toggle="modal" data-target="#logout"><i class="fa fa-sign-out fa-fw"></i> Salir</a></li>

              </ul>
            </li>
          </ul>
    </div>

  </div>

</nav>

<?php
 }
 /*FIN DE MENU ADMINISTRADOR*/
 if($_SESSION['cargo'] == 2 ){ ?>

<!-- MENU TECNICO -->
 <nav class="navbar navbar-default navbar-fixed-top" >
  <div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class=""></span>
          <span class="fa fa-navicon" style="color:white;"></span>
        </button>
      <a class="navbar-brand" href="/entrada">ADMIN SERV V.1</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
      <?php
        foreach ($itemUsuTecn as $key) {
          $url = explode('/',URL);
          $class = ('/'.$url[1] == $key['route']) ? 'active' : '';
          echo '<li class="'.$class.'"> <a href="'.$key['route'].'">'.$key['text'].'</a></li>';
        }?>
      </ul>



        <!-- DATOS DEL USUARIO -->
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <span class="nom_usu"><?php echo $_SESSION['nombre']  ?> </span> <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <?php
                foreach ($itemUsuDefa as $key ) {
                  echo '<li><a href="'.$key["route"].'"><i class="'.$key['class'].'"></i> '.$key["text"].'</a></li>';
                }

              ?>
                <li><a href="" data-toggle="modal" data-target="#logout"><i class="fa fa-sign-out fa-fw"></i> Salir</a></li>

              </ul>
            </li>
          </ul>
    </div>

  </div>

</nav>
 <?php  }

# FIN MENU TECNICO

 if($_SESSION['cargo'] == 3 ){ ?>

<!-- MENU VENDEDOR -->
 <nav class="navbar navbar-default navbar-fixed-top" >
  <div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class=""></span>
          <span class="fa fa-navicon" style="color:white;"></span>
        </button>
      <a class="navbar-brand" href="/entrada">ADMIN SERV V.1</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
      <?php
        foreach ($itemUsuVende as $key) {
          $url = explode('/',URL);
          $class = ('/'.$url[1] == $key['route']) ? 'active' : '';
          echo '<li class="'.$class.'"> <a href="'.$key['route'].'">'.$key['text'].'</a></li>';
        }?>
      </ul>



        <!-- DATOS DEL USUARIO -->
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <span class="nom_usu"><?php echo $_SESSION['nombre']  ?> </span> <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <?php
                foreach ($itemUsuDefa as $key ) {
                  echo '<li><a href="'.$key["route"].'"><i class="'.$key['class'].'"></i> '.$key["text"].'</a></li>';
                }

              ?>
                <li><a href="" data-toggle="modal" data-target="#logout"><i class="fa fa-sign-out fa-fw"></i> Salir</a></li>

              </ul>
            </li>
          </ul>
    </div>

  </div>

</nav>
 <?php  }
?>
<!-- MODAL LOGOUT -->

    <div class="modal fade modal-logout" id="logout" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <br>
            <p class="text-center">¿Quieres cerrar la sesión?</p>
            <p class="text-center"><i class="fa fa-exclamation-triangle fa-5x"></i></p>
            <p class="text-center">
                <a href="/login/logout" class="btn btn-primary btn-sm">Cerrar la sesión</a>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
            </p>
          </div>
      </div>
    </div>

<?PHP } ?>
