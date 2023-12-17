@extends('admin_layout')
@section('admin_content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thông tin khách mua hàng</h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tên người mua</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->customer_phone }}</td>
                            <td>{{ $customer->customer_email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thông tin giao hàng</h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tên người nhận</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Hình thức thanh toán</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $shipping->shipping_name }}</td>
                            <td>{{ $shipping->shipping_phone }}</td>
                            <td>{{ $shipping->shipping_email }}</td>
                            <td>{{ $shipping->shipping_address }}</td>
                            <td>
                                @if ($shipping->shipping_method == 0)
                                    Chuyển khoản ngân hàng
                                @elseif($shipping->shipping_method == 1)
                                    Thanh toán bằng tiền mặt
                                @endif
                            </td>
                            <td>{{ $shipping->shipping_note }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Chi tiết đơn hàng</h4>
            {{-- <p class="card-description">Đơn hàng</p> --}}

            <div class="table-responsive">
                <?php
                $message = Session::get('message'); /* get giá trị từ Session::put ở file CategoryProduct.php */
                // Kiểm tra nếu có giá trị message được put thì in ra thông báo và xóa Session::put('message')
                if ($message) {
                    echo '<div class="alert alert-success">' . $message . '</div>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="stt">STT</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá sản phẩm</th>
                            <th>Mã giảm giá</th>
                            <th>Phí vận chuyển</th>
                            <th>Thành tiền</th>
                            {{-- <th class="sticky-column">Thao tác</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                            $total = 0;
                        @endphp
                        @foreach ($order_details as $key => $od_dtls)
                            @php
                                $i++;
                                $subtotal = $od_dtls->product_price * $od_dtls->product_sale_quantity;
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td class="stt">{{ $i }}</td>
                                <td><img src="../public/uploads/product/{{ $od_dtls->product_image }}" alt=""
                                        width="50px" height="50px"></td>
                                <td>{{ $od_dtls->product_name }}</td>
                                <td>{{ $od_dtls->product_sale_quantity }}</td>
                                <td>{{ number_format($od_dtls->product_price, 0, ',', '.') }} đ</td>
                                <td>
                                    @if ($od_dtls->product_coupon != 'Không')
                                        {{ $od_dtls->product_coupon }}
                                    @else
                                        Không có mã
                                    @endif
                                </td>
                                <td>{{ number_format($od_dtls->product_feeship, 0, ',', '.') }} đ</td>
                                <td>{{ number_format($subtotal, 0, ',', '.') }} đ</td>
                                {{-- <td class="operation-buttons">
                                    <a title="Chỉnh sửa" href="" class="btn mini-btn btn-inverse-primary btn-icon">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    <a title="Xóa"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không ?')"
                                        href="" class="btn mini-btn btn-inverse-danger btn-icon">
                                        <i class="mdi mdi-delete-forever"></i>
                                    </a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <div class="container_button">
                    <a target="blank" href="{{ URL('/print-order/' . $od_dtls->order_code) }}"
                        class="btn btn-info btn-icon-text"> In đơn
                        hàng
                        <i class="mdi mdi-printer btn-icon-append"></i>
                    </a>
                </div>
                <div class="container_total">
                    @php
                        $total_coupon = 0;
                    @endphp
                    @if ($coupon_feature == 1)
                        <div class="total">
                            @php
                                $total_after_coupon = ($total * $coupon_discount) / 100;
                                echo 'Tổng tiền giảm: <span>' . number_format($total_after_coupon, 0, ',', '.') . ' đ</span><br>';
                                $total_coupon = $total - $total_after_coupon;
                            @endphp
                        </div>
                    @else
                        <div class="total">
                            @php
                                echo 'Tổng tiền giảm: <span>' . number_format($coupon_discount, 0, ',', '.') . ' đ</span><br>';
                                $total_coupon = $total - $coupon_discount + $od_dtls->product_feeship;
                            @endphp
                        </div>
                    @endif
                    <div class="total">
                        Phí vận chuyển: <span>{{ number_format($od_dtls->product_feeship, 0, ',', '.') }} đ</span>
                    </div>
                    <div class="total">
                        Tổng tiền: <span>{{ number_format($total_coupon, 0, ',', '.') }} đ</span>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
