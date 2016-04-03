<?php
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 13.03.2016
 * Time: 1:31
 */

include_once($_SERVER['DOCUMENT_ROOT']."\\common\\entry.php");
$accounts = $GLOBALS["objects"]["accounts"];
$messages = "";

//POST
if (count($_POST)!=0) {
    if (empty($_REQUEST["id"])){
        $messages = "";//TODO:js script
    }
    else{

        if (!empty($_POST["apply"])) {

            if ($_POST["apply"]==true) {
                if (edit_delete("accounts", true, array('id'=>array('compare'=>'=','value'=>$_REQUEST["id"]))) == true) {
                    header("Location: /administration/points/#id" . $_REQUEST["id"]);
                }
            }
            else
            {
                header("Location: /administration/points/#id" . $_REQUEST["id"]);
            }
        }
    }
}
include ($abs_path."\\administration\\header.php");

$data = get_first("accounts",array('id'=>array('value'=>$_REQUEST['id'])),'','id');

echo '
<div class="container">
    <div class="span10 offset1">
        <div class="row">
            <h3>Удаление аккаунта: '.$data["name"].'</h3>
        </div>

        <form class="form-horizontal" action="delete.php" method="post">
          <input type="hidden" name="id" value="'.$_REQUEST['id'].'"/>
          <input type="hidden" name="apply" checked="checked" value="true"/>
          <p class="alert alert-error">Вы уверены, что хотите удалить аккаунт '.$data['name'].'?</p>
          <div class="form-actions">
              <button type="submit" class="btn btn-danger">Да</button>
              <a class="btn" href="/administration/points/#id'.$_REQUEST["id"].'">Нет</a>
            </div>
        </form>
    </div>
</div> <!-- /container -->
';



include ($abs_path."\\administration\\footer.php");