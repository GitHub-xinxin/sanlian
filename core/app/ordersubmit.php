<?php
/**
 * Created by IntelliJ IDEA.
 * User: codeMonkey QQ:2463619823
 * Date: 2017/6/26
 * Time: 21:28
 */

defined('IN_IA') or exit('Access Denied');
		$uid = $_GPC['uid'];
		$kid = $_GPC['kid'];
		$xkwkj = DBUtil::findById(DBUtil::$TABLE_XKWKJ, $kid);
		$user = DBUtil::findById(DBUtil::$TABLE_XKWKJ_USER, $uid);
		$uname = $_GPC['uname'];
		$address = $_GPC['address'];
		$tel = $_GPC['tel'];
		$zipcode = $_GPC['zipcode'];
		$p_model=$_GPC['p_model'];
		MonUtil::emtpyMsg($xkwkj, "砍价活动不存在或已删除");
		MonUtil::emtpyMsg($user, "用户不存在或已删除");
		$orderInfo = $this->findOrderInfo($kid, $uid);
		$orderNo = $this->getOrderNo($kid, $uid);
		 $leftCount = $this->getLeftCount($xkwkj) -1;
		 if ($leftCount < 0) {
			 message("库存已不足，下次再参加活动吧!");
		 }

		if (empty($orderInfo)) {//没有该用户的订单 信息
			$order_array = array(
				'order_no' => $orderNo,
				'kid' => $xkwkj['id'],
				'uid' => $user['id'],
				'unid' => $uc['id'],
				'uname' => $uname,
				'address' => $address,
				'tel' => $tel,
				'zipcode' => $zipcode,
				'openid' => $user['openid'],
				'y_price' => $xkwkj['p_y_price'],
				'pay_type' => $xkwkj['pay_type'],
				'kh_price' => $user['price'],
				'yf_price' => $xkwkj['yf_price'],
				'total_price' => $user['price'] + $xkwkj['yf_price'],
				'status' => $this::$KJ_STATUS_XD,
				'p_model'=>$p_model,
				'createtime' => TIMESTAMP
			);

			DBUtil::create(DBUtil::$TABLE_XKWJK_ORDER, $order_array);
			$oid = pdo_insertid();
			$orderInfo = DBUtil::findById(DBUtil::$TABLE_XKWJK_ORDER, $oid);
		}

		if ($orderInfo['status'] == $this::$KJ_STATUS_XD && $xkwkj['pay_type'] == 1) {//立即支付
			$this->toPayTemplate($user, $orderInfo, $xkwkj);
		} else if ($orderInfo['status'] == $this::$KJ_STATUS_XD && $xkwkj['pay_type'] == 2) {//货到付款
			include $this->template('orderInfo');
		}
