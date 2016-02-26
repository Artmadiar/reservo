<?
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 21.02.2016
 * Time: 5:41
 */
include_once("datamanager.php");
include_once("templater.php");

include ("header.php");

echo insert("users");
foreach ($GLOBALS["objects"]["users"] as $key => $value) {
    echo "<br>" . cr_element($value);
}
echo '<br>';
echo cr_list('accounts');





include ("footer.php");
