
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle">
      <i class="fa fa-bars" style="margin-top: 4px;"></i>
    </button>

    <!-- Topbar Search -->
    <form action="{{route('Admin.search.user')}}" class="d-none d-sm-inline-block form-inline ml-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
      <div class="input-group">
        <input type="text" name="search" class="form-control bg-light border-0 small order-2" placeholder="جستجو در کاربران ..."
          aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav mr-auto">

      <!-- Nav Item - Search Dropdown (Visible Only XS) -->
      <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
          aria-labelledby="searchDropdown">
          <form action="{{route('Admin.search.user')}}" class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
              <input type="text" name="search" class="form-control bg-light border-0 small order-2" placeholder=" جستجو در کاربران"
                aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Nav Item - Alerts -->
      @php
        $orders = App\models\Order::where('payment_status' , 1)->where('status' , 1)->get()->take(5);
      @endphp
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <!-- Counter - Alerts -->
          <span class="badge badge-danger badge-counter">{{$orders->count()}}</span>
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in text-right"
          aria-labelledby="alertsDropdown">
          <h6 class="dropdown-header">
            آخرین سفارشات
          </h6>
          @foreach ($orders as $order)
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div>
              <div class="small text-gray-500"> زمان سفارش : {{$order->created_at}}</div>
              <span class="font-weight-bold"> مبلغ سفارش : {{$order->paying_amount}} تومان</span>
              <br>
              <span class="font-weight-bold">سفارش دهنده : {{$order->user->cellphone}}</span>
            </div>

            <div class="mr-5">
              <div class="icon-circle bg-primary" data-toggle="modal"
              data-target="#ordersDetiles-{{$order->id}}">
                <i class="fas fa-file-alt text-white"></i>
              </div>
            </div>
           </a>
           @endforeach
          <a class="dropdown-item text-center small text-gray-500" href="{{route('Admin.orders.index')}}"> مشاهده تمام سفارشات </a>
        </div>
      </li>

      <!-- Nav Item - Messages -->
      @php
        $comments = App\models\Comment::where('approved' , 0)->get();
      @endphp
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <!-- Counter - Messages -->
          <span class="badge badge-danger badge-counter">{{$comments->count()}}</span>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in text-right"
          aria-labelledby="messagesDropdown">
          <h6 class="dropdown-header">
            کامنت ها
          </h6>
            @foreach ($comments as $comment)
            <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">
              <div class="font-weight-bold">
                <div class="text-truncate">{{$comment->text}}</div>
                <div class="small text-gray-500"> {{$comment->user->name}}</div>
              </div>

              <div class="dropdown-list-image mr-3">
                <img class="rounded-circle" src="{{$comment->text ? asset('images/home/testi-1.png') : $comment->text}}" alt="">
                <div class="status-indicator bg-success"></div>
              </div>
            </a>
          @endforeach
          <a class="dropdown-item text-center small text-gray-500" href="{{ route('Admin.comments.index') }}"> مشاهده تمام کامنت ها </a>
        </div>
      </li>

      <div class="topbar-divider d-none d-sm-block"></div>

      <!-- Nav Item - User Information -->
      @auth
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <span class="ml-2 d-none d-lg-inline text-gray-600 small"> {{auth()->user()->name}}</span>
          <img class="img-profile rounded-circle" src="{{auth()->user()->avatar ? auth()->user()->avatar : asset('images/bg-login.jpg')}}">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in text-right"
          aria-labelledby="userDropdown">
          <a class="dropdown-item" href="{{route('home.users_profile.index')}}">
            <i class="fas fa-user fa-sm fa-fw ml-2 text-gray-400"></i>
            پروفایل
          </a>
          <a class="dropdown-item" href="#">
            <i class="fas fa-cogs fa-sm fa-fw ml-2 text-gray-400"></i>
            تنظیمات
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw ml-2 text-gray-400"></i>
            خروج
          </a>
        </div>
      </li>
      @endauth
    </ul>
  </nav>

   <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel"> اطمینان از خروج</h5>
         <button class="close ml-0" type="button" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body">آیا از خروج از پنل کاربری خود اطمینان دارید؟</div>
       <div class="modal-footer">
         <a class="btn btn-primary" href="{{route('logout')}}"> خروج </a>
         <button class="btn btn-secondary" type="button" data-dismiss="modal"> لغو </button>
       </div>
     </div>
   </div>
 </div>

 <!-- Modal Order -->
@foreach ($orders as $order)
<div class="modal fade" id="ordersDetiles-{{$order->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" style="direction: rtl;">
                        <form action="#">
                          <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th> تصویر محصول </th>
                                            <th> نام محصول </th>
                                            <th> فی </th>
                                            <th> تعداد </th>
                                            <th> قیمت کل </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderitems as $item)
                                             <tr>
                                                <td class="product-thumbnail">
                                                    <a href="{{route('home.products.show' , ['product' => $item->product->slug])}}">
                                                        <img width="100" src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $item->product->primary_image)}}" alt="">
                                                    </a>
                                                </td>
                                                <td class="product-name">
                                                    <a href="{{route('home.products.show' , ['product' => $item->product->slug])}}">{{$item->product->name}}</a>
                                                </td>
                                                <td class="product-price-cart"><span class="amount">
                                                    {{number_format($item->price)}}
                                                        تومان
                                                    </span></td>
                                                <td class="product-quantity">
                                                    {{$item->quantity}}
                                                </td>
                                                <td class="product-subtotal">
                                                    {{number_format($item->subtotal)}}
                                                    تومان
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal end -->
