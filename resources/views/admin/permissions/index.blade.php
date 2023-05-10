@extends('admin.layouts.admin')

@section('title')
    permissions index
@endsection

@section('content')

<!-- Content Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
        <div class="d-flex flex-column text-center flex-md-row justify-content-between mb-4">
            <h5 class="font-weight-bold mt-4">لیست پرمیژن ها ({{$permissions->total()}})</h5>
           <div>
            <a class="btn btn-sm btn-outline-primary mt-4" href="{{ route('Admin.permissions.create')}}" >
                <i class="fa fa-plus"></i>
                ایجاد پرمیژن
            </a>
           </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>نام نمایشی</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $key=>$permission)
                        <tr>
                            <th>
                                {{ $permissions->firstItem() + $key }}
                            </th>
                            <th>
                                    {{ $permission->name }}
                            </th>
                            <th>
                                    {{ $permission->display_name }}
                            </th>
                            <th>
                                <a class="btn btn-sm btn-outline-info mr-3" href="{{ route('Admin.permissions.edit', ['permission' => $permission->id])  }}"> ویرایش </a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{$permissions->render()}}
        </div>
    </div>
</div>
@endsection
