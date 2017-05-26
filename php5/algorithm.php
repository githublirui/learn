<?php

$arr = array(345, 4, 17, 6, 52, 16, 58, 69, 32, 8, 234);
$length = count($arr);
for ($i = 1; $i < $length; $i++) {
    for ($j = $length - 1; $j >= $i; $j--) {
        if ($arr[$j] < $arr[$j - 1]) {
            $tmp = $arr[$j - 1];
            $arr[$j - 1] = $arr[$j];
            $arr[$j] = $tmp;
        }
    }
}
print_r($arr);
?>
