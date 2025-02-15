@extends('base')

@section('content')

    @include('doko.components.banner')

    <div class="main_content">
        @include('doko.components.collection')
        <div class="section small_pt pb_70">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="heading_s1 text-center">
                            <h2>Exclusive Products</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="tab-style1">
                            <ul role="tablist" class="nav nav-tabs justify-content-center">
                                <li class="nav-item"><a id="arrival-tab" data-bs-toggle="tab" href="#arrival" role="tab"
                                        aria-controls="arrival" aria-selected="true" class="nav-link active">New
                                        Arrival</a></li>
                                <li class="nav-item"><a id="sellers-tab" data-bs-toggle="tab" href="#sellers" role="tab"
                                        aria-controls="sellers" aria-selected="false" class="nav-link">Best Sellers</a>
                                </li>
                                <li class="nav-item"><a id="featured-tab" data-bs-toggle="tab" href="#featured" role="tab"
                                        aria-controls="featured" aria-selected="false" class="nav-link">Featured</a>
                                </li>
                                <li class="nav-item"><a id="special-tab" data-bs-toggle="tab" href="#special" role="tab"
                                        aria-controls="special" aria-selected="false" class="nav-link">Special Offer
                                    </a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="arrival" role="tabpanel" aria-labelledby="arrival-tab"
                                class="tab-pane fade show active">
                                <div class="row shop_container">
                                    @foreach ($newArrival as $product)
                                        <div class="col-lg-3 col-md-4 col-6">
                                            @include('doko/components/product-item')
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div id="sellers" role="tabpanel" aria-labelledby="sellers-tab" class="tab-pane fade">
                                <div class="row shop_container">
                                    @foreach ($bestSellers as $product)
                                        <div class="col-lg-3 col-md-4 col-6">
                                            @include('doko/components/product-item')
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div id="featured" role="tabpanel" aria-labelledby="featured-tab" class="tab-pane fade">
                                <div class="row shop_container">
                                    @foreach ($featured as $product)
                                        <div class="col-lg-3 col-md-4 col-6">
                                            @include('doko/components/product-item')
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div id="special" role="tabpanel" aria-labelledby="special-tab" class="tab-pane fade">
                            <div class="row shop_container">
                                    @foreach ($specialOffer as $product)
                                    <div class="col-lg-3 col-md-4 col-6">
                                        @include('doko/components/product-item')
                                    </div>
                                    @endforeach
                                </div>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="product">
                                        <div class="product_img"><a href="shop-product-detail.html"><img alt="product_img1"
                                                    src="/assets/files/jupes/jupe_10/524653477845911210422131276651247578029662051684087227597.webp"></a>
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i>
                                                            Add To Cart </a>
                                                    </li>
                                                    <li><a href="shop-compare.html"><i class="icon-shuffle"></i></a>
                                                    </li>
                                                    <li><a href="shop-quick-view.html"><i
                                                                class="icon-magnifier-add"></i></a></li>
                                                    <li><a href="#"><i class="icon-heart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="shop-product-detail.html">
                                                    Jupe plissée fleuri à taille froncée</a></h6>
                                            <div class="product_price"><span class="price">$11.94</span><del>$219.28</del>
                                                <div class="on_sale"><span>35% Off</span></div>
                                            </div>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width: 80%;"></div>
                                                </div><span class="rating_num">(21)</span>
                                            </div>
                                            <div class="pr_desc">
                                                <p>Lorem ipsum dolor sit amet,
                                                    consectetur adipiscing elit. Phasellus blandit massa enim.
                                                    Nullam id varius nunc id varius nunc.</p>
                                            </div>
                                            <div class="pr_switch_wrap">
                                                <div class="product_color_switch"><span data-color="#87554B"
                                                        class="active"></span><span data-color="#333333"></span><span
                                                        data-color="#DA323F"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="product">
                                        <div class="product_img"><a href="shop-product-detail.html"><img alt="product_img1"
                                                    src="/assets/files/jupes/jupe_11/1451201977371506193909225457730933602286799421684087227869.webp"></a>
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i>
                                                            Add To Cart </a>
                                                    </li>
                                                    <li><a href="shop-compare.html"><i class="icon-shuffle"></i></a>
                                                    </li>
                                                    <li><a href="shop-quick-view.html"><i
                                                                class="icon-magnifier-add"></i></a></li>
                                                    <li><a href="#"><i class="icon-heart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="shop-product-detail.html">
                                                    Jupe taille haute à imprimé tacheture</a></h6>
                                            <div class="product_price"><span class="price">$41.16</span><del>$207.89</del>
                                                <div class="on_sale"><span>35% Off</span></div>
                                            </div>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width: 80%;"></div>
                                                </div><span class="rating_num">(21)</span>
                                            </div>
                                            <div class="pr_desc">
                                                <p>Lorem ipsum dolor sit amet,
                                                    consectetur adipiscing elit. Phasellus blandit massa enim.
                                                    Nullam id varius nunc id varius nunc.</p>
                                            </div>
                                            <div class="pr_switch_wrap">
                                                <div class="product_color_switch"><span data-color="#87554B"
                                                        class="active"></span><span data-color="#333333"></span><span
                                                        data-color="#DA323F"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="product">
                                        <div class="product_img"><a href="shop-product-detail.html"><img alt="product_img1"
                                                    src="/assets/files/jupes/jupe_12/136707611525619073042115678929305337482321241684087227967.webp"></a>
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i>
                                                            Add To Cart </a>
                                                    </li>
                                                    <li><a href="shop-compare.html"><i class="icon-shuffle"></i></a>
                                                    </li>
                                                    <li><a href="shop-quick-view.html"><i
                                                                class="icon-magnifier-add"></i></a></li>
                                                    <li><a href="#"><i class="icon-heart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="shop-product-detail.html">
                                                    Jupe courte unicolore à œillets</a></h6>
                                            <div class="product_price"><span class="price">$55.47</span><del>$273.34</del>
                                                <div class="on_sale"><span>35% Off</span></div>
                                            </div>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width: 80%;"></div>
                                                </div><span class="rating_num">(21)</span>
                                            </div>
                                            <div class="pr_desc">
                                                <p>Lorem ipsum dolor sit amet,
                                                    consectetur adipiscing elit. Phasellus blandit massa enim.
                                                    Nullam id varius nunc id varius nunc.</p>
                                            </div>
                                            <div class="pr_switch_wrap">
                                                <div class="product_color_switch"><span data-color="#87554B"
                                                        class="active"></span><span data-color="#333333"></span><span
                                                        data-color="#DA323F"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="product">
                                        <div class="product_img"><a href="shop-product-detail.html"><img alt="product_img1"
                                                    src="/assets/files/jupes/jupe_13/8587721751812044915236772880705449857816544791684087228092.webp"></a>
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i>
                                                            Add To Cart </a>
                                                    </li>
                                                    <li><a href="shop-compare.html"><i class="icon-shuffle"></i></a>
                                                    </li>
                                                    <li><a href="shop-quick-view.html"><i
                                                                class="icon-magnifier-add"></i></a></li>
                                                    <li><a href="#"><i class="icon-heart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="shop-product-detail.html">
                                                    Jupe trapèze avec imprimé floral et nœud</a></h6>
                                            <div class="product_price"><span class="price">$46.77</span><del>$230.39</del>
                                                <div class="on_sale"><span>35% Off</span></div>
                                            </div>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width: 80%;"></div>
                                                </div><span class="rating_num">(21)</span>
                                            </div>
                                            <div class="pr_desc">
                                                <p>Lorem ipsum dolor sit amet,
                                                    consectetur adipiscing elit. Phasellus blandit massa enim.
                                                    Nullam id varius nunc id varius nunc.</p>
                                            </div>
                                            <div class="pr_switch_wrap">
                                                <div class="product_color_switch"><span data-color="#87554B"
                                                        class="active"></span><span data-color="#333333"></span><span
                                                        data-color="#DA323F"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="product">
                                        <div class="product_img"><a href="shop-product-detail.html"><img alt="product_img1"
                                                    src="/assets/files/jupes/jupe_14/673993384631424122014242197518485049644030101684087228136.webp"></a>
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i>
                                                            Add To Cart </a>
                                                    </li>
                                                    <li><a href="shop-compare.html"><i class="icon-shuffle"></i></a>
                                                    </li>
                                                    <li><a href="shop-quick-view.html"><i
                                                                class="icon-magnifier-add"></i></a></li>
                                                    <li><a href="#"><i class="icon-heart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="shop-product-detail.html">
                                                    Jupe crayon à imprimé géométrique zippé</a></h6>
                                            <div class="product_price"><span class="price">$29.57</span><del>$215.78</del>
                                                <div class="on_sale"><span>35% Off</span></div>
                                            </div>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width: 80%;"></div>
                                                </div><span class="rating_num">(21)</span>
                                            </div>
                                            <div class="pr_desc">
                                                <p>Lorem ipsum dolor sit amet,
                                                    consectetur adipiscing elit. Phasellus blandit massa enim.
                                                    Nullam id varius nunc id varius nunc.</p>
                                            </div>
                                            <div class="pr_switch_wrap">
                                                <div class="product_color_switch"><span data-color="#87554B"
                                                        class="active"></span><span data-color="#333333"></span><span
                                                        data-color="#DA323F"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="product">
                                        <div class="product_img"><a href="shop-product-detail.html"><img alt="product_img1"
                                                    src="/assets/files/jupes/jupe_15/5738579584111282483467033919065902821452135221684087228194.webp"></a>
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i>
                                                            Add To Cart </a>
                                                    </li>
                                                    <li><a href="shop-compare.html"><i class="icon-shuffle"></i></a>
                                                    </li>
                                                    <li><a href="shop-quick-view.html"><i
                                                                class="icon-magnifier-add"></i></a></li>
                                                    <li><a href="#"><i class="icon-heart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="shop-product-detail.html">
                                                    Jupe à imprimé floral à taille froncée</a></h6>
                                            <div class="product_price"><span class="price">$55.45</span><del>$213.38</del>
                                                <div class="on_sale"><span>35% Off</span></div>
                                            </div>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width: 80%;"></div>
                                                </div><span class="rating_num">(21)</span>
                                            </div>
                                            <div class="pr_desc">
                                                <p>Lorem ipsum dolor sit amet,
                                                    consectetur adipiscing elit. Phasellus blandit massa enim.
                                                    Nullam id varius nunc id varius nunc.</p>
                                            </div>
                                            <div class="pr_switch_wrap">
                                                <div class="product_color_switch"><span data-color="#87554B"
                                                        class="active"></span><span data-color="#333333"></span><span
                                                        data-color="#DA323F"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="product">
                                        <div class="product_img"><a href="shop-product-detail.html"><img alt="product_img1"
                                                    src="/assets/files/jupes/jupe_16/1264531120533832328596494031926895568308444171684087228233.webp"></a>
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i>
                                                            Add To Cart </a>
                                                    </li>
                                                    <li><a href="shop-compare.html"><i class="icon-shuffle"></i></a>
                                                    </li>
                                                    <li><a href="shop-quick-view.html"><i
                                                                class="icon-magnifier-add"></i></a></li>
                                                    <li><a href="#"><i class="icon-heart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="shop-product-detail.html">
                                                    Jupe taille haute à imprimé floral croisé à nœud</a></h6>
                                            <div class="product_price"><span class="price">$16.05</span><del>$204.01</del>
                                                <div class="on_sale"><span>35% Off</span></div>
                                            </div>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width: 80%;"></div>
                                                </div><span class="rating_num">(21)</span>
                                            </div>
                                            <div class="pr_desc">
                                                <p>Lorem ipsum dolor sit amet,
                                                    consectetur adipiscing elit. Phasellus blandit massa enim.
                                                    Nullam id varius nunc id varius nunc.</p>
                                            </div>
                                            <div class="pr_switch_wrap">
                                                <div class="product_color_switch"><span data-color="#87554B"
                                                        class="active"></span><span data-color="#333333"></span><span
                                                        data-color="#DA323F"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection