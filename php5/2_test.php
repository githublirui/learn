<?php

//include ('www/t1.php');
//735652
//2014-2-23
$time = strtotime('2014-2-23 00:00:00');
//echo $time;
//echo "<br/>";
////echo $time - (735652 * 60 * 60 * 24);
//echo   60 * 60 * 24;
//die;

include '../common.php';
include 'pear/Crypt/HMAC.php';

$s = null;

//v(isset($s));

function test($a) {
    return $a;
}

$test = &test(123);

//echo $test;
//echo $a;
//$test =3;
//echo $a;


class E {

    private $p1;
    private $p2;

    function __construct($a) {
        $this->p1 = $a;
    }

    function __get($name) {
        echo 'get';
        return $this->$name;
    }

    function __isset($name) {
        return isset($this->$name);
    }

    function __unset($name) {
        unset($this->$name);
    }

}

$a = new E('v1');

//unset($a->p1);
//var_dump($a->p1);

class father {

    public function __construct() {
        $this->aa(123);
    }

}

class son extends father {

    public function aa($a) {
        echo __FUNCTION__ . __CLASS__ . "<br/>" . $a;
    }

}

/**
 * 
 * 鐖剁被鍜屽瓙绫荤殑__set
 */
class FatherSet {

    public $var = null;

    public function __set($name, $value) {
        $this->$name = $value;
    }

}

class SonSet EXtends FatherSet {

    public function __set($name, $value) {
        $this->$name = $value;
    }

}

//$s = new SonSet();
//$s->var = 123;
//var_dump($s->var);
//die;

class PHP5OBJTest {

    public $a = null;

    public function setName($a) {
        $this->a = $a;
        return $this->a;
    }

}

function setR(PHP5OBJTest $a) {
    $a->setName(1233);
}

$r = new PHP5OBJTest();
$a = clone $r;
//$a = $r;
$r->setName('aaaa');
setR($a);
v($r->a);

define('SECRET_KEY', 'example');
#hmac加密算法，不可逆

function createHmac($array) {
    $hmac = new Crypt_HMAC(SECRET_KEY);
    $data = '';
    foreach ($array as $k => $v) {
        $data .= $k . $v;
        $ret[] = "$k=$v";
    }
    $hash = $hmac->hash($data);
    $ret[] = "hash=$hash";
    return join("&amp", $ret);
}

$s = createHmac(array('a' => 'b'));

//chr()  #函数从指定的 ASCII 值返回字符。
function validHmac($arr) {
    
}

//v(123 ^ str_repeat(chr(0x36), 64));
#异常
try {
    throw new Exception(111);
} catch (Exception $e) {
    //echo $e->getMessage();
}

#面向对象迭代
//v(md5(uniqid(rand())));
//phpinfo();die;
$m = new Memcache();
$m->connect('127.0.0.1', 80);
var_dump($m);
die;
