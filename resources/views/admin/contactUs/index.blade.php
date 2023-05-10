@extends('admin.layouts.admin')

@section('title')
    contacts index
@endsection

@section('content')

<!-- Content Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
        <div class=" d-flex flex-column text-center flex-md-row justify-content-between mb-4">
            <h5 class="font-weight-bold mt-4">لیست کامنت ها ({{$contacts->total()}})</h5>

        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام کاربر</th>
                        <th>عنوان کامنت </th>
                        <th>متن کامنت </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $key=>$contact)
                        <tr>
                            <th>
                                {{ $contacts->firstItem() + $key }}
                            </th>
                            <th>
                                {{ $contact->name}}
                            </th>
                            <th>
                                {{ $contact->subject}}
                            </th>
                            <th>
                                {{ $contact->text}}
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{$contacts->render()}}
        </div>
    </div>
</div>
@endsection
