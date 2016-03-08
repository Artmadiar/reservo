<?
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 28.02.2016
 * Time: 6:03
 */

include_once($_SERVER['DOCUMENT_ROOT']."\\administration\\entry.php");

include ($abs_path."header.php");

echo cr_list('accounts');

include ($abs_path."footer.php");
