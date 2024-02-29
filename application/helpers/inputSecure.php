<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function to_string_seguro($string){
    $blackListChar = '/[<>\#“”$%&+*\/=¿?¡!\'\\\`’()]/';
    $string = preg_replace($blackListChar,'',$string);
    return $string;
}

function to_number_seguro($string){
    $new_number=''; 
    if(is_numeric($string))
    {
        $new_number=$string;
    }
    return $new_number;
}