<body>
<section id="prove-product-cat-config">
<div class="container">
    <div class="col-sm-12">
        <div class="col-sm-6">

                <img class="pull-right" src="<?php echo '/imagenes/'.$producto->url_imagen ?>" style=" height: 250px">

        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <h3>Codigo: <span class="text-primary"><?php echo $producto->cod_pro ?></span></h3>
            </div>
            <div class="form-group">
                <h3>Descripcion: <span class="text-primary"><?php echo $producto->des_pro ?></span></h3>
            </div>
            <div class="form-group">
                <h3>Marca: <span class="text-primary"><?php echo $producto->marca ?></span></h3>
            </div>
            <div class="form-group">
                <h3>Stock: <span class="text-primary"><?php echo $producto->stock ?> UND</span></h3>
            </div>
            <div class="form-group">
                <h3>Precio: <span class="text-primary"><?php echo $producto->pre_ven.' '.MONEDA ?> </span></h3>
            </div>
        </div>
    </div>

</div>
</section>
</body>

