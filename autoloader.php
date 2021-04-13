<?php

defined( 'ABSPATH' ) || exit;

function loadMain ($name){
   $file = dirname( __FILE__ )."/assets/class/".$name.'.class.php';

   if(file_exists($file)){
       include_once $file;
   }
}

function loadAdmin ($name){
   $file = dirname( __FILE__ )."/assets/class/admin/".$name.'.class.php';

   if(file_exists($file)){
       include_once $file;
   }
}

spl_autoload_register("loadMain");
spl_autoload_register("loadAdmin");
