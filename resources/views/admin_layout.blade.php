<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - Quản lý Website</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('public/backend/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('public/backend/vendors/font-awesome/css/all.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('public/backend/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/css/custom.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('public/backend/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo-mini" href="{{ URL::to('/dashboard') }}">
                    <h1>AD</h1>
                </a>
                <a class="navbar-brand brand-logo" href="{{ URL::to('/dashboard') }}">
                    <h1>ADMIN</h1>
                </a>
                {{-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg"
                        alt="logo" /></a> --}}
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <div class="search-field d-none d-xl-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control bg-transparent border-0"
                                placeholder="Search products">
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="{{ asset('public/backend/images/faces/face28.png') }}" alt="image">
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">
                                    <?php
                                    $name = Session::get('admin_name'); /* get giá trị từ Session::put ở file AdminController */
                                    // Kiểm tra nếu có giá trị admin_name được put thì in ra tên người dùng
                                    if ($name) {
                                        echo $name;
                                    }
                                    ?>
                                </p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm"
                            aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                            <div class="p-3 text-center bg-primary">
                                <img class="img-avatar img-avatar48 img-avatar-thumb"
                                    src="{{ asset('public/backend/images/faces/face28.png') }}" alt="">
                            </div>
                            <div class="p-2">
                                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                                    href="#">
                                    <span>Trang cá nhân</span>
                                    <span class="p-0">
                                        <span class="badge badge-success">1</span>
                                        <i class="mdi mdi-account-outline ml-1"></i>
                                    </span>
                                </a>
                                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                                    href="javascript:void(0)">
                                    <span>Cài đặt</span>
                                    <i class="mdi mdi-settings"></i>
                                </a>
                                <div role="separator" class="dropdown-divider"></div>
                                {{-- <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                                    href="#">
                                    <span>Lock Account</span>
                                    <i class="mdi mdi-lock ml-1"></i>
                                </a> --}}
                                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                                    href="{{ URL::to('/logout') }}">
                                    <span>Đăng xuất</span>
                                    <i class="mdi mdi-logout ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-category">Tổng quan</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::to('/dashboard') }}">
                            <span class="icon-bg"><i class="mdi mdi-home menu-icon"></i></span>
                            <span class="menu-title">Trang chủ</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Quản lý</li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#order" aria-expanded="false"
                            aria-controls="order">
                            <span class="icon-bg"><i class="mdi mdi-cube-send menu-icon"></i></span>
                            <span class="menu-title">Đơn hàng</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="order">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ URL::to('/manager-order') }}">Quản lý đơn
                                        hàng</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#category_product" aria-expanded="false"
                            aria-controls="category_product">
                            <span class="icon-bg"><i class="mdi mdi-view-week menu-icon"></i></span>
                            <span class="menu-title">Danh mục sản phẩm</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="category_product">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ URL::to('/add-category-product') }}">Thêm
                                        danh mục sản phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ URL::to('/list-category-product') }}">Danh sách danh
                                        mục</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#brand" aria-expanded="false"
                            aria-controls="brand">
                            <span class="icon-bg"><i class="mdi mdi-flag-variant menu-icon"></i></span>
                            <span class="menu-title">Thương hiệu sản phẩm</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="brand">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ URL::to('/add-brand-product') }}">Thêm
                                        thương hiệu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ URL::to('/list-brand-product') }}">Danh sách thương
                                        hiệu</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#products" aria-expanded="false"
                            aria-controls="products">
                            <span class="icon-bg"><i class="mdi mdi-shopping menu-icon"></i></span>
                            <span class="menu-title">Sản phẩm</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="products">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ URL::to('/add-product') }}">Thêm
                                        sản phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ URL::to('/list-product') }}">Danh sách sản
                                        phẩm</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#coupon" aria-expanded="false"
                            aria-controls="coupon">
                            <span class="icon-bg"><i class="mdi mdi-ticket menu-icon"></i></span>
                            <span class="menu-title">Mã giảm giá</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="coupon">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ URL::to('/create-coupon') }}">Tạo mã giảm
                                        giá</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ URL::to('/list-coupon') }}">Danh sách mã giảm
                                        giá</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#delivery" aria-expanded="false"
                            aria-controls="delivery">
                            <span class="icon-bg"><i class="mdi mdi-truck-delivery menu-icon"></i></span>
                            <span class="menu-title">Phí vận chuyển</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="delivery">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ URL::to('/delivery') }}">Quản lý phí vận
                                        chuyển</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{ URL::to('/list-coupon') }}">Danh sách mã giảm
                                        giá</a>
                                </li> --}}
                            </ul>
                        </div>
                    </li>

                    {{-- <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false"
                            aria-controls="auth">
                            <span class="icon-bg"><i class="mdi mdi-lock menu-icon"></i></span>
                            <span class="menu-title">User Pages</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank
                                        Page </a></li>
                                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html">
                                        Register </a></li>
                                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404
                                    </a></li>
                                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500
                                    </a></li>
                            </ul>
                        </div>
                    </li> --}}
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('admin_content') {{-- Gọi section 'admin_content' trong file dashboard.blade.php --}}
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="footer-inner-wraper">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                                Admin 2023</span>
                            {{-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                                    href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard
                                    templates</a> from Bootstrapdash.com</span> --}}
                        </div>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('public/backend/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('public/backend/vendors/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('ck_product_desc');
        CKEDITOR.replace('ck_product_content');
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            fetch_delivery();

            function fetch_delivery() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ URL('/select-feeship') }}',
                    method: 'POST',
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        $('#load_delivery').html(data);
                    }
                });
            }
            $(document).on('blur', '.fee_feeship_edit', function() {
                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ URL('/update-feeship') }}',
                    method: 'POST',
                    data: {
                        feeship_id: feeship_id,
                        fee_value: fee_value,
                        _token: _token
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                });
            });
            $('.add_delivery').click(function() {
                var city = $('.city').val();
                var district = $('.district').val();
                var wards = $('.wards').val();
                var feeship = $('.feeship').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ URL('/add-delivery') }}',
                    method: 'POST',
                    data: {
                        city: city,
                        district: district,
                        wards: wards,
                        feeship: feeship,
                        _token: _token
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                });
            });
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';

                if (action == 'city') {
                    result = 'district';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{ URL('/select-delivery') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        })
    </script>

    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('public/backend/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('public/backend/vendors/jquery-circle-progress/js/circle-progress.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('public/backend/js/off-canvas.js') }}"></script>
    <script src="{{ asset('public/backend/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('public/backend/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    {{-- <script src="{{ asset('public/backend/js/dashboard.js') }}"></script> --}}
    <script src="{{ asset('public/backend/js/file-upload.js') }}"></script>
    <script src="{{ asset('public/backend/js/codemirror.js') }}"></script>
    <script src="{{ asset('public/backend/js/select2.js') }}"></script>
    {{-- <script src="{{ asset('public/backend/js/typeahead.js') }}"></script> --}}
    <!-- End custom js for this page -->

</body>

</html>
