<?php
/**
 * Created by IntelliJ IDEA.
 * User: wanglu
 * Date: 2017/11/10
 * Time: 10:59
 */
/**
 * Created by wanglu on 2017/11/10.
 */

$list = pdo_fetchall("SELECT a.*,b.name FROM " . tablename('enjoy_city_firm') . " as a left join ".tablename('enjoy_city_kind')." as b on
    a.childid=b.id WHERE a.uniacid = '{$_W['uniacid']}' and a.ispay>-1 ORDER BY a.createtime desc");

$title = array(
    '排序',
    '商户名',
    '起始时间',
    '终止时间',
    '一级分类',
    '二级分类',
    '省',
    '市',
    '区',
    '详细地址',
    '经度',
    '纬度',
    '电话',
    '简介',
    '优惠信息',
    '自定义按钮名称',
    '商品外链',
    'logo图片',
    '横幅图片',
    '浏览次数',
    '转发次数',
    '老板微信号',
    '老板微信昵称',
    '老板性别',
    '老板头像',
    '老板二维码',
    '申请人姓名',
    '申请人UID',
    '老板个人简介',
    '通过审核1(是)0(否)',
    '在线支付1(是)0(否)',
    '在线支付1金额',
);

$arraydata[] = iconv("UTF-8","GB2312//IGNORE", implode("\t", $title )) ;

foreach ($list as &$value) {
    $cash=$value['total']-$value['cashed'];
    $tmp_value =  array(
        $value['hot'],
        $value['title'],
        $value['stime'],
        $value['etime'],
        $value['parentid'],
        $value['childid'],
        $value['province'],
        $value['city'],
        $value['district'],
        $value['address'],
        $value['location_x'],
        $value['location_y'],
        $value['tel'],
        $value['intro'],
        $value['custom'],
        $value['breaks'],
        $value['firmurl'],
        $value['icon'],
        $value['img'],
        $value['browse'],
        $value['forward'],
        $value['wei_num'],
        $value['wei_name'],
        $value['wei_sex'],
        $value['wei_avatar'],
        $value['wei_ewm'],
        $value['s_name'],
        $value['uid'],
        $value['wei_intro'],
        $value['ischeck'],
        $value['ispay'],
        $value['paymoney'],
    );

    $arraydata[] = iconv("UTF-8","GB2312//IGNORE", implode("\t", $tmp_value )) ;
}
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/vnd.ms-execl");
header("Content-Type: application/force-download");
header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=".date('Ymd').'.xls');
header("Content-Transfer-Encoding: binary");
header("Pragma: no-cache");
header("Expires: 0");
echo  implode("\t\n",$arraydata);
exit();
