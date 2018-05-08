<?php
/**
 * Created by IntelliJ IDEA.
 * User: codeMonkey QQ:2463619823
 * Date: 2017/6/26
 * Time: 21:28
 */

defined('IN_IA') or exit('Access Denied');
$page_size = $this::$PAGE_SIZE;
$page = max(1, intval($_GPC['page']));
$start= $page_size + ($page - 1) * $page_size;
$userInfo = $this->getClientUserInfo();
if (empty($userInfo)) {
	echo "";
}

$goods_name = "(select p_name from ".tablename(DBUtil::$TABLE_XKWKJ_GOODS)." g where k.gid = g.id) as goods_name";
$goods_preview_pic = "(select p_preview_pic from ".tablename(DBUtil::$TABLE_XKWKJ_GOODS)." g where k.gid = g.id) as goods_preview_pic";


$listSql = "select u.id as uid , k.id, ".$goods_name.", k.p_y_price, k.p_low_price, ".$goods_preview_pic." from ".tablename(DBUtil::$TABLE_XKWKJ). " k left join "
	.tablename(DBUtil::$TABLE_XKWKJ_USER). " u on u.kid=k.id where k.show_index_enable=1 and k.weid=:weid and u.openid=:openid order by k.index_sort asc limit ".$start.",".$this::$PAGE_SIZE;


$countSql = "select count(*) from ".tablename(DBUtil::$TABLE_XKWKJ). " k left join "
	.tablename(DBUtil::$TABLE_XKWKJ_USER). " u on u.kid=k.id where k.show_index_enable=1 and k.weid=:weid and u.openid=:openid";


$params = array(
	":openid"=>$userInfo['openid'],
	":weid"=> $this->weid
);

$list = pdo_fetchall($listSql, $params);
if (empty($list)) {
	echo "";
	exit;
}
//include $this->template("index_page2");





$indexsetting = DBUtil::findUnique(DBUtil::$TABLE_XKWKJ_INDEX_SETTING, array(':weid' => $this->weid));


if (empty($indexsetting['home_style'])) {
	include $this->template("index_page");
}

if ($indexsetting['home_style'] == 1) {
	include $this->template("index_page2");
}


