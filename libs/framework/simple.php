<?php
// +----------------------------------------------------------------------
// | Created by [ PhpStorm ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016.
// +----------------------------------------------------------------------
// | Create Time (2020-07-28 16:05)
// +----------------------------------------------------------------------
// | Author: 唐轶俊 <tangyijun@021.com>
// +----------------------------------------------------------------------
namespace libs\framework;
class Simple
{
    protected $config = [];

    public function __construct($config = [])
    {
        $this->config = $config;
    }

    public function run()
    {
        //路由解析
        $this->route();

        //设置错误级别
        $this->setReporting();
    }



    public function route()
    {
        $controllerName = $this->config['controller'];
        $actionName = $this->config['action'];
        $params = [];
        $url = $_SERVER['REQUEST_URI'];
        $position = strpos($url, '?');
        $url = $position === false ? $url : substr($url, 0, $position);
        $url = trim($url, '/');
        if ($url) {
            $urlArray = explode('/', $url);
            $urlArray = array_filter($urlArray);

            //获取控制器名称
            $controllerName = ucfirst($urlArray[0]);
            array_shift($urlArray);

            //获取方法名称
            $actionName = $urlArray ? $urlArray[0] : $actionName;
            array_shift($urlArray);

            //获取参数
            $params = $urlArray ? $urlArray : array();
        }

        //获取模块名称
        $module = substr(APP_PATH,strrpos(str_replace('\\','/',APP_PATH),"/") + 1);
        $controller = 'app\\'.$module.'\\controller\\'. $controllerName;

        //过滤
        if ($controller && !preg_match('/^[A-Za-z](\w|\.)*$/', $controller) && !class_exists($controller)) {
            exit($controller . '控制器不存在');
        }
        if (!method_exists($controller, $actionName)) {
            exit($actionName . '方法不存在');
        }
        $dispatch = new $controller($controllerName, $actionName);
        call_user_func_array(array($dispatch, $actionName), $params);
    }



    public function setReporting()
    {
        if (APP_DEBUG === true) {
            error_reporting(E_ALL);
            ini_set('display_errors','On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors','Off');
            ini_set('log_errors', 'On');
        }
    }
}