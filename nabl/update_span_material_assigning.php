<?php include("header.php");?>
<?php 
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
}

if(isset($_POST["save_next"]))
{
	$txt_final_trf_no= $_POST["txt_final_trf_no"];
	$var_ex_date_submission = $_POST['ex_date_submission'];
	$date_ex_date_submission = str_replace('/', '-', $var_ex_date_submission);
	$ex_date_submission =  date('Y-m-d', strtotime($date_ex_date_submission));
	$morr= "r";
	$current_date= date('Y-m-d');
	// gt final material counts
	
   $select_mate_counts="select `final_material_id`,`material_category` from final_material_assign_master WHERE `is_deleted`=0 AND `temporary_trf_no`='$txt_final_trf_no' AND `created_by_id`='$_SESSION[u_id]' AND `report_no`='0' AND `lab_no` ='0' ORDER BY final_material_id ASC";
	
	$result_mate_counts=mysqli_query($conn,$select_mate_counts);
	$get_counts_of_materials=mysqli_num_rows($result_mate_counts);
	
		if($get_counts_of_materials > 0)
		{
			$sel_jobs="select * from job where `temporary_trf_no`='$txt_final_trf_no'";
		    $result_jobs_date=mysqli_query($conn,$sel_jobs);
		    $get_jobs_result=mysqli_fetch_array($result_jobs_date);
			$sample_rec_date=$get_jobs_result["sample_rec_date"];
			$get_tested_by=$get_jobs_result["tested_by"];
			$get_tested_status=$get_jobs_result["tested_by_status"];
			$set_trf_no=$get_jobs_result["trf_no"];
			$set_job_no=$get_jobs_result["trf_no"];
			
			$nabl_type=$get_jobs_result["nabl_type"];
			$branch_id=$get_jobs_result["branch_id"];
			
			$d= date("d", strtotime($sample_rec_date));
			$m= date("m", strtotime($sample_rec_date));
			$y= date("y", strtotime($sample_rec_date));
			
			$sel_branch = "select * from branches where `branch_id`=".$branch_id;
			$query_branch = mysqli_query($conn, $sel_branch);
			$row_branch = mysqli_fetch_array($query_branch);
			$branch_name=$row_branch["branch_name"];
			$branch_short_code=$row_branch["branch_short_code"];
			$trf_prefix_nabl=$row_branch["trf_prefix_nabl"];
			$trf_prefix_non_nabl=$row_branch["trf_prefix_non_nabl"];
						
			$final_id_array=array();
			$final_mat_cat_array=array();
			$array_tested_by=explode(",",$get_tested_by);
		    $array_tested_status=explode(",",$get_tested_status);
			
			while($one_final_id=mysqli_fetch_array($result_mate_counts))
			{
				array_push($final_id_array,$one_final_id["final_material_id"]);
				array_push($final_mat_cat_array,$one_final_id["material_category"]);
				
				$select_eng_by_mat_cat_id="select `material_engineer` from material_category where `material_cat_id`='$one_final_id[material_category]'";
				$query_eng_by_mat_cat_id=mysqli_query($conn,$select_eng_by_mat_cat_id);
				
				if(mysqli_num_rows($query_eng_by_mat_cat_id) > 0)
				{
					$result_engineers= mysqli_fetch_array($query_eng_by_mat_cat_id);
					if (!in_array("0", $array_tested_by))
					{
						array_push($array_tested_by,"0");
						array_push($array_tested_status,"0");
					}
				}
			}
			
			$implode_tested_by=implode(",",$array_tested_by);
		    $implode_tested_by_status=implode(",",$array_tested_status);
			
			// update one entry in job table
			$update_jobs="update job set `material_assign`=1,`trf_no`='$set_trf_no', `tested_by`='',`tested_by_status`='',`light_indication`='1',`material_assign`=1 where `temporary_trf_no`='$txt_final_trf_no'";
			$result_jobs=mysqli_query($conn,$update_jobs);
			
			
			if($nabl_type=="nabl")
			{
				$select_done_final="select * from final_material_assign_master WHERE `is_deleted`=0 AND `nabl_type`='$nabl_type' AND `temporary_trf_no`='$txt_final_trf_no' AND `created_by_id`='$_SESSION[u_id]' AND `lab_no` !='0' ORDER BY `max_number` DESC LIMIT 0,1";
				$result_done_final=mysqli_query($conn,$select_done_final);
				if(mysqli_num_rows($result_done_final) > 0)
				{
					$get_done_final= mysqli_fetch_assoc($result_done_final);
					$lab_no_plusing= intval($get_done_final["max_number"])+1;
					$limit_for_final =intval($get_done_final["max_number"])+ intval($get_counts_of_materials);
				}
				else
				{
					$lab_no_plusing=1;
					$limit_for_final =intval($get_counts_of_materials);
				}
				
			}
			else
			{
				$select_done_final="select * from final_material_assign_master WHERE `is_deleted`=0 AND `nabl_type`='$nabl_type'  AND `temporary_trf_no`='$txt_final_trf_no' AND `created_by_id`='$_SESSION[u_id]' AND `lab_no` !='0' ORDER BY `max_number` DESC LIMIT 0,1";
				$result_done_final=mysqli_query($conn,$select_done_final);
				if(mysqli_num_rows($result_done_final) > 0)
				{
					$get_done_final= mysqli_fetch_assoc($result_done_final);
					$lab_no_plusing= intval($get_done_final["max_number"])+1;
					$limit_for_final =intval($get_done_final["max_number"])+ intval($get_counts_of_materials);
				}
				else
				{
					$lab_no_plusing=1;
					$limit_for_final =intval($get_counts_of_materials);
				}
			}
			
			
			$counting=0;
			
			for($i=$lab_no_plusing;$i<=$limit_for_final;$i++)
			{
				if($nabl_type=="nabl")
				{
							$sel_latest="select * from final_material_assign_master where `nabl_type` ='$nabl_type' AND `lab_no` !='0' AND `rec_sam_date`='$sample_rec_date' ORDER BY `max_number` DESC LIMIT 0,1";
							$final_latest = mysqli_query($conn, $sel_latest);
							if(mysqli_num_rows($final_latest) > 0)
							{
								$latest_final = mysqli_fetch_array($final_latest);
								$max_number = intval($latest_final["max_number"]) + 1 ;
							}
							else
							{
								$max_number = 1;
							}
							
							$sel_mat_cat="select `material_category` from final_material_assign_master where `final_material_id`=".$final_id_array[$counting];
							$final_mat_cat = mysqli_query($conn, $sel_mat_cat);
							$result_mat_cat = mysqli_fetch_array($final_mat_cat);
							$get_mat_cat_id=$result_mat_cat["material_category"];
							
							$sel_cat_name="select `cat_prefix` from material_category where `material_cat_id`=".$get_mat_cat_id;
							$final_cat_name = mysqli_query($conn, $sel_cat_name);
							$result_cat_name = mysqli_fetch_array($final_cat_name);
							$get_cat_prefix=$result_cat_name["cat_prefix"];
							
							$maxs=$max_number;
							$set_last_lab= sprintf('%05d', $max_number);
							$txt_set_lab_nos= $trf_prefix_nabl.$set_last_lab;
							
							$sel_last_of_ulr="select * from ulr_sequence ORDER BY ulr_sequence_id DESC";
							$query_last_of_ulr=mysqli_query($conn,$sel_last_of_ulr);
							if(mysqli_num_rows($query_last_of_ulr) > 0)
							{
								$result_last_of_ulr=mysqli_fetch_assoc($query_last_of_ulr);
								$get_last_ulr_no= intval($result_last_of_ulr["ulr_sequence"]);
								$ulr_counts= intval($get_last_ulr_no)+1;
							}else{
								$ulr_counts= 1;
							}
							
							$txt_final_ulr_no= sprintf('%09d', $ulr_counts);
							
							$update_ulrs="update final_material_assign_master set `ulr_no`='$txt_final_ulr_no' where `final_material_id`=".$final_id_array[$counting];
							mysqli_query($conn,$update_ulrs);
							
							//insert in ulr sequence table
							$insert_ulr="insert into ulr_sequence (`ulr_sequence`,`ulr_sequence_date`,`table_primary_key_id`,`ulr_status`,`created_date`,`created_by`,`modified_date`,`modified_by`) 
							values(
							'$ulr_counts',
							'$sample_rec_date',
							'$final_id_array[$counting]',
							'2',
							'$current_date',
							'$_SESSION[u_id]',
							'$current_date',
							'$_SESSION[u_id]')";
							mysqli_query($conn,$insert_ulr);
							
				}if($nabl_type=="non_nabl")
				{
							$sel_latest="select * from final_material_assign_master where `nabl_type` ='$nabl_type' AND `lab_no` !='0' AND `rec_sam_date`='$sample_rec_date' ORDER BY `max_number` DESC LIMIT 0,1";
							$final_latest = mysqli_query($conn, $sel_latest);
							if(mysqli_num_rows($final_latest) > 0)
							{
								$latest_final = mysqli_fetch_array($final_latest);
								$max_number = intval($latest_final["max_number"]) + 1 ;
							}
							else
							{
								$max_number = 1;
							}
							
							$sel_mat_cat="select `material_category` from final_material_assign_master where `final_material_id`=".$final_id_array[$counting];
							$final_mat_cat = mysqli_query($conn, $sel_mat_cat);
							$result_mat_cat = mysqli_fetch_array($final_mat_cat);
							$get_mat_cat_id=$result_mat_cat["material_category"];
							
							$sel_cat_name="select `cat_prefix` from   material_category  where `material_cat_id`=".$get_mat_cat_id;
							$final_cat_name = mysqli_query($conn, $sel_cat_name);
							$result_cat_name = mysqli_fetch_array($final_cat_name);
							$get_cat_prefix=$result_cat_name["cat_prefix"];
							
							$maxs=$max_number;
							$set_last_lab= sprintf('%05d', $max_number);
							$txt_set_lab_nos= $trf_prefix_non_nabl.$get_cat_prefix."/".$set_last_lab;
				}
				
				
				// update final material table
				$update_final_mate="update final_material_assign_master set `trf_no`='$set_trf_no',`job_no`='$set_job_no',`lab_no`='$txt_set_lab_nos',`max_number`='$maxs',`is_status`=1 where `final_material_id`=".$final_id_array[$counting];
			    $result_final_mate=mysqli_query($conn,$update_final_mate);
				
				//update span_save_material table by final material ids
				$update_span_material="update span_material_assign set `trf_no`='$set_trf_no',`job_number`='$set_job_no',`lab_no`='$txt_set_lab_nos',`is_save`='1' where `final_material_id`='$final_id_array[$counting]'";
				$result_span_material=mysqli_query($conn,$update_span_material);
				
				
				
				$counting++;
				//$ulr_counts++;
				
			}  
			    //update test_wise_master table by temporarory trf_no
				$update_test_wise_master="update test_wise_material_rate set `trf_no`='$set_trf_no',`job_no`='$set_job_no' where `temporary_trf_no`='$txt_final_trf_no'";
				$result_test_wise_master=mysqli_query($conn,$update_test_wise_master);
				
				
				//if add more material so the ulr no set button ope to set
				$update_save_tables="update save_material_assign set `set_url`='0' where `temporary_trf_no`='$txt_final_trf_no'";
				mysqli_query($conn,$update_save_tables);
				
				//if add more material so the ulr no set button ope to set
				$update_jober="update job set `set_url`='0' where `temporary_trf_no`='$txt_final_trf_no'";
				mysqli_query($conn,$update_jober);
			
			
			
		}else
		{
			?>
			<script >
				window.location.href="<?php echo $base_url; ?>index.php";
			</script>
			<?php
		}		 
	//report no genrate code Stop
	
	?>
	<script >
	alert("TRF SAVED SUCEESSFULLY .. \n Your S.R.F. No.is : <?php echo $set_trf_no; ?>");
	window.location.href="job_listing_for_second_reception.php";
	</script>
	<?php
}

$sel_jobing="select * from job where `temporary_trf_no`='$_GET[temporary_trf_no]'";
$query_jobs=mysqli_query($conn,$sel_jobing);
$resut_jobs=mysqli_fetch_array($query_jobs);
$get_rec_date=$resut_jobs["sample_rec_date"];
$nabl_types=$resut_jobs["nabl_type"];
?>

<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}

.mede_class{
	color:red;
}
.visually-hidden {
    position: absolute;
    left: -100vw;
}

</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">
   <?php
  //set session job and report no
  ?>
<section class="content">
			<?php include("menu.php") ?>
			<div class="row">
		
		<h1 style="text-align:center;">
		Material Selection
		</h1>
	</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body"  style="border:1px groove #ddd;">
							<br>
								<div class="row">
									
									<div class="col-lg-12">
									<label for="inputEmail3" class="col-sm-2 control-label">Token No:</label>
											
										  <div class="col-sm-2">
											<input type="text" class="form-control" value="<?php echo $_GET['temporary_trf_no'];?>" id="txt_trf_no" name="txt_trf_no" readonly>
											<input type="hidden" class="form-control" value="<?php echo $nabl_types;?>" id="nabl_types" name="nabl_types">
											<input type="hidden" class="form-control" value="<?php echo $get_rec_date;?>" id="txt_rec_sam_date" name="txt_rec_sam_date" >
										  </div>
										<div class="form-group">
										
										  <!--<label for="inputEmail3" class="col-sm-2 control-label">Lab No:</label>-->
										  
										  <div class="col-sm-3">
												<div class="input-group date">
													<input type="hidden" class="form-control" value="<?php echo $_GET['temporary_trf_no'];?>" id="txt_job_no" name="txt_job_no" >
											</div>
										</div>
									</div>
								
								</div>
							</div>
							<div class="panel-group">
							  
								<a data-toggle="collapse" href="#collapse1" class="btn btn-primary" style="width:100%;margin-top: 2%;font-size: 20px;" id="add_material_button">Add Material</a>
								<div id="collapse1" class="panel-collapse collapse">
								<br>
								<form class="form" id="add_mate_form" method="post">
								
								<div class="row">
									<div class="col-md-4">
									<label for="exampleInputEmail1">Select Category<span class="mede_class">*</span>:</label>
									</div>
									<div class="col-md-4">
									<label for="exampleInputEmail1">Select Material<span class="mede_class">*</span>:</label>
									</div>
									<div class="col-md-4">
									<label for="exampleInputEmail1">Expec. submission Date:</label>
									</div>
									
								</div>
								  <div class="row">
								  <div class="col-md-4">
										<div class="form-group">
											
											<div class="col-sm-12">
												<select class="form-control select2" name="select_material_category" id="select_material_category" >
													<option value="">Select Category</option>
													<?php 
													$sql = "select * from material_category where `material_cat_status`='1' AND `material_cat_isdelete`='0'";
												
													$result = mysqli_query($conn, $sql);

													if (mysqli_num_rows($result) > 0) {
														while($row = mysqli_fetch_assoc($result)) {
													
													?>
			
													<option value="<?php echo $row['material_cat_id'];?>"><?php echo $row['material_cat_name'];?></option>
													<?php }}?>
												</select>
											</div>
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="form-group">
											
											<div class="col-sm-12">
											<select class="form-control select2" name="select_material" id="select_material">
													<option value="">Select Material</option>
													
											</select>
											<input type="hidden" id="filename" name="filename">
												
											</div>
											
										</div>
									</div>
									
								
									
									<div class="col-md-4">
										<div class="form-group">
											
											<div class="col-sm-12">
												<div class="col-sm-12">
												<input type="text"  style="height:30px;" name="ex_date_submission" id="ex_date_submission" value="<?php echo date('d/m/Y')?>">
											</div>
											</div>
										</div>
									</div>
									
										
								</div>
								<br>
								<div class="row">
									<div class="col-md-4">
									<label for="exampleInputEmail1">Sample Conditon:</label><br>
									
									</div>
									<div class="col-md-4">
									<label for="exampleInputEmail1">Location:</label><br>
									
									</div>
									
									<div class="col-md-4">
									<label for="exampleInputEmail1">Quantity:</label><br>
									
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-4">
									<div class="form-group">
											
											<div class="col-sm-12">
									<select class="form-control select2" name="select_samp_condition" id="select_samp_condition">
										<option value="">Select Conditon</option>
										<option value="1" selected>Sealed</option>
										<option value="2">Unsealed</option>
										<option value="3">Good</option>
										<option value="4">Poor</option>
									</select>
									</div>
									</div>
									</div>
									<div class="col-md-4">
									<div class="form-group">
											
											<div class="col-sm-12">
									<select class="form-control select2" name="select_location" id="select_location">
										<option value="">Select Location</option>
										<option value="1" selected>In Laboratory</option>
										<option value="2">On Site</option>
									</select>
									</div>
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="form-group">
										<div class="col-sm-12">
										<input type="text" class="" id="txt_qty" name="txt_qty" placeholder="Enter Quantity" value="1">
									    </div>
									</div>
									</div>
									
									
								</div>
								  <br>
								  
								<div class="row">
									<div class="col-md-4">
									<label for="exampleInputEmail1">Sample Note:</label><br>
									<select class="form-control select2" name="sample_note" id="sample_note">
										<option value="">Select Sample Note</option>
										<option value="The Samples have been Submitted to us by the Customer.|The above given Results Refer only to the sample submitted by the customer for testing." selected>The Samples have been Submitted to us by the Customer.</option>
										<option value="The test has been conducted on samples collected from site.|The above given results refer only to the samples collected for testing.">The test has been conducted on samples collected from site.</option>
									</select>
									</div>
								</div>
								  <br>
								<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<form class="form" id="billing" method="post">
							<div class="panel-group">
								<div class="panel panel-default">
									<br>
									<div class="panel-heading">
										<h4 class="panel-title" style="text-align:center;">
											<a data-toggle="collapse" href="#collapse2" class="btn btn-primary" style="color:white;width:100%;" aria-expanded="true"><b>Type Of Sample</b></a>
										</h4>
									</div><br>
									<div id="collapse2" class="panel-collapse collapse in" aria-expanded="true">
										<div class="panel-body" id="put_in_type_of_sample">
										</div>
									</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
								<hr style="border:var(--primary) 2px solid;">
								<div class="row">
									<div class="col-md-1">
									<label for="chk_for_star">
									Select Test<span class="mede_class" id="id_for_star"></span>:<label>
									<input type="hidden" name="txt_is_sample" id="txt_is_sample" value="0">
									<input type="checkbox" class="visually-hidden" name="chk_for_star"  id="chk_for_star" value="0">									
									</div>
									<div class="col-md-2">
									<div id="put_all_chk_box">
									</div>
									</div>
									<!--<div class="col-md-2">
									<label for="exampleInputEmail1">Admin Supply:<span class="mede_class">*</span>:</label>
									
									</div>-->
									
								<div class="col-md-3">
									<label for="exampleInputEmail1">Reported By<span class="mede_class">*</span>:</label>
									</div>
									
								</div>
								<div class="row">
								<div class="col-md-2">
										<div class="form-group">
											
											<div class="col-sm-3">
												<select class="form-control" name="select_test" id="select_test" multiple="multiple">
													
												</select>
												</div>
										</div>
								</div>
								
								
									<div class="col-md-3">
										<div class="form-group">
											
											<div class="col-sm-12">
											<select class="form-control " name="reported_by" id="reported_by" style="height:50px;">
													<!--<option value="">Select Quality Manager</option>-->
													<?php 
													$sel_staff="select * from multi_login where `staff_isadmin`='5'";
													$query_staff=mysqli_query($conn,$sel_staff);
													if(mysqli_num_rows($query_staff) > 0){
													while($rowss=mysqli_fetch_array($query_staff)){?>
													<option value="<?php echo $rowss['id']?>"><?php echo $rowss['staff_fullname']?></option>
													
													<?php }}?>
												</select>
												
											</div>
										</div>
								
								</div>
								
								
								<!--<div class="col-md-2">
										<div class="form-group">
											
											<div class="col-sm-12">
												<input type="radio" style="width:33px;height:25px;" name="radio" value="m" checked><span style="font-size:35px;" ><b>M</b></span>
												<input type="radio" style="width:33px;height:25px;"name="radio" value="r"><span style="font-size:35px;"><b>R<b></span>
											</div>
										</div>
								</div>-->
								
								<div class="col-md-2">
								<input type="hidden" name="radio" value="r">
										<div class="form-group">
											
											
										</div>
								</div>
								
								
								
								<!--<div class="col-md-4">
										<div class="form-group">
											
											<div class="col-sm-12">
												<input type="radio" style="width:33px;height:25px;" name="exel_radio" value="y"><span style="font-size:35px;" ><b>YES</b></span>
												<input type="radio" style="width:33px;height:25px;"name="exel_radio" value="n" checked><span style="font-size:35px;"><b>No<b></span>
											</div>
										</div>
								</div>-->
								</div>
								<br>
							<!--<select id="multiselectdemo" multiple="multiple">
									<option value="jQuery">jQuery tutorial</option>
												<option value="Bootstrap">Bootstrap Tips</option>
												<option value="HTML">HTML</option>
												<option value="CSS">CSS tricks</option>
												<option value="angular">Angular JS</option>
												</select>-->
								
								<div class="row">
								
								<div class="col-md-3">
										<div class="form-group">
											
											<div class="col-sm-12">
												<!--<button type="button" class="btn btn-info"  onclick="addData('add_material_assinging')" name="btn_add_data" id="btn_add_data" style="width:100%;font-size:20px;margin-left:160%;" >Add Test</button>-->
												<button type="button" class="btn btn-info"  name="btn_add_data_save" id="btn_add_data_save" style="width:100%;font-size:20px;margin-left:160%;" >Save Test</button>
											</div>
										</div>
								</div>
								</div>
								</div>
							</div>
							</form>
							<div class="row">
									<div class="col-lg-12">
									<div id="display_data">
									</div>
									</div>
							</div>
							<div class="box-footer">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<div class="col-sm-12">
												
												<!--<button type="button" class="btn btn-info"  onclick="savedata('add_material_assinging_save')" name="btn_add_data_save" id="btn_add_data_save" style="width:100%;font-size:20px;display:none;" >Save Test</button>-->
												
											</div>
										</div>
									</div>
								</div>	
							</div>
							<br>
							<br>
							<div class="row">
									<div class="col-lg-12">
									<div id="display_data_after_save">
									</div>
									</div>
							</div>
							
							
							
							<form name="frm_save" method="post" onsubmit="return confirm('Are you sure you want to Save this Material?');">
							<div class="row">
								<div class="col-lg-12">
									<input type="hidden" value="<?php echo $_GET['temporary_trf_no'];?>" name="txt_final_trf_no">
									<?php
									// set job no from report no
									//$set_job_no1=substr($_GET['report_no'],7);
									?>
									
									<!--<input type="submit" class="btn btn-info" name="final_save" id="final_save" style="width:20%;font-size:20px;margin-left: 40%;margin-bottom: 2%;display:none;" value="SAVE">-->
									 <button type="submit"  class="btn btn-info" name="save_next" id="save_next" style="width:20%;font-size:20px;margin-left: 40%;margin-bottom: 2%;display:none;" >Save
									 </button>

									
									
								</div>
							</div>
								</form>
							</div>
						
					</div>
				</div>
</section>	
</div>
  
	
<?php include("footer.php");?>
<link rel="stylesheet" href="bower_components/custom/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="bower_components/custom/bootstrap-multiselect.js"></script>
		  	  
<script>
$(function () {
    $('.select2').select2();
  });
$(document).ready(function(){
	   $('#select_test').multiselect();
	$(".only_remark").hide();
	$(".material_class").hide();
	get_span_assign_after_save();
	//get_span_assign();
	get_span_set_sam_rec_date("0","onload");
});

$('#casting_date').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy'
	})
	
$('#ex_date_submission').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy'
	})
	
	var txt_rec_sam_datess= $("#txt_rec_sam_date").val();
	var d = new Date(txt_rec_sam_datess);
	var curr_date = d.getDate();
	var curr_month = d.getMonth() + 1; //Months are zero based
	var curr_year = d.getFullYear();
	var txt_rec_sam_date=(curr_date + "/" + curr_month + "/" + curr_year);
   // on category change 
$("#select_material_category").change(function(){
      var select_material_category = $('#select_material_category').val(); 
	  var txt_report_no = $('#txt_report_no').val();
	   var txt_job_no = $('#txt_job_no').val();
	   $('#txt_qty').val("1");
	   var txt_qty = $('#txt_qty').val();
	   var nabl_types = $('#nabl_types').val();
	   if(txt_qty=="0")
	  {
		  alert("Enter Quantity Properly");
		  return false;
	  }
	  if(select_material_category=="10")
	  {
		  $("#txt_qty").prop("disabled", true);
	  }else{
		  $("#txt_qty").prop("disabled", false);
	  }
	  var postData = 'action_type=get_material_by_category&select_material_category='+select_material_category+'&txt_report_no='+txt_report_no+'&txt_job_no='+txt_job_no+'&txt_qty='+txt_qty+'&nabl_types='+nabl_types;
			
			$.ajax({
				url : "<?php $base_url; ?>span_save_material.php",
				type: "POST",
				dataType:'JSON',
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					document.getElementById("overlay_div").style.display="none";
					$('#select_material').html(data.all_material);	
				    //$('#txt_lab_no').val(data.final_lab_id);
				    $('#hidden_lab_no').val(data.final_lab_id);
					$('#select_test').html(data.out_tests);
					$('#select_test').multiselect('rebuild');
					//$('#sel_tested_by').html(data.out_materials_engineer);
					$('#put_in_type_of_sample').html(data.set_type_sample);
					$('#select_test').multiselect('rebuild');

				    var set_sample_id= "#"+data.cate_prefix;
					$(".material_class").hide();
					$(set_sample_id).show();
					
					$('.casting_date').datepicker({
							autoclose: true,
							format: 'dd/mm/yyyy',
							endDate: "'"+txt_rec_sam_date+"'"
					})
					
				 }
			});
});
   // on qty change 
$("#txt_qty").change(function(){
      var select_material_category = $('#select_material_category').val(); 
	  var txt_qty = $('#txt_qty').val();
	  var filename = $('#filename').val();
	  if(txt_qty=="0")
	  {
		  alert("Enter Quantity Properly");
		  return false;
	  }
	  
	  if(select_material_category =="")
	  {
		  alert("Select Material Category..");
		  return false;
	  }
	  var postData = 'action_type=get_by_qty_change&select_material_category='+select_material_category+'&txt_qty='+txt_qty+'&filename='+filename;
			
			$.ajax({
				url : "<?php $base_url; ?>span_save_material.php",
				type: "POST",
				dataType:'JSON',
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					document.getElementById("overlay_div").style.display="none";
					
					$('#put_in_type_of_sample').html(data.set_type_sample);
					$(".material_class").hide();
					if(filename !="testings.php"){
						var set_sample_id= "#"+data.cate_prefix;
						$(set_sample_id).show();
					}else{
						$("#testings").show();
						
					}
					
					
					$('.casting_date').datepicker({
							autoclose: true,
							format: 'dd/mm/yyyy',
							endDate: "'"+txt_rec_sam_date+"'"
					})
				 
				 }
			});
});


   // only for steel materials change 
	$(document).on("change","#steel_set_qty",function(){
	var select_material_category = $('#select_material_category').val(); 
      var steel_set_qty = $('#steel_set_qty').val();
	  if(steel_set_qty=="0")
	  {
		  alert("Enter Steel Quantity Properly");
		  return false;
	  }
	  if(select_material_category =="")
	  {
		  alert("Select Material Category..");
		  return false;
	  }
	  var postData = 'action_type=get_steel_qty_by_change&&steel_set_qty='+steel_set_qty+'&select_material_category='+select_material_category;
			
			$.ajax({
				url : "<?php $base_url; ?>span_save_material.php",
				type: "POST",
				dataType:'JSON',
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					document.getElementById("overlay_div").style.display="none";
					
					$('#put_in_type_of_sample').html(data.set_type_sample);
					var set_sample_id= "#"+data.cate_prefix;
				
					$(".material_class").hide();
					$(set_sample_id).show();
				 
				 }
			});
});


// on material change

$("#select_material").change(function(){
      var select_material = $('#select_material').val(); 
      var txt_report_no = $('#txt_report_no').val(); 
	  var nabl_types = $('#nabl_types').val();
      var select_material_category = $('#select_material_category').val(); 
      var txt_job_no = $('#txt_job_no').val(); 
	  var postData = 'action_type=get_lab_by_material&select_material='+select_material+'&txt_report_no='+txt_report_no+'&select_material_category='+select_material_category+'&txt_job_no='+txt_job_no+'&nabl_types='+nabl_types;
			
			$.ajax({
				url : "<?php $base_url; ?>span_save_material.php", 
				type: "POST",
				dataType:'JSON',
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					document.getElementById("overlay_div").style.display="none";
					
					var days=parseInt(data.material_per_day_limit);
					var someDate = new Date();
					someDate.setDate(someDate.getDate() + days);
					
					var dd = someDate.getDate();
					var mm = someDate.getMonth() + 1;
					var y = someDate.getFullYear();

					var someFormattedDate = dd + '/'+ mm + '/'+ y;
					
					$('#ex_date_submission').val(someFormattedDate);
					
					$('#select_test').html(data.out_tests);
					$('#select_test').multiselect('rebuild');
					$('#filename').val(data.filename);
					get_span_set_sam_rec_date(days,"changes");
					set_for_excel();
					
				 }
			});
});

//on day changes

$("#day").change(function(){
	var get_days=$("#day").val();
	var get_set_of_cube=$("#set_of_cube").val();
	
	if(get_days !="" && get_days=="other"){
		$(".only_remark").show();
	}else{
		$(".only_remark").hide();
	}
	
	if(get_days=="7_28"){
			var multi=6;
		}else{
			var multi=3;
			
		}
		
		var set_no_of_cobe= get_set_of_cube * multi;
		$("#no_of_cube").val(set_no_of_cobe);
	
	
	
});


//on ulr no  changes

$(document).on("blur",".class_ulr",function(){
	var txt_ulr_no= $(this).val();
	if(txt_ulr_no.length !=5){
		alert("Please Enter 5 Digit In Ulr No.");
		return false;
	}
	var txt_ulr_no_ids= $(this).attr("id");
	var set_first="#first_"+txt_ulr_no_ids;
	var set_third="#third_"+txt_ulr_no_ids;
	var first_ulr= $(set_first).val();
	var third_ulr= $(set_third).val();
	
	var postData = 'action_type=update_ulr_no_by_ids&txt_ulr_no='+txt_ulr_no+'&txt_ulr_no_ids='+txt_ulr_no_ids+'&first_ulr='+first_ulr+'&third_ulr='+third_ulr;
			
		$.ajax({
				url : "<?php $base_url; ?>span_save_material.php", 
				type: "POST",
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					document.getElementById("overlay_div").style.display="none";
				 }
			});
});

//on delete final materials click

$(document).on("click",".delete_final_entry",function(){
	
	var id= $(this).attr("id");
	var postData = '&action_type=delete_final_entry&id='+id;
			
		$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This material?",
        buttons: {
			confirm: function () 
			{
				$.ajax({
						url : "<?php $base_url; ?>span_save_material.php", 
						type: "POST",
						data : postData,
						beforeSend: function(){
							document.getElementById("overlay_div").style.display="block";
						},
						success: function(data)
						 {
							document.getElementById("overlay_div").style.display="none";
							get_span_assign_after_save();
							get_span_set_sam_rec_date("0","onload");
						 }
					});
			},
            cancel: function () {
				return;
            }
			}
        })
});


// on set of cube blur
$(document).on("blur","#set_of_cube",function(){
	var get_days=$("#day").val();
	var get_set_of_cube=$("#set_of_cube").val();
	
	if(get_days !=""){
		if(get_days=="7_28"){
			var multi=6;
		}else{
			var multi=3;
			
		}
		
		var set_no_of_cobe= get_set_of_cube * multi;
		$("#no_of_cube").val(set_no_of_cobe);
		
	}else{
		alert("Select Days");
		$("#no_of_cube").val(0);
		return false;
	}
	
	
	
});

// add data
function addData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add_material_assinging') {
				var txt_trf_no = $('#txt_trf_no').val(); 
				var txt_job_no = $('#txt_job_no').val(); 
				var select_material_category = $('#select_material_category').val(); 
				var select_material = $('#select_material').val(); 
				//var txt_lab_no = $('#txt_lab_no').val(); 
				var type_of_cement = $('#type_of_cement').val(); 
				var cement_grade = $('#cement_grade').val(); 
				var cement_brand = $('#cement_brand').val(); 
				var week_no = $('#week_no').val(); 
				var brick_source = $('#brick_source').val(); 
				var sample_de = $('#sample_de').val(); 
				var mark = $('#mark').val();
				var brick_specification = $('#brick_specification').val();
				var tanker_no = $('#tanker_no').val();
				var lot_no = $('#lot_no').val();
				var bitumin_grade = $('#bitumin_grade').val();
				var make = $('#make').val();
				
				
				var tanker_no1 = $('#tanker_no1').val();
				var lot_no1 = $('#lot_no1').val();
				var bitumin_grade1 = $('#bitumin_grade1').val();
				var make1 = $('#make1').val();
				
				var cube_grade = $('#cube_grade').val();
				var day_remark = $('#day_remark').val();
				var casting_date = $('#casting_date').val();
				var day = $('#day').val();
				var set_of_cube = $('#set_of_cube').val();
				var no_of_cube = $('#no_of_cube').val();
				var cc_identification = $('#cc_identification').val();
				var chainage_no = $('#chainage_no').val();
				var fdd_desc_sample = $('#fdd_desc_sample').val();
				var shape = $('#shape').val();
				var age = $('#age').val();
				var color = $('#color').val();
				var thickness = $('#thickness').val();
				var paver_grade = $('#paver_grade').val();
				var sample_type = $('#sample_type').val();
				var soil_source = $('#soil_source').val();
				var dia = $('#dia').val();
				var steel_grade = $('#steel_grade').val();
				var steel_brand = $('#steel_brand').val();
				var tile_source = $('#tile_source').val();
				var tiles_specification = $('#tiles_specification').val();
				var fine_agg_source = $('#fine_agg_source').val();
				var fine_agg_type = $('#fine_agg_type').val();
				var qa_spall_source = $('#qa_spall_source').val();
				var bitumin_mix = $('#bitumin_mix').val();
				var tiles_specification = $('#tiles_specification').val();
				var brand = $('#brand').val();
				var select_test = $('#select_test').val();
				var select_samp_condition = $('#select_samp_condition').val();
				var select_location = $('#select_location').val();
				var sample_note = $('#sample_note').val();
				var txt_is_sample = $('#txt_is_sample').val();
				
				
				var tested_by = "0";
				var reported_by = $('#reported_by').val();
				var ex_date_submission = $('#ex_date_submission').val();
				var chkmorr = $("input[name='radio']:checked").val();
				var exel_radio = "n";
				
				// condition for steel_brand
				/*if(select_material_category !="" && select_material_category =="10" && dia=="")
				{
					alert("Please Enter Dia First...");
					return false;
				}*/
				
				
				// condition for cube and flexure
				if(select_material_category =="5" && select_material =="129" && casting_date=="")
				{
					alert("Please Enter Casting Date  First...");
					return false;
				}else{
					
					if(casting_date=="")
					{
						casting_date="0000-00-00";
					}
					
				}
				
				// condition for cube and flexure
				if(select_material_category =="5" && select_material =="143" && casting_date=="")
				{
					alert("Please Enter Casting Date  First...");
					return false;
				}else{
					
					if(casting_date=="")
					{
						casting_date="0000-00-00";
					}
					
				}
				
			
				if(txt_trf_no !="" && select_material_category !="" && select_material !=""&& select_test !="" && tested_by !=""&& reported_by !=""){
					
				billData = '&action_type='+type+'&id='+id+'&txt_trf_no='+txt_trf_no+'&txt_job_no='+txt_job_no+'&select_material_category='+select_material_category+'&select_material='+select_material+'&type_of_cement='+type_of_cement+'&cement_grade='+cement_grade+'&cement_brand='+cement_brand+'&week_no='+week_no+'&brick_source='+brick_source+'&mark='+mark+'&brick_specification='+brick_specification+'&tanker_no='+tanker_no+'&lot_no='+lot_no+'&bitumin_grade='+bitumin_grade+'&make='+make+'&cube_grade='+cube_grade+'&day_remark='+day_remark+'&casting_date='+casting_date+'&day='+day+'&set_of_cube='+set_of_cube+'&no_of_cube='+no_of_cube+'&shape='+shape+'&age='+age+'&color='+color+'&thickness='+thickness+'&paver_grade='+paver_grade+'&sample_type='+sample_type+'&dia='+dia+'&steel_grade='+steel_grade+'&steel_brand='+steel_brand+'&tile_source'+tile_source+'&tiles_specification='+tiles_specification+'&brand='+brand+'&select_test='+select_test+'&tested_by='+tested_by+'&reported_by='+reported_by+'&ex_date_submission='+ex_date_submission+'&chkmorr='+chkmorr+'&exel_radio='+exel_radio+'&fine_agg_source='+fine_agg_source+'&qa_spall_source='+qa_spall_source+'&select_samp_condition='+select_samp_condition+'&select_location='+select_location+'&bitumin_mix='+bitumin_mix+'&txt_is_sample='+txt_is_sample+'&cc_identification='+cc_identification+'&chainage_no='+chainage_no+'&fine_agg_type='+fine_agg_type+'&fdd_desc_sample='+fdd_desc_sample+'&sample_de='+sample_de+'&soil_source='+soil_source+'&sample_note='+sample_note+'&tanker_no1='+tanker_no1+'&lot_no1='+lot_no1+'&bitumin_grade1='+bitumin_grade1+'&make1='+make1;
				}else{
					alert(" All Filled Required");
					return false;
				}
				
				//exit();
				
    }else{
				
	
				billData = 'action_type='+type+'&id='+id;
				
    }
     $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: billData,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},
        success:function(msg){
		document.getElementById("overlay_div").style.display="none";
          get_span_assign();
		 // $("#btn_add_data_save").css("display", "block");
        }
    }); 
}


//save in final

$(document).on("click","#btn_add_data_save",function(){
    
				var txt_trf_no = $('#txt_trf_no').val(); 
				var txt_job_no = $('#txt_job_no').val(); 
				var select_material_category = $('#select_material_category').val(); 
				var select_material = $('#select_material').val(); 
				var txt_qty = $('#txt_qty').val(); 
				if(txt_qty=="0")
				{
					alert("Enter Quality properly");
					return false;
				}
				
				var type_of_cement=[];
				$(".type_of_cement").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					type_of_cement.push(get_value);
				}); 
				
				var cement_grade=[];
				$(".cement_grade").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					cement_grade.push(get_value);
				}); 
				
				var cement_brand=[];
				$(".cement_brand").each(function () {
					if($(this).val()!=""){
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					cement_brand.push(get_value);
					}
				}); 
				
				var week_no=[];
				$(".week_no").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					week_no.push(get_value);
				}); 
				
				var brick_source=[];
				$(".brick_source").each(function () {
					var get_values=$(this).val();
					
					var get_value = get_values.replaceAll(/,/g, '|');
					brick_source.push(get_value);
				}); 
				
				var sample_de=[];
				$(".sample_de").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					sample_de.push(get_value);
				}); 
				
				var mark=[];
				$(".mark").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					mark.push(get_value);
				}); 
				
				var brick_specification=[];
				$(".brick_specification").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					brick_specification.push(get_value);
				}); 
				
				var brick_size=[];
				$(".brick_size").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					brick_size.push(get_value);
				}); 
				
				var tanker_no=[];
				$(".tanker_no").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					tanker_no.push(get_value);
				}); 
				
				var lot_no=[];
				$(".lot_no").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					lot_no.push(get_value);
				}); 
				
				var bitumin_grade=[];
				$(".bitumin_grade").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					bitumin_grade.push(get_value);
				}); 
				
				var make=[];
				$(".make").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					make.push(get_value);
				}); 
				
				
				
				var tanker_no1=[];
				$(".tanker_no1").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					tanker_no1.push(get_value);
				}); 
				
				var lot_no1=[];
				$(".lot_no1").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					lot_no1.push(get_value);
				}); 
				
				var bitumin_grade1=[];
				$(".bitumin_grade1").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					bitumin_grade1.push(get_value);
				}); 
				
				var make1=[];
				$(".make1").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					make1.push(get_value);
				}); 
				
				var cube_grade=[];
				$(".cube_grade").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					cube_grade.push(get_value);
				}); 
				
				var day_remark=[];
				$(".day_remark").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					day_remark.push(get_value);
				}); 
				
				var casting_date=[];
				$(".casting_date").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					casting_date.push(get_value);
				}); 
				
				var day=[];
				$(".day").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					day.push(get_value);
				}); 
				
				var set_of_cube=[];
				$(".set_of_cube").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					set_of_cube.push(get_value);
				}); 
				
				var no_of_cube=[];
				$(".no_of_cube").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					no_of_cube.push(get_value);
				}); 
				
				var cc_identification=[];
				$(".cc_identification").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					cc_identification.push(get_value);
				}); 
				
				var chainage_no=[];
				$(".chainage_no").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					chainage_no.push(get_value);
				}); 
				
				var fdd_desc_sample=[];
				$(".fdd_desc_sample").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					fdd_desc_sample.push(get_value);
				}); 
				
				var fdd_qty=[];
				$(".class_qty").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					fdd_qty.push(get_value);
				}); 
				
				var shape=[];
				$(".shape").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					shape.push(get_value);
				}); 
				
				var age=[];
				$(".age").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					age.push(get_value);
				}); 
				
				var color=[];
				
				$(".color").each(function () {
					if($(this).val() !=""){
						var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					color.push(get_value);
					}
				}); 
				
				
				var thickness=[];
				$(".thickness").each(function () {
					if($(this).val() !=""){
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					thickness.push(get_value);
					}
				}); 
				
				var paver_grade=[];
				$(".paver_grade").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					paver_grade.push(get_value);
				}); 
				
				var sample_type=[];
				$(".sample_type").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					sample_type.push(get_value);
				}); 
				
				var soil_source=[];
				$(".soil_source").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					soil_source.push(get_value);
				}); 
				
				var dia=[];
				$(".dia").each(function () {
					if($(this).val()!=""){
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					dia.push(get_value);
					}
				}); 
				
				var steel_grade=[];
				$(".steel_grade").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					steel_grade.push(get_value);
				}); 
				
				var steel_brand=[];
				$(".steel_brand").each(function () {
					if($(this).val()!=""){
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					steel_brand.push(get_value);
					}
				}); 
				
				
				
				var steel_heat=[];
				$(".steel_heat").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					steel_heat.push(get_value);
				}); 
				
				var steel_sample_qty=[];
				$(".steel_sample_qty").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					steel_sample_qty.push(get_value);
				}); 
				
				var tile_source=[];
				$(".tile_source").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					tile_source.push(get_value);
				}); 
				
				var tiles_specification=[];
				$(".tiles_specification").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					tiles_specification.push(get_value);
				}); 
				
				var fine_agg_source=[];
				$(".fine_agg_source").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					fine_agg_source.push(get_value);
				}); 
				
				var fine_agg_type=[];
				$(".fine_agg_type").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					fine_agg_type.push(get_value);
				}); 
				
				var qa_spall_source=[];
				$(".qa_spall_source").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					qa_spall_source.push(get_value);
				}); 
				
				var bitumin_mix=[];
				$(".bitumin_mix").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					bitumin_mix.push(get_value);
				}); 
				
				var brand=[];
				$(".brand").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					brand.push(get_value);
				});
				
				var core_qty=[];
				$(".core_qty").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					core_qty.push(get_value);
				});
				
				var bitu_qty=[];
				$(".bitu_qty").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					bitu_qty.push(get_value);
				});
				
				var ultra_qty=[];
				$(".ultra_qty").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					ultra_qty.push(get_value);
				});
				
				var rebound_qty=[];
				$(".rebound_qty").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					rebound_qty.push(get_value);
				});
				
				var carbo_qty=[];
				$(".carbo_qty").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					carbo_qty.push(get_value);
				});
				
				var c_thick_qty=[];
				$(".c_thick_qty").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					c_thick_qty.push(get_value);
				});
				
				var half_cell_qty=[];
				$(".half_cell_qty").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					half_cell_qty.push(get_value);
				});
				
				var pile_qty=[];
				$(".pile_qty").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					pile_qty.push(get_value);
				});
				
				var pull_qty=[];
				$(".pull_qty").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					pull_qty.push(get_value);
				});
				
				var cc_qty=[];
				$(".cc_qty").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					cc_qty.push(get_value);
				});
				
				var grd_zone=[];
				$(".grd_zone").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					grd_zone.push(get_value);
				});
				
				var in_l=[];
				$(".in_l").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					in_l.push(get_value);
				});
				
				var in_w=[];
				$(".in_w").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					in_w.push(get_value);
				});
				
				var in_h=[];
				$(".in_h").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					in_h.push(get_value);
				});
				
				var in_den=[];
				$(".in_den").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					in_den.push(get_value);
				});
				
				var in_grade=[];
				$(".in_grade").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					in_grade.push(get_value);
				});
				
				var inl=[];
				$(".inl").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					inl.push(get_value);
				});
				
				var inw=[];
				$(".inw").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					inw.push(get_value);
				});
				
				var inh=[];
				$(".inh").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					inh.push(get_value);
				});
				
				var inden=[];
				$(".inden").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					inden.push(get_value);
				});
				
				var ingrade=[];
				$(".ingrade").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					ingrade.push(get_value);
				});
				
				var excel_description=[];
				$(".excel_description").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					excel_description.push(get_value);
				});
				
				var excel_qty=[];
				$(".excel_qty").each(function () {
					var get_values=$(this).val();
					var get_value = get_values.replaceAll(/,/g, '|');
					excel_qty.push(get_value);
				});
				
				
				
				var select_test = $('#select_test').val();
				var select_samp_condition = $('#select_samp_condition').val();
				var select_location = $('#select_location').val();
				var sample_note = $('#sample_note').val();
				var txt_is_sample = $('#txt_is_sample').val();
				
				var tested_by = "0";
				var reported_by =$('#reported_by').val();;
				var ex_date_submission = $('#ex_date_submission').val();
				var chkmorr = $("#radio").val();
				var exel_radio = $("input[name='exel_radio']:checked").val();
				var steel_source_name = $("#steel_source").val();
				

				if(select_material =="")
				{
					alert("Please Select Material");
					return false;
				}
				
				if(select_test =="")
				{
					alert("Please Select Test");
					return false;
				}

				if(tested_by =="")
				{
					alert("Please Select Engineer");
					return false;
				}

				if(reported_by =="")
				{
					alert("Please Select Qm");
					return false;
				}
				
				// condition for steel_brand
				//if(select_material_category !="" && select_material_category =="10" && dia=="")
				//{
				//	alert("Please Enter Dia First...");
				//	return false;
				//}
				
				// condition for cube and flexure
				if(select_material_category =="5" && select_material =="129" && casting_date=="")
				{
					alert("Please Enter Casting Date  First...");
					return false;
				}else{
					
					if(casting_date=="")
					{
						casting_date="0000-00-00";
					}
					
				}
				
				// condition for cube and flexure
				if(select_material_category =="5" && select_material =="143" && casting_date=="")
				{
					alert("Please Enter Casting Date  First...");
					return false;
				}else{
					
					if(casting_date=="")
					{
						casting_date="0000-00-00";
					}
					
				}
					
				
				//var qty = prompt("ENTER QUANTITY","1");
				var qty = txt_qty;
				if(qty == null)
				{
					alert("Process Cancel Successfully.");
				}
				else
				{
						if (qty != null || qty != "") {
							
								if(qty!=0)
								{
									
						
										if(!isNaN(qty))
										{
													billData = '&action_type=add_material_assinging_save&txt_trf_no='+txt_trf_no+'&txt_job_no='+txt_job_no+'&select_material_category='+select_material_category+'&select_material='+select_material+'&ex_date_submission='+ex_date_submission+'&qty='+qty+'&type_of_cement='+type_of_cement+'&cement_grade='+cement_grade+'&cement_brand='+cement_brand+'&week_no='+week_no+'&brick_source='+brick_source+'&mark='+mark+'&brick_specification='+brick_specification+'&tanker_no='+tanker_no+'&lot_no='+lot_no+'&bitumin_grade='+bitumin_grade+'&make='+make+'&cube_grade='+cube_grade+'&day_remark='+day_remark+'&casting_date='+casting_date+'&day='+day+'&set_of_cube='+set_of_cube+'&no_of_cube='+no_of_cube+'&shape='+shape+'&age='+age+'&color='+color+'&thickness='+thickness+'&paver_grade='+paver_grade+'&sample_type='+sample_type+'&dia='+dia+'&steel_grade='+steel_grade+'&steel_brand='+steel_brand+'&steel_heat='+steel_heat+'&steel_sample_qty='+steel_sample_qty+'&tiles_specification='+tiles_specification+'&brand='+brand+'&select_test='+select_test+'&tested_by='+tested_by+'&reported_by='+reported_by+'&chkmorr='+chkmorr+'&exel_radio='+exel_radio+'&fine_agg_source='+fine_agg_source+'&qa_spall_source='+qa_spall_source+'&select_samp_condition='+select_samp_condition+'&select_location='+select_location+'&bitumin_mix='+bitumin_mix+'&txt_is_sample='+txt_is_sample+'&cc_identification='+cc_identification+'&chainage_no='+chainage_no+'&fine_agg_type='+fine_agg_type+'&fdd_desc_sample='+fdd_desc_sample+'&sample_de='+sample_de+'&soil_source='+soil_source+'&fdd_qty='+fdd_qty+'&cc_qty='+cc_qty+'&steel_set_qty='+steel_set_qty+'&grd_zone='+grd_zone+'&in_l='+in_l+'&in_h='+in_w+'&in_w='+in_w+'&in_den='+in_den+'&in_grade='+in_grade+'&inl='+inl+'&inh='+inh+'&inw='+inw+'&inden='+inden+'&ingrade='+ingrade+'&steel_source_name='+steel_source_name+'&brick_size='+brick_size+'&excel_description='+excel_description+'&excel_qty='+excel_qty+'&sample_note='+sample_note+'&tanker_no1='+tanker_no1+'&lot_no1='+lot_no1+'&bitumin_grade1='+bitumin_grade1+'&make1='+make1;
													
															 $.ajax({
													type: 'POST',
													url: '<?php $base_url; ?>span_save_material.php',
													data: billData,
													beforeSend: function(){
													//document.getElementById("overlay_div").style.display="block";
													},
													success:function(msg){
													  document.getElementById("overlay_div").style.display="none";
													  $('#display_data').html("");
													  $("#add_mate_form")[0].reset();
													  $("#add_material_button").click();
													// $("#btn_add_data_save").css("display", "none");
													 $("#final_save").css("display", "block");
													 $("#save_next").css("display", "block");
													 $("#after_save_portion").css("display", "block");
														get_span_assign_after_save();
														get_span_set_sam_rec_date("0","onload");
													}														
												});
										}
										else
										{
											alert("Please Input Valid Quantity.");
										}
									
								}
								else
								{
									alert("Please Input Valid Quantity.");
								}
						}
						else
						{
								alert("Please Input Valid Quantity.");
						}
				}
				
    
   
});

function savedata(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add_material_assinging_save') {
				var txt_trf_no = $('#txt_trf_no').val(); 
				var txt_job_no = $('#txt_job_no').val(); 
				var select_material_category = $('#select_material_category').val(); 
				var select_material = $('#select_material').val(); 
				//var txt_lab_no = $('#txt_lab_no').val(); 	
				//6/4
				var type_of_cement = $('#type_of_cement').val(); 
				var cement_grade = $('#cement_grade').val(); 
				var cement_brand = $('#cement_brand').val(); 
				var week_no = $('#week_no').val(); 
				var brick_source = $('#brick_source').val(); 
				var sample_de = $('#sample_de').val(); 
				var mark = $('#mark').val();
				var brick_specification = $('#brick_specification').val();
				var tanker_no = $('#tanker_no').val();
				var lot_no = $('#lot_no').val();
				var bitumin_grade = $('#bitumin_grade').val();
				var make = $('#make').val();
				
				var tanker_no1 = $('#tanker_no1').val();
				var lot_no1 = $('#lot_no1').val();
				var bitumin_grade1 = $('#bitumin_grade1').val();
				var make1 = $('#make1').val();
				
				var cube_grade = $('#cube_grade').val();
				var day_remark = $('#day_remark').val();
				var casting_date = $('#casting_date').val();
				var day = $('#day').val();
				var set_of_cube = $('#set_of_cube').val();
				var no_of_cube = $('#no_of_cube').val();
				var cc_identification = $('#cc_identification').val();
				var chainage_no = $('#chainage_no').val();
				var fdd_desc_sample = $('#fdd_desc_sample').val();
				var shape = $('#shape').val();
				var age = $('#age').val();
				var color = $('#color').val();
				var thickness = $('#thickness').val();
				var paver_grade = $('#paver_grade').val();
				var sample_type = $('#sample_type').val();
				var soil_source = $('#soil_source').val();
				var dia = $('#dia').val();
				var steel_grade = $('#steel_grade').val();
				var steel_brand = $('#steel_brand').val();
				var tile_source = $('#tile_source').val();
				var tiles_specification = $('#tiles_specification').val();
				var fine_agg_source = $('#fine_agg_source').val();
				var fine_agg_type = $('#fine_agg_type').val();
				var qa_spall_source = $('#qa_spall_source').val();
				var bitumin_mix = $('#bitumin_mix').val();
				var brand = $('#brand').val();
				var select_test = $('#select_test').val();
				var select_samp_condition = $('#select_samp_condition').val();
				var select_location = $('#select_location').val();
				var sample_note = $('#sample_note').val();
				var txt_is_sample = $('#txt_is_sample').val();
				
				var tested_by = "0";
				var reported_by = $('#reported_by').val();
				var ex_date_submission = $('#ex_date_submission').val();
				var chkmorr = $("input[name='radio']:checked").val();
				var exel_radio = $("input[name='exel_radio']:checked").val();
				
				// condition for steel_brand
				/*if(select_material_category !="" && select_material_category =="10" && dia=="")
				{
					alert("Please Enter Dia First...");
					return false;
				}*/
				
				// condition for cube and flexure
				if(select_material_category =="5" && select_material =="129" && casting_date=="")
				{
					alert("Please Enter Casting Date  First...");
					return false;
				}else{
					
					if(casting_date=="")
					{
						casting_date="0000-00-00";
					}
					
				}
				
				// condition for cube and flexure
				if(select_material_category =="5" && select_material =="143" && casting_date=="")
				{
					alert("Please Enter Casting Date  First...");
					return false;
				}else{
					
					if(casting_date=="")
					{
						casting_date="0000-00-00";
					}
					
				}
					
				
				var qty = prompt("ENTER QUANTITY","1");
				if(qty == null)
				{
					alert("Process Cancel Successfully.");
				}
				else
				{
						if (qty != null || qty != "") {
							
								if(qty!=0)
								{
									if(qty > 1)
									{
						
										if(!isNaN(qty))
										{
													billData = '&action_type='+type+'&id='+id+'&txt_trf_no='+txt_trf_no+'&txt_job_no='+txt_job_no+'&select_material_category='+select_material_category+'&select_material='+select_material+'&ex_date_submission='+ex_date_submission+'&qty='+qty+'&type_of_cement='+type_of_cement+'&cement_grade='+cement_grade+'&cement_brand='+cement_brand+'&week_no='+week_no+'&brick_source='+brick_source+'&mark='+mark+'&brick_specification='+brick_specification+'&tanker_no='+tanker_no+'&lot_no='+lot_no+'&bitumin_grade='+bitumin_grade+'&make='+make+'&cube_grade='+cube_grade+'&day_remark='+day_remark+'&casting_date='+casting_date+'&day='+day+'&set_of_cube='+set_of_cube+'&no_of_cube='+no_of_cube+'&shape='+shape+'&age='+age+'&color='+color+'&thickness='+thickness+'&paver_grade='+paver_grade+'&sample_type='+sample_type+'&dia='+dia+'&steel_grade='+steel_grade+'&steel_brand='+tile_source+'&tiles_specification='+tiles_specification+'&brand='+brand+'&select_test='+select_test+'&tested_by='+tested_by+'&reported_by='+reported_by+'&ex_date_submission='+ex_date_submission+'&chkmorr='+chkmorr+'&exel_radio='+exel_radio+'&fine_agg_source='+fine_agg_source+'&qa_spall_source='+qa_spall_source+'&select_samp_condition='+select_samp_condition+'&select_location='+select_location+'&bitumin_mix='+bitumin_mix+'&txt_is_sample='+txt_is_sample+'&cc_identification='+cc_identification+'&chainage_no='+chainage_no+'&fine_agg_type='+fine_agg_type+'&fdd_desc_sample='+fdd_desc_sample+'&sample_de='+sample_de+'&soil_source='+soil_source+'&sample_note='+sample_note+'&tanker_no1='+tanker_no1+'&lot_no1='+lot_no1+'&bitumin_grade1='+bitumin_grade1+'&make1='+make1;
													
															 $.ajax({
													type: 'POST',
													url: '<?php $base_url; ?>span_save_material.php',
													data: billData,
													beforeSend: function(){
													//document.getElementById("overlay_div").style.display="block";
													},
													success:function(msg){
													  document.getElementById("overlay_div").style.display="none";
													  $('#display_data').html("");
													  $("#add_mate_form")[0].reset();
													  $("#add_material_button").click();
													 $("#btn_add_data_save").css("display", "none");
													 $("#final_save").css("display", "block");
													 $("#save_next").css("display", "block");
													 $("#after_save_portion").css("display", "block");
														get_span_assign_after_save();
														get_span_set_sam_rec_date("0","onload");
													}														
												});
										}
										else
										{
											alert("Please Input Valid Quantity.");
										}
									}
									else
									{
										
										//PUT SUCEESS DATA OVER HERE
										
										$('#display_data').html("");
										$("#add_mate_form")[0].reset();
										$("#add_material_button").click();
										$("#btn_add_data_save").css("display", "none");
										$("#final_save").css("display", "block");
										$("#save_next").css("display", "block");
										$("#after_save_portion").css("display", "block");
									    get_span_assign_after_save();
										get_span_set_sam_rec_date("0","onload");
									}
								}
								else
								{
									alert("Please Input Valid Quantity.");
								}
						}
						else
						{
								alert("Please Input Valid Quantity.");
						}
				}
				
    }
   
}



function get_span_assign_after_save(){
		
		var str= '<?php echo $_GET["temporary_trf_no"]?>';
		var txt_jb_id= str;
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=get_span_assign_after_save&temporary_trf_no='+str,
        success:function(html){
            $('#display_data_after_save').html(html);
        }
    });
}

function get_span_set_sam_rec_date(first,second){
		
		var str= '<?php echo $_GET["temporary_trf_no"]?>';
		var txt_jb_id= str;
		var first= first;
		var second= second;
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=get_span_set_sam_rec_date&temporary_trf_no='+str+'&first='+first+'&second='+second,
        success:function(html){
			//alert(html);
            $('#ex_date_submission').val(html);
        }
    });
}

function set_for_excel(){
	var filename= $("#filename").val();
	var txt_qty= $("#txt_qty").val();
	if(filename=="testings.php")
	{
		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>span_save_material.php',
			data: 'action_type=set_for_excel&filename='+filename+'&txt_qty='+txt_qty,
			dataType:'JSON',
			success:function(html){
				$('#put_in_type_of_sample').html(html.set_type_sample);
				$(".material_class").hide();
				$("#txt_qty").prop("disabled", false);
				$("#testings").show();
			}
		});
	}else{
		//$("#txt_qty").prop("disabled", true);
	}

}

function get_span_assign(){
		var str= '<?php echo $_GET["temporary_trf_no"]?>';
		var txt_jb_id= str;
		
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=get_span_assign&temporary_trf_no='+str,
        success:function(html){
            $('#display_data').html(html);
        }
    });
}


   // $(".open .dropdown-menu checkbox").prop('checked', $(this).prop("checked")); 


$(document).on('click','.all_chk', function(event){
   
	//$('.multiselect-container .multiselect-container').prop('checked', this.checked);
	$('#select_test checkbox').prop('selected',true);
});


$('#chk_for_star').click(function() {
   
	var txt_is_sample= $("#txt_is_sample").val();
	
	if(txt_is_sample=="0")
	{
		$("#txt_is_sample").val("1");
		$('#id_for_star').text('*');
	}else
	{
		$("#txt_is_sample").val("0");
		$('#id_for_star').text('');
	}
});

$(document).on('change','#steeling_id', function(){
	var steeling_id= $("#steeling_id").val();
	$('.steel_grade').html('<option value="'+steeling_id+'">'+steeling_id+'</option>');
	
});
	
</script>
