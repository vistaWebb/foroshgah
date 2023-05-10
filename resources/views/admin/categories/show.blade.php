@extends('admin.layouts.admin')

@section('title')
    show categories
@endsection

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4 bg-white">
        <div class="mb-4">
            <h5 class="font-weight-bold mt-4">دسته بندی : {{ $category->name }}</h5>
        </div>

        <hr>

        <div class="row mb-3">

            <div class="form-group col-md-3">
                <label>نام</label>
                <input class="form-control" type="text" value="{{ $category->name }}" disabled >
            </div>
            <div class="form-group col-md-3">
                <label>نام انگلیسی</label>
                <input class="form-control" type="text" value="{{ $category->slug }}" disabled >
            </div>
            <div class="form-group col-md-3">
                <label>والد </label>
                <div class="form-control" style="background-color:#eaecf4">
                    @if ($category->parent_id==0)
                        {{ $category->name }}
                    @else
                        {{$category->parent->name }}
                    @endif
                </div>
            </div>
            <div class="form-group col-md-3">
                <label>وضعیت </label>
                <input class="form-control" type="text" value="{{($category->is_active) }}" disabled >
            </div>
            <div class="form-group col-md-3">
                <label> ایکون</label>
                <input class="form-control" type="text" value="{{($category->icon) }}" disabled >
            </div>
            <div class="form-group col-md-3">
                <label>تاریخ ایجاد</label>
                <input class="form-control" type="text" value="{{ verta($category->created_at) }}" disabled >
            </div>
            <div class="form-group col-md-12">
                <label> توضیحات</label>
                <textarea class="form-control" disabled > {{($category->icon) }} </textarea>
            </div>
            <div class="col-md-12">
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <label>ویژگی ها </label>
                        <div class="form-control" style="background-color:#eaecf4">
                            @foreach ($category->attributes as $attribute)
                                {{$attribute->name}} {{$loop->last? '' : '،'}}
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>ویژگی های قابل فیلتر </label>
                        <div class="form-control" style="background-color:#eaecf4">
                            @foreach ($category->attributes()->wherePivot('is_filter' , 1)->get() as $attribute)
                                {{$attribute->name}} {{$loop->last? '' : '،'}}
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>ویژگی های متغیر  </label>
                        <div class="form-control" style="background-color:#eaecf4">
                            @foreach ($category->attributes()->wherePivot('is_variation' , 1)->get() as $attribute)
                                {{$attribute->name}}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('Admin.categories.index') }}" class="btn btn-dark mt-0 mb-2 mr-3">بازگشت</a>
    </div>
 </div>
@endsection
