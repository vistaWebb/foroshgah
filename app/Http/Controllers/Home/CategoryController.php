<?php

namespace App\Http\Controllers\Home;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;

class CategoryController extends Controller
{
    public function show(Product $product , Category $category)
    {
        SEOTools::setTitle('verna.ir');
        SEOTools::setDescription('خرید آنلاین انواع پوشاک و اکسسوری زنانه، مردانه، دخترانه، پسرانه با قیمت عالی در فروشگاه ورنا');
        SEOTools::opengraph()->setUrl(route('home.index'));
        SEOTools::opengraph()->addProperty('type', 'store');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

        $products = $category->products()->filter()->search()->paginate(5);
        $attributes = $category->attributes()->where('is_filter' , 1)->with('values')->get();
        $variation = $category->attributes()->where('is_variation' , 1)->with('variationValues')->first();

        return view('home.categories.show' , compact('category' , 'attributes' , 'variation' , 'products'));
    }

}
