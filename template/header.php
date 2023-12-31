<!DOCTYPE html>
<html lang="zh-cmn-Hans" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<title><?php echo $siteinfo['title']; ?></title>
	<meta name="generator" content="EverEdit" />
	<meta name="author" content="dsanpang.com" />
	<meta name="keywords" content="<?php echo $siteinfo['keywords']; ?>" />
	<meta name="description" content="<?php echo $siteinfo['description']; ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="favicon.ico"  type="image/x-icon" />
	<link rel="stylesheet" href="./static/layui/css/layui.css">
	<link rel='stylesheet' href='./static/style.css?v=<?php echo $version; ?>'>
	<link rel="stylesheet" href="./static/font-awesome/css/font-awesome.min.css">

</head>
<body>
	<!--顶部导航栏-->
	<div class = "header">
        <div class = "layui-container">
            <div class = "layui-row">
                <div class = "layui-col-lg12">
	                <div class="logo">
		                <img src="./static/logo.png" style="width:30px;height:30px;">
	                </div>
                    <div class = "layui-hide-xs">
                        <ul class="layui-nav menu" lay-filter="">
                            <li class="layui-nav-item"><a href="./"><i class="fa fa-home" aria-hidden="true"></i> 镜像首页</a></li>
                            <li class="layui-nav-item"><a href="./?c=netmask"><i class="fa fa-exchange" aria-hidden="true"></i> 子网掩码</a></li>
                            <li class="layui-nav-item"><a href="./?c=cache"><i class="fa fa-file-text" aria-hidden="true"></i> 文件索引</a></li>
                            <li class="layui-nav-item"><a href="./?c=admin" target = "_blank"><i class="layui-icon">&#xe665;</i> 文件管理</a></li>
                        </ul>
                    </div>
                    <div class = "layui-hide-xs layui-hide-sm layui-show-md-block" style = "width:260px;float:right;margin-top:10px;">
                    	<form class="layui-form" action="./" method = "get">
	                    	<input type="text" name="c" required lay-verify="required" autocomplete="off" class="layui-input" value = "search" style = "display: none;">
	                    	<input style = "width:70%;float:left;border-right:0;border-radius:0;" type="text" name="s" required lay-verify="required" placeholder="请输入关键词" autocomplete="off" class="layui-input">
	                    	<input style = "width:30%;float:left;border-left:0;border-radius:0;" type="submit" value = "搜索" class="layui-btn">
                    	</form>
                    </div>
                    <div class = "layui-hide-lg layui-hide-md" style = "width:100%;float:right;margin-top:10px;margin-bottom:10px;">
                    	<form class="layui-form" action="./" method = "get">
	                    	<input type="text" name="c" required lay-verify="required" autocomplete="off" class="layui-input" value = "search" style = "display: none;">
	                    	<input style = "width:70%;float:left;border-right:0;border-radius:0;" type="text" name="s" required lay-verify="required" placeholder="请输入关键词" autocomplete="off" class="layui-input">
	                    	<input style = "width:30%;float:left;border-left:0;border-radius:0;" type="submit" value = "搜索" class="layui-btn">
                    	</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 顶部导航栏END -->