<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();

class CouponController extends Controller
{
    public function create_coupon()
    {
        return view("admin.Coupon.create_coupon");
    }
    public function add_coupon_code(Request $request)
    {
        $data = $request->all();
        $coupon = new Coupon();
        $coupon->coupon_name = $data["coupon_name"];
        $coupon->coupon_code = $data["coupon_code"];
        $coupon->coupon_number = $data["coupon_number"];
        $coupon->coupon_feature = $data["coupon_feature"];
        $coupon->coupon_discount = $data["coupon_discount"];
        $coupon->save();

        Session::put('message', 'Thêm mã giảm giá thành công !');
        return Redirect::to('create-coupon');
    }
    public function list_coupon()
    {
        $coupon = Coupon::orderBy('coupon_id', 'desc')->get();
        return view('admin.Coupon.list_coupon')->with(compact('coupon'));
    }
    public function delete_coupon($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        Session::put('message', 'Xóa mã giảm giá thành công !');
        return Redirect::to('list-coupon');
    }
    public function unset_coupon()
    {
        $coupon = Session::get('coupon');
        if ($coupon == true) {
            Session::forget('coupon');
            return Redirect()->back()->with('message', 'Hủy mã giảm giá thành công!');

        }
    }
}
