<?php
session_start();
if(!isset($_SESSION['id'])||!isset($_SESSION['username'])){
    header('Location:../login/index.html');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>汽车美容维修后台管理</title>
<!--    <link rel="stylesheet" href="../asset/admin/layui/css/layui.css">-->
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">汽车美容维修后台管理</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->

        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                    <?php echo $_SESSION['username'] ?>
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="">基本资料</a></dd>
                    <dd><a href="http://www.car.com/admin/login/index.html">退出登录</a></dd>
                </dl>
            </li>

        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <li class="layui-nav-item ">
                    <a class="" href="javascript:;">登录管理</a>
                    <dl class="layui-nav-child">
<!--                        <dd><a href="">查看管理员</a></dd>-->
                        <dd><a href="/admin/admin/index.php">添加管理员</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">关于我们</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/about/index.php">添加描述</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">产品管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/types/index.php">产品分类</a></dd>
                        <dd><a href="/admin/goods/index.php">添加产品</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">导航栏</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/nav/index.php">添加导航栏</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">轮播图</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/slider/index.php">添加轮播图</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">新闻资讯管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/news/index.php">添加资讯</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">团队管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/team/index.php">添加团队</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">产品管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/goods/produt.php">添加产品信息</a></dd>
                        <dd><a href="/admin/goods/index.php">查看产品信息</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">在线预约管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/order/index.php">查看预约名单</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
<!--    <script src="../asset/admin/layui/layui.js"></script>-->
<!--    <script>-->
<!--        //JavaScript代码区域-->
<!--        layui.use('element', function(){-->
<!--            var element = layui.element;-->
<!---->
<!--        });-->
<!--    </script>-->
</body>
</html>

