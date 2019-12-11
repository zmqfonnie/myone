//公共部分
$(function(){
    // 二级导航显示
    $('.nav li').mouseenter(function(){
        //stop() 第一个参数停止后续在队列接着的所有动画 第二个参数是否让当前动画执行到最后
        $(this).find('.nav-two').stop(true, false).slideDown();
    })
    $('.nav li').mouseleave(function(){
        $(this).find('.nav-two').stop(true, false).slideUp();
    })
    //三级导航显示
    $('.nav-two li').mouseenter(function(){
        $(this).find('.nav-three').stop(true, false).fadeIn(500);
    })
    $('.nav-two li').mouseleave(function(){
        $(this).find('.nav-three').stop(true, false).fadeOut(500);
    })
})

/* -----窗口页面效果----- start */
//跑马灯广告效果
$.fn.newRoll=function(){
    let str = $(this).text().trim().replace(/\s+/g, "");
    setInterval( ()=>{
        let start = str.substring(0,1);
        let end = str.substring(1);
        str = end+start;
        $(this).text(str)
    },500)
}
//置顶按钮
$.fn.fixBar=function(num){
    let mythis = this;
    $(document).scroll(function(){
        if( $(document).scrollTop() > num){
            $(mythis).css("visibility","visible");
        }else{
            $(mythis).css("visibility","hidden");
        }
    })
    $(mythis).click(function(){
        $('body,html').animate({scrollTop:0},600);
    })
}
//通过判断遮罩层是否出现控制窗口是否能够滑动
$.fn.shade = function(){
    //基于jquery的显示/隐藏的方法判断的
    if(this.css("display") == "none"){
        $("body").css({overflow:"visible"})
    }else{
        $("body").css({overflow:"hidden"})
    }
}
//多条消息横向无缝滚动
$.fn.wuroll=function(){
    //无缝滚动需要把数据复制一遍
    let oul = $(this);
    let oulhtml = $(this).html();
    oul.html(oulhtml+oulhtml);

    //得到所有的子元素 子元素的宽度和个数
    let ali = $(this).children();
    let aliWidth = ali.eq(0).width();
    let aliSize = ali.size();
    //设置重新组成后的父元素宽度
    let ulWidth = aliWidth*aliSize;
    oul.width(ulWidth);

    //速度 正数从左到右 负数从右到左
    let speed = -2;
    function slider(){
        if(speed<0){
            if(oul.css('left')==-ulWidth/2+'px'){
                oul.css('left',0);
            }
            oul.css('left','+=-2px');
        }
        if(speed>0){
            if(oul.css('left')=='0px'){
                oul.css('left',-ulWidth/2+'px');
            }
            oul.css('left','+='+speed+'px');
        }
    }
    let timeId = setInterval(slider,30);
    $(this).mouseover(function(){
        clearInterval(timeId);
    });
    $(this).mouseout(function(){
        timeId = setInterval(slider,30);
    });
}
/* -----窗口页面效果----- end */

/* -----表单判断----- start */
//控制只能输入数字
function phoneNum(obj){    
    obj.value=obj.value.replace(/[^\d]/g,'');
}
//layer简单的提示框
function mylayer(str){
    layui.use('layer', function(){
        var layer = layui.layer;
        layer.ready(function(){
            layer.msg(str);
        })
    })
    return false;
}
//判断电话号码进行提示并得到对应的布尔值
$.fn.phoneFlag = function(){
    let flag = /^1[34578]\d{9}$/.test($(this).val()); 
    if(empty(this,"手机号码")){
        if(!flag){
            layui.use('layer', function(){
                var layer = layui.layer;
                layer.ready(function(){
                    layer.msg('手机号码错误!');
                });
            })
            return false;
        }
        return true;    
    }
    return false;
}
//判断为空时,发出提示,并返回对应的布尔值
function empty(obj,str){
    let num = obj.val().trim();
    if(!num){
        layui.use('layer', function(){
            var layer = layui.layer;
            layer.ready(function(){
                if(num == ""){
                    layer.msg('请输入'+str+'!');
                }
            })
        })
        return false;
    }
    return true;
}
//验证码再次发送倒计时
function sendCode(obj){
    let btn = obj;
    let time = 60;
    btn.disabled = true;    //将按钮置为不可点击
    btn.value = "重新发送"+time;
    $(btn).css({    //改变样式
        opacity : "0.6",
        cursor : "no-drop"
    })
    let clock = setInterval(function(){
        time--;
        if(time>0){
            btn.value = "重新发送"+time;
        }else{
            clearInterval(clock);
            btn.disabled = false;
            btn.value = '获取验证码';
            time = 60; //重置时间
            $(btn).css({    //变会样式
                opacity : "1",
                cursor : "pointer"
            })
        }
    },1000);
}
/* -----表单判断----- end */

/* -----设置本地缓存----- end */
function storage(flag) {
    if (window.localStorage) {
        if (flag) {
            localStorage.flag = flag;
        } else {
            //清空
            localStorage.clear();
        }
    } else {
        alert("浏览器不支持localStorage!无法存储");
    }
}

/* -----逻辑处理----- start */
//简单的二级选中处理 添加类active
$.fn.navActive = function(){
    let myindex = this.index();
    let mythis = this[0];
    let fael = $(this).parent();
    fael.children().each(function(){
        if( mythis==this ){
            $(this).addClass("active").siblings().removeClass("active");
        }
    })
    return myindex;
}
/* -----逻辑处理----- end */





