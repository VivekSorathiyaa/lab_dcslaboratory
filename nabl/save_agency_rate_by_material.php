<?php
session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'search_agency'){
		
				$sel_agency= $_POST["sel_agency"];
				$rate_type= $_POST["rate_type"];
				$template_code= $_POST["template_code"];
				$less= $_POST["less"];
				$plus= $_POST["plus"];
				
				$sel_agency_wise="select * from agency_rate_by_material where `rate_type`='$rate_type' AND `agency_id`='$sel_agency'";
				$query_agency_wise=mysqli_query($conn,$sel_agency_wise);
				if(mysqli_num_rows($query_agency_wise)> 0)
				{
					
					$var_design='<table id="example2" class="table table-bordered table-striped" style="width:100%;">
											<thead>
											<tr>
												<th style="text-align:center;">Material Name</th>
												<th style="text-align:center;">Rate Type</th>	
												<th style="text-align:center;">Old Rate</th>	
												<th style="text-align:center;">New Rate</th>
											</tr>
										</thead>
										<tbody>';
					while($get_agency_wise=mysqli_fetch_array($query_agency_wise))
					{
						
					$var_design .='<tr>';
					$var_design .='<td style="text-align:center">'.$get_agency_wise["material_name"].'</td>';
					$var_design .='<td style="text-align:center">';
					if($get_agency_wise["rate_type"]=="0"){
						$var_design .="Government";
					}else{
						$var_design .="Private";						
					}
					$var_design .='</td>';
					$var_design .='<td style="text-align:center">'.$get_agency_wise["old_rate"].'</td>';
					$var_design .='<td style="text-align:center"><input type="text" name="txt_new_rate[]" class="change_rate_class" data-id="'.$get_agency_wise["agency_rate_id"].'" value="'.$get_agency_wise["new_rate"].'"></td>';
					$var_design .='</tr>';

					
					}					
										
										
										
					$var_design .='</tbody></table>';
					
					
					echo json_encode(array("var_design"=> $var_design));
				}else{
					
					$sel_test="select * from material";
					$query_test=mysqli_query($conn,$sel_test);
					
					if(mysqli_num_rows($query_test)> 0){
						
						while($get_test= mysqli_fetch_array($query_test))
						{
									
							if($rate_type=="0")
							{
								$achive_rate= $get_test["rate_govt"];  // get government rate
							}else
							{
								$achive_rate= $get_test["rate_private"];  // get Private rate	
							}
							
							if($less !="")
							{
								$new_rate= $achive_rate - ($achive_rate * $less / 100); // get less % if it is not not blank
								
								
							}else{
								
								$new_rate= $achive_rate + ($achive_rate * $plus / 100); // get Plus % if it is not not blank
							}	
							$ins_agency_rate="insert into agency_rate_by_material (`template_no`,`agency_id`,`rate_type`,`less`,`plus`,`material_id`,`material_name`,`old_rate`,`new_rate`) values('$template_code','$sel_agency','$rate_type','$less','$plus','$get_test[id]','$get_test[mt_name]','$achive_rate','$new_rate')";
							
							$result_insert_agency=mysqli_query($conn,$ins_agency_rate);
							
						}
						
					}
					
					// dispaly after insert
					$sel_agency_wise="select * from agency_rate_by_material where`rate_type`='$rate_type' AND `agency_id`='$sel_agency'";
					$query_agency_wise=mysqli_query($conn,$sel_agency_wise);
					
					$var_design='<table id="example2" class="table table-bordered table-striped" style="width:100%;">
											<thead>
											<tr>
												<th style="text-align:center;">Material Name</th>
												<th style="text-align:center;">Rate Type</th>	
												<th style="text-align:center;">Old Rate</th>	
												<th style="text-align:center;">New Rate</th>
											</tr>
										</thead>
										<tbody>';
					while($get_agency_wise=mysqli_fetch_array($query_agency_wise))
					{
					
					$var_design .='<tr>';
					$var_design .='<td style="text-align:center">'.$get_agency_wise["material_name"].'</td>';
					$var_design .='<td style="text-align:center">';
					if($get_agency_wise["rate_type"]=="0"){
						$var_design .="Government";
					}else{
						$var_design .="Private";						
					}
					$var_design .='</td>';
					$var_design .='<td style="text-align:center">'.$get_agency_wise["old_rate"].'</td>';
					$var_design .='<td style="text-align:center"><input type="text" name="txt_new_rate[]" class="change_rate_class" data-id="'.$get_agency_wise["agency_rate_id"].'" value="'.$get_agency_wise["new_rate"].'"></td>';
					$var_design .='</tr>';

					
					}					
										
										
										
					$var_design .='</tbody></table>';
					echo json_encode(array("var_design"=> $var_design));
					
				}
	}elseif($_POST['action_type'] == 'on_agency_change'){
			
			$sel_agency= $_POST["sel_agency"];
			$sel_exist_agency="select template_no,agency_id,is_active,rate_type,count(*) from agency_rate_by_material where `agency_id`='$sel_agency' GROUP BY template_no,agency_id,is_active";
			
			$query_exist_agency=mysqli_query($conn,$sel_exist_agency);
			if(mysqli_num_rows($query_exist_agency)>0){
			
				
				$exist_design='<table id="example1" class="table table-bordered table-striped" style="width:100%;">
										<thead>
										<tr>
											<th style="text-align:center;">Template No</th>
											<th style="text-align:center;">Agency Name</th>	
											<th style="text-align:center;">Rate Type</th>	
											<th style="text-align:center;">is Active</th>
											<th style="text-align:center;">Action</th>
										</tr>
									</thead>
									<tbody>';
				while($get_agency=mysqli_fetch_array($query_exist_agency))
				{
					$sel_agency_name="select * from agency_master where `isdeleted`=0 AND `agency_id`='$get_agency[agency_id]'";
					$query_agency_name=mysqli_query($conn,$sel_agency_name);
					$get_agency_name=mysqli_fetch_array($query_agency_name);
					if($get_agency["rate_type"]=="0"){ $rats="Government";}else{$rats="private";}
					$exist_design .='<tr>';
					$exist_design .='<td style="text-align:center">'.$get_agency["template_no"].'</td>';
					$exist_design .='<td style="text-align:center">'.$get_agency_name["agency_name"].'</td>';
					$exist_design .='<td style="text-align:center">'.$rats.'</td>';
					$exist_design .='<td style="text-align:center">';
					if($get_agency["is_active"]==0){
						$exist_design .='<img src="images/work_light/red.png" width="20" height="20">';
					}else{
						$exist_design .='<img src="images/work_light/green.png" width="20" height="20">';
					}
					
					$exist_design .='</td>';
					$exist_design .='<td style="text-align:center"><a href="javascript:void(0);" class="btn btn-primary  btn3d edit_agency_rate" data-id="'.$get_agency["template_no"].'"title="Edit"><span class="glyphicon glyphicon-question-ok"></span> Edit</a><a href="javascript:void(0);" class="btn btn-danger  btn3d delete_all_template" data-id="'. $get_agency["template_no"].'" title="Edit"><span class="glyphicon glyphicon-question-ok"></span> Delete</a></td>';
					$exist_design .='</tr>';
					
				}
				
				$exist_design .='</tbody></table>';
				
			}else{
				$exist_design="";
			}
			
			echo json_encode(array("exist_design" => $exist_design));
	}
	elseif($_POST['action_type'] == 'set_rate_on_change'){
		
		$set_rates= $_POST["set_rates"];
		$agency_rate_id= $_POST["agency_rate_id"];
		
		$up_rate="update agency_rate_by_material set `new_rate`='$set_rates' where `agency_rate_id`=".$agency_rate_id;
		$query_up_rate=mysqli_query($conn,$up_rate);
	}
	elseif($_POST['action_type'] == 'delete_all_template'){
		
		$delete_all_template= $_POST["delete_all_template"];
		
		
		$up_rate="delete from agency_rate_by_material where `template_no`='$delete_all_template'";
		$query_up_rate=mysqli_query($conn,$up_rate);
	}
	elseif($_POST['action_type'] == 'insert_new_by_template_no'){
		
		$template_no= $_POST["template_no"];
		$get_type_from_a_rate="select * from agency_rate_by_material where `template_no`='$template_no'";
		$query_type_from_a_rate= mysqli_query($conn,$get_type_from_a_rate);
		
			$var_design='<table id="example2" class="table table-bordered table-striped" style="width:100%;">
											<thead>
											<tr>
												<th style="text-align:center;">Material Name</th>
												<th style="text-align:center;">Rate Type</th>	
												<th style="text-align:center;">Old Rate</th>	
												<th style="text-align:center;">New Rate</th>
											</tr>
										</thead>
										<tbody>';
					while($get_agency_wise=mysqli_fetch_array($query_type_from_a_rate))
					{
					
					$var_design .='<tr>';
					$var_design .='<td style="text-align:center">'.$get_agency_wise["material_name"].'</td>';
					$var_design .='<td style="text-align:center">';
					if($get_agency_wise["rate_type"]=="0"){
						$var_design .="Government";
					}else{
						$var_design .="Private";						
					}
					$var_design .='</td>';
					$var_design .='<td style="text-align:center">'.$get_agency_wise["old_rate"].'</td>';
					$var_design .='<td style="text-align:center"><input type="text" name="txt_new_rate[]" class="change_rate_class" data-id="'.$get_agency_wise["agency_rate_id"].'" value="'.$get_agency_wise["new_rate"].'"></td>';
					$var_design .='</tr>';

					
					}					
										
										
										
					$var_design .='</tbody></table>';
					echo json_encode(array("var_design"=> $var_design));
		
		
		
	}
    exit;
}
?>
