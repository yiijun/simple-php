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
$host_name = gethostname();
if(in_array($host_name, ['VM_48_39_centos'])) {
    define('LIB_ENV', 'pro');
} else if(in_array($host_name, ['10-9-115-74'])) {
    define('LIB_ENV', 'test');
} else {
    define('LIB_ENV', 'dev');
}

define('APP_PATH', dirname(__FILE__));
define('APP_DEBUG', true);
require __DIR__ . '/../../vendor/autoload.php';

//加载配置
$config = require_once __DIR__ . '/../../conf/'.LIB_ENV.'/conf_admin.php';
$app = new \libs\framework\Simple($config);