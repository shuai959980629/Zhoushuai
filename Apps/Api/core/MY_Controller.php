<?php
class MY_Controller extends CI_Controller
{
	protected $headers;
	protected $params; 				//客户端提交的数据
	protected $pageData = array();  //提交的页面数据

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(false);
	}


	/**
	 * 返回客户端信息通用函数
	 * @param number $status 返回状态
	 * @param string $data	包含的数据
	 * @param string $msg	状态说明
	 */
	public function return_client($status = 0, $msg = null)
	{
		$requesttype = $this->input->is_ajax_request();//ajax请求
		if($requesttype){
			header('Content-type: application/json;charset=utf-8');
			$resp = array(
				'status' => $status,
				'data' => empty($this->pageData) ? null : $this->pageDat,
				'msg' => empty($msg) ? null : $msg,
				'time' => date('Y-m-d H:i:s', time()));//microtime(true) - $starttime);
			$json = json_encode($resp);
			die($json);
		}
	}

}
