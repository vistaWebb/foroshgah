@extends('admin.layouts.admin')

@section('title')
    banners index
@endsection

@section('content')

<!-- Content Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
        <div class="d-flex flex-column text-center flex-md-row justify-content-between mb-4">
            <h5 class="font-weight-bold mt-4">لیست بنرها ({{$banners->total()}})</h5>
           <div>
            <a class="btn btn-sm btn-outline-primary mt-4" href="{{ route('Admin.banners.create')}}" >
                <i class="fa fa-plus"></i>
                ایجاد بنر
            </a>
           </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>تصویر</th>
                        <th>عنوان</th>
                        <th>متن</th>
                        <th>اولویت</th>
                        <th>وضعیت</th>
                        <th>نوع</th>
                        <th>متن دکمه</th>
                        <th>لینک دکمه</th>
                        <th>آیکون دکمه</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $key=>$banner)
                        <tr>
                            <th>
                                {{ $banners->firstItem() + $key }}
                            </th>
                            <th>
                                <a target="_blank" href="{{url(env('BANNER_IMAGES_UPLOAD_PATH').$banner->image)}}">
                                    {{$banner->image}}
                                </a>
                            </th>
                            <th>
                                    {{ $banner->title }}
                            </th>
                            <th>
                                    {{ $banner->text }}
                            </th>
                            <th>
                                    {{ $banner->priority }}
                            </th>
                            <th>
                                <span class="{{$banner->getRawOriginal('is_active') ? 'text-success' : 'text-danger'}}">
                                    {{ $banner->is_active }}
                                </span>
                            </th>
                            <th>
                                {{ $banner->type }}
                            </th>
                            <th>
                                {{ $banner->button_text }}
                            </th>
                            <th>
                                {{ $banner->button_link }}
                            </th>
                            <th>
                                {{ $banner->button_icon }}
                            </th>
                            <th>
                                <form action="{{ route('Admin.banners.destroy' , ['banner' => $banner->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger mr-3 mb-2" >حذف</button>
                                </form>
                                <a class="btn btn-sm btn-outline-info mr-3" href="{{ route('Admin.banners.edit', ['banner' => $banner->id])  }}"> ویرایش </a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{$banners->render()}}
        </div>
    </div>
</div>
@endsection
