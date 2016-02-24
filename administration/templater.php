<?php
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 25.02.2016
 * Time: 0:21
 */


function cr_element($field){

    return $field["represent"].':<input type="text" name="'.$field["name"].'" >';

}