<?php
/**
 * Created by IntelliJ IDEA.
 * User: codeMonkey QQ:2463619823
 * Date: 2017/6/26
 * Time: 21:28
 */

defined('IN_IA') or exit('Access Denied');
$kid = $_GPC['kid'];
$uid = $_GPC['uid'];
$xkwkj = DBUtil::findById(DBUtil::$TABLE_XKWKJ, $kid);
$user = DBUtil::findById(DBUtil::$TABLE_XKWKJ_USER, $uid);
$userInfo = $this->getClientUserInfo($xkwkj['id']);
MonUtil::emtpyMsg($xkwkj, "砍价活动删除或不存在");
MonUtil::emtpyMsg($user, "用户删除或不存在");
$orderInfo = $this->findOrderInfo($kid, $uid);
MonUtil::emtpyMsg($orderInfo, "您还未提交订单");


include $this->template('orderInfo');