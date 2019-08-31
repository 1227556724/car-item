window.onload = function () {
    // 返回顶部
    // 获取元素
    let jump = document.querySelector(".return")
    let times //用来保存时间函数
    let scrollT //用来保存滚动过的距离
    let speed //用来保存运动的步进值
    jump.onclick = () => {
        clearInterval(times);
        times = setInterval(() => {
            scrollT = document.documentElement.scrollTop; //用来保存滚动过的距离
            speed = (0 - scrollT) / 10; //用来保存运动的步进值
            speed = speed > 0 ? Math.ceil(speed) : Math.floor(speed)
            scrollT += speed; //移动的距离
            scrollTo(0, scrollT); //让页面滚动到scrollT
            if (0 == scrollT) {
                clearInterval(times);
            }
        }, 20)
    }
    // 滚动浏览器时停止时间函数
    window.onwheel = () => {
        clearInterval(times);
    }
    // 设置滚动浏览器显示隐藏置顶箭头
    let scrollH //定义一个变量来保存滚动超出文本
    // 获取头部下滑元素
    let pull = document.querySelector(".header-pull");
    window.onscroll = () => {
        scrollH = window.scrollY;
        // 1、置顶
        // 判断当到滚动到哪里显示
        if (scrollH > 600) {
            jump.style.display = "block";
        }
        if (scrollH < 500) {
            jump.style.display = "none";
        }
        // 2、 头部下滑菜单
        // 判断如果滚动超过90就显示顶部
        if (scrollH > 90) {
            pull.style.cssText = "transition: 0.8s linear;top:0;opacity:1"
        } else {
            pull.style.cssText = "transition:0;top:-90px;"
        }
        // 判断如果小于等于0就隐藏顶部
    }
}