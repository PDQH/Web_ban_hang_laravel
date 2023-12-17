<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();
// Tạo class Controller chứa các hàm logic để thực hiện các yêu cầu trong các file Route (routes/web.php)
class HomeController extends Controller
{
    public function index()
    {
        $cate_product = DB::table("tbl_category_product")->where('category_status', '1')->orderBy("category_id", "desc")->get();
        $brand_product = DB::table("tbl_brand")->where('brand_status', '1')->orderBy("brand_id", "desc")->get();


        // $list_product = DB::table("tbl_product")
        //     ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        //     ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        //     ->orderBy('tbl_product.product_id', 'desc')->get(); /* Lấy dữ liệu từ bảng tbl_product và trả về các bản ghi từ bảng qua phương thức get và lưu chúng trong biến*/

        $all_product = DB::table("tbl_product")->where('product_status', '1')->orderBy("product_id", "desc")->limit(6)->get();

        return view("pages.home")
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('all_product', $all_product); /* khi hàm index() được gọi ở file web.php thì trả về file home.blade.php */
    }
    public function search(Request $request)
    {
        $keywords = $request->keywords_submit;
        $cate_product = DB::table("tbl_category_product")->where('category_status', '1')->orderBy("category_id", "desc")->get();
        $brand_product = DB::table("tbl_brand")->where('brand_status', '1')->orderBy("brand_id", "desc")->get();


        // $list_product = DB::table("tbl_product")
        //     ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        //     ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        //     ->orderBy('tbl_product.product_id', 'desc')->get(); /* Lấy dữ liệu từ bảng tbl_product và trả về các bản ghi từ bảng qua phương thức get và lưu chúng trong biến*/

        $search_product = DB::table("tbl_product")->where('product_name', 'like', '%' . $keywords . '%')->get();

        return view("pages.Product.search")
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('search_product', $search_product); /* khi hàm index() được gọi ở file web.php thì trả về file home.blade.php */

    }
}
