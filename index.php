<?php
header("Content-type:text/html;charset=utf-8");
    //定义应用名字
    define('APP_NAME','JLCS');
    //定义应用路径
    define('APP_PATH','./JLCS/');
    //开启调试模式
    define('APP_DEBUG',true);
    //引入核心文件
    require './ThinkPHP/ThinkPHP.php';
?>