<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion pr-0" id="accordionSidebar">

    <!-- Sidebar - name -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home.index')}}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Verna.ir</div>
    </a>
{{-- {{auth()->loginUsingId(1)}} --}}
    @role('admin')
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{ route('dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span> داشبورد </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading - USERS-->
    <div class="sidebar-heading">
        کاربران
    </div>

    <!-- Nav Item - USERS Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true"
           aria-controls="collapsePages">
            {{-- <i class="fas fa-fw fa-cart-plus"></i> --}}
            <i class="fas fa-laugh-wink fa-2x text-gray-300"></i>
           <span> کاربران </span>
        </a>
        <div id="collapseUsers" class="collapse
         {{request()->is('admin-panel/management/users*') ? 'show' : ''}}
         {{request()->is('admin-panel/management/roles*') ? 'show' : ''}}
         {{request()->is('admin-panel/management/permissions*') ? 'show' : ''}}
         " aria-labelledby="headingPages" data-parent="#accordionSidebar">
           <div class="bg-white py-2 collapse-inner rounded">
             <a class="collapse-item {{request()->is('admin-panel/management/users*') ? 'active' : ''}} " href="{{ route('Admin.users.index') }}"> لیست کاربران</a>
             <a class="collapse-item {{request()->is('admin-panel/management/roles*') ? 'active' : ''}} " href="{{ route('Admin.roles.index')}}"> گروه های کاربری</a>
             <a class="collapse-item {{request()->is('admin-panel/management/permissions*') ? 'active' : ''}} " href="{{ route('Admin.permissions.index') }}"> پرمیژن ها</a>
           </div>
        </div>
    </li>
    @endrole

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading - STORE -->
    <div class="sidebar-heading">
      فروشگاه
    </div>

    <!-- Nav Item - PRODUCTS Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true"
        aria-controls="collapsePages">
        <i class="fas fa-fw fa-cart-plus"></i>
        <span> محصولات </span>
      </a>
      <div id="collapseProducts" class="collapse
      {{request()->is('admin-panel/management/products*') ? 'show' : ''}}
      {{request()->is('admin-panel/management/categories*') ? 'show' : ''}}
      {{request()->is('admin-panel/management/attributes*') ? 'show' : ''}}
      {{request()->is('admin-panel/management/tags*') ? 'show' : ''}}
      {{request()->is('admin-panel/management/comments*') ? 'show' : ''}}
      " aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item {{request()->is('admin-panel/management/products*') ? 'active' : ''}}" href="{{ route('Admin.products.index') }}"> محصولات </a>
          <a class="collapse-item {{request()->is('admin-panel/management/categories*') ? 'active' : ''}}" href="{{ route('Admin.categories.index') }}"> دسته بندی ها</a>
          <a class="collapse-item {{request()->is('admin-panel/management/attributes*') ? 'active' : ''}}" href="{{ route('Admin.attributes.index') }}"> ویژگی ها</a>
          <a class="collapse-item {{request()->is('admin-panel/management/tags*') ? 'active' : ''}}" href="{{ route('Admin.tags.index') }}"> تگ ها</a>
          <a class="collapse-item {{request()->is('admin-panel/management/comments*') ? 'active' : ''}}" href="{{ route('Admin.comments.index') }}"> کامنت ها</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - brands -->
    <li class="nav-item">
        <a class="nav-link " href="{{ route('Admin.brands.index')}}">
          <i class="fas fa-fw fa-table"></i>
          <span> برندها </span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading - ORDERS -->
    <div class="sidebar-heading">
        سفارشات
    </div>

    <!-- Nav Item - ORDERS Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders" aria-expanded="true"
          aria-controls="collapsePages">
          <i class="fas fa-fw fa-cart-plus"></i>
          <span> سفارشات </span>
        </a>
        <div id="collapseOrders" class="collapse
        {{request()->is('admin-panel/management/orders*') ? 'show' : ''}}
        {{request()->is('admin-panel/management/transactions*') ? 'show' : ''}}
        {{request()->is('admin-panel/management/coupons*') ? 'show' : ''}}
        " aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{request()->is('admin-panel/management/orders*') ? 'active' : ''}}" href="{{ route('Admin.orders.index') }}"> سفارشات</a>
            <a class="collapse-item {{request()->is('admin-panel/management/transactions*') ? 'active' : ''}}" href="{{ route('Admin.transactions.index') }}"> تراکنش ها</a>
            <a class="collapse-item {{request()->is('admin-panel/management/coupons*') ? 'active' : ''}}" href="{{ route('Admin.coupons.index') }}"> کوپن ها</a>
          </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading - SETTING -->
    <div class="sidebar-heading">
        تنظیمات
    </div>

    <!-- Nav Item - banners -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('Admin.banners.index')}}">
          <i class="fas fa-fw fa-image"></i>
          <span> بنرها </span>
        </a>
    </li>
     <!-- Nav Item - banners -->
     <li class="nav-item">
        <a class="nav-link" href="{{ route('Admin.contactUs.index')}}">
          <i class="fas fa-fw fa-comments"></i>
          <span> کامنت ها </span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
