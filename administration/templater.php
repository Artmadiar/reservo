<?php
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 25.02.2016
 * Time: 0:21
 */

include_once("datamanager.php");

function cr_element($field,$value,$error){

	$result = '';
    $attrs = '';

    if (($field["name"]=="is_deleted") || ($field["name"]=="date_reg")) {
        $attrs .= ' readonly';
    }

    if ($field["check"]) {
        $attrs .= ' required';
    }

    if ($field["length"]!=false) {
        $attrs .= ' maxlength='.$field["length"];
    }


    if ($field["type"]=="string") {
		$result .='
		<div class="control-group '.(($error["error"]==true)?'error':'').'">
			<label class="control-label" for="'.$field["name"].'">'.$field["represent"].'</label>
			<div class="controls">
				<input type="text" '.$attrs.' id="'.$field["name"].'" name="'.$field["name"].'" value="'.$value.'" >';
				if ($error["error"])
                    $result .= '
                    <span class="help-inline">'.$error["detail"].'</span>';
		$result .='	</div>
		</div>';
    }
    elseif ($field["type"]=="bool") {
        $result .= '
		<div class="control-group '.(($error["error"]==true)?'error':'').'">
			<label class="control-label" for="'.$field['name'].'">'.$field['represent'].'</label>
			<div class="controls">
				<label class="checkbox">
					<div class="checker" id="'.$field['name'].'">
						<span>
							<input '.$attrs.' type="checkbox" id="'.$field['name'].'" value="'.$value.'">
						</span>
					</div>
				</label>
			</div>
		</div>';
	}
    elseif ($field["type"]=="email") {

        //TASK: $("#email")[0].checkValidity()
        $result .= '
		 <div class="control-group '.(($error["error"]==true)?'error':'').'">
            <label class="control-label" for="'.$field['name'].'">'.$field['represent'].'</label>
            <div class="controls">
                <input type="email" '.$attrs.' class="form-control" id="'.$field['name'].'" name="'.$field['name'].'" value="'.$value.'" placeholder="Введите email">';
        if ($error["error"])
            $result .= '
                    <span class="help-inline">'.$error["detail"].'</span>';
        $result .='	</div>
		</div>';
    }
    elseif ($field["type"]=="password") {

        $result .= '
		<div class="control-group '.(($error["error"]==true)?'error':'').'">
			<label class="control-label" for="'.$field["name"].'">'.$field["represent"].'</label>
			<div class="controls">
				<input type="password" '.$attrs.' id="'.$field["name"].'" name="'.$field["name"].'" value="'.$value.'" >';
        if ($error["error"])
            $result .= '
                    <span class="help-inline">'.$error["detail"].'</span>';
        $result .='	</div>
		</div>';
    }
    elseif ($field["type"]=="date") {

        $result .= '
        <div class="control-group '.(($error["error"]==true)?'error':'').'">
		    <label class="control-label" for="'.$field['name'].'">'.$field['represent'].'</label>
		    <div class="controls">
		        <input type="date" '.$attrs.' id="'.$field['name'].'" name="'.$field['name'].'" value="'.$value.'" >';
        if ($error["error"])
            $result .= '
                    <span class="help-inline">'.$error["detail"].'</span>';
        $result .='	</div>
		</div>';
    }
    elseif ($field["type"]=="datetime") {

        $result .= '
        <div class="control-group '.(($error["error"]==true)?'error':'').'">
		    <label class="control-label" for="'.$field['name'].'">'.$field['represent'].'</label>
		    <div class="controls">
		        <input type="datetime-local" '.$attrs.' id="'.$field['name'].'" name="'.$field['name'].'" value="'.$value.'">';
        if ($error["error"])
            $result .= '
                    <span class="help-inline">'.$error["detail"].'</span>';
        $result .='	</div>
		</div>';
    }
    elseif ($field["type"]=="text") {

        $result .= '
        <div class="control-group '.(($error["error"]==true)?'error':'').'">
		    <label class="control-label" for="'.$field['name'].'">'.$field['represent'].'</label>
		    <div class="controls">
                <textarea class="form-control" '.$attrs.' id="'.$field['name'].'" name="'.$field['name'].'" rows="3">'.$value.'</textarea>';
        if ($error["error"])
            $result .= '
                    <span class="help-inline">'.$error["detail"].'</span>';
        $result .='	</div>
		</div>';

    }

    return $result;
}

function cr_list($table){

    $data = get_data($GLOBALS['objects'][$table]['name'],"","","id DESC");
    $title = $GLOBALS['objects']['accounts']['represent'];
    //$iCurr = (empty($_GET['page']) ? 1 : intval($_GET['page']));

    $result = '
			<div>
				<div class="span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>'.
                        $title
                        .'</h2>
						<div class="box-icon">
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">

						<div class="row-fluid">
						    <div class="span3">
						        <div id="DataTables_Table_0_length" class="dataTables_length">
						            <label>
						                <select style="margin-right: 5px; width: 30%;" size="1" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0">
						                    <option value="10" selected="selected">10</option>
						                    <option value="25">25</option><option value="50">50</option>
						                    <option value="100">100</option>
						                </select> записей на странице
						            </label>
						        </div>
						    </div>
						    <div class="span8">
						      <div class="dataTables_filter" id="DataTables_Table_0_filter">
						            <label>Поиск: <input type="text" style="width:70%;" aria-controls="DataTables_Table_0"></label>
						        </div>
						    </div>
						    <div class="span1">
						        <a class="btn btn-success" href="new.php">
								    <i class="halflings-icon white plus"></i>
								</a>
						    </div>
				        </div>

						<table class="table table-striped table-bordered bootstrap-datatable">
						  <thead>
							  <tr>';


                    // TABLE HEAD
                foreach($GLOBALS['objects'][$table]['fields'] as $key=>$value){

                    if ($value['show_list']==true)
                    // add attribute aria-sort="ascending" / "descending"
                    // add attribute class="sorting_asc"
                    $result.='
							      <th>
							      '.$value['represent'].'
							      </th>';
                }
                    //FOR BUTTONS
                    $result.='
							      <th>
							      Действия
							      </th>';

	                $result .= '
							  </tr>
						  </thead>
					  <tbody>';

                    foreach($data as $key=>$row) {
                        $result .= '<tr>';
                        foreach ($GLOBALS['objects'][$table]['fields'] as $column => $value) {
                            if ($value['show_list']==false) continue;
                            $result .= '
								<td><a name="id'.$row['id'].'"></a>
								' . $row[$value['name']] . '</td>';

                        }
                        //ACTIONS BUTTON
                        $result .= '
								<td class="center ">
									<a class="btn btn-info" href="update.php?id='.$row['id'].'">
										<i class="halflings-icon white edit"></i>
									</a>
									<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">
										<i class="halflings-icon white trash"></i>
									</a>
								</td>';
                        $result .= '</tr>';
                        }
                        $result .='
						</tbody>
					</table>

                    <div class="row-fluid">
                        <div class="span12">
                            <div class="dataTables_info" id="DataTables_Table_0_info">Показано с 1 по 1 из 1 записи(ей)
                            </div>
                        </div>
                        <div class="span12 center">
                            <div class="dataTables_paginate paging_bootstrap pagination">
                                <ul>
                                    <li class="prev disabled">
                                        <a href="#">← Предыдущая</a>
                                    </li>
                                    <li class="active">
                                        <a href="#">1</a>
                                    </li>
                                    <li class="next disabled">
                                        <a href="#">Следующая → </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

				 </div>
			</div>
		</div><!--/span-->';

    return $result;

}