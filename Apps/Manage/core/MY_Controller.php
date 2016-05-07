<?php
class MY_Controller extends CI_Controller
{
	protected $theme    = '';
	protected $lay      = '';		//layout
	protected $expire	= 60;		//缓存时间
	protected $pageData = array();  //提交的页面数据

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(false);
	}



	protected function render($view = '', $content_type = 'auto', $return = FALSE)
	{
		if ($content_type == 'auto') {
			$content_type = $this->input->is_ajax_request() ? 'json' : 'html';
		}
		switch ($content_type) {
			case 'json':
				if ($return === FALSE) {
					$this->output->enable_profiler(FALSE);
					$this->output
						->set_status_header(200)
						->set_content_type('application/json', 'utf-8')
						->set_output(json_encode($this->pageData));
				}
				else {
					return json_encode($this->pageData);
				}
				break;
			case 'html':
			default:
				if (empty($view)) {
					$view = $this->router->class . '/' . $this->router->method . '.php';
				}
				$this->pageData['_COMMON'] = $this->config->item('common');
				return $this->layout->load($this->pageData, $this->lay, $view, $this->theme, $return);
				break;
		}
	}

	/**
	 * 返回客户端信息通用函数
	 * @param number $status 返回状态
	 * @param string $data	包含的数据
	 * @param string $msg	状态说明
	 */
	public function return_client($status = 0,$msg = null)
	{
		$requesttype = $this->input->is_ajax_request();
		if($requesttype){
			header('Content-type: application/json;charset=utf-8');
			$resp = array(
				'status' => $status,
				'data' => empty($this->pageData) ? null : $this->pageData,
				'msg' => empty($msg) ? null : $msg,
				'time' => date('Y-m-d H:i:s', time()));//microtime(true) - $starttime);
			$json = json_encode($resp);
			die($json);
		}
	}

}
