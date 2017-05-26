<?php

header("Content-type: text/html; charset=utf-8");
$simple_code = array(
    '一',
    '地',
    '在',
    '要',
    '工',
    '上',
    '是',
    '中',
    '国',
    '同',
    '和',
    '的',
    '有',
    '人',
    '我',
    '主',
    '产',
    '不',
    '为',
    '这',
    '民',
    '了',
    '发',
    '以',
    '经',
);
shuffle($simple_code);
$arr_keys = ($simple_code);
echo implode("", $arr_keys);