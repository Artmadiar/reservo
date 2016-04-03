<?php
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 21.02.2016
 * Time: 8:07
 */

global $objects;

$json = file_get_contents($abs_path.'\\common\\scheme.json');
$objects = json_decode($json,true);
