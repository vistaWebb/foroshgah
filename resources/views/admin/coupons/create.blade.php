@extends('admin.layouts.admin')

@section('title')
    create coupons
@endsection

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4 bg-white">
        <div class="mb-4">
            <h5 class="font-weight-bold mt-4">ایجاد کوپن</h5>
        </div>
        <hr>
        @include('admin.sections.errors')
        <form action="{{ route('Admin.coupons.store') }}" method="POST" >
        @csrf
            <div class="form-row mb-0">
                <div class="form-group col-md-3">
                    <label for="name">نام</label>
                    <input class="form-control" id="name" name="name" type="text" value="{{ old('name')}}">
                </div>
                <div class="form-group col-md-3">
                    <label for="code">کد</label>
                    <input class="form-control" id="code" name="code" type="text" value="{{ old('code')}}">
                </div>
                <div class="form-group col-md-3">
                    <label for="type">نوع</label>
                    <select class="form-control" id="type" name="type" type="text">
                        <option value="amount">مبلغی</option>
                        <option value="percentage">درصدی</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="amount">مبلغ</label>
                    <input class="form-control" id="amount" name="amount" type="text" value="{{ old('amount')}}">
                </div>
                <div class="form-group col-md-3">
                    <label for="percentage">درصد</label>
                    <input class="form-control" id="percentage" name="percentage" type="text" value="{{ old('percentage')}}">
                </div>
                <div class="form-group col-md-3">
                    <label for="max_percentage_amount">حداکثر مبلغ برای نوع درصدی</label>
                    <input class="form-control" id="max_percentage_amount" name="max_percentage_amount" type="text" value="{{ old('max_percentage_amount')}}">
                </div>
                <div class="form-group col-md-3">
                    <label for="expired_at">تاریخ انقضا</label>
                    <input class="form-control" id="expired_at" name="expired_at" type="date" value="{{ old('expired_at ')}}">
                </div>
                <div class="form-group col-md-12">
                    <label for="description">توضیحات</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>

                <button class="btn btn-outline-primary mt-0 mb-2 mr-3" type="submit">ثبت</button>
                <a href="{{ route('Admin.coupons.index') }}" class="btn btn-dark mt-0 mb-2 mr-3">بازگشت</a>
            </div>
        </form>
    </div>
 </div>
@endsection
