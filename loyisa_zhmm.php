<?php
/*
Plugin Name: 找回密码
Version: 1.1
Description: 用户可以使用此插件找回密码,原作者D丶L,由Loyisa添加验证码功能
Author: Loyisa
Author Email: loyisa@vip.qq.com
Author URL: https://loyisa.cn
For: V3.8+
*/

if (!defined('SYSTEM_ROOT')) {
	die('Insufficient Permissions');
}

function loyisa_zhmm_navi()
{
	echo '<li ';
	if (isset($_GET['pub_plugin']) && $_GET['pub_plugin'] == 'loyisa_zhmm') {
		echo 'class="active"';
	}
	echo '><a href="index.php?pub_plugin=loyisa_zhmm"><span class="glyphicon glyphicon-search"></span> 找回密码</a></li>';
}

//显示验证码
function loyisa_zhmm_recaptcha_show()
{
    // 检测是否开启验证码
    if (option::get('loyisa_zhmm_recaptcha_enabled') == 0) {
        return;
    }
    echo '<script src="https://www.recaptcha.net/recaptcha/api.js" async defer></script>
  <div class="g-recaptcha" data-sitekey="' . option::get('loyisa_zhmm_recaptcha_sitekey') . '" data-theme="' . option::get('loyisa_zhmm_recaptcha_theme') . '"></div>';
}

// 检查验证码
function loyisa_zhmm_recaptcha_check()
{
    // 检测是否开启验证码
    if (option::get('loyisa_zhmm_recaptcha_enabled') == 0) {
        return;
    }
    if (!empty($_POST['g-recaptcha-response'])) {
        // 获取验证码
        $response = loyisa_zhmm_get_recaptcha(option::get('loyisa_zhmm_recaptcha_secretkey'), $_POST['g-recaptcha-response'], $_SERVER["REMOTE_ADDR"]);
        // 检测验证码 并根据错误代码输出语句
        if (!$response->success) {
            switch ($response->errorcodes) {
                case '{[0] => "missing-input-secret"}':
                case '{[0] => "invalid-input-secret"}':
                    msg('验证码配置错误!');
                    break;
                case '{[0] => "timeout-or-duplicate"}':
                    msg('验证码已超时!请重新验证');
                    break;
                default:
                    msg('验证码验证失败!请重新验证');
            }
        }
    } else {
        msg('验证码验证失败!请重新验证');
    }
}

/**
 * 获取验证码json
 * @param string $secret
 * @param string $response
 * @param string $remoteip
 * @return object ReCaptchaResponse
 */
function loyisa_zhmm_get_recaptcha($secret, $response, $remoteip)
{
    // 和recaptcha服务器二次校验
    $getjsonurl = file_get_contents('https://www.recaptcha.net/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $response . '&remoteip=' . $remoteip);
    // 解析获取到的json
    $response = json_decode($getjsonurl);
    return $response;
}

addAction('navi_10', 'loyisa_zhmm_navi');
addAction('navi_11', 'loyisa_zhmm_navi');
