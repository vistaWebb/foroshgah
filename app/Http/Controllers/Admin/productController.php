<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ProductImageController ;
use App\Http\Controllers\Admin\ProductAttributeController ;
use App\Http\Controllers\Admin\ProductVariationController ;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Tag;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;


class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('admin.products.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $brands = Brand::all();
        $tags = Tag::all();
        $categories = Category::where('parent_id', '!=', 0)->get();

        return view('admin.products.create', compact('brands', 'tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'brand_id'=>'required',
            'is_active'=>'required',
            'tag_ids'=>'required',
            'description'=>'required',
            'primary_image'=>'required|mimes:jpg,jpeg,png,svg',
            'images'=>'required',
            'images.*'=>'mimes:jpg,jpeg,png,svg',
            'category_id'=>'required',
            'attribute_ids'=>'required',
            'attribute_ids.*'=>'required',
            'variation_values'=>'required',
            'variation_values.*.*'=>'required',
            'variation_values.price.*'=>'integer',
            'variation_values.quantity.*'=>'integer',
            'delivery_amount'=>'required|integer',
            'delivery_amount_per_product'=>'nullable|integer',
        ]);

        try
        {
        DB::beginTransaction();
        $productImageController = new ProductImageController();
        $fileNameImages = $productImageController->upload($request->primary_image , $request->images);

        $product = Product::create([
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'primary_image' => $fileNameImages['fileNamePrimaryImage'],
            'description' => $request->description,
            'is_active' => $request->is_active,
            'delivery_amount' => $request->delivery_amount,
            'delivery_amount_per_product' => $request->delivery_amount_per_product,
        ]);

        foreach($fileNameImages['fileNameImages'] as $fileNameImage)
        {
            ProductImage::create([
                'product_id' => $product->id,
                'image' => $fileNameImage
            ]);
        }

        $ProductAttributeController = new ProductAttributeController();
        $ProductAttributeController->store($request->attribute_ids , $product);

        $category = Category::find($request->category_id);
        $ProductVariationController = new ProductVariationController();
        $ProductVariationController->store($request->variation_values , $category->attributes()->wherePivot('is_variation' , 1)->first()->id , $product);

        $product->tags()->attach($request->tag_ids);


        DB::commit();
        }catch(\Exception $ex)
        {
            DB::rollBack();
            alert()->error('  مشکل در ایجاد  محصول ', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }

        alert()->success('با موفقیت انجام شد','محصول با موفقیت ایجاد شد');
        return redirect()->route('Admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $productAttributes = $product->attributes()->with('attribute')->get();
        $productVariations = $product->variations;
        $images = $product->images;

        return view('admin.products.show', compact('product' , 'productAttributes' ,'productVariations' , 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $tags = Tag::all();

        $productAttributes = $product->attributes()->with('attribute')->get();
        $productVariations = $product->variations;

        return view('admin.products.edit' , compact('product' , 'brands' , 'tags' , 'productAttributes' , 'productVariations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required',
            'brand_id'=>'required|exists:brands,id',
            'is_active'=>'required',
            'tag_ids'=>'required|exists:tags,id',
            'description'=>'required',
            'attribute_values'=>'required',
            'variation_values'=>'required',
            'variation_values.*.price'=>'required|integer',
            'variation_values.*.quantity'=>'required|integer',
            'variation_values.*.sale_price'=>'nullable|integer',
            'variation_values.*.date_on_sale_from'=>'nullable|date',
            'variation_values.*.date_on_sale_to'=>'nullable|date',
            'delivery_amount'=>'required|integer',
            'delivery_amount_per_product'=>'nullable|integer',
        ]);

        try
        {
        DB::beginTransaction();

        $product ->update([
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'description' => $request->description,
            'is_active' => $request->is_active,
            'delivery_amount' => $request->delivery_amount,
            'delivery_amount_per_product' => $request->delivery_amount_per_product,
        ]);

        $ProductAttributeController = new ProductAttributeController();
        $ProductAttributeController->update($request->attribute_values);

        $ProductVariationController = new ProductVariationController();
        $ProductVariationController->update($request->variation_values);

        $product->tags()->sync($request->tag_ids);


        DB::commit();
        }catch(\Exception $ex)
        {
            DB::rollBack();
            alert()->error('  مشکل در ویرایش  محصول ', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }

        alert()->success('با موفقیت انجام شد','محصول با موفقیت ویرایش شد');
        return redirect()->route('Admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function editCategory(Request $request, Product $product)
    {
        $categories = Category::where('parent_id', '!=', 0)->get();
        return view('admin.products.edit-category' , compact('product' , 'categories'));
    }

    public function updateCategory(Request $request, Product $product)
    {
        $request->validate([
            'category_id'=>'required',
            'attribute_ids'=>'required',
            'attribute_ids.*'=>'required',
            'variation_values'=>'required',
            'variation_values.*.*'=>'required',
            'variation_values.price.*'=>'integer',
            'variation_values.quantity.*'=>'integer',
        ]);

        try
        {
        DB::beginTransaction();

        $product->update([
            'category_id' => $request->category_id,
        ]);

        $ProductAttributeController = new ProductAttributeController();
        $ProductAttributeController->change($request->attribute_ids , $product);

        $category = Category::find($request->category_id);
        $ProductVariationController = new ProductVariationController();
        $ProductVariationController->change($request->variation_values , $category->attributes()->wherePivot('is_variation' , 1)->first()->id , $product);

        DB::commit();
        }catch(\Exception $ex)
        {
            DB::rollBack();
            alert()->error('  مشکل در ایجاد  محصول ', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }

        alert()->success('با موفقیت انجام شد','محصول با موفقیت ایجاد شد');
        return redirect()->route('Admin.products.index');
    }
}

