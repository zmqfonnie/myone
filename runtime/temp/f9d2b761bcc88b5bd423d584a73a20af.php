<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:82:"F:\WorkProgram\laragon\www\myone\public/../application/index\view\index\index.html";i:1579225898;s:75:"F:\WorkProgram\laragon\www\myone\application\index\view\layout\default.html";i:1579225849;s:72:"F:\WorkProgram\laragon\www\myone\application\index\view\common\meta.html";i:1579338673;s:74:"F:\WorkProgram\laragon\www\myone\application\index\view\common\header.html";i:1579339657;s:74:"F:\WorkProgram\laragon\www\myone\application\index\view\common\footer.html";i:1579340038;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
<title><?php echo (isset($config['title']) && ($config['title'] !== '')?$config['title']:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">
<meta name="keywords" content="<?php echo $config['keywords']; ?>">
<meta name="description" content="<?php echo $config['description']; ?>">
<meta name="author" content="fonnie">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css?v=<?php echo $config['version']; ?>">
<link href="/assets/css/fonnie.css?v=<?php echo $config['version']; ?>" rel="stylesheet">
<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js?v=<?php echo $config['version']; ?>"></script>
<script type="text/javascript">
    var config = <?php echo json_encode($config); ?>;
</script>
<script src="/assets/css/fonnie.js?v=<?php echo $config['version']; ?>"></script>

</head>
<body>
<div class="fonnie-page">
<div class="fonnie-header">
    <div class="div-center">
        <ul class="fonnie-menu">
            <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li><a href="<?php echo $vo['url']; ?>"><i class="<?php echo $vo['class']; ?>"></i> <?php echo $vo['name']; ?></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>
<main class="content">
    <!--<div class="fonnie-header-image">-->
<!--    <div class="image-overlay"></div>-->
<!--    <div class="header-image image-cover text-center">-->
<!--        <div class="image-text">-->
<!--            <h2>test</h2>-->
<!--            <br/>-->
<!--            <span>dasfadf asdfdas'fsad sadf;a </span>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->



<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p><p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p><p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
<p>123</p>
</main>
<footer class="footer text-center">
        <div class="gotop-box footer-tool">
            <span class="fa fa-chevron-up"></span>
        </div>
        <div class="search-box footer-tool">
            <span class="fa fa-search"></span>
            <form class="search-form" role="search" method="get" id="searchform" action="https://www.drblack-system.com/">
                <input type="text" name="s" id="search" placeholder="Search..." style="display: none;">
            </form>
        </div>

    <div class="footer-content div-center">
        <p>已在风雨中度过 <span id="site_time"></span></p>
        <p>Copyright&nbsp;©&nbsp;<?php echo date('Y'); ?> Powered by <a href="//114.55.147.127" target="_blank">Fonnie</a> All Rights Reserved</p>
        <p><a href="http://www.beian.miit.gov.cn/" target="_blank"><?php echo $config['beian']; ?></a></p>
    </div>
</footer>
</div>
</body>
</html>