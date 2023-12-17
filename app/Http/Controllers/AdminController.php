<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();

// Tạo class Controller chứa các hàm logic để thực hiện các yêu cầu trong các file Route (routes/web.php)
class AdminController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get("admin_id");
        if ($admin_id) {
            return redirect::to("dashboard");
        } else {
            return redirect::to("admin")->send();
        }
    }
    public function index()
    {
        return view("admin_login"); /* khi hàm index() được gọi ở file web.php thì trả về file admin_login.blade.php */
    }
    public function show_dashboard()
    {
        $this->AuthLogin();
        return view("admin.dashboard"); /* khi hàm show_dashboard() được gọi ở file web.php thì trả về file admin_dashboard.blade.php */
    }
    public function dashboard(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        // Kiểm tra dữ liệu nhập vào từ form với dữ liệu trong database và chuyển hướng đến file dashboard.blade.php
        $result = DB::table("tbl_admin")->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        // nếu result đúng thì đặt session thành admin_name và admin_id và chuyển đến trang dashboard. Còn sai thì đặt session thành message và vẫn ở lại trang login
        if ($result) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'Thông tin đăng nhập không đúng. Vui lòng thử lại.');
            return Redirect::to('/admin');
        }
    }
    public function logout()
    {
        $this->AuthLogin();
        // xóa session admin_name và admin_id và chuyển về trang login
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
}
