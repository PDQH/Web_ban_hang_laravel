<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();

class ProductController extends Controller
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
    public function add_product()
    {
        $this->AuthLogin();
        $cate_product = DB::table("tbl_category_product")->orderBy("category_id", "desc")->get();
        $brand_product = DB::table("tbl_brand")->orderBy("brand_id", "desc")->get();
        return view("admin.Products.add_product")->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }
    public function list_product()
    {
        $this->AuthLogin();
        $list_product = DB::table("tbl_product")
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->orderBy('tbl_product.product_id', 'desc')->get(); /* Lấy dữ liệu từ bảng tbl_product và trả về các bản ghi từ bảng qua phương thức get và lưu chúng trong biến*/
        $manager_product = view("admin.Products.list_product")->with("list_product", $list_product); /* Gán biến $list_product vào view để sử dụng trong giao diện. */
        // Trả về view có tên là admin_layout
        // Gán view list_product vào một phần của view admin_layout có tên là admin.list_product, đảm bảo rằng danh sách sản phẩm sẽ được hiển thị trong layout.
        return view("admin_layout")->with('admin.Products.list_product', $manager_product);
    }
    public function save_product(Request $request)
    {
        $this->AuthLogin();
        //lấy dữ liệu từ form và gán với các cột tương ứng trong database
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;

        // lấy ảnh từ form và kiểm tra nếu ảnh tồn tại thì thực hiện thêm vào database nếu không có ảnh thì để trống
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName(); /* lấy tên ảnh của ảnh người dùng tải lên */
            $name_image = current(explode('.', $get_name_image)); /* dùng method current để phân tách giữa tên ảnh và đuôi file qua dấu chấm */
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension(); /* ghép tên file ảnh, số random, đấu chắm và định dạng ảnh */
            $get_image->move('public/uploads/product', $new_image); /* lưu ảnh người dùng tải lên vào thư mục product */
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message', 'Thêm sản phẩm thành công !');
            return Redirect::to('add-product');
        }

        $data['product_image'] = ''; /* đặt trường ảnh là rỗng nếu ng dùng ko tải ảnh lên */
        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Thêm sản phẩm thành công !');
        return Redirect::to('add-product');
    }
    // Ẩn sản phẩm
    public function unactive_product($product_id)
    {
        $this->AuthLogin();
        // truy cập bảng và so sánh id truyền vào và id trong bảng và thay đổi giá trị của status
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Ẩn sản phẩm thành công');
        return Redirect::to('list-product');
    }
    // Hiện sản phẩm
    public function active_product($product_id)
    {
        $this->AuthLogin();
        // truy cập bảng và so sánh id truyền vào và id trong bảng và thay đổi giá trị của status
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message', 'Hiện thị sản phẩm thành công');
        return Redirect::to('list-product');
    }
    // Sửa sản phẩm
    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $cate_product = DB::table("tbl_category_product")->orderBy("category_id", "desc")->get();
        $brand_product = DB::table("tbl_brand")->orderBy("brand_id", "desc")->get();

        $edit_product = DB::table("tbl_product")->where('product_id', $product_id)->get(); /* Lấy dữ liệu từ bảng tbl_brand và trả về các bản ghi từ bảng qua phương thức get và lưu chúng trong biến*/
        $manager_product = view("admin.Products.edit_product")->with("edit_product", $edit_product)
            ->with('cate_product', $cate_product)
            ->with('brand_product', $brand_product); /* Gán biến $list_product vào view để sử dụng trong giao diện. */
        return view("admin_layout")->with('admin.Products.edit_product', $manager_product);

    }
    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName(); /* lấy tên ảnh của ảnh người dùng tải lên */
            $name_image = current(explode('.', $get_name_image)); /* dùng method current để phân tách giữa tên ảnh và đuôi file qua dấu chấm */
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension(); /* ghép tên file ảnh, số random, đấu chắm và định dạng ảnh */
            $get_image->move('public/uploads/product', $new_image); /* lưu ảnh người dùng tải lên vào thư mục product */
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công !');
            return Redirect::to('add-product');
        }

        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công !');
        return Redirect::to('list-product');
    }
    public function delete_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message', 'Xóa sản phẩm thành công !');
        return Redirect::to('list-product');
    }
    /* End ADMIN */

    public function detail_product($product_id)
    {
        $cate_product = DB::table("tbl_category_product")->where('category_status', '1')->orderBy("category_id", "desc")->get();
        $brand_product = DB::table("tbl_brand")->where('brand_status', '1')->orderBy("brand_id", "desc")->get();

        $details_product = DB::table("tbl_product")
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.product_id', $product_id)->get(); /* Lấy dữ liệu từ bảng tbl_product và trả về các bản ghi từ bảng qua phương thức get và lưu chúng trong biến*/

        foreach ($details_product as $key => $value) {
            $category_id = $value->category_id;
        }
        $related_product = DB::table("tbl_product")
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_category_product.category_id', $category_id)->whereNotIn('tbl_product.product_id', [$product_id])->get(); /* Lấy dữ liệu từ bảng tbl_product và trả về các bản ghi từ bảng qua phương thức get và lưu chúng trong biến*/

        $chunks = array_chunk($related_product->toArray(), 3); // Chia dữ liệu thành các phần 3 sản phẩm mỗi phần

        return view('pages.Product.show_details_product')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('product_detail', $details_product)
            ->with('related', $related_product)
            ->with('chunks', $chunks);
    }

}
