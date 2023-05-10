@extends('home.layouts.home')

@section('title')
    index shop
@endsection

@section('content')
<div class="shop-bottom-area mt-35 p-5">
    <div class="tab-content jump">
      <div class="row ht-products" style="direction: rtl;">
        @foreach ($products as $product)
          <div class="col-xl-3 col-md-6 col-lg-6 col-sm-6">
            <!--Product Start-->
            <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
              <div class="ht-product-inner">
                <div class="ht-product-image-wrap">
                  <a href="{{ route('home.products.show' , ['product' => $product->slug])}}" class="ht-product-image">
                    <img height="300" src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image)}}" alt="{{ $product->name}}" alt="Universal Product Style" />
                  </a>
                  <div class="ht-product-action">
                    <ul>
                      <li>
                        <a href="#" data-toggle="modal" data-target="#productModal-{{$product->id}}"><i
                            class="sli sli-magnifier"></i><span class="ht-product-action-tooltip"> مشاهده سریع
                          </span></a>
                      </li>
                      <li>
                          @auth
                              @if ($product->checkUserWishList(auth()->id()))
                                  <a href="{{ route('home.wishlist.remove' , ['product' => $product->id ]) }}"><i class="fas fa-heart" style="color:red"></i>
                                  <span class="ht-product-action-tooltip">   به لیست علاقه مندی ها اضافه شده است</span></a>
                              @else
                                  <a href="{{ route('home.wishlist.add' , ['product' => $product->id ]) }}"><i class="sli sli-heart"></i>
                                  <span class="ht-product-action-tooltip"> افزودن به لیست علاقه مندی ها </span></a>
                              @endif
                          @else
                              <a href="{{ route('home.wishlist.add' , ['product' => $product->id ]) }}"><i class="sli sli-heart"></i>
                              <span class="ht-product-action-tooltip">افزودن به لیست علاقه مندی ها </span></a>
                          @endauth
                      </li>
                      <li>
                        <a href="#"><i class="sli sli-refresh"></i><span class="ht-product-action-tooltip"> مقایسه
                          </span></a>
                      </li>

                    </ul>
                  </div>
                </div>
                <div class="ht-product-content">
                  <div class="ht-product-content-inner">
                    <div class="ht-product-categories">
                      <a href="#">{{$product->category->name}}</a>
                    </div>
                    <h4 class="ht-product-title text-right">
                      <a href="product-details.html"> {{$product->name}}  </a>
                    </h4>
                    <div class="ht-product-price">
                      @if ($product->quantity_check)
                          @if ($product->sale_check)
                              <span class="new">
                              {{number_format($product->sale_check->sale_price)}}
                              تومان
                              </span>
                              <span class="old">
                              {{number_format($product->sale_check->price)}}
                              تومان
                              </span>
                          @else
                              <span class="new">
                              {{number_format($product->price_check->price)}}
                              تومان
                              </span>
                          @endif
                      @else
                      <div class="not-in-stock" >
                          <p class="text-wight">ناموجود</p>
                      </div>
                      @endif
                    </div>
                    <div class="ht-product-ratting-wrap">
                      <div
                      data-rating-stars="5"
                      data-rating-readonly="true"
                      data-rating-value="{{ceil($product->rates->avg('rate'))}}"
                      >
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <!--Product End-->
          </div>
        @endforeach
      </div>
      <div class="pro-pagination-style text-center mt-30">
        {{$products->links()}}
    </div>
    </div>



</div>

@endsection
