@extends('frontend.template')
@section('content')
@if(isset($record))
<div class="sp-area">
    <div class="container">
        <div class="sp-nav">
            <div class="row">
                <div class="col-lg-4">
                    <div class="sp-img_area">
                        <div class="sp-img_slider slick-img-slider kenne-element-carousel" data-slick-options='{
                        "slidesToShow": 1,
                        "arrows": false,
                        "fade": true,
                        "draggable": false,
                        "swipe": false,
                        "asNavFor": ".sp-img_slider-nav"
                        }'>
                            <div class="single-slide red zoom">
                                <img src="/assets/images/product/1-1.jpg" alt="Kenne's Product Image">
                            </div>
                            <div class="single-slide orange zoom">
                                <img src="/assets/images/product/1-2.jpg" alt="Kenne's Product Image">
                            </div>
                            <div class="single-slide brown zoom">
                                <img src="/assets/images/product/2-1.jpg" alt="Kenne's Product Image">
                            </div>
                            <div class="single-slide umber zoom">
                                <img src="/assets/images/product/2-2.jpg" alt="Kenne's Product Image">
                            </div>
                            <div class="single-slide black zoom">
                                <img src="/assets/images/product/3-1.jpg" alt="Kenne's Product Image">
                            </div>
                            <div class="single-slide green zoom">
                                <img src="/assets/images/product/3-2.jpg" alt="Kenne's Product Image">
                            </div>
                        </div>
                        <div class="sp-img_slider-nav slick-slider-nav kenne-element-carousel arrow-style-2 arrow-style-3" data-slick-options='{
                        "slidesToShow": 3,
                        "asNavFor": ".sp-img_slider",
                        "focusOnSelect": true,
                        "arrows" : true,
                        "spaceBetween": 30
                        }' data-slick-responsive='[
                                {"breakpoint":1501, "settings": {"slidesToShow": 3}},
                                {"breakpoint":1200, "settings": {"slidesToShow": 2}},
                                {"breakpoint":992, "settings": {"slidesToShow": 4}},
                                {"breakpoint":768, "settings": {"slidesToShow": 3}},
                                {"breakpoint":575, "settings": {"slidesToShow": 2}}
                            ]'>
                            <div class="single-slide red">
                                <img src="/assets/images/product/1-1.jpg" alt="Kenne's Product Thumnail">
                            </div>
                            <div class="single-slide orange">
                                <img src="/assets/images/product/1-2.jpg" alt="Kenne's Product Thumnail">
                            </div>
                            <div class="single-slide brown">
                                <img src="/assets/images/product/2-1.jpg" alt="Kenne's Product Thumnail">
                            </div>
                            <div class="single-slide umber">
                                <img src="/assets/images/product/2-2.jpg" alt="Kenne's Product Thumnail">
                            </div>
                            <div class="single-slide red">
                                <img src="/assets/images/product/3-1.jpg" alt="Kenne's Product Thumnail">
                            </div>
                            <div class="single-slide orange">
                                <img src="/assets/images/product/3-2.jpg" alt="Kenne's Product Thumnail">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="sp-content">
                        <div class="sp-heading">
                            <h5><a href="#">{{ $record->title }}</a></h5>
                        </div>
                        <span class="reference">Name: {{ $record->title }}</span>
                        <div class="rating-box">
                            <ul>
                                <li><i class="ion-android-star"></i></li>
                                <li><i class="ion-android-star"></i></li>
                                <li><i class="ion-android-star"></i></li>
                                <li class="silver-color"><i class="ion-android-star"></i></li>
                                <li class="silver-color"><i class="ion-android-star"></i></li>
                            </ul>
                        </div>
                        <div class="sp-essential_stuff">
                            <ul>
                                <li>Brands <a href="javascript:void(0)">Buxton</a></li>
                                <li>Code: <a href="javascript:void(0)">{{ $record->sku }}</a></li>
                                <li>Reward Points: <a href="javascript:void(0)">{{ $record->qty }}</a></li>
                                <li>Availability: <a href="javascript:void(0)">{{ ($record->qty > 0)? "Còn hàng" : "Hết hàng" }}</a></li>
                                <li>Giá: <a href="javascript:void(0)"><span>{{ number_format(($record->price_sale > 0)? $record->price_sale : $record->price) }}</span></a></li>
                            </ul>
                        </div>
                        <div class="product-size_box">
                            <span>Size</span>
                            <select class="myniceselect nice-select">
                                <option value="1">S</option>
                                <option value="2">M</option>
                                <option value="3">L</option>
                                <option value="4">XL</option>
                            </select>
                        </div>
                        <div class="quantity">
                            <label>Quantity</label>
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" value="1" type="text">
                                <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                            </div>
                        </div>
                        <div class="qty-btn_area">
                            <ul>
                                <li><a class="qty-cart_btn" href="cart.html">Add To Cart</a></li>
                                <li><a class="qty-wishlist_btn" href="wishlist.html" data-toggle="tooltip" title="Add To Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                </li>
                                <li><a class="qty-compare_btn" href="compare.html" data-toggle="tooltip" title="Compare This Product"><i class="ion-ios-shuffle-strong"></i></a></li>
                            </ul>
                        </div>
                        <div class="kenne-tag-line">
                            <h6>Tags:</h6>
                            <a href="javascript:void(0)">scarf</a>,
                            <a href="javascript:void(0)">jacket</a>,
                            <a href="javascript:void(0)">shirt</a>
                        </div>
                        <div class="kenne-social_link">
                            <ul>
                                <li class="facebook">
                                    <a href="https://www.facebook.com" data-toggle="tooltip" target="_blank" title="Facebook">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="twitter">
                                    <a href="https://twitter.com" data-toggle="tooltip" target="_blank" title="Twitter">
                                        <i class="fab fa-twitter-square"></i>
                                    </a>
                                </li>
                                <li class="youtube">
                                    <a href="https://www.youtube.com" data-toggle="tooltip" target="_blank" title="Youtube">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                                <li class="google-plus">
                                    <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank" title="Google Plus">
                                        <i class="fab fa-google-plus"></i>
                                    </a>
                                </li>
                                <li class="instagram">
                                    <a href="https://rss.com" data-toggle="tooltip" target="_blank" title="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-tab_area-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sp-product-tab_nav">
                    <div class="product-tab">
                        <ul class="nav product-menu">
                            <li><a class="active" data-toggle="tab" href="#description"><span>Mô tả</span></a></li>
                            <li><a data-toggle="tab" href="#specification"><span>Chi tiết cầu hình</span></a></li>
                        </ul>
                    </div>
                    <div class="tab-content uren-tab_content">
                        <div id="description" class="tab-pane active show" role="tabpanel">
                            <div class="product-description">
                                <ul>
                                    <li>
                                        {{ $record->content }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="specification" class="tab-pane" role="tabpanel">
                            @if( isset($setting))
                            <table class="table table-bordered specification-inner_stuff">
                                <tbody>
                                    <tr>
                                        <td colspan="2"><strong>Cấu hình</strong></td>
                                    </tr>
                                </tbody>
                                @foreach($setting as $key=>$value)
                                <tbody>
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $value }}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            @endif
                        </div>
                        <div id="reviews" class="tab-pane" role="tabpanel">
                            <div class="tab-pane active" id="tab-review">
                                <form class="form-horizontal" id="form-review">
                                    <div id="review">
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 50%;"><strong>Customer</strong></td>
                                                    <td class="text-right">26/10/19</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <p>Good product! Thank you very much</p>
                                                        <div class="rating-box">
                                                            <ul>
                                                                <li><i class="ion-android-star"></i></li>
                                                                <li><i class="ion-android-star"></i></li>
                                                                <li><i class="ion-android-star"></i></li>
                                                                <li><i class="ion-android-star"></i></li>
                                                                <li><i class="ion-android-star"></i></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h2>Write a review</h2>
                                    <div class="form-group required">
                                        <div class="col-sm-12 p-0">
                                            <label>Your Email <span class="required">*</span></label>
                                            <input class="review-input" type="email" name="con_email" id="con_email" required>
                                        </div>
                                    </div>
                                    <div class="form-group required second-child">
                                        <div class="col-sm-12 p-0">
                                            <label class="control-label">Share your opinion</label>
                                            <textarea class="review-textarea" name="con_message" id="con_message"></textarea>
                                            <div class="help-block"><span class="text-danger">Note:</span> HTML is
                                                not
                                                translated!</div>
                                        </div>
                                    </div>
                                    <div class="form-group last-child required">
                                        <div class="col-sm-12 p-0">
                                            <div class="your-opinion">
                                                <label>Your Rating</label>
                                                <span>
                                                <select class="star-rating">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="kenne-btn-ps_right">
                                            <button class="kenne-btn">Continue</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(count( \Helper::BestSale()))
<div class="list-product_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h3>Sản phẩm bán chạy</span></h3>
                    <div class="list-product_arrow"></div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="kenne-element-carousel list-product_slider slider-nav" data-slick-options='{
                "slidesToShow": 3,
                "slidesToScroll": 1,
                "infinite": false,
                "arrows": true,
                "dots": false,
                "spaceBetween": 30,
                "appendArrows": ".list-product_arrow"
                }' data-slick-responsive='[
                {"breakpoint":1200, "settings": {
                "slidesToShow": 2
                }},
                {"breakpoint":768, "settings": {
                "slidesToShow": 1
                }},
                {"breakpoint":575, "settings": {
                "slidesToShow": 1
                }}
            ]'>
            @foreach( \Helper::BestSale() as $item)
                    <div class="product-item">
                        <div class="single-product">
                            <div class="product-img">
                                <a href="{{ route('detailItem',$item->slug) }}">
                                    <img class="primary-img" src="/assets/images/product/8-1.jpg" alt="Kenne's Product Image">
                                </a>
                                @if( $item->price_sale > 0 && $item->price_sale < $item->price)
                                <span class="sticker-2">- {{ round( ($item->price - $item->price_sale) / $item->price * 100 )}}%</span>
                                @endif
                            </div>
                            <div class="product-content">
                                <div class="product-desc_info">
                                    <h3 class="product-name"><a href="{{ route('detailItem',$item->slug) }}">{{ $item->title }}</a>
                                    </h3>
                                    <div class="price-box">
                                    @if( $item->price_sale > 0 && $item->price_sale < $item->price )
                                        <span class="new-price">{{ number_format($item->price_sale) }}₫</span>
                                    @endif
                                        <span class="old-price">{{ number_format($item->price) }}₫</span>
                                    </div>
                                </div>
                                <div class="add-actions">
                                    <ul>
                                        <li><a href="wishlist.html" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="ion-ios-heart-outline"></i></a>
                                        </li>
                                        <li><a href="cart.html" data-toggle="tooltip" data-placement="top" title="Add To cart">Add to cart</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endif
@endsection