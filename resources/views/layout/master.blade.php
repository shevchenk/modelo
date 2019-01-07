<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        @section('author')
        <meta name="author" content="Jorge Salcedo (Shevchenko)">
        @show
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

        @section('description')
        <meta name="description" content="Software Modelo">
        @show
        <title>
            @section('title')
                Software Modelo (JS)
            @show
        </title>

        @section('include')
            <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
            {{ Html::style('lib/bootstrap/css/bootstrap.min.css') }}
            {{ Html::style('lib/font-awesome/css/font-awesome.min.css') }}
            {{ Html::style('lib/meanmenu/css/meanmenu.min.css') }}
            {{ Html::style('lib/animate/css/animate.css') }}
            {{ Html::style('lib/normalize/css/normalize.css') }}
            {{ Html::style('lib/scrollbar/css/jquery.mCustomScrollbar.min.css') }}
            {{ Html::style('css/notika-custom-icon.css') }}
            {{ Html::style('lib/wave/css/waves.min.css') }}
            {{ Html::style('lib/wave/css/button.css') }}
            {{ Html::style('lib/notification/css/notification.css') }}
            {{ Html::style('lib/sweetalert-master/dist/sweetalert.css') }}
            {{ Html::style('lib/dialog/css/sweetalert2.min.css') }}
            {{ Html::style('lib/dialog/css/dialog.css') }}
            {{ Html::style('css/main.css') }}
            {{ Html::style('css/style.css') }}
            {{ Html::style('css/responsive.css') }}

            <!--
            {{ Html::style('lib/bootstrap-select/dist/css/bootstrap-select.css') }}
            {{ Html::style('lib/owl-carousel/css/owl.carousel.css') }}
            {{ Html::style('lib/owl-carousel/css/owl.theme.css') }}
            {{ Html::style('lib/owl-carousel/css/owl.transitions.css') }}
            {{ Html::style('lib/jvectormap/css/jquery-jvectormap-2.0.3.css') }}
            {{ Html::style('lib/color-picker/css/farbtastic.css') }}
            {{ Html::style('lib/cropper/css/cropper.min.css') }}
            -->

            {{ Html::script('js/modernizr-custom.js') }}
            {{ Html::script('lib/jQuery/jquery-2.2.3.min.js') }}
            {{ Html::script('lib/bootstrap/js/bootstrap.min.js') }}
            {{ Html::script('js/wow.min.js') }}
            {{ Html::script('lib/jQueryUI/jquery-ui.min.js') }}
            
            <!--
            <script src="js/owl.carousel.min.js"></script>
            <script src="js/counterup/jquery.counterup.min.js"></script>
            <script src="js/counterup/waypoints.min.js"></script>
            <script src="js/counterup/counterup-active.js"></script>
            <script src="js/flot/jquery.flot.js"></script>
            <script src="js/flot/jquery.flot.resize.js"></script>
            <script src="js/flot/flot-active.js"></script>
            -->
            
            {{ Html::script('js/jquery.scrollUp.min.js') }}
            {{ Html::script('lib/meanmenu/js/jquery.meanmenu.js') }}
            {{ Html::script('lib/scrollbar/js/jquery.mCustomScrollbar.concat.min.js') }}
            {{ Html::script('lib/wave/js/waves.min.js') }}
            {{ Html::script('lib/wave/js/wave-active.js') }}
            {{ Html::script('lib/notification/js/bootstrap-growl.min.js') }}
            {{ Html::script('lib/notification/js/notification-active.js') }}
            {{ Html::script('lib/sweetalert-master/dist/sweetalert.min.js') }}
            {{ Html::script('lib/chat/jquery.chat.js') }}
            {{ Html::script('js/jquery.todo.js') }}
            {{ Html::script('js/plugins.js') }}
            {{ Html::script('js/main.js') }}
            {{ Html::script('js/tawk-chat.js') }}
        @show
        @include( 'include.css.master' )
        @include( 'include.js.master' )
    </head>

    <body>
        <div class="header-top-area">
            @include( 'layout.admin_head' )
        </div>

        <div class="mobile-menu-area">
            @include( 'layout.admin_menu_mobile' )
        </div>

        <div class="main-menu-area mg-tb-40">
            @include( 'layout.admin_menu' )
        </div>

        <div>
            <div class="msjG" style="display: none;"> </div>
            @yield('content')
        </div>

        <div class="footer-copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-copy-right">
                            <p><strong>Copyright &copy; 2017-2018 <a href="http://jssoluciones.pe" target="_blank">JS</a></strong>. All rights
            reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

        @yield('form')
        @include( 'include.form.imagen' )
        @include( 'include.form.mensaje' )
    </body>
</html>
