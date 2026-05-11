
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Telemaster - Вход</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <base href="/templates/adminlte/">
    <link rel="shortcut icon" href="images/logo160x160.png" type="image/x-icon" />

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="bg">

</div>
<div class="login-box">
    <div class="login-logo mb-md-4"  style="z-index: 9999;">
        <a href="/">
            <img style="width: 150px;" src="images/logo.png">
            <p>Telemaster - Вход</p>
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <form action="/manager" method="get">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Пароль">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Запомнить меня
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Войти</button>
                    </div>
                </div>
            </form>

            <p class="mb-1">
                <a href="forgot-password.html">Забыли пароль?</a>
            </p>
            <p class="mb-0">
                <a href="register.html" class="text-center">Регистрация</a>
            </p>
        </div>
    </div>
</div>
<style>
    .bg {
        background-image: url('images/bg1.jpg');
        background-size: cover;
        background-position: top right;
        height: 100%;
        width: 100%;
        position: absolute;
        opacity: 1;
        z-index: 0;
    }
    .login-box {
        position: absolute;
    }
    .login-logo {
        font-weight: 600;
        p {
            color: #fff;
            text-shadow: 0px 3px 3px #0a0388;
        }
     }
</style>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
