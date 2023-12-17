@extends('admin_layout')
@section('admin_content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách đơn hàng</h4>
            <p class="card-description">Đơn hàng</p>
            <div class="table-responsive">
                <?php
                $message = Session::get('message'); /* get giá trị từ Session::put ở file CategoryProduct.php */
                // Kiểm tra nếu có giá trị message được put thì in ra thông báo và xóa Session::put('message')
                if ($message) {
                    echo '<div class="alert alert-success">' . $message . '</div>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Thời gian đặt hàng</th>
                            <th>Trình trạng đơn hàng</th>
                            <th class="sticky-column">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($order as $key => $od)
                            @php
                                $i++;
                            @endphp
                            {{-- Vòng lặp lấy dữ liệu từ bản ghi trả về trong biến $list_order và lưu giá trị vào $order --}}
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $od->order_code }}</td>
                                <td>{{ $od->created_at }}</td>
                                <td>
                                    @if ($od->order_status == 1)
                                        Đơn hàng mới
                                    @else
                                        Đã xử lý
                                    @endif
                                </td>
                                <td class="operation-buttons">
                                    <a title="Xem đơn hàng" href="{{ URL::to('/view-order/' . $od->order_code) }}"
                                        class="btn mini-btn btn-inverse-info btn-icon">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                    <a title="Xóa"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không ?')"
                                        href="{{ URL::to('/delete-order/' . $od->order_code) }}"
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
