<?php

namespace App\Http\Controllers\Home;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishListController extends Controller
{
    public function add(Product $product)
    {
        if(auth()->check()){
            if($product->checkUserWishList(auth()->id())){
                alert()->error(' اختلال در ثبت  ' , 'شما قبلا این محصول را به لیست علاقه مندی خود اضافه نموده اید.')->persistent('حله');
                return redirect()->back();
            }else{
                 Wishlist::create([
                    'user_id' => auth()->id(),
                    'product_id' => $product->id
                ]);
                alert()->success('با تشکر' , 'محصول به علاقه مندی ها اضافه شد');
                return redirect()->back();
            }

        }else{
            alert()->error(' اختلال در ثبت  ' , 'لطفا ابتدا وارد سایت شوید.')->persistent('حله');
            return redirect()->back();
        }
    }

    public function remove(Product $product)
    {
        if(auth()->check()){
            $wishlist = Wishlist::where('product_id' , $product->id)->where('user_id' , auth()->id())->firstOrFail();
            if($wishlist){
                Wishlist::where('product_id' , $product->id)->where('user_id' , auth()->id())->delete();
            }


            alert()->success('با تشکر' , 'محصول از علاقه مندی ها حذف شد');
            return redirect()->back();

        }else{
            alert()->error(' اختلال در ثبت  ' , 'لطفا ابتدا وارد سایت شوید.')->persistent('حله');
            return redirect()->back();
        }
    }

    public function usersProfileIndex()
    {
        $wishlist = Wishlist::where('user_id' , auth()->id())->get();
        return view('home.users_profile.wishlist' , compact('wishlist'));
    }

}
