<?php

if(!function_exists('role_to_string')) {
    function role_to_string($value) {
		if($value == 1) return "Developer";
		else if($value == 2) return "Purchase";
		else if($value == 3) return "Inquery";

		return "";
    }
}

if(!function_exists('roles_to_string')) {
	function roles_to_string($role) {

		$r_array = explode(",", $role);
		$role_string = "";
		$cnt = 0;
		foreach ($r_array as $obj) {
			if($cnt == 0) {
				$role_string = $role_string.role_to_string($obj);
			}
			else {
				$role_string = $role_string.", ".role_to_string($obj);
			}

			$cnt = $cnt + 1;
		}

		return $role_string;
	}
}

if(!function_exists('get_now')) {
	function get_now() {
		date_default_timezone_set('Asia/Hong_Kong');

		$date = new DateTime();
		$timestamp = $date->getTimestamp();

		return $timestamp;
	}
}

if(!function_exists('status_to_string')) {
	function status_to_string($value) {
		if($value == 0) return "New";
		else if($value == 1) return "Pending";
		else if($value == 2) return "Approved";
		else if($value == 3) return "Purchased";
		else if($value == 4) return "Deleted";
	}
}
