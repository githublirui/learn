<?php

include '../common.php';
class A {

    public $a = 'aaaa';

    public function __construct() {
//        $this->testA();
    }

    public function testA() {
        var_dump($this->a);
    }

}

#多继承样例

class B {

    public $b = 131231;

    public function TestB() {
        echo 'TestB';
//        $re = new ReflectionClass($this);
//        $pros = $re->getProperties(ReflectionProperty::IS_PUBLIC);
//        $mlists = $re->getMethods(ReflectionProperty::IS_PUBLIC);
//        $a = new ReflectionProperty();
//        $m = new ReflectionMethod($a, $name);
//        $m->isStatic();
//        $m->invoke($object, $m);
//        $c::$m;
//        $a = $a->getName();
//        $b = $a->getValue($object);
//        echo 6666;
        //property_exists($class, $property); #检查对象或类是否具有该属性
    }

    public function __call($name, $arguments) {
        var_dump($arguments);
    }

}

//$b = new B();
//$b->TestS();
//die;
#接口。
//作用: 当很多人开发时，定义一个类的模版，类里的所有方法都必须要去实现
#抽象类
//作用: 实际不使用,不能实例化
//，抽象出共同的方法，供给其他子类调用，含有抽象方法的类必须是抽象类

class MultiExtend {

    protected $_extends = array(); #继承的类
    protected $_extend_methods = array(); #继承的方法

    public function __construct() {
        if (count($this->_extends) > 0) {
            $this->iniExtend();
        }
    }

    protected function iniExtend() {
        $extend_classes = $this->_extends;

        #循环继承的类，继承类属性和方法
        foreach ($extend_classes as $extend_class) {
            $this->toextends($extend_class);
        }
    }

    public function toextends($extend_class) {
        #1. 继承所有公共属性
        $extend_class_ref = new ReflectionClass($extend_class);

        $extend_properties = $extend_class_ref->getProperties(ReflectionProperty::IS_PUBLIC);

        foreach ($extend_properties as $extend_property) {
            $name = $extend_property->getName();
            $extend_property = new ReflectionProperty($name, $name);
            /* @var $extend_property ReflectionProperty */
            $value = $extend_property->getValue(new $extend_class);
            if ($name == '_extends') {
                $this->_extends = array_merge($this->_extends, $value);
            } else {
                $this->{$name} = $value;
            }
        }

        #2. 继承方法
        $extend_methods = $extend_class_ref->getMethods(ReflectionMethod::IS_PUBLIC);
        foreach ($extend_methods as $extend_method) {
            $this->_extend_methods[$extend_method->name] = $extend_class;
        }
    }

    public function __call($name, $arguments) {
        $extend_methods = $this->_extend_methods;
        $o = $extend_methods[$name];
        if ($o) {
            return eval("$o::$name('" . $arguments . "');");
        } else {
            throw new Exception('方法未找到');
        }
    }

}

class C extends MultiExtend {

    public $_extends = array('A', 'B');

}

#ini
//$c = new C();
//echo $c->a;
$a = NULL;

//var_dump(isset($a)); #false
//die;
function callbackarr($value, $key) {
    echo $key . '-' . $value . '<br/>';
}

$arr = array('A', 'B');

//v(array_map('callbackarr', array('a' => 1, 'b' => 2)));# 执行函数
//array_walk($arr, 'callbackarr'); #函数对数组中的每个元素应用回调函数。注： 第一次个参数好像只支持变量，不支持直接传入数组

function increment(&$num, $inc = 1) {
    $num += $inc;
}

$num = 3;
increment($num);
increment($num, 1);

//v($num);
#面向对象static 静态属性,静态方法，属于类本身，不属于任何实例

class StaticVar {

    static $v = 1;

    public function setV() {
        self::$v++;
    }

}

$s = new StaticVar();
$s->setV();
$s->setV();
$s->setV();
$s = new StaticVar();

//v(StaticVar::$v);
#一个接口只能继承和自己不冲动的接口
interface I1 {
    const AA=1231;
    function getName();
}

interface I2 {

    function getName();
}

interface I3 extends I1, I2 {

    public function getName();
}

#sql 慢日志
//slow_query_log=d:/slow.txt 找到超过两秒的语句
