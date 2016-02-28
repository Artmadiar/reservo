<?
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 28.02.2016
 * Time: 6:03
 */

include_once($_SERVER['DOCUMENT_ROOT']."\\administration\\entry.php");

include ($abs_path."header.php");

//echo insert("users");
//foreach ($GLOBALS["objects"]["users"] as $key => $value) {
//    echo "<br>" . cr_element($value);
//}
//echo '<br>';
echo cr_list('accounts');





include ($abs_path."footer.php");
