<?php
error_reporting(1);
session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'check_for_merge')
	{
		$chk_array= $_POST["chk_array"];
		$explode_est_id=explode(",",$chk_array);
		
		$sel_rate_array=array();
		$bill_to_id_array=array();
		$f_percent_array=array();
		$s_percent_array=array();
		$dicount_array=array();
		$make_type_array=array();
		$which_made_array=array();
		
		foreach($explode_est_id as $keyses => $one_ids)
		{
			$sel_est="select * from estimate_total_span where `est_id`=".$one_ids;
			$query_est=mysqli_query($conn,$sel_est);
			$get_est=mysqli_fetch_array($query_est);
			
			array_push($sel_rate_array,$get_est["rate_type"]);
			array_push($bill_to_id_array,$get_est["bill_to_id"]);
			array_push($f_percent_array,$get_est["charge_one_percentage"]);
			array_push($s_percent_array,$get_est["charge_two_percentage"]);
			array_push($dicount_array,$get_est["discount_percentage"]);
			array_push($make_type_array,$get_est["make_by"]);
			array_push($which_made_array,$get_est["which_made"]);
			
		}
		//array_push($bill_to_id_array,"jj");
		if((count(array_unique($sel_rate_array)) === 1) && (count(array_unique($bill_to_id_array)) === 1) && (count(array_unique($f_percent_array)) === 1) && (count(array_unique($s_percent_array)) === 1) && (count(array_unique($dicount_array)) === 1) && (count(array_unique($make_type_array)) === 1)) {
			
			if(!in_array("1", $which_made_array) || !in_array("2", $which_made_array))
			{
				$fill=array("status" => 0,"msg" => "SUCCESS","make_type" => $make_type_array[0]);
			}else{
				$fill=array("status" => 1,"msg" => "Something Went Wrong...");
			}
		}else{
				$fill=array("status" => 1,"msg" => "Something Went Wrong...");
			
		}
		
			echo json_encode($fill);	
	} else if($_POST['action_type'] == 'on_make_by_change')
	{
		$txt_make_by=$_POST["txt_make_by"];
		$get_rate_type=$_POST["get_rate_type"];
		$bill_to_id=$_POST["bill_to_id"];
		$get_chk_array= explode(",",$_POST["txt_trf_no"]);
		$perfoma_array= explode(",",$_POST["perfoma_array"]);
		
		if($txt_make_by=="0")
		{
		$count_rows=0;
		$now_array=array();
		$jobs_array=array();
		//foreach($get_chk_array as  $keyed => $one_chk_array)
		foreach($perfoma_array as  $keyed => $one_perfoma)
		{
			$sel_ests="select * from estimate_total_span where `perfoma_no`='$perfoma_array[$keyed]'";
			$get_ests=mysqli_query($conn,$sel_ests);
			if(mysqli_num_rows($get_ests) > 0)
			{
				$one_ests=mysqli_fetch_array($get_ests);
				$explode_trf_aray=explode(",",$one_ests["trf_no_array"]);
				$explode_mat_ids=explode(",",$one_ests["mat_ids"]);
				$explode_mat_name=explode(",",$one_ests["mate_name"]);
				$explode_test_ids=explode(",",$one_ests["test_ids"]);
				$explode_test_name=explode(",",$one_ests["test_name"]);
				$explode_test_qty=explode(",",$one_ests["test_qty"]);
				$explode_test_rates=explode(",",$one_ests["test_rates"]);
				$explode_test_totals=explode(",",$one_ests["test_totals"]);
				
				foreach($explode_test_ids as $keyer => $one_test_id)
				{
					$one_chk_array=$explode_trf_aray[$keyer];
			if (!in_array($one_chk_array, $jobs_array))
			{
		?>
			<tr>
			<td colspan="6"><b style="font-size:14px;">Job No: <?php echo $one_chk_array;?></b></th>
			</tr>
			<?php
			array_push($jobs_array,$one_chk_array);
			}
			$sel_jobs="select nameofwork from job where `trf_no`='$one_chk_array'";
			$query_jobs=mysqli_query($conn,$sel_jobs);
			$get_now=mysqli_fetch_array($query_jobs);
			$name_of_works=$get_now["nameofwork"];
			if (!in_array($name_of_works, $now_array))
			{
			?>
				<tr>
				<td colspan="6"><b style="">Name Of Work: <?php echo strip_tags($name_of_works);?></b></td>
				</tr>
				<tr>
					<th width="2%">Material Name</th>
					<th width="4%">Test Name</th>
					<th width="2%">Qty</th>
					<th width="2%">Rate</th>
					<th width="2%">Amount</th>
				</tr>
			<?php	
			array_push($now_array,$name_of_works);										  
			}
											
														
													
													
												    
													
													//array_reverse($merge_material_name_array);
													
													?>
													
													<tr>
														  <td>
														  <input type="hidden" name="mt_id[]" class="class_trf_id" id="trfid_<?php echo $keyer;?>" value="<?php echo $one_chk_array;?>">
														  
														  <input type="hidden" name="mt_id[]" class="class_mate_id" id="mateid_<?php echo $count_rows;?>" value="<?php echo $explode_mat_ids[$keyer]; ?>">
														  <input type="text" name="mat_name[]" class="form-control class_mate_name" id="matename_<?php echo $count_rows;?>" value="<?php echo $explode_mat_name[$keyer]; ?>" disabled style="width:200px;font-weight:bold;">
														  </td>
														  <td>
															<input type="hidden" name="test_id[]" class="class_test_id" id="testid_<?php echo $count_rows;?>" value="<?php echo $one_test_id;?>">
															<input type="text" name="test_name[]" class="form-control class_test" id="test_<?php echo $count_rows;?>" value="<?php echo $explode_test_name[$keyer];?>" >
															</td>
															<td>
															<input type="text" name="qty[]" class="form-control class_qty" id="qty_<?php echo $count_rows;?>" value="<?php echo $explode_test_qty[$keyer];?>" >
															</td>
															<td>
															<input type="text" name="rate[]" class="form-control txt_rate_class" id="rate_<?php echo $count_rows;?>" value="<?php echo $explode_test_rates[$keyer];?>">
															</td>
															<td>
															  <input type="text" name="amt[]" class="form-control class_amnt" id="amt_<?php echo $count_rows;?>" value="<?php echo $explode_test_qty[$keyer] * $explode_test_rates[$keyer];?>" disabled>
															</td>
															<!--<td>
																<a href="JavaScript:void(0)" class="remove_button btn btn-primary" title="Remove field" style=""><b>X</b></a>
															</td>-->
															
														  </tr>
													<?php
													$count_rows++;
													}
													}
	}
	}else{
	   $now_array=array();
	   $count_rows=0;
	   $jobs_array=array();
		//foreach($get_chk_array as $keyed => $one_chk_arrays)
		foreach($perfoma_array as  $keyed => $one_perfoma)
		{
	   
	   
	   $sel_ests="select * from estimate_total_span where `perfoma_no`='$perfoma_array[$keyed]'";
	  $get_ests=mysqli_query($conn,$sel_ests);
		if(mysqli_num_rows($get_ests) > 0)
		{
			$one_ests=mysqli_fetch_array($get_ests);
			$explode_trf_aray=explode(",",$one_ests["trf_no_array"]);
			$explode_mat_ids=explode(",",$one_ests["mat_ids"]);
			$explode_mat_name=explode(",",$one_ests["mate_name"]);
			$explode_mat_qty=explode(",",$one_ests["material_qty"]);
			$explode_mat_rates=explode(",",$one_ests["material_rates"]);
			
		foreach($explode_mat_ids as $mat_key=> $one_material)
		{
			$one_chk_array=$explode_trf_aray[$mat_key];
		if (!in_array($one_chk_array, $jobs_array))
		{
		?>
		<tr>
		<td colspan="6"><b style="font-size:14px;">Job No: <?php echo $one_chk_array;?></b></th>
		</tr>
		<?php
		array_push($jobs_array,$one_chk_array);
		}
		$sel_jobs="select nameofwork from job where `trf_no`='$one_chk_array'";
		$query_jobs=mysqli_query($conn,$sel_jobs);
		$get_now=mysqli_fetch_array($query_jobs);
		$name_of_works=$get_now["nameofwork"];
		if (!in_array($name_of_works, $now_array))
		{
		?>
			<tr>
			<td colspan="6"><b style="">Name Of Work: <?php echo strip_tags($name_of_works);?></b></td>
			</tr>
			<tr>
			<th width="4%">Material Name</th>
			<th width="2%">Qty</th>
			<th width="2%">Rate</th>
			<th width="2%">Amount</th>
			</tr>
		<?php	
		array_push($now_array,$name_of_works);										  
		}
		
		?>
		<tr>
		<td>
		<input type="hidden" name="mt_id[]" class="class_trf_id" id="trfid_<?php echo $keyer;?>" value="<?php echo $one_chk_array;?>">
		<input type="hidden" name="material_ids[]" class="form-control class_material_id" id="" value="<?php echo $one_material; ?>" disabled>
		<input type="text" name="material_names[]" class="form-control class_material_name" id="material_names" value="<?php echo $explode_mat_name[$mat_key]; ?>" disabled>
		</td>
		<td>
		<input type="text" name="material_qty[]" class="form-control class_material_qty" id="materialqty_<?php echo $count_rows;?>" value="<?php echo $explode_mat_qty[$mat_key]; ?>" >
		</td>
		<td>
		<input type="text" name="material_rating[]" class="form-control class_material_rates" id="materialrating_<?php echo $count_rows;?>" value="<?php echo $explode_mat_rates[$mat_key]; ?>" >
		</td>
		<td>
		
		<?php
		// multification of qty and material_rate 
			$multi_of_qty_and_mate_rate= intval($explode_mat_qty[$mat_key]) * intval($explode_mat_rates[$mat_key]);
		?>
		<input type="text" name="material_totals[]" class="form-control class_amnt" id="materialtotals_<?php echo $count_rows;?>" value="<?php echo $multi_of_qty_and_mate_rate;?>" disabled>
		</td>
		</tr>
	 
		<?php 
		$count_rows++;
		}
		}
		}
		}
		}else if($_POST['action_type'] == 'merge_perfoma_test')
		{
		
		$txt_trf_no= $_POST["txt_trf_no"];
		$txt_job_no= $_POST["txt_job_no"];
		$gst_no= $_POST["gst_no"];
		$hsn_codes= $_POST["hsn_codes"];
		$squence_no= $_POST["squence_no"];
		$perfoma_no= $_POST["perfoma_no"];
		$txt_invoice_no= $_POST["txt_invoice_no"];
		$replace_date= str_replace("/","-",$_POST['invoice_date']);
		$invoice_date= date('Y-m-d', strtotime($replace_date));
		$select_rate_explode= explode("|",$_POST["select_rate"]);
		$select_rate=$select_rate_explode[0];
		$hidden_gst_type= $_POST["hidden_gst_type"];
		$hidden_gst_in_ex= $_POST["hidden_gst_in_ex"];
		$txt_cgst= $_POST["txt_cgst"];
		$txt_sgst= $_POST["txt_sgst"];
		$txt_igst= $_POST["txt_igst"];
		$txt_grand= $_POST["txt_grand"];
		$txt_amt_in_word= $_POST["txt_amt_in_word"];
		$total_amt= $_POST["total_amt"];
		$hidden_agency= $_POST["hidden_agency"];
		$test_ids_array= $_POST["test_ids_array"];
		$raw_post = file_get_contents('php://input');
		
		//$filearray = in_array(explode("&test_name_array=", $raw_post),$raw_post,false);
		$filear = explode("&test_name_array=", $raw_post);

		foreach ($filear as $array_dat) {
			//$data_list[] = strstr($array_dat, '&test_name_array=');
			$data_list = $array_dat;
		}
		$datas = explode("&test_qty_array=", $data_list);
		foreach ($datas as $array_dat1) {
			//$data_list[] = strstr($array_dat, '&test_name_array=');
			$datas[] = $array_dat1;
		}
		
		 $test_name_array= $datas[0];
		//$test_name_array= $_POST["test_name_array"];
		$test_qty_array= $_POST["test_qty_array"];
		$test_rates_array= $_POST["test_rates_array"];
		$test_trf_id_array= $_POST["test_trf_id_array"];
		$test_amnt_array= $_POST["test_amnt_array"];
		//$filearray = in_array(explode("&test_name_array=", $raw_post),$raw_post,false);
		$filear1 = explode("&test_mate_array=", $raw_post);

		foreach ($filear1 as $array_dat1) {
			//$data_list[] = strstr($array_dat, '&test_name_array=');
			$data_list1 = $array_dat1;
		}
		$datas1 = explode("&test_mate_id_array=", $data_list1);
		foreach ($datas1 as $array_dat11) {
			//$data_list[] = strstr($array_dat, '&test_name_array=');
			$datas1[] = $array_dat11;
		}
		
		
		$test_mate_array= $datas1[0];
		
		$test_mate_id_array= $_POST["test_mate_id_array"];
		$txt_bill_to= $_POST["txt_bill_to"];
		$other_customer_name= $_POST["other_customer_name"];
		$other_customer_address= $_POST["other_customer_address"];
		$other_customer_gst_no= $_POST["other_customer_gst_no"];
		$letter_heading= $_POST["letter_heading"];
		$letter_nos= $_POST["letter_nos"];
		$letter_dated= $_POST["letter_dated"];
		
		$txt_charge_one= $_POST["txt_charge_one"];
		$txt_charge_one_percentage= $_POST["txt_charge_one_percentage"];
		$txt_charge_two= $_POST["txt_charge_two"];
		$txt_charge_two_percentage= $_POST["txt_charge_two_percentage"];
		$txt_taxable= $_POST["txt_taxable"];
		$txt_round_up= $_POST["txt_round_up"];
		$txt_charge_one_amnt= $_POST["txt_charge_one_amnt"];
		$txt_charge_two_amnt= $_POST["txt_charge_two_amnt"];
		$txt_discount_percentage= $_POST["txt_discount_percentage"];
		$txt_discount_amnt= $_POST["txt_discount_amnt"];
		$bill_to_id= $_POST["bill_to_id"];
		//echo$bill_to_name= $_POST["bill_to_name"];exit;
		$bill_to_name= str_replace("QQQ","&",$_POST["bill_to_name"]);
		$perfoma_array= explode(",",$_POST["perfoma_array"]);
		$one_perfoma_nos= min($perfoma_array);
		$todays=date("Y-m-d");
		
		foreach($perfoma_array as $keyes => $get_one_perfoma)
		{
			$sel_estimates="select * from estimate_total_span where `perfoma_no`='$get_one_perfoma'";
			$query_estimates=mysqli_query($conn,$sel_estimates);
			if(mysqli_num_rows($query_estimates) > 0)
			{
				$get_estimate=mysqli_fetch_array($query_estimates);
				
				$in_trf_no=$get_estimate["trf_no"];
				$in_job_no=$get_estimate["job_no"];
				$in_bill_to=$get_estimate["bill_to"];
				$in_bill_to_id=$get_estimate["bill_to_id"];
				$in_bill_to_name=$get_estimate["bill_to_name"];
				$in_perfoma_no=$get_estimate["perfoma_no"];
				$in_merged_perfoma_no=$one_perfoma_nos;
				$in_letter_heading=$get_estimate["letter_heading"];
				$in_letter_nos=$get_estimate["letter_nos"];
				$in_letter_dated=$get_estimate["letter_dated"];
				$in_estimate_date=$get_estimate["estimate_date"];
				$in_agency_id=$get_estimate["agency_id"];
				$in_rate_type=$get_estimate["rate_type"];
				$in_gst_type=$get_estimate["gst_type"];
				$in_gst_in_or_ex=$get_estimate["gst_in_or_ex"];
				$in_gst_no=$get_estimate["gst_no"];
				$in_hsn_codes=$get_estimate["hsn_codes"];
				$in_make_by=$get_estimate["make_by"];
				$in_trf_no_array=$get_estimate["trf_no_array"];
				$in_mat_ids=$get_estimate["mat_ids"];
				$in_mate_name=$get_estimate["mate_name"];
				$in_test_ids=$get_estimate["test_ids"];
				$in_test_name=$get_estimate["test_name"];
				$in_test_qty=$get_estimate["test_qty"];
				$in_test_rates=$get_estimate["test_rates"];
				$in_test_totals=$get_estimate["test_totals"];
				$in_material_qty=$get_estimate["material_qty"];
				$in_material_rates=$get_estimate["material_rates"];
				$in_material_amnt=$get_estimate["material_amnt"];
				$in_c_gst_amt=$get_estimate["c_gst_amt"];
				$in_s_gst_amt=$get_estimate["s_gst_amt"];
				$in_i_gst_amt=$get_estimate["i_gst_amt"];
				$in_grand_total=$get_estimate["grand_total"];
				$in_charge_one=$get_estimate["charge_one"];
				$in_charge_one_percentage=$get_estimate["charge_one_percentage"];
				$in_charge_one_amount=$get_estimate["charge_one_amount"];
				$in_charge_two=$get_estimate["charge_two"];
				$in_charge_two_percentage=$get_estimate["charge_two_percentage"];
				$in_charge_two_amount=$get_estimate["charge_two_amount"];
				$in_discount_percentage=$get_estimate["discount_percentage"];
				$in_discount_amnt=$get_estimate["discount_amnt"];
				$in_taxable_amnt=$get_estimate["taxable_amnt"];
				$in_round_up_amnt=$get_estimate["round_up_amnt"];
				$in_total_amt=$get_estimate["total_amt"];
				$in_total_amt_in_word=$get_estimate["total_amt_in_word"];
				$in_print_counts=$get_estimate["print_counts"];
				
				// insert in merge table
				$ins_merged="insert into estimate_total_span_merged (`trf_no`,`job_no`,`bill_to`,`bill_to_id`,`bill_to_name`,`perfoma_no`,`merged_perfoma_no`,`letter_heading`,`letter_nos`,`letter_dated`,`estimate_date`,`agency_id`,`rate_type`,`gst_type`,`gst_in_or_ex`,`gst_no`,`hsn_codes`,`make_by`,`trf_no_array`,`mat_ids`,`mate_name`,`test_ids`,`test_name`,`test_qty`,`test_rates`,`test_totals`,`material_qty`,`material_rates`,`material_amnt`,`c_gst_amt`,`s_gst_amt`,`i_gst_amt`,`grand_total`,`charge_one`,`charge_one_percentage`,`charge_one_amount`,`charge_two`,`charge_two_percentage`,`charge_two_amount`,`discount_percentage`,`discount_amnt`,`taxable_amnt`,`round_up_amnt`,`total_amt`,`total_amt_in_word`,`print_counts`) 
						values(
						'$in_trf_no',
						'$in_job_no',
						'$in_bill_to',
						'$in_bill_to_id',
						'$in_bill_to_name',
						'$in_perfoma_no',
						'$in_merged_perfoma_no',
						'$in_letter_heading',
						'$in_letter_nos',
						'$in_letter_dated',
						'$in_estimate_date',
						'$in_agency_id',
						'$in_rate_type',
						'$in_gst_type',
						'$in_gst_in_or_ex',
						'$in_gst_no',
						'$in_hsn_codes',
						'$in_make_by',
						'$in_trf_no_array',
						'$in_mat_ids',
						'$in_mate_name',
						'$in_test_ids',
						'$in_test_name',
						'$in_test_qty',
						'$in_test_rates',
						'$in_test_totals',
						'$in_material_qty',
						'$in_material_rates',
						'$in_material_amnt',
						'$in_c_gst_amt',
						'$in_s_gst_amt',
						'$in_i_gst_amt',
						'$in_grand_total',
						'$in_charge_one',
						'$in_charge_one_percentage',
						'$in_charge_one_amount',
						'$in_charge_two',
						'$in_charge_two_percentage',
						'$in_charge_two_amount',
						'$in_discount_percentage',
						'$in_discount_amnt',
						'$in_taxable_amnt',
						'$in_round_up_amnt',
						'$in_total_amt',
						'$in_total_amt_in_word',
						'$in_print_counts')";
						
						mysqli_query($conn,$ins_merged);
					// delete from estimate table but not min perfoma no	
					if($get_one_perfoma != $one_perfoma_nos)
					{
						$dele_estiamte="delete from estimate_total_span where `perfoma_no`='$get_one_perfoma'";
						mysqli_query($conn,$dele_estiamte);
					}
				
			}
		}
		
		$update_est="update estimate_total_span set `trf_no`='$txt_trf_no',`job_no`='$txt_job_no',`estimate_no`='$txt_invoice_no',`gst_no`='$gst_no',`hsn_codes`='$hsn_codes',`estimate_date`='$invoice_date',`agency_id`='$hidden_agency',`rate_type`='$select_rate',`gst_type`='$hidden_gst_type',`gst_in_or_ex`='$hidden_gst_in_ex',`test_ids`='$test_ids_array',`test_name`='$test_name_array',`test_qty`='$test_qty_array',`test_rates`='$test_rates_array',`test_totals`='$test_amnt_array',`c_gst_amt`='$txt_cgst',`s_gst_amt`='$txt_sgst',`i_gst_amt`='$txt_igst',`grand_total`='$txt_grand',`total_amt`='$total_amt',`total_amt_in_word`='$txt_amt_in_word',`trf_no_array`='$test_trf_id_array',`mate_name`='$test_mate_array',`mat_ids`='$test_mate_id_array',`bill_to`='$txt_bill_to',`other_customer_name`='$other_customer_name',`other_customer_address`='$other_customer_address',`other_customer_gst_no`='$other_customer_gst_no',`letter_heading`='$letter_heading',`letter_nos`='$letter_nos',`letter_dated`='$letter_dated',`charge_one`='$txt_charge_one',`charge_one_percentage`='$txt_charge_one_percentage',`charge_two`='$txt_charge_two',`charge_two_percentage`='$txt_charge_two_percentage',`taxable_amnt`='$txt_taxable',`round_up_amnt`='$txt_round_up',`charge_one_amount`='$txt_charge_one_amnt',`charge_two_amount`='$txt_charge_two_amnt',`discount_percentage`='$txt_discount_percentage',`discount_amnt`='$txt_discount_amnt',`bill_to_id`='$bill_to_id',`bill_to_name`='$bill_to_name' where `perfoma_no`='$one_perfoma_nos'";
		
		$result_insert_estimate=mysqli_query($conn,$update_est);
	
		
	}else if($_POST['action_type'] == 'merge_perfoma_material')
	{
		
		$txt_trf_no= $_POST["txt_trf_no"];
		$txt_job_no= $_POST["txt_job_no"];
		$gst_no= $_POST["gst_no"];
		$hsn_codes= $_POST["hsn_codes"];
		$squence_no= $_POST["squence_no"];
		$perfoma_no= $_POST["perfoma_no"];
		$txt_invoice_no= $_POST["txt_invoice_no"];
		$replace_date= str_replace("/","-",$_POST['invoice_date']);
		$invoice_date= date('Y-m-d', strtotime($replace_date));
		$select_rate_explode= explode("|",$_POST["select_rate"]);
		$select_rate=$select_rate_explode[0];
		$hidden_gst_type= $_POST["hidden_gst_type"];
		$hidden_gst_in_ex= $_POST["hidden_gst_in_ex"];
		$txt_cgst= $_POST["txt_cgst"];
		$txt_sgst= $_POST["txt_sgst"];
		$txt_igst= $_POST["txt_igst"];
		$txt_grand= $_POST["txt_grand"];
		$txt_amt_in_word= $_POST["txt_amt_in_word"];
		$total_amt= $_POST["total_amt"];
		$hidden_agency= $_POST["hidden_agency"];
		$raw_post = file_get_contents('php://input');
		
		$test_trf_id_array= $_POST["test_trf_id_array"];
		$test_mate_id_array= $_POST["test_mate_id_array"];
		$test_mate_array= $_POST["test_mate_array"];
		$mate_qty_array= $_POST["mate_qty_array"];
		$mate_rates_array= $_POST["mate_rates_array"];
		$mat_amnt_array= $_POST["mat_amnt_array"];
		

		
		$txt_bill_to= $_POST["txt_bill_to"];
		$other_customer_name= $_POST["other_customer_name"];
		$other_customer_address= $_POST["other_customer_address"];
		$other_customer_gst_no= $_POST["other_customer_gst_no"];
		$letter_heading= $_POST["letter_heading"];
		$letter_nos= $_POST["letter_nos"];
		$letter_dated= $_POST["letter_dated"];
		
		$txt_charge_one= $_POST["txt_charge_one"];
		$txt_charge_one_percentage= $_POST["txt_charge_one_percentage"];
		$txt_charge_two= $_POST["txt_charge_two"];
		$txt_charge_two_percentage= $_POST["txt_charge_two_percentage"];
		$txt_taxable= $_POST["txt_taxable"];
		$txt_round_up= $_POST["txt_round_up"];
		$txt_charge_one_amnt= $_POST["txt_charge_one_amnt"];
		$txt_charge_two_amnt= $_POST["txt_charge_two_amnt"];
		$txt_discount_percentage= $_POST["txt_discount_percentage"];
		$txt_discount_amnt= $_POST["txt_discount_amnt"];
		$bill_to_id= $_POST["bill_to_id"];
		//echo$bill_to_name= $_POST["bill_to_name"];exit;
		$bill_to_name= str_replace("QQQ","&",$_POST["bill_to_name"]);
		$perfoma_array= explode(",",$_POST["perfoma_array"]);
		$one_perfoma_nos= min($perfoma_array);
		
		$todays=date("Y-m-d");
		
		foreach($perfoma_array as $keyes => $get_one_perfoma)
		{
			$sel_estimates="select * from estimate_total_span where `perfoma_no`='$get_one_perfoma'";
			$query_estimates=mysqli_query($conn,$sel_estimates);
			if(mysqli_num_rows($query_estimates) > 0)
			{
				$get_estimate=mysqli_fetch_array($query_estimates);
				
				$in_trf_no=$get_estimate["trf_no"];
				$in_job_no=$get_estimate["job_no"];
				$in_bill_to=$get_estimate["bill_to"];
				$in_bill_to_id=$get_estimate["bill_to_id"];
				$in_bill_to_name=$get_estimate["bill_to_name"];
				$in_perfoma_no=$get_estimate["perfoma_no"];
				$in_merged_perfoma_no=$one_perfoma_nos;
				$in_letter_heading=$get_estimate["letter_heading"];
				$in_letter_nos=$get_estimate["letter_nos"];
				$in_letter_dated=$get_estimate["letter_dated"];
				$in_estimate_date=$get_estimate["estimate_date"];
				$in_agency_id=$get_estimate["agency_id"];
				$in_rate_type=$get_estimate["rate_type"];
				$in_gst_type=$get_estimate["gst_type"];
				$in_gst_in_or_ex=$get_estimate["gst_in_or_ex"];
				$in_gst_no=$get_estimate["gst_no"];
				$in_hsn_codes=$get_estimate["hsn_codes"];
				$in_make_by=$get_estimate["make_by"];
				$in_trf_no_array=$get_estimate["trf_no_array"];
				$in_mat_ids=$get_estimate["mat_ids"];
				$in_mate_name=$get_estimate["mate_name"];
				$in_test_ids=$get_estimate["test_ids"];
				$in_test_name=$get_estimate["test_name"];
				$in_test_qty=$get_estimate["test_qty"];
				$in_test_rates=$get_estimate["test_rates"];
				$in_test_totals=$get_estimate["test_totals"];
				$in_material_qty=$get_estimate["material_qty"];
				$in_material_rates=$get_estimate["material_rates"];
				$in_material_amnt=$get_estimate["material_amnt"];
				$in_c_gst_amt=$get_estimate["c_gst_amt"];
				$in_s_gst_amt=$get_estimate["s_gst_amt"];
				$in_i_gst_amt=$get_estimate["i_gst_amt"];
				$in_grand_total=$get_estimate["grand_total"];
				$in_charge_one=$get_estimate["charge_one"];
				$in_charge_one_percentage=$get_estimate["charge_one_percentage"];
				$in_charge_one_amount=$get_estimate["charge_one_amount"];
				$in_charge_two=$get_estimate["charge_two"];
				$in_charge_two_percentage=$get_estimate["charge_two_percentage"];
				$in_charge_two_amount=$get_estimate["charge_two_amount"];
				$in_discount_percentage=$get_estimate["discount_percentage"];
				$in_discount_amnt=$get_estimate["discount_amnt"];
				$in_taxable_amnt=$get_estimate["taxable_amnt"];
				$in_round_up_amnt=$get_estimate["round_up_amnt"];
				$in_total_amt=$get_estimate["total_amt"];
				$in_total_amt_in_word=$get_estimate["total_amt_in_word"];
				$in_print_counts=$get_estimate["print_counts"];
				
				// insert in merge table
				$ins_merged="insert into estimate_total_span_merged (`trf_no`,`job_no`,`bill_to`,`bill_to_id`,`bill_to_name`,`perfoma_no`,`merged_perfoma_no`,`letter_heading`,`letter_nos`,`letter_dated`,`estimate_date`,`agency_id`,`rate_type`,`gst_type`,`gst_in_or_ex`,`gst_no`,`hsn_codes`,`make_by`,`trf_no_array`,`mat_ids`,`mate_name`,`test_ids`,`test_name`,`test_qty`,`test_rates`,`test_totals`,`material_qty`,`material_rates`,`material_amnt`,`c_gst_amt`,`s_gst_amt`,`i_gst_amt`,`grand_total`,`charge_one`,`charge_one_percentage`,`charge_one_amount`,`charge_two`,`charge_two_percentage`,`charge_two_amount`,`discount_percentage`,`discount_amnt`,`taxable_amnt`,`round_up_amnt`,`total_amt`,`total_amt_in_word`,`print_counts`) 
						values(
						'$in_trf_no',
						'$in_job_no',
						'$in_bill_to',
						'$in_bill_to_id',
						'$in_bill_to_name',
						'$in_perfoma_no',
						'$in_merged_perfoma_no',
						'$in_letter_heading',
						'$in_letter_nos',
						'$in_letter_dated',
						'$in_estimate_date',
						'$in_agency_id',
						'$in_rate_type',
						'$in_gst_type',
						'$in_gst_in_or_ex',
						'$in_gst_no',
						'$in_hsn_codes',
						'$in_make_by',
						'$in_trf_no_array',
						'$in_mat_ids',
						'$in_mate_name',
						'$in_test_ids',
						'$in_test_name',
						'$in_test_qty',
						'$in_test_rates',
						'$in_test_totals',
						'$in_material_qty',
						'$in_material_rates',
						'$in_material_amnt',
						'$in_c_gst_amt',
						'$in_s_gst_amt',
						'$in_i_gst_amt',
						'$in_grand_total',
						'$in_charge_one',
						'$in_charge_one_percentage',
						'$in_charge_one_amount',
						'$in_charge_two',
						'$in_charge_two_percentage',
						'$in_charge_two_amount',
						'$in_discount_percentage',
						'$in_discount_amnt',
						'$in_taxable_amnt',
						'$in_round_up_amnt',
						'$in_total_amt',
						'$in_total_amt_in_word',
						'$in_print_counts')";
						
						mysqli_query($conn,$ins_merged);
					// delete from estimate table but not min perfoma no	
					if($get_one_perfoma != $one_perfoma_nos)
					{
						$dele_estiamte="delete from estimate_total_span where `perfoma_no`='$get_one_perfoma'";
						mysqli_query($conn,$dele_estiamte);
					}
				
			}
		}
		
		$update_est="update estimate_total_span set `trf_no`='$txt_trf_no',`job_no`='$txt_job_no',`estimate_no`='$txt_invoice_no',`gst_no`='$gst_no',`hsn_codes`='$hsn_codes',`estimate_date`='$invoice_date',`agency_id`='$hidden_agency',`rate_type`='$select_rate',`gst_type`='$hidden_gst_type',`gst_in_or_ex`='$hidden_gst_in_ex',`c_gst_amt`='$txt_cgst',`s_gst_amt`='$txt_sgst',`i_gst_amt`='$txt_igst',`grand_total`='$txt_grand',`total_amt`='$total_amt',`total_amt_in_word`='$txt_amt_in_word',`trf_no_array`='$test_trf_id_array',`mate_name`='$test_mate_array',`mat_ids`='$test_mate_id_array',`material_qty`='$mate_qty_array',`material_rates`='$mate_rates_array',`material_amnt`='$mat_amnt_array',`bill_to`='$txt_bill_to',`other_customer_name`='$other_customer_name',`other_customer_address`='$other_customer_address',`other_customer_gst_no`='$other_customer_gst_no',`letter_heading`='$letter_heading',`letter_nos`='$letter_nos',`letter_dated`='$letter_dated',`charge_one`='$txt_charge_one',`charge_one_percentage`='$txt_charge_one_percentage',`charge_two`='$txt_charge_two',`charge_two_percentage`='$txt_charge_two_percentage',`taxable_amnt`='$txt_taxable',`round_up_amnt`='$txt_round_up',`charge_one_amount`='$txt_charge_one_amnt',`charge_two_amount`='$txt_charge_two_amnt',`discount_percentage`='$txt_discount_percentage',`discount_amnt`='$txt_discount_amnt',`bill_to_id`='$bill_to_id',`bill_to_name`='$bill_to_name' where `perfoma_no`='$one_perfoma_nos'";
		
		$result_insert_estimate=mysqli_query($conn,$update_est);
		
	}
}

// convert in word function_exists
function numtowords($num){
	$number = $num;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
 // return $result . "Rupees  " . $points;
 return $result . "Rupees  ";
}
?>
