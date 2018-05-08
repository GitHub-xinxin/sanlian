<?php

/**
 *
 * User: codeMonkey QQ:2463619823
 * Date: 2015/1/18
 * Time: 0:01
 */
class DBUtil
{


    public static $TABLE_XKWKJ = "sanlian_xkwkj";

    public static $TABLE_XKWKJ_GOODS = "sanlian_xkwkj_goods";

    public static $TABLE_XKWKJ_USER = "sanlian_xkwkj_user";

    public static $TABLE_XKWKJ_FIREND = "sanlian_xkwkj_firend";

    public static $TABLE_XKWJK_ORDER = "sanlian_xkwkj_order";

    public static $TABLE_XKWKJ_SETTING = "sanlian_xkwkj_setting";

    public static $TABLE_XKWKJ_INDEX_SETTING = "sanlian_xkwkj_index_setting";

    public static $TABLE_XKWKJ_USER_INFO = "sanlian_xkwkj_user_info";

    public static $TABLE_XKWKJ_USER_ADDRESS = "sanlian_xkwkj_address";

    public static $TABLE_XKWKJ_PPTS = "sanlian_xkwkj_ppts";

    public static $TABLE_XKWKJ_CATEGORY = "sanlian_xkwkj_category";

    public static $TABLE_XKWKJ_REPLY = "sanlian_xkwkj_reply";

    public static $TABLE_XKWKJ_TEMPLATE = "sanlian_xkwkj_template";

    public static $TABLE_XKWKJ_POSTER = "sanlian_xkwkj_poster";


    public static function findById($table, $id)
    {
        return pdo_fetch("select * from " . tablename($table) . " where id=:id", array(':id' => $id));
    }


    public static function findUnique($table, $params = array())
    {


        if (!empty($params)) {
            $where = " where ";
            $index = 0;
            foreach ($params as $key => $value) {

                $where .= substr($key, 1) . "=" . $key . " ";

                if ($index < count($params) - 1) {
                    $where .= " and ";
                }
                $index++;

            }
        }

        return pdo_fetch("select * from " . tablename($table) . $where, $params);

    }

    public static function  findList($table, $params = array())
    {


        if (!empty($params)) {
            $where = " where ";
            $index = 0;
            foreach ($params as $key => $value) {

                $where .= substr($key, 1) . "=" . $key . " ";

                if ($index < count($params) - 1) {
                    $where .= " and ";
                }
                $index++;

            }
        }

        return pdo_fetchall("select * from " . tablename($table) . $where, $params);
    }


    public static function  findListEx($table, $fileds, $params = array())
    {


        if (!empty($params)) {
            $where = " where ";
            $index = 0;
            foreach ($params as $key => $value) {

                $where .= substr($key, 1) . "=" . $key . " ";

                if ($index < count($params) - 1) {
                    $where .= " and ";
                }
                $index++;

            }
        }

        return pdo_fetchall("select " . $fileds . " from " . tablename($table) . $where, $params);
    }


    public static function  create($table, $data = array())
    {
        return pdo_insert($table, $data);

    }

    public static function  update($table, $data = array(), $params = array())
    {
        return pdo_update($table, $data, $params);

    }

    public static function  updateById($table, $data = array(), $id)
    {
        return pdo_update($table, $data, array('id' => $id));

    }


    public static function  deleteByid($table, $id)
    {
        return pdo_delete($table, array('id' => $id));
    }

    public static function  delete($table, $params = array())
    {
        return pdo_delete($table, $params);
    }


}