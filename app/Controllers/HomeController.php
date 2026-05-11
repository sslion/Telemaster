<?php

namespace App\Controllers;

use App\Models\PostsModel;
use Telegram\Bot\Api;
use function PHPUnit\Runner\render;

class HomeController extends BaseController
{
    public function index()
    {
//        view('welcome_message');

        $this->render(null, "templates/site/index");
    }

    public function login()
    {
        $this->render(null, "templates/site/login");
    }
}
