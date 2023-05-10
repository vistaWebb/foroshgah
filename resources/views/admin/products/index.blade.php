@extends('admin.layouts.admin')

@section('title')
    products index
@endsection

@section('content')

<!-- Content Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
        <div class=" d-flex flex-column text-center flex-md-row justify-content-between mb-4">
            <h5 class="font-weight-bold mt-4">لیست  محصولات ({{$products->total()}})</h5>
            <div>
                <a class="btn btn-sm btn-outline-primary mt-4" href="{{ route('Admin.products.create')}}" >
                    <i class="fa fa-plus"></i>
                    ایجاد محصول
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>نام برند</th>
                        <th>نام دسته بندی</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key=>$product)
                        <tr>
                            <th>
                                {{ $products->firstItem() + $key }}
                            </th>
                            <th>
                                <a href="{{route('Admin.products.show' , ['product' => $product->id]) }}">
                                    {{ $product->name }}
                                </a>
                            </th>
                            <th>
                                <a href="{{route('Admin.brands.show' , ['brand' => $product->brand->id]) }}">
                                    {{ $product->brand->name}}
                                </a>
                            </th>
                            <th>
                                    {{ $product->category->name}}
                            </th>
                            <th>
                                <span class="{{$product->getRawOriginal('is_active') ? 'text-success' : 'text-danger'}}">
                                    {{ $product->is_active }}
                                </span>
                            </th>

                            <th>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        عملیات
                                    </button>
                                    <div class="dropdown-menu">

                                        <a href="{{ route('Admin.products.edit' , ['product'=>$product->id]) }}"
                                            class="dropdown-item text-right"> ویرایش محصول </a>

                                        <a href="{{ route('Admin.products.images.edit' , ['product'=>$product->id]) }}"
                                            class="dropdown-item text-right"> ویرایش تصاویر </a>

                                        <a href="{{ route('Admin.products.category.edit' , ['product'=>$product->id]) }}"
                                            class="dropdown-item text-right"> ویرایش دسته بندی و ویژگی </a>

                                    </div>
                                </div>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{$products->render()}}
        </div>
    </div>
</div>
@endsection
