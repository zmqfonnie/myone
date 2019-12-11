$(function(){
    /* 轮播图 */
    var swiper = new Swiper('.rotation',{
        loop: true,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
    $('#btn').click(function(){
        if(!empty($('.name'),"姓名")){
            return false;
        }
        if(!empty($('.phone'),"手机号")){
            return false;
        }
        if(!$('.phone').phoneFlag()){
            return false;
        }
        mylayer("提交成功！")
        $('.name').val('')
        $('.phone').val('')
    })
    
})