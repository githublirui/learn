<?php
include '../common.php';
if ($_FILES) {
//    var_dump($_FILES['lr_file']);
//    var_dump($_FILES['lr_file']['name']);
//    var_dump($_FILES['lr_file']['type']);
//    var_dump($_FILES['lr_file']['tmp_name']);
//    var_dump($_FILES['lr_file']['size']); #按照字节，1T=1024G,1G=1024MB  1MB=1024KB 1KB=1024字节 1个汉字占两个字节.
//    var_dump($_FILES['lr_file']['error']);
    #文件大小，文件类型，是否是上传文件
    $max_size = 1024 * 1024 * 2; #2M
    $allow_type = array('jpg', 'doc', 'rar', 'zip');
    if (is_uploaded_file($_FILES['lr_file']['tmp_name'])) {
        if ($_FILES['lr_file']['size'] > $max_size) {
            echo '文件大小错误';
            die;
        }
        $ext = strtolower(substr($_FILES['lr_file']['name'], strripos($_FILES['lr_file']['name'], '.') + 1));
        if (!in_array($ext, $allow_type)) {
            echo '文件扩展名错误';
            die;
        }
        $rand_name = time() . substr(md5(uniqid(rand(), true)), 0, 6);
        @mkdir('./upload/');
        if (move_uploaded_file($_FILES['lr_file']['tmp_name'], './upload/' . $rand_name . '.' . $ext)) {
            echo '上传成功';
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    </head>
    <body>
        <form enctype="multipart/form-data" method="post" action="./5.8.php" >
            <input type="file" name="lr_file" />
            <input type="submit" />
        </form>
    </body>
</html>