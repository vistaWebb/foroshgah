<?php

namespace App\Http\Controllers\Home;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompareController extends Controller
{
    public function add(Product $product)
    {
        if(session()->has('compareProducts')){
            if(in_array($product->id ,  session()->get('compareProducts'))){
                alert()->warning('دقت کنید','محصول مورد نظر قبلا به لیست علاقه مندی های شما اضافه شده است.');
                return redirect()->route('home.compare.index');
            }
            session()->push('compareProducts' , $product->id);
        }else{
            session()->put('compareProducts' , [$product->id]);
        }
        alert()->success('با موفقیت انجام شد','محصول مورد نظر با موفقیت اضافه شد');
        return redirect()->route('home.compare.index');
    }

    public function index()
    {
        if(session()->has('compareProducts')){
            $products = Product::findOrFail(session()->get('compareProducts'));
            return view('home.compare.index' , compact('products'));
        }
        alert()->warning('در ابتدا باید محصولی برای مقایسه اضافه کنید', 'دقت کنید');
        return redirect()->back();
    }

    public function remove($productId)
    {
        if(session()->has('compareProducts')){
            foreach(session()->get('compareProducts') as $key=>$item){
                if ($item == $productId){
                    session()->pull('compareProducts.'.$key);
                }
                if(session()->get('compareProducts') == []){
                    session()->forget('compareProducts');
                    return redirect()->route('home.index');
                }
                return redirect()->route('home.compare.index');
            }
        }
        alert()->warning('دقت کنید','لیست مقایسه شما خالی است');
        return redirect()->back();
    }
}
