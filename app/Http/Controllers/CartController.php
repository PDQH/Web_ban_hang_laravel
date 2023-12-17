<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Models\Coupon;

session_start();

class CartController extends Controller
{
    public function save_cart(Request $request)
    {
        $productID = $request->productid_hidden;
        $quantity = $request->quantity;

        $product_info = DB::table("tbl_product")->where("product_id", $productID)->first();

        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = '1';
        $data['options']['image'] = $product_info->product_image;

        Cart::add($data);
        Cart::setGlobalTax(10); // Set thuế

        // Cart::destroy();
        return Redirect::to('/show-cart');

    }
    public function show_cart()
    {
        $cate_product = DB::table("tbl_category_product")->where('category_status', '1')->orderBy("category_id", "desc")->get();
        $brand_product = DB::table("tbl_brand")->where('brand_status', '1')->orderBy("brand_id", "desc")->get();
        return view('pages.Cart.show_cart')
            ->with('category', $cate_product)
            ->with('brand', $brand_product);
    }
    public function delete_to_cart($rowId)
    {
        Cart::update($rowId, 0);
        return Redirect::to('/show-cart');

    }
    public function update_cart_quantity(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId, $qty);
        return Redirect::to('/show-cart');

    }
    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()) . rand(0, 26), 5);
        $cart = Session::get('cart');
        if ($cart == true) {
            $is_avaiable = 0;
            foreach ($cart as $key => $value) {
                if ($value['product_id'] == $data['cart_product_id']) {
                    $is_avaiable++;
                }
            }
            if ($is_avaiable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_price' => $data['cart_product_price'],
                    'product_quantity' => $data['cart_product_quantity'],
                );
                Session::put('cart', $cart);

            }

        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_price' => $data['cart_product_price'],
                'product_quantity' => $data['cart_product_quantity'],
            );
        }
        Session::put('cart', $cart);
        Session::save();
    }
    public function delete_pro_to_cart($session_id)
    {
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $value) {
                if ($value['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return Redirect()->back()->with('message', 'Xóa sản phẩm khỏi giỏ hàng thành công!');

        } else {
            return Redirect()->back()->with('error', 'Xóa sản phẩm khỏi giỏ hàng thất bại!');
        }

    }
    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($data['cart_quantity'] as $key => $qty) {
                foreach ($cart as $session => $value) {
                    if ($value['session_id'] == $key) {
                        $cart[$session]['product_quantity'] = $qty;
                    }
                }
            }
            Session::put('cart', $cart);
            return Redirect()->back()->with('message', 'Cập nhật giỏ hàng thành công!');
        } else {
            return Redirect()->back()->with('error', 'Cập nhật giỏ hàng thất bại!');
        }

    }
    public function delete_all_cart()
    {
        $cart = Session::get('cart');
        if ($cart == true) {
            Session::forget('cart');
            Session::forget('coupon');
            return Redirect()->back()->with('message', 'Xóa tất cả sản phẩm khỏi giỏ hàng thành công!');

        }
    }
    public function show_cart_ajax()
    {
        $cate_product = DB::table("tbl_category_product")->where('category_status', '1')->orderBy("category_id", "desc")->get();
        $brand_product = DB::table("tbl_brand")->where('brand_status', '1')->orderBy("brand_id", "desc")->get();
        return view('pages.Cart.show_cart_ajax')
            ->with('category', $cate_product)
            ->with('brand', $brand_product);

    }
    public function check_coupon(Request $request)
    {
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->first();
        if ($coupon) {
            $count_coupon = $coupon->count();
            if ($count_coupon > 0) {
                $coupon_session = Session::get('coupon');
                if ($coupon_session == true) {
                    $is_avaiable = 0;
                    if ($is_avaiable == 0) {
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_feature' => $coupon->coupon_feature,
                            'coupon_discount' => $coupon->coupon_discount,
                        );
                        Session::put('coupon', $cou);
                    }
                } else {
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_feature' => $coupon->coupon_feature,
                        'coupon_discount' => $coupon->coupon_discount,
                    );
                    Session::put('coupon', $cou);
                }
                Session::save();
                return Redirect()->back()->with('message', 'Thêm mã giảm giá thành công!');
            }
        } else {
            return Redirect()->back()->with('error', 'Mã giảm giá không đúng. Vui lòng nhập lại!');
        }
    }
}
