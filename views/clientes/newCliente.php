
<body>
<section id="prove-product-cat-config">
<div class="container">
    <div class="page-header">
        <h1>Panel de administración de Clientes <small><?php echo EMPRESA; ?></small></h1>
    </div>
        <?php if (!empty($this->msg->hasMessages())) { $this->msg->display(); }
            include VIEWS.'/clientes/partials/navegacion.php'; ?>
                <div role="tabpanel" class="tab-pane fade <?php if($menu == 1){echo 'in active';} else {echo '';}?>" id="newCliente">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <br>
                    <div id="add-cliente">
                        <h2 class="text-primary text-center"><small><i class="fa fa-plus"></i></small> Agregar Nuevo Cliente</h2>
                        <form action="/clientes/newCliente" method="post">
                            <div class="form-group">
                                <label class="control-label"> N# de Cedula</label><br>
                                <select name="nac_id"  class="form-control" style="width: 20%; float: left">
                                    <option value="1">V-</option>
                                    <option value="2">E-</option>
                                </select>
                                <input type="text" name="ced_cli" class="cedula form-control" style="width: 80%;" placeholder="Cedula" required>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Nombres del Cliente</label>
                                <input type="text" name="nom_cli" class="abc form-control" placeholder="Nombres" required>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Apellidos del Cliente</label>
                                <input type="text" name="ape_cli" class="abc form-control" placeholder="Apellidos" required>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Genero</label>
                                <select name="sexo" class="form-control">
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Dirección</label>
                                <textarea class="form-control" name="dir_cli" cols="30" rows="2" placeholder="Dirección" required></textarea>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Telefono</label>
                                <input type="text" name="telf_cli" class="phone form-control" placeholder="0412-1234567">
                            </div>

                            <p class="text-center">
                                <button class="btn btn-primary" type="submit" >Registrar</button>
                            </p>

                        </form>
                    </div>
                    </div>
                    <div class="col-sm-6">
                        <img src="img/girl-callcenter.png" alt="cliente">
                    </div>

                </div>
                </div>
</div>
</section>
</body>
<?php include VIEWS.'/clientes/partials/scripts.php';  ?>
