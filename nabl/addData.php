<?php
session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'data'){


		$get_query = "select * from material_assign WHERE assign_id='$_POST[id]' AND `isdeleted`='0'";
		$select_result = mysqli_query($conn, $get_query);
		$result=mysqli_fetch_array($select_result);

		$category_sql = "select * from material_category where `material_cat_status`='1' AND `material_cat_isdelete`='0'";
		$category_result = mysqli_query($conn, $category_sql);
		$out_category;
		if (mysqli_num_rows($category_result) > 0) {
			while($row = mysqli_fetch_assoc($category_result)) {
				if($result['material_category']==$row['material_cat_id'])
				{
					$selected_cate="selected";
				}else
				{
					$selected_cate="";

				}
			$out_category .='<option value="'.$row['material_cat_id'].'" '.$selected_cate.'>'.$row['material_cat_name'].'</option>';
			}}


		$material_query = "SELECT * FROM material WHERE `mt_status`=1 AND `mt_isdeleted`=0 AND mat_category_id =".$result['material_category'];
		$result_material = mysqli_query($conn,$material_query);
	    $out_material='<option value="">Select Material</option>';


	while($material_row = mysqli_fetch_assoc($result_material))
	{
			if($result['material']==$material_row['id'])
				{
					$selected_materials="selected";
				}else
				{
					$selected_materials="";

				}

		 $out_material .='<option value="'.$material_row['id'].'>" '.$selected_materials.'>'.$material_row["mt_name"].'</option>';

     }

		$material_category=$result['material_category'];
		$all_material_category=$out_category;
		$all_material=$out_material;
		$material=$result['material'];
		$rate=$result['rate'];
		$qty=$result['qty'];
		$sgstamt=$result['sgstamt'];
		$cgstamt=$result['cgstamt'];
		$netamt=$result['netamt'];
		$assign_id=$result['assign_id'];



	 $fill = array(

        'all_material_category' => $all_material_category,
        'all_material' => $all_material,
        'material_category' => $material_category,
        'material' => $material,
        'qty' => $qty,
        'rate' =>  $rate,
        'cgstamt' =>  $cgstamt,
        'sgstamt' => $sgstamt,
        'igstamt' => $igstamt,
        'netamt' => $netamt,
        'assign_id' => $assign_id

         );


        echo json_encode($fill);
    }else if($_POST['action_type'] == 'view'){
		    $txt_report_no=$_POST['txt_report_no'];

						?>
							<div id="display_data">
									<div class="row">
										<div class="col-lg-12">
											<table border="1px solid black" align="center" width="100%" id="aaaa">
												<tr>
													<th width="10%"><label>Actions</label></th>
													<th width="35%"><label>Material</label></th>
													<th width="5%"><label>Lab Id</label></th>
													<th width="5%"><label>Quantity</label></th>
													<th width="10%"><label>Rate</label></th>
													<th width="10%"><label>Taxable Amount</label></th>
													<th width="10%"><label>CGST</label></th>
													<th width="10%"><label>SGST</label></th>
													<th width="10%"><label>NET</label></th>

												</tr>

													<?php
													$query = "select * from material_assign WHERE report_number='$txt_report_no' AND `isdeleted`='0' AND `assign_status`='0'";
													$result = mysqli_query($conn, $query);

													$total_taxabled=0;

													if (mysqli_num_rows($result) > 0) {
														while($r = mysqli_fetch_array($result)){

															if($r['isdeleted'] == 0){
															?>
															<tr>
															<td style="text-align:center;" width="10%">
															<!--<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php //echo $r['assign_id']; ?>')"></a>-->
															<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?addData('delete','<?php echo $r['assign_id']; ?>'):false;"></a>
														</td>

															<?php
															$mt_id= $r['material'];

															$query_mt = "select * from material WHERE id='$mt_id' AND `mt_status` = '1' AND `mt_isdeleted` = '0'";
															$result_mt = mysqli_query($conn, $query_mt);
															$rw = mysqli_fetch_array($result_mt);

															$query_sum = "select SUM(cgstamt) as sum_cgstamt, SUM(sgstamt) as sum_sgstamt,SUM(netamt) as sum_netamt from material_assign WHERE report_number='$txt_report_no' AND isdeleted=0 AND assign_status=0 ";
															$result_sum = mysqli_query($conn, $query_sum);

															$r_sum = mysqli_fetch_array($result_sum);

															$cgst=round($r_sum['sum_cgstamt'],2);
															$sgst=round($r_sum['sum_sgstamt'],2);
															$gst=$cgst+$sgst;

															$net=round($r_sum['sum_netamt']);

															?>
															<td style="text-align:center;" width="35%"><?php echo $rw['mt_name'];?></td>
															<td style="text-align:center;" width="5%"><?php echo $r['lab_id'];?></td>
															<td style="text-align:center;" width="5%"><?php echo $r['qty'];?></td>
															<td style="text-align:center;" width="10%"><?php echo $r['rate'];?></td>
															<td style="text-align:center;" width="10%"><?php echo $r['rate']*$r['qty'];
															$total_taxabled += $r['rate']*$r['qty'];

															?></td>

															<td style="text-align:center;" width="10%"><?php echo $r['cgstamt'];?></td>
															<td style="text-align:center;" width="10%"><?php echo $r['sgstamt'];?></td>

															<td style="text-align:center;" width="10%"><?php echo $r['netamt'];?></td>
															</tr>
															<?php
															}
														}
													}
												?>

												<tr>
													<th colspan="5"><label>Total</label></th>
													<th style="text-align:center;"><?php echo $total_taxabled;?></th>
													<th style="text-align:center;"><?php echo round($r_sum['sum_cgstamt'], 2);?></th>
													<th style="text-align:center;"><?php echo round($r_sum['sum_sgstamt'], 2);?></th>

													<th style="text-align:center;"><?php echo round($r_sum['sum_netamt'], 2);?></th>
												</tr>
											</table>
										</div>
									</div>
								<hr>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Taxable:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="txt_taxable" name="txt_gst" value="<?php echo $total_taxabled;?>">
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Total GST:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="txt_gsti" name="txt_gst" value="<?php echo $gst;?>">
											</div>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Total Bill:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="txt_billinword" name="txt_billinword" value="<?php echo $net;?>">
											</div>
										</div>
									</div>
								</div>
							</div>
							<br>

		<?php

    }else if($_POST['action_type'] == 'view_for_edit'){
		    $txt_report_no=$_POST['txt_report_no'];

						?>
							<div id="display_data">
									<div class="row">
										<div class="col-lg-12">
											<table border="1px solid black" align="center" width="100%" id="aaaa">
												<tr>
													<th width="10%"><label>Actions</label></th>
													<th width="35%"><label>Material</label></th>
													<th width="5%"><label>Lab Id</label></th>
													<th width="5%"><label>Quantity</label></th>
													<th width="10%"><label>Rate</label></th>
													<th width="10%"><label>Taxable Amount</label></th>
													<th width="10%"><label>CGST</label></th>
													<th width="10%"><label>SGST</label></th>
													<th width="10%"><label>NET</label></th>

												</tr>

													<?php
													$query = "select * from material_assign WHERE report_number='$txt_report_no' AND `isdeleted`='0'";
													$result = mysqli_query($conn, $query);

													$total_taxabled=0;

													if (mysqli_num_rows($result) > 0) {
														while($r = mysqli_fetch_array($result)){

															if($r['isdeleted'] == 0){
															?>
															<tr>
															<td style="text-align:center;" width="10%">
															<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['assign_id']; ?>')"></a>
															<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?addData('delete','<?php echo $r['assign_id']; ?>'):false;"></a>
														</td>

															<?php
															$mt_id= $r['material'];

															$query_mt = "select * from material WHERE id='$mt_id' AND `mt_status` = '1' AND `mt_isdeleted` = '0'";
															$result_mt = mysqli_query($conn, $query_mt);
															$rw = mysqli_fetch_array($result_mt);

															$query_sum = "select SUM(cgstamt) as sum_cgstamt, SUM(sgstamt) as sum_sgstamt,SUM(netamt) as sum_netamt from material_assign WHERE report_number='$txt_report_no' AND isdeleted=0";
															$result_sum = mysqli_query($conn, $query_sum);

															$r_sum = mysqli_fetch_array($result_sum);

															$cgst=round($r_sum['sum_cgstamt'],2);
															$sgst=round($r_sum['sum_sgstamt'],2);
															$gst=$cgst+$sgst;

															$net=round($r_sum['sum_netamt']);

															?>
															<td style="text-align:center;" width="35%"><?php echo $rw['mt_name'];?></td>
															<td style="text-align:center;" width="5%"><?php echo $r['lab_id'];?></td>
															<td style="text-align:center;" width="5%"><?php echo $r['qty'];?></td>
															<td style="text-align:center;" width="10%"><?php echo $r['rate'];?></td>
															<td style="text-align:center;" width="10%"><?php echo $r['rate']*$r['qty'];
															$total_taxabled += $r['rate']*$r['qty'];

															?></td>

															<td style="text-align:center;" width="10%"><?php echo $r['cgstamt'];?></td>
															<td style="text-align:center;" width="10%"><?php echo $r['sgstamt'];?></td>

															<td style="text-align:center;" width="10%"><?php echo $r['netamt'];?></td>
															</tr>
															<?php
															}
														}
													}
												?>

												<tr>
													<th colspan="5"><label>Total</label></th>
													<th style="text-align:center;"><?php echo $total_taxabled;?></th>
													<th style="text-align:center;"><?php echo round($r_sum['sum_cgstamt'], 2);?></th>
													<th style="text-align:center;"><?php echo round($r_sum['sum_sgstamt'], 2);?></th>

													<th style="text-align:center;"><?php echo round($r_sum['sum_netamt'], 2);?></th>
												</tr>
											</table>
										</div>
									</div>
								<hr>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Taxable:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="txt_taxable" name="txt_gst" value="<?php echo $total_taxabled;?>">
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Total GST:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="txt_gsti" name="txt_gst" value="<?php echo $gst;?>">
											</div>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Total Bill:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="txt_billinword" name="txt_billinword" value="<?php echo $net;?>">
											</div>
										</div>
									</div>
								</div>
							</div>
							<br>

		<?php

    }else if($_POST['action_type'] == 'update_on_chk'){
		$chk_value=explode("|",$_POST['chk_value']);

		if($chk_value[1]==0){
			$where=" set `working_status`='1' WHERE `working_status`=$chk_value[1]";
		}else if($chk_value[1]==1){
			$where=" set `working_status`='2' WHERE `working_status`=$chk_value[1]";
		}else{
			$where=" set `working_status`='2' WHERE `working_status`=$chk_value[1]";
		}

		$update_job="update job_id_to_material".$where." AND job_assign_id=".$chk_value[0];
		mysqli_query($conn,$update_job);

	}else if($_POST['action_type'] == 'view_by_id'){
		    $clicked_id=$_POST['clicked_id'];

						?>
							<table align="center" width="100%" id="aaaa">
												<tr>
													<th style="text-align:center;">Material Name</th>
													<th style="text-align:center;">Lab Id</th>
													<th style="text-align:center;">job  Id</th>
													<th style="text-align:center;">Qty</th>
													<th style="text-align:center;">Testing Date</th>
													<th style="text-align:center;">Testing Start Date</th>
													<th style="text-align:center;">Testing End Date</th>
													<th style="text-align:center;">Testing Days</th>
												</tr>

													<?php
													$query = "select * from material_assign WHERE assign_id='$clicked_id' AND `isdeleted`='0'";
													$result = mysqli_query($conn, $query);
													$r = mysqli_fetch_array($result);

													if (mysqli_num_rows($result) > 0) {
														$get_qty= $r['qty'];
														for($i=1;$i<=$get_qty;$i++)
														{
													?>
															<tr>

															<?php
															$mt_id= $r['material'];

															$query_mt = "select * from material WHERE id='$mt_id' AND `mt_status` = '1' AND `mt_isdeleted` = '0'";
															$result_mt = mysqli_query($conn, $query_mt);
															$rw = mysqli_fetch_array($result_mt);
															?>
															<td style="white-space:nowrap;text-align:center;"><?php echo $rw['mt_name'];?>
															<input type="hidden" name="report_number[]" value="<?php echo $r['report_number'];?>">
															<input type="hidden" name="material_cat_ids[]" value="<?php echo $r['material_category'];?>">
															<input type="hidden" name="material_ids[]" value="<?php echo $r['material'];?>">
															</td>
															<td style="white-space:nowrap;text-align:center;"><?php echo $r['lab_id'];?>
															<input type="hidden" name="lab_ids[]" value="<?php echo $r['lab_id'];?>">
															</td>

															<?php
															$explode_for_jobing=explode("/",$r['lab_id']);

															$job_id_set= $explode_for_jobing[2]."/".$explode_for_jobing[0]."-".$i;

															?>
															<td style="white-space:nowrap;text-align:center;"><?php echo $job_id_set;?>
															<input type="hidden" name="job_ids[]" value="<?php echo $job_id_set;?>">

															</td>
															<td style="white-space:nowrap;text-align:center;">1</td>
															<td style="white-space:nowrap;text-align:center;"><div class="date">

														<input type="text" class="testing_date"  name="testing_date[]" value="<?php echo date("d/m/Y");?>">
													</div></td>

															<td style="white-space:nowrap;text-align:center;"><div class="date">

														<input type="text" class="for_date start_date" id="start_date_<?php echo $i;?>" name="start_date[]" value="<?php echo date("d/m/Y");?>" tabindex="2">
													</div></td>

														<td style="white-space:nowrap;text-align:center;"><div class="date">

														<input type="text" class="for_date end_date" id="end_date_<?php echo $i;?>" name="end_date[]" value="<?php echo date("d/m/Y");?>" tabindex="2">
													</div></td>
													<td style="white-space:nowrap;text-align:center;">
													<span id="span_<?php echo $i;?>">0</span>
															<input type="hidden" name="days[]" value="0" class="day_class" id="days_<?php echo $i;?>">

															</td>

															<?php
														}

													}
												?>

											</table>


	<script>
	$('.testing_date').datepicker({
		autoclose: true,
	    format: 'dd/mm/yyyy'
	});

	$('.end_date').datepicker({
		autoclose: true,
	    format: 'dd/mm/yyyy'
	});

	$('.start_date').datepicker({
		autoclose: true,
	    format: 'dd/mm/yyyy'
	});

	$('.end_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    }).on("change", function() {
		//alert("dss");
		var start_date_id= "#"+$(this).attr("id").replace("end", "start");
		var get_start_date = $(start_date_id).val();

		var end_date_id= "#"+$(this).attr("id");
		var get_end_date = $(end_date_id).val();

		var start_datearray = get_start_date.split("/");
		var new_start_date = start_datearray[1] + '/' + start_datearray[0] + '/' + start_datearray[2];

		var end_datearray = get_end_date.split("/");
		var new_end_date = end_datearray[1] + '/' + end_datearray[0] + '/' + end_datearray[2];


		var date1 = new Date(new_start_date);
		var date2 = new Date(new_end_date);
		var timeDiff = Math.abs(date2.getTime() - date1.getTime());
		var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

		var split_id = start_date_id.split("_");

		var spaned="span_"+split_id[2];
		var put_days="#days_"+split_id[2];
		document.getElementById(spaned).innerHTML = diffDays;
		$(put_days).val(diffDays);

		  });



	</script>

		<?php

}else if($_POST['action_type'] == 'send_job_to_second'){
		$clicked_id=explode("|",$_POST['clicked_id']);

		$job_update="update job_id_to_material SET `send_to_second_status`='1' WHERE `createdby_id`='$clicked_id[2]' AND `assign_status`='1' AND `report_number`='$clicked_id[1]'";

		$result_of_update=mysqli_query($conn,$job_update);

		$job_total_update="update job_id_to_material_total SET `send_to_second_status`='1' WHERE `createdby_id`='$clicked_id[2]' AND `assign_status`='1' AND `report_number`='$clicked_id[1]'";

		$result_of_total_update=mysqli_query($conn,$job_total_update);

}else if($_POST['action_type'] == 'send_job_to_second_reception'){
		$clicked_id=$_POST['clicked_id'];

		$job_update="update job SET `send_to_second_reception`='1',`assign_status`='1',`admin_special_light`=1 WHERE `job_id`=".$clicked_id;
		$result_of_total_update=mysqli_query($conn,$job_update);

}else if($_POST['action_type'] == 'delete_job_by_rec'){
		$clicked_id=$_POST['clicked_id'];

		$job_delete="delete from  job WHERE `job_id`=".$clicked_id;
		$result_of_job_delete=mysqli_query($conn,$job_delete);

}else if($_POST['action_type'] == 'view_by_id_for_edit'){
		    $edit_id=$_POST['id'];

						?>
							<table align="center" width="100%" id="edit_data">
												<tr>
													<th style="text-align:center;">Material Name</th>
													<th style="text-align:center;">Lab Id</th>
													<th style="text-align:center;">job  Id</th>
													<th style="text-align:center;">Qty</th>
													<th style="text-align:center;">Testing Date</th>
													<th style="text-align:center;">Testing Start Date</th>
													<th style="text-align:center;">Testing End Date</th>
													<th style="text-align:center;">Testing Days</th>
												</tr>

													<?php
													$query = "select * from job_id_to_material WHERE `job_assign_id`=$edit_id AND `isdeleted`='0'";
													$result = mysqli_query($conn, $query);
													$r = mysqli_fetch_array($result);

													if (mysqli_num_rows($result) > 0) {
														$get_qty= $r['qty'];
														for($i=1;$i<=$get_qty;$i++)
														{
													?>
															<tr>

															<?php
															$mt_id= $r['material'];

															$query_mt = "select * from material WHERE id='$mt_id' AND `mt_status` = '1' AND `mt_isdeleted` = '0'";
															$result_mt = mysqli_query($conn, $query_mt);
															$rw = mysqli_fetch_array($result_mt);
															?>
															<td style="white-space:nowrap;text-align:center;"><?php echo $rw['mt_name'];?>

															</td>
															<td style="white-space:nowrap;text-align:center;"><?php echo $r['lab_id'];?>
															</td>


															<td style="white-space:nowrap;text-align:center;"><?php echo $r['job_id'];?>
															</td>
															<td style="white-space:nowrap;text-align:center;"><?php echo $r['qty'];?></td>
															<td style="white-space:nowrap;text-align:center;"><div class="date">

														<input type="text" class="testing_date"  name="testing_date" value="<?php echo date('d/m/Y', strtotime($r['testing_date']));?>">
													</div></td>

															<td style="white-space:nowrap;text-align:center;"><div class="date">

														<input type="text" class="for_date start_date" id="start_date_<?php echo $i;?>" name="start_date" value="<?php echo date('d/m/Y', strtotime($r['testing_start_date']));?>" tabindex="2">
													</div></td>

														<td style="white-space:nowrap;text-align:center;"><div class="date">

														<input type="text" class="for_date end_date" id="end_date_<?php echo $i;?>" name="end_date" value="<?php echo date('d/m/Y', strtotime($r['testing_end_date']));?>" tabindex="2">
													</div></td>
													<td style="white-space:nowrap;text-align:center;">
													<span id="span_<?php echo $i;?>"><?php echo $r['testing_days'];?></span>
															<input type="hidden" name="days" value="<?php echo $r['testing_days'];?>" class="day_class" id="days_<?php echo $i;?>">

															</td>

															<?php
														}

													}
												?>

											</table>

											<input type="hidden" name="edit_id_of_job" value="<?php echo $r['job_assign_id'];?>">



	<script>
	$('.testing_date').datepicker({
		autoclose: true,
	    format: 'dd/mm/yyyy'
	});

	$('.end_date').datepicker({
		autoclose: true,
	    format: 'dd/mm/yyyy'
	});

	$('.start_date').datepicker({
		autoclose: true,
	    format: 'dd/mm/yyyy'
	});

	$('.end_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    }).on("change", function() {
		//alert("dss");
		var start_date_id= "#"+$(this).attr("id").replace("end", "start");
		var get_start_date = $(start_date_id).val();

		var end_date_id= "#"+$(this).attr("id");
		var get_end_date = $(end_date_id).val();

		var start_datearray = get_start_date.split("/");
		var new_start_date = start_datearray[1] + '/' + start_datearray[0] + '/' + start_datearray[2];

		var end_datearray = get_end_date.split("/");
		var new_end_date = end_datearray[1] + '/' + end_datearray[0] + '/' + end_datearray[2];


		var date1 = new Date(new_start_date);
		var date2 = new Date(new_end_date);
		var timeDiff = Math.abs(date2.getTime() - date1.getTime());
		var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

		var split_id = start_date_id.split("_");

		var spaned="span_"+split_id[2];
		var put_days="#days_"+split_id[2];
		document.getElementById(spaned).innerHTML = diffDays;
		$(put_days).val(diffDays);

		  });



	</script>

		<?php

    }else if($_POST['action_type'] == 'view_after_add_data'){
						$report_no=$_POST['report_no'];
		 ?>
							<table align="center" width="100%" id="aaaa">
												<tr>
													<th style="text-align:center;">Action</th>
													<th style="text-align:center;">Material Name</th>
													<th style="text-align:center;">Lab Id</th>
													<th style="text-align:center;">job  Id</th>
													<th style="text-align:center;">Qty</th>
													<th style="text-align:center;">Testing Date</th>
													<th style="text-align:center;">Testing Start Date</th>
													<th style="text-align:center;">Testing End Date</th>
													<th style="text-align:center;">Testing Days</th>
												</tr>

													<?php
													$query = "select * from job_id_to_material WHERE `assign_status`=0 AND `isdeleted`='0' AND `createdby_id`=".$_SESSION['u_id']." AND `report_number`='$report_no'";
													$result = mysqli_query($conn, $query);

													if (mysqli_num_rows($result) > 0) {
														while($r = mysqli_fetch_array($result)){
													?>
															<tr>

															<?php
															$mt_id= $r['material'];

															$query_mt = "select * from material WHERE id='$mt_id' AND `mt_status` = '1' AND `mt_isdeleted` = '0'";
															$result_mt = mysqli_query($conn, $query_mt);
															$rw = mysqli_fetch_array($result_mt);
															?>
															<td>

															<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['job_assign_id']; ?>')"></a>
															<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?deleteData('delete','<?php echo $r['job_assign_id']; ?>'):false;"></a>

															</td>
															<td style="white-space:nowrap;text-align:center;"><?php echo $rw['mt_name'];?>
															</td>
															<td style="white-space:nowrap;text-align:center;"><?php echo $r['lab_id'];?>

															</td>


															<td style="white-space:nowrap;text-align:center;"><?php echo $r['job_id'];?>


															</td>
															<td style="white-space:nowrap;text-align:center;">
															<?php echo $r['qty'];?>
															</td>
															<td style="white-space:nowrap;text-align:center;"><div class="date">
														    <?php echo $r['testing_date'];?>
															</td>

															<td style="white-space:nowrap;text-align:center;">
															<?php echo $r['testing_start_date'];?>
															</td>

															<td style="white-space:nowrap;text-align:center;">
															<?php echo $r['testing_end_date'];?>
															</td>
															<td style="white-space:nowrap;text-align:center;">
															<?php echo $r['testing_days'];?>
															</td>

															<?php
														}

													}
												?>

											</table>
<?php

    }else if($_POST['action_type'] == 'view_after_add_data_in_edit'){
					$report_no=$_POST['report_no'];

		 ?>
							<table align="center" width="100%" id="aaaa">
												<tr>
													<th style="text-align:center;">Action</th>
													<th style="text-align:center;">Material Name</th>
													<th style="text-align:center;">Lab Id</th>
													<th style="text-align:center;">job  Id</th>
													<th style="text-align:center;">Qty</th>
													<th style="text-align:center;">Testing Date</th>
													<th style="text-align:center;">Testing Start Date</th>
													<th style="text-align:center;">Testing End Date</th>
													<th style="text-align:center;">Testing Days</th>
												</tr>

													<?php
													$query = "select * from job_id_to_material WHERE  `isdeleted`='0' AND `createdby_id`=".$_SESSION['u_id']." AND `report_number`='$report_no'";
													$result = mysqli_query($conn, $query);

													if (mysqli_num_rows($result) > 0) {
														while($r = mysqli_fetch_array($result)){
													?>
															<tr>

															<?php
															$mt_id= $r['material'];

															$query_mt = "select * from material WHERE id='$mt_id' AND `mt_status` = '1' AND `mt_isdeleted` = '0'";
															$result_mt = mysqli_query($conn, $query_mt);
															$rw = mysqli_fetch_array($result_mt);
															?>
															<td>

															<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['job_assign_id']; ?>')"></a>
															<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?deleteData('delete','<?php echo $r['job_assign_id']; ?>'):false;"></a>

															</td>
															<td style="white-space:nowrap;text-align:center;"><?php echo $rw['mt_name'];?>
															</td>
															<td style="white-space:nowrap;text-align:center;"><?php echo $r['lab_id'];?>

															</td>


															<td style="white-space:nowrap;text-align:center;"><?php echo $r['job_id'];?>


															</td>
															<td style="white-space:nowrap;text-align:center;">
															<?php echo $r['qty'];?>
															</td>
															<td style="white-space:nowrap;text-align:center;"><div class="date">
														    <?php echo $r['testing_date'];?>
															</td>

															<td style="white-space:nowrap;text-align:center;">
															<?php echo $r['testing_start_date'];?>
															</td>

															<td style="white-space:nowrap;text-align:center;">
															<?php echo $r['testing_end_date'];?>
															</td>
															<td style="white-space:nowrap;text-align:center;">
															<?php echo $r['testing_days'];?>
															</td>

															<?php
														}

													}
												?>

											</table>
<?php

    }else if($_POST['action_type'] == 'get_jobing'){
	?>
		<table id="example1" class="table table-bordered table-striped" width="100%">
									<thead>
									<tr>
										<th style="text-align:center;">Action</th>
										<th style="text-align:center;">Report Number</th>
										<th style="text-align:center;">Date</th>
										<th style="text-align:center;">Created By</th>
									</tr>

								</thead>
								<tbody>
									<?php
										$count=0;
										$query="select * from job_id_to_material_total WHERE `assign_status`=1 AND `isdeleted`=0 AND `send_to_second_status`=0 AND `createdby_id`='$_SESSION[u_id]' ORDER BY job_id_to_material_total_id DESC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{


									?>
											<tr>
											<td style="text-align:center;">

												<a href="<?php echo $base_url; ?>edit_material_report.php?report_no=<?php echo $row['report_number'];?>" class="glyphicon glyphicon-edit" title="Material Assign"></a>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<button type="button" class="btn btn-info send_to_second" id="btn_click" data-id="<?php echo $row['job_id_to_material_total_id'];?>|<?php echo $row['report_number'];?>|<?php echo $_SESSION['u_id'];?>" name="btn_click" title="Send to Second Reception Desk">Send To</button>



											</td>


											<td style="white-space:nowrap;text-align:center;"><?php echo $row['report_number'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['date'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['createdby'];?></td>
										</tr>
									<?php
										}
									?>
								</tbody>

							  </table>

	<?php
	}else if($_POST['action_type'] == 'get_jobing_for_first_reception'){
	?>
		<table id="example1" class="table table-bordered table-striped" width="100%">
									<thead>
									<tr>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Date</th>
										<th style="text-align:center;">Customer Name</th>
										<th style="text-align:center;">Agency Name</th>
										<th style="text-align:center;">Report No</th>
										<th style="text-align:center;">Action</th>
									</tr>

								</thead>
								<tbody>
									<?php
										$count=0;
										$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=0 AND `send_to_second_reception`=0 ORDER BY job_id DESC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;

									?>
											<tr>
											<td><?php echo $count;?></td>
											<td><?php echo date("d-m-Y", strtotime($row['date']));?></td>
											<td><?php echo $row['clientname'];?></td>
											<td><?php

											$query_agency="select * from agency_master where `agency_id`=".$row['agency'];
											$result_agency=mysqli_query($conn,$query_agency);
											$row_result=mysqli_fetch_array($result_agency);
											echo $row_result["agency_name"];
											?></td>
											<td style="white-space:nowrap;"><?php echo $row['report_no'];?></td>
											<td style="text-align:center;">

											<?php if($row['jobcreatedby_id']==$_SESSION['u_id']){?>

											<?php if($row['assign_status']==0){ ?>
												<!--<a href="<?php //echo $base_url; ?>material_assigning.php?report_no=<?php// echo $row['report_no'];?>" class="btn btn-info btn-lg btn3d" title="Material Assign"><span class="glyphicon glyphicon-question-edit"></span> Edit</a>-->

												<a href="<?php echo $base_url; ?>edit_client_form.php?job_id=<?php echo $row['job_id'];?>" class="btn btn-info btn-lg btn3d" title="Material Assign"><span class="glyphicon glyphicon-question-edit"></span> Edit</a>
												&nbsp;&nbsp;&nbsp;

												<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d delete_job" data-id="<?php echo $row['job_id'];?>"title="Delete Job"><span class="glyphicon glyphicon-question-ok"></span> Delete Job</a>

												&nbsp;&nbsp;&nbsp;
												<a href="#" class="btn btn-success btn-lg btn3d send_to_second" data-id="<?php echo $row['job_id'];?>"title="Send to Second Reception Desk"><span class="glyphicon glyphicon-question-ok"></span> Send To Reception 2</a>

										    <?php }

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

	<?php
	}elseif($_POST['action_type'] == 'add'){

				$get_report_number=explode("=",$_POST["get_form"]);
				$report_number = $get_report_number[1];


				$select_material_category =$_POST['material_cat_ids'];
				$select_material = $_POST['material_ids'];
				$lab_ids = $_POST['lab_ids'];
				$job_ids = $_POST['job_ids'];
				$testing_date = $_POST['testing_date'];
				$start_date = $_POST['start_date'];
				$end_date = $_POST['end_date'];
				$days = $_POST['days'];
				$txt_qty = 1;



				foreach($select_material as $key=> $value){

				$testing_explode_dating= explode("/",$testing_date[$key]);
				$testing_insert_date= $testing_explode_dating[2]."-".$testing_explode_dating[1]."-".$testing_explode_dating[0];

				$start_explode_dating= explode("/",$start_date[$key]);
				$start_insert_date= $start_explode_dating[2]."-".$start_explode_dating[1]."-".$start_explode_dating[0];

				$end_explode_dating= explode("/",$end_date[$key]);
				$end_insert_date= $end_explode_dating[2]."-".$end_explode_dating[1]."-".$end_explode_dating[0];

					$insert="insert into job_id_to_material (`report_number`,`material_category`,`material`,`lab_id`,`job_id`,`qty`,`testing_date`,`testing_start_date`,`testing_end_date`,`testing_days`,`createdby_id`,`createdby`,`createddate`,`modifiedby`,`modifieddate`,`assign_status`,`isdeleted`)
				values(
				'$report_number',
				'$select_material_category[$key]',
				'$select_material[$key]',
				'$lab_ids[$key]',
				'$job_ids[$key]',
				'1',
				'$testing_insert_date',
				'$start_insert_date',
				'$end_insert_date',
				'$days[$key]',
				'$_SESSION[u_id]',
				'$_SESSION[name]',
				'0000-00-00',
				'',
				'0000-00-00',
				'0',
				'0')";
				$result_of_insert=mysqli_query($conn,$insert);

				}



    }elseif($_POST['action_type'] == 'add_material_assinging'){


				$txt_report_no=$_POST['txt_report_no'];
				$report_explode= explode("/",$txt_report_no);
				$date =$_POST['date'];;
				$select_material_category =$_POST['select_material_category'];
				$select_material = $_POST['select_material'];
				$material_prefix = $_POST['material_prefix'];
				$txt_qty = $_POST['txt_qty'];
				$txt_rate= $_POST['txt_rate'];
				$taxable= $txt_qty*$txt_rate;
				$txt_cgst= $_POST['txt_cgst'];
				$txt_sgst= $_POST['txt_sgst'];
				$txt_net= $_POST['txt_net'];
				$gst_type= $_POST['gst_type'];
				$directing_path= $_POST['directing_path'];
				$like=$material_prefix."%";



				$sel="select * from material_assign where isdeleted=0 AND lab_id LIKE '".$like."' order by assign_id DESC";
				$resulting = mysqli_query($conn, $sel);

				if (mysqli_num_rows($resulting) > 0) {
					$job_r = mysqli_fetch_assoc($resulting);

					$explode_no= explode("/",$job_r["lab_id"]);

					$first_explode= $explode_no[0]."/";
					$second_explode= $explode_no[1]."/";
					$third_explode= $explode_no[2];
					$fourth_explode= $explode_no[3];
					$month_day=substr($third_explode,0,4);
					$get_report_no= substr($third_explode,4);
					$plus_report_no= $get_report_no + 1;

					$final_lab_id= $first_explode.$second_explode.$month_day.$plus_report_no."/".$fourth_explode;


				}else{
					$final_lab_id= $material_prefix."/".$report_explode[1]."/".$report_explode[2]."/".$report_explode[3];
				}

				$explode_dating= explode("/",$date);
				$to_insert_date= $explode_dating[2]."-".$explode_dating[1]."-".$explode_dating[0];

				$insert="insert into material_assign (`gst_type`,`report_number`,`material_category`,`material`,`rate`,`qty`,`sgstper`,`sgstamt`,`cgstper`,`cgstamt`,`netamt`,`lab_id`,`direct_path`,`date`,`createdby`,`createddate`,`modifiedby`,`modifieddate`,`assign_status`,`isdeleted`)
				values(
				'$gst_type',
				'$txt_report_no',
				'$select_material_category',
				'$select_material',
				'$txt_rate',
				'$txt_qty',
				'9',
				'$txt_sgst',
				'9',
				'$txt_cgst',
				'$txt_net',
				'$final_lab_id',
				'$directing_path',
				'$to_insert_date',
				'$_SESSION[name]',
				'$to_insert_date',
				'',
				'0000-00-00',
				'0',
				'0')";

		$result_of_insert=mysqli_query($conn,$insert);

    }elseif($_POST['action_type'] == 'edit_job'){

				$get_test_date=explode("=",$_POST["get_form"]);
				$testing_date = $get_test_date[1];
				$start_date = $_POST['start_date'];
				$end_date = $_POST['end_date'];
				$days = $_POST['days'];
				$edit_id_of_job = $_POST['edit_id_of_job'];



				$testing_explode_dating= explode("/",$testing_date);
				$testing_insert_date= $testing_explode_dating[2]."-".$testing_explode_dating[1]."-".$testing_explode_dating[0];

				$start_explode_dating= explode("/",$start_date);
				$start_insert_date= $start_explode_dating[2]."-".$start_explode_dating[1]."-".$start_explode_dating[0];

				$end_explode_dating= explode("/",$end_date);
				$end_insert_date= $end_explode_dating[2]."-".$end_explode_dating[1]."-".$end_explode_dating[0];

					$update="update job_id_to_material SET `testing_date`='$testing_insert_date',`testing_start_date`='$start_insert_date',`testing_end_date`='$end_insert_date',`testing_days`='$days' WHERE `job_assign_id`=$edit_id_of_job";


				mysqli_query($conn,$update);





    }elseif($_POST['action_type'] == 'delete_job_by_id'){

				$delete_id = $_POST['id'];
				$delete_job="DELETE FROM job_id_to_material WHERE `job_assign_id` =".$delete_id;

				mysqli_query($conn,$delete_job);

	}elseif($_POST['action_type'] == 'edit'){

		$taxable_amt_count= ($_POST["txt_rate_edit"]*$_POST["txt_qty_edit"]);

		$update="update material_assign SET `material_category`='$_POST[select_material_category]',`material`='$_POST[select_material]',`qty`='$_POST[txt_qty]',`rate`='$_POST[txt_rate]',`cgstamt`='$_POST[txt_cgst]',`sgstamt`='$_POST[txt_sgst]',`netamt`='$_POST[txt_net]' WHERE `assign_id`='$_POST[txt_id]'";


		$result_of_update=mysqli_query($conn,$update);

    }elseif($_POST['action_type'] == 'delete'){

		 $delete="DELETE FROM  material_assign WHERE `assign_id`='$_POST[id]'";

		$result_of_delete=mysqli_query($conn,$delete);

    }
    exit;
}
?>

<?php function numtowords($num){
$decones = array(
            '01' => "One",
            '02' => "Two",
            '03' => "Three",
            '04' => "Four",
            '05' => "Five",
            '06' => "Six",
            '07' => "Seven",
            '08' => "Eight",
            '09' => "Nine",
            10 => "Ten",
            11 => "Eleven",
            12 => "Twelve",
            13 => "Thirteen",
            14 => "Fourteen",
            15 => "Fifteen",
            16 => "Sixteen",
            17 => "Seventeen",
            18 => "Eighteen",
            19 => "Nineteen"
            );
$ones = array(
            0 => " ",
            1 => "One",
            2 => "Two",
            3 => "Three",
            4 => "Four",
            5 => "Five",
            6 => "Six",
            7 => "Seven",
            8 => "Eight",
            9 => "Nine",
            10 => "Ten",
            11 => "Eleven",
            12 => "Twelve",
            13 => "Thirteen",
            14 => "Fourteen",
            15 => "Fifteen",
            16 => "Sixteen",
            17 => "Seventeen",
            18 => "Eighteen",
            19 => "Nineteen"
            );
$tens = array(
            0 => "",
            2 => "Twenty",
            3 => "Thirty",
            4 => "Forty",
            5 => "Fifty",
            6 => "Sixty",
            7 => "Seventy",
            8 => "Eighty",
            9 => "Ninety"
            );
$hundreds = array(
            "Hundred",
            "Thousand",
            "Million",
            "Billion",
            "Trillion",
            "Quadrillion"
            ); //limit t quadrillion
$num = number_format($num,2,".",",");
$num_arr = explode(".",$num);
$wholenum = $num_arr[0];
$decnum = $num_arr[1];
$whole_arr = array_reverse(explode(",",$wholenum));
krsort($whole_arr);
$rettxt = "";
foreach($whole_arr as $key => $i){
    if($i < 20){
        $rettxt .= $ones[$i];
    }
    elseif($i < 100){
        $rettxt .= $tens[substr($i,0,1)];
        $rettxt .= " ".$ones[substr($i,1,1)];
    }
    else{
        $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0];
        $rettxt .= " ".$tens[substr($i,1,1)];
        $rettxt .= " ".$ones[substr($i,2,1)];
    }
    if($key > 0){
        $rettxt .= " ".$hundreds[$key]." ";
    }

}
$rettxt = $rettxt." Rupees";

if($decnum > 0){
    $rettxt .= " and ";
    if($decnum < 20){
        $rettxt .= $decones[$decnum];
    }
    elseif($decnum < 100){
        $rettxt .= $tens[substr($decnum,0,1)];
        $rettxt .= " ".$ones[substr($decnum,1,1)];
    }
    $rettxt = $rettxt." Paise";
}
return $rettxt;}


function convert_number_to_words($number) {
    $hyphen      = '-';
   // $conjunction = ' and ';
    $conjunction = '  ';
    $separator   = ', ';
    $negative    = 'negative ';
   // $decimal     = ' point ';
    $decimal     = ' And ';
    $dictionary  = array(
        0                   => 'Zero',
        1                   => 'One',
        2                   => 'Two',
        3                   => 'Three',
        4                   => 'Four',
        5                   => 'Five',
        6                   => 'Six',
        7                   => 'Seven',
        8                   => 'Eight',
        9                   => 'Nine',
        10                  => 'Ten',
        11                  => 'Eleven',
        12                  => 'Twelve',
        13                  => 'Thirteen',
        14                  => 'Fourteen',
        15                  => 'Fifteen',
        16                  => 'Sixteen',
        17                  => 'Seventeen',
        18                  => 'Eighteen',
        19                  => 'Nineteen',
        20                  => 'Twenty',
        30                  => 'Thirty',
        40                  => 'Fourty',
        50                  => 'Fifty',
        60                  => 'Sixty',
        70                  => 'Seventy',
        80                  => 'Eighty',
        90                  => 'Ninety',
        100                 => 'Hundred',
        1000                => 'Thousand',
        1000000             => 'Million',
        1000000000          => 'Billion',
        1000000000000       => 'Trillion',
        1000000000000000    => 'Quadrillion',
        1000000000000000000 => 'Quintillion'
    );
    if (!is_numeric($number)) {
        return false;
    }
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }
    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    $string = $fraction = null;
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }


    return $string;
}
?>
