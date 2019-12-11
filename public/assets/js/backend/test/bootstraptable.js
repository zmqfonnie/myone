define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {


    var Controller = {
        index: function () {
            //Layer.alert('接收到回传数据：' + JSON.stringify(data), {title: "回传数据"}); 弹窗
            //Toastr.info("执行了自定义搜索操作");                                         提示
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'test/bootstraptable/index',
                    add_url: '',
                    edit_url: 'test/bootstraptable/edit',
                    del_url: 'test/bootstraptable/del',
                    multi_url: '',
                    dragsort_url: '',
                }
            });

            //绑定事件
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var panel = $($(this).attr("href"));
                if (panel.size() > 0) {
                    Controller.table[panel.attr("id")].call(this);
                    $(this).on('click', function (e) {
                        $($(this).attr("href")).find(".btn-refresh").trigger("click");
                    });
                }
                //移除绑定的事件
                $(this).unbind('shown.bs.tab');
            });

            //必须默认触发shown.bs.tab事件
            $('ul.nav-tabs li.active a[data-toggle="tab"]').trigger("shown.bs.tab");
        },
        table: {
            one: function () {
                var table = $("#table");

                //在普通搜索提交搜索前 1
                table.on('common-search.bs.table', function (event, table, query) {
                    //这里可以获取到普通搜索表单中字段的查询条件
                    // console.log(query);
                });

                //在普通搜索渲染后  2
                table.on('post-common-search.bs.table', function (event, table) {
                    var form = $("form", table.$commonsearch);
                    $("input[name='title']", form).addClass("selectpage").data("source", "auth/adminlog/selectpage").data("primaryKey", "title").data("field", "title").data("orderBy", "id desc");
                    $("input[name='username']", form).addClass("selectpage").data("source", "auth/admin/index").data("primaryKey", "username").data("field", "username").data("orderBy", "id desc");
                    Form.events.cxselect(form);
                    Form.events.selectpage(form);
                });

                //在表格内容渲染完成后回调事件 1
                table.on('post-body.bs.table', function (e, settings, json, xhr) {
                    // console.log(settings);
                });

                //当表格数据加载完成时 2
                table.on('load-success.bs.table', function (e, data) {
                    //console.log(data.rows[0]);
                    $("#money").text(data.extend.money);
                    $("#price").text(data.extend.price);
                });

                //这个对象 变为助手函数 然后index.html模板里面就可以使用这个对象的方法了
                Template.helper("Moment", Moment);

                // 初始化表格
                table.bootstrapTable({
                    url: $.fn.bootstrapTable.defaults.extend.index_url,
                    //searchFormTemplate:'zidingyisearch',  //自定义搜索
                    toolbar: '#toolbar',
                    columns: [
                        [
                            //如果state有值则选中复选框
                            {field: 'state', checkbox: true},
                            {
                                field: 'id', title: __('ID'), sortable: true, searchList: function (column) {
                                    return Template('chooseid', {});
                                }
                            },
                            //{field: 'admin_id', title: __('管理员ID'), operate: false}, //fonnie
                            {field: 'username', title: __('用户名'), formatter: Table.api.formatter.search},
                            {field: 'admin.nickname', title: __('昵称'), operate: false},
                            {field: 'title', title: __('标题'), operate: 'LIKE %...%', placeholder: '模糊搜索，*表示任意字符'},
                            {
                                field: 'url',
                                title: __('Url'),
                                align: 'left',
                                searchList: $.getJSON('test/bootstraptable/searchlist'),
                                events: Controller.api.events.url,
                                formatter: Controller.api.formatter.url
                            },
                            {
                                field: 'ip',
                                title: __('IP'),
                                searchList: function (column) {
                                    return Template('selectip', {});
                                },
                                events: Controller.api.events.ip,
                                formatter: Controller.api.formatter.ip
                            },
                            {
                                field: 'custom',
                                title: __('自定义切换'),
                                operate: false,
                                formatter: Controller.api.formatter.custom
                            },
                            //browser是一个不存在的字段
                            //通过formatter来渲染数据,同时为它添加上事件
                            {
                                field: 'browser',
                                title: __('浏览器'),
                                operate: false,
                                events: Controller.api.events.browser,
                                formatter: Controller.api.formatter.browser
                            },
                            {
                                field: 'admin_id',
                                title: __('联动搜索'),
                                visible:false,
                                searchList: function (column) {
                                    //在index.html 页面有#categorytpl
                                    return Template('categorytpl', {});
                                }
                            },
                            {
                                field: 'createtime',
                                title: __('Update time'),
                                sortable: true,
                                formatter: Table.api.formatter.datetime,
                                operate: 'RANGE',
                                addclass: 'datetimerange',
                                data:"autocomplete='off'"
                            },
                            {
                                field: 'operate',
                                title: __('Operate'),
                                table: table,
                                events: Table.api.events.operate,
                                formatter: Table.api.formatter.operate,
                                buttons: [
                                    {
                                        name: 'detail',
                                        title: __('弹出窗口打开'),
                                        // btn-dialog弹窗
                                        classname: 'btn btn-xs btn-primary btn-dialog',
                                        icon: 'fa fa-list',
                                        url: 'test/bootstraptable/detail',
                                        callback: function (data) {
                                            Layer.alert('接收到回传数据：' + JSON.stringify(data), {title: "回传数据"});
                                        }
                                    },
                                    {
                                        name: 'ajax',
                                        title: __('发送Ajax'),
                                        classname: 'btn btn-xs btn-success btn-magic btn-ajax',
                                        icon: 'fa fa-magic',
                                        url: 'test/bootstraptable/detail',
                                        success: function (data, ret) {
                                            Layer.alert(ret.msg + "<br>" + JSON.stringify(data));
                                            //关闭提示
                                            //return false;
                                        },
                                        error: function (data, ret) {
                                            Layer.alert(ret.msg + "<br>" + JSON.stringify(data));
                                            return false;
                                        }
                                    },
                                    {
                                        name: 'addtabs',
                                        title: __('新选项卡中打开'),
                                        classname: 'btn btn-xs btn-warning btn-addtabs',
                                        icon: 'fa fa-folder-o',
                                        url: 'test/bootstraptable/detail',
                                    }
                                ]
                            }

                        ]
                    ],
                    //表格视图
                    templateView: true,
                    //视图模板 默认itemtpl
                    //templateFormatter:'itemtpl',
                    //禁用默认搜索框
                    search: false,
                    //启用普通表单搜索
                    commonSearch: true,
                    //不隐藏搜索表单
                    searchFormVisible: true,
                    //pagesize 12
                    pageSize: 12,
                    queryParams: function (params) {

                        //这里可以获取搜索条件
                        var filter = JSON.parse(params.filter);
                        var op = JSON.parse(params.op);
                        console.log(filter);
                        console.log(op);
                        //追加
                        //这里可以动态赋值，比如从URL中获取admin_id的值，filter.admin_id=Fast.api.query('admin_id');
                        // filter.admin_id = 1;
                        // op.admin_id = "=";

                        params.filter = JSON.stringify(filter);
                        params.op = JSON.stringify(op);
                        return params;
                    },
                    onLoadSuccess: function (data) {
                        // 在表格第次加载成功后,刷新左侧菜单栏彩色小角标,支持一次渲染多个
                        // 如果需要在进入后台即显示左侧的彩色小角标,请使用服务端渲染方式,详情修改application/admin/controller/Index.php
                        Backend.api.sidebar({
                            // 'test/bootstraptable': data.total,
                            'test/bootstraptable': [data.total, 'blue', 'label']
                        });
                        //Toastr.info("左侧角标已经刷新成功");
                    },
                });

                // 为表格绑定事件
                Table.api.bindevent(table);

                //指定搜索条件  切换模板视图
                $(document).on("click", ".btn-toggle-view", function () {
                    var options = table.bootstrapTable('getOptions');
                    console.log(options);
                    table.bootstrapTable('refreshOptions', {templateView: !options.templateView});
                });
                //点击详情  模板视图
                $(document).on("click", ".btn-detail[data-id]", function () {
                    Backend.api.open('test/bootstraptable/detail/ids/' + $(this).data('id'), __('Detail'));
                });

                // 自定义搜索 条件一直在除非刷新页面 当前执行的是自定义搜索,搜索URL中包含login的数据
                $(document).on("click", ".btn-singlesearch", function () {
                    var options = table.bootstrapTable('getOptions');
                    var queryParams = options.queryParams;
                    options.pageNumber = 1;
                    options.queryParams = function (params) {
                        //这一行必须要存在,否则在点击下一页时会丢失搜索栏数据
                        params = queryParams(params);

                        //如果希望追加搜索条件,可使用
                        var filter = params.filter ? JSON.parse(params.filter) : {};
                        var op = params.op ? JSON.parse(params.op) : {};
                        filter.url = 'login';
                        op.url = 'like';
                        params.filter = JSON.stringify(filter);
                        params.op = JSON.stringify(op);
                        //如果希望忽略搜索栏搜索条件,可使用
                        //params.filter = JSON.stringify({url: 'login'});
                        //params.op = JSON.stringify({url: 'like'});

                        return params;
                    };
                    table.bootstrapTable('refresh', {});
                    Toastr.info("当前执行的是自定义搜索,搜索URL中包含login的数据");
                    return false;
                });

                // 监听下拉列表改变的事件
                $(document).on('change', 'select[name=admin_id]', function () {
                    $("input[name='admin_id']").val($(this).val());
                });

                // 获取选中项
                $(document).on("click", ".btn-selected", function () {
                    //选中的
                    //table.bootstrapTable('getSelections')
                    if (table.bootstrapTable('getSelections').length != 0) {
                        Layer.alert(JSON.stringify(table.bootstrapTable('getSelections')));
                    } else {
                        //在templateView的模式下不能调用table.bootstrapTable('getSelections')来获取选中的ID,只能通过下面的Table.api.selectedids来获取
                        Layer.alert(JSON.stringify(Table.api.selectedids(table)));
                    }

                });


                // 启动和暂停按钮
                $(document).on("click", ".btn-start,.btn-pause", function () {
                    //在table外不可以使用添加.btn-change的方法
                    //只能自己调用Table.api.multi实现
                    //如果操作全部则ids可以置为空
                    var ids = Table.api.selectedids(table);
                    Table.api.multi("changestatus", ids.join(","), table, this);
                    //Table.api.multi("test/bootstraptable/start", ids.join(","), table, this); //fonnie
                    // Layer.confirm(
                    //     __('确定吗？'),
                    //     {icon: 3, title: __('Warning'), offset: 0, shadeClose: true},
                    //     function (index) {
                    //         Fast.api.ajax({
                    //             url: 'test/bootstraptable/start',
                    //             data: {ids: ids.join(",")}
                    //         }, function (data, ret) {
                    //             Toastr.success('启动成功');
                    //             return false;
                    //         }, function (data, ret) {
                    //             Toastr.success('启动失败');
                    //             return false;
                    //         })
                    //     });
                });

                //控制器跳转
                $(document).on("click", ".btn-go", function () {
                    var ids = Table.api.selectedids(table);

                });

                // 会员信息
                $(document).on("click", ".btn-userinfo", function () {
                    var that = this;
                    var userinfo = Controller.api.userinfo.get();
                    if (!userinfo) {
                        Layer.open({
                            content: Template("logintpl", {}),
                            zIndex: 99,
                            area: ['430px', '350px'],
                            title: __('Login FastAdmin'),
                            resize: false,
                            btn: [__('Login'), __('Register')],
                            yes: function (index, layero) {
                                Fast.api.ajax({
                                    url: Config.fastadmin.api_url + '/user/login',
                                    dataType: 'jsonp',
                                    data: {
                                        account: $("#inputAccount", layero).val(),
                                        password: $("#inputPassword", layero).val(),
                                        _method: 'POST'
                                    }
                                }, function (data, ret) {
                                    Controller.api.userinfo.set(data);
                                    Layer.closeAll();
                                    Layer.alert(ret.msg);
                                }, function (data, ret) {
                                });
                            },
                            btn2: function () {
                                return false;
                            },
                            success: function (layero, index) {
                                $(".layui-layer-btn1", layero).prop("href", "http://www.fastadmin.net/user/register.html").prop("target", "_blank");
                            }
                        });
                    } else {
                        Fast.api.ajax({
                            url: Config.fastadmin.api_url + '/user/index',
                            dataType: 'jsonp',
                            data: {
                                user_id: userinfo.id,
                                token: userinfo.token,
                            }
                        }, function (data) {
                            Layer.open({
                                content: Template("userinfotpl", userinfo),
                                area: ['430px', '360px'],
                                title: __('Userinfo'),
                                resize: false,
                                btn: [__('Logout'), __('Cancel')],
                                yes: function () {
                                    Fast.api.ajax({
                                        url: Config.fastadmin.api_url + '/user/logout',
                                        dataType: 'jsonp',
                                        data: {uid: userinfo.id, token: userinfo.token}
                                    }, function (data, ret) {
                                        Controller.api.userinfo.set(null);
                                        Layer.closeAll();
                                        Layer.alert(ret.msg);
                                    }, function (data, ret) {
                                        Controller.api.userinfo.set(null);
                                        Layer.closeAll();
                                        Layer.alert(ret.msg);
                                    });
                                }
                            });
                            return false;
                        }, function (data) {
                            Controller.api.userinfo.set(null);
                            $(that).trigger('click');
                            return false;
                        });

                    }
                });


            },
            two: function () {
                var table = $("#table2");
                table.bootstrapTable({
                    url: $.fn.bootstrapTable.defaults.extend.index_url,
                    toolbar: '#toolbar2',
                    sortName: 'id',
                    search: false,
                    columns: [
                        [
                            {field: 'id', title: 'ID'},
                            {field: 'title', title: __('Title')},
                            {field: 'url', title: __('Url'), formatter: Table.api.formatter.url},
                            {field: 'ip', title: __('ip')},
                            {
                                field: 'createtime',
                                title: __('Createtime'),
                                formatter: Table.api.formatter.datetime,
                                operate: 'RANGE',
                                addclass: 'datetimerange',
                                sortable: true
                            },
                        ]
                    ]
                });

                // 为表格2绑定事件
                Table.api.bindevent(table);

            },
            three: function () {

                var table = $("#table3");
                //这个对象 变为助手函数 然后index.html模板里面就可以使用这个对象的方法了
                Template.helper("Moment", Moment);


                table.bootstrapTable({
                    url: $.fn.bootstrapTable.defaults.extend.index_url,
                    toolbar: '#toolbar3',
                    search: false,
                    showExport: false, //导出表格
                    showToggle: false,
                    showColumns: false,
                    commonSearch: false,
                    searchFormTemplate: false,
                    templateView: true,
                    pageSize: 12,
                });

                // 为表格绑定事件
                Table.api.bindevent(table);

            },
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        detail: function () {
            $(document).on('click', '.btn-callback', function (data) {
                //关闭窗口并回传数据
                Fast.api.close($("input[name=callback]").val());
                console.log(data);
            });
        },
        map: function () {
            Form.api.bindevent($("form[role=form]"));

            require(['async!BMap'], function () {

                // 更多文档可参考 http://lbsyun.baidu.com/jsdemo.htm
                // 百度地图API功能
                var map = new BMap.Map("allmap");
                var point = new BMap.Point(116.404, 39.915);
                map.centerAndZoom(point, 13); //设置中心坐标点和级别
                var marker = new BMap.Marker(point);  // 创建标注
                map.addOverlay(marker);               // 将标注添加到地图中
                marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画

                map.enableDragging();   //开启拖拽
                //map.enableInertialDragging();   //开启惯性拖拽
                map.enableScrollWheelZoom(true); //是否允许缩放
                //map.centerAndZoom("上海",15); //根据城市名设定地图中心点

                //获取当前浏览器坐标详情
                var geolocation = new BMap.Geolocation();
                geolocation.getCurrentPosition(function (r) {
                    if (this.getStatus() == BMAP_STATUS_SUCCESS) {
                        var mk = new BMap.Marker(r.point);
                        map.addOverlay(mk);
                        map.panTo(r.point);
                        //Layer.alert('您的位置：' + r.point.lng + ',' + r.point.lat);
                    } else {
                        Layer.alert('failed' + this.getStatus());
                    }
                }, {enableHighAccuracy: true});

                // 点搜索按钮时解析地址坐标
                $(document).on('click', '.btn-search', function () {
                    // 创建地址解析器实例
                    var myGeo = new BMap.Geocoder();
                    // 将地址解析结果显示在地图上,并调整地图视野
                    myGeo.getPoint($("#searchaddress").val(), function (point) {
                        if (point) {
                            map.centerAndZoom(point, 16);
                            map.addOverlay(new BMap.Marker(point));
                        } else {
                            Layer.alert("您选择地址没有解析到结果!");
                        }
                    });
                });

            });
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            },
            userinfo: {  //登录
                get: function () {
                    var userinfo = localStorage.getItem("fastadmin_userinfo");
                    return userinfo ? JSON.parse(userinfo) : null;
                },
                set: function (data) {
                    if (data) {
                        localStorage.setItem("fastadmin_userinfo", JSON.stringify(data));
                    } else {
                        localStorage.removeItem("fastadmin_userinfo");
                    }
                }
            },
            formatter: {
                url: function (value, row, index) {
                    return '<div class="input-group input-group-sm" style="width:250px;"><input type="text" class="form-control input-sm " value="' + value + '"><span class="input-group-btn input-group-sm"><a href="' + value + '" target="_blank" class="btn btn-default btn-sm btn-url"><i class="fa fa-link"></i></a></span></div>';
                },
                ip: function (value, row, index) {

                    //搜索
                    return '<a class="btn btn-xs btn-ip bg-success"><i class="fa fa-map-marker"></i> ' + value + '</a>';

                    //这里手动构造URL   控制器之间跳转
                    url = "test/cityselect?" + this.field + "=" + value;

                    //方式一,直接返回class带有addtabsit的链接,这可以方便自定义显示内容
                    //return '<a href="' + url + '" class="label label-success addtabsit" title="' + __("Search %s", value) + '">' + __('Search %s', value) + '</a>';

                    //方式二,直接调用Table.api.formatter.addtabs
                    // return Table.api.formatter.addtabs(value, row, index, url);
                },
                browser: function (value, row, index) {
                    //这里我们直接使用row的数据
                    return '<a class="btn btn-xs btn-browser">' + row.useragent.split(" ")[0] + '</a>';
                },
                custom: function (value, row, index) {
                    //添加上btn-change可以自定义请求的URL进行数据处理   没标题的关闭
                    return '<a class="btn-change text-success" data-url="test/bootstraptable/change" data-id="' + row.id + '"><i class="fa ' + (row.title == '' ? 'fa-toggle-off' : 'fa-toggle-on') + ' fa-2x"></i></a>';
                },
            },
            events: {//绑定事件的方法
                url: {
                    'click .btn-url': function (e, value, row, index) {
                        e.stopPropagation();
                        this.setAttribute('href', this.parentElement.parentElement.firstElementChild.value);
                    }
                },
                ip: {
                    //格式为：方法名+空格+DOM元素
                    'click .btn-ip': function (e, value, row, index) {
                        e.stopPropagation(); //停止点击复选
                        var container = $("#table").data("bootstrap.table").$container;
                        var options = $("#table").bootstrapTable('getOptions');
                        //这里我们手动将数据填充到表单然后提交
                        $("form.form-commonsearch [name='ip']", container).val(value);
                        $("form.form-commonsearch", container).trigger('submit');
                        Toastr.info("执行了搜索IP操作");
                    }
                },
                browser: {
                    'click .btn-browser': function (e, value, row, index) {
                        e.stopPropagation(); //停止点击复选
                        Layer.alert("该行数据为: <code>" + JSON.stringify(row) + "</code>");
                    }
                },
            }
        }
    };
    return Controller;
});