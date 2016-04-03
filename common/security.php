<?php
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 03.04.2016
 * Time: 6:41
 */

$res = $_SERVER['DOCUMENT_ROOT']."/common/login.php";
//header("Location: ".$_SERVER['DOCUMENT_ROOT']);

$user = get_first("users",array("id"=>array("value"=>1)));
echo $user["name"];