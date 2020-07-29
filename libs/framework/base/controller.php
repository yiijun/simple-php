<?php
// +----------------------------------------------------------------------
// | Created by [ PhpStorm ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016.
// +----------------------------------------------------------------------
// | Create Time (2020-07-29 10:06)
// +----------------------------------------------------------------------
// | Author: 唐轶俊 <tangyijun@021.com>
// +----------------------------------------------------------------------
namespace libs\framework\base;
class Controller
{
    protected $controller;

    protected $action;

    protected $view;

    public function __construct($controller,$action)
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->view = new View($this->controller,$this->action);
    }


    public function assign($name, $value)
    {
        $this->view->assign($name, $value);
    }


    public function render()
    {
        $this->view->render();
    }
}