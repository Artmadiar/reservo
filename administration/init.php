<?php
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 21.02.2016
 * Time: 8:07
 */

$json = file_get_contents('scheme.json');
global $objects;
$objects = json_decode($json,true);
