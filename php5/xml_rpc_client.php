<?php

/**
 * 
 * XML RPC 客户端请求
 */
include '../lib/xmlrpc-2.2.2/lib/xmlrpc.inc';

#请求数据处理
$request_data = array('name' => '李睿', 'age' => 25);
$f = new xmlrpcmsg('functionname', array(php_xmlrpc_encode($request_data))
); #传递的参数

var_dump($f);
die;
//开始请求
$c = new xmlrpc_client("/learn/php5/xml_rpc_server.php", "learn.local", 88);
//$c->setDebug(1); //设置开发模式
$r = &$c->send($f);

if (!$r->faultCode()) {
    $v = $r->value();
    print "</pre><br/>Request data is "
            . htmlspecialchars($v->scalarval()) . "<br/>";
    print "<HR>I got this value back<BR><PRE>" .
            htmlentities($r->serialize()) . "</PRE><HR>\n";
} else {
    print "An error occurred: ";
    print "Code: " . htmlspecialchars($r->faultCode())
            . " Reason: '" . htmlspecialchars($r->faultString()) . "'</pre><br/>";
}