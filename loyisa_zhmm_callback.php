<?php
if (!defined('SYSTEM_ROOT')) {
	die('Insufficient Permissions');
}

function callback_init()
{
	// 插件配置
	option::add('loyisa_zhmm_recaptcha_enabled', 1);
	option::add('loyisa_zhmm_recaptcha_theme', 'light');
	option::add('loyisa_zhmm_recaptcha_sitekey', '');
	option::add('loyisa_zhmm_recaptcha_secretkey', '');
}

function callback_remove()
{
	// 禁用插件时移除配置文件
	option::del('loyisa_zhmm_recaptcha_enabled');
	option::del('loyisa_zhmm_recaptcha_theme');
	option::del('loyisa_zhmm_recaptcha_site_key');
	option::del('loyisa_zhmm_recaptcha_secret_key');
}