@extends('main')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                    <li class="active">Giỏ hàng của tôi</li>
                </ol>
            </div>
            @if (Session()->has('message'))
                <div class="alert alert-success">
                    {{ Session()->get('message') }}
                </div>
            @elseif(Session()->has('error'))
                <div class="alert alert-danger">
                    {{ Session()->get('error') }}
                </div>
            @endif
            <div class="table-responsive cart_info col-sm-10 clearfix">
                <form action="{{ URL::to('/update-cart') }}" method="POST">
                    @csrf
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Hình ảnh</td>
                                <td class="description">Tên sản phẩm</td>
                                <td class="price">Giá</td>
                                <td class="quantity">Số lượng</td>
                                <td class="total">Thành tiền</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (Session::get('cart') == true)
                                @php
                                    $total = 0;
                                @endphp
                                @foreach (Session::get('cart') as $key => $cart)
                                    @php
                                        $subtotal = $cart['product_price'] * $cart['product_quantity'];
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td class="cart_product">
                                            <img src="{{ asset('public/uploads/product/' . $cart['product_image']) }}"
                                                width="50" alt="{{ $cart['product_image'] }}">
                                        </td>
                                        <td class="cart_description">
                                            <h4>{{ $cart['product_name'] }}</h4>
                                            {{-- <p>Web ID: 1089772</p> --}}
                                        </td>
                                        <td class="cart_price">
                                            <p>{{ number_format($cart['product_price'], 0, ',', '.') }} đ</p>
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">
                                                <input class="cart_quantity_input" type="number" min="1"
                                                    name="cart_quantity[{{ $cart['session_id'] }}]"
                                                    value="{{ $cart['product_quantity'] }}" autocomplete="off"
                                                    size="2">
                                            </div>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price">{{ number_format($subtotal, 0, ',', '.') }} đ</p>
                                        </td>
                                        <td class="cart_delete">
                                            <a class="cart_quantity_delete"
                                                href="{{ URL::to('/delete-pro-to-cart/' . $cart['session_id']) }}"><i
                                                    class="fa-solid fa-xmark"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>
                                        <input type="submit" value="Cập nhật giỏ hàng" name="update_qty"
                                            class="check_out btn btn-default btn-sm">
                                    </td>
                                    <td>
                                        <a class="btn btn-default check_out" href="{{ URL::to('/delete-all-cart') }}">Xóa
                                            tất cả giỏ hàng</a>
                                    </td>
                                    <td>
                                        @if (Session::get('customer'))
                                            <a class="btn btn-default check_out" href="{{ URL::to('/checkout') }}">Thanh
                                                toán</a>
                                        @else
                                            <a class="btn btn-default check_out"
                                                href="{{ URL::to('/login-checkout') }}">Thanh
                                                toán</a>
                                        @endif
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="5">
                                        <center>
                                            @php
                                                echo '<p>Giỏ hàng đang trống. Hãy mua hàng!</p>';
                                            @endphp
                                        </center>

                                    </td>
                                </tr>
                            @endif
                        </tbody>
                </form>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            {{-- <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                    delivery cost.</p>
            </div> --}}
            <div class="row">
                {{-- <div class="col-sm-6">
                    <div class="chose_area">
                        <ul class="user_option">
                            <li>
                                <input type="checkbox">
                                <label>Use Coupon Code</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Use Gift Voucher</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Estimate Shipping & Taxes</label>
                            </li>
                        </ul>
                        <ul class="user_info">
                            <li class="single_field">
                                <label>Country:</label>
                                <select>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field">
                                <label>Region / State:</label>
                                <select>
                                    <option>Select</option>
                                    <option>Dhaka</option>
                                    <option>London</option>
                                    <option>Dillih</option>
                                    <option>Lahore</option>
                                    <option>Alaska</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field zip-field">
                                <label>Zip Code:</label>
                                <input type="text">
                            </li>
                        </ul>
                        <a class="btn btn-default update" href="">Get Quotes</a>
                        <a class="btn btn-default check_out" href="">Continue</a>
                    </div>
                </div> --}}
                <div class="col-sm-6">
                    @if (Session::get('cart') == true)
                        <div class="total_area">
                            <ul>
                                <li>Tổng giá trị giỏ hàng: <span>{{ number_format($total, 0, ',', '.') }} đ</span></li>
                                @if (Session::get('coupon'))
                                    <li>
                                        @foreach (Session::get('coupon') as $key => $cou)
                                            @if ($cou['coupon_feature'] == 1)
                                                Mã giảm giá: <span>{{ $cou['coupon_discount'] }} %</span>
                                                @php
                                                    $total_coupon = ($total * $cou['coupon_discount']) / 100;
                                                    echo '<li>Tổng tiền sau giảm: <span>' . number_format($total_coupon, 0, ',', '.') . ' đ</span></li>';
                                                @endphp
                                    <li>Tổng tiền:
                                        <span>{{ number_format($total - $total_coupon, 0, ',', '.') }}đ</span>
                                    </li>
                                @elseif($cou['coupon_feature'] == 2)
                                    Mã giảm giá: <span>{{ number_format($cou['coupon_discount'], 0, ',', '.') }} đ</span>
                                    @php
                                        $total_coupon = $total - $cou['coupon_discount'];
                                    @endphp
                                    <li>Tổng tiền: <span>{{ number_format($total_coupon, 0, ',', '.') }} đ</span>
                                    </li>
                                @endif
                    @endforeach
                    </li>
                    @endif
                    {{-- <li>Thuế <span></span></li>
                                <li>Phí vận chuyển <span>Free</span></li> --}}
                    </ul>
                    {{-- <a class="btn btn-default check_out" href="">Thanh toán</a> --}}
                </div>
                <div class="col-sm-6 container_coupon">
                    @if (Session::get('cart'))
                        <form action="{{ URL::to('/check-coupon') }}" method="POST">
                            @csrf
                            <input type="text" class="form_control" name="coupon" placeholder="Nhập mã giảm giá">
                            <input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Nhập">
                            @if (Session::get('coupon'))
                                <a class="btn btn-default" href="{{ URL::to('/unset-coupon') }}">Hủy mã giảm
                                    giá</a>
                            @endif
                        </form>
                    @endif
                </div>
                @endif
            </div>
        </div>
        </div>
    </section><!--/#do_action-->
@endsection
