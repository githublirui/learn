<?php

include '../common.php';

/**
 * 
 * 第五章用php写web应用
 */
//5.4.1 常见的错误
#1. php.ini register_globals的值设置为off
#2. 跨站运行脚本，
#2. sql注入
//5.5.1 用户输入验证
#1. 对于不同类型的验证方法，可以在脚本里把收到的数据强制类型转换
# $product_id = (int) $_GET['id'];
//HMAC 确认
class Crypt_HMAC {

    public function __construct($key, $method = 'md5') {
        if (!in_array($method, array('md5', 'sha1'))) {
            die('unsupported has function ' . $method);
        }
    }

}

//三种加密方式
#md5($str);sha1($str);crypt($str);
//5.5.6 错误处理
#log_errors,display_errors
#可以设置error_log来设置log的文件，例: error_log = "C:\log_cmd\log\php_error.log"
function customError($type, $error, $file, $line) {
    //$type 捕捉到错误的类型
    //$error 文本的错误信息
    //$file,$line 错误的文件名和错误的行数
    echo "<b>Custom error:</b> [$type] $error<br />";
    echo " Error on line $line in $file<br />";
    echo "Ending Script";
    die();
}

set_error_handler('customError'); #自定义错误处理
//session 
session_id('test'); #指定session id 
session_start();
//v(session_id());

/**
 * 异常
 */
try {
    $a->display();
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
