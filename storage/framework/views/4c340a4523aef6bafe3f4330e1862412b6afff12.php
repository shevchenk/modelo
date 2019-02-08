  

<?php $__env->startSection('include'); ?>
    ##parent-placeholder-d3ecb0d890368d7659ee54010045b835dacb8efe##
    <?php echo e(Html::style('lib/datatables/dataTables.bootstrap.css')); ?>

    <?php echo e(Html::script('lib/datatables/jquery.dataTables.min.js')); ?>

    <?php echo e(Html::script('lib/datatables/dataTables.bootstrap.min.js')); ?>


    <?php echo $__env->make( 'secureaccess.js.myself_ajax' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make( 'secureaccess.js.myself' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="fa fa-user-secret"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Mi Acceso</h2>
                                    <p>Actualizar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <form id="MyselfForm">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Contraseña Nueva:</label>
                                <input type="password" class="form-control" id="txt_password" name="txt_password" placeholder="Contraseña Nueva">
                            </div>
                            <div class="form-group">
                                <label>Confirmar Contraseña Nueva:</label>
                                <input type="password" class="form-control" id="txt_password_confirm" name="txt_password_confirm" placeholder="Confirmar Contraseña Nueva">
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-asterisk"></i> Su contraseña Actual:</label>
                                <input type="password" class="form-control" id="txt_password_actual" name="txt_password_actual" placeholder="Su contraseña Actual">
                            </div>
                            <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="EditarAjax()" >
                                <i class="fa fa-edit fa-lg"></i>&nbsp;Guardar</a>
                            </div>
                        </div><!-- .box-body -->
                    </form><!-- .form -->
                </div>
            </div><!-- .box -->
        </div><!-- .col -->
    </div><!-- .row -->
</div><!-- .content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>