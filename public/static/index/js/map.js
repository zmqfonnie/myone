$(function(){
    //地图位置
    var init = function () {
        var center = new qq.maps.LatLng(28.672840,115.878960); //中心坐标
        //定义工厂模式函数
        var myOptions = {
            center: center,
            zoom: 13,
            mapTypeId: qq.maps.MapTypeId.ROADMAP //设置地图样式
        }
        //获取dom元素添加地图信息
        var map = new qq.maps.Map(document.getElementById("container"), myOptions);
        //获取城市列表接口设置中心点
        // var citylocation = new qq.maps.CityService({
        //     complete : function(result){
        //         map.setCenter(result.detail.latLng);
        //     }
        // });
        // //调用searchLocalCity();方法    根据用户IP查询城市信息。
        // citylocation.searchLocalCity();
        // var infoWin = new qq.maps.InfoWindow({
        //     map: map
        // });

        var label = new qq.maps.Label({
            position: center,
            map: map,
            content:'江西绿色家园科技园有限公司'
        });
        //open()打开信息窗口
        // infoWin.open();
        // infoWin.setPosition(map);
        // infoWin.setContent('<div><p>江西绿色家园科技园有限公司</p></div>');
    }
    init();
})