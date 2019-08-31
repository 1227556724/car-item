<?php
include '../public/header.php';

?>
<link rel="stylesheet" href="/asset/index/css/index.css">
<!-- 头部 -->
<!-- 轮播图 -->
<?php $bannersql="select * from slider order by id desc limit 0,3";
        $newbanner=$mysql->query($bannersql)->fetch_all(MYSQLI_ASSOC);
?>
<div class="bitBanner">
    <div class="bitImg">
        <?php foreach ($newbanner as $v){ ?>
        <div class="img-bn img-bn1">
            <img src="<?php echo $v['img']?>" alt="">
        </div>
        <?php }?>
    </div>
    <div class="tp-bullets">
<!--        <div class="bullet bullet2"></div>-->
        <?php for ($i=0;$i<count($newbanner);$i++){ ?>
            <div class="bullet bullet2"></div>
        <?php }?>

    </div>
    <div class="tparrows left"></div>
    <div class="tparrows right"></div>
</div>
<!-- 轮播图 -->
<!-- 内容块 -->
<div class="bit-content">
    <div class="wf-wrap">
        <div class="bg-text">
            <div class="tp-text">我们的努力，只是为了您的满意</div>
            <div class="bt-text">我们为您提供集汽车内外装饰、汽车影音改装、汽车精品销售、汽车美容养护于一体的大型“一站式汽车服务”</div>
        </div>
        <div class="container">
            <div class="row">
                <div class="row-card card1">
                    <div class="row-img">
                        <img src="/asset/index/img/icon1.png" alt="">
                    </div>
                    <div class="row-text">汽车保养 专家系统</div>
                    <div class="qfe-wrapper">
                        <img src="/asset/index/img/xian.png" alt="">
                    </div>
                    <div class="content-tx">応损捠捡换换，攴朰朲朳枛朸桸桹桺奿妀。夲夳夵壱売壳圢圤圥圦圧，圩圪囡団囤囥咍咎壱売壳圢圤圥圦応损捠捡换换。</div>
                </div>
                <div class="row-card card2">
                    <div class="row-img">
                        <img src="/asset/index/img/icon2.png" alt="">
                    </div>
                    <div class="row-text">原厂品质 正品配件统</div>
                    <div class="qfe-wrapper">
                        <img src="/asset/index/img/xian.png" alt="">
                    </div>
                    <div class="content-tx content-txo">応损捠捡换换，攴朰朲朳枛朸桸桹桺奿妀。夲夳夵壱売壳圢圤圥圦圧，圩圪囡団囤囥咍咎壱売壳圢圤圥圦応损捠捡换换。</div>
                </div>
                <div class="row-card card3">
                    <div class="row-img">
                        <img src="/asset/index/img/icon3.png" alt="">
                    </div>
                    <div class="row-text">全里程保养保障</div>
                    <div class="qfe-wrapper">
                        <img src="/asset/index/img/xian.png" alt="">
                    </div>
                    <div class="content-tx content-txo">応损捠捡换换，攴朰朲朳枛朸桸桹桺奿妀。夲夳夵壱売壳圢圤圥圦圧，圩圪囡団囤囥咍咎壱売壳圢圤圥圦応损捠捡换换。</div>
                </div>
                <div class="row-card card4">
                    <div class="row-img">
                        <img src="/asset/index/img/icon4.png" alt="">
                    </div>
                    <div class="row-text">4S店一半的价格</div>
                    <div class="qfe-wrapper">
                        <img src="/asset/index/img/xian.png" alt="">
                    </div>
                    <div class="content-tx content-txo">応损捠捡换换，攴朰朲朳枛朸桸桹桺奿妀。夲夳夵壱売壳圢圤圥圦圧，圩圪囡団囤囥咍咎壱売壳圢圤圥圦応损捠捡换换。</div>
                </div>
            </div>
        </div>
        <div class="bg-text pd-text">
            <div class="tp-text bt-font">引领时代，驾驭未来</div>
            <div class="img-car">
                <img src="/asset/index/img/xian2.png" alt="">
            </div>
        </div>
        <div class="bg-text pd-text bg-company clearfix">
            <div class="left-img img-one"><img src="/asset/index/img/jj1.jpg" alt="" class="enter enter1"></div>
            <div class="left-img right">
                <div class="column">
                    <div class="tp-card">
                        <a href="" class="lf-font">公司简介</a>
                        <a href="about.html" class="rg-font">MORE +</a>
                    </div>
                    <div class="bt-card">
                        <div class="text-cn">汽车有限公司成立于XXX年XX月XX日，是本地区唯一的授权销售服务中心和特约售后服务中心。主要从事多种品牌的整车销售、
                            售后服务、配件供应及信息反馈业务。</div>
                        <div class="text-cn text-cn2">公司秉承 “尊荣无限
                            至上体验”的服务理念，培养更主动贴心的服务意识,追求更周到便捷的服务水准，让每一位车主，都体验到管家般的细致专业，享受到待为贵宾般的尊崇体验公司秉承 “尊荣无限
                            至上体验”的服务理念，培养更主动贴心的服务意识,追求更周到便捷的服务水准，让每一位车主，都体验到管家般的细致专业，享受到待为贵宾般的尊崇体验……</div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $news="select * from news order by id desc";
        ?>
        <div class="bg-text pd-text bg-company clearfix">
            <div class="left-img right">
                <div class="column column-lf">
                    <div class="tp-card">
                        <a href="" class="lf-font">美容知识</a>
                        <a href="news.html" class="rg-font">MORE +</a>
                    </div>
                    <div class="bt-card">
                        <ul>
                            <li><a href="know-how.html">修车五大禁忌忌开锅时贸然开引擎盖</a><span>2015-01-20</span></li>
                            <li><a href="know-how.html">你的爱车清理到位了吗 可别忘记排水孔</a><span>2015-01-20</span></li>
                            <li><a href="know-how.html">配置升级 2015款凯迪拉克XTS到店实拍</a><span>2015-01-20</span></li>
                            <li><a href="know-how.html">奥迪推出Q2/Q4受阻 菲亚特抢注名称</a><span>2015-01-20</span></li>
                            <li><a href="know-how.html">新能源汽车补贴酝酿新思路</a><span>2015-01-20</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="left-img"><img src="/asset/index/img/jj2.jpg" alt="" class="enter enter2"></div>
        </div>
    </div>
</div>
<!-- 内容块结束 -->
<!-- 底部 -->
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
<script src="/asset/index/js/animate.js"></script>
<script src="/asset/index/js/index.js"></script>

</body>

</html>