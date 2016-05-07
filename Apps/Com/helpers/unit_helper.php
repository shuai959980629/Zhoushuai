<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 * @package		Libraries
 * @author		Glen.luo
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

/**
 * 为图片添加水印.
 *
 * @access	public
 * @param	string 图片存放路径
 * @return	string
 */
if ( ! function_exists('create_wm_image'))
{
    function create_wm_image($file_path, $wm_pos = array('bottom', 'right'))
    {
        if (file_exists($file_path) === FALSE) {
            return FALSE;
        }

        $wm_font_path = realpath(BASEPATH . '../frameworks/fonts/zhs.ttf');
        if (file_exists($wm_font_path) === FALSE) {
            log_message('error', "not found font file: {$wm_font_path}");
            return FALSE;
        }

        $CI = & get_instance();

        $config['image_library'] = 'GD2';
        $config['source_image'] = $file_path;
        $config['wm_text'] = 'Copyright 2014 - xxx';
        $config['wm_type'] = 'text';
        $config['quality'] = 100;
        $config['dynamic_output'] = FALSE;
        $config['wm_font_path'] = $wm_font_path;
        $config['wm_font_size'] = '16';
        /*$config['wm_font_color'] = '018077';*/
        $config['wm_font_color'] = 'b2b2b2';
        $config['wm_vrt_alignment'] = $wm_pos[0];
        $config['wm_hor_alignment'] = $wm_pos[1];
        $config['wm_hor_offset'] = 10;
        $config['wm_vrt_offset'] = 2;
        /*$config['wm_padding'] = '6';*/

        /*$config['image_library'] = 'gd2';
        $config['source_image'] = $file_path;
        $config['dynamic_output'] = FALSE;
        $config['quality'] = 100;
        $config['wm_type'] = 'overlay';
        $config['wm_padding'] = '0';
        $config['wm_vrt_alignment'] = $wm_pos[0];
        $config['wm_hor_alignment'] = $wm_pos[1];
        $config['wm_hor_offset'] = 6;
        $config['wm_vrt_offset'] = 6;
        $config['wm_overlay_path'] = $wm_overlay_path;
        $config['wm_opacity'] = 90;
        $config['wm_x_transp'] = '4';
        $config['wm_y_transp'] = '4';*/
        $CI->load->library('image_lib');
        $CI->image_lib->initialize($config);
        $result = $CI->image_lib->watermark();
        if (!$result) {
            log_message('error', strip_tags($CI->image_lib->display_errors()));
        }
        $CI->image_lib->clear();
    }
}

/**
 * 标题截取.
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('get_short_title'))
{
    function get_short_title($title, $len = 10, $suffix = '...')
    {
        $title = preg_replace('/\s|&nbsp;+/m', '', $title);

        if (mb_strlen($title, 'utf-8') > $len) {
            return mb_substr($title, 0 , $len, 'utf-8') . $suffix;
        }

        return $title;
    }
}

/**
 * 加载组件片断.
 *
 * @access	public
 * @param	string 组件名称
 * @param	array  组件所需数据
 * @return	string
 */
if ( ! function_exists('load_widget'))
{
    function load_widget($template, $data = array())
    {
        if (empty($template)) {
            return '';
        }

        $CI = & get_instance();
        return $CI->load->view($template, $data, TRUE);
    }
}

/**
 * 得到用于展示的时间.
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('get_show_time'))
{
    function get_show_time($time, $format = 'date')
    {
		$result = '';
		$current_time = time();
		$sub_time = $current_time - $time;
		if(60 > $sub_time)
		{
			$result = '刚刚';
		}
		if(60 <= $sub_time && 3600 >= $sub_time)
		{
			$result = floor($sub_time/60);
			$result = $result.' 分钟前';
		}
		if(3600 <= $sub_time && 86400 >= $sub_time)
		{
			$result = floor($sub_time/3600);
			$result = $result.' 小时前';
		}
		if(86400 < $sub_time)
        {
            if ($format == 'date') {
			    $result = date('m月d日', $time);
            }
            else {
			    $result = floor($sub_time/86400).'天前';
            }
		}
		return $result;
    }
}

/**
 * 用户密码加密算法
 * @access	public
 * @return	<string>
 * @author wangchuan
 */
if (!function_exists('md5_passwd')) {
    function md5_passwd($salt, $password)
    {
        return md5(md5($password).$salt);
    }
}
/**
 * 获取客户端请求地IP
 * @access	public
 * @return	<string>
 * @author wangchuan
 */
if (!function_exists('get_client_ip')) {
    function get_client_ip()
    {
        if (getenv('HTTP_CLIENT_IP') and strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $onlineip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR') and strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),
        'unknown')) {
            $onlineip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('REMOTE_ADDR') and strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $onlineip = getenv('REMOTE_ADDR');
        } elseif (isset($_SERVER['REMOTE_ADDR']) and $_SERVER['REMOTE_ADDR'] and
        strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $onlineip = $_SERVER['REMOTE_ADDR'];
        }
        preg_match("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/", $onlineip, $match);
        return $onlineip = $match[0] ? $match[0] : 'unknown';
    }
}

/**
 * @根据IP地址获取所在城市
 * @access	public
 * @return
 * @author zhoushuai
 */
if (!function_exists('GetIpLookup')) {
    function GetIpLookup($ip = ''){
        if(empty($ip)){
            $ip = get_client_ip();
        }
        $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
        if(empty($res)){ return false; }
        $jsonMatches = array();
        preg_match('#\{.+?\}#', $res, $jsonMatches);
        if(!isset($jsonMatches[0])){ return false; }
        $json = json_decode($jsonMatches[0], true);
        if(isset($json['ret']) && $json['ret'] == 1){
            $json['ip'] = $ip;
            unset($json['ret']);
        }else{
            return false;
        }
        return $json;
    }
}



/**
 * 检查身份证号码是否合法
 * @access	public
 * @return	<string>
 * @author wangchuan
 */
if (!function_exists('isIdCard')) {
	function isIdCard($vStr){
    $vCity = array(
        '11','12','13','14','15','21','22',
        '23','31','32','33','34','35','36',
        '37','41','42','43','44','45','46',
        '50','51','52','53','54','61','62',
        '63','64','65','71','81','82','91'
    );

    if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr)) return false;

    if (!in_array(substr($vStr, 0, 2), $vCity)) return false;

    $vStr = preg_replace('/[xX]$/i', 'a', $vStr);
    $vLength = strlen($vStr);

    if ($vLength == 18)
    {
        $vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
    } else {
        $vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
    }

    if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) return false;

    /*if ($vLength == 18)
    {
        $vSum = 0;

        for ($i = 17 ; $i >= 0 ; $i--)
        {
            $vSubStr = substr($vStr, 17 - $i, 1);
            $vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr , 11));
        }

        if($vSum % 11 != 1) return false;
    }*/

    $checkBit = array(1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2);

    if ($vLength == 18)
    {
        $vSum = 0;

        for ($i = 17 ; $i > 0 ; $i--)
        {
            $vSubStr = substr($vStr, 17 - $i, 1);
            $vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr));
        }

        if(!isset($checkBit[$vSum % 11])) return false;
    }

    return true;
	}
}





/**
 * 数字格式
 * @param 	string	$number		//数字
 * @param 	integer $strlen		//小数位长度
 * @param 	boolean	$round		//是否进行四舍五入
 * @param 	boolean	$format		//格式化[科学计数法，默认不开启]
 * @access	public
 * @author  LEE
 * @return	integer | float
 */
if ( ! function_exists('numberFormat'))
{
    function numberFormat($number, $strlen = 0, $round = false, $format = false)
	{
		if ($number === null) {
			$number = 0;
		}

		if (!is_numeric($number)) {
			return $number;
		}

		if (!strpos($number, '.')) {
			if ($strlen > 0 && !$round) {
				$decimal = str_pad("0", $strlen, "0");
				$number  = $number . '.' . $decimal;
			}

			$format && $number = number_format($number);

			return (string) $number;
		}

		$num  = $decimal = '';

		$nums = explode('.', $number);
		$lens = $strlen ? $strlen : strlen($nums[1]);

		$decimal = substr($nums[1], 0, $lens);

		if (!$round && strlen($decimal) < $strlen) {
			$decimal = (string) str_pad($decimal, $strlen, "0");
			$num 	 = $nums[0] . '.' . $decimal;
		} else {
			$num 	 = $nums[0] . '.' . $decimal;
			$round && $num = round((float) $num, $strlen);
//			!$strlen && !$round && $num = $nums[0];
			!$strlen && $num = (float) $num;

			$format && $num = number_format($num, $strlen);
		}

		return (string) $num;
	}
}


/**
 * 取得memcache数据
 * @author zhoushuai
 * @param string $key
 * @return \array:
 */
if (!function_exists('getMmemData'))
{
    function getMmemData($key){
        $CI = & get_instance();
        $CI->load->driver('cache');
        $return = array();
        if($CI->cache->memcached->is_supported() === true){
            $key = md5($key);
            $cache = $CI->cache->memcached->get($key);
            return $cache;
        }
        return $return;
    }
}

/**
 * 保存memcache数据
 * @author zhoushuai
 * @param string $key
 * @return boolean
 */
if (!function_exists('setMmemData'))
{
    function setMmemData($key, $data, $replace = false,$ttl = 60){
        $CI = & get_instance();
        $CI->load->driver('cache');
        if ($CI->cache->memcached->is_supported() === true) {
            $key = md5($key);
            if (!$replace) {
                $CI->cache->memcached->save($key, $data, $ttl);
            } else {
                $CI->cache->memcached->replace($key, $data, $ttl);
            }
            return true;
        }
        return false;
    }
}


/**
 * 删除memcache数据
 * @author zhoushuai
 * @param string $key
 * @return boolean
 */
if (!function_exists('delMmemData'))
{
    function delMmemData($key){
        $CI = & get_instance();
        $CI->load->driver('cache');
        if ($CI->cache->memcached->is_supported() === true) {
            $key = md5($key);
            $CI->cache->memcached->delete($key);
            return true;
        }
        return false;
    }
}


/**
 * 清空memcache数据
 * @author zhoushuai
 * @param string $key
 * @return boolean
 */
if (!function_exists('cleanMmemData'))
{
    function cleanMmemData(){
        $CI = & get_instance();
        $CI->load->driver('cache');
        if ($CI->cache->memcached->is_supported() === true) {
            $CI->cache->memcached->clean();
        }
        return false;
    }
}
/**
 * 加载指定角色的用户权限.
 *
 * @access	public
 * @param	array
 * @return	string
 */
if ( ! function_exists('load_priv_by_role'))
{
    function load_priv_by_role($role)
    {
        $CI = & get_instance();

        $priv = array();

        $purview = $CI->config->item('purview');
        if ($purview === FALSE) {
            log_message('error', 'config/priv.php权限配置文件取不到值');
            return NULL;
        }

        $role_cfg = $CI->config->item('role');

        if ($role_cfg === FALSE || array_key_exists($role, $role_cfg) === FALSE) {
            log_message('error', "不存在的用户角色:{$role}，请检查config/role.php角色配置文件");
            return NULL;
        }

        if (count($role_cfg[$role]['modules']) == 1 && $role_cfg[$role]['modules'][0] == '*' ) {
            $priv = array_keys($purview);
        }
        else {
            $priv = array_values($role_cfg[$role]['modules']);
        }

        return $priv;
    }
}