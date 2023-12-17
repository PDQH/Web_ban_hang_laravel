@extends('admin_layout')
@section('admin_content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm sản phẩm</h4>
                <p class="card-description"> Nhập thông tin của sản phẩm </p>
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
                <form class="forms-sample" action="{{ URL::to('/save-product') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputName1">Tên sản phẩm</label>
                        <input type="text" name="product_name" class="form-control" id="exampleInputName1"
                            placeholder="Tên sản phẩm" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Giá sản phẩm</label>
                        <input type="text" name="product_price" class="form-control" id="exampleInputName1"
                            placeholder="Giá sản phẩm" required>
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh sản phẩm</label>
                        <input type="file" name="product_image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled
                                placeholder="Tải lên hình ảnh sản phẩm">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Tải lên</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Mô tả sản phẩm</label>
                        <textarea class="form-control" name="product_desc" id="ck_product_desc" rows="8" placeholder="Mô tả sản phẩm"
                            required></textarea>

                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Mô tả chi tiết sản phẩm</label>
                        <textarea class="form-control" name="product_content" id="ck_product_content" rows="4"
                            placeholder="Mô tả chi tiết sản phẩm" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Danh mục sản phẩm</label>
                        <select name="product_cate" class="form-control" id="exampleSelectGender">
                            @foreach ($cate_product as $key => $cate)
                                <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Thương hiệu</label>
                        <select name="product_brand" class="form-control" id="exampleSelectGender">
                            @foreach ($brand_product as $key => $brand)
                                <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Trạng thái hiển thị</label>
                        <select name="product_status" class="form-control" id="exampleSelectGender">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiện</option>
                        </select>
                    </div>

                    <button type="submit" name="add_product" class="btn btn-primary mr-2">Thêm sản phẩm</button>
                </form>
            </div>
        </div>

    </div>
@endsection
