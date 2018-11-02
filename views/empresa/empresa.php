

<body>
    <section id="prove-product-cat-config">
        <div class="container">
            <div class="page-header">
                <h1>Datos de administración de la empresa <small><?php echo EMPRESA; ?></small></h1>
            </div>
            <ul class="nav nav-tabs">
                <li class="active"><a href="/empresa">Empresa</a></li>
            </ul>
                    <?php if (!empty($this->msg->hasMessages())) { $this->msg->display(); } ?>
            <div class="row">
                <div class="col-xs-12 ">
                    <br>
                <div id="dat-empresa">


                <?php if(!empty($empresa)){ ?>
                <!-- FORM EDITAR -->
                <form enctype="multipart/form-data" action="/empresa/update" method="POST">
                    <div class="col-sm-12">
                        <div class="page-header"><h3>Datos de la Empresa</h3></div>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label for="">RIF:</label>
                        <input type="text" class="form-control" value="<?php echo $empresa[0]->rif_emp; ?>" name="rif_emp" required >
                    </div>

                    <div class="col-sm-8 form-group">
                        <label for="">Nombre:</label>
                        <input type="text" class="form-control" value="<?php echo $empresa[0]->nom_emp; ?>" name="nom_emp" required>
                    </div>

                    <div class="form-group col-sm-12">
                        <label for="">Direccion:</label>
                        <input type="text" class="form-control" value="<?php echo $empresa[0]->dir_emp; ?>" name="dir_emp" required>
                    </div>

                    <div class="form-gorup col-sm-4">
                        <label for="">Telefono:</label>
                        <input type="text" value="<?php echo $empresa[0]->tlf_emp; ?>" class="phone form-control" name="tlf_emp">
                    </div>

                    <div class="form-gorup col-sm-5">
                        <label for="">Correo Electronico:</label>
                        <input type="email" value="<?php echo $empresa[0]->email_emp; ?>" class="form-control" name="email_emp">
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="">IVA:</label>
                        <div class="input-group">
                            <input type="number" class="number form-control" value="<?php echo $empresa[0]->iva; ?>" name="iva" required>
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label for="">LOGO:</label>
                        <img src="<?php echo '/imagenes/'.$empresa[0]->url_logo; ?>" alt="">
                        <input type="hidden" value="<?php echo $empresa[0]->url_logo; ?>" name="url_logo_old">
                        <input type="file" name="url_logo" value="">
                        <span class="help-block text-red">Necesario tipo de imagen JPEG o PNG y con un acho no mayor de 51px y un alto no mayor de 45px</span>
                    </div>

                    <!-- DATOS DEL PROPIETARIO -->

                    <div class="col-sm-12">
                        <div class="page-header"><h3>Datos del Propietario</h3></div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="">Cedula:</label>
                        <input type="text" class="cedulaEdit form-control" value="<?php echo $empresa[0]->ced_pro ?>" name="ced_pro" required>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="">Nombre:</label>
                        <input type="text" class="abc form-control" value="<?php echo $empresa[0]->propietario ?>" name="nom_pro" required>
                    </div>
                    <p class="text-center">
                        <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                    </p>
                </form>
                <?php }
                else {?>

                    <!-- DATOS DE LA EMPRESA -->
                <form enctype="multipart/form-data" action="/empresa/create" method="POST">
                    <div class="col-sm-12">
                        <div class="page-header"><h3>Datos de la Empresa</h3></div>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label for="">RIF:</label>
                        <input type="text" class="form-control" placeholder="J-123456789-0" name="rif_emp" required="">
                    </div>

                    <div class="col-sm-8 form-group">
                        <label for="">Nombre:</label>
                        <input type="text" class="form-control" placeholder="Empresa C.A" name="nom_emp" required="">
                    </div>

                    <div class="form-group col-sm-12">
                        <label for="">Direccion:</label>
                        <input type="text" class="form-control" placeholder="Estado Táchira, El Piñal, Calle 2 Con Carrera 2" name="dir_emp" required="">
                    </div>

                    <div class="form-gorup col-sm-4">
                        <label for="">Telefono:</label>
                        <input type="text" placeholder="0000-0000000" class="phone form-control" name="tlf_emp">
                    </div>

                    <div class="form-gorup col-sm-5">
                        <label for="">Correo Electronico:</label>
                        <input type="email" placeholder="empresa@email.com" class="form-control" name="email_emp">
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="">IVA:</label>
                        <div class="input-group">
                            <input type="number" class="number form-control" placeholder="15" name="iva" required="">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label for="">LOGO:</label>
                        <input type="file" name="url_logo">
                        <span class="help-block text-red">Necesario tipo de imagen JPEG o PNG y con un acho no mayor de 51px y un alto no mayor de 45px</span>
                    </div>

                    <!-- DATOS DEL PROPIETARIO -->

                    <div class="col-sm-12">
                        <div class="page-header"><h3>Datos del Propietario</h3></div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="">Cedula:</label>
                        <input type="text" class="cedulaEdit form-control" placeholder="V-12345678" name="ced_pro" required="">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="">Nombre:</label>
                        <input type="text" class="abc form-control" placeholder="Nombre del Propietario" name="nom_pro" required="">
                    </div>
                    <p class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </p>
                </form>
                <?php } ?>
                </div>
                </div>



            </div>
        </div>
    </section>
</body>


