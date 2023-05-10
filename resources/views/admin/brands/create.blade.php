@extends('admin.layouts.admin')

@section('title')
    create brands
@endsection

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4 bg-white">
        <div class="mb-4">
            <h5 class="font-weight-bold mt-4">ایجاد برند</h5>
        </div>
        <hr>
        @include('admin.sections.errors')
        <form action="{{ route('Admin.brands.store') }}" method="POST" >
        @csrf

        <div class="form-row mb-0">
            <div class="form-group col-md-4">
                <label for="name">نام</label>
                <input class="form-control" id="name" name="name" type="text" value="{{ old('name')}}">
            </div>

            <div class="form-group col-md-4 ">
                <label for="is_active">وضعیت</label>
                <select class="form-control text-muted" id="is_active" name="is_active">
                    <option value="1" selected>فعال</option>
                    <option value="0" >غیر فعال</option>
                </select>
            </div>
        </div>

        <button class="btn btn-outline-primary mt-0 mb-2 mr-3" type="submit">ثبت</button>
        <a href="{{ route('Admin.brands.index') }}" class="btn btn-dark mt-0 mb-2 mr-3">بازگشت</a>

        </form>
    </div>
 </div>
@endsection
