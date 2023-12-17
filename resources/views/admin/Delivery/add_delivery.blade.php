@extends('admin_layout')
@section('admin_content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm phí vận chuyển</h4>
                <p class="card-description"> Đặt phí vận chuyển cho các Tỉnh thành phố </p>
                <form>
                    @csrf
                    <div class="form-group">
                        <label for="exampleSelectGender">Chọn thành phố</label>
                        <select name="city" id="city" class="form-control choose city" id="exampleSelectGender">
                            <option value=""><--- Chọn tỉnh thành phố ---></option>
                            @foreach ($city as $key => $ci)
                                <option value="{{ $ci->matp }}">{{ $ci->name_thanhpho }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Chọn quận huyện</label>
                        <select name="district" id="district" class="form-control district choose"
                            id="exampleSelectGender">
                            <option value=""><--- Chọn quận huyện ---></option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Chọn xã phường/ thị trấn</label>
                        <select name="wards" id="wards" class="form-control wards" id="exampleSelectGender">
                            <option value=""><--- Chọn xã phường/ thị trấn ---></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Phí vận chuyển</label>
                        <input type="text" name="feeship" class="form-control feeship" id="exampleInputName1"
                            placeholder="Phí vận chuyển" required>
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
                    <button type="button" name="add_delivery" class="btn btn-primary mr-2 add_delivery">Thêm phí vận
                        chuyển</button>
                </form>
            </div>
            <div id="load_delivery">

            </div>
        </div>
    </div>
@endsection
