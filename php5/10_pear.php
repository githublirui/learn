<?php

require_once 'pear/HTML/Template/IT.php';

$list_items = array(
    'a',
    'b',
    'c',
);
$tpl = new HTML_Template_IT('./templates');
$tpl->loadTemplatefile('it_list_tpl');
