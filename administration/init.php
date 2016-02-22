<?php
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 21.02.2016
 * Time: 8:07
 */

global $objects;
global $file_storage;
global $host;

$file_storage = "\files";
$host = "reservo";

$json = file_get_contents('scheme.json');
$objects = json_decode($json,true);
