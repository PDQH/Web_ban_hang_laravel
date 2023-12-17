@extends('admin_layout')
@section('admin_content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách danh mục sản phẩm</h4>
            <p class="card-description">Danh mục sản phẩm</p>
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
                            <th>Tên danh mục</th>
                            <th>Trạng thái</th>
                            <th>Mô tả</th>
                            <th class="sticky-column">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_category_product as $key => $cate_pro)
                            {{-- Vòng lặp lấy dữ liệu từ bản ghi trả về trong biến $list_category_product và lưu giá trị vào $cate_pro --}}
                            <tr>
                                <td>{{ $cate_pro->category_name }}</td>
                                <td>
                                    <?php
                                        if ($cate_pro->category_status == 0) {
                                    ?>
                                    <a class="container_icon" title="Ẩn"
                                        href="{{ URL::to('/active-category-product/' . $cate_pro->category_id) }}"><i
                                            class="hide_icon fa-solid fa-eye-slash"></i></a>
                                    <?php
                                        } else {
                                    ?>
                                    <a class="container_icon" title="Hiển thị"
                                        href="{{ URL::to('/unactive-category-product/' . $cate_pro->category_id) }}"><i
                                            class="show_icon fa-solid fa-eye"></i></a>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td>{{ $cate_pro->category_desc }}</td>
                                <td class="operation-buttons">
                                    <a title="Chỉnh sửa"
                                        href="{{ URL::to('/edit-category-product/' . $cate_pro->category_id) }}"
                                        class="btn mini-btn btn-inverse-primary btn-icon">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    <a title="Xóa"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục sản phẩm này không ?')"
                                        href="{{ URL::to('/delete-category-product/' . $cate_pro->category_id) }}"
                                        class="btn mini-btn btn-inverse-danger btn-icon">
                                        <i class="mdi mdi-delete-forever"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="container_button">
                <form action="{{ URL('import-csv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group col-xs-12">
                        <input class="form-control" type="file" name="file" accept=".xlsx"><br>
                        <button type="submit" value="Import CSV" name="import_csv" class="btn btn-success btn-icon-text">
                            <i class="mdi mdi-file-import btn-icon-prepend"></i>
                            Nhập Excel
                        </button>
                    </div>
                </form>
                <form action="{{ URL('export-csv') }}" method="POST">
                    @csrf
                    <button type="submit" value="Export CSV" name="export_csv" class="btn btn-warning btn-icon-text">
                        <i class="mdi mdi-file-export btn-icon-prepend"></i>
                        Xuất Excel
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
