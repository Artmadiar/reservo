<?php
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 28.02.2016
 * Time: 5:34
 */

include_once($_SERVER['DOCUMENT_ROOT']."\\administration\\entry.php");

include ($abs_path."header.php");

echo '<form class="form-horizontal">
    <fieldset>';

foreach ($GLOBALS["objects"]["accounts"]["fields"] as $key => $value) {
    echo  cr_element($value);
}

echo    '<div class="form-actions">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <button class="btn">Отмена</button>
        </div>
    </fieldset>
</form>';




include ($abs_path."footer.php");