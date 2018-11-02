

<link rel="stylesheet" href="/css/login.css">
<link rel="stylesheet" href="/css/form-elements.css">

<div class="top-content">

    <div class="inner-bg">
        <div class="container">

            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Aceso al Sistema</h3>
                            <p>Introduce tu Usuario y Contraseña para Acceder:</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form role="form" action="login/login" method="POST" class="login-form">
                            <div class="form-group">
                                <label class="sr-only" for="form-username">Usuario</label>
                                <input type="email" name="email" placeholder="Usuario..." class="form-username form-control" id="form-username">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="form-password">Contraseña</label>
                                <input type="password" name="password" placeholder="Contraseña..." class="form-password form-control" id="form-password">
                            </div>
                            <button type="submit" class="btn">Entrar!</button>
                        </form>
                        <div class="text-alert text-center padding-top"><?php !empty($error_message) ? print($error_message) : '' ?></div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

<script>

$(document).ready(function() {

    $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
        $(this).removeClass('input-error');
    });

    $('.login-form').on('submit', function(e) {

        $(this).find('input[type="text"], input[type="password"], textarea').each(function(){
            if( $(this).val() == "" ) {
                e.preventDefault();
                $(this).addClass('input-error');
            }
            else {
                $(this).removeClass('input-error');
            }
        });

    });


});
</script>
