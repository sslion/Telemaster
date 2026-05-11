<?php
namespace App\Libraries;
use App\Models\SettingsModel;

class Settings
{
    private static $instance = null;
    private $settings = [];

    static function getInstance() {
        if(!static::$instance) {
            static::$instance = new static();
            $settings = (new SettingsModel())->findAll();
            if(count($settings)) {
                foreach ($settings as $setting) {
                    static::$instance->settings[$setting["code"]] = $setting["value"];
                }
            }
        }
        return static::$instance;
    }

    public function __construct(){}
    public function __clone(){}
    public function __wakeup(){}

    function get($key) {
        if(key_exists($key, $this->settings)) {
            return $this->settings[$key];
        }
        return "";
    }

    // TODO сделать сеттер
    function set($key, $value) {
        if(key_exists($key, $this->settings)) {
            return $this->settings[$key];
        }
        return "";
    }
}