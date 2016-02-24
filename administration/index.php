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

$pdo = Database::connect();

$sql = 'SELECT * FROM accounts ORDER BY id';
echo '<table border="1">';
foreach ($pdo->query($sql) as $row) {
    echo '<tr>';
    echo '<td>'.$row["id"].'</td>';
    echo '<td>'.$row["login"].'</td>';
    echo '<td>'.$row["name"].'</td>';
    echo '<td>'.$row["BIN"].'</td>';
    echo '</tr>';
}
Database::disconnect();


include ("footer.php");
