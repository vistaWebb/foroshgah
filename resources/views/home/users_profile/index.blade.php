@extends('home.layouts.home')

@section('title')
  user profile
@endsection

@section('content')
<div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{ route('home.index')}}">صفحه اصلی</a>
                </li>
                <li class="active"> مشخصات کاربری </li>
            </ul>
        </div>
    </div>
</div>

<!-- my account wrapper start -->
<div class="my-account-wrapper pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row text-right" style="direction: rtl;">
                        <div class="col-lg-3 col-md-4">
                            @include('home.sections.profile_sidebar')
                        </div>
                        <!-- My Account Tab Menu End -->
                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">

                                <div class="myaccount-content">
                                    <h3> پروفایل </h3>
                                    <div class="account-details-form">
                                        <form action="{{route('home.profile.update')}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label for="first-name" class="required">
                                                            نام
                                                        </label>
                                                        <input type="text" name="name" id="first-name" value="{{auth()->user()->name == null ? '' : auth()->user()->name}}"/>
                                                        @error('name')
                                                        <p class="input-error-validation">
                                                            <strong>{{ $message }}</strong>
                                                        </p>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="single-input-item">
                                                <label for="email" class="required"> ایمیل </label>
                                                <input type="email" id="email" disabled value="{{auth()->user()->email == null ? '' : auth()->user()->email}}" />
                                            </div>

                                            <div class="single-input-item">
                                                <button class="check-btn sqr-btn" type="submit"> ثبت تغییرات </button>
                                            </div>

                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div> <!-- My Account Tab Content End -->
                    </div>
                </div> <!-- My Account Page End -->
            </div>
        </div>
    </div>
</div>
<!-- my account wrapper end -->



@endsection
