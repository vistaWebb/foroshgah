@extends('home.layouts.home')

@section('title')
    about-us
@endsection

@section('content')

<div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('home.index')}}">صفحه اصلی</a>
                </li>
                <li class="active"> درباره ما </li>
            </ul>
        </div>
    </div>
</div>

<div class="about-story-area pt-100 pb-100" style="direction: rtl;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="story-img">
                    <a href="#"><img src="{{asset('images/home/about_us.jpg')}}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 text-right">
                <div class="story-details pl-50">
                    <div class="story-details-top">
                        <h2> خوش آمدید به  <span> ورنا</span></h2>
                        <p>فروشگاه ورنا از سال 1395 فعالیت خود را در حوزه فروش پوشاک آغاز کرد. تمرکز و توجه ورنا از ابتدا بر کالای برند و اورجینال بود، و ازآنجا که تا آن زمان این نیاز در بازار تأمین نشده بود، ورنا شرایطی رو ایجاد کرد تا مشتریان این امکان را داشته باشند تا به‌راحتی محصولات برند مورد‌نظر خود را با اطمینان خاطر تهیه کنند.</p>
                    </div>
                    <div class="story-details-bottom">
                        <h4>برند‌های موجود در فروشگاه ورنا</h4>
                        <p>تمام تلاش ورنا گرد هم آوردن برند‌هایی محبوب و باکیفیت بالا از تمام نقاط جهان است. برندهایی مثل: فیلا، ری بن، زارا، نایک، ماوی، کوتون، ریباک، پول اند بیر، شنل، جک اند جونز، اچ اند ام، ال سی وایکیکی، سیکو، فندی، دیور، کولینز، کروم، کنوود، آرمانی، زرسام، کوهن، هوگرو، مل اند موژ، پیرکاردین، لوناچی، مارکس اند اسپنسر، صاد، ونس، سوپردرای، نیوا، پلیس، درسا، مک، میگل، هرمس، زرسام، دکوتین، ویلسون، فسیل، دیفکتو، یو اس پولو، منگو، نیو بالانس، سیاوود و...</p>
                    </div>
                    <div class="story-details-bottom">
                        <h4>تنوع محصولات در ورنا</h4>
                        <p>شما می‌توانید انواع پوشاک مردانه، زنانه، بچگانه را در دسته‌بندی‌های مختلف مثل لباس‌های رسمی، لباس راحتی، لباس ورزشی، کفش و صندل، اکسسوری، کلاه، ساعت، عینک، شال و روسری و... را در ورنا به راحتی تهیه کنید.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="feature-area pt-50 pb-50" style="direction: rtl;">
    <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-4 col-md-4">
            <div class="single-feature text-right mb-40">
              <div class="feature-icon">
                <img src="{{asset('images/home/free-shipping.png')}}" alt="" />
              </div>
              <div class="feature-content">
                <h4>لورم ایپسوم</h4>
                <p>لورم ایپسوم متن ساختگی</p>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4">
            <div class="single-feature text-right mb-40 pl-50">
              <div class="feature-icon">
                <img src="{{asset('images/home/support.png')}}" alt="" />
              </div>
              <div class="feature-content">
                <h4>لورم ایپسوم</h4>
                <p>24x7 لورم ایپسوم</p>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4">
            <div class="single-feature text-right mb-40">
              <div class="feature-icon">
                <img src="{{asset('images/home/security.png')}}" alt="" />
              </div>
              <div class="feature-content">
                <h4>لورم ایپسوم</h4>
                <p>لورم ایپسوم متن ساختگی</p>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

<div class="testimonial-area pt-80 pb-95 section-margin-1" style="background-image: url(assets/img/bg/bg-1.jpg);">
    <div class="container">
        <div class="row">
          <div class="col-lg-10 ml-auto mr-auto">
            <div class="testimonial-active owl-carousel nav-style-1">
                <div class="single-testimonial text-center">
                    <img src="{{asset('images/home/testi-1.png')}}" alt="" />
                    <p>چطور میتوانم سفارشم را تحویل بگیرم ؟</p>
                    <p>اکسپرس اگر شما در یکی از شهرهای تهران ، کرج ، اصفهان، تبریز، کرمانشاه، قم، یزد، قزوین، زنجان، اردبیل، گرگان، ارومیه، اراک، خرم آباد، مشهد، اهواز، شیراز، کرمان، بندرعباس، زاهدان، گیلان، مازندران، همدان هستید ، سفارش شما با اکسپرس دیجیکالا تحویل شما میشود.

                        پست پیشتاز:  در صورتی که آدرس شما در محدوده اکسپرس دیجی استایل نیست ، سفارش شما با پست پیشتاز تحویل شما میشود. </p>
                    <div class="client-info">
                      <img src="{{asset('images/home/testi.png')}}" alt="" />
                      <h5> سوالات کاربران</h5>
                    </div>
                </div>
                <div class="single-testimonial text-center">
                    <img src="{{asset('images/home/testi-2.png')}}" alt="" />
                    <p>اگر کالایی که دریافت کرده ام با آنچه در سایت دیده ام مغایرت داشت باید چه کار کنم؟</p>
                    <p>در صورت مشاهده هر گونه مغایرت، لطفا مراتب را به خدمات پس از فروش اطلاع دهید.

                        شما برای این کار می توانید از راه های ارتباطی که در صفحه تماس با ما ذکر شده است استفاده نمایید.

                        همچنین می توانید با مراجعه به قسمت سفارش های تحویل شده در حساب کاربری خود، درخواست بازگشت کالای خود را ثبت نمایید.</p>
                    <div class="client-info">
                      <img src="{{asset('images/home/testi.png')}}" alt="" />
                      <h5> سوالات کاربران </h5>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
</div>

<div class="banner-area pt-100 pb-65">
    <div class="container">
        <div class="row">
            @foreach ($bottomBanners as $banner)
            <div class="col-lg-6 col-md-6 text-right">
                <div class="single-banner mb-30 scroll-zoom">
                <img src="{{ asset(env('BANNER_IMAGES_UPLOAD_PATH') . $banner->image)}}" alt="{{ $banner->image}}" alt="" />
                <div class="{{$loop->last ? 'banner-content banner-position-4' : 'banner-content banner-position-3'}}">
                    <h3>{{$banner->title}} </h3>
                    <h2>{{$banner->text}} </h2>
                    <a href="{{$banner->button_link}}">{{$banner->button_text}}</a>
                </div>
                </div>
            </div>
            @endforeach
        </div>
      </div>
</div>

@endsection
