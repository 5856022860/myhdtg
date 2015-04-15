<?php if(!defined('HDPHP_PATH'))exit;
return array (
  'user_id' => 
  array (
    'field' => 'user_id',
    'type' => 'int(10) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'goods_id' => 
  array (
    'field' => 'goods_id',
    'type' => 'int(10) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'goods_num' => 
  array (
    'field' => 'goods_num',
    'type' => 'smallint(6)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'orderid' => 
  array (
    'field' => 'orderid',
    'type' => 'int(10) unsigned',
    'null' => 'NO',
    'key' => true,
    'default' => NULL,
    'extra' => 'auto_increment',
  ),
  'total_money' => 
  array (
    'field' => 'total_money',
    'type' => 'smallint(6)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'addressid' => 
  array (
    'field' => 'addressid',
    'type' => 'smallint(5) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'status' => 
  array (
    'field' => 'status',
    'type' => 'enum(\'未付款\',\'已付款\')',
    'null' => 'NO',
    'key' => false,
    'default' => '未付款',
    'extra' => '',
  ),
);
?>