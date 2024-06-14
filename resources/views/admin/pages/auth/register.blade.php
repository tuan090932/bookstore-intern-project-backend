<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/assets/css/sb-admin-2.css') }}" rel="stylesheet">
    <style>
        input[type=password]::-ms-reveal,
        input[type=password]::-ms-clear
        {
            display: none;
        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Đăng ký tài khoản</h1>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form class="user" action="{{ route('admin.register.submit') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="admin_name" id="exampleName"
                                            placeholder="Name" value="{{ old('admin_name') }}">
                                        @error('admin_name')
                                            <span style="margin: 5px 0 0 10px; font-size: 12px;" class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail"
                                        placeholder="Email Address" value="{{ old('admin_email') }}">
                                    @error('email')
                                        <span style="margin: 5px 0 0 10px; font-size: 12px;" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="toggleAdminPassword" style="cursor: pointer;">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                        @error('password')
                                            <span style="margin: 5px 0 0 10px; font-size: 12px;" class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-user" name="password_confirmation" id="password_confirmation" placeholder="Repeat Password">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="toggleAdminPasswordConfirmation" style="cursor: pointer;">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Đăng ký
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('forgot-password') }}">Quên mật khẩu?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{ route('admin.login') }}">Đã có tài khoản? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Show/Hide Password JavaScript-->
    <script>
        function togglePasswordVisibility(toggleId, passwordFieldId) {
            document.getElementById(toggleId).addEventListener('click', function () {
                const passwordField = document.getElementById(passwordFieldId);
                const passwordFieldType = passwordField.getAttribute('type');
                const icon = this.querySelector('i');
                if (passwordFieldType === 'password') {
                    passwordField.setAttribute('type', 'text');
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordField.setAttribute('type', 'password');
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        }

        togglePasswordVisibility('toggleAdminPassword', 'password');
        togglePasswordVisibility('toggleAdminPasswordConfirmation', 'password_confirmation');
    </script>

</body>

</html>
