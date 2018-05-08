<?php
/**
 * Created by IntelliJ IDEA.
 * User: codeMonkey QQ:2463619823
 * Date: 2016/4/8
 * Time: 23:04
 */

//define("SANLIAN_XKWKJ", "sanlian_xkwkj");
//define("SANLIAN_XKWKJ_RES", "../addons/" . SANLIAN_XKWKJ . "/");


require IA_ROOT. '/addons/sanlian_xkwkj/core/defines.php';
require_once IA_ROOT . "/addons/" . SANLIAN_XKWKJ . "/dbutil.class.php";
require_once IA_ROOT . "/addons/" . SANLIAN_XKWKJ . "/imageUtil.php";
require IA_ROOT . "/addons/" . SANLIAN_XKWKJ . "/oauth2.class.php";
require_once IA_ROOT . "/addons/" . SANLIAN_XKWKJ . "/value.class.php";
require_once IA_ROOT . "/addons/" . SANLIAN_XKWKJ . "/monUtil.class.php";
require_once IA_ROOT . "/addons/" . SANLIAN_XKWKJ . "/WxPayPubHelper/WxPayPubHelper.php";

class Core extends WeModuleSite {

	public $POSTER_PATH = "/addons/sanlian_xkwkj/poster/#ticket#.jpg";

	function __construct() {
		global $_W;
	}

	public function getMobileTemplate($tid) {

		if (empty($tid)) {
			return "templates/default/";
		}

		$templdate = DBUtil::findById(DBUtil::$TABLE_XKWKJ_TEMPLATE, $tid);
		if (empty($templdate)) {
			message("模板删除或不存在，请检查!!");
		}

		return "templates/". $templdate['dirname'] . "/";
	}
}