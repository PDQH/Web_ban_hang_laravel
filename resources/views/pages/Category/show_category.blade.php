@extends('main') {{-- phần mở rộng là file main.blade.php --}}
@section('content')
    {{-- Tạo section để gọi trong file main.blade.php --}}
    <div class="features_items"><!--features_items-->
        @foreach ($category_name as $key => $name)
            <h2 class="title text-center">{{ $name->category_name }}</h2>
        @endforeach
        @foreach ($category_by_id as $key => $product)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <div class="container_pro_image">
                                <img src="{{ URL::to('public/uploads/product/' . $product->product_image) }}"
                                    alt="" />
                            </div>
                            <h2>{{ number_format($product->product_price) . ' ' . 'đ' }}</h2>
                            <p>{{ $product->product_name }}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i
                                    class="fa-solid fa-cart-shopping"></i>Thêm
                                vào
                                giỏ hàng</a>
                        </div>
                        <div class="product-overlay">
                            <form>
                                @csrf
                                <input type="hidden" value="{{ $product->product_id }}"
                                    class="cart_product_id_{{ $product->product_id }}">
                                <input type="hidden" value="{{ $product->product_name }}"
                                    class="cart_product_name_{{ $product->product_id }}">
                                <input type="hidden" value="{{ $product->product_image }}"
                                    class="cart_product_image_{{ $product->product_id }}">
                                <input type="hidden" value="{{ $product->product_price }}"
                                    class="cart_product_price_{{ $product->product_id }}">
                                <input type="hidden" value="1"
                                    class="cart_product_quantity_{{ $product->product_id }}">
                                <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}" class="detail_pro">
                                    <div class="overlay_image">
                                        <span>Xem chi tiết</span>
                                    </div>
                                </a>
                                <div class="overlay-content">
                                    <h2>{{ number_format($product->product_price) . ' ' . 'đ' }}</h2>
                                    <p>{{ $product->product_name }}</p>
                                    {{-- <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa-solid fa-cart-shopping"></i>Thêm vào giỏ hàng</a> --}}
                                    <button type="button" name="add-to-cart" data-id_product="{{ $product->product_id }}"
                                        class="btn btn-default add-to-cart">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        Thêm vào giỏ hàng
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa-solid fa-heart-circle-plus"></i>Thêm vào yêu thích</a></li>
                            <li><a href="#"><i class="fa-solid fa-square-plus"></i>Thêm vào so sánh</a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        @endforeach
    </div><!--features_items-->
    <ul class="pagination pagination-sm m-t-none m-b-none">
        {{-- {!! $category_by_id->links() !!} --}}
        @if ($category_by_id->onFirstPage())
            <li class="disabled"><span>Previous</span></li>
        @else
            <li><a href="{{ $category_by_id->previousPageUrl() }}">Previous</a></li>
        @endif

        @for ($i = 1; $i <= $category_by_id->lastPage(); $i++)
            <li class="{{ $category_by_id->currentPage() == $i ? 'active' : '' }}">
                <a href="{{ $category_by_id->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($category_by_id->hasMorePages())
            <li><a href="{{ $category_by_id->nextPageUrl() }}">Next</a></li>
        @else
            <li class="disabled"><span>Next</span></li>
        @endif
    </ul>
@endsection {{-- Kết thúc section 'content' --}}
