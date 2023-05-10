@extends('admin.layouts.admin')

@section('title')
    show attributes
@endsection

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4 bg-white">

        <div class="mb-4">
            <h5 class="font-weight-bold mt-4">ویژگی : {{ $attribute->name }}</h5>
        </div>

        <hr>

        <div class="row">

            <div class="form-group col-md-6">
                <label>نام</label>
                <input class="form-controller" type="text" value="{{ $attribute->name }}" disabled >
            </div>

            <div class="form-group col-md-6">
                <label>تاریخ ایجاد</label>
                <input class="form-controller" type="text" value="{{ verta($attribute->created_at) }}" disabled >
            </div>

            <a href="{{ route('Admin.attributes.index') }}" class="btn btn-dark mt-0 mb-2 mr-3">بازگشت</a>

        </div>
    </div>
 </div>
@endsection
