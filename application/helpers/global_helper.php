<?php
/**
 * Created by PhpStorm.
 * User: ruh19
 * Date: 2/6/2018
 * Time: 12:57 AM
 */

/**
 * implode array to string
 * if array is null or space then return null
 * @param $arr: array
*/
if ( ! function_exists('cimplode')) {
    function cimplode($arr)
    {
        if ( isset($arr) == false || $arr == null || $arr == "" || count($arr) < 1 ) return null;
        else return implode(",", $arr);
    }
}

/**
 * @param $str : multi check values string ( join with `, ` )
 * @param $cnt: length of array
 * @return $ret : array that explode
*/
if ( ! function_exists("ccheckeds")) {
    function ccheckeds($str, $cnt)
    {
        $res = array_fill(0, $cnt, "");

        if ( isset($str) == false || $str == "" || $str == null ) return $res;

        $arr = explode(",", $str);
        for ( $i = 0; $i < count($arr); $i ++ ) $res[ intval($arr[$i]) - 1 ] = "checked";
        return $res;
    }
}

/**
 * @param $str : multi selected values string ( join with `, ` )
 * @param $cnt: length of array
 * @return $ret : array that explode
 */
if ( ! function_exists("cselecteds")) {
    function cselecteds($str, $cnt)
    {
        $res = array_fill(0, $cnt, "");

        if ( isset($str) == false || $str == "" || $str == null ) return $res;

        $arr = explode(",", $str);
        for ( $i = 0; $i < count($arr); $i ++ ) $res[ intval($arr[$i]) - 1 ] = "selected";
        return $res;
    }
}

/**
 * validate invalid value ( country, state, city, etc select params)
 * @param $param : paramter
 * @return $ret if validate then original, else 0
*/

if ( !function_exists("ValParamN")) {
    function valparamN( $param ) {
        if ( isset($param) == false || $param == "" || $param == null ) return 0;
        else return $param;
    }
}

/**
 * validate invalid string
 * @param $param : paramter
 * @return $ret if validate then original, else ""
 */

if ( !function_exists("ValParamS")) {
    function ValParamS( $param ) {
        if ( isset($param) == false || $param == "" || $param == null ) return "";
        else return $param;
    }
}

/**
* implode array to string by using constant array
* if array is null or space then return null
 * @param $indexs: index string ( seperate ",")
 * @param $carray: constant array
*/
if ( ! function_exists('cimplode_c')) {
    function cimplode_c($indexs, $carray)
    {
        $carray = unserialize($carray);
        $ret = "";
        if ( isset($indexs) == false || $indexs == null || $indexs == "" ) return $ret;
        $iarr = explode(",", $indexs);
        foreach ( $iarr as $val ) {
            if ( $ret != "" ) $ret .= ", ";
            $ret .= $carray[intval($val)];
        }

        return $ret;
    }
}

/**
 * implode array to string by using constant array
 * if array is null or space then return null
 * @param $indexs: index string ( seperate ",")
 * @param $carray: constant array
 */
if ( ! function_exists('cimplode_mc')) {
    function cimplode_mc($indexs, $carray)
    {
        $carray = unserialize($carray);
        $ret = "";
        if ( isset($indexs) == false || $indexs == null || $indexs == "" ) return "Any";
        $iarr = explode(",", $indexs);
        foreach ( $iarr as $val ) {
            if ( $ret != "" ) $ret .= ", ";
            $ret .= $carray[ intval($val) - 1 ];
        }

        return $ret;
    }
}

/**
 * implode array to string by using constant array
 * if array is null or space then return null
 * @param $index: index
 * @param $carray: constant array
 */
if ( ! function_exists('get_constant_val')) {
    function get_constant_val($index, $carray)
    {
        $carray = unserialize($carray);
        $ret = "not set";
        if ( isset($index) == false || $index == null || $index == "" || $index == "0" ) return $ret;
        $ret = $carray[ intval($index) - 1 ];
        return $ret;
    }
}