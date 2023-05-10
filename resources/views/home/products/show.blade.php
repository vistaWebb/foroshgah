@extends('home.layouts.home')

@section('title')
    product shop
@endsection
@section('script')
    <script>
        $('.variation-select').on('change' , function(){
            let variation = JSON.parse(this.value);
            let variationPriceDiv = $('.variation-price');
            variationPriceDiv.empty();

            if(variation.is_sale){
                let spanSale = $('<span />' , {
                    class : 'new',
                    text : toPersianNum(number_format(variation.sale_price)) + ' تومان'
                });
                let spanPrice = $('<span />' , {
                    class : 'old',
                    text : toPersianNum(number_format(variation.price)) + ' تومان'
                });

                variationPriceDiv.append(spanSale);
                variationPriceDiv.append(spanPrice);
            }else{
                let spanPrice = $('<span />' , {
                    class : 'new',
                    text : toPersianNum(number_format(variation.price)) + ' تومان'
                });
                variationPriceDiv.append(spanPrice);
            }

            $('.quantity-input').attr('data-max' , variation.quantity);
            $('.quantity-input').val(1);

        });
    </script>
@endsection

@section('content')

<div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('home.index')}}">صفحه محصول</a>
                </li>
                <li class="active">فروشگاه </li>
            </ul>
        </div>
    </div>
</div>

<div class="product-details-area pt-100 pb-95">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-6 order-2 order-sm-2 order-md-1" style="direction: rtl;">
                <div class="product-details-content ml-30">
                    <h2 class="text-right"> {{$product->name}} </h2>
                    <div class="product-details-price variation-price">
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

                    <div class="pro-details-rating-wrap">
                        <div
                        data-rating-stars="5"
                        data-rating-readonly="true"
                        data-rating-value="{{ceil($product->rates->avg('rate'))}}">
                        </div>
                        <span> | </span>
                      <span>({{ $product->approvedComments()->count()}}) دیدگاه  </span>
                    </div>

                    <p class="text-right">
                       {{$product->description}}
                    </p>

                    <div class="pro-details-list text-right">
                        <ul>
                            @foreach ( $product->attributes()->with('attribute')->get() as $attribute)
                            <li>
                                {{$attribute->attribute->name}}
                                :
                                {{$attribute->value}}
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <form action="{{route('home.cart.add')}}" method="POST" >
                        <input type="hidden" name="product_id" value="{{$product->id}}" >
                        @csrf
                        @if ($product->quantity_check)
                            @php
                                if($product->sale_check)
                                {
                                    $variationProductSelected = $product->sale_check;
                                }else{
                                    $variationProductSelected = $product->price_check;
                                }
                            @endphp
                            <div class="pro-details-size-color text-right">
                                <div class="pro-details-size w-50">
                                    <span>{{App\Models\Attribute::find($product->variations->first()->attribute_id)->name}}</span>
                                    <select name="variation" class="form-control variation-select">
                                        @foreach ($product->variations()->where('quantity','>',0)->get() as $variation)
                                        <option value="{{ json_encode($variation->only(['id' , 'quantity','is_sale' , 'sale_price' , 'price'])) }}"
                                            {{ $variationProductSelected->id == $variation->id ? 'selected' : '' }}>
                                            {{$variation->value}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="pro-details-quality">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box quantity-input" type="text" name="qtybutton" value="1"  date-max="5"  />
                                </div>
                                <div class="pro-details-cart">
                                    <button type="submit">افزودن به سبد خرید</button>
                                </div>
                                <div class="pro-details-wishlist">
                                    @auth
                                        @if ($product->checkUserWishList(auth()->id()))
                                            <a href="{{ route('home.wishlist.remove' , ['product' => $product->id ]) }}">
                                                <i class="fas fa-heart" style="color:red"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('home.wishlist.add' , ['product' => $product->id ]) }}">
                                                <i class="sli sli-heart"></i>
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('home.wishlist.add' , ['product' => $product->id ]) }}">
                                            <i class="sli sli-heart"></i>
                                        </a>
                                    @endauth
                                </div>
                                <div class="pro-details-compare">
                                    <a title="Add To Compare" href="{{ route('home.compare.add' , ['product'=>$product]) }}"><i class="sli sli-refresh"></i></a>
                                </div>
                            </div>
                        @else
                            <div class="not-in-stock" >
                                <p class="text-wight">ناموجود</p>
                            </div>
                        @endif
                    </form>


                <div class="pro-details-meta">
                  <span>دسته بندی :</span>
                  <ul>
                    <li><a href="#">{{$product->category->parent->name}} , {{$product->category->name}}</a></li>
                  </ul>
                </div>
                <div class="pro-details-meta">
                  <span>تگ ها :</span>
                  <ul>
                    @foreach ($product->tags as $tag)
                     <li><a href="#">{{$tag->name}} {{$loop->last ? '' : ','}}</a></li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>



            <div class="col-lg-6 col-md-6 order-1 order-sm-1 order-md-2">
                <div class="product-details-img">
                    <div class="zoompro-border zoompro-span">
                        <img width="400px" height="800px" class="zoompro" src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image)}}"
                            data-zoom-image="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image)}}" alt="" />

                    </div>
                    <div id="gallery" class="mt-20 product-dec-slider">
                        <a data-image="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image)}}"
                            data-zoom-image="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image)}}">
                            <img width="100px" height="100px" src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image)}}" alt="">
                        </a>

                        @foreach ($product->images as $image )
                        <a data-image="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image)}}"
                            data-zoom-image="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image)}}">
                            <img width="100px" height="100px" src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image)}}" alt="">
                        </a>
                        @endforeach
                </div>
            </div>

        </div>
    </div>
</div>

<div class="description-review-area pb-95">
    <div id="comments" class="container">
        <div class="row" style="direction: rtl;">
            <div class="col-lg-8 col-md-8">
                <div class="description-review-wrapper">
                    <div class="description-review-topbar nav">
                        <a class="{{ count($errors)>0 ? '' : 'active'}}" data-toggle="tab" href="#des-details1"> توضیحات </a>
                        <a data-toggle="tab" href="#des-details3"> اطلاعات بیشتر </a>
                        <a class="{{ count($errors)>0 ? 'active' : ''}}" data-toggle="tab" href="#des-details2">
                            دیدگاه
                            ({{ $product->approvedComments()->count()}})
                        </a>
                    </div>
                    <div class="tab-content description-review-bottom">
                        <div id="des-details1" class="tab-pane {{ count($errors)>0 ? '' : 'active'}}">
                            <div class="product-description-wrapper">
                                <p class="text-justify">
                                    {{$product->description}}
                                </p>
                            </div>
                        </div>
                        <div id="des-details3" class="tab-pane">
                            <div class="product-anotherinfo-wrapper text-right">
                                <ul>

                                    @foreach ( $product->attributes()->with('attribute')->get() as $attribute)
                                    <li>
                                        <span> {{$attribute->attribute->name}} :</span>
                                        {{$attribute->value}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div id="des-details2" class="tab-pane {{ count($errors)>0 ? 'active' : ''}}">

                            <div class="review-wrapper">
                                @foreach ($product->approvedComments as $comment)
                                <div class="single-review">
                                    <div class="review-img">
                                        <img src="{{$comment->user->avatar == null ? asset('./images/home/user.png') : $comment->user->avatar}}" alt="">
                                    </div>
                                    <div class="review-content w-100 text-right">
                                        <p class="text-right">
                                            {{$comment->text}}
                                        </p>
                                        <div class="review-top-wrap">
                                            <div class="review-name">
                                                <h4>  {{$comment->user->name == null ? 'کاربر گرامی' : $comment->user->name}} </h4>
                                            </div>
                                            <div
                                            data-rating-stars="5"
                                            data-rating-readonly="true"
                                            data-rating-value="{{ceil($comment->user->rates->where('product_id' , $product->id)->avg('rate'))}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="ratting-form-wrapper text-right">
                                <span> نوشتن دیدگاه </span>
                                @include('home.sections.errors')

                                <div class="my-3" id="dataReadonlyReview"
                                data-rating-stars="5"
                                data-rating-value="0"
                                data-rating-input="#rateInput">
                                </div>

                                <div class="ratting-form">
                                    <form action="{{ route('home.comments.store' , ['product'=>$product->id])}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="rating-form-style mb-20">
                                                    <label> متن دیدگاه : </label>
                                                    <textarea name="text"></textarea>
                                                </div>
                                            </div>
                                            <input id="rateInput" type="hidden" name="rate" value="0">
                                            <div class="col-lg-12">
                                                <div class="form-submit">
                                                    <input type="submit" value="ارسال">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="pro-dec-banner">
                    <a href="#"><img src="{{asset('images/home/banner-7.png')}}" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-area pb-70">
    <div class="container">
        <div class="section-title text-center pb-60">
            <h2> محصولات مرتبط </h2>
            <p>
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                چاپگرها و متون بلکه روزنامه و مجله
            </p>
        </div>
        <div class="arrivals-wrap scroll-zoom">
            <div class="ht-products product-slider-active owl-carousel">
          <!--Product Start-->
          @foreach ($likeProducts as $product)
          <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
            <div class="ht-product-inner">
              <div class="ht-product-image-wrap">
                <a href="{{ route('home.products.show' , ['product' => $product->slug])}}" class="ht-product-image">
                  <img height="250" src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image)}}" alt="{{ $product->name}}" alt="Universal Product Style" />
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
                      <a href="{{ route('home.compare.add' , ['product'=>$product]) }}"><i class="sli sli-refresh"></i><span class="ht-product-action-tooltip"> مقایسه
                        </span></a>
                    </li>

                  </ul>
                </div>
              </div>
              <div class="ht-product-content">
                <div class="ht-product-content-inner">
                  <div class="ht-product-categories">
                    <a href="{{ route('home.categories.show' , ['category'=>$product->category->slug])}}">{{$product->category->name}}</a>
                  </div>
                  <h4 class="ht-product-title text-right">
                    <a href="{{ route('home.products.show' , ['product' => $product->slug])}}"> {{$product->name}}  </a>
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
           @endforeach
        <!--Product End-->
            </div>
        </div>
    </div>
</div>


  <!-- Modal -->
  @foreach ($likeProducts as $product)
  <div class="modal fade" id="productModal-{{$product->id}}" tabindex="-1" role="dialog">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">x</span>
           </button>
         </div>
         <div class="modal-body">
           <div class="row">
             <div class="col-md-7 col-sm-12 col-xs-12" style="direction: rtl;">
               <div class="product-details-content quickview-content">
                 <h2 class="text-right mb-4"> {{$product->name}}</h2>
                 <div class="product-details-price variation-price">
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
                 <div class="pro-details-rating-wrap">

                     <div
                     data-rating-stars="5"
                     data-rating-readonly="true"
                     data-rating-value="{{ceil($product->rates->avg('rate'))}}">
                     </div>
                     <span> | </span>
                   <span>({{ $product->approvedComments()->count()}})دیدگاه  </span>
                 </div>
                 <p class="text-right">
                     {{$product->description}}
                 </p>
                 <div class="pro-details-list text-right">
                   <ul class="text-right">

                     @foreach ( $product->attributes()->with('attribute')->get() as $attribute)
                     <li>
                         {{$attribute->attribute->name}}
                         :
                         {{$attribute->value}}
                     </li>
                     @endforeach

                   </ul>
                 </div>

                 <form action="{{route('home.cart.add')}}" method="POST" >
                    <input type="hidden" name="product_id" value="{{$product->id}}" >
                    @csrf
                    @if ($product->quantity_check)
                        @php
                            if($product->sale_check)
                            {
                                $variationProductSelected = $product->sale_check;
                            }else{
                                $variationProductSelected = $product->price_check;
                            }
                        @endphp
                        <div class="pro-details-size-color text-right">
                            <div class="pro-details-size w-50">
                                <span>{{App\Models\Attribute::find($product->variations->first()->attribute_id)->name}}</span>
                                <select name="variation" class="form-control variation-select">
                                    @foreach ($product->variations()->where('quantity','>',0)->get() as $variation)
                                    <option value="{{ json_encode($variation->only(['id' , 'quantity','is_sale' , 'sale_price' , 'price'])) }}"
                                        {{ $variationProductSelected->id == $variation->id ? 'selected' : '' }}>
                                        {{$variation->value}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="pro-details-quality">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box quantity-input" type="text" name="qtybutton" value="1"  date-max="5"  />
                            </div>
                            <div class="pro-details-cart">
                                <button type="submit">افزودن به سبد خرید</button>
                            </div>
                            <div class="pro-details-wishlist">
                                @auth
                                    @if ($product->checkUserWishList(auth()->id()))
                                        <a href="{{ route('home.wishlist.remove' , ['product' => $product->id ]) }}">
                                            <i class="fas fa-heart" style="color:red"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('home.wishlist.add' , ['product' => $product->id ]) }}">
                                            <i class="sli sli-heart"></i>
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('home.wishlist.add' , ['product' => $product->id ]) }}">
                                        <i class="sli sli-heart"></i>
                                    </a>
                                @endauth
                            </div>
                            <div class="pro-details-compare">
                                <a title="Add To Compare" href="{{ route('home.compare.add' , ['product'=>$product]) }}"><i class="sli sli-refresh"></i></a>
                            </div>
                        </div>
                    @else
                        <div class="not-in-stock" >
                            <p class="text-wight">ناموجود</p>
                        </div>
                    @endif
                </form>

                 <div class="pro-details-meta">
                   <span>دسته بندی :</span>
                   <ul>
                     <li><a href="#">{{$product->category->parent->name}} , {{$product->category->name}}</a></li>
                   </ul>
                 </div>
                 <div class="pro-details-meta">
                   <span>تگ ها :</span>
                   <ul>
                     @foreach ($product->tags as $tag)
                      <li><a href="#">{{$tag->name}} {{$loop->last ? '' : ','}}</a></li>
                     @endforeach
                   </ul>
                 </div>
               </div>
             </div>

             <div class="col-md-5 col-sm-12 col-xs-12">
               <div class="tab-content quickview-big-img">
                 <div id="pro-primary{{$product->id}}" class="tab-pane fade show active">
                   <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image)}}" alt="" />
                 </div>
                @foreach ($product->images as $image )
                 <div id="pro-{{$image->id}}" class="tab-pane fade">
                     <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image)}}" alt="" />
                 </div>
                @endforeach
               </div>
               <!-- Thumbnail Large Image End -->
               <!-- Thumbnail Image End -->
               <div class="quickview-wrap mt-15">
                 <div class="quickview-slide-active owl-carousel nav nav-style-2" role="tablist">
                   <a class="active" data-toggle="tab" href="#pro-primary{{$product->id}}">
                     <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image)}}" alt="" /></a>

                   @foreach ($product->images as $image )
                   <a data-toggle="tab" href="#pro-{{$image->id}}">
                     <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image)}}" alt="" />
                   </a>
                   @endforeach
                 </div>
               </div>
             </div>

           </div>
         </div>
       </div>
     </div>
   </div>
 @endforeach
 <!-- Modal end -->
</div>
@endsection




