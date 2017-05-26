<?php

include '../lib/xmlrpc-2.2.2/lib/xmlrpc.inc';
include '../lib/xmlrpc-2.2.2/lib/xmlrpcs.inc';
include '../lib/xmlrpc-2.2.2/lib/xmlrpc_wrappers.inc';

function saySomething($msg) {
    $words = php_xmlrpc_decode($msg->getParam(0)); //从msg对象中解码出参数1 为变量
    //你可以在这里干n多事情
    //下面返回结果
//    if (strlen($words) > 0) {
    return new xmlrpcresp(new xmlrpcval('名字: ' . $words['name'] . ',年龄: ' . $words['age'], 'string')); //返回给客户的
//    } else {
//        return new xmlrpcresp(0, $xmlrpcerruser + 100, "参数 ‘" . $words['name'] . "’ 服务器怀疑你说废话.");
//        //出现错误返回给客户的，当然也可以不返回
//        //如果有什么参数不对啊 系统会返回错误的
//        //$xmlrpcerruser + 100 这个是返回客户自定义错误时候的错误代码
//        //开发RPC程序的时候最好自己定义一个错误表客户端显示的错误编号会是 100
//    }
}

//最后建立服务器
$s = new xmlrpc_server(array('functionname' => array('function' => 'saySomething', //命令对应要调用的函数     
//        'signature' => array(array('array', 'array')), //返回，输入的数据类型
    //一个函数可以有几种输入和输出类型     
//        'docstring' => 'This service echoes Hello+input stirng.'
    //对该调用的说明    
    )) //这个参数决定此时不立即服务   
);
$s->response_charset_encoding = "UTF-8"; //可以设置一些参数
$s->service(); //现在才开始服务