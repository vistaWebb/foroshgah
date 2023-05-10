<?php

namespace App\Http\Controllers\Home;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        SEOTools::setTitle('verna.ir');
        SEOTools::setDescription('خرید آنلاین انواع پوشاک و اکسسوری زنانه، مردانه، دخترانه، پسرانه با قیمت عالی در فروشگاه ورنا');
        SEOTools::opengraph()->setUrl(route('home.index'));
        SEOTools::opengraph()->addProperty('type', 'store');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

        $likeProducts = Product::where('category_id' , $product->category->id)->get();
        return view('home.products.show' , compact('product' , 'likeProducts'));
    }
}
