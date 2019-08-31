<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/16
 * Time: 16:49
 */
$mysql=new mysqli('localhost','root','','repair');
//echo '连接成功';
//将数据库的字符转换为中文
$mysql->set_charset('utf8');
