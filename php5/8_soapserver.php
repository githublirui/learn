<?php

/**
 * SOAP SERVER
 */
class SoapRequest {

    public function getName() {
        return 'Li Rui';
    }

}

//包含提供服务的类进来
//wsdl方式提供web service,如果生成了wsdl文件则可直接传递到//SoapServer的构造函数中
//$s = new SoapServer('PersonInfo.wsdl');
//doesn't work 只有location不能提供web service
//output:looks like we got no XML document
//$s = new SoapServer(null,array("location"=>"http://localhost/Test/MyService/Server.php"));
//下面两种方式均可以工作，只要指定了相应的uri
//$s = new SoapServer(null,array("uri"=>"Server.php"));
$s = new SoapServer(null, array("location" => "http://localhost/Test/MyService/Server.php", "uri" => "Server.php"));
$s->setClass("SoapRequest");

$s->handle();
?>