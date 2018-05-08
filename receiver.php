<?php
/**
 * 模块订阅器
 */
defined('IN_IA') or exit('Access Denied');

class Sanlian_XKWkJModuleReceiver extends WeModuleReceiver {
	public function receive() {
		global $_W, $_GPC;
		//load()->func('communication');
		$type = $this->message['type'];
		$uniacid = $_W['uniacid'];
		$acid = $_W['acid'];
		$openid = $this->message['from'];
		WeUtility::logging('info',"333".$type);
	}
	
		
}