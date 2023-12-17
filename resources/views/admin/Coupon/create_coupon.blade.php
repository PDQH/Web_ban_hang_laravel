@extends('admin_layout')
@section('admin_content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tạo mã giảm giá</h4>
                <p class="card-description"> Nhập thông tin của mã giảm giá </p>
                <form class="forms-sample" action="{{ URL::to('/add-coupon-code') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputName1">Tên mã giảm giá</label>
                        <input type="text" name="coupon_name" class="form-control" id="exampleInputName1"
                            placeholder="Tên mã giảm giá" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Mã giảm giá</label>
                        <input type="text" name="coupon_code" class="form-control" id="exampleInputName1"
                            placeholder="Mã giảm giá" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Số lượng mã giảm giá</label>
                        <input type="text" name="coupon_number" class="form-control" id="exampleInputName1"
                            placeholder="Số lượng mã giảm giá" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Hình thức giảm giá</label>
                        <select name="coupon_feature" class="form-control" id="exampleSelectGender">
                            <option value="0"><--- Chọn ---></option>
                            <option value="1">Giảm theo phần trăm</option>
                            <option value="2">Giảm theo tiền</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Nhập số % hoặc tiền giảm</label>
                        <input type="text" name="coupon_discount" class="form-control" id="exampleInputName1"
                            placeholder="Nhập số % hoặc tiền giảm" required>
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
                    <button type="submit" name="add_category_product" class="btn btn-primary mr-2">Thêm mã giảm
                        giá</button>
                </form>
            </div>
        </div>
    </div>
@endsection
