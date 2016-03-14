<?php
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 21.02.2016
 * Time: 7:01
 */

include_once("init.php");
include_once("database.php");


function validate($object)
{
    $result = true;
    $fields = array();

    //isset
    foreach ($GLOBALS['objects'][$object]['fields'] as $key => $value) {

        $check = $value["check"];
        $unique = $value["unique"];
        $where = '';
        if (!empty($_REQUEST['id']))
            $where = 'NOT id='.$_REQUEST['id'].' AND ';
        if ($check && $unique) {
            if (!empty($_POST[$value["name"]]) == true) {
                if (
                    have_data($object,
                        $where.' '.$value["name"] . '="' . $_POST[$value["name"]] . '"',
                        $value["name"]) == false
                ) {
                    $fields[$key] = array("error" => false, "detail" => "");
                } else {
                    $result = false;
                    $fields[$key] = array("error" => true, "detail" => "Данное значение занято!");
                }
            } else //check=true;not empty;unique = doesn't matter
            {
                $fields[$key] = array("error" => true, "detail" => "Обязательное поле для заполнения!");
            }
        } elseif ($check && !$unique) {
            if (!empty($_POST[$value["name"]]) == true) {
                $fields[$key] = array("error" => false, "detail" => "");
            } else //check=true;not empty;unique = doesn't matter
            {
                $fields[$key] = array("error" => true, "detail" => "Обязательное поле для заполнения!");
            }
        } elseif (!$check && $unique) {
            if (!empty($_POST[$value["name"]]) == true) {
                if (
                    have_data($object,
                        $value["name"] . '=`' . $_POST[$value["name"]] . '`',
                        $value["name"]) == false
                ) {
                    $fields[$key] = array("error" => false, "detail" => "");
                } else {
                    $result = false;
                    $fields[$key] = array("error" => true, "detail" => "Данное значение занято!");
                }
            }
        } elseif (!$check && !$unique) {
            $fields[$key] = array("error" => false, "detail" => "");
        }
    }
    $answer = array("result"=>$result,"fields"=>$fields);
    return $answer;
}



function insert($object){

    $sql = 'insert into '.$object .' (';

    foreach($GLOBALS['objects'][$object]['fields'] as $key=>$value)
    {
        if ($key!='id')
        $sql .= "$key,";
    }
    $sql = substr($sql, 0, strlen($sql)-1).") VALUES (";
    $values = array();
    foreach($GLOBALS['objects'][$object]['fields'] as $key=>$value) {
        if ($key == 'id') {
        } elseif ($key == "date_reg") {
            $sql .= 'NOW(),';
        } elseif ($key == "is_deleted") {
            $sql .= '?,';
            $values[] = 'false';
        } else {
            $sql .= '?,';
            $values[] = $_POST[$value["name"]];
            //$values[] = mysqli_real_escape_string($pdo,$_POST[$value["name"]]);
        }
    }
    $sql = substr($sql, 0, strlen($sql)-1).")";

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute($values);
    Database::disconnect();

    if (intval($q->errorCode())==0)
        return true;
    else
        return false;

}

function update($object,$where){

    $sql = 'update '.$object .' SET ';

    $values = array();
    foreach($GLOBALS['objects'][$object]['fields'] as $key=>$value) {
        if ($key == 'id') {
        } elseif ($key == "date_reg") {
        } elseif ($value["type"] == "bool") {
            $sql .= $key.'='.$_POST[$value["name"]].',';
        } else {
            $sql .= $key.'=?,';
            //$values[] = mysqli_real_escape_string($pdo,$_POST[$value["name"]]);
            $values[] = $_POST[$value["name"]];
        }
    }
    $sql = substr($sql, 0, strlen($sql)-1);
    //$where = mysqli_real_escape_string($pdo,$where);
    $sql = $sql.' WHERE '.$where;

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute($values);
    Database::disconnect();

    if (intval($q->errorCode())==0)
        return true;
    else
        return false;

}

function edit_delete($object,$delete,$where){

    if ((!isset($object)) || (!isset($delete)) || (!isset($where)))
        return false;

    $sql = 'update '.$object .' SET is_deleted=';
    $sql  .= (($delete==true)?'true':'false');

    //$where = mysqli_real_escape_string($pdo,$where);
    $sql = $sql.' WHERE '.$where;
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute();
    Database::disconnect();

    if (intval($q->errorCode())==0)
        return true;
    else
        return false;
}

function get_data($table,$where='',$selected_fields='',$order=''){

    if ($where!='')
        $where = ' WHERE '.$where;

    if ($selected_fields=='')
        $selected_fields = '*';

    if ($order!=''){
        $order = 'ORDER BY '.$order;
    }

    $pdo = Database::connect();
    //$where = mysqli_real_escape_string($pdo,$where);
    //$order = mysqli_real_escape_string($pdo,$order);
    $sql = 'SELECT '.$selected_fields.' FROM '.$table.' '.$where.' '.$order;
    $result = $pdo->query($sql);
    Database::disconnect();

    return $result;
}

function get_first($table,$where='',$selected_fields='',$order=''){

    $result = get_data($table,$where,$selected_fields,$order);
    $row = $result->fetch();
    return $row;
}

function have_data($table,$where='',$selected_fields=''){

    $result = get_data($table,$where,$selected_fields);
    if ($result->rowCount()==0){
        $have_data = false;
    }
    else{
        $have_data = true;
    }

    return $have_data;
}

