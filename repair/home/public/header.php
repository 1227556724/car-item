<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>汽车维修美容 | 维修服务、保养服务、钣金喷漆、AMG改装、加装服务、高档美容</title>
    <link rel="shopcut icon" href="/asset/index/img/title.png">
    <link rel="stylesheet" href="/asset/index/css/public.css">
    <link rel="stylesheet" href="https://at.alicdn.com/t/font_1251659_asfj0d7sdfw.css">
</head>
<?php
header('Content-type:text/html;charset:utf8');
include '../../config/db.php';
$nvasql="select * from nav  order by sort desc";
$newdata=$mysql->query($nvasql)->fetch_all(MYSQLI_ASSOC);
?>
<body>
<!-- 头部 -->
<div class="headerPM clearfix">
    <div class="wr-wrap">
        <div class="wf-table">
            <div class="wf-td">
                <a href="" class="bitem">
                    <img src="/asset/index/img/head1.png" alt="" class="car-one">
                </a>
            </div>
            <div class="nar-rg">
                <ul>
                    <?php
                    foreach ($newdata as $v){ ?>
                        <li><a class="<?php echo isset($nid)&& $nid==$v['id']? 'color':''  ?>" href="../nav/nav.php?nid=<?php echo $v['id']?>"><?php echo $v['navname']?></a></li>
                    <?php }?>
                    <li><a href="/home/index/index.php" class="<?php echo !isset($nid)? 'color':'' ;?>">首页</a></li>
                </ul>
            </div>

        </div>
    </div>
</div>
<div class="headerPM clearfix header-pull">
    <div class="wr-wrap">
        <div class="wf-table">
            <div class="wf-td">
                <a href="" class="bitem">
                    <img src="/asset/index/img/head1.png" alt="" class="car-pull">
                </a>
            </div>
            <div class="nar-rg">
                <ul>
                    <ul>
                        <?php
                        foreach ($newdata as $v){ ?>
                            <li><a class="<?php echo isset($nid)&& $nid==$v['id']? 'color':''  ?>" href="../nav/nav.php?nid=<?php echo $v['id']?>"><?php echo $v['navname']?></a></li>
                        <?php }?>
                        <li><a href="/home/index/index.php" class="<?php echo  !isset($nid)? 'color':'' ;?>">首页</a></li>
                    </ul>
                </ul>
            </div>
        </div>
    </div>
</div>