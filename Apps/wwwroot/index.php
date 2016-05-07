<?php
/**
 * API入口文件
 * @auther zhoushuai
 */
$starttime = microtime(true);
define('APPNAME', 'api');
//定义当前项目的名称
define('APP_FOLDER','Api');
//视图目录
define('VIEW_FOLDER','');
//引入公用的入口文件
require_once '../Com/entry/index.php';
