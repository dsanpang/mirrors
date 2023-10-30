<?php
	$siteinfo = array(
		"site_name"	=>	"<i class='fa fa-sitemap' aria-hidden='true'></i>",
		"title"		=>	"三胖云",
		"keywords"	=>	"系统镜像,Centos,Debian,Ubuntu",
		"description"	=>	"三胖闭源镜像站,常用驱动下载"
	);

	//需要忽略的目录
	$ignore	= array(
		".",
		".git",
		"H4k3r",
		".user.ini",
		".well-known",
		".htaccess",
		"favicon.ico",
		"functions",
		"config.php",
		"404.html",
		"index.php",
		"static",
		"LICENSE",
		"template",
		"cache.php",
		"indexes.php",
		"zdir"
	);
	//设置参数
	$config = array(
		//thedir为需要读取的目录，如:/data/wwwroot/soft.xiaoz.org，仅将zdir放在子目录的情况下需要配置此项，其它请勿配置此选项
		"thedir"	=>	'',
		"allowip"	=>	array(
			//"0.0.0.0",			//注意设置为0.0.0.0则不限制IP，更多说明请参考帮助文档：https://doc.xiaoz.me/#/zdir/
			"::1",
			"127.0.0.1",
			"192.168.1."
		),
		"username"	=>	"h4k3r",			//用户名
		"password"	=>	"dsanpang",		//密码
		"auth"		=>	FALSE			//是否开启访问验证
	);	
?>