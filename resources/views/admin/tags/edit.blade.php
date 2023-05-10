@extends('admin.layouts.admin')

@section('title')
    edit tags
@endsection

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4 bg-white">
        <div class="mb-4">
            <h5 class="font-weight-bold mt-4">ویرایش تگ {{ $tag->name }} </h5>
        </div>
        <hr>
        @include('admin.sections.errors')
        <form action="{{ route('Admin.tags.update' , ['tag' => $tag->id ])}}" method="POST" >
        @csrf
        @method('put')

        <div class="form-row mb-0">

            <div class="form-group col-md-12">
                <label for="name">نام</label>
                <input class="form-controller" id="name" name="name" type="text" value="{{ $tag->name }}">
            </div>

            <button class="btn btn-outline-primary mt-0 mb-2 mr-3" type="submit">ویرایش</button>
            <a href="{{ route('Admin.tags.index') }}" class="btn btn-dark mt-0 mb-2 mr-3">بازگشت</a>

        </div>

        </form>
    </div>
 </div>
@endsection
