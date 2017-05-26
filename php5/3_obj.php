<?php

/**
 * PHP5 面向对象
 */
include '../common.php';
#常量

class ConstTest {

    const RED = 'aaa';

}

//echo ConstTest::RED; //#常量访问
/**
 * 克隆class
 */
class CloneTest {

    public $var1 = 1;

    public function __clone() {
        echo 'clone class success';
    }

}

$clone_test = new CloneTest();
//echo $clone_test->var1;
//$clone_test2 = clone $clone_test;
$clone_test2->var1 = 2;
//echo "<br/>";
//echo $clone_test->var1;

/**
 * 多态练习
 * 
 */
class Animal {

    public function makeSounds() {
        print "no animal";
    }

}

class Dog extends Animal {

    public function makeSounds() {
        print 'wuff';
    }

}

class Cat extends Animal {

    public function makeSounds() {
        print 'miao';
    }

}

$s = new Cat();
$is_instance = $s instanceof Animal;
//var_dump($is_instance);

/**
 * 接口
 * 
 */
interface InterFace1 {

    function getName();
}

class InterFaceClass implements InterFace1 {

    public function getName() {
        return 1231;
    }

    public function getAge() {
        return 123;
    }

}

$a = new InterFaceClass();

//var_dump($a instanceof InterFace1);

function funcitonparamType(InterFace1 $a) {
    return $a->getName();
}

$s = funcitonparamType($a);
//v($s);

/**
 * 
 * class __get,__set,__call,类的属性和方法的重载
 * 
 */
class magicFuncClass {

    private $x = 1;
    private $y = 2;

    public function __set($name, $value) {
        echo 123;
    }

    public function __get($name) {
        return $this->$name;
    }

    public function seyHello() {
        echo 'hello';
    }

}

/**
 * 模仿函数只对本类有用，子类没效果
 */
class magicFuncClassSon extends magicFuncCall {
    
}

$s = new magicFuncClassSon();
$s->x = 4;
//v($s->x);

class magicFuncCall {

    public function __construct() {
        $this->obj = new magicFuncClass();
    }

    public function seyHello1() {
        echo 'hello1';
    }

    public function __call($method, $args) {
        return call_user_func_array(array($this->obj, $method), $args);
    }

}

function funcCallTest($s) {
    var_dump($s);
}

//call_user_func('funcCallTest', array(1, 2, 3)); //函数调用 = funcCallTest(array(1, 2, 3));
#class调用,第一个参数array(类名，函数名),第二个参数为函数参数
//call_user_func(array('magicFuncClass', 'seyHello'), array(1, 2, 3));
$magicFuncClass = new magicFuncCall();

//$magicFuncClass->x = 11;
//$magicFuncClass->seyHello();

/**
 * 使用数组语法访问的重载
 */
class AccessAccessClass implements ArrayAccess {

    public $name1 = 'name1';
    public $name2 = 'name3';

    public function offsetExists($name) {
        
    }

    public function offsetGet($name) {
        return $name;
    }

    public function offsetSet($name, $value) {
        
    }

    public function offsetUnset($name) {
        
    }

}

$access = new AccessAccessClass();
//v($access['join']);
#使用迭代器重载
foreach ($access as $key => $acces) {
//    var_dump($access[$key]);
}

/**
 * 
 * 面向对象设计模式 - 策略模式
 * @用途: 处理程序算法与其他算法之间的互换，策略模式经常和工厂模式一起使用
 * @实现方式: 通过声明一个抽象类的拥有一个算法方法的基类来实现的，而且通过继承这个基类的具体的类来实现
 */
abstract class FileNamingStrategy {

    abstract function createLinkName($filename);
}

class ZipFileNamingStrategy extends FileNamingStrategy {

    public function createLinkName($filename) {
        return 'Zip' . $filename;
    }

}

class TarFileNamingStrategy extends FileNamingStrategy {

    public function createLinkName($filename) {
        return 'Tar' . $filename;
    }

}

/**
 * 
 * 面向对象设计模式 - 单件模式
 * @用途 实例一个类，在整个应用范围都存在，并让整个应用的代码都可以访问它
 * @实现方式 实现一个静态的类的方法getInstance(),值返回该类的唯一的实例.
 * 它创建一个实例，把它存放在一个私有的静态变量中,并返回实例，下一次创建，返回这个创建的实例句柄
 * 
 */
class Logger {

    public static $instance = null;

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Logger();
        }
        return self::$instance;
    }

    private function __construct() {
        
    }

    private function __clone() {
        
    }

    public function Log($str) {
        return $str;
    }

}

//v(Logger::getInstance()->Log('my log'));

/**
 * 
 * 面向对象设计模式 - 工厂模式
 * @用途 
 * @实现方式 一个工厂类拥有一个静态的方法，用来接受一些输入，根据输入决定创建那个类的实例 
 */
#算数类
abstract class Operation {

    protected $_NumberA = 0;
    protected $_NumberB = 0;
    protected $_Result = 0;

    abstract function getResult($a, $b);
}

class AddOperation extends Operation {

    public function getResult($a, $b) {
        $this->_Result = $a + $b;
        return $this->_Result;
    }

}

class SubOpereation extends Operation {

    public function getResult($a, $b) {
        return $a - $b;
    }

}

class OpereationFactory {

    public static function createOperation($type) {
        $result = null;
        switch ($type) {
            case "+":
                $result = new AddOperation();
                break;
            case "-":
                $result = new SubOpereation();
                break;
        }
        return $result;
    }

}

$a = OpereationFactory::createOperation('-');
//v($a->getResult(2, 3));#结果: int(-1)

/**
 * 
 * 面向对象设计模式 - 观察者模式
 * @用途: 更改一小块程序，影响应用中许多不同部分的代码
 * 当被观察这发生变化，观察者数据都相应做出改变
 */
interface Observer {

    public function notify($obj);
}

class ExchangeRage {

    public static $instance = null;
    private $observers = array();
    private $exchange_rage;

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new ExchangeRage();
        }
        return self::$instance;
    }

    public function getExchangeRage() {
        return $this->exchange_rage;
    }

    public function setExchangeRage($new_rage) {
        $this->exchange_rage = $new_rage;
        $this->notifyObservers();
    }

    public function notifyObservers() {
        foreach ($this->observers as $obj) {
            $obj->notify($this);
        }
    }

    public function registerObserver($obj) {
        $this->observers[] = $obj;
    }

}

class ProductItem implements Observer {

    public function __construct() {
        ExchangeRage::getInstance()->registerObserver($this);
    }

    public function notify($obj) {
        if ($obj instanceof ExchangeRage) {
            print "recevied updated !<br/>";
        }
    }

}

$p1 = new ProductItem();
$p2 = new ProductItem();

//ExchangeRage::getInstance()->setExchangeRage(4.5);

/**
 * 
 * 面向对象映射授权模式
 * 执行一个类，去调用其他类的方法
 */
class ClassOne {

    public function callClassOne() {
        echo 'class one<br/>';
    }

}

class ClassTwo {

    public function callClassTwo() {
        echo 'class two<br/>';
    }

}

class ClassDelegator {

    private $targets;

    public function __construct() {
        $this->targets[] = new ClassOne();
    }

    public function delegrtor($obj) {
        $this->targets[] = $obj;
    }

    public function __call($method, $args) {
        foreach ($this->targets as $target_obj) {
            $target_reflector = new ReflectionClass($target_obj);
            if ($target_reflector->hasMethod($method)) {
                $method = $target_reflector->getMethod($method);
                if ($method->isPublic() && !$method->isAbstract()) {
                    return $method->invoke($target_obj, $args);
                }
            }
        }
    }

}

$delegator = new ClassDelegator();
$delegator->delegrtor(new ClassTwo());
$delegator->callClassOne();
$delegator->callClassTwo();
#结果
//class one
//class two
?>