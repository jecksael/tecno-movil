    <script src="/js/cargando.js"></script>
    <script src="/css/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/jQuery-Mask-Plugin-master/jquery.mask.js"></script>
    <script src="/js/function.js"></script>
<!--

-->

<?php
//

        if(!empty($_SESSION['cargo'])){
?>
<footer>
    <h3 class="text-center">&copy; <?php echo EMPRESA; ?></h3><br>
    <ul class="list-unstyled text-center">
     <!--   <a href="#" class="social-icon all-elements-tooltip" data-toggle="tooltip" data-placement="bottom" title="Facebook">
            <img src="<?php echo FOLDER. "/public/icons/social-facebook.png" ?>">
        </a>
        <a href="#" class="social-icon all-elements-tooltip" data-toggle="tooltip" data-placement="bottom" title="Google +">
            <img src="<?php echo FOLDER. "/public/icons/social-googleplus.png" ?>">
        </a>
        <a href="#" class="social-icon all-elements-tooltip" data-toggle="tooltip" data-placement="bottom" title="Linkedin">
            <img src="<?php echo FOLDER. "/public/icons/social-linkedin.png" ?>">
        </a>
        <a href="#" class="social-icon all-elements-tooltip" data-toggle="tooltip" data-placement="bottom" title="Pinterest">
            <img src="<?php echo FOLDER. "/public/icons/social-pinterest.png" ?>">
        </a>
        <a href="#" class="social-icon all-elements-tooltip" data-toggle="tooltip" data-placement="bottom" title="Twitter">
            <img src="<?php echo FOLDER. "/public/icons/social-twitter.png" ?>">
        </a> -->

    </ul>
    <br><br><br>
    <h5 class="text-center tittles-pages-logo">PG24 &copy; <?php echo date("Y");?></h5>
</footer>

<?php }?>
