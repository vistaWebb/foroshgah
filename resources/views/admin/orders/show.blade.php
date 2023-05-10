@extends('admin.layouts.admin')

@section('title')
    show orders
@endsection

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4 bg-white">

        <div class="mb-4">
            <h5 class="font-weight-bold mt-4">سفارش : {{ $order->id }}</h5>
        </div>

        <hr>

        <div class="row">

            <div class="form-group col-md-3">
                <label>نام کاربر</label>
                <input class="form-control" type="text" value="{{ $order->user->name == null ? 'کاربر گرامی' : $order->user->name }}" disabled >
            </div>
            <div class="form-group col-md-3">
                <label>کوپن </label>
                <input class="form-control" type="text" value="{{ $order->Coupon_id == null ? 'استفاده نشده ' : $order->coupon->name }}" disabled >
            </div>
            <div class="form-group col-md-3">
                <label>وضعیت </label>
                <input class="form-control" type="text" value="{{ $order->status}}" disabled >
            </div>
            <div class="form-group col-md-3">
                <label>مبلغ </label>
                <input class="form-control" type="text" value="{{ $order->total_amount}}" disabled >
            </div>
            <div class="form-group col-md-3">
                <label>هزینه ارسال </label>
                <input class="form-control" type="text" value="{{ $order->delivery_amount}}" disabled >
            </div>
            <div class="form-group col-md-3">
                <label>مبلغ کد تخفیف </label>
                <input class="form-control" type="text" value="{{ $order->coupon_amount}}" disabled >
            </div>
            <div class="form-group col-md-3">
                <label>مبلغ پرداختی </label>
                <input class="form-control" type="text" value="{{ $order->paying_amount}}" disabled >
            </div>
            <div class="form-group col-md-3">
                <label>نوع پرداخت </label>
                <input class="form-control" type="text" value="{{ $order->payment_type}}" disabled >
            </div>
            <div class="form-group col-md-3">
                <label>وضعیت پرداخت </label>
                <input class="form-control" type="text" value="{{ $order->payment_status}}" disabled >
            </div>
            <div class="form-group col-md-3">
                <label>تاریخ ایجاد</label>
                <input class="form-control" type="text" value="{{ verta($order->created_at) }}" disabled >
            </div>
            <div class="form-group col-md-12">
                <label>آدرس </label>
                <trxtarea class="form-control" disabled > {{ $order->address->address}} </trxtarea>
            </div>
            <hr>
            <div class="form-group col-md-12">
                <h5>محصولات</h5>
                <div class="table-responsive">
                    <table  class="table table-bordered table-striped text-center">
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
                                        <a href="{{route('Admin.products.show' , ['product' => $item->product->id])}}">
                                            <img width="100" height="100" src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $item->product->primary_image)}}" alt="">
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <a href="{{route('Admin.products.show' , ['product' => $item->product->id])}}">{{$item->product->name}}</a>
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
            </div>
        </div>
        <a href="{{ route('Admin.orders.index') }}" class="btn btn-dark mt-0 mb-2 mr-3">بازگشت</a>
    </div>
 </div>
@endsection
