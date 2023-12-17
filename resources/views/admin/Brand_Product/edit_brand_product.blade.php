@extends('admin_layout')
@section('admin_content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Chỉnh sửa thương hiệu sản phẩm</h4>
                <p class="card-description"> Chỉnh sửa thông tin của thương hiệu sản phẩm </p>
                <form class="forms-sample" action="{{ URL::to('/update-brand-product/' . $edit_brand_product->brand_id) }}"
                    method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputName1">Tên thương hiệu</label>
                        <input type="text" value="{{ $edit_brand_product->brand_name }}" name="brand_product_name"
                            class="form-control" id="exampleInputName1" placeholder="Tên thương hiệu">
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Mô tả thương hiệu</label>
                        <textarea class="form-control" name="brand_product_desc" id="exampleTextarea1" rows="4"
                            placeholder="Mô tả thương hiệu">{{ $edit_brand_product->brand_desc }}</textarea>
                    </div>
                    <button type="submit" name="update_brand_product" class="btn btn-primary mr-2">Sửa thương
                        hiệu</button>
                    <a href="{{ URL::previous() }}" class="btn btn-light">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection
