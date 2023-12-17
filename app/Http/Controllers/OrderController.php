<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feeship;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Coupon;

use PDF;

class OrderController extends Controller
{
    public function manager_order()
    {
        $order = Order::orderBy('created_at', 'DESC')->get();
        return view("admin.Order.manager_order")->with(compact('order'));
    }
    public function view_order($order_code)
    {
        // $this->AuthLogin();
        $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->get();
        foreach ($order as $key => $od) {
            $customer_id = $od->customer_id;
            $shipping_id = $od->shipping_id;
            // $order_status = $od->order_status;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();

        $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();

        foreach ($order_details as $key => $order_d) {
            $product_coupon = $order_d->product_coupon;
        }
        if ($product_coupon != 'Không') {
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();
            $coupon_feature = $coupon->coupon_feature;
            $coupon_discount = $coupon->coupon_discount;
        } else {
            $coupon_feature = 2;
            $coupon_discount = 0;
        }

        return view("admin.Order.view_order")
            ->with(compact('order_details', 'customer', 'shipping', 'order_details', 'coupon_feature', 'coupon_discount'));
    }

    /* In đơn hàng */
    public function print_order($checkout_code)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code)
    {
        $order_details = OrderDetails::where('order_code', $checkout_code)->get();
        $order = Order::where('order_code', $checkout_code)->get();
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();

        $order_details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();

        foreach ($order_details_product as $key => $order_d) {

            $product_coupon = $order_d->product_coupon;
        }
        if ($product_coupon != 'Không') {
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();

            $coupon_feature = $coupon->coupon_feature;
            $coupon_discount = $coupon->coupon_discount;

            if ($coupon_feature == 1) {
                $coupon_echo = $coupon_discount . '%';
            } elseif ($coupon_feature == 2) {
                $coupon_echo = number_format($coupon_discount, 0, ',', '.') . 'đ';
            }
        } else {
            $coupon_feature = 2;
            $coupon_discount = 0;
            $coupon_echo = '0';
        }

        $output = '';

        $output .= '
        <style>
        body{
			font-family: DejaVu Sans;
		}
        table{
            width: 100%;
        }
		.table-styling{
			border:1px solid #000;
		}
		.table-styling thead tr th{
			border:1px solid #000;
		}
        .table-styling tbody tr td{
			border:1px solid #000;
		}
        .heading span{
            color: #0074e1;
        }
        .heading {
            color: #f59f0d;
        }
        h5 {
            margin-bottom: 10px;
        }

		</style>
		<h1 class="heading"><center><span>392-</span>STORE</center></h1>
		<h3><center>HÓA ĐƠN BÁN HÀNG</center></h3>
		<h5>Người đặt hàng</h5>
		<table class="table-styling">
				<thead>
					<tr>
						<th>Tên khách hàng</th>
						<th>Số điện thoại</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>';

        $output .= '		
					<tr>
						<td>' . $customer->customer_name . '</td>
						<td>' . $customer->customer_phone . '</td>
						<td>' . $customer->customer_email . '</td>
					</tr>';

        $output .= '				
				</tbody>
		</table>
		<h5>Ship hàng tới</h5>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên người nhận</th>
						<th>Địa chỉ</th>
						<th>Số điện thoại</th>
						<th>Email</th>
						<th>Ghi chú</th>
					</tr>
				</thead>
				<tbody>';

        $output .= '		
					<tr>
						<td>' . $shipping->shipping_name . '</td>
						<td>' . $shipping->shipping_address . '</td>
						<td>' . $shipping->shipping_phone . '</td>
						<td>' . $shipping->shipping_email . '</td>
						<td>' . $shipping->shipping_note . '</td>
					</tr>';

        $output .= '				
				</tbody>
		</table>
		<h5>Đơn hàng đặt</h5>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên sản phẩm</th>
						<th>Mã giảm giá</th>
						<th>Phí vận chuyển</th>
						<th>Số lượng</th>
						<th>Giá sản phẩm</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>';

        $total = 0;

        foreach ($order_details_product as $key => $product) {

            $subtotal = $product->product_price * $product->product_sale_quantity;
            $total += $subtotal;

            if ($product->product_coupon != 'Không') {
                $product_coupon = $product->product_coupon;
            } else {
                $product_coupon = 'Không mã';
            }

            $output .= '		
					<tr>
						<td>' . $product->product_name . '</td>
						<td>' . $product_coupon . '</td>
						<td>' . number_format($product->product_feeship, 0, ',', '.') . ' đ' . '</td>
						<td>' . $product->product_sale_quantity . '</td>
						<td>' . number_format($product->product_price, 0, ',', '.') . ' đ' . '</td>
						<td>' . number_format($subtotal, 0, ',', '.') . ' đ' . '</td>
					</tr>';
        }

        if ($coupon_feature == 1) {
            $total_after_coupon = ($total * $coupon_discount) / 100;
            $total_coupon = $total - $total_after_coupon;
        } else {
            $total_coupon = $total - $coupon_discount + $product->product_feeship;
        }

        $output .= '<tr>
				<td colspan="2">
					<p>Tổng tiền giảm: ' . $coupon_echo . '</p>
					<p>Phí vận chuyển: ' . number_format($product->product_feeship, 0, ',', '.') . ' đ' . '</p>
					<p>Thanh toán: ' . number_format($total_coupon, 0, ',', '.') . ' đ' . '</p>
				</td>
		</tr>';

        $output .= '				
				</tbody>
		</table>
			<table>
				<thead>
					<tr>
						<th width="200px"><h4>Người lập phiếu</h4></th>
						<th width="800px"><h4>Người nhận</h4></th>
						
					</tr>
				</thead>
				<tbody>';

        $output .= '				
				</tbody>
		</table>
		';

        return $output;
    }
}
