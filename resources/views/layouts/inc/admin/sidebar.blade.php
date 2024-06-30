<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ Request::is('admin/dashboard') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('admin/dashboard')}}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/orders') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('admin/orders') }}">
              <i class="mdi mdi-sale menu-icon"></i>
              <span class="menu-title">Orders</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/brands') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('admin/brands') }}">
              <i class="mdi mdi-hexagon-multiple menu-icon"></i>
              <span class="menu-title">Brand</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/category') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('admin/category') }}">
                <i class="mdi mdi-view-list menu-icon"></i>
              <span class="menu-title">Category</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/subcategories') ? 'active':'' }}">
            <a class="nav-link" href="{{url('admin/subcategories')}}">
                <i class="mdi mdi-folder menu-icon"></i>
              <span class="menu-title">Sub Category</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/products') ? 'active':'' }}">
            <a class="nav-link" href="{{url('admin/products')}}">
                <i class="mdi mdi-package-variant-closed menu-icon"></i>
              <span class="menu-title">Products</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/colors') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('admin/colors') }}">
                <i class="mdi mdi-palette menu-icon"></i>
              <span class="menu-title">Colors</span>
            </a>
        </li>

        <li class="nav-item {{ Request::is('admin/sizes') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('admin/sizes') }}">
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              <span class="menu-title">Sizes</span>
            </a>
        </li>

        <li class="nav-item {{ Request::is('admin/sliders') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('admin/sliders') }}">
                <i class="mdi mdi-tune-vertical menu-icon"></i>
              <span class="menu-title">Sliders</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/users') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('admin/users') }}">
                <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">User Pages</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/settings') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('admin/settings') }}">
              <i class="mdi mdi-settings menu-icon"></i>
              <span class="menu-title">Setting</span>
            </a>
          </li>

    </ul>
</nav>
