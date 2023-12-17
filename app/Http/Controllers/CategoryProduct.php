<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;
use App\Models\Brand;
use App\Imports\ExcelImports;
use App\Exports\ExcelExports;
use Excel;

session_start();

class CategoryProduct extends Controller
{
    /* Admin */
    public function AuthLogin()
    {
        $admin_id = Session::get("admin_id");
        if ($admin_id) {
            return redirect::to("dashboard");
        } else {
            return redirect::to("admin")->send();
        }
    }
    public function add_category_product()
    {
        $this->AuthLogin();
        return view("admin.Category_Product.add_category_product");
    }
    public function list_category_product()
    {
        $this->AuthLogin();
        $list_category_product = Category::all();
        $manager_category_product = view("admin.Category_Product.list_category_product")->with("list_category_product", $list_category_product); /* Gán biến $list_category_product vào view để sử dụng trong giao diện. */
        // Trả về view có tên là admin_layout
        // Gán view list_category_product vào một phần của view admin_layout có tên là admin.list_category_product, đảm bảo rằng danh sách danh mục sản phẩm sẽ được hiển thị trong layout.
        return view("admin_layout")->with('admin.Category_Product.list_category_product', $manager_category_product);
    }
    public function save_category_product(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $category = new Category();
        $category->category_name = $data['category_product_name'];
        $category->category_desc = $data['category_product_desc'];
        $category->category_status = $data['category_product_status'];
        $category->save();

        Session::put('message', 'Thêm danh mục sản phẩm thành công !');
        return Redirect::to('add-category-product');
    }
    // Ẩn danh mục sản phẩm
    public function unactive_category_product($category_product_id)
    {
        $this->AuthLogin();
        // Tìm và cập nhật trạng thái từ model Brand
        $category = Category::find($category_product_id);
        $category->category_status = 0; // Cập nhật trạng thái
        $category->save();

        Session::put('message', 'Ẩn danh mục sản phẩm thành công');
        return Redirect::to('list-category-product');
    }
    // Hiện danh mục sản phẩm
    public function active_category_product($category_product_id)
    {
        $this->AuthLogin();
        // Tìm và cập nhật trạng thái từ model Brand
        $category = Category::find($category_product_id);
        $category->category_status = 1; // Cập nhật trạng thái
        $category->save();

        Session::put('message', 'Hiện danh mục sản phẩm thành công');
        return Redirect::to('list-category-product');
    }
    // Sửa danh mục sản phẩm
    public function edit_category_product($category_product_id)
    {
        $this->AuthLogin();
        $edit_category_product = Category::find($category_product_id);
        $manager_category_product = view("admin.Category_Product.edit_category_product")->with("edit_category_product", $edit_category_product); /* Gán biến $list_category_product vào view để sử dụng trong giao diện. */
        return view("admin_layout")->with('admin.Category_Product.edit_category_product', $manager_category_product);

    }
    public function update_category_product(Request $request, $category_product_id)
    {
        $this->AuthLogin();
        $data = $request->all();
        $category = Category::find($category_product_id);
        $category->category_name = $data['category_product_name'];
        $category->category_desc = $data['category_product_desc'];
        $category->save();

        Session::put('message', 'Cập nhật danh mục sản phẩm thành công !');
        return Redirect::to('list-category-product');
    }
    public function delete_category_product($category_product_id)
    {
        $this->AuthLogin();
        // Xác định và xóa bản ghi từ model Category
        $category = Category::find($category_product_id);
        $category->delete();

        Session::put('message', 'Xóa danh mục sản phẩm thành công !');
        return Redirect::to('list-category-product');
    }
    /* End Admin */

    public function show_category_home($category_id)
    {
        $cate_product = DB::table("tbl_category_product")->where('category_status', '1')->orderBy("category_id", "desc")->get();
        $brand_product = DB::table("tbl_brand")->where('brand_status', '1')->orderBy("brand_id", "desc")->get();

        $category_by_id = DB::table("tbl_product")->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
            ->where('tbl_product.category_id', $category_id)->paginate(6);
        $category_name = DB::table("tbl_category_product")->where("tbl_category_product.category_id", $category_id)->limit(1)->get();
        return view('pages.Category.show_category')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('category_by_id', $category_by_id)
            ->with('category_name', $category_name);
    }
    public function export_csv()
    {
        return Excel::download(new ExcelExports, 'category_product.xlsx');
    }
    public function import_csv(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImports, $path);
        return back();
    }


}
