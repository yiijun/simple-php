<?php
// +----------------------------------------------------------------------
// | Created by [ PhpStorm ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016.
// +----------------------------------------------------------------------
// | Create Time (2020-07-29 9:57)
// +----------------------------------------------------------------------
// | Author: 唐轶俊 <tangyijun@021.com>
// +----------------------------------------------------------------------
namespace libs\framework\base;
class View
{
    protected $controller;

    protected $action;

    protected $variables = [];

    public function __construct($controller,$action)
    {
        $this->controller = $controller;
        $this->action = $action;
    }

    /**
     * @param $name
     * @param $value
     * 渲染变量
     */
    public function assign($name,$value)
    {
        $this->variables[$name] = $value;
    }

    /**
     * 加载视图
     */
    public function render()
    {
        //变量赋值
        extract($this->variables);

        //获取视图路径
        $layout = APP_PATH . '/view/' . strtolower($this->controller) . '/' . ucwords($this->action) . '.html';

        if (is_file($layout)) {
            include $layout;
        } else {
            echo "<h1>无法找到视图文件</h1>";
        }
    }
}