<div class="jumbotron" id="jumbotron-index">

    <img src="img/banner2.png"  width="100%" alt="banner" class="img-responsive">
</div>
<body id="container-page-index">

    <section id="new-prod-index">
         <div class="container">
            <div class="page-header">
                <h1>Novedades <small>productos</small></h1>
            </div>
            <div class="row">
                <?php if(isset($producto)){
                    if(!empty($producto)){
                        foreach ($producto as $key => $value) {?>

                            <div class="col-xs-12 col-sm-6 col-md-3">
                                 <div class="thumbnail">
                                   <a href="/inventario/producto_detalle/<?php echo $value->id ?>"><img src="<?php echo '/imagenes/'.$value->url_imagen ?>" style=" height: 250px"></a>
                                   <div class="caption">
                                     <h3><?php echo $value->marca ?></h3>
                                     <p><?php echo $value->des_pro ?></p>
                                     <p><?php echo $value->pre_ven ?> BF</p>
                                     <!-- <p class="text-center">
                                         <a href="#" class="btn btn-primary btn-sm">
                                            <i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;
                                     </p> -->

                                   </div>
                                 </div>
                             </div>
                        <?php }
                    }
                } ?>

            </div>
         </div>
    </section>

    <section id="distribuidores-index">
        <div class="container">
            <div class="col-xs-12 col-sm-6">

            </div>
            <div class="col-xs-12 col-sm-6">

            </div>
            <div class="col-xs-12">
                <div class="page-header">
                  <h1>Nuestras <small style="color: #333;">Marcas</small></h1>
                </div>
                <br><br>
                <center>
                    <img src="img/logos-marcas.png" alt="logos-marcas" width="80%" class="img-responsive">
                </center>
            </div>
        </div>
    </section>
</body>

