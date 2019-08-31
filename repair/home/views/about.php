<!DOCTYPE html>
<html lang="en">


<link rel="stylesheet" href="/asset/index/css/about.css">
    <?php
        include '../public/header.php';
//        获取数据渲染中间内容
        $about="select * from aboutus ";
        $aboutresult=$mysql->query($about)->fetch_assoc();
//        获取数据渲染团队
        $team="select * from team order by id asc limit 0,4";
        $teamresult=$mysql->query($team)->fetch_all(MYSQLI_ASSOC);
    ?>
    <!-- 中部 -->
    <div class="cn-content">
        <div class="bit-wrap">
            <div class="img clearfix">
                <img src="/asset/index/img/gy1.jpg" alt="">
            </div>
            <div class="about-tt clearfix">
                <span class="line left"></span>
                <div class="about-title">
                    <div class="hd-title">
                        <div class="tp-title">关于我们</div>
                        <div class="hd-subtitle">About Us</div>
                    </div>

                </div>
                <span class="line right"></span>
            </div>
            <div class="text-content">
                <div class="content left-cn">
                    <?php echo $aboutresult['ades']?>
                </div>
                <div class="content right-cn">
                    <img src="<?php echo $aboutresult['aimg']?>" alt="">
                </div>
            </div>
<!--            团队内容渲染-->
            <?php

            ?>
            <div class="about-tt clearfix">
                <span class="line left"></span>
                <div class="about-title">
                    <div class="hd-title">
                        <div class="tp-title">维修师傅</div>
                        <div class="hd-subtitle">Master Team</div>
                    </div>
                </div>
                <span class="line right"></span>
            </div>
            <div class="worker">
                <?php foreach ($teamresult as $v){?>
                <div class="card">
                    <img src="<?php echo $v['head_img']; ?>" alt="">
                    <div class="name"> <strong><?php echo $v['teamname']; ?></strong>
                        <div class="post color"><?php echo $v['positions']; ?></div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- 中部 -->
    <div class="footer clearfix">
        <div class="wf-wrap">
            <div class="clearfix">
                <div class="wrap-content">
                    <p class="color"> <strong>一店地址</strong> </p>
                    <p class="text-two">门店地址：上海市松江区佘山林荫大道18号 </p>
                    <p>预约电话：<a href="" class="color">400-562-6654 </a></p>
                    <p class="text-two"><strong class="bold">营业时间：</strong></p>
                    <p class="sm-font">周一 ~周五：上午9:30-下午8:00</p>
                    <p class="sm-font">周六、周日：上午10:00-下午9:00</p>
                </div>
                <div class="wrap-content">
                    <p class="color"> <strong>二店地址</strong> </p>
                    <p class="text-two">门店地址：上海市松江区佘山林荫大道18号 </p>
                    <p>预约电话：<a href="" class="color">400-562-6654 </a></p>
                    <p class="text-two"><strong class="bold">营业时间：</strong></p>
                    <p class="sm-font">周一 ~周五：上午9:30-下午8:00</p>
                    <p class="sm-font">周六、周日：上午10:00-下午9:00</p>
                </div>
                <div class="wrap-content">
                    <p class="color"> <strong>三店地址</strong> </p>
                    <p class="text-two">门店地址：上海市松江区佘山林荫大道18号 </p>
                    <p>预约电话：<a href="" class="color">400-562-6654 </a></p>
                    <p class="text-two"><strong class="bold">营业时间：</strong></p>
                    <p class="sm-font">周一 ~周五：上午9:30-下午8:00</p>
                    <p class="sm-font">周六、周日：上午10:00-下午9:00</p>
                </div>
            </div>
            <div class="column-inner clearfix">
                <ul>
                    <li>
                        <div class="img img1"></div>
                    </li>
                    <li>
                        <div class="img img2"></div>
                    </li>
                    <li>
                        <div class="img img3"></div>
                    </li>
                    <li>
                        <div class="img img4"></div>
                    </li>
                    <li>
                        <div class="img img5"></div>
                    </li>
                </ul>
                <div class="bt-text">版权所有 2019-2020 汽车美容工作室 技术支持：起飞页</div>
            </div>
        </div>
    </div>
    <!-- 底部 -->
    <div class="return">
        <i class="iconfont icon-iconfonticontrianglecopy"></i>
    </div>
    <script src="/asset/index/js/return.js"></script>
</body>

</html>