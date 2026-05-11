<?php
$user = session("user");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?= $title ?></title>
    <base href="/templates/adminlte/">
    <link rel="shortcut icon" href="images/logo160x160.png" type="image/x-icon" />
<!--    <link rel="shortcut icon" sizes="16x16" href="dist/img/favicon/favicon-16x16.ico" type="image/x-icon" />-->
<!--    <link rel="shortcut icon" sizes="24x24" href="dist/img/favicon/favicon-24x24.ico" type="image/x-icon" />-->
<!--    <link rel="shortcut icon" sizes="32x32" href="dist/img/favicon/favicon-32x32.ico" type="image/x-icon" />-->
<!--    <link rel="shortcut icon" sizes="48x48" href="dist/img/favicon/favicon-48x48.ico" type="image/x-icon" />-->
<!--    <link rel="shortcut icon" sizes="16x16" href="dist/img/favicon/favicon-16x16.png" type="image/png" />-->
<!--    <link rel="shortcut icon" sizes="24x24" href="dist/img/favicon/favicon-24x24.png" type="image/png" />-->
<!--    <link rel="shortcut icon" sizes="32x32" href="dist/img/favicon/favicon-32x32.png" type="image/png" />-->
<!--    <link rel="shortcut icon" sizes="48x48" href="dist/img/favicon/favicon-48x48.png" type="image/png" />-->
<!--    <link rel="apple-touch-icon" sizes="16x16" href="dist/img/favicon/favicon-16x16.png" />-->
<!--    <link rel="apple-touch-icon" sizes="24x24" href="dist/img/favicon/favicon-24x24.png" />-->
<!--    <link rel="apple-touch-icon" sizes="32x32" href="dist/img/favicon/favicon-32x32.png" />-->
<!--    <link rel="apple-touch-icon" sizes="48x48" href="dist/img/favicon/favicon-48x48.png" />-->
<!--    <link rel="apple-touch-icon" sizes="57x57" href="dist/img/favicon/favicon-57x57.png" />-->
<!--    <link rel="apple-touch-icon" sizes="60x60" href="dist/img/favicon/favicon-60x60.png" />-->

    <link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/fancybox/source/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen"/>
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="dist/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="plugins/jquery/jquery.min.js"></script>

</head>
<body class="hold-transition sidebar-mini <?=(session("leftmenuState") == -1) ? "sidebar-collapse" : ""?>">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background: linear-gradient(45deg, #300bfc38, #C5DDE8);">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button" id="collapse-button"><i class="fa fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= route_to('admin_dashboard') ?>" class="nav-link">Главная</a>
            </li>
            <?php
            if (isset($filter)): ?>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link filter-btn"><i class="fa fa-search"></i> Фильтр</a>
                </li>
            <?php endif; ?>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <?php
            echo view('layouts/navbar_admin_dropdown');
            echo view('layouts/navbar_user_dropdown');
            ?>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="<?= site_url('/') ?>" class="brand-link">
            <img src="images/logo160x160.png" alt="Telemaster Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8; background-color: white; padding: 3px;">
            <span class="brand-text font-weight-light">Telemaster</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <nav class="mt-2" style="margin-top: 2rem !important;">
                <?php
                echo view('layouts/admin_menu');
                ?>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <?php if (!isset($content_header_hide)) { ?>
        <div class="content-wrapper bg_image bg_image3">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"><?= $title ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= route_to('admin_dashboard') ?>">Главная</a>
                                </li>
                                <li class="breadcrumb-item active"><?= $title ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <?= $content ?>

        </div>
    <?php } else { ?>
        <div class="content-wrapper bg_image bg_image3">
            <?= $content ?>
        </div>
    <?php } ?>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
            Telemaster 2024
        </div>
        <strong>Copyright &copy; 2024-2025 <a href="#">HiddenName</a>.</strong> All rights reserved.
    </footer>
</div>
<?php
if (isset($filter)):
    ?>
    <div class="filter-bg filter-bg-clk"></div>
    <div class="filter-wrapper filter-bg-clk">
        <div class="filter-inner">
            <!--            <div class="filter-title">Фильтр</div>-->
            <?= $filter ?>
        </div>
    </div>
<?php endif; ?>
<style>
    .filter-bg {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgb(100,100,100);
        opacity: 0;
    }
    .filter-wrapper {
        width: 100%;
        top: -660px;
        position: absolute;
        transition: all .5s;
        z-index: 9999;
    }
    .filter-inner {
        background-color: #fff;
        border-radius: 15px;
        margin: 30px auto;
        width: 600px;
        transition: all .5s;
        transform: scale(0);
    }
    .filter-title {
        padding: 10px;
        text-align: left;
    }
    .filter-opened {
        transition: all 1s;
        transform: scale(1);
    }

</style>

<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>
<script src="plugins/fancybox/lib/jquery.mousewheel.pack.js"></script>
<script src="plugins/fancybox/source/jquery.fancybox.js?v=2.1.7"></script>
<link rel="stylesheet" href="dist/css/nice-select.css">
<script src="dist/js/jquery.nice-select.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<!--<script src="https://unpkg.com/tippy.js@6"></script>-->
<script src="plugins/tippy/tippy.min.js"></script>

<!--Скрипт уведомлений-->
<!--<script type="text/javascript" src="//www.gstatic.com/firebasejs/3.6.8/firebase.js"></script>-->
<!--<script type="text/javascript" src="/firebase_subscribe.js"></script>-->
<!--Скрипт уведомлений-->

<script src="dist/js/adminlte.min.js"></script>
<script src="js/application.js"></script>

<script>
    let leftmenuState = <?=(session("leftmenuState"))??1?>;

    $(function () {

        $("#collapse-button").click(function () {
            leftmenuState = -leftmenuState;
            APP.saveLeftmenuState(leftmenuState);
        })
        // let filterHeght = getFilterHeight();
        // function getFilterHeight() {
        //     //$(".filter-wrapper").hide();
        //     $(".filter-wrapper").css("transform", "scale(1)");
        //     let h = $(".filter-bg").height() - $(".filter-inner").height() / 2;
        //     $(".filter-wrapper").css("transform", "scale(0)");
        //     //$(".filter-wrapper").show();
        //     alert($(".filter-bg").height(), $(".filter-inner").height());
        //
        //     return 0;
        // }

        console.log("Если перестали работать найс-селекты, то смотреть в основном фале шлаблона");
        $('.nice-select').niceSelect();
        $("[data-fancybox]").fancybox({padding: 0, overlayOpacity: 0.3});

        $(".filter-btn").on("click", function(e){

            e.preventDefault();
            $(".filter-bg").show();
            $(".filter-bg").animate({opacity:.4}, 500, "linear");
            $(".filter-inner").addClass("filter-opened");
            $(".filter-wrapper").animate(
                {
                    top: 0,
                }, 200, "linear"
            )
        });
        $(".filter-bg-clk").on("click", function(e){
            //e.preventDefault();
            if($(e.target).hasClass("filter-bg-clk")) {
                console.log(e.target)
                hideFilter();
            }
        });

        function hideFilter() {
            let h = $(".filter-wrapper").height();
            $(".filter-wrapper").animate(
                {
                    top: -h,
                    transform: "scale(1)"
                },400,"linear", function () {
                    $(".filter-bg").animate({opacity:0}, 400, "linear", function () {
                        $(".filter-bg").hide();
                    });
                }
            )
            $(".filter-inner").removeClass("filter-opened");
        }

        <?php
        $badges_obj = new \App\Libraries\Badges();
        $badges = $badges_obj->getBadges();
        if(count($badges) > 0) {
            foreach ($badges as $key => $val) {
                echo "APP.setBadge('{$key}', {$val});";
            }
        } ?>

    });
</script>
</body>
</html>
