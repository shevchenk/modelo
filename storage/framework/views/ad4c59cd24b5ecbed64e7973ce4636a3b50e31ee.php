<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php $__env->startSection('author'); ?>
        <meta name="author" content="Jorge Salcedo (Shevchenko)">
        <?php echo $__env->yieldSection(); ?>
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

        <?php $__env->startSection('description'); ?>
        <meta name="description" content="Software Modelo">
        <?php echo $__env->yieldSection(); ?>
        <title>
            <?php $__env->startSection('title'); ?>
                Software Modelo (JS)
            <?php echo $__env->yieldSection(); ?>
        </title>

        <?php $__env->startSection('include'); ?>
            <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
            <?php echo e(Html::style('lib/bootstrap/css/bootstrap.min.css')); ?>

            <?php echo e(Html::style('lib/font-awesome/css/font-awesome.min.css')); ?>

            <?php echo e(Html::style('lib/meanmenu/css/meanmenu.min.css')); ?>

            <?php echo e(Html::style('lib/animate/css/animate.css')); ?>

            <?php echo e(Html::style('lib/normalize/css/normalize.css')); ?>

            <?php echo e(Html::style('lib/scrollbar/css/jquery.mCustomScrollbar.min.css')); ?>

            <?php echo e(Html::style('css/notika-custom-icon.css')); ?>

            <?php echo e(Html::style('lib/wave/css/waves.min.css')); ?>

            <?php echo e(Html::style('lib/wave/css/button.css')); ?>

            <?php echo e(Html::style('lib/notification/css/notification.css')); ?>

            <?php echo e(Html::style('lib/sweetalert-master/dist/sweetalert.css')); ?>

            <?php echo e(Html::style('lib/dialog/css/sweetalert2.min.css')); ?>

            <?php echo e(Html::style('lib/dialog/css/dialog.css')); ?>

            <?php echo e(Html::style('css/main.css')); ?>

            <?php echo e(Html::style('css/style.css')); ?>

            <?php echo e(Html::style('css/responsive.css')); ?>


            <!--
            <?php echo e(Html::style('lib/bootstrap-select/dist/css/bootstrap-select.css')); ?>

            <?php echo e(Html::style('lib/owl-carousel/css/owl.carousel.css')); ?>

            <?php echo e(Html::style('lib/owl-carousel/css/owl.theme.css')); ?>

            <?php echo e(Html::style('lib/owl-carousel/css/owl.transitions.css')); ?>

            <?php echo e(Html::style('lib/jvectormap/css/jquery-jvectormap-2.0.3.css')); ?>

            <?php echo e(Html::style('lib/color-picker/css/farbtastic.css')); ?>

            <?php echo e(Html::style('lib/cropper/css/cropper.min.css')); ?>

            -->

            <?php echo e(Html::script('js/modernizr-custom.js')); ?>

            <?php echo e(Html::script('lib/jQuery/jquery-2.2.3.min.js')); ?>

            <?php echo e(Html::script('lib/bootstrap/js/bootstrap.min.js')); ?>

            <?php echo e(Html::script('js/wow.min.js')); ?>

            <?php echo e(Html::script('lib/jQueryUI/jquery-ui.min.js')); ?>

            
            <!--
            <script src="js/owl.carousel.min.js"></script>
            <script src="js/counterup/jquery.counterup.min.js"></script>
            <script src="js/counterup/waypoints.min.js"></script>
            <script src="js/counterup/counterup-active.js"></script>
            <script src="js/flot/jquery.flot.js"></script>
            <script src="js/flot/jquery.flot.resize.js"></script>
            <script src="js/flot/flot-active.js"></script>
            -->
            
            <?php echo e(Html::script('js/jquery.scrollUp.min.js')); ?>

            <?php echo e(Html::script('lib/meanmenu/js/jquery.meanmenu.js')); ?>

            <?php echo e(Html::script('lib/scrollbar/js/jquery.mCustomScrollbar.concat.min.js')); ?>

            <?php echo e(Html::script('lib/wave/js/waves.min.js')); ?>

            <?php echo e(Html::script('lib/wave/js/wave-active.js')); ?>

            <?php echo e(Html::script('lib/notification/js/bootstrap-growl.min.js')); ?>

            <?php echo e(Html::script('lib/sweetalert-master/dist/sweetalert.min.js')); ?>

            <?php echo e(Html::script('lib/chat/jquery.chat.js')); ?>

            <?php echo e(Html::script('js/jquery.todo.js')); ?>

            <?php echo e(Html::script('js/plugins.js')); ?>

            <?php echo e(Html::script('js/main.js')); ?>

            <?php echo e(Html::script('js/tawk-chat.js')); ?>

        <?php echo $__env->yieldSection(); ?>
        <?php echo $__env->make( 'include.css.master' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make( 'include.js.master' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </head>

    <body>
        <div class="header-top-area">
            <?php echo $__env->make( 'layout.admin_head' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>

        <div class="mobile-menu-area">
            <?php echo $__env->make( 'layout.admin_menu_mobile' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>

        <div class="main-menu-area mg-tb-40">
            <?php echo $__env->make( 'layout.admin_menu' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>

        <div>
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <div class="footer-copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-copy-right">
                            <p><strong>Copyright &copy; 2019 <a href="http://jssoluciones.pe" target="_blank">JS</a></strong>. All rights
            reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

        <?php echo $__env->yieldContent('form'); ?>
        <?php echo $__env->make( 'include.form.imagen' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make( 'include.form.mensaje' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </body>
</html>
