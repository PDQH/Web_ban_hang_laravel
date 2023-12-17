<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>392-STORE</title>
    <link href="{{ asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/vendor/font-awesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/sweetalert.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ asset('public/frontend/images/logo_mini.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ asset('public/frontend/images/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ asset('public/frontend/images/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{ asset('public/frontend/images/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed"
        href="{{ asset('public/frontend/images/apple-touch-icon-57-precomposed.png') }}">
</head><!--/head-->

<body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa-solid fa-phone"></i></i> 093922002</a></li>
                                <li><a href="#"><i class="fa-solid fa-envelope"></i></i> 392store@gmail.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-google-plus-g"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{ URL::to('/trang-chu') }}"><img
                                    src="{{ asset('public/frontend/images/392logo.png') }}" alt="" /></a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                {{-- <li><a href="{{ URL::to('/login_checkout') }}"><i class="fa-solid fa-user"></i> Tài
                                        khoản</a>
                                </li> --}}
                                {{-- <li>
                                    <a href="#">
                                        <i class="fa-solid fa-heart"></i>
                                        Yêu thích
                                    </a>
                                </li> --}}
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    $shipping_id = Session::get('shipping_id');
                                    if ($customer_id != null && $shipping_id == null) {
                                    ?>
                                <li>
                                    <a href="{{ URL::to('/checkout') }}">
                                        <i class="fa-solid fa-money-bill"></i>
                                        Thanh toán
                                    </a>
                                </li>
                                <?php
                                    }elseif ($customer_id != null && $shipping_id != null) {
                                        ?>
                                <li>
                                    <a href="{{ URL::to('/payment') }}">
                                        <i class="fa-solid fa-money-bill"></i>
                                        Thanh toán
                                    </a>
                                </li>
                                <?php
                                    }else{
                                        ?>
                                <li>
                                    <a href="{{ URL::to('/login-checkout') }}">
                                        <i class="fa-solid fa-money-bill"></i>
                                        Thanh toán
                                    </a>
                                </li>
                                <?php
                                    }
                                    ?>
                                <li>
                                    <a href="{{ URL::to('/show-cart-ajax') }}">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        Giỏ hàng
                                    </a>
                                </li>

                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if ($customer_id != null) {
                                    ?>
                                <li>
                                    <a href="{{ URL::to('/logout-checkout') }}">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                        Đăng xuất
                                    </a>
                                </li>
                                <?php
                                    }else {
                                        ?>
                                <li>
                                    <a href="{{ URL::to('/login-checkout') }}">
                                        <i class="fa-solid fa-right-to-bracket"></i>
                                        Đăng nhập
                                    </a>
                                </li>
                                <?php
                                    }
                                    ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->

        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ URL::to('/trang-chu') }}" class="active">Trang chủ</a></li>
                                <li class="dropdown"><a href="#">Sản phẩm<i
                                            class="fa-solid fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach ($category as $key => $cate)
                                            <li><a
                                                    href="{{ URL::to('danh-muc-san-pham/' . $cate->category_id) }}">{{ $cate->category_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Tin tức</a>
                                </li>
                                <li><a href="{{ URL::to('/show-cart') }}">Giỏ hàng</a></li>
                                <li><a href="contact-us.html">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{ URL::to('/tim-kiem') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="search_box pull-right">
                                <input type="text" name="keywords_submit" placeholder="Tìm kiếm sản phẩm" />
                                <div class="container_btn_search">
                                    <input type="submit" value="" style="margin-top:0;" name="search_item"
                                        class="btn btn-primary btn-sm" />
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    {{-- 
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span>392</span>-STORE</h1>
                                    <h2>Free E-Commerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ asset('public/frontend/images/girl1.jpg') }}"
                                        class="girl img-responsive" alt="" />
                                    <img src="{{ asset('public/frontend/images/pricing.png') }}" class="pricing"
                                        alt="" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>392</span>-STORE</h1>
                                    <h2>100% Responsive Design</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ asset('public/frontend/images/girl2.jpg') }}"
                                        class="girl img-responsive" alt="" />
                                    <img src="{{ asset('public/frontend/images/pricing.png') }}" class="pricing"
                                        alt="" />
                                </div>
                            </div>

                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>392</span>-STORE</h1>
                                    <h2>Free Ecommerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ asset('public/frontend/images/girl3.jpg') }}"
                                        class="girl img-responsive" alt="" />
                                    <img src="{{ asset('public/frontend/images/pricing.png') }}" class="pricing"
                                        alt="" />
                                </div>
                            </div>

                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/slider--> --}}

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục sản phẩm</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            {{-- <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Sportswear
                                        </a>
                                    </h4>
                                </div>
                                <div id="sportswear" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Nike </a></li>
                                            <li><a href="#">Under Armour </a></li>
                                            <li><a href="#">Adidas </a></li>
                                            <li><a href="#">Puma</a></li>
                                            <li><a href="#">ASICS </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> --}}
                            @foreach ($category as $key => $cate)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a
                                                href="{{ URL::to('/danh-muc-san-pham/' . $cate->category_id) }}">{{ $cate->category_name }}</a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        </div><!--/category-products-->

                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương hiệu</h2>
                            @foreach ($brand as $key => $brand)
                                <div class="brands-name">
                                    <ul class="nav nav-pills nav-stacked">
                                        <li><a
                                                href="{{ URL::to('/thuong-hieu-san-pham/' . $brand->brand_id) }}">{{ $brand->brand_name }}</a>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div><!--/brands_products-->

                        {{-- <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                <input type="text" class="span2" value="" data-slider-min="0"
                                    data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]"
                                    id="sl2"><br />
                                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div><!--/price-range--> --}}

                        {{-- <div class="shipping text-center"><!--shipping-->
                            <img src="{{ asset('public/frontend/images/shipping.jpg') }}" alt="" />
                        </div><!--/shipping--> --}}

                    </div>
                </div>
                <div class="col-sm-9 padding-right">
                    @yield('content') {{-- Gọi section 'content' trong file home.blade.php --}}
                </div>
            </div>
        </div>
    </section>

    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>392</span>-STORE</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    {{-- <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ asset('public/frontend/images/iframe1.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa-solid fa-circle-play"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ asset('public/frontend/images/iframe2.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa-solid fa-circle-play"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ asset('public/frontend/images/iframe3.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa-solid fa-circle-play"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ asset('public/frontend/images/iframe4.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa-solid fa-circle-play"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="{{ asset('public/frontend/images/map.png') }}" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

        {{-- <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Store</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Store</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i
                                        class="fa-solid fa-circle-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div> --}}

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2023 392-STORE Inc. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer><!--/Footer-->

    <script src="{{ asset('public/frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>

    <script src="{{ asset('public/frontend/js/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart').click(function() {
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ url('/add-cart-ajax') }}',
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_quantity: cart_product_quantity,
                        _token: _token
                    },
                    success: function(data) {
                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{ url('/show-cart-ajax') }}";
                            });
                    }
                });

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';

                if (action == 'city') {
                    result = 'district';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{ URL('/select-delivery-home') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.add_feeship').click(function() {
                var matp = $('.city').val();
                var maqh = $('.district').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();

                if (matp == '' && maqh == '' && xaid == '') {
                    alert('Vui lòng chọn khu vực để tính phí vận chuyển!')
                } else {
                    $.ajax({
                        url: '{{ URL('/calculate-feeship') }}',
                        method: 'POST',
                        data: {
                            matp: matp,
                            maqh: maqh,
                            xaid: xaid,
                            _token: _token
                        },
                        success: function() {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.send_order').click(function() {
                swal({
                        title: "Xác nhận đơn hàng",
                        text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Cảm ơn, Mua hàng",

                        cancelButtonText: "Đóng,chưa mua",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            var shipping_name = $('.shipping_name').val();
                            var shipping_email = $('.shipping_email').val();
                            var shipping_address = $('.shipping_address').val();
                            var shipping_phone = $('.shipping_phone').val();
                            var shipping_note = $('.shipping_note').val();
                            var shipping_method = $('.payment_method').val();
                            var order_fee = $('.order_fee').val();
                            var order_coupon = $('.order_coupon').val();
                            var _token = $('input[name="_token"]').val();

                            $.ajax({
                                url: '{{ url('/confirm-order') }}',
                                method: 'POST',
                                data: {
                                    shipping_name: shipping_name,
                                    shipping_email: shipping_email,
                                    shipping_address: shipping_address,
                                    shipping_phone: shipping_phone,
                                    shipping_note: shipping_note,
                                    _token: _token,
                                    order_fee: order_fee,
                                    order_coupon: order_coupon,
                                    shipping_method: shipping_method
                                },
                                success: function() {
                                    swal("Đơn hàng",
                                        "Đơn hàng của bạn đã được gửi thành công",
                                        "success");
                                }
                            });
                            window.setTimeout(function() {
                                location.reload();
                            }, 3000);
                        } else {
                            swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");
                        }
                    });
            });
        });
    </script>
</body>

</html>
