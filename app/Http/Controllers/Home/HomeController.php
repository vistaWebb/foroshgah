<?php

namespace App\Http\Controllers\Home;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Setting;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use TimeHunter\LaravelGoogleReCaptchaV3\Validations\GoogleReCaptchaV3ValidationRule;

class HomeController extends Controller
{
    public function index()
    {
        // auth()->loginUsingId(1);
        SEOTools::setTitle('verna.ir');
        SEOTools::setDescription('خرید آنلاین انواع پوشاک و اکسسوری زنانه، مردانه، دخترانه، پسرانه با قیمت عالی در فروشگاه ورنا');
        SEOTools::opengraph()->setUrl(route('home.index'));
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

        $sliders = Banner::where('type' , 'slider')->where('is_active' , 1)->orderBy('priority')->get();
        $indexTopBanners = Banner::where('type' , 'index-top')->where('is_active' , 1)->orderBy('priority')->get();
        $indexBottomBanners = Banner::where('type' , 'index-bottom')->where('is_active' , 1)->orderBy('priority')->get();

        $products = Product::where('is_active' , 1)->get()->take(5);
        $womenProducts = Product::where('category_id' , 5)->get()->take(5);
        $menProducts = Product::where('category_id' , 4)->get()->take(5);

        return view('home.index' , compact('sliders' , 'indexTopBanners' , 'indexBottomBanners' , 'products' , 'womenProducts' , 'menProducts'));
    }

    public function aboutUs()
    {
        SEOTools::setTitle('verna.ir');
        SEOTools::setDescription('خرید آنلاین انواع پوشاک و اکسسوری زنانه، مردانه، دخترانه، پسرانه با قیمت عالی در فروشگاه ورنا');
        SEOTools::opengraph()->setUrl(route('home.about-us'));
        SEOTools::opengraph()->addProperty('type', 'store');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

        $bottomBanners = Banner::where('type' , 'index-bottom')->where('is_active' , 1)->orderBy('priority')->get();
        return view('home.about-us' , compact('bottomBanners'));
    }

    public function contactUs()
    {
        SEOTools::setTitle('verna.ir');
        SEOTools::setDescription('خرید آنلاین انواع پوشاک و اکسسوری زنانه، مردانه، دخترانه، پسرانه با قیمت عالی در فروشگاه ورنا');
        SEOTools::opengraph()->setUrl(route('home.contact-us'));
        SEOTools::opengraph()->addProperty('type', 'store');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

        $setting = Setting::findOrFail(1);
        return view('home.contact-us' , compact('setting'));
    }

    public function contactUsForm(Request $request)
    {
        $request->validate([
            'name'=>'required|string|min:4|max:40',
            'email'=>'required|email',
            'subject'=>'required|string|min:4|max:100',
            'text'=>'required|string|min:4|max:4000',
        ]);


        ContactUs::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'text'=>$request->text,
            // 'g-recaptcha-response'=>[new GoogleReCaptchaV3ValidationRule('contact_us')]
        ]);

        alert()->success('با موفقیت انجام شد','کامنت با موفقیت ارسال شد');
        return redirect()->back();

    }
}
