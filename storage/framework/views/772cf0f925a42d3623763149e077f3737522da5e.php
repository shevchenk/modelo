<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="mobile-menu">
                <nav id="dropdown">
                    <ul class="mobile-menu-nav">
                        <?php if(isset($menu)): ?>
                            <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a data-toggle="collapse" data-target="#AM<?php echo e($val->menu_id); ?>" href="#">
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
                        <li><a data-toggle="collapse" data-target="#Charts" href="#">Home</a>
                            <ul class="collapse dropdown-header-top">
                                <li><a href="index.html">Dashboard One</a></li>
                                <li><a href="index-2.html">Dashboard Two</a></li>
                                <li><a href="index-3.html">Dashboard Three</a></li>
                                <li><a href="index-4.html">Dashboard Four</a></li>
                                <li><a href="analytics.html">Analytics</a></li>
                                <li><a href="widgets.html">Widgets</a></li>
                            </ul>
                        </li>
                        <li><a data-toggle="collapse" data-target="#demoevent" href="#">Email</a>
                            <ul id="demoevent" class="collapse dropdown-header-top">
                                <li><a href="inbox.html">Inbox</a></li>
                                <li><a href="view-email.html">View Email</a></li>
                                <li><a href="compose-email.html">Compose Email</a></li>
                            </ul>
                        </li>
                        <li><a data-toggle="collapse" data-target="#democrou" href="#">Interface</a>
                            <ul id="democrou" class="collapse dropdown-header-top">
                                <li><a href="animations.html">Animations</a></li>
                                <li><a href="google-map.html">Google Map</a></li>
                                <li><a href="data-map.html">Data Maps</a></li>
                                <li><a href="code-editor.html">Code Editor</a></li>
                                <li><a href="image-cropper.html">Images Cropper</a></li>
                                <li><a href="wizard.html">Wizard</a></li>
                            </ul>
                        </li>
                        <li><a data-toggle="collapse" data-target="#demolibra" href="#">Charts</a>
                            <ul id="demolibra" class="collapse dropdown-header-top">
                                <li><a href="flot-charts.html">Flot Charts</a></li>
                                <li><a href="bar-charts.html">Bar Charts</a></li>
                                <li><a href="line-charts.html">Line Charts</a></li>
                                <li><a href="area-charts.html">Area Charts</a></li>
                            </ul>
                        </li>
                        <li><a data-toggle="collapse" data-target="#demodepart" href="#">Tables</a>
                            <ul id="demodepart" class="collapse dropdown-header-top">
                                <li><a href="normal-table.html">Normal Table</a></li>
                                <li><a href="data-table.html">Data Table</a></li>
                            </ul>
                        </li>
                        <li><a data-toggle="collapse" data-target="#demo" href="#">Forms</a>
                            <ul id="demo" class="collapse dropdown-header-top">
                                <li><a href="form-elements.html">Form Elements</a></li>
                                <li><a href="form-components.html">Form Components</a></li>
                                <li><a href="form-examples.html">Form Examples</a></li>
                            </ul>
                        </li>
                        <li><a data-toggle="collapse" data-target="#Miscellaneousmob" href="#">App views</a>
                            <ul id="Miscellaneousmob" class="collapse dropdown-header-top">
                                <li><a href="notification.html">Notifications</a>
                                </li>
                                <li><a href="alert.html">Alerts</a>
                                </li>
                                <li><a href="modals.html">Modals</a>
                                </li>
                                <li><a href="buttons.html">Buttons</a>
                                </li>
                                <li><a href="tabs.html">Tabs</a>
                                </li>
                                <li><a href="accordion.html">Accordion</a>
                                </li>
                                <li><a href="dialog.html">Dialogs</a>
                                </li>
                                <li><a href="popovers.html">Popovers</a>
                                </li>
                                <li><a href="tooltips.html">Tooltips</a>
                                </li>
                                <li><a href="dropdown.html">Dropdowns</a>
                                </li>
                            </ul>
                        </li>
                        <li><a data-toggle="collapse" data-target="#Pagemob" href="#">Pages</a>
                            <ul id="Pagemob" class="collapse dropdown-header-top">
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
                        </li>
                        <li><a data-toggle="collapse" data-target="#Mmisdatos" href="#">
                                <i class="fa fa-user-secret"></i>
                                <span>Mis Datos</span>
                            </a>
                            <ul id="Mmisdatos" class="collapse dropdown-header-top">
                                <li><a href="secureaccess.myself">Datos Personales</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
