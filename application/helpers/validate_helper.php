<?php

/**
 * if user did not logined, then go to user login page
 */
if ( ! function_exists('redirect_user_home')) {
	function redirect_user_home()
	{
		$CI =& get_instance();
		$CI->load->library("session");
		if(!$CI->session->userdata('isUserLogin') )
		{
			redirect('front/login');
		}
	}
}

/**
 * if admin did not logined, then go to admin login page
 */
if( ! function_exists('redirect_admin_home')) {
	function redirect_admin_home() {
		$CI =& get_instance();
		$CI->load->library("session");
		if( $CI->session->userdata('role') != "admin" )
		{
			redirect('admin/login');
		}
	}
}

/**
 * if developer did not logined, then go to developer login page
 * this is a temp function and use till this site will publish
 */
if( ! function_exists('redirect_developer_login')) {
    function redirect_developer_login() {
        $CI =& get_instance();
        $CI->load->library("session");
        if( $CI->session->userdata('developer') != "developer" )
        {
            redirect('front/developer_login');
        }
    }
}

/**
 * @return if user logined return 1, else if user did not logined return 0
 */
if( ! function_exists('is_user_login')) {
    function is_user_login()
    {
        $CI =& get_instance();
        $CI->load->library("session");
        if(!$CI->session->userdata('isUserLogin') )
        {
            return false;
        } else {
            return true;
        }
    }
}

/**
 * @return if admin logined return 1, else if user did not logined return 0
 */
if( ! function_exists('is_admin_login')) {
    function is_admin_login()
    {
        $CI =& get_instance();
        $CI->load->library("session");
        if( $CI->session->userdata('role') != "admin" )
        {
            return false;
        } else {
            return true;
        }
    }
}
