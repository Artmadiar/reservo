<?php
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 28.02.2016
 * Time: 8:33
 */

global $files_storage;
global $files_storage_server;
global $rel_path;
global $abs_path;
global $user;

//initial

$files_storage_server = $_SERVER['DOCUMENT_ROOT']."\\administration\\files\\";
$files_storage = "administration/files/";

$abs_path = $_SERVER['DOCUMENT_ROOT']."\\administration\\";

$level = substr_count($_SERVER['REQUEST_URI'],"/")-1;
$rel_path = "";
for ($i = 1; $i <= $level; $i++) {
    $rel_path.='../';
}

$user = array("id"=>0,"login"=>"admin");

//includes

include_once($abs_path."init.php");
include_once($abs_path."datamanager.php");
include_once($abs_path."templater.php");
