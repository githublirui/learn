<?php

include '../common.php';

/**
 * 
 * XML
 */
$xml = xml_parser_create('UTF-8'); #创建解析器对象
//处理器初始化
xml_set_element_handler($xml, 'start_handler', 'end_handler'); #针对开始和结束标记
xml_set_character_data_handler($xml, 'character_handler'); #针对字符数据
xml_parser_set_option($xml, XML_OPTION_CASE_FOLDING, FALSE); #关闭大小写折叠

function start_handler($xml, $tag, $attributes) {
//    var_dump($attributes);
}

function end_handler($xml, $tag) {
//    var_dump($tag);
}

function character_handler($xml, $data) {
    //var_dump($data);
}

//xml_parse($xml, file_get_contents('demo.xml'));#解析xml
//开始解析xml文件
$a = simplexml_load_string(file_get_contents('demo.xml')); //把xml文件转换成simple xml对象

$xml = simplexml_load_file("./demo.xml"); //把xml文件转换成simple xml对象
#解析DOM树
$dom = new DOMDocument();
$dom->load('demo.xml');

$root = $dom->documentElement;
//page 256
$dom_nodes = $root->childNodes;
for ($i = 0; $i < $dom_nodes->length; $i++) {
    $item = $dom_nodes->item($i);
    /* @ $item DOMText */
//    $item->setAttribute('id', true);
}

$node = $dom->getElementById('menu'); //为解决，获取不到
//v($node);
//$root->length;
//$body_attr_name = $dom->getElementsByTagName('body')->item(0)->getAttributeNode('aa')->name; #获取属性
//$body_attr_value = $dom->getElementsByTagName('body')->item(0)->getAttributeNode('aa')->value; #获取属性值
//v($root->getAttribute('ff'));
//v($body->getAttributeNode('background')->value);
//v($dom->getElementsByTagName('body')->length);
#XPATH查询
$xpath = new DOMXPath($dom);
$nodes = $xpath->query('/html/body[@aa=\'bb\']'); #搜索属性
//v($nodes->length);
//v($nodes->item(0)->getAttribute('aa'));
#创建DOM
$dom = new DOMDocument();
$html = $dom->createElement('html');
$dom->appendChild($html);
$head = $dom->createElement('head');
$title = $dom->createElement('title');
$head->appendChild($title);
$title->appendChild($dom->createTextNode('Create Dom'));
$html->appendChild($head);
$body = $dom->createElement('body');
$body->setAttribute('border', '1px slid red');
$html->appendChild($body);
$div = $dom->createElement('div');
$body->appendChild($div);
$div->appendChild($dom->createTextNode('Hello World'));
$div->appendChild($dom->createElement('br'));
//echo $dom->saveHTML(); #生成html

/**
 * 8.4.2 浏览simpleXML对象
 */
$xml = simplexml_load_file('demo.xml');
//v($xml->body->name[1]);
foreach ($xml->body->children() as $element) {
    echo ($element);
}