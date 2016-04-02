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
        $where = array();
        if (!empty($_REQUEST['id']))
            $where['id'] = array('compare'=>'<>','value'=>$_REQUEST['id'],'separator'=>'AND');
        if ($check && $unique) {
            if (!empty($_POST[$value["name"]]) == true) {
                $where[$value["name"]] = array('compare'=>'=','value'=>$_POST[$value["name"]],'type'=>$value["type"]);
                if (have_data($object,$where,$value["name"]) == false) {
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
            $where[$value["name"]] = array("compare"=>'=','value'=>$_POST[$value["name"]],"type"=>$value["type"]);
            if (!empty($_POST[$value["name"]]) == true) {
                if (
                    have_data($object,
                        $where,
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



function insert($object,&$id=null){

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
    if ($id!=null)
        $id = $pdo->lastInsertId();

    Database::disconnect();

    if (intval($q->errorCode())==0)
        return true;
    else
        return false;

}

function update($object,$where=array()){

    $sql = 'update '.$object .' SET ';

    $values = array();

    $error_load_pics = false;

    foreach($GLOBALS['objects'][$object]['fields'] as $key=>$value) {
        if ($key == 'id') {
        } elseif ($key == "date_reg") {
        } elseif ($value["type"] == "bool") {
            $sql .= $key.'='.$_POST[$value["name"]].',';
        } elseif ($value["type"] == "picture") {

            $sql .= $key.'=?,';

            $int_pic = 0;
            //If we have id and don't have pic
            if ((!empty($_POST[$value["name"]])) && ($_POST[$value["name"]]!=0) && (empty($_FILES[$value["name"]]["name"]))) {
                $int_pic = $_POST[$value["name"]];
            //if we don't have id
            } else {
                //but have file of pic
                if (!empty($_FILES[$value["name"]]["name"])){
                    //load pic and get id of file
                    $res_load = load_picture($value["name"]);
                    //if successful load
                    if ($res_load['valid']==true)
                        $int_pic = $res_load['id'];
                    else
                        $error_load_pics = true;
                }
            }
            $values[] = $int_pic;

        } else {
            $sql .= $key.'=?,';
            //$values[] = mysqli_real_escape_string($pdo,$_POST[$value["name"]]);
            $values[] = $_POST[$value["name"]];
        }
    }
    $sql = substr($sql, 0, strlen($sql)-1);
    //$where = mysqli_real_escape_string($pdo,$where);
    $sql = $sql.sql_ifs_builder($where);

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute($values);
    Database::disconnect();

    if ((intval($q->errorCode())==0) && ($error_load_pics==false))
        return true;
    else
        return false;

}

function edit_delete($object,$delete,$where=array()){

    if ((!isset($object)) || (!isset($delete)) || (count($where)==0))
        return false;

    $sql = 'update '.$object .' SET is_deleted=';
    $sql  .= (($delete==true)?'true':'false');

    //$where = mysqli_real_escape_string($pdo,$where);
    $sql = $sql.sql_ifs_builder($where);
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

function load_picture($pic,&$pdo=false){

    $picture = $_FILES[$pic];

    //check
    if (!empty($picture) && $picture['name']!="")
    {
        $imageinfo = getimagesize($picture['tmp_name']);
        if($imageinfo['mime'] != 'image/gif'
            && $imageinfo['mime'] != 'image/jpeg'
            && $imageinfo['mime'] != 'image/png'
            && $imageinfo['mime'] != 'image/bmp') {
            return array('error' => "Извините, изображение должно быть формата JPEG/PNG/GIF/BMP!",
                  'valid' => false,
                  'id'    => 0);
        }
        $format = $imageinfo['mime'];
        $pos = strpos($imageinfo['mime'],'/');
        if ($pos>0)
            $format = substr($imageinfo['mime'],$pos+1,strlen($imageinfo['mime']));
        $name = basename($picture["name"]);

        $not_set_pdo = ($pdo==false);
        if ($not_set_pdo) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        $sql = 'INSERT INTO files (date_reg,user_id,name,format) VALUES (NOW(),'.$GLOBALS["user"]["id"].',"'.$name.'","'.$format.'") ';
        $q = $pdo->prepare($sql);
        $q->execute();
        $id = $pdo->lastInsertId();

        if ($not_set_pdo)
            Database::disconnect();

        if (intval($q->errorCode())!=0)
            return array('error' => "Ошибка загрузки изображения в базу данных!",
                'valid' => false,
                'id'    => 0);

        $uploadfile = $GLOBALS['files_storage_server'] . $id . '.' . $format;
        if (move_uploaded_file($picture['tmp_name'], $uploadfile)) {
            return array('error' => "",
                'valid' => true,
                'id'    => $id);
        }
        else {
            return array('error' => "Ошибка загрузки изображения!",
                'valid' => false,
                'id'    => 0);
        }

    }
    else
        return array('error' => "",
            'valid' => false,
            'id'    => 0);
}

function get_data($table,$where=array(),$selected_fields='',$order=''){

    if ($selected_fields=='')
        $selected_fields = '*';

    if ($where=="")
        $where = array();

    if ($order!=''){
        $order = 'ORDER BY '.$order;
    }

    $pdo = Database::connect();
    //$where = mysqli_real_escape_string($pdo,$where);
    //$order = mysqli_real_escape_string($pdo,$order);
    $sql = 'SELECT '.$selected_fields.' FROM '.$table.' '.sql_ifs_builder($where).' '.$order;
    $result = $pdo->query($sql);
    Database::disconnect();

    return $result;
}

function get_first($table,$where=array(),$selected_fields='',$order='',$in=0){
    $in++;
    $result = get_data($table,$where,$selected_fields,$order);
    if ($result==false)
        return false;
    $row = $result->fetch();

    foreach($GLOBALS['objects'][$table]['fields'] as $key=>$value) {
        if ($value["type"]=="index_data"){

            if ($in>=4) return null;

            $index_data = get_first($value["data"]["table"],
                array($value["data"]["index"]=>array("compare"=>"=","value"=>$row[$value["name"]])),"","",$in);
                //$value["data"]["field"]);

            $row[$value["data"]["name"]] = $index_data;//[$value["data"]["field"]];
        }
    }
    return $row;
}

function have_data($table,$where=array(),$selected_fields=''){

    $result = get_data($table,$where,$selected_fields);
    if ($result->rowCount()==0){
        $have_data = false;
    }
    else{
        $have_data = true;
    }

    return $have_data;
}

function get_pic($id){

    if ($id==0) return false;
    $pic = get_first("files",array("id"=>array("value"=>$id)),"");
    if ($pic==false) return false;
    $pic["path"] = $GLOBALS['rel_path'].$GLOBALS['files_storage'].$pic['id'].'.'.$pic['format'];

    return $pic;
}

function sql_ifs_builder($ifs){

    $result = '';

    if (count($ifs)==0) return $result;

    foreach($ifs as $key=>$value){

        $compare = $value['compare'];
        if ((!isset($compare)) || (empty($compare)))
            $compare = "=";

        $val = $value['value'];
        if (
            ($value["type"]=='string') ||
            ($value["type"]=='email') ||
            ($value["type"]=='string')
            )
            $val = "'".$val."'";

        $result .= ' '.$key.$compare.$val;
        if (isset($value['separator']))
            $result .= ' '.$value['separator'];
    }

    if ($result!='') $result = ' WHERE '.$result;
    $result;
    return $result;

}