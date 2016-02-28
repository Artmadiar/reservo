<?php
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 28.02.2016
 * Time: 8:33
 */

global $file_storage;
global $rel_path;
global $abs_path;

//initial

$file_storage = $_SERVER['DOCUMENT_ROOT']."\\administration\\files";

$abs_path = $_SERVER['DOCUMENT_ROOT']."\\administration\\";

$level = substr_count($_SERVER['REQUEST_URI'],"/")-1;
$rel_path = "";
for ($i = 1; $i <= $level; $i++) {
    $rel_path.='../';
}


//includes

include_once($abs_path."init.php");
include_once($abs_path."datamanager.php");
include_once($abs_path."templater.php");
