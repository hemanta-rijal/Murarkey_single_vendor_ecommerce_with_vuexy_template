<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->

            <li class="treeview {{ request()->is('admin/users*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Users</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i>View All
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.users.create') }}"><i class="fa fa-plus"></i>Add new
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.users.sellers-trash') }}"><i class="fa fa-trash"></i>Associate Seller
                            Trash
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('admin.users.trash') }}"><i class="fa fa-trash"></i>Trash
                        </a>
                    </li>

                </ul>
            </li>


            <li class="treeview {{ request()->is('admin/companies*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-bank"></i> <span>Companies</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.companies.index') }}">View All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.companies.index') }}?type=pending"><i></i>Pending
                            Companies</a>
                    </li>

                    <li>
                        <a href="{{ route('admin.companies.trash') }}"><i></i>Trash Items</a>
                    </li>

                </ul>
            </li>

            <li class="treeview {{ request()->is('admin/products*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-laptop"></i> <span>Products</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.products.index') }}">View All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.create') }}">Post a New Product
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}?type=pending"><i></i>Pending
                            Products</a>
                    </li>

                    <li>
                        <a href="{{ route('admin.products.trash') }}"><i></i>Trash Items</a>
                    </li>

                </ul>
            </li>


            <li class="treeview {{ request()->is('admin/flash-sales*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-server"></i> <span>Flash Sales</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.flash-sales.index') }}">View All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.flash-sales.index') }}">Add New
                        </a>
                    </li>
                </ul>
            </li>
        
            <li class="treeview {{ request()->is('admin/system-messages*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-bullhorn"></i> <span>System Messages</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.system-messages.index') }}"><i class="fa fa-wheel"></i>View All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.system-messages.create') }}"><i class="fa fa-plus"></i>Add new
                        </a>
                    </li>
                </ul>
            </li>

            {{--  <li class="treeview {{ request()->is('admin/theme*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-paint-brush"></i> <span>Theme Settings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.theme.index') }}"><i class="fa fa-wheel"></i>View All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.theme.create') }}"><i class="fa fa-plus"></i>Add new
                        </a>
                    </li>
                </ul>
            </li>  --}}

            {{--  <li class="treeview {{ request()->is('admin/metas*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-wrench"></i> <span>Metas</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.metas.index') }}"><i class="fa fa-wheel"></i>View All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.metas.create') }}"><i class="fa fa-plus"></i>Add new
                        </a>
                    </li>
                </ul>
            </li>  --}}

            <li class="treeview {{ request()->is('admin/categories*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-list-ol"></i> <span>Categories</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.categories.index') }}"><i class="fa fa-wheel"></i>View All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.create') }}"><i class="fa fa-plus"></i>Add new
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.order') }}"><i class="fa fa-align-left"></i>Order
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.upload') }}"><i class="fa fa-align-left"></i>Import Form
                            Excel File
                        </a>
                    </li>
                </ul>
            </li>
            {{--  -----------------------system Settings---------------------  --}}
             <li class="{{ request()->is('admin/home-page*') || request()->is('admin/theme*') || request()->is('admin/sliders*') || request()->is('admin/banners*') ? 'active' : '' }}">
                <a href="{!! route('admin.site-settings.index') !!}">
                    <i class="fa fa-server"></i> <span>Site Settings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview {{request()->is('admin/home-page/featured-categories*') ? 'active' : ''}}">
                        <a href="{{ route('admin.featured-categories.index') }}">Featured
                            Categories
                        </a>
                    </li>
                    <li class="treeview {{request()->is('admin/home-page/featured-companies*') ? 'active' : ''}}">
                        <a href="{{ route('admin.featured-companies.index') }}">Featured
                            Companies
                        </a>
                    </li>
                    <li class="treeview {{request()->is('admin/banner*') ? 'active' : ''}}">
                        <a href="{{ route('admin.banners.index') }}">Banners Setting
                        </a>
                    </li>
                     <li class="treeview {{request()->is('admin/site-settings*') ? 'active' : ''}}">
                        <a href="{{ route('admin.site-settings.index') }}">site Settings
                        </a>
                    </li>
                    
                </ul>
            </li>
            {{--  -----------------------system Settings---------------------  --}}
           
            <li class="treeview {{ request()->is('admin/system-settings*') ? 'active' : '' }}">
                <a href="{!! route('admin.system-settings.index') !!}">
                    <i class="fa fa-wrench"></i> <span>System Settings</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
            </li>

            <li class="treeview {{ request()->is('admin/pages*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-file-code-o"></i> <span>Pages</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.pages.index') }}"><i class="fa fa-wheel"></i>View All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pages.create') }}"><i class="fa fa-plus"></i>Add new
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ request()->is('admin/location*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-lemon-o"></i> <span>Location</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.location.cities.index') }}">Cities</a>
                    </li>

                    <li>
                        <a href="{{ route('admin.location.states.index') }}">Province</a>
                    </li>

                    <li>
                        <a href="{{ route('admin.location.countries.index') }}">Countries</a>
                    </li>

                    {{--<li>--}}
                    {{--<a href="{{ route('admin.location.area-code.index') }}">Area Codes</a>--}}
                    {{--</li>--}}
                </ul>
            </li>

            <li class="treeview {{ request()->is('admin/pages/contact-us*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-user-md"></i> <span>Contact Us Form Data</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="/admin/contact-us"><i class="fa fa-wheel"></i>View All
                        </a>
                    </li>
                    <li>
                        <a href="/admin/contact-us?type=unread"><i class="fa fa-plus"></i>Unread Only
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ request()->is('admin/newsletter*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i> <span>Newsletter</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.newsletter.subscribers') }}"><i class="fa fa-wheel"></i>View
                            Subscribers
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-plus"></i>Something Missing
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>