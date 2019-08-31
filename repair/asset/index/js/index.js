window.onload = function () {
    // 轮播图
    // 获取元素
    let bigBanner = document.querySelector(".bitBanner")
    let bigBox = document.querySelectorAll(".img-bn");
    let bigBull = document.querySelectorAll(".bullet");
    let bigBtn = document.querySelectorAll(".tparrows");
    // 利用双下标实现轮播
    let index = 0;
    let next = 0;
    let flag = true;
    // 默认显示第一张图片
    bigBox[0].style.left = 0;
    // 默认显示第一个轮播点颜色
    bigBull[0].classList.add("selected");
    let time = setInterval(move, 3000)
    // 右箭头点击事件
    bigBtn[1].onclick = () => {
        if (!flag) {
            return
        }
        flag = false;
        move()
        // flag = true;
    }
    // 左箭头点击事件
    bigBtn[0].onclick = () => {
        if (!flag) {
            return
        }
        flag = false;
        moves()
    }
    // 当移入轮播图是停止播放
    bigBanner.onmouseover = () => {
        clearInterval(time)
    }
    // 当移出轮播图时开始播放
    bigBanner.onmouseout = () => {
        time = setInterval(move, 3000)
    }
    // 点击轮播点切换轮播图,首先遍历轮播点
    bigBull.forEach((v, i) => {
        v.onclick = () => {
            if (i > index) {
                if (!flag) {
                    return
                }
                move()
            }
            if (i < index) {
                if (!flag) {
                    return;
                }
                moves()
            }
        }
    })
    // 封装函数(轮播图向左移动)
    function move() {
        // 下一张图片的下标
        next++
        // 判断当下标大于图片的长图时
        if (next > bigBox.length - 1) {
            next = 0
        }
        // 第一张图片的位置为0
        bigBox[index].style.left = 0;
        // 下一张图片的位置为1349
        bigBox[next].style.left = 1349 + "px";
        // 利用animate动画让图片有动画效果
        animate(bigBox[index], {
            // 让第一张图片的下标移动到右边
            left: -1349
        }, () => {
            flag = true;
            // 遍历轮播点默认清除类名
            bigBull.forEach((v) => {
                v.classList.remove("selected")
            })
            bigBull[index].classList.add("selected");
        })
        animate(bigBox[next], {
            // 让第二周图片的下标移动到0
            left: 0
        })
        // 进行完一轮循环将next的值赋给index继续下一轮
        index = next
    }
    // 封装函数（轮播图向右移动）
    function moves() {
        // 第二张图的下标
        next--
        // 判断当他小于0时
        if (next < 0) {
            next = bigBox.length - 1
        }
        bigBox[index].style.left = 0;
        bigBox[next].style.left = -1349 + "px";
        animate(bigBox[index], {
            left: 1349
        });
        animate(bigBox[next], {
            left: 0
        }, () => {
            bigBull.forEach((v) => {
                flag = true;
                v.classList.remove("selected")
            })
            bigBull[index].classList.add("selected")
        })
        index = next
    }
    // 轮播图
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
        }, 10)
    }
    // 滚动浏览器时停止时间函数
    window.onwheel = () => {
        clearInterval(times);
    }
    // 2、置顶下滑
    let pull = document.querySelector(".header-pull");
    // 3、按需加载
    let enter = document.querySelectorAll(".enter1");
    let enter2 = document.querySelectorAll(".enter2");
    // 设置滚动浏览器显示隐藏置顶箭头
    let row=document.querySelectorAll(".card1");
    let row2=document.querySelectorAll(".card2");
    let row3=document.querySelectorAll(".card3");
    let row4=document.querySelectorAll(".card4");
    let scrollH //定义一个变量来保存滚动超出文本
    window.onscroll = () => {
        scrollH = window.scrollY;
        // 判断当到滚动到哪里显示
        if (scrollH > 1500) {
            jump.style.display = "block";
        }
        if (scrollH < 500) {
            jump.style.display = "none";
        }
        // 判断如果滚动超过90就显示顶部
        if (scrollH > 90) {
            pull.style.cssText = "transition: 0.8s linear;top:0;opacity:1"
        }
        // 判断如果小于等于0就隐藏顶部
        if (scrollH <= 0) {
            pull.style.cssText = "transition:0;top:-90px;"
        }
        row.forEach((v)=>{
            if(scrollH>=500){
                setTimeout(function(){
                    v.style.cssText="transition:all 1s ease ;transform:translateX(0);"
                },300)
            }
        })
        row2.forEach((v)=>{
            if(scrollH>=500){
                setTimeout(function(){
                    v.style.cssText="transition:all 1s ease ;transform:translateX(0);"
                },400)
            }
        })
        row3.forEach((v)=>{
            if(scrollH>=500) {
                setTimeout(function () {
                    v.style.cssText = "transition:all 1s ease ;transform:translateX(0);"
                }, 500)
            }
        })
        row4.forEach((v)=>{
            if(scrollH>=500) {
                setTimeout(function () {
                    v.style.cssText = "transition:all 1s ease ;transform:translateX(0);"
                }, 600)
            }
        })
        // 3、页面重载
        enter.forEach((v) => {
            if (scrollH >=850) {
                v.style.cssText = "transition:all 1s ease;width:304px;height:203px;opacity:1;"
            }
        })
        enter2.forEach((v) => {
            if (scrollH >=1150) {
                v.style.cssText = "transition:all 1s ease;width:304px;height:203px;opacity:1;"
            }
        })
    }
}