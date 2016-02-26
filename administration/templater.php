<?php
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 25.02.2016
 * Time: 0:21
 */

include_once("datamanager.php");

function cr_element($field){

    $result = $field["represent"];

    if ($field["type"]=="string") {
        $result .=  ':<input type="text" name="' . $field["name"] . '" >';
    }

    if ($field["type"]=="bool") {
        $result .=  ':<input type="checkbox" name="' . $field["name"] . '" >';
    }

    return $result;
}

function cr_list($table){

    $data = get_data($table);

    $result = '
    <div class="row-fluid sortable ui-sortable">
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">

						<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
						  <thead>
							  <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 237px;">Username</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date registered: activate to sort column ascending" style="width: 346px;">Date registered</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending" style="width: 193px;">Role</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 208px;">Status</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 418px;">Actions</th></tr>
						  </thead>

					  <tbody role="alert" aria-live="polite" aria-relevant="all"><tr class="odd">
								<td class=" sorting_1">Dennis Ji</td>
								<td class="center ">2012/01/01</td>
								<td class="center ">Member</td>
								<td class="center ">
									<span class="label label-success">Active</span>
								</td>
								<td class="center ">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>
									</a>
									<a class="btn btn-info" href="#">
										<i class="halflings-icon white edit"></i>
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i>
									</a>
								</td>
							</tr><tr class="even">
								<td class=" sorting_1">Dennis Ji</td>
								<td class="center ">2012/01/01</td>
								<td class="center ">Member</td>
								<td class="center ">
									<span class="label label-success">Active</span>
								</td>
								<td class="center ">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>
									</a>
									<a class="btn btn-info" href="#">
										<i class="halflings-icon white edit"></i>
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i>
									</a>
								</td>
							</tr><tr class="odd">
								<td class=" sorting_1">Dennis Ji</td>
								<td class="center ">2012/01/01</td>
								<td class="center ">Member</td>
								<td class="center ">
									<span class="label label-success">Active</span>
								</td>
								<td class="center ">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>
									</a>
									<a class="btn btn-info" href="#">
										<i class="halflings-icon white edit"></i>
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i>
									</a>
								</td>

							</tr><tr class="even">
								<td class=" sorting_1">Dennis Ji</td>
								<td class="center ">2012/01/01</td>
								<td class="center ">Member</td>
								<td class="center ">
									<span class="label label-success">Active</span>
								</td>
								<td class="center ">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>
									</a>
									<a class="btn btn-info" href="#">
										<i class="halflings-icon white edit"></i>
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i>
									</a>
								</td>
							</tr><tr class="odd">
								<td class=" sorting_1">Dennis Ji</td>
								<td class="center ">2012/02/01</td>
								<td class="center ">Staff</td>
								<td class="center ">
									<span class="label label-important">Banned</span>
								</td>
								<td class="center ">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>
									</a>
									<a class="btn btn-info" href="#">
										<i class="halflings-icon white edit"></i>
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i>
									</a>
								</td>
							</tr><tr class="even">
								<td class=" sorting_1">Dennis Ji</td>
								<td class="center ">2012/02/01</td>
								<td class="center ">Staff</td>
								<td class="center ">
									<span class="label label-important">Banned</span>
								</td>
								<td class="center ">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>
									</a>
									<a class="btn btn-info" href="#">
										<i class="halflings-icon white edit"></i>
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i>
									</a>
								</td>
							</tr><tr class="odd">
								<td class=" sorting_1">Dennis Ji</td>
								<td class="center ">2012/03/01</td>
								<td class="center ">Member</td>
								<td class="center ">
									<span class="label label-warning">Pending</span>
								</td>
								<td class="center ">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>
									</a>
									<a class="btn btn-info" href="#">
										<i class="halflings-icon white edit"></i>
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i>
									</a>
								</td>
							</tr><tr class="even">
								<td class=" sorting_1">Dennis Ji</td>
								<td class="center ">2012/03/01</td>
								<td class="center ">Member</td>
								<td class="center ">
									<span class="label label-warning">Pending</span>
								</td>
								<td class="center ">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>
									</a>
									<a class="btn btn-info" href="#">
										<i class="halflings-icon white edit"></i>
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i>
									</a>
								</td>
							</tr><tr class="odd">
								<td class=" sorting_1">Dennis Ji</td>
								<td class="center ">2012/01/21</td>
								<td class="center ">Staff</td>
								<td class="center ">
									<span class="label label-success">Active</span>
								</td>
								<td class="center ">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>
									</a>
									<a class="btn btn-info" href="#">
										<i class="halflings-icon white edit"></i>
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i>
									</a>
								</td>
							</tr><tr class="even">
								<td class=" sorting_1">Dennis Ji</td>
								<td class="center ">2012/01/21</td>
								<td class="center ">Staff</td>
								<td class="center ">
									<span class="label label-success">Active</span>
								</td>
								<td class="center ">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>
									</a>
									<a class="btn btn-info" href="#">
										<i class="halflings-icon white edit"></i>
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i>
									</a>
								</td>
							</tr>
						</tbody>
					</table>

				 </div>
			</div>
		</div><!--/span-->

	</div>';

    return $result;

}