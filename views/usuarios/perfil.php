<body>
    <section id="prove-product-cat-config">
        <div class="container">
            <div class="page-header">
                <h1>Perfil del Usuario <em class="text-primary"><?php echo $usuario->nombre.' '. $usuario->apellido; ?></em>
                    <small class="tittles-pages-logo"><?php echo EMPRESA; ?></small>
                </h1>
            </div>
            <?php if (!empty($this->msg->hasMessages())) { $this->msg->display(); }
            $status = array(1 => 'Activo', 2 =>'Inactivo');
            ?>

            <div class="row">
                <br>
                <div id="adm-reparacion">
                    <div class="col-xs-12">
                        <div class="col-sm-4">
                            <i class="fa fa-user" style="font-size: 250px"></i>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Nombres:</label>
                                <span><?php echo $usuario->nombre ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Apellidos:</label>
                                <span><?php echo $usuario->apellido ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Email:</label>
                               <span><?php echo $usuario->email ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Contraseña:</label>
                                <input type="password" class="password" value="<?php echo $usuario->password ?>" readonly>
                                <input type="button" class="btn btn-success" data-toggle="modal" data-target="#changePass" value="Cambiar Password">
                            </div>
                            <div class="form-group">
                                <label for="">Direccion:</label>
                                <span><?php echo $usuario->direccion ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Telefono:</label>
                                <span><?php echo $usuario->telefono ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Cargo:</label>
                                <span><?php echo $usuario->cargo ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Status:</label>
                                <span><?php echo $status[$usuario->status] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</body>
<!-- MODAL CAMBIO DE CONTRASEÑA -->
<div class="modal fade" id="changePass">
    <form action="/usuario/change_pass" method="post" id="form-change-pass">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" >Cambiar Contraseña</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="">Contraseña Actual:</label>
                        <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                        <input type="password" name="oldPass"  class="form-control" required="">
                    </div>

                        <div class="pass form-group  has-feedback">
                            <label class="control-label">Nueva Contraseña</label>
                            <input type="password" class="pwd form-control" id="password1" required="">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    <div class="form-group pass has-feedback">
                        <label class="control-label">Confirmar Contraseña:</label>
                        <input type="password" name="pass" id="password2" class="pwd form-control" required="">
                        <span class="glyphicon  form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                </div>

            </div>
        </div>
    </form>

</div>
<script>

$(document).ready(function(){

    var camposPass = $(".pass")
    camposPass.find('span').addClass('hide')

$("#form-change-pass" ).submit(function(event) {
    var pass1 = $("#password1").val()
    var pass2 = $("#password2").val()
    if(pass1 == pass2){
        return true
    }
        event.preventDefault();

});

    $(".pwd").keyup(function(){
        var pass1 = $("#password1")
        var pass2 = $("#password2")
        camposPass.removeClass('has-error has-success')
        if(pass1.val() == pass2.val()){
            camposPass.addClass('has-success')
            camposPass.find('span').removeClass('hide')
            camposPass.find('span').removeClass('glyphicon-remove')
            camposPass.find('span').addClass('glyphicon-ok')

        }
        else{
            camposPass.addClass('has-error')
            camposPass.find('span').removeClass('glyphicon-ok')
            camposPass.find('span').addClass('glyphicon-remove')
        }
    })
})
</script>
<style>
    .password{
        background: none;
        border:none;
    }
</style>
