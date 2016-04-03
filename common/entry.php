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

$files_storage_server = $_SERVER['DOCUMENT_ROOT']."\\files\\";
$files_storage = "files/";

$abs_path = $_SERVER['DOCUMENT_ROOT']."\\";

$level = substr_count($_SERVER['REQUEST_URI'],"/")-1;
$rel_path = "";
for ($i = 1; $i <= $level; $i++) {
    $rel_path.='../';
}

//includes

include_once($abs_path."common\\init.php");
include_once($abs_path."common\\datamanager.php");
include_once($abs_path."common\\templater.php");


//session

include_once($abs_path."common\\security.php");

//
