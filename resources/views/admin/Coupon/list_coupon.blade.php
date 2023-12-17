@extends('admin_layout')
@section('admin_content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách mã giảm giá</h4>
            <p class="card-description">Mã giảm giá</p>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<div class="alert alert-success">' . $message . '</div>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tên mã giảm giá</th>
                            <th>Mã giảm giá</th>
                            <th>Số lượng</th>
                            <th>Hình thức giảm</th>
                            <th>Số tiền giảm</th>
                            <th class="sticky-column">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupon as $key => $cou)
                            {{-- Vòng lặp lấy dữ liệu từ bản ghi trả về trong biến $list_brand_product và lưu giá trị vào $cou --}}
                            <tr>
                                <td>{{ $cou->coupon_name }}</td>
                                <td>{{ $cou->coupon_code }}</td>
                                <td>{{ $cou->coupon_number }}</td>
                                <td>
                                    <?php
                                        if ($cou->coupon_feature == 1) {
                                    ?>
                                    <p>Giảm theo %</p>
                                    <?php
                                        } else {
                                    ?>
                                    <p>Giảm theo số tiền</p>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if ($cou->coupon_feature == 1) {
                                    ?>
                                    <p>Giảm {{ $cou->coupon_discount }}%</p>
                                    <?php
                                        } else {
                                    ?>
                                    <p>Giảm {{ number_format($cou->coupon_discount, 0, ',', '.') }} đ</p>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td class="operation-buttons">
                                    <a title="Xóa"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa mã giảm giá này không ?')"
                                        href="{{ URL::to('/delete-coupon/' . $cou->coupon_id) }}"
                                        class="btn mini-btn btn-inverse-danger btn-icon">
                                        <i class="mdi mdi-delete-forever"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
