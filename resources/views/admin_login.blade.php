<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - Đăng nhập</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('public/backend/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
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
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            {{-- <div class="brand-logo">
                                <img src="../../assets/images/logo-dark.svg">
                            </div> --}}
                            <h1 style="user-select: none;">Đăng nhập</h1>
                            <h6 class="font-weight-light">Hãy đăng nhập để tiếp tục!</h6>
                            <form class="pt-3" action="{{ URL::to('/admin-dashboard') }}" method="post">
                                {{ csrf_field() }} {{-- Tạo section để gán token. Để chống tấn công SQL Injection  --}}
                                <div class="form-group">
                                    <input type="email" name="admin_email" class="form-control form-control-lg"
                                        id="exampleInputEmail1" placeholder="Email" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="admin_password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="Mật khẩu" autocomplete="new-password"
                                        required>
                                </div>
                                {{-- Thông báo đăng nhập không thành công --}}
                                <?php
                                $message = Session::get('message'); /* get giá trị từ Session::put ở file AdminController */
                                // Kiểm tra nếu có giá trị message được put thì in ra thông báo và xóa Session::put('message')
                                if ($message) {
                                    echo '<div class="alert alert-danger">' . $message . '</div>';
                                    Session::put('message', null);
                                }
                                ?>
                                <div class="mt-3">
                                    <input type="submit" value="ĐĂNG NHẬP" name="login"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input"> Nhớ đăng nhập </label>
                                    </div>
                                    <a href="#" class="auth-link text-black">Quên mật khẩu?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('public/backend/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('public/backend/js/off-canvas.js') }}"></script>
    <script src="{{ asset('public/backend/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('public/backend/js/misc.js') }}"></script>
    <!-- endinject -->
</body>

</html>
