<?php
if ($_POST) {
    var_dump($_POST);
    echo "<br/>";
    $fp = fopen('php://input', 'rb');
    while (!feof($fp)) {
        echo fgets($fp);
    }
}
iconv($in_charset, $out_charset, $str);
mb_convert_encoding($str, $to_encoding, $fp);
var_dump(version_compare(5.3, 5.4));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>php输入输出流</title>
    </head>
    <form method="POST" action="?a=1231" enctype="martipart/form-data">
        <input name="example1" /><br/>
        <input name="example2" /><br/>
        <input type="submit" /><br/>
    </form>
</html>
