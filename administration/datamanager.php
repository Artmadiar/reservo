<?php
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 21.02.2016
 * Time: 7:01
 */

include_once("init.php");

/**
 * @param $object
 * @return sql
 */

include_once("database.php");

function insert($object){

    $sql = 'insert into $object (';
    foreach($GLOBALS['objects'][$object] as $key=>$value)
    {
        if ($key!='id')
        $sql .= "$key,";
    }
    $sql = substr($sql, 0, strlen($sql)-1).") VALUES (";

    foreach($GLOBALS['objects'][$object] as $key=>$value)
    {
        if ($key!='id')
        $sql .= $value["type"].',';
    }
    $sql = substr($sql, 0, strlen($sql)-1).")";

    return $sql;
}
