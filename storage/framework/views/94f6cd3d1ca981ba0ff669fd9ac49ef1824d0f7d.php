  

<?php $__env->startSection('include'); ?>
    ##parent-placeholder-d3ecb0d890368d7659ee54010045b835dacb8efe##
    <?php echo e(Html::style('lib/datatables/dataTables.bootstrap.css')); ?>

    <?php echo e(Html::script('lib/datatables/jquery.dataTables.min.js')); ?>

    <?php echo e(Html::script('lib/datatables/dataTables.bootstrap.min.js')); ?>


    <?php echo e(Html::style('lib/bootstrap-select/dist/css/bootstrap-select.min.css')); ?>

    <?php echo e(Html::script('lib/bootstrap-select/dist/js/bootstrap-select.min.js')); ?>

    <?php echo e(Html::script('lib/bootstrap-select/dist/js/i18n/defaults-es_ES.min.js')); ?>


    <?php echo e(Html::style('lib/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')); ?>

    <?php echo e(Html::script('lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')); ?>

    <?php echo e(Html::script('lib/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js')); ?>


    <?php echo e(Html::style('lib/EasyAutocomplete1.3.5/easy-autocomplete.min.css')); ?>

    <?php echo e(Html::script('lib/EasyAutocomplete1.3.5/jquery.easy-autocomplete.min.js')); ?>


    <?php echo $__env->make( 'mantenimiento.persona.js.persona_ajax' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make( 'mantenimiento.persona.js.persona' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make( 'mantenimiento.persona.js.persona_modal_ajax' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make( 'mantenimiento.persona.js.persona_modal' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    

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
                                    <i class="fa fa-cogs"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Personas</h2>
                                    <p>Gestionar registro de las Personas</p>
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
                <form id="PersonaForm">
                    <div class="box-body table-responsive no-padding">
                        <table id="TablePersona" class="table table-bordered table-hover">
                            <thead>
                                <tr class="cabecera">
                                    <th class="col-xs-2">
                                        <div class="form-group col-xs-12">
                                            <label><h4>Apellido Paterno:</h4></label>
                                            <div class="input-group col-xs-12">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_paterno" id="txt_paterno" placeholder="Apellido Paterno" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-2">
                                        <div class="form-group col-xs-12">
                                            <label><h4>Apellido Materno:</h4></label>
                                            <div class="input-group col-xs-12">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_materno" id="txt_materno" placeholder="Apellido Materno" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-2">
                                        <div class="form-group col-xs-12">
                                            <label><h4>Nombre:</h4></label>
                                            <div class="input-group col-xs-12">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_nombre" id="txt_nombre" placeholder="Nombre" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                     <th class="col-xs-2">
                                        <div class="form-group col-xs-12">
                                            <label><h4>DNI:</h4></label>
                                            <div class="input-group col-xs-12">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_dni" id="txt_dni" placeholder="DNI" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-2">
                                        <div class="form-group col-xs-12">
                                            <label><h4>Email:</h4></label>
                                            <div class="input-group col-xs-12">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_email" id="txt_email" placeholder="Email" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                    
                                    <th class="col-xs-2">
                                        <div class="form-group col-xs-12">
                                            <label><h4>Estado:</h4></label>
                                            <div class="input-group col-xs-12">
                                                <select class="form-control" name="slct_estado" id="slct_estado">
                                                    <option value='' selected>.::Todo::.</option>
                                                    <option value='0'>Inactivo</option>
                                                    <option value='1'>Activo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-1">[-]</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr class="cabecera">
                                  <th>Paterno</th>
                                  <th>Materno</th>
                                  <th>Nombre</th>
                                  <th>DNI</th>
                                  <th>Email</th>
                                  <th>Estado</th>
                                  <th>[-]</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditar(1)" >
                            <i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo</a>
                        </div>
                    </div><!-- .box-body -->
                </form><!-- .form -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('form'); ?>
     <?php echo $__env->make( 'mantenimiento.persona.form.persona_modal' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
     
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>