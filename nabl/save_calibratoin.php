<?php

session_start();
include ("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from calibration_data WHERE id='$_POST[id]' and 	isdeleted = '0'"; 
			$select_result = mysqli_query($conn, $get_query);
			$result=mysqli_fetch_array($select_result);
			$id=$result['id'];
			$unique_id=$result['unique_id'];
			$name_of_instu=$result['name_of_instu'];
			$ranges=$result['ranges'];
			$accuracy=$result['accuracy'];
			$acceptance_cri=$result['acceptance_cri'];
			$location=$result['location'];
			$make_model=$result['make_model'];
			$method=$result['method'];
			$calibration_date=$result['calibration_date'];
			$rep_no=$result['rep_no'];
			$due_date=$result['due_date'];
			$status=$result['status'];
	
			$fill = array(
							'id' => $id,
							'unique_id' => $unique_id,
							'name_of_instu' => $name_of_instu,
							'ranges' => $ranges,
							'accuracy' => $accuracy,
							'acceptance_cri' => $acceptance_cri,
							'location' => $location,
							'make_model' => $make_model,
							'method' => $method,
							'calibration_date' => date('d/m/Y', strtotime($calibration_date)),
							'rep_no' => $rep_no,
							'due_date' => date('d/m/Y', strtotime($due_date)),
							'status' => $status							
						);	  
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'noti_of_calibration')
		{
		$todays= $_POST["today_date"];

		 $get_query = "select * from calibration_data WHERE `due_date`<='$todays' and isdeleted = '0'";
		$select_result = mysqli_query($conn, $get_query);
		$design="";
		if(mysqli_num_rows($select_result) >0)
		{
		$design .="<marquee style='color:red;font-size:30px;' onmouseover='this.stop();' onmouseout='this.start();'>THERE IS EXPIRATION DATE WILL NEAR FOR THIS CERTIFICATE NO.<a href='calibration_entry_which_expired.php'>";
		while($ones_row=mysqli_fetch_array($select_result)){

		$design .= $ones_row["rep_no"]." ,";

		}
		$design .="</a></marquee>";

		}

		$fill = array('design' => $design);  
		echo json_encode($fill);
		}

		
	else if($_POST['action_type'] == 'add')
		{
			$unique_id=$_POST['unique_id'];
			$name_of_instu=$_POST['name_of_instu'];
			$ranges=$_POST['ranges'];
			$accuracy=$_POST['accuracy'];
			$acceptance_cri=$_POST['acceptance_cri'];
			$location=$_POST['location'];
			$make_model=$_POST['make_model'];
			$method=$_POST['method'];
			$calibration_date=$_POST['calibration_date'];
			$rep_no=$_POST['rep_no'];
			$due_date=$_POST['due_date'];
			$status=$_POST['status'];

			$start_day=substr($_POST['calibration_date'],0,2);
			$start_month=substr($_POST['calibration_date'],3,2);
			$start_year=substr($_POST['calibration_date'],6,4);
			$calibration_date = $start_year."-".$start_month."-".$start_day;

			$start_day=substr($_POST['due_date'],0,2);
			$start_month=substr($_POST['due_date'],3,2);
			$start_year=substr($_POST['due_date'],6,4);
			$due_date = $start_year."-".$start_month."-".$start_day;
			
			$curr_date=date("Y-m-d");
			
			$insert="insert into `calibration_data` (`unique_id`,`name_of_instu`,`ranges`,`accuracy`,`acceptance_cri`,`location`,`make_model`,`method`,`calibration_date`,`rep_no`,`due_date`,`status`,`created_by`,`created_date`, `modified_by`, `modified_date`, `isdeleted`, `deleted_by`) values(
				'$unique_id',
				'$name_of_instu',
				'$ranges',
				'$accuracy',
				'$acceptance_cri',
				'$location',
				'$make_model',
				'$method',
				'$calibration_date',
				'$rep_no',
				'$due_date',
				'$status',																			
				'$_SESSION[name]','$curr_date','','0000-00-00','0','')";
			$result_of_insert=mysqli_query($conn,$insert);	
			//------------job no logic---------
			
			$fill = $result_of_insert;
			echo json_encode($fill);	
		
		}
		
		else if($_POST['action_type'] == 'edit'){
		$calibration_date=substr($_POST['calibration_date'],0,2);
		$calibration_date_month=substr($_POST['calibration_date'],3,2);
		$calibration_date_year=substr($_POST['calibration_date'],6,4);
		$new_calibration_date = $calibration_date_year."-".$calibration_date_month."-".$calibration_date;
		
		$due_date=substr($_POST['due_date'],0,2);
		$due_date_month=substr($_POST['due_date'],3,2);
		$due_date_year=substr($_POST['due_date'],6,4);
		$new_due_date = $calibration_date_year."-".$calibration_date_month."-".$due_date;
		
		$curr_date=date("Y-m-d");
		
		  $update="update calibration_data SET `unique_id`='$_POST[unique_id]',`name_of_instu`='$_POST[name_of_instu]',`ranges`='$_POST[ranges]',`accuracy`='$_POST[accuracy]',`acceptance_cri`='$_POST[acceptance_cri]',`location`='$_POST[location]',`make_model`='$_POST[make_model]',`method`='$_POST[method]',`calibration_date`='$new_calibration_date',`rep_no`='$_POST[rep_no]',`due_date`='$new_due_date',`status`='$_POST[status]',`working_status`='$_POST[working_status]',`modified_by`='$_SESSION[name]',`modified_date`='$curr_date' WHERE `id`='$_POST[txt_id1]'"; 

		$result_of_update=mysqli_query($conn,$update);	
		
		
		$fill = array($result_of_update); 
		echo json_encode($fill);	
	
    }
	
else if($_POST['action_type'] == 'view')
		{
				 
		?>
		
					
					
				<table id="examples1" class="table table-bordered table-striped">
					<thead>
							<tr>
								<th style="text-align:center;" width="10%"><label>Actions</label></th>
								<th style="text-align:center;"><label>UNIQUE ID.</label></th>	
								<th style="text-align:center;"><label>INSTUMENT  NAME</label></th>	
								<th style="text-align:center;"><label>RANGE </label></th>	
								<th style="text-align:center;"><label>ACCURACY  </label></th>	
								<th style="text-align:center;"><label>ACCEPTANCE CRITERIA </label></th>	
								<th style="text-align:center;"><label>LOCATION  </label></th>	
								<th style="text-align:center;"><label>MAKE/ MODEL  </label></th>	
								<th style="text-align:center;"><label>METHOD OF CALIBRATION  </label></th>	
								<th style="text-align:center;"><label>DATE</label></th>	
								<th style="text-align:center;"><label>METHOD OF CALIBRATION  </label></th>	
								<th style="text-align:center;"><label>DUE DATE</label></th>	
								<th style="text-align:center;"><label>STATUS </label></th>	
								
							</tr>
							  </thead>
							  	<tbody>
								<?php
							  $query = "select * from calibration_data WHERE `isdeleted`='0'";
						
								$result = mysqli_query($conn, $query);
			
								if (mysqli_num_rows($result) > 0) {
								while($r = mysqli_fetch_array($result)){
										?>
									
										<tr>
										<td style="text-align:center;" width="10%">	
										
										<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
										<?php

											//$val =  $_SESSION['isadmin'];
											//if($val == 0 || $val == 5){
											?>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
										<?php
											//}
										?>
										</td>
										<td style="text-align:center;"><?php echo $r['unique_id'];?></td>
										<td style="text-align:center;"><?php echo $r['name_of_instu'];?></td>
										<td style="text-align:center;"><?php echo $r['ranges'];?></td>					
										<td style="text-align:center;"><?php echo $r['accuracy'];?></td>					
										<td style="text-align:center;"><?php echo $r['acceptance_cri'];?></td>
										<td style="text-align:center;"><?php echo $r['location'];?></td>					
										<td style="text-align:center;"><?php echo $r['make_model'];?></td>					
										<td style="text-align:center;"><?php echo $r['method'];?></td>		
										<td style="text-align:center;"><?php echo date('Y-m-d', strtotime($r['calibration_date']));?></td>			
										<td style="text-align:center;"><?php echo $r['rep_no'];?></td>
										<td style="text-align:center;"><?php echo date('Y-m-d', strtotime($r['due_date']));?></td>					
										<td style="text-align:center;"><?php echo $r['status'];?></td>	 				
										</tr>
										
										<?php
									}
								}
							?>
							</tbody>
						</table>
					<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.buttons.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.flash.min.js"></script>
<script src="bower_components/datatables.net-bs/js/jszip.min.js"></script>
<script src="bower_components/datatables.net-bs/js/pdfmake.min.js"></script>
<script src="bower_components/datatables.net-bs/js/vfs_fonts.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.html5.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.print.min.js"></script>

<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
 
    var table = $('#examples1').DataTable({
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
		
   
 } );
 </script>

		<?php
		
    }
		elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update calibration_data SET `isdeleted`='1',`deleted_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		
		$fill = array('result_of_delete' => $result_of_delete); 
		echo json_encode($fill);	
		
		}	
	
	 exit;
	
}

?>
