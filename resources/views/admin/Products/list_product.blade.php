@extends('admin_layout')
@section('admin_content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách sản phẩm</h4>
            <p class="card-description">Danh sách sản phẩm</p>
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
                            <th>Tên sản phẩm</th>
                            <th>Giá sản phẩm</th>
                            <th>Hình ảnh sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>
                            <th>Trạng thái</th>
                            <th class="sticky-column">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_product as $key => $product)
                            {{-- Vòng lặp lấy dữ liệu từ bản ghi trả về trong biến $list_product và lưu giá trị vào $product --}}
                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ number_format($product->product_price) . ' ' . 'đ' }}</td>
                                <td><img src="public/uploads/product/{{ $product->product_image }}"
                                        alt="{{ $product->product_image }}" width="100px" height="100px"></td>
                                <td>{{ $product->category_name }}</td>
                                <td>{{ $product->brand_name }}</td>
                                <td>
                                    <?php
                                        if ($product->product_status == 0) {
                                    ?>
                                    <a class="container_icon" title="Ẩn"
                                        href="{{ URL::to('/active-product/' . $product->product_id) }}"><i
                                            class="hide_icon fa-solid fa-eye-slash"></i></a>
                                    <?php
                                        } else {
                                    ?>
                                    <a class="container_icon" title="Hiển thị"
                                        href="{{ URL::to('/unactive-product/' . $product->product_id) }}"><i
                                            class="show_icon fa-solid fa-eye"></i></a>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td class="operation-buttons">
                                    <a title="Chỉnh sửa" href="{{ URL::to('/edit-product/' . $product->product_id) }}"
                                        class="btn mini-btn btn-inverse-primary btn-icon">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    <a title="Xóa"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không ?')"
                                        href="{{ URL::to('/delete-product/' . $product->product_id) }}"
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
