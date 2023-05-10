@extends('admin.layouts.admin')

@section('title')
    comments index
@endsection

@section('content')

<!-- Content Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
        <div class=" d-flex flex-column text-center flex-md-row justify-content-between mb-4">
            <h5 class="font-weight-bold mt-4">لیست کامنت ها ({{$comments->total()}})</h5>

        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام کاربر</th>
                        <th>نام محصول</th>
                        <th>متن کامنت </th>
                        <th>وضعیت </th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $key=>$comment)
                        <tr>
                            <th>
                                {{ $comments->firstItem() + $key }}
                            </th>
                            <th>
                                {{ $comment->user->name ==null ? $comment->user->cellphone : $comment->user->name}}
                            </th>
                            <th>
                                <a href=" {{route('Admin.products.show' , ['product' => $comment->product->id])}}">
                                {{ $comment->product->name }}
                                <a>
                            </th>
                            <th>
                                {{ $comment->text}}
                            </th>
                            <th class="{{$comment->getRawOriginal('approved') ? 'text-success' : 'text-danger'}}">
                                {{ $comment->approved}}
                            </th>
                            <th>
                                <a class="btn btn-sm btn-outline-success" href="{{ route('Admin.comments.show', ['comment' => $comment->id])  }}"> نمایش </a>
                                <form action="{{ route('Admin.comments.destroy' , ['comment' => $comment->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger  mb-2" >حذف</button>
                                </form>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{$comments->render()}}
        </div>
    </div>
</div>
@endsection
