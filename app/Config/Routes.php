<?php

use CodeIgniter\Router\RouteCollection;

$filter = "auth"; // Требуется авторизация
//$filter = "noauth"; // Не требуется авторизация

//$adminFilter = "adminAuth"; // Требуется авторизация
$adminFilter = "noauth"; // Не требуется авторизация

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('/login', 'HomeController::index', ['as' => 'manager_login']);

$routes->group('manager', ['filter' => $filter], function ($routes) use ($filter) {
    $routes->get('/', 'Manager\MainController::index', ['as' => 'manager_main', 'filter' => $filter]);
    $routes->get('dashboard', 'Manager\MainController::index', ['as' => 'manager_dashboard']);

    $routes->get('channels', 'Manager\ChannelsController::index', ['as' => 'manager_channels']);
    $routes->get('channels/edit', 'Manager\ChannelsController::editChannel', ['as' => 'manager_editChannel']);
    $routes->post('channels/edit', 'Manager\ChannelsController::saveChannel', ['as' => 'manager_saveChannel']);
    $routes->post('channels/check', 'Manager\ChannelsController::checkChannel', ['as' => 'manager_checkChannel']);

    $routes->get('posts', 'Manager\PostsController::index', ['as' => 'manager_posts']);
    $routes->get('posts/new', 'Manager\PostsController::newPost', ['as' => 'manager_newPost']);

//    $routes->post('sendMessage', 'Manager\MainController::newPost', ['as' => 'manager_newPost']);
});

$routes->group('admin', ['filter' => $adminFilter], function ($routes) {
    $routes->get('/', 'Manager\MainController::index', ['as' => 'admin_main']);
    $routes->get('dashboard', 'Manager\MainController::index', ['as' => 'admin_dashboard']);
});