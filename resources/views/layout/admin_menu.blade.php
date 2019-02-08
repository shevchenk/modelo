<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                @if (isset($menu))
                    @foreach ( $menu as $key => $val)
                        <li>
                            <a data-toggle="tab" href="#AMT{{ $val->menu_id }}">
                                <i class="{{ $val->icono }}"></i>
                                <span>{{ $val->menu }}</span>
                            </a>
                        </li>
                    @endforeach
                @endif
                <li>
                    <a href="secureaccess.myself">
                        <i class="fa fa-user-secret"></i>
                        <span>Mi Acceso</span>
                    </a>
                </li>
                <li>
                    <a href="salir">
                        <i class="glyphicon glyphicon-log-in"></i>
                        <span>Cesar Sesión</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content custom-menu-content">
                @if (isset($menu))
                    @foreach ( $menu as $key => $val)
                        <div id="AMT{{ $val->menu_id }}" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                @php $opciones=explode('||',$val->opciones); @endphp
                                @foreach ( $opciones as $op )
                                @php $dop=explode('|',$op); @endphp
                                <li><a href="{{ $dop[1] }}">{{ $dop[0] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
