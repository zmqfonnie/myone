<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:96:"F:\WorkProgram\laragon\www\myone\public/../application/admin\view\test\bootstraptable\index.html";i:1575015925;s:75:"F:\WorkProgram\laragon\www\myone\application\admin\view\layout\default.html";i:1562338655;s:72:"F:\WorkProgram\laragon\www\myone\application\admin\view\common\meta.html";i:1566781937;s:74:"F:\WorkProgram\laragon\www\myone\application\admin\view\common\script.html";i:1562338655;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !$config['fastadmin']['multiplenav']): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <div class="panel panel-default panel-intro">
    <div class="panel-heading">
        <div class="panel-lead"><em>多表格功能</em>
            <style> .pull-left-container{margin-right:5px;} </style>
            <span class="pull-left-container"><small class="label  bg-red">完整表格</small></span>
            <span class="pull-left-container"><small class="label  bg-black">菜单彩色角标</small></span>
            <span class="pull-left-container"><small class="label  bg-aqua">控制器间跳转</small></span>
            <span class="pull-left-container"><small class="label  bg-blue">多级联动</small></span>
            <span class="pull-left-container"><small class="label  bg-yellow">自定义搜索</small></span>
            <span class="pull-left-container"><small class="label  bg-purple">多表格</small></span>
            <span class="pull-left-container"><small class="label  bg-gray">关联模型</small></span>
            <span class="pull-left-container"><small class="label  bg-primary">百度地图</small></span>
            <span class="pull-left-container"><small class="label  bg-green">表格模板</small></span>
            <span class="pull-left-container"><small class="label  bg-green">（url可跳转 示例：//www.baidu.com）</small></span>

        </div>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#one" data-toggle="tab">表格1</a></li>
            <li><a href="#two" data-toggle="tab">表格2</a></li>
            <li><a href="#three" data-toggle="tab"><i class="fa fa-plus"></i></a></li>
        </ul>
    </div>
    <div class="panel-body">
        <div id="myTabContent" class="tab-content">
            <!--   one tabel1   -->
            <div class="tab-pane fade active in" id="one">
                <div class="widget-body no-padding">
                    <div id="toolbar" class="toolbar">
                        <?php echo build_toolbar('refresh,delete'); ?>
                        <a class="btn btn-info btn-disabled disabled btn-selected" href="javascript:;"><i
                                class="fa fa-leaf"></i> 获取选中项</a>
                        <div class="dropdown btn-group">
                            <a class="btn btn-primary btn-more dropdown-toggle btn-disabled disabled"
                               data-toggle="dropdown"><i class="fa fa-cog"></i> <?= __('More') ?></a>
                            <ul class="dropdown-menu text-left" role="menu">
                                <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;"
                                       data-params="status=normal"><i class="fa fa-eye"></i> <?php echo __('Set to normal'); ?></a>
                                </li>
                                <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;"
                                       data-params="status=hidden"><i class="fa fa-eye-slash"></i> <?php echo __('Set to
                                    hidden'); ?></a></li>
                            </ul>
                        </div>
                        <a class="btn btn-success btn-singlesearch" href="javascript:;"><i class="fa fa-user"></i> 自定义搜索</a>
                        <a class="btn btn-success btn-change btn-start" data-params="action=start"
                           data-url="test/bootstraptable/start" href="javascript:;"><i class="fa fa-play"></i> 启动</a>
                        <a class="btn btn-danger btn-change btn-pause" data-params="action=pause"
                           data-url="test/bootstraptable/pause" href="javascript:;"><i class="fa fa-pause"></i> 暂停</a>
                        <a href="javascript:;" class="btn btn-default" style="font-size:14px;color:dodgerblue;">
                            <i class="fa fa-dollar"></i>
                            <span class="extend">
                                金额：<span id="money">0</span>
                                总条数：<span id="price">0</span>
                            </span>
                        </a>
                        <a class="btn btn-danger addtabsit" title="多级联动" href="test/cityselect"><i
                                class="fa fa-taxi"></i> 多级联动页面</a>
                        <a class="btn btn-primary btn-userinfo" href="javascript:;"><i class="fa fa-user"></i>
                            用户登录</a>
                        <a href="test/bootstraptable/map" class="btn btn-info btn-dialog"  title="地图1"><i
                                class="fa fa-map-signs"></i>
                            地图</a>
                        <a href="<?php echo addon_url('address/index/index'); ?>" class="btn btn-info btn-dialog" title="地图2"><i
                                class="fa fa-map-signs"></i>
                            插件地图</a>
                        <button type="button" class="btn btn-primary" data-toggle="addresspicker"">点击选择地址获取经纬度</button>
                        <a class="btn btn-success btn-toggle-view " title="切换表格视图" href="javascript:;"><i
                                class="fa fa-leaf"></i> 切换表格视图</a>
                    </div>
                    <table id="table" class="table table-striped table-bordered table-hover" width="100%"></table>
                </div>
            </div>
            <!--   two tabel2   -->
            <div class="tab-pane fade" id="two">
                <div id="toolbar2" class="toolbar">
                    <?php echo build_toolbar('refresh'); ?>
                </div>
                <table id="table2" class="table table-striped table-bordered table-hover" width="100%"></table>
            </div>
            <!--   two tabel3   -->
            <div class="tab-pane fade" id="three">
                <div id="toolbar3" class="toolbar">
                    <?php echo build_toolbar('refresh'); ?>
                </div>
                <table id="table3" class="table table-striped table-bordered table-hover" width="100%"></table>
            </div>
        </div>
    </div>
</div>
<script id="selectip" type="text/html">
    <select id="ip" class="form-control selectpicker" multiple name="ip" style="height:31px;">
        <?php if(is_array($ipList) || $ipList instanceof \think\Collection || $ipList instanceof \think\Paginator): if( count($ipList)==0 ) : echo "" ;else: foreach($ipList as $key=>$vo): ?>
        <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',""))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </select>
</script>
<script id="chooseid" type="text/html">
    <div class="input-group">
        <div class="input-group-btn">
            <select class="form-control operate" data-name="id" style="width:auto;">
                <option value="=" selected>等于</option>
                <option value=">">大于</option>
                <option value="<">小于</option>
            </select>
        </div>
        <input class="form-control" type="text" name="id" placeholder="" value=""/>
    </div>
</script>
<script id="categorytpl" type="text/html">
    <div class="row">
        <div class="col-xs-12">
            <div class="form-inline" data-toggle="cxselect" data-selects="group,admin">
                <select class="group form-control" name="group"
                        data-url="test/bootstraptable/cxselect?type=group"></select>
                <select class="admin form-control" name="admin_id" data-url="test/bootstraptable/cxselect?type=admin"
                        data-query-name="group_id"></select>
                <input type="hidden" class="operate" data-name="admin_id" value="="/>
            </div>
        </div>
    </div>
</script>
<!-- 登录 -->
<script id="logintpl" type="text/html">
    <div>
        <form class="form-horizontal">
            <fieldset>
                <div class="alert alert-dismissable alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong><?php echo __('Warning'); ?></strong><br/><?php echo __('Login tips'); ?>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" id="inputAccount" value=""
                                   placeholder="<?php echo __('Your username or email'); ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" id="inputPassword" value=""
                                   placeholder="<?php echo __('Your password'); ?>">
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</script>
<script id="userinfotpl" type="text/html">
    <div>
        <form class="form-horizontal form-userinfo">
            <fieldset>
                <div class="alert alert-dismissable alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong><?php echo __('Warning'); ?></strong><br/><?php echo __('Logined tips', '<%=username%>'); ?>
                </div>
            </fieldset>
            <div class="breadcrumb"><a href="https://www.fastadmin.net/user/myaddon.html" target="_blank"><i
                    class="fa fa-money"></i> <?php echo __('My addons'); ?></a></div>
            <div class="breadcrumb"><a href="https://www.fastadmin.net/user/addon.html" target="_blank"><i
                    class="fa fa-upload"></i> <?php echo __('My posts'); ?></a></div>
        </form>
    </div>
</script>
<script id="customformtpl" type="text/html">
    <!--form表单必须添加form-commsearch这个类-->
    <form action="" class="form-commonsearch">
        <div style="border-radius:2px;margin-bottom:10px;background:#f5f5f5;padding:20px;">
            <h4>自定义搜索表单</h4>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label">ID</label>
                        <!--显式的operate操作符-->
                        <div class="input-group">
                            <div class="input-group-btn">
                                <select class="form-control operate" data-name="id" style="width:auto;">
                                    <option value="=" selected>等于</option>
                                    <option value=">">大于</option>
                                    <option value="<">小于</option>
                                </select>
                            </div>
                            <input class="form-control" type="text" name="id" placeholder="" value=""/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label">标题</label>
                        <!--隐式的operate操作符，必须携带一个class为operate隐藏的文本框,且它的data-name="字段",值为操作符-->
                        <input class="operate" type="hidden" data-name="title" value="="/>
                        <input class="form-control" type="text" name="title" placeholder="请输入查找的标题" value=""/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label">管理员ID</label>
                        <div class="row" data-toggle="cxselect" data-selects="group,admin">
                            <div class="col-xs-6">
                                <select class="group form-control" name="group"
                                        data-url="test/bootstraptable/cxselect?type=group"></select>
                            </div>
                            <div class="col-xs-6">
                                <select class="admin form-control" name="admin_id"
                                        data-url="test/bootstraptable/cxselect?type=admin"
                                        data-query-name="group_id"></select>
                            </div>
                            <input type="hidden" class="operate" data-name="admin_id" value="="/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label">用户名</label>
                        <input type="hidden" class="operate" data-name="username" value="="/>
                        <input id="c-category_id" data-source="auth/admin/index" data-primary-key="username"
                               data-field="username" class="form-control selectpage" name="username" type="text"
                               value="">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-3" style="min-height:68px;">
                    <!--这里添加68px是为了避免刷新时出现元素错位闪屏-->
                    <div class="form-group">
                        <label class="control-label">IP</label>
                        <input type="hidden" class="operate" data-name="ip" value="in"/>
                        <!--给select一个固定的高度-->
                        <select id="c-flag" class="form-control selectpicker" multiple name="ip" style="height:31px;">
                            <?php if(is_array($ipList) || $ipList instanceof \think\Collection || $ipList instanceof \think\Paginator): if( count($ipList)==0 ) : echo "" ;else: foreach($ipList as $key=>$vo): ?>
                            <option value="<?php echo $key; ?>" {in name="key" value="" }selected{
                            /in}><?php echo $vo; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label">IP</label>
                        <input type="hidden" class="operate" data-name="createtime" value="RANGE"/>
                        <input type="text" class="form-control datetimerange" name="createtime" value=""/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label"></label>
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="submit" class="btn btn-success btn-block" value="提交"/>
                            </div>
                            <div class="col-xs-6">
                                <input type="reset" class="btn btn-primary btn-block" value="重置"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</script>

<style type="text/css">
    .test {
        height:100%;position: relative;
    }
    .test > span {
        position:absolute;left:15px;top:15px;
    }
</style>
<script id="itemtpl" type="text/html">
    <!--
    如果启用了templateView,默认调用的是itemtpl这个模板，可以通过设置templateFormatter来修改
    在当前模板中可以使用三个变量(item:行数据,i:当前第几行,data:所有的行数据)
    此模板引擎使用的是art-template的native,可参考官方文档
    -->

    <div class="col-sm-4 col-md-3">
        <!--下面四行是为了展示随机图片和标签，可移除-->
        <% var imagearr = ['https://ws2.sinaimg.cn/large/006tNc79gy1fgphwokqt9j30dw0990tb.jpg', 'https://ws2.sinaimg.cn/large/006tNc79gy1fgphwt8nq8j30e609f3z4.jpg', 'https://ws1.sinaimg.cn/large/006tNc79gy1fgphwn44hvj30go0b5myb.jpg', 'https://ws1.sinaimg.cn/large/006tNc79gy1fgphwnl37mj30dw09agmg.jpg', 'https://ws3.sinaimg.cn/large/006tNc79gy1fgphwqsvh6j30go0b576c.jpg']; %>
        <% var image = imagearr[item.id % 5]; %>
        <% var labelarr = ['primary', 'success', 'info', 'danger', 'warning']; %>
        <% var label = labelarr[item.id % 5]; %>
        <div class="thumbnail test">
            <span class="btn btn-<%=label%>">ID:<%=item.id%></span>
            <a href="<%=item.admin.avatar%>" target="_blank"><img src="<%=item.admin.avatar%>" class="img-responsive" alt="<%=item.title%>"></a>
            <div class="caption">
                <h4><%=item.title?item.title:'无'%></h4>
                <p class="text-muted">操作者IP:<%=item.ip%></p>
                <p class="text-muted">操作时间:<%=Moment(item.createtime*1000).format("YYYY-MM-DD HH:mm:ss")%></p>
                <p>
                    <!--详情的事件需要在JS中手动绑定-->
                    <a href="#" class="btn btn-primary btn-success btn-detail" data-id="<%=item.id%>"><i class="fa fa-camera"></i> 详情</a>

                    <!--如果需要响应编辑或删除事件，可以给元素添加 btn-edit或btn-del的类和data-id这个属性值-->
                    <a href="#" class="btn btn-primary btn-edit"   data-id="<%=item.id%>"><i class="fa fa-pencil"></i> 编辑</a>
                    <a href="#" class="btn btn-danger btn-del" data-id="<%=item.id%>"><i class="fa fa-times"></i> 删除</a>
                    <span class="pull-right" style="margin-top:10px;">
                        <!--如果需要多选操作，请确保有下面的checkbox元素存在,可移除-->
                        <input name="checkbox" data-id="<%=item.id%>" type="checkbox" />
                    </span>
                </p>
            </div>
        </div>
    </div>
</script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>