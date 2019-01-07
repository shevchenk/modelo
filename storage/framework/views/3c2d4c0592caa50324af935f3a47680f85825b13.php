<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                <?php if(isset($menu)): ?>
                    <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a data-toggle="tab" href="#AMT<?php echo e($val->menu_id); ?>">
                                <i class="<?php echo e($val->icono); ?>"></i>
                                <span><?php echo e($val->menu); ?></span>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <li><a data-toggle="tab" href="#Tables"><i class="fa fa-table"></i> Tables</a>
                </li>
                <li><a data-toggle="tab" href="#Page"><i class="fa fa-cog fa-spin"></i> Pages</a>
                </li>
            </ul>
            <div class="tab-content custom-menu-content">
                <?php if(isset($menu)): ?>
                    <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div id="AMT<?php echo e($val->menu_id); ?>" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <?php  $opciones=explode('||',$val->opciones);  ?>
                                <?php $__currentLoopData = $opciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $op): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php  $dop=explode('|',$op);  ?>
                                <li><a href="<?php echo e($dop[1]); ?>"><?php echo e($dop[0]); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <div id="Tables" class="tab-pane active notika-tab-menu-bg animated flipInX">
                    <ul class="notika-main-menu-dropdown">
                        <li><a href="normal-table.html">Normal Table</a>
                        </li>
                        <li><a href="data-table.html">Data Table</a>
                        </li>
                    </ul>
                </div>
                <div id="Page" class="tab-pane notika-tab-menu-bg animated flipInX">
                    <ul class="notika-main-menu-dropdown">
                        <li><a href="contact.html">Contact</a>
                        </li>
                        <li><a href="invoice.html">Invoice</a>
                        </li>
                        <li><a href="typography.html">Typography</a>
                        </li>
                        <li><a href="color.html">Color</a>
                        </li>
                        <li><a href="login-register.html">Login Register</a>
                        </li>
                        <li><a href="404.html">404 Page</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
