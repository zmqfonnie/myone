<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"F:\WorkProgram\laragon\www\myone\public/../application/error/404.html";i:1579489359;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" href="/static/404/css/main.css" type="text/css" media="screen, projection" /> <!-- main stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="/static/404/css/tipsy.css" /> <!-- Tipsy implementation -->

<!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="/static/404/css/ie8.css"/>
    <![endif]-->

<script type="text/javascript" src="/static/404/scripts/jquery-1.7.2.min.js"></script> <!-- uiToTop implementation -->
<script type="text/javascript" src="/static/404/scripts/custom-scripts.js"></script>
<script type="text/javascript" src="/static/404/scripts/jquery.tipsy.js"></script> <!-- Tipsy -->

<script type="text/javascript">

$(document).ready(function(){
			
	universalPreloader();
						   
});

$(window).load(function(){

	//remove Universal Preloader
	universalPreloaderRemove();
	
	rotate();
    dogRun();
	dogTalk();
	
	//Tipsy implementation
	$('.with-tooltip').tipsy({gravity: $.fn.tipsy.autoNS});
						   
});

</script>


<title>找不到页面了</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body>

<!-- Universal preloader -->
<div id="universal-preloader">
    <div class="preloader">
        <img src="/static/404/images/universal-preloader.gif" alt="universal-preloader" class="universal-preloader-preloader" />
    </div>
</div>
<!-- Universal preloader -->

<div id="wrapper">
<!-- 404 graphic -->
	<div class="graphic"></div>
<!-- 404 graphic -->
<!-- Not found text -->
	<div class="not-found-text">
    	<h1 class="not-found-text" style="display: inline-block;">页面错误!</h1>
    	<a class="not-found-text" style="text-decoration: none;margin-left: 20px;color: #00CC00;" href="/">返回主页</a>
    </div>
<!-- Not found text -->

<!-- search form -->
<div class="search">
	<form name="search" method="get" action="https://www.baidu.com/s" />
        <input type="text" name="wd" value="Search ..." />
        <input class="with-tooltip" title="Search!" type="submit" name="submit" value="" />
    </form>
</div>
<!-- search form -->

<!-- top menu -->
<!-- top menu -->

<div class="dog-wrapper">
<!-- dog running -->
	<div class="dog"></div>
<!-- dog running -->
	
<!-- dog bubble talking -->
	<div class="dog-bubble">
    	
    </div>
    
    <!-- The dog bubble rotates these -->
    <div class="bubble-options">
    	<p class="dog-bubble">
			<br />
        	跑 啊 跑 ！
        </p>
    	<p class="dog-bubble">
	        <br />
        	哈 ！ 哈 ！
        </p>
        <p class="dog-bubble">
        	<br />
        	快 乐 的 地 球 转 呀 转 ！
        </p>
        <p class="dog-bubble">
        	好 无 聊 啊 ！<br /><img style="margin-top:8px" src="/static/404/images/cookie.png" alt="cookie" />
        </p>
        <p class="dog-bubble">
        	<br />
        	前 面 有 朵 云 ！  
        </p>
        <p class="dog-bubble">
        	<br />
            我 跨 过 山 和 大 海 ！
        </p>
        <p class="dog-bubble">
        	我 是 一 只 <br /><img style="margin-top:8px" src="/static/404/images/cat.png" alt="cat" />
        </p>
        <p class="dog-bubble">
			<br />
        	喵 喵 喵 喵 ！ @_@
        </p>
    </div>
    <!-- The dog bubble rotates these -->
<!-- dog bubble talking -->
</div>

<!-- planet at the bottom -->
	<div class="planet"></div>
<!-- planet at the bottom -->
</div>

<!--
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
-->
</body>
</html>