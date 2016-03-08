<?php
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 08.03.2016
 * Time: 16:52
 */

include_once($_SERVER['DOCUMENT_ROOT']."\\administration\\entry.php");
$accounts = $GLOBALS["objects"]["accounts"];
$valid = array();

//POST
if (count($_POST)!=0) {
    $valid = validate("accounts");

    if ((!empty($_POST["BIN"])) && (strlen($_POST["BIN"])!=12)){
        $valid["result"] = false;
        $valid["fields"]["BIN"]["error"] = true;
        $valid["fields"]["BIN"]["detail"] = "Некорректный ИИН/БИН!";
    }

    if ($valid["result"] == true) {
        if (update("accounts",'id='.$_REQUEST["id"])==true){
            header("Location: /administration/points/#id".$_REQUEST["id"]);
        }
    }
}
include ($abs_path."header.php");

echo '<form class="form-horizontal" method="POST">
    <fieldset>';

$data = get_first("accounts",'id='.$_REQUEST['id'],'','id');
foreach ($accounts["fields"] as $key => $value) {
    if ($value["show_form"])
        echo  cr_element($value,!empty($_POST[$value["name"]])?$_POST[$value["name"]]:$data[$value["name"]],$valid["fields"][$key]);
}

echo    '   <div class="form-actions">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <button class="btn">Отмена</button>
            </div>
            </fieldset>
        </form>';




include ($abs_path."footer.php");