<?php
if (!defined('SYSTEM_ROOT')) {
	die('Insufficient Permissions');
}
/*
Plugin Name: 找回密码
Version: 1.1
Description: 用户可以使用此插件找回密码,原作者D丶L,由Loyisa添加验证码功能
Author: Loyisa
Author Email: loyisa@vip.qq.com
Author URL: https://loyisa.cn
For: V3.8+
*/
function loyisa_zhmm_navi()
{
	echo '<li ';
	if (isset($_GET['pub_plugin']) && $_GET['pub_plugin'] == 'dl_zhmm') {
		echo 'class="active"';
	}
	echo '><a href="index.php?pub_plugin=dl_zhmm"><span class="glyphicon glyphicon-search"></span> 找回密码</a></li>';
}

addAction('navi_10', 'loyisa_zhmm_navi');
addAction('navi_11', 'loyisa_zhmm_navi');
