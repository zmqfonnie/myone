var index = 0;
$('.honor-box').click(function () {
    var obj = $(this).parent(); 
    index = obj.index();
    console.log(index);
    fangda(obj);
})
function prev() {
    var list = $('.myshade-list');
    var left = list.css("left");
    var width = $('.myshade-list img').eq(0).width();
    left = width*(index-1);
    console.log('prec:'+index);
    if (index > 0) {
        list.css('left', parseInt(-left));
        index--;
    }
    console.log('prec:'+index);
}
function next() {
    var list = $('.myshade-list');
    var left = list.css("left");
    var width = $('.myshade-list img').eq(0).width();
    left = width*(index+1);
    console.log('next:'+index);
    console.log('list:'+list.children().length);
    if (index < list.children().length-1) {
        list.css('left', parseInt(-left));
        index++;
    }
    console.log('next:'+index);
}
//点击图片添加相册功能的布局
function fangda(obj) {
    //给页面添加遮罩层
    $('body').append('<div class="myshade"></div>');
    $('body').css({ overflow: "hidden" });
    $('.myshade').css({
        width: "100%",
        height: "100%",
        backgroundColor: "rgba(0,0,0,0.8)",
        zIndex: "999",
        position: "fixed",
        top: "0",
        left: "0",
        display: "none"
    });
    $('.myshade').fadeIn(500);
    var fam = obj.parent();
    var times = 2; //放大倍数
    var myWidth = obj.width() * times;
    var myHeight = obj.height() * times;
    var sum = fam.children().length; //有多少个子元素
    var myindex = obj.index();
    //console.log('index:'+myindex);

    //关闭按钮
    $('.myshade').append('<p class="close">X</p>');
    $('.close').css({
        position: "absolute",
        top: "50px",
        right: "50px",
        fontSize: "50px",
        color: "#fff",
        cursor: "pointer"
    });

    //筛选盒子
    $('.myshade').append('<div class="myshade-center"></div>');
    $('.myshade-center').css({
        position: "absolute",
        top: "50%",
        left: "50%",
        transform: "translate(-50%,-50%)",
        width: myWidth,
        height: myHeight,
        overflow: 'hidden',
    });
    //偏移列表
    $('.myshade-center').append('<div class="myshade-list"></div>');
    $('.myshade-list').css({
        position: "absolute",
        width: myWidth * sum,
        height: myHeight,
        top: "0",
        left: -myWidth * myindex,
        transition: "all 0.6s"
    });
    //左右按钮切换
    $('.myshade').append('<div class="myshade-anniu"><div class="prev" onclick="prev()"><</div><div class="next" onclick="next()">></div></div>');
    $('.myshade-anniu').css({
        position: "absolute",
        width: myWidth + 250,
        lineHeight: "80px",
        top: "50%",
        left: "50%",
        transform: "translate(-50%,-50%)",
        color: "#fff",
        fontSize: "80px"
    });
    $('.prev').css({
        float: "left",
        cursor: "pointer"
    })
    $('.next').css({
        float: "right",
        cursor: "pointer"
    })
    //遍历添加子元素img
    for (var i = 0; i < sum; i++) {
        var str = fam.children().eq(i).find('img').attr('src');
        $('.myshade-list').append('<img src=' + str + '>');
    }
    $('.myshade-list img').css({
        width: myWidth,
        height: myHeight,
        bordr: "1px solid #dfdfdf"
    });
    //点击当前遮罩层 关闭遮罩层
    $('.close').click(function(){
        $('.myshade').remove();
        $('body').css({ overflow:"auto" });
    });
}