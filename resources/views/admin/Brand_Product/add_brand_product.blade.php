@extends('admin_layout')
@section('admin_content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm thương hiệu sản phẩm</h4>
                <p class="card-description"> Nhập thông tin của thương hiệu sản phẩm </p>
                <form class="forms-sample" action="{{ URL::to('/save-brand-product') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputName1">Tên thương hiệu</label>
                        <input type="text" name="brand_product_name" class="form-control" id="exampleInputName1"
                            placeholder="Tên thương hiệu" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Mô tả thương hiệu</label>
                        <textarea class="form-control" name="brand_product_desc" id="exampleTextarea1" rows="4"
                            placeholder="Mô tả thương hiệu" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Trạng thái hiển thị</label>
                        <select name="brand_product_status" class="form-control" id="exampleSelectGender">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiện</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <?php
                        $message = Session::get('message'); /* get giá trị từ Session::put ở file CategoryProduct.php */
                        // Kiểm tra nếu có giá trị message được put thì in ra thông báo và xóa Session::put('message')
                        if ($message) {
                            echo '<div class="alert alert-success">' . $message . '</div>';
                            Session::put('message', null);
                        }
                        ?>

                    </div>
                    <button type="submit" name="add_brand_product" class="btn btn-primary mr-2">Thêm thương hiệu</button>
                </form>
            </div>
        </div>
    </div>
@endsection
