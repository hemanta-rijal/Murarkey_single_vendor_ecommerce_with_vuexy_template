<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->

            <li class="{{ request()->is('operator') ? 'active' : '' }}">
                <a href="/operator">
                    <i class="fa fa-shopping-cart"></i> <span>Orders</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>

            </li>


            <li class="{{ request()->is('operator/not-found-awb') ? 'active' : '' }}">
                <a href="{{ route('operator.not-found-awb.index') }}">
                    <i class="fa fa-shopping-cart"></i> <span>Not Found AWB</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>

            </li>


            <li class="{{ request()->is('operator/barcode') ? 'active' : '' }}">
                <a href="/operator/barcode">
                    <i class="fa fa-barcode"></i> <span>Barcode</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>

            </li>

        </ul>
        <!-- /.sidebar-menu -->

    </section>
    <!-- /.sidebar -->
</aside>