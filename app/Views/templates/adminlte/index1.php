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

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Поиск" aria-label="Поиск">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

<!--        <button type="button" id="subscribe">Следить за изменениями</button>-->

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>

            <?
            if(!empty($user["isAdmin"])) {
            $menu_mdl = new \App\Models\MenuModel();
            $menus = $menu_mdl->getMenus();
            ?>
            <li class="nav-item dropdown d-none d-sm-inline-block">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="nav-link dropdown-toggle">Интерфейс</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow dropdown-menu-right" style="left: 0px; right: inherit;">
                    <? foreach ($menus as $item) { ?>
                    <li><a href="#" class="dropdown-item"><?=$item["title"]?></a></li>
                    <? } ?>
                </ul>
            </li>
            <? } ?>

            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
                            class="fa fa-cogs"></i></a>
            </li>
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
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <?php
                    $user = session()->get('user');
//                    dd($user);
                    if($user && !$user['avatar']) { ?>
                        <img src="<?=site_url(settings('AVATARS_DIRECTORY') . 'noavatar.png')?>" class="img-circle elevation-2" alt="User Image">
                    <? } elseif($user && $user['avatar']) { ?>
                        <img src="<?=site_url(settings('AVATARS_DIRECTORY') . $user['avatar'])?>" class="img-circle elevation-2" alt="User Image">
                    <? } else { ?>
                        <img src="<?=site_url(settings('AVATARS_DIRECTORY') . 'noavatar.png')?>" class="img-circle elevation-2" alt="User Image">
                    <? } ?>
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?=$user['username'] ?? "Пупкин В."?></a>
                </div>
            </div>

            <nav class="mt-2">
                <?php
                $menu_mdl = new \App\Models\MenuModel();
                echo view('layouts/admin_menu', ['menu_items' => $menu_mdl->getAdminMenu()]);
                ?>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <?php if (!isset($content_header_hide)) { ?>
        <div class="content-wrapper">
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
        <div class="content-wrapper dashboard">
            <?= $content ?>
        </div>
    <?php } ?>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
            <input type="text" style="width: 100%;" placeholder="Каккой-то инпут">
        </div>
    </aside>

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
<script src="https://unpkg.com/tippy.js@6"></script>

<!--Скрипт уведомлений-->
<script type="text/javascript" src="//www.gstatic.com/firebasejs/3.6.8/firebase.js"></script>
<script type="text/javascript" src="/firebase_subscribe.js"></script>
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
