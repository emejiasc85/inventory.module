

<div class="sidebar">

    <div class="sidebar-collapse">
        <div class="sidebar-header" style="display: none" >
        </div>
        <div class="sidebar-menu">
            <ul class="nav nav-sidebar">
                <li><a href="/sales/cash-register"><i class="fa fa-inbox"></i><span class="text"> Caja</span></a></li>
                <li><a href="/sales/report-cash-registers"><i class="fa fa-bar-chart-o"></i><span class="text"> Ventas</span></a></li>
                <li><a href="{{ route('stocks.index') }}"><i class="fa fa-cubes"></i><span class="text"> Existencias</span></a></li>
                <li><a href="{{ route('orders.index') }}"><i class="fa fa-truck"></i><span class="text"> Pedidos</span></a></li>
                {{-- <li><a href="{{ route('audit.index') }}"><i class="fa fa-list-alt"></i><span class="text"> Auditoria</span></a></li> --}}
                {{-- <li><a href="{{ route('quotes.index') }}"><i class="fa fa-calendar"></i><span class="text"> Cotizaciones  </span></a></li> --}}
                <li><a href="{{ route('people.index') }}"><i class="fa fa-users"></i><span class="text"> Personas</span></a></li>
                <li><a href="/products"><i class="fa fa-barcode"></i><span class="text"> Productos</span></a></li>
                <li><a href="/gift-cards"><i class="fa fa-gift"></i><span class="text"> Gift Cards</span></a></li>

                <li>
                    <a href="#"><i class="fa fa-filter"></i><span class="text"> Reportes</span> <span class="indicator"></span></a>
                    <ul>
                        <li><a href="{{ route('reports.due_dates') }}"><i class="fa fa-calendar-times-o"></i><span class="text">Proximos a vencer</span></a></li>
                        <li><a href="{{ route('reports.min_stock') }}"><i class="fa fa-exclamation-triangle"></i><span class="text">    En stock minimo</span></a></li>
                        <li><a href="{{ route('reports.resumen') }}"><i class="fa fa-shopping-cart"></i><span class="text">Movimientos</span></a></li>
                        <li><a href="{{ route('reports.products') }}"><i class="fa fa-cubes"></i><span class="text">Top Productos</span></a></li>
                        <li><a href="{{ route('reports.customers') }}"><i class="fa fa-users"></i><span class="text">Top Clientes</span></a></li>
                        <li><a href="{{ route('reports.sellers') }}"><i class="fa fa-user"></i><span class="text">Top Vendedores</span></a></li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-book"></i><span class="text"> Catalagos</span> <span class="indicator"></span></a>
                    <ul>
                        <li><a href="{{ route('categories.index') }}"><i class="icon-grid"></i><span class="text"> Categorias</span></a></li>
                        <li><a href="{{ route('product_series.index') }}"><i class="fa fa-bookmark"></i><span class="text"> Series</span></a></li>
                        <li><a href="{{ route('product.groups.index') }}"><i class="icon-grid"></i><span class="text"> Grupos</span></a></li>
                        <li><a href="{{ route('product.presentations.index') }}"><i class="icon-tag"></i><span class="text"> Presentaciones</span></a></li>
                        <li><a href="{{ route('makes.index') }}"><i class="icon-badge"></i><span class="text"> Marcas</span></a></li>
                        <li><a href="{{ route('unit.measures.index') }}"><i class="icon-chemistry"></i><span class="text"> Medidas</span></a></li>
                        {{--
                            <li><a href="{{ route('orders.type.index') }}"><i class="fa fa-tags"></i><span class="text"> Tipos de ordenes</span></a></li>
                            <li><a href="{{ route('warehouses.index') }}"><i class="fa fa-database"></i><span class="text"> Bodegas</span></a></li>
                        --}}
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-gears"></i><span class="text"> Configuraciones</span> <span class="indicator"></span></a>
                    <ul>
                        <li><a href="{{ route('commerces.edit', [1, 'comercio']) }}"><i class="fa fa-home"></i><span class="text"> Comercio</span></a></li>
                        <li><a href="{{ route('resolutions.index') }}"><i class="fa fa-list-ol"></i><span class="text"> Resoluciones</span></a></li>
                        <li><a href="{{ route('users.index') }}"><i class="fa fa-users"></i><span class="text"> Usuarios</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="sidebar-footer" style="display: none">
    	<!--
        <ul class="sidebar-actions">
            <li class="action">
                <div class="btn-group dropup">
                    <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-speedometer"></i><span>Infrastructure</span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>

                </div>
            </li>
            <li class="action">
                <div class="btn-group dropup">
                    <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-list"></i><span>Menu</span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>

                </div>
            </li>
            <li class="action">
                <div class="btn-group dropup">
                    <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-users"></i><span>Contacts</span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>

                </div>
            </li>
        </ul>
        <ul class="sidebar-terms">
            <li><a href="page-blank.html#">Terms</a></li>
            <li><a href="page-blank.html#">Privacy</a></li>
            <li><a href="page-blank.html#">Help</a></li>
            <li><a href="page-blank.html#">About</a></li>
        </ul>
        -->
    </div>

</div>