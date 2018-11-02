<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="<?php if($menu == 1){echo 'active';}else {echo '';} ?>">
        <a href="/inventario/newPro" role="tab" >Registro de Productos</a>
    </li>

    <li role="presentation" class="<?php if($menu == 2){echo 'active';}else {echo '';} ?>">
        <a href="/inventario/listmarca" role="tab" >Listado de Marcas</a>
    </li>
</ul>
<script>
    $(document).ready(function(){
        $('.phone').mask('0000-0000000',{reverse:false});
        $('.cedula').mask('00000000');
        $('.abc').mask('S');
        $('.price').mask('00,000,000,000.00',{reverse:true});
        $('.number').mask('#');

        $()
    })
</script>
