<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="mobile-menu">
                <nav id="dropdown">
                    <ul class="mobile-menu-nav">
                        @if (isset($menu))
                            @foreach ( $menu as $key => $val)
                                <li>
                                    <a data-toggle="collapse" 
                                    onclick="masterG.OpenCloseMenu();" data-target="#AM{{ $val->menu_id }}" href="#">
                                        <i class="{{ $val->icono }}"></i>
                                        <span>{{ $val->menu }}</span>
                                    </a>
                                    <ul id="AM{{ $val->menu_id }}" class="collapse dropdown-header-top">
                                        @php $opciones=explode('||',$val->opciones); @endphp
                                        @foreach ( $opciones as $op )
                                        @php $dop=explode('|',$op); @endphp
                                        <li><a href="{{ $dop[1] }}">{{ $dop[0] }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        @endif
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
