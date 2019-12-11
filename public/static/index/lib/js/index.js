$(function(){
    console.log("hah");
    //首页轮播图
    var mySwiper1 = new Swiper('.ibanner', {
        autoplay: {
            disableOnInteraction: false,
        },
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable :true,
        }
    })

    //新闻轮播图
    var mySwiper3 = new Swiper('.newswiper', {
        autoplay: {
            disableOnInteraction: false,
        },
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable :true,
        }
    })

    /* 跑马灯效果 */
    $('.newcoll').newRoll();

    /* 置顶效果 */
    $('.goTop').fixBar(700);

    /* 左侧tab栏 */
    $('.module-menu li').click(function(){
        let mythis = this;
        let fael = $(this).parent();
        fael.children().each(function(){       
            if( mythis==this ){
                $(this).addClass("active").siblings().removeClass("active");
            }
        })     
    })

    /* 出国移民 异步请求 */
    $('#immigration li').click(function(){
        //获取点击的下标
        var cate_id = $(this).data('cate_id');
        var pid = $(this).data('pid');
        $.ajax({
            url:"./index.php?m=home&c=index&a=index",
            data:{cate_id:cate_id,pid:pid},
            type:"POST",
            dataType: "json",
            success:function(data) {//返回数据根据结果进行相应的处理
                // console.log(data);
                // console.log(data.new);
                // console.log(data.new.length);
                // console.log(data.new[0].title)
                var mytxtf="",mytxtl="";
                mytxtf+='<img src=data/attachment/article/'+data.list.img+'>';
                mytxtf+='<div>'+
                            '<span>'+data.list.title+'</span>'+
                            '<p class="hides">'+data.list.intro+'</p>'
                        +'</div>';
                $('.immigration .intr-top').html(mytxtf);
                for(var i=0;i<data.new.length;i++){
                    mytxtl+='<a class="verFlex item" href='+data.new[i].url+'>'+
                        '<p class="hide">'+data.new[i].title+'</p>'+
                        '<span>'+data.new[i].add_time+'</span>'
                        +'</a>';
                }
                $('.immigration .module-new').html(mytxtl);
            }
        })
    })

    /* 出国留学 异步请求 */
    $('#study li').click(function(){
        //获取点击的下标
        var address_id = $(this).data('cate_id');
        var pid = $(this).data('pid');
        $.ajax({
            url:"./index.php?m=home&c=index&a=index",
            data:{address_id:address_id,pid:pid},
            type:"POST",
            dataType: "json",
            success:function(data) {//返回数据根据结果进行相应的处理
                console.log(data);
                var mytxtf="",mytxtl="";
                mytxtf+='<img src=data/attachment/article/'+data.list.img+'>';
                mytxtf+='<div>'+
                        '<span>'+data.list.title+'</span>'+
                        '<p class="hides">'+data.list.intro+'</p>'
                        +'</div>';
                $('.study .intr-top').html(mytxtf);
                for(var i=0;i<data.new.length;i++){
                    mytxtl+='<a class="verFlex item" href='+data.new[i].url+'>'+
                        '<p class="hide">'+data.new[i].title+'</p>'+
                        '<span>'+data.new[i].add_time+'</span>'
                        +'</a>';
                }
                $('.study .module-new').html(mytxtl);
                var moda = $('.module-btn a').length;
                console.log(moda);
                for(var i=0;i<moda;i++){
                    $('.module-btn a').eq(i).attr('href',data.url[i])
                }

            }
        })
    })

    /* 出国签证 异步请求 */
    $('#visa li').click(function(){
        var address_id = $(this).data('cate_id');
        var pid = $(this).data('pid');
        $.ajax({
            url:"./index.php?m=home&c=index&a=index",
            data:{address_id:address_id,pid:pid},
            type:"POST",
            dataType: "json",
            success:function(data) {//返回数据根据结果进行相应的处理
                var mytxtf="",mytxtl="";
                mytxtf+='<img src=data/attachment/article/'+data.list.img+'>';
                mytxtf+='<div>'+
                        '<span>'+data.list.title+'</span>'+
                        '<p class="hides">'+data.list.intro+'</p>'
                        +'</div>';
                $('.visa .intr-top').html(mytxtf);
                for(var i=0;i<data.new.length;i++){
                    mytxtl+='<a class="verFlex item" href='+data.new[i].url+'>'+
                        '<p class="hide">'+data.new[i].title+'</p>'+
                        '<span>'+data.new[i].add_time+'</span>'
                        +'</a>';
                }
                $('.visa .module-new').html(mytxtl);
            }
        })
    })

    /* 出国游学 异步请求 */
    $('#research li').click(function(){
        var cate_id = $(this).data('cate_id');
        var pid = $(this).data('pid');
        $.ajax({
            url:"./index.php?m=home&c=index&a=index",
            data:{cate_id:cate_id,pid:pid},
            type:"POST",
            dataType: "json",
            success:function(data) {//返回数据根据结果进行相应的处理
                // console.log(data);
                var mytxtf="",mytxtl="";
                mytxtf+='<img src=data/attachment/article/'+data.list.img+'>';
                mytxtf+='<div>'+
                    '<span>'+data.list.title+'</span>'+
                    '<p class="hides">'+data.list.intro+'</p>'
                    +'</div>';
                $('.research .intr-top').html(mytxtf);
                for(var i=0;i<data.new.length;i++){
                    mytxtl+='<a class="verFlex item" href='+data.new[i].url+'>'+
                        '<p class="hide">'+data.new[i].title+'</p>'+
                        '<span>'+data.new[i].add_time+'</span>'
                        +'</a>';
                }
                $('.research .module-new').html(mytxtl);
            }
        })
    })

    /* 企业宣传 */
    var mySwiper2 = new Swiper('.scenery', {
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        loop: true,
        slidesPerView : 4,
        spaceBetween : 28,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
            hideOnClick: true,
        }
    })
    $('.iptxt span').click(function(){
        let myip= $(this).navActive();
        console.log(myip);
        if(myip==0){
            $('#scenery').css('left',0);
        }
        if(myip==2){
            $('#scenery').css('left',-1200);
        }
    })

    /* 实用信息|友情链接 */
    $('.mytabs li').click(function(){
        let myindex = $(this).index();
        let mythis = this;
        let fael = $(this).parent();
        fael.find('li').each(function(){       
            if( mythis==this ){
                $(this).addClass("active").siblings().removeClass("active");
            }
        })
        console.log(myindex);
        if(myindex==0){
            $('.mytxt').css('left',0);
        }
        if(myindex==2){
            $('.mytxt').css('left',-1200);
        }
        
    })

    // 免费预约
    $('#loBtn').click(function(){
        $('.shade').show();
        $('.login').show();
        $('.shade').shade();
    })
    $('.switch li').click(function(){
        let myindex = $(this).index();
        let mythis = this;
        let fael = $(this).parent();
        fael.children().each(function(){       
            if( mythis==this ){
                $(this).addClass("active").siblings().removeClass("active");
            }
        }) 
        $('.login-con li').eq(myindex).addClass("active").siblings().removeClass("active");
    })
    /* 留学表单判断 */
    $('#liustudy').click(function(){
        if(!empty($('.lone .name'),"姓名")){
            return false;
        }
        if(!empty($('.lone .phone'),"手机号")){
            return false;
        }
        if(!$('.lone .phone').phoneFlag()){
            return false;
        }
        if(!empty($('.lone .code'),"验证码")){
            return false;
        }
        $.ajax({
            url:"",
            data: {},
            type: "POST",
            dataType: "json",
            success: function (data) {
                //判断是否请求成功的状态你自己写一下
            }
        })
        // 成功之后退出
        $('.shade').hide();
        $('.login').hide();
        $('.shade').shade();
        storage(true);
    })
    /* 留学表单发送验证码倒计时 */
    $('.lone .mycode').click(function(){
        if(!empty($('.lone .phone'),"手机号")){
            return false;
        }
        if(!$('.lone .phone').phoneFlag()){
            return false;
        }
        sendCode(this);
    })
    /* 移民表单判断 */
    $('#migrant').click(function(){
        if(!empty($('.ltwo .name'),"姓名")){
            return false;
        }
        if(!empty($('.ltwo .phone'),"手机号")){
            return false;
        }
        if(!$('.ltwo .phone').phoneFlag()){
            return false;
        }
        if(!empty($('.ltwo .code'),"验证码")){
            return false;
        }
        $.ajax({
            url:"",
            data: {},
            type: "POST",
            dataType: "json",
            success: function (data) {
                //判断是否请求成功的状态你自己写一下
            }
        })
        // 成功之后退出
        $('.shade').hide();
        $('.login').hide();
        $('.shade').shade();
        storage(true);
    })
    /* 移民表单发送验证码倒计时 */
    $('.ltwo .mycode').click(function(){
        if(!empty($('.ltwo .phone'),"手机号")){
            return false;
        }
        if(!$('.ltwo .phone').phoneFlag()){
            return false;
        }
        sendCode(this);
    })

    //退出预约
    $('.close').click(function(){
        $('.shade').hide();
        $('.login').hide();
        $('.shade').shade();
        // $('.pingu').hide();
        // $('.yuedu').show();
        // $('.yuedu').shade();
    })
    
    
})

