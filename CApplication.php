<?php
namespace core;

class CApplication
{
    public $config;
    public static $app = null;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public static function app($config = null)
    {
        if (self::$app == null) {
            if ($config === null && defined('APP_PATH')) {//约定APP_PATH为应用根目录，存放着config.php
                $config = require APP_PATH . '/config.php';
            }
            self::$app = new self($config);
        }
        return self::$app;
    }

    public function run()
    {
        $group = isset($_GET['g']) ? strtolower($_GET['g']) : '';
        if ($group == '') {
            $control = 'controller\\' . strtolower(isset($_GET['c']) ? $_GET['c'] : 'index');
        } else {
            $control = $group . '\controller\\' . strtolower(isset($_GET['c']) ? $_GET['c'] : 'index');
        }

        $action = strtolower(isset($_GET['a']) ? $_GET['a'] : 'index');

        if(!class_exists($control)){
            http_response_code(404);
            return false;
        }

        $ctrl = new $control($group, $control, $action);

        if ($ctrl->beforeAction()) {
            $ctrl->$action();
        }
        return true;
    }

}

	