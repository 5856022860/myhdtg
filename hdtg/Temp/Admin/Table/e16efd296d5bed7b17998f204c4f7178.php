<?php if(!defined('HDPHP_PATH'))exit;
return array (
  'adminname' => 
  array (
    'field' => 'adminname',
    'type' => 'char(20)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'adminid' => 
  array (
    'field' => 'adminid',
    'type' => 'tinyint(3) unsigned',
    'null' => 'NO',
    'key' => true,
    'default' => NULL,
    'extra' => 'auto_increment',
  ),
  'adminpass' => 
  array (
    'field' => 'adminpass',
    'type' => 'char(32)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
);
?>