<?
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 21.02.2016
 * Time: 5:41
 */
include ("datamanager.php");
include ("header.php");

echo insert("users");
foreach ($GLOBALS["objects"]["users"] as $key => $value) {
    echo "<br>" . cr_element($value);
}
include ("footer.php");
