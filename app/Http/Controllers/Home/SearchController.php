<?php

namespace App\Http\Controllers\Home;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->search;
        $products = Product::where('name' , 'LIKE' , '%'.$keyword.'%')->paginate(3);

        return view('home.search', compact('products'));
    }
}
