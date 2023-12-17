<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Brand;

session_start();

class BrandProduct extends Controller
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
    public function add_brand_product()
    {
        $this->AuthLogin();
        return view("admin.Brand_Product.add_brand_product");
    }
    public function list_brand_product()
    {
        $this->AuthLogin();
        $list_brand_product = Brand::all(); /* lấy tất cả dữ liệu từ bẳng tbl_brand qua class Brand của model */

        $manager_brand_product = view("admin.Brand_Product.list_brand_product")->with("list_brand_product", $list_brand_product); /* Gán biến $list_brand_product vào view để sử dụng trong giao diện. */
        // Trả về view có tên là admin_layout
        // Gán view list_brand_product vào một phần của view admin_layout có tên là admin.list_brand_product, đảm bảo rằng danh sách thương hiệu sản phẩm sẽ được hiển thị trong layout.
        return view("admin_layout")->with('admin.Brand_Product.list_brand_product', $manager_brand_product);
    }
    public function save_brand_product(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();

        Session::put('message', 'Thêm thương hiệu sản phẩm thành công !');
        return Redirect::to('add-brand-product');
    }
    // Ẩn thương hiệu sản phẩm
    public function unactive_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        // Tìm và cập nhật trạng thái từ model Brand
        $brand = Brand::find($brand_product_id);
        $brand->brand_status = 0; // Cập nhật trạng thái
        $brand->save();

        Session::put('message', 'Ẩn thương hiệu sản phẩm thành công');
        return Redirect::to('list-brand-product');
    }
    // Hiện thương hiệu sản phẩm
    public function active_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        // Tìm và cập nhật trạng thái từ model Brand
        $brand = Brand::find($brand_product_id);
        $brand->brand_status = 1; // Cập nhật trạng thái
        $brand->save();

        Session::put('message', 'Hiện thương hiệu sản phẩm thành công');
        return Redirect::to('list-brand-product');
    }
    // Sửa thương hiệu sản phẩm
    public function edit_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        $edit_brand_product = Brand::find($brand_product_id);
        $manager_brand_product = view("admin.Brand_Product.edit_brand_product")->with("edit_brand_product", $edit_brand_product); /* Gán biến $list_brand_product vào view để sử dụng trong giao diện. */
        return view("admin_layout")->with('admin.Brand_Product.edit_brand_product', $manager_brand_product);

    }
    public function update_brand_product(Request $request, $brand_product_id)
    {
        $this->AuthLogin();
        $data = $request->all();
        $brand = Brand::find($brand_product_id);
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->save();

        Session::put('message', 'Cập nhật thương hiệu sản phẩm thành công !');
        return Redirect::to('list-brand-product');
    }
    public function delete_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        // Xác định và xóa bản ghi từ model Brand
        $brand = Brand::find($brand_product_id);
        $brand->delete();

        Session::put('message', 'Xóa thương hiệu sản phẩm thành công !');
        return Redirect::to('list-brand-product');
    }
    /* End Admin */

    public function show_brand_home($brand_id)
    {
        $cate_product = DB::table("tbl_category_product")->where('category_status', '1')->orderBy("category_id", "desc")->get();
        $brand_product = DB::table("tbl_brand")->where('brand_status', '1')->orderBy("brand_id", "desc")->get();

        $brand_by_id = DB::table("tbl_product")->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')
            ->where('tbl_product.brand_id', $brand_id)->paginate(6);
        $brand_name = DB::table("tbl_brand")->where("tbl_brand.brand_id", $brand_id)->limit(1)->get();
        return view('pages.Brand.show_brand')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('brand_by_id', $brand_by_id)
            ->with('brand_name', $brand_name);
    }

}
