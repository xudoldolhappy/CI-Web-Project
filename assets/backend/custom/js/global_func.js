/**
 * string validate
 * @param val: entered val (input, select, textarea etc...)
 * @return 0=>valid, 1=>invalid
 * */
function g_v_t(val)
{
    if ( val == "" || val == undefined || val == null )
        return true;
    else return false;
}

/**
 * select value validate
 * @param val: entered val (input, select, textarea etc...)
 * @return 0=>valid, 1=>invalid
 * */
function g_v_ts(val)
{
    if ( val == "" || val == undefined || val == null || val == "0" )
        return true;
    else return false;
}

/**
 * number validate
 * @param val: entered value
 * @return 0=>valid, 1=>invalid
 * */
function g_v_n(val)
{
    if ( isNaN(val) ) return true;
    else return false;
}

/**
 * phone number format
 * @param str: phone number
 * @return 0=>valid, 1=>invalid
 * */
function g_v_p(str)
{
    if ( str == undefined || str == "" || str == null ) return true;
    var strs = str.split("");
    if ( strs.length < 10 || strs.length > 13 ) return true;
    if ( isNaN(str)) return true;
    return false;
}

/**
 * date validate
 * @param str: date (yy-mm-dd)
 * @return 0=>valid, 1=>invalid
 * */
function g_v_d(str)
{
    if ( str == undefined || str == "" || str == null ) return true;
    var strs = str.split("-");
    if ( strs.length != 3 ) return true;
    if ( isNaN(strs[0]) || isNaN(strs[0]) || isNaN(strs[0]) ) return true;
    if ( parseInt(strs[0]) < 1900 || parseInt(strs[0]) > 2017 ) return true;
    if ( parseInt(strs[1]) < 1 || parseInt(strs[1]) > 12 ) return true;
    if ( parseInt(strs[2]) < 1 || parseInt(strs[2]) > 31 ) return true;
    return false;
}

/**
 * time validate
 * @param str: time (hh:mm)
 * @return 0=>valid, 1=>invalid
 * */
function g_v_t_hhmm(str)
{
    if ( str == undefined || str == "" || str == null ) return true;
    var strs = str.split(":");
    if ( strs.length != 2 ) return true;
    if ( isNaN(strs[0]) || isNaN(strs[0]) || isNaN(strs[0]) ) return true;
    if ( parseInt(strs[0]) < 0 || parseInt(strs[0]) > 23 ) return true;
    if ( parseInt(strs[1]) < 0 || parseInt(strs[1]) > 59 ) return true;
    return false;
}

/**
 * verify email foramt
 * @param str :email string (email@param.com)
 * @return 0=>valid, 1=>invalid
 * */
function g_v_e(str)
{
    if ( str == undefined || str == "" || str == null ) return true;
    var strs = str.split("@");
    if ( strs.length < 2 ) return true;
    var strs = str.split(".");
    if ( strs.length < 2 ) return true;
    return false;
}

/**
 * return valid value
 * @param val: entered val (input, select, textarea etc...)
 * @return valid value
 * */
function g_ret_val_val(val)
{
    if ( val == "" || val == undefined || val == null || val == "0" )
        return "";
    else return val;
}