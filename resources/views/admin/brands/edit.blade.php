@extends('admin.layouts.admin')

@section('title')
    edit brands
@endsection

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4 bg-white">
        <div class="mb-4">
            <h5 class="font-weight-bold mt-4">ویرایش برند {{ $brand->name }} </h5>
        </div>
        <hr>
        @include('admin.sections.errors')
        <form action="{{ route('Admin.brands.update' , ['brand' => $brand->id ])}}" method="POST" >
        @csrf
        @method('put')
        <div class="form-row mb-0">
            <div class="form-group col-md-4">
                <label for="name">نام</label>
                <input class="form-controller" id="name" name="name" type="text" value="{{ $brand->name }}">
            </div>

            <div class="form-group col-md-8 ">
                <label for="is_active">وضعیت</label>
                <select class="form-controller text-muted" id="is_active" name="is_active">
                    <option value="1" {{ $brand->getRawOriginal('is_active') ? '' : 'selected'}} >فعال</option>
                    <option value="0" {{ $brand->getRawOriginal('is_active') ? '' : 'selected'}} >غیر فعال</option>
                </select>
            </div>

                <button class="btn btn-outline-primary mt-0 mb-2 mr-3" type="submit">ویرایش</button>
                <a href="{{ route('Admin.brands.index') }}" class="btn btn-dark mt-0 mb-2 mr-3">بازگشت</a>

        </div>

        </form>
    </div>
 </div>
@endsection
