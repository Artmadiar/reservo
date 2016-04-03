<?
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 28.02.2016
 * Time: 6:03
 */
include_once($_SERVER['DOCUMENT_ROOT']."\\common\\entry.php");

include ($abs_path."\\administration\\header.php");

echo cr_list('accounts');

include ($abs_path."\\administration\\footer.php");
