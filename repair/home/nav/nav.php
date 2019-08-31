<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/23
 * Time: 10:47
 */
header('Content-type:text/html;charset:utf8');
include_once '../../config/db.php';
$nid=$_GET['nid'];
$nsql="select * from nav where id='$nid'";
$data=$mysql->query($nsql)->fetch_assoc();
$tpl=$data['url'];
include_once '../views/'.$tpl;
