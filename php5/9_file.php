<?php
include '../common.php';
$path = 'file.txt';
//$fp = fopen($path, 'rb+');
#打开一个文件句柄，可以是url，第二个参数
#r(只读方式打开，将文件指针指向文件头),
#w(写入方式打开，将文件指针指向文件头并将文件大小截为零。如果文件不存在则尝试创建之),
#a(写入方式打开，将文件指针指向文件末尾。如果文件不存在则尝试创建之。),加号代表读写方式
#b 指定文件是二进制文件访该广
//$fr = fread($fp, '5'); #从文件读取一个数据块
//$fg = fgets($fp); #获取文件第一行
//fwrite($fp, 'bb'); //fputs 写入文件
//fclose($fp); #关闭文件句柄
//v($fg);
#注: 在处理一个文件的时候通常使用file_get_contents加载到内存并且运行preg_match_all会很浪费资源，使用如下会更加高效
//echo file_get_contents($path);
#feof 测试文件指针是否到了文件结束的位置
//while (!feof($fp)) {
//    $line = fgets($fp);
//    echo $line . '<br/>';
//}
//时间扩展
//echo time();
//echo microtime();
//print_r(gettimeofday());
//echo localtime();
//echo gmmktime();
//echo "\n\r";
//echo time();
////setlocale($category, $path);
//
//putenv($path);#设置环境变量，周期为程序运行结束
//$ts = mktime(12, 0, 0, 10, 29, 2004);
//for ($i = 0; $i < 4; $i++) {
//    echo date('Y-m-d H:i:s', $ts) . "\r\n";
//    $ts += 24 * 60 * 60;
//}
#遍历一个文件夹里的所有文件和文件夹
$dir = "./www";

function listDir($dir) {
    $path = realpath($dir);

    if (is_dir($path)) {
        $pd_handle = opendir($path);
        while (($file = readdir($pd_handle))) {
            if ($file == '..' || $file == '.') {
                continue;
            }
            $f_path = $path . '/' . $file;
            if (is_dir($f_path)) {
                echo $f_path . "<br/>";
                listDir($f_path);
            } else {
                echo $f_path . "<br/>";
            }
        }
        closedir($pd_handle);
    } else {
        echo $path;
    }
}

function listDir1($path) {
    $path = realpath($path);
    if (is_dir($path)) {
        $files = scandir($path);
        foreach ($files as $file) {
            if ($file == '..' || $file == '.') {
                continue;
            }
            $s_path = $path . "/" . $file;
            echo $s_path . "<br/>";
            if (is_dir($s_path)) {
                listDir1($s_path);
            }
        }
    } else {
        echo $path . "<br/>";
    }
}

$re = listDir1($dir);
?>

