$(function(){
    if(sessionStorage.getItem("yueflag")){
        $('.yuedu').hide();
        $('.yuedu').shade();
    }
    $('.yuedu').shade(); 
    //继续阅读
    $('.yuedu').click(function(){
        $(this).hide();
        $('.shade').shade(); 
        $('.shade').show();
        $('.pingu').show();
        $('.shade').shade();
    })
    //关闭
    $('#yue .close').click(function(){
        $('.shade').hide();
        $('.pingu').hide();
        $('.yuedu').show();
        $('.yuedu').shade();
    })
    //验证码
    $('#yue .mycode').click(function(){
        if(!empty($('.yphone'),"手机号")){
            return false;
        }
        if(!$('.yphone').phoneFlag()){
            return false;
        }
        sendCode(this);
    })
    $('#yue-btn').click(function(){


        $('#login-btn').click(function(){
            var yname = $(this).data('yname');
            var yphone = $(this).data('yphone');
            var ycode = $(this).data('ycode');
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



        if( !empty($('.yname'),"您的姓名") ){
            return false;
        }
        if( !empty($('.yphone'),"手机号") ){
            return false;
        }
        if( !$('.yphone').phoneFlag() ){
            return false;
        }
        if( !empty($('.ycode'),"验证码") ){
            return false;
        }


        //提交成功后文章继续阅读
        $('.shade').hide();
        $('.pingu').hide();
        $('.shade').shade();
        mylayer('填写成功,请继续阅读!');
        //进行数据存储
        session("yueflag",true);
        console.log(sessionStorage.getItem("yueflag"));
        
    })
    console.log(sessionStorage.getItem("yueflag"));
})