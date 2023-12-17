@extends('admin_layout')
@section('admin_content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"> Chỉnh sửa danh mục sản phẩm</h4>
                <p class="card-description"> Chỉnh sửa thông tin của danh mục sản phẩm </p>
                <form class="forms-sample"
                    action="{{ URL::to('/update-category-product/' . $edit_category_product->category_id) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputName1">Tên danh mục</label>
                        <input type="text" value="{{ $edit_category_product->category_name }}"
                            name="category_product_name" class="form-control" id="exampleInputName1"
                            placeholder="Tên danh mục">
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Mô tả danh mục</label>
                        <textarea class="form-control" name="category_product_desc" id="exampleTextarea1" rows="4"
                            placeholder="Mô tả danh mục">{{ $edit_category_product->category_desc }}</textarea>
                    </div>
                    <button type="submit" name="update_category_product" class="btn btn-primary mr-2">Sửa danh
                        mục</button>
                    <a href="{{ URL::previous() }}" class="btn btn-light">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection
