<?php
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 28.02.2016
 * Time: 5:34
 */

include_once($_SERVER['DOCUMENT_ROOT']."\\common\\entry.php");
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
        if (insert("accounts")==true){
            header("Location: /administration/points/");
        }
    }
}
include ($abs_path."\\administration\\header.php");

echo '<form class="form-horizontal" method="POST">
    <fieldset>';


foreach ($accounts["fields"] as $key => $value) {
    if ($value["show_form"])
    echo  cr_element($value,$_POST[$value["name"]],$valid["fields"][$key]);
}

echo    '   <div class="form-actions">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <button class="btn">Отмена</button>
            </div>
            </fieldset>
        </form>';




include ($abs_path."\\administration\\footer.php");