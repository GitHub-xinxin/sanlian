<?php
/**
 * Created by IntelliJ IDEA.
 * User: codeMonkey QQ:2463619823
 * Date: 2017/6/26
 * Time: 21:28
 */

defined('IN_IA') or exit('Access Denied');
$kid = $_GPC['kid'];

$xkwkj = DBUtil::findById(DBUtil::$TABLE_XKWKJ, $kid);
$newtitle = $xkwkj['title']. "-副本".TIMESTAMP;
$title = $xkwkj['title'];

$copyfiles = " weid, starttime,endtime, kj_intro, p_kc, p_y_price, p_low_price, yf_price, copyright, share_title, share_icon, copyright_url, hot_tel, createtime, 
kj_dialog_tip,rank_tip,u_fist_tip,u_already_tip,fk_fist_tip,fk_already_tip,kj_rule,pay_type, p_model,kj_follow_enable, join_follow_enable, follow_dlg_tip, follow_btn_name,erweim, share_bg, rank_num, join_rank_num,
v_user, zt_address, one_kj_enable, day_help_count, submit_money_limit, hx_enabled, show_index_enable,index_sort,  announcement, zgg_url, join_user_limit, help_limit, locationlimit,bgmusic,  kc_type, lq_type,
cid, shtel, gid, templateid, hfbk_enable
";

$sql = "insert into ".tablename(DBUtil::$TABLE_XKWKJ)." (title, ".$copyfiles.")  select REPLACE  (title, '".$title."', '".$newtitle."') , ".$copyfiles." from ".tablename(DBUtil::$TABLE_XKWKJ) ." where id =". $kid;

pdo_query($sql);
message('复制成功！', referer(), 'success');

