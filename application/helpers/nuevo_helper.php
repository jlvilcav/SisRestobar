<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('notSimbols'))
{
    function notSimbols($var = '')
    {
    	//compruebo que los caracteres sean los permitidos 
	   $permitidos = "áéíóúÁÉÍÓÚabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_"; 
	   for ($i=0; $i<strlen($nombre_usuario); $i++){ 
	      if (strpos($permitidos, substr($var,$i,1))===false){ 
	         echo $nombre_usuario . " no es válido<br>"; 
	         return false; 
	      }else{
	      	echo $var . " es válido<br>"; 
	   		return true;
	      }
	   } 
	   
    }   
}