<?php
/**
 * 后台管理项目入口文件
 * @auther zhoushuai
 */
$starttime = microtime(true);
define('APPNAME', 'Manage');
//定义当前项目的名称
define('APP_FOLDER','Manage');
//视图目录
define('VIEW_FOLDER','');
//引入公用的入口文件
require_once '../../Com/entry/index.php';
