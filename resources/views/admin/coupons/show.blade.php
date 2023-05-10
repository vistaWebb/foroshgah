@extends('admin.layouts.admin')

@section('title')
    show coupons
@endsection

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4 bg-white">

        <div class="mb-4">
            <h5 class="font-weight-bold mt-4">کوپن : {{ $coupon->name }}</h5>
        </div>

        <hr>

        <div class="row">

            <div class="form-group col-md-6">
                <label>نام</label>
                <input class="form-control" type="text" value="{{ $coupon->name }}" disabled >
            </div>
            <div class="form-group col-md-6">
                <label>مبلغ</label>
                <input class="form-control" type="text" value="{{ $coupon->amount }}" disabled >
            </div>

            <div class="form-group col-md-6">
                <label>درصد</label>
                <input class="form-control" type="text" value="{{ $coupon->percentage }}" disabled >
            </div>

            <div class="form-group col-md-6">
                <label>تاریخ ایجاد</label>
                <input class="form-control" type="text" value="{{ verta($coupon->created_at) }}" disabled >
            </div>

            <a href="{{ route('Admin.coupons.index') }}" class="btn btn-dark mt-0 mb-2 mr-3">بازگشت</a>

        </div>
    </div>
 </div>
@endsection
