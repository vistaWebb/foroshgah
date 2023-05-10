@extends('admin.layouts.admin')

@section('title')
    show roles
@endsection

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4 bg-white">

        <div class="mb-4">
            <h5 class="font-weight-bold mt-4">برند : {{ $role->name }}</h5>
        </div>
        <hr>
        <div class="row">
            <div class="form-group col-md-4">
                <label>نام</label>
                <input class="form-control" type="text" value="{{ $role->name }}" disabled >
            </div>
            <div class="form-group col-md-4">
                <label>نام نمایشی</label>
                <input class="form-control" type="text" value="{{ $role->display_name }}" disabled >
            </div>
            <div class="accordion col-md-12 mt-3 mb-4" id="accordionPermission">
                <div class="card">
                    <div class="card-header p-1" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-right" type="button" data-toggle="collapse"
                                data-target="#collapsePermission" aria-expanded="true" aria-controls="collapseOne">
                                مجوز های دسترسی
                            </button>
                        </h2>
                    </div>

                    <div id="collapsePermission" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#accordionPermission">
                        <div class="card-body row">
                            @foreach ($role->permissions as $permission)
                                <div class="col-md-3">
                                    <span>{{$permission->display_name}}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('Admin.roles.index') }}" class="btn btn-dark mt-0 mb-2 mr-3">بازگشت</a>

        </div>
    </div>
 </div>
@endsection
