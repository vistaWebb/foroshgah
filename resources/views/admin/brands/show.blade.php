@extends('admin.layouts.admin')

@section('title')
    show brands
@endsection

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4 bg-white">

        <div class="mb-4">
            <h5 class="font-weight-bold mt-4">برند : {{ $brand->name }}</h5>
        </div>

        <hr>

        <div class="row">

            <div class="form-group col-md-4">
                <label>نام</label>
                <input class="form-controller" type="text" value="{{ $brand->name }}" disabled >
            </div>

            <div class="form-group col-md-4">
                <label>وضعیت</label>
                <input class="form-controller" type="text" value="{{ $brand->is_active }}" disabled >
            </div>

            <div class="form-group col-md-4">
                <label>تاریخ ایجاد</label>
                <input class="form-controller" type="text" value="{{ verta($brand->created_at) }}" disabled >
            </div>

            <a href="{{ route('Admin.brands.index') }}" class="btn btn-dark mt-0 mb-2 mr-3">بازگشت</a>

        </div>
    </div>
 </div>
@endsection
