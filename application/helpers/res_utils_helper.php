<?php

if(!function_exists('res_write')) {
    function res_write($data) {
		header('Content-Type: application/json; charset=UTF-8');
        
        echo json_encode($data);
    }
}
