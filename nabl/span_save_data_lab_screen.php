<?php
session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'view_detail_from_job')
	{
		?>
		 <div class="table-responsive" id="display_data">
		 
										<table class="table no-margin" style="color: black;">
										  <thead>
										  <tr>
											<th>Material</th>
											<th>Lab No</th>
											<th>Test List</th>
											<th>Exp. Sub. Date</th>
										  </tr>
										  </thead>
										  <tbody>
										  <?php
		$abc = explode("|",$_POST['abc']);
		$report_no = $abc[0];
		$job_number = $abc[1];
		
		$get_jobs="select  * from job where `report_no`='$report_no' AND `job_number`='$job_number'";
		$query_job=mysqli_query($conn,$get_jobs);
		$job_row=mysqli_fetch_array($query_job);
		
		$query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$job_number' ORDER BY final_material_id DESC";
		$result=mysqli_query($conn,$query);
		$material_count=1;
		while($row=mysqli_fetch_array($result))
		{
			
		$sel_cate="select * from material_category where `material_cat_id`=".$row['material_category'];
		$result_cat=mysqli_query($conn,$sel_cate);
		$row_cat=mysqli_fetch_array($result_cat);
		
		$sel_mat="select * from material where `id`=".$row['material_id'];
		$result_mat=mysqli_query($conn,$sel_mat);
		$row_mat=mysqli_fetch_array($result_mat);
		  ?>
		  <tr>
			<td><b><?php echo $row_mat["mt_name"];?></b>
			<input type="hidden" value="<?php echo $row['material_id'];?>" name="material_id_hidden" id="material_<?php echo $material_count;?>">
			</td>
			<td>
			<input type="text" name="labno[]" class="form-control" id="labno_<?php echo $material_count;?>" value="<?php echo $row['lab_no']; ?>" disabled style="width: 160px;">
			</td>
			<td>
			<?php 
		 $test_query="select * from span_material_assign WHERE `isdeleted`=0 AND `lab_no`='$row[lab_no]' AND `report_no`='$report_no' AND `job_number`='$job_number' ORDER BY material_assign_id DESC";
		$result_for_test=mysqli_query($conn,$test_query);
		$print_test="";
		while($rows=mysqli_fetch_array($result_for_test))
		{
			
		$sel_test="select * from test_master where `test_id`=".$rows['test'];
		$result_test=mysqli_query($conn,$sel_test);
		$row_test=mysqli_fetch_array($result_test);
			
			echo $row_test['test_name']." , ";
			$print_test .=$row_test['test_name']." , ";
		}
		
		?>
		<input type="hidden" name="testlist[]" class="form-control" id="testlist_<?php echo $material_count;?>" value="<?php echo $print_test; ?>">
			
		</td>
			
			<td>
			  <input type="text" name="expdate[]" class="form-control expdate_class" id="expdate_<?php echo $material_count;?>" value="<?php echo date('d-m-Y',strtotime($row['expected_date'])); ?>" style="width: 120px;"  disabled>
			</td>
			
			
		  </tr>
		<?php 
		$material_count++;
		} ?>
		<tr>
		<td colspan="4" style="text-align:center;">
		<br>
		<a href="lab_material_print.php?pass_id=<?php echo $_POST['abc'];?>" class="btn btn-primary" target="_blank" style="width:30%;">PRINT</a>
		</td>
		</tr>
		  </tbody>
		</table>
	<?php
	} else  if($_POST['action_type'] == 'view_detail_from_job_from_second')
	{
		?>
		 <div class="table-responsive" id="display_data">
		 
										<table class="table no-margin" style="color: black;">
										  <thead>
										  <tr>
											<th>Material</th>
											<th>Lab No</th>
											<th>Test List</th>
											<th>Exp. Sub. Date</th>
											<th>Action</th>
										  </tr>
										  </thead>
										  <tbody>
										  <?php
		$abc = explode("|",$_POST['abc']);
		$report_no = $abc[0];
		$job_number = $abc[1];
		
		//update light status
		$update_light_in_final="update final_material_assign_master set `light_status`='1' where `report_no`='$report_no' AND `job_no`='$job_number' AND `light_status`='0'";
		$update_light_query=mysqli_query($conn,$update_light_in_final);
		
		$get_jobs="select  * from job where `report_no`='$report_no' AND `job_number`='$job_number'";
		$query_job=mysqli_query($conn,$get_jobs);
		$job_row=mysqli_fetch_array($query_job);
		
		$query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$job_number' ORDER BY final_material_id DESC";
		$result=mysqli_query($conn,$query);
		$material_count=1;
		while($row=mysqli_fetch_array($result))
		{
			
		$sel_cate="select * from material_category where `material_cat_id`=".$row['material_category'];
		$result_cat=mysqli_query($conn,$sel_cate);
		$row_cat=mysqli_fetch_array($result_cat);
		
		$sel_mat="select * from material where `id`=".$row['material_id'];
		$result_mat=mysqli_query($conn,$sel_mat);
		$row_mat=mysqli_fetch_array($result_mat);
		  ?>
		  <tr>
			<td><b><?php echo $row_mat["mt_name"];?></b>
			<input type="hidden" value="<?php echo $row['material_id'];?>" name="material_id_hidden" id="material_<?php echo $material_count;?>">
			</td>
			<td>
			<input type="text" name="labno[]" class="form-control" id="labno_<?php echo $material_count;?>" value="<?php echo $row['lab_no']; ?>" disabled style="width: 160px;">
			</td>
			<td>
			<?php 
		 $test_query="select * from span_material_assign WHERE `isdeleted`=0 AND `lab_no`='$row[lab_no]' AND `report_no`='$report_no' AND `job_number`='$job_number' ORDER BY material_assign_id DESC";
		$result_for_test=mysqli_query($conn,$test_query);
		$print_test="";
		while($rows=mysqli_fetch_array($result_for_test))
		{
			
		$sel_test="select * from test_master where `test_id`=".$rows['test'];
		$result_test=mysqli_query($conn,$sel_test);
		$row_test=mysqli_fetch_array($result_test);
			
			echo $row_test['test_name']." , ";
			$print_test .=$row_test['test_name']." , ";
		}
		
		?>
		<input type="hidden" name="testlist[]" class="form-control" id="testlist_<?php echo $material_count;?>" value="<?php echo $print_test; ?>">
			
		</td>
			
			<td>
			  <input type="text" name="expdate[]" class="form-control expdate_class" id="expdate_<?php echo $material_count;?>" value="<?php echo date('d-m-Y',strtotime($row['expected_date'])); ?>" style="width: 120px;" data-id="<?php echo $row['final_material_id'];?>">
			</td>
			<td>
			<?php
			if($row['light_status']=="0" || $row['light_status']=="1"){
			?>
			<a href="javascript:void(0)" class="btn btn-primary update_light_status" data-id="<?php echo $row['final_material_id']."|".$report_no;?>">Save</a>
		<?php }else{ ?>
				<span style="color:green;">Completed</span>
		<?php }?>
			</td>
			
		  </tr>
		<?php 
		$material_count++;
		} ?>
		<tr>
		<td colspan="4" style="text-align:center;">
		<br>
		<a href="lab_material_print.php?pass_id=<?php echo $_POST['abc'];?>" class="btn btn-primary" target="_blank" style="width:30%;">PRINT</a>
		</td>
		</tr>
		  </tbody>
		</table>
		<script>
		$('.expdate_class').datepicker({
			autoclose: true,
			format: 'dd-mm-yyyy'
		});
		</script>
	<?php
	}
	else  if($_POST['action_type'] == 'update_final_for_light_by_id')
	{
		//update light status
		$explode_light=explode("|",$_POST["get_attr"]);
		
		$get_attr= $explode_light[0];
		$reports_no= $explode_light[1];
		
		$update_light_in_final="update final_material_assign_master set `light_status`='2' where `final_material_id`='$get_attr' AND `light_status`='1'";
		$update_light_query=mysqli_query($conn,$update_light_in_final);
		
		$update_job_owner="update job set `job_owner`='1' where `report_no`='$reports_no' AND `jobisdeleted`='0'";
		$update_job_query=mysqli_query($conn,$update_job_owner);
		
	}
	else if($_POST['action_type'] == 'submit_data_to_second_screen')
	{
		$report_number = $_POST['r_no'];
		$job_number = $_POST['j_no'];
		$date = date("Y-m-d");
		
		$update = "UPDATE `job` SET `job_lab_progress_date`='$date',`job_lab_progress`='1' where `report_no`='$report_number' AND `job_number`='$job_number'";
		$update_data = mysqli_query($conn,$update);
	}
	else if($_POST['action_type'] == 'submit_reward')
	{
		$report_number = $_POST['r_no'];
		$job_number = $_POST['j_no'];
		$date = date("Y-m-d");
		
		$update = "UPDATE `job` SET `job_lab_progress_date`='$date',`job_lab_progress`='0' where `report_no`='$report_number' AND `job_number`='$job_number'";
		$update_data = mysqli_query($conn,$update);
	}
	else if($_POST['action_type'] == 'job_complete')
	{
		$report_number = $_POST['screen2_r_no'];
		$job_number = $_POST['screen2_j_no'];
		$date = date("Y-m-d");
		
		$update_light_in_final="update final_material_assign_master set `light_status`='2' where `report_no`='$report_number' AND `job_no`='$job_number'";
		$update_light_query=mysqli_query($conn,$update_light_in_final);
		
		$update = "UPDATE `job` SET `job_lab_progress_end_date`='$date',`report_job_printing`='1',`job_owner`='1',`eng_light_status`='2' where `report_no`='$report_number' AND `job_number`='$job_number'";
		$update_data = mysqli_query($conn,$update);
	}
	else if($_POST['action_type'] == 'update_date_by_id')
	{
		$get_date = date('Y-m-d',strtotime($_POST['get_date']));
		$final_table_id = $_POST['get_attr'];
		
		echo $update = "UPDATE `final_material_assign_master` SET `expected_date`='$get_date' where `final_material_id`='$final_table_id'";
		$update_data = mysqli_query($conn,$update);
	}
	else if($_POST['action_type'] == 'getdata_after_refresh')
	{
		?>
			<div id="test_common">
	<div class="row">
			<div class="col-md-12" style="width:100%;overflow:auto; max-height:250px;">
				<div class="table-responsive" id="display_data_pending">
					<table id="mytable" class="table table-bordred table-striped" width="100%">
						<thead>
							<th style="text-align:center;"><h3><b>Sr No.</b></h3></th>
							<th style="text-align:center;"><h3><b>Report Number</b></h3></th>
							<th style="text-align:center;"><h3><b>Job Number</b></h3></th>
							<th style="text-align:center;"><h3><b>Sample Receieved Date</b></h3></th>
							<th style="text-align:center;"><h3><b>Action</b></h3></th>
						</thead>
						<tbody>
						<?php
						$count=0;
						$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `morr`= 'm' AND `job_lab_assign`='1' AND `job_lab_progress`= '0' AND `report_job_printing`='0' ORDER BY job_id DESC";
						$result=mysqli_query($conn,$query);
						while($row=mysqli_fetch_array($result))
						{
						$count++;

						?>
						<input type="hidden" id="r_no" name="r_no" value="<?php echo $row['report_no'];?>">
						<input type="hidden" id="j_no" name="j_no" value="<?php echo $row['job_number'];?>">
						<tr>
						<td style="text-align:center;"><b><?php echo $count;?></b></td>
						<td style="white-space:nowrap;text-align:center;" ><b><?php echo $row['report_no'];?></b></td>
						<td style="white-space:nowrap;text-align:center;"><b><?php echo $row['job_number'];?></b></td>
						<td style="white-space:nowrap;text-align:center;"><b><?php 
						$date = new DateTime($row['sample_rec_date']);
						echo $date->format('d-m-Y');
						?></b></td>
						<td style="text-align:center;">
						
						<?php if($row['jobcreatedby_id']==$_SESSION['u_id']){?>
						
						<input type="button" class="btn btn-info btn-lg view_detail_from_job" data-id="<?php echo $row['report_no']."|".$row['job_number'];?>" data-toggle="modal" data-target="#myModal" value="View">
						<!--<a href="view_job_by_eng.php?report_no=<?php //echo $row['report_no'];?>&&job_no=<?php// echo $row['job_number'];?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> View</a>--->
						&nbsp;

						<input type="button" class="btn btn-success btn-lg btn3d submit_data_to_second_screen" data-id="<?php echo $row['report_no']."|".$row['job_number'];?>" title="Send To Progress" Value="Send To Progress">
						
						<?php
						}else{
							echo "****";
						}
						?>
						</td>
						</tr>
						<?php
						}	
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<section class="title-banner text-white" id="title-banner" style="background-color:#36BBFE;">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
					<h2 style="text-align: center;  color:#f9ea3e;margin-top: 5px;"><b>Work In Progress</b></h2>
				</div>
				<div class="col-md-4" style="margin-top: 7px;">
				</div>
			</div>
		</div>
	</section>
	<div class="row">
			<div class="col-md-12" style="width:100%;overflow:auto; max-height:250px;">
				<div class="table-responsive" id="second_display_data_pending">
					<table id="mytable2" class="table table-bordred table-striped" width="100%">
						<thead>
							<th style="text-align:center;"><h3><b>Sr No.</b></h3></th>
							<th style="text-align:center;"><h3><b>Report Number</b></h3></th>
							<th style="text-align:center;"><h3><b>Job Number</b></h3></th>
							<th style="text-align:center;"><h3><b>Sample Receieved Date</b></h3></th>
							<th style="text-align:center;"><h3><b>Status</b></h3></th>
							<th style="text-align:center;"><h3><b>Action</b></h3></th>
						</thead>
						<tbody>
						<?php
						$count=0;
						$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `morr`= 'm' AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='0' ORDER BY job_id DESC";
						$result=mysqli_query($conn,$query);
						while($row=mysqli_fetch_array($result))
						{
						$count++;

						?>
						<input type="hidden" id="screen2_r_no" name="r_no" value="<?php echo $row['report_no'];?>">
						<input type="hidden" id="screen2_j_no" name="j_no" value="<?php echo $row['job_number'];?>">
						<tr>
						<td style="text-align:center;"><b><?php echo $count;?></b></td>
						<td style="white-space:nowrap;text-align:center;" ><b><?php echo $row['report_no'];?></b></td>
						<td style="white-space:nowrap;text-align:center;"><b><?php echo $row['job_number'];?></b></td>
						<td style="white-space:nowrap;text-align:center;"><b><?php 
						$date = new DateTime($row['sample_rec_date']);
						echo $date->format('d-m-Y');
						?></b></td>
						<td style="white-space:nowrap;text-align:center;">
						<?php 
						
						$final_query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$row[job_number]' AND `report_no`='$row[report_no]' ORDER BY final_material_id DESC";
						$final_result=mysqli_query($conn,$final_query);
						$off=0;
						$working=0;
						$done_light=0;

						if(mysqli_num_rows($final_result)>0){
							
							while($get_row=mysqli_fetch_array($final_result))
							{
								if($get_row["light_status"]==0){
									$off=1;
									$working=0;
									$done_light=0;
								}elseif($get_row["light_status"]==1){
									$off=0;
									$working=1;
									$done_light=0;
								}elseif($get_row["light_status"]==2){
									$off=0;
									$working=0;
									$done_light=1;
								}
							}
							
						}
						
						if($off==1){
							echo '<img src="images/work_light/off.png">';
						}else if($working==1){
							echo '<img src="images/work_light/work.png">';
						}elseif($done_light==1){
							echo '<img src="images/work_light/done.png">';
						}else{
							
						}
					?>
						</td>
						<td style="text-align:center;">
						
						<?php if($row['jobcreatedby_id']==$_SESSION['u_id']){?>
						
						<input type="button" class="btn btn-warning btn-lg btn3d submit_reward" data-id="<?php echo $row['report_no']."|".$row['job_number'];?>" title="Send To Reward" Value="Reward">
						
						<input type="button" class="btn btn-info btn-lg view_detail_from_job_from_second" data-id="<?php echo $row['report_no']."|".$row['job_number'];?>" data-toggle="modal" data-target="#myModal" value="View"></input>
						<!--<a href="view_job_by_eng.php?report_no=<?php //echo $row['report_no'];?>&&job_no=<?php// echo $row['job_number'];?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> View</a>--->
						&nbsp;

						<input type="button" class="btn btn-success btn-lg btn3d job_complete" title="Job Complete" data-id="<?php echo $row['report_no']."|".$row['job_number'];?>" value="Job Complete">

						<?php
						}else{
							echo "****";
						}
						?>
						</td>
						</tr>
						<?php
						}	
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<script>
	var table = $('#mytable').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
		"oLanguage": {
   "sSearch": "Search Pending Jobs"
 }
		
    } );
	
	var table2 = $('#mytable2').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
		"oLanguage": {
   "sSearch": "Search Progressing Jobs"
 }
		
    } );
	</script>
				
		<?php
	}
	else if($_POST['action_type'] == 'submit_reward_to_rec2'){
		$clicked_id=explode("|",$_POST['abc']);
		$get_report_no=$clicked_id[0];
		
		
		
		echo $update_jobs="update job set `job_lab_assign`='0' where `report_no`='$get_report_no'";exit;
		$query_update_jobs=mysqli_query($conn,$update_jobs);
		
	
}
	
	exit;
}