@extends('admin.layouts.admin')

@section('title')
    edit users
@endsection

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4 bg-white">
        <div class="mb-4">
            <h5 class="font-weight-bold mt-4">ویرایش بنر</h5>
        </div>
        <hr>
        @include('admin.sections.errors')
        <form action="{{ route('Admin.users.update' , ['user' =>$user]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-row mb-0">

            <div class="form-group col-md-3">
                <label for="name">نام</label>
                <input class="form-control" id="name" name="name" type="text" value="{{ $user->name}}">
            </div>
            <div class="form-group col-md-3">
                <label for="cellphone">شماره تلفن همراه</label>
                <input class="form-control" id="cellphone" name="cellphone" type="text" value="{{ $user->cellphone}}">
            </div>
            <div class="form-group col-md-3">
                <label for="role">نقش کاربر</label>
                <select class="form-control" name="role" id="role">
                    <option></option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ in_array($role->id , $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $role->display_name }}</option>
                    @endforeach
                </select>
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

                    <div id="collapsePermission" class="collapse " aria-labelledby="headingOne"
                        data-parent="#accordionPermission">
                        <div class="card-body row">
                            @foreach ($permissions as $permission)
                            <div class="form-group form-check col-md-3">
                                <input type="checkbox" class="form-check-input"
                                    id="permission_{{ $permission->id }}" name="{{ $permission->name }}"
                                    value="{{ $permission->name }}"
                                    {{ in_array( $permission->id , $user->permissions->pluck('id')->toArray() ) ? 'checked' : '' }}
                                    >
                                <label class="form-check-label mr-3"
                                    for="permission_{{ $permission->id }}">{{ $permission->display_name }}</label>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <button class="btn btn-outline-primary mt-0 mb-2 mr-3" type="submit">ثبت</button>
        <a href="{{ route('Admin.users.index') }}" class="btn btn-dark mt-0 mb-2 mr-3">بازگشت</a>

        </form>
    </div>
 </div>

 @include('sweetalert::alert')
@endsection
