<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="mobile-menu">
                <nav id="dropdown">
                    <ul class="mobile-menu-nav">
                        <?php if(isset($menu)): ?>
                            <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a data-toggle="collapse" 
                                    onclick="masterG.OpenCloseMenu();" data-target="#AM<?php echo e($val->menu_id); ?>" href="#">
                                        <i class="<?php echo e($val->icono); ?>"></i>
                                        <span><?php echo e($val->menu); ?></span>
                                    </a>
                                    <ul id="AM<?php echo e($val->menu_id); ?>" class="collapse dropdown-header-top">
                                        <?php  $opciones=explode('||',$val->opciones);  ?>
                                        <?php $__currentLoopData = $opciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $op): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php  $dop=explode('|',$op);  ?>
                                        <li><a href="<?php echo e($dop[1]); ?>"><?php echo e($dop[0]); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <li><a href="secureaccess.myself">
                                <i class="fa fa-user-secret"></i>
                                <span>Mi Acceso</span>
                            </a>
                        </li>
                        <li><a href="salir">
                                <i class="glyphicon glyphicon-log-in"></i>
                                <span>Cerrar Sesión</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
