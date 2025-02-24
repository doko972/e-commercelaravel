@foreach ($products as $product)
    <div class="col-md-4 col-6">
        <div class="product">
            <div class="product_img">
                <a href="{{ route('product', ['slug' => $product['slug']]) }}">
                    <img src="{{ Storage::url($product->imageUrls()[0])}}" alt="product_img1">
                </a>
                <div class="product_action_box">
                    <ul class="list_none pr_action_btn">
                        <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add
                                To Cart</a></li>
                        <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                        <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a>
                        </li>
                        <li><a href="#"><i class="icon-heart"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="product_info">
                <h6 class="product_title"><a href="{{ route('product', ['slug' => $product['slug']]) }}">{{ $product->name }}</a>
                </h6>
                <div class="product_price">
                    <span class="price">{{ $format_price($product->soldePrice) }}</span>
                    <del>{{ $format_price($product->regularPrice) }}</del>
                    <div class="on_sale">
                        <span>{{ $calculateReduction($product) }}% Off</span>
                    </div>
                </div>
                <div class="rating_wrap">
                    <div class="rating">
                        <div class="product_rate" style="width:80%"></div>
                    </div>
                    <span class="rating_num">(21)</span>
                </div>
                <div class="pr_desc">
                    <p>{{$product->description }}</p>
                </div>
                <div class="list_product_action_box">
                    <ul class="list_none pr_action_btn">
                        <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add
                                To Cart</a></li>
                        <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                        <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a>
                        </li>
                        <li><a href="#"><i class="icon-heart"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endforeach
