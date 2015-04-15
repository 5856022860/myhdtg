<?php if(!defined('HDPHP_PATH'))exit;
return array (
  'addressid' => 
  array (
    'field' => 'addressid',
    'type' => 'int(10) unsigned',
    'null' => 'NO',
    'key' => true,
    'default' => NULL,
    'extra' => 'auto_increment',
  ),
  'user_id' => 
  array (
    'field' => 'user_id',
    'type' => 'int(10) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'consignee' => 
  array (
    'field' => 'consignee',
    'type' => 'char(20)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'city' => 
  array (
    'field' => 'city',
    'type' => 'char(20)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'province' => 
  array (
    'field' => 'province',
    'type' => 'char(12)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'county' => 
  array (
    'field' => 'county',
    'type' => 'char(12)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'tel' => 
  array (
    'field' => 'tel',
    'type' => 'char(12)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'street' => 
  array (
    'field' => 'street',
    'type' => 'varchar(120)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'postcode' => 
  array (
    'field' => 'postcode',
    'type' => 'char(10)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
);
?>