<?php
namespace App\Libraries;
use Telegram\Bot\Api;

class Telegram
{
    private static $instance = null;
    private static $telegram = null;
    public static $token = '7747802532:AAElxqJYF2Go7Uixp_TGwdUpTjCh8YzLYSI';

    static function getInstance() {
        if(!static::$instance) {
            static::$instance = new static();

//            $token = '7747802532:AAElxqJYF2Go7Uixp_TGwdUpTjCh8YzLYSI';
            static::$telegram = new Api(static::$token);
        }
        return static::$telegram;
    }

    public function __construct(){}
    public function __clone(){}
    public function __wakeup(){}
}