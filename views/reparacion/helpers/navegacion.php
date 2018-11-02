<ul class="nav nav-tabs" role="tablist">
    <?php if ($_SESSION['id'] == 1){ ?>
    <li role="presentation" class="<?php if($menu == 1) {echo 'active';} else {echo '';} ?>">
        <a href="/reparacion/reparacion_espera" role="tab">Por Realizar</a>
    </li>
    
    <li class="<?php if($menu == 2) {echo 'active';} else {echo '';} ?>">
        <a href="/reparacion/reparacion_realizada">Por Entregar</a>
    </li>
    <?php } ?>

    <?php if ($_SESSION['id'] == 4){ ?>

    <li class="<?php if($menu == 4) {echo 'active';} else {echo '';} ?>">
        <a href="/reparacionvende/reparacion_num_ser">Por N# de Servicio</a>
    </li>

    <li class="<?php if($menu == 3) {echo 'active';} else {echo '';} ?>">
        <a href="/reparacionvende/reparacion_ced">Por N# de Cedula</a>
    </li>
    <?php }
    else { ?>
    <li class="<?php if($menu == 4) {echo 'active';} else {echo '';} ?>">
        <a href="/reparacion/reparacion_num_ser">Por N# de Servicio</a>
    </li>

    <li class="<?php if($menu == 3) {echo 'active';} else {echo '';} ?>">
        <a href="/reparacion/reparacion_ced">Por N# de Cedula</a>
    </li>
   <?php } ?>


    <?php if ($_SESSION['id'] == 1){ ?>
    <li class="<?php if($menu == 5) {echo 'active';} else {echo '';} ?>">
        <a href="/reparacion/reparacion_caducada">Reparaciones Caducadas</a>
    </li>
    <?php } ?>
</ul>
