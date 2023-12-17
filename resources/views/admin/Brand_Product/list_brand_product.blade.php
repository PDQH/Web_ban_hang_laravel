@extends('admin_layout')
@section('admin_content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách thương hiệu sản phẩm</h4>
            <p class="card-description">Thương hiệu sản phẩm</p>
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
                            <th>Tên thương hiệu</th>
                            <th>Trạng thái</th>
                            <th>Mô tả</th>
                            <th class="sticky-column">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_brand_product as $key => $brand_pro)
                            {{-- Vòng lặp lấy dữ liệu từ bản ghi trả về trong biến $list_brand_product và lưu giá trị vào $brand_pro --}}
                            <tr>
                                <td>{{ $brand_pro->brand_name }}</td>
                                <td>
                                    <?php
                                        if ($brand_pro->brand_status == 0) {
                                    ?>
                                    <a class="container_icon" title="Ẩn"
                                        href="{{ URL::to('/active-brand-product/' . $brand_pro->brand_id) }}"><i
                                            class="hide_icon fa-solid fa-eye-slash"></i></a>
                                    <?php
                                        } else {
                                    ?>
                                    <a class="container_icon" title="Hiển thị"
                                        href="{{ URL::to('/unactive-brand-product/' . $brand_pro->brand_id) }}"><i
                                            class="show_icon fa-solid fa-eye"></i></a>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td>{{ $brand_pro->brand_desc }}</td>
                                <td class="operation-buttons">
                                    <a title="Chỉnh sửa" href="{{ URL::to('/edit-brand-product/' . $brand_pro->brand_id) }}"
                                        class="btn mini-btn btn-inverse-primary btn-icon">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    <a title="Xóa"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa thương hiệu sản phẩm này không ?')"
                                        href="{{ URL::to('/delete-brand-product/' . $brand_pro->brand_id) }}"
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
