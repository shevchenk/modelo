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
                <li><a data-toggle="tab" href="#Tables"><i class="fa fa-table"></i> Tables</a>
                </li>
                <li><a data-toggle="tab" href="#Page"><i class="fa fa-cog fa-spin"></i> Pages</a>
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
