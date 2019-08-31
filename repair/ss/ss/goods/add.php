<?php
include "../common.php";
?>
<style>
    .layui-form{
        width:70%;
        margin:auto;
    }
</style>

<div class="layui-body">
    <div style="padding: 15px;">

        <form action="" class="layui-form" id="addGoods" lay-filter="addtest1">
            <div class="layui-form-item">
                <label class="layui-form-label" for="name">产品名称</label>
                <div class="layui-input-block inputs">
                    <input type="text" name="name" required  lay-verify="required" placeholder="请输入产品名称" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">产品分类</label>
                <div class="layui-input-block">
                    <input type="radio" name="typeid" value="0" title="刹车油/制动液" checked>
                    <input type="radio" name="typeid" value="1" title="机油润滑油">
                    <input type="radio" name="typeid" value="2" title="防冻冷却液">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="img1">图片1</label>
                <div class="layui-input-block inputs">
                    <input type="text" name="img1" required  lay-verify="required" placeholder="请输入图片1地址" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="img2">图片2</label>
                <div class="layui-input-block inputs">
                    <input type="text" name="img2" required  lay-verify="required" placeholder="请输入图片2地址" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="market_price">市场价格</label>
                <div class="layui-input-block inputs">
                    <input type="text" name="market_price" required  lay-verify="required" placeholder="请输入市场价格" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="price">零售价格</label>
                <div class="layui-input-block inputs">
                    <input type="text" name="price" required  lay-verify="required" placeholder="请输入零售价格" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="stock">库存</label>
                <div class="layui-input-block inputs">
                    <input type="text" name="stock" required  lay-verify="required" placeholder="请输入库存" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label" for="content">内容</label>
                <div class="layui-input-block">
                    <textarea name="content" placeholder="请输入详细内容" required class="layui-textarea"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button type="submit" class="layui-btn" lay-submit lay-filter="addDemo">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>

    </div>
</div>

<?php
include "../footer.php";
?>

<script>

    var layer,form;
    layui.use(['element','jquery','form','layer'],function() {
        var element = layui.element;
        var $ = layui.jquery;
        layer = layui.layer;
        form = layui.form;

        $(".goodsAdd").parent().addClass("layui-this");
        $(".goodsAdd").parents("li").addClass("layui-nav-itemed");

        form.on('submit(addDemo)', function (data) {
            // console.log(data.field);
            $.get("action.php?type=add", data.field, function (res) {
                let datas = JSON.parse(res);
                if (datas.code === 200) {
                    layer.msg(datas.msg, {icon: 1, time: 500});

                } else {
                    layer.msg(datas.msg, {icon: 2, time: 1000});
                }
            });
            return false;
        });
    })

</script>