<?php
global $_W,$_GPC;

empty($_GPC['op'])? $operation ='list':$operation=$_GPC['op'];

if($operation == 'list'){
    $shoplist = pdo_getall('sanlian_xkwkj_shop_manage',array('uniacid'=>$_W['uniacid']));
}elseif($operation == 'add'){
    if(checksubmit()){
        $data=array(
            'shop_name'=>$_GPC['name'],
            'uniacid'=>$_W['uniacid']
        );
        if(empty($_GPC['id'])){
            $res = pdo_insert('sanlian_xkwkj_shop_manage',$data);
        }else{
            $res = pdo_update('sanlian_xkwkj_shop_manage',$data,array('id'=>$_GPC['id']));
        }
        if(empty($res)){
            message('操作失败',$this->createWebUrl('shopmanage'),'error');
        }else{
            message('操作成功',$this->createWebUrl('shopmanage'),'success');
        }
    }else{
        if(!empty($_GPC['id'])){
            $shop = pdo_get('sanlian_xkwkj_shop_manage',array('id'=>$_GPC['id']));
        }
    }
}elseif($operation == 'delete'){
    $res = pdo_delete('sanlian_xkwkj_shop_manage',array('id'=>$_GPC['id'])); 
    if(empty($res)){
        message('删除失败',$this->createWebUrl('shopmanage'),'error');
    }else{
        message('删除成功',$this->createWebUrl('shopmanage'),'success');
    }
}
include $this->template('shop_manage');
?>