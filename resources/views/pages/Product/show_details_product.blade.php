@extends('main')
@section('content')
    @foreach ($product_detail as $key => $value)
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    <img src="{{ URL::to('/public/uploads/product/' . $value->product_image) }}" alt="" />
                </div>
                {{-- <div id="similar-product" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <a href=""><img src="{{ URL::to('public/frontend/images/similar1.jpg') }}"
                                    alt=""></a>
                            <a href=""><img src="{{ URL::to('public/frontend/images/similar2.jpg') }}"
                                    alt=""></a>
                            <a href=""><img src="{{ URL::to('public/frontend/images/similar3.jpg') }}"
                                    alt=""></a>
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div> --}}

            </div>
            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                    <img src="{{ URL::to('public/frontend/images/new.jpg') }}" class="newarrival" alt="" />
                    <h2>{{ $value->product_name }}</h2>
                    <p>ID sản phẩm: {{ $value->product_id }}</p>
                    <img src="{{ URL::to('public/frontend/images/rating.png') }}" alt="" />
                    <form action="{{ URL::to('/save-cart/') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $value->product_id }}"
                            class="cart_product_id_{{ $value->product_id }}">
                        <input type="hidden" value="{{ $value->product_name }}"
                            class="cart_product_name_{{ $value->product_id }}">
                        <input type="hidden" value="{{ $value->product_image }}"
                            class="cart_product_image_{{ $value->product_id }}">
                        <input type="hidden" value="{{ $value->product_price }}"
                            class="cart_product_price_{{ $value->product_id }}">
                        <div class="container_buy_info">
                            <span>{{ number_format($value->product_price) . ' ' . 'đ' }}</span>
                            <div>
                                <label>Số lượng:</label>
                                <input name="quantity" type="number" min="1"
                                    class="product_qty cart_product_quantity_{{ $value->product_id }}" value="1" />
                                <input name="productid_hidden" type="hidden" value="{{ $value->product_id }}" />

                            </div>
                            {{-- <button type="submit" class="btn btn-fefault cart">
                                <i class="fa fa-shopping-cart"></i>
                                Thêm vào giỏ hàng
                            </button> --}}
                            <input type="button" value="Thêm vào giỏ hàng" class="btn btn-default btn-sm add-to-cart"
                                data-id_product="{{ $value->product_id }}" name="add-to-cart">
                        </div>

                    </form>
                    <p><b>Tình trạng:</b> Còn hàng</p>
                    <p><b>Điều kiện:</b> Mới</p>
                    <p><b>Thương hiệu:</b> {{ $value->brand_name }}</p>
                    <p><b>Danh mục:</b> {{ $value->category_name }}</p>
                    <a href=""><img src="{{ URL::to('public/frontend/images/share.png') }}"
                            class="share img-responsive" alt="" /></a>
                </div><!--/product-information-->
            </div>
        </div><!--/product-details-->
    @endforeach

    <div class="category-tab shop-details-tab"><!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#details" data-toggle="tab">Giới thiệu sản phẩm</a></li>
                <li><a href="#companyprofile" data-toggle="tab">Thông số kỹ thuật</a></li>
                <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="details">
                <p>{!! $value->product_desc !!}</p>
                <p>{!! $value->product_content !!}</p>
            </div>

            <div class="tab-pane fade" id="companyprofile">
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="images/home/gallery1.jpg" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i
                                        class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="reviews">
                <div class="col-sm-12">
                    <ul>
                        <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                        <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                        <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                    </ul>

                    <p><b>Write Your Review</b></p>

                    <form action="#">
                        <span>
                            <input type="text" placeholder="Your Name" />
                            <input type="email" placeholder="Email Address" />
                        </span>
                        <textarea name=""></textarea>
                        <b>Rating: </b> <img src="{{ URL::to('public/frontend/images/rating.png') }}" alt="" />
                        <button type="button" class="btn btn-default pull-right">
                            Submit
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div><!--/category-tab-->

    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">Sản phẩm đề xuất</h2>
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @php $chunks = array_chunk($related->toArray(), 3); @endphp <!-- Chia dữ liệu thành các phần 4 sản phẩm mỗi phần -->
                @foreach ($chunks as $key => $chunk)
                    <div class="item{{ $key === 0 ? ' active' : '' }}"> {{-- Nếu điều kiện $key === 0 đúng, nghĩa là đây là phần tử đầu tiên trong vòng lặp, mảng con đầu tiên được gán class 'active' (hoạt động), để phần tử này được hiển thị khi trang web được tải lần đầu. --}}
                        @foreach ($chunk as $dexuat)
                            <div class="col-sm-4">
                                <!-- Hiển thị thông tin sản phẩm -->
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ URL::to('public/uploads/product/' . $dexuat->product_image) }}"
                                                alt="" />
                                            <h2>{{ number_format($dexuat->product_price) . ' ' . 'đ' }}</h2>
                                            <p>{{ $dexuat->product_name }}</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div><!--/recommended_items-->
@endsection
