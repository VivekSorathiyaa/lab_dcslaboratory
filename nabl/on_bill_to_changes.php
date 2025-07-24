<?php
error_reporting(1);
session_start();
include("connection.php");
if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'on_bill_chages'){

		$txt_bill_to=$_POST["txt_bill_to"];
		$txt_one_trf=$_POST["txt_one_trf"];
		$sel_job="select * from job where `trf_no`='$txt_one_trf'";
		$query_job= mysqli_query($conn,$sel_job);
		$result_job=mysqli_fetch_array($query_job);
		$get_agency_id= $result_job["agency"];
		$client_code= $result_job["client_code"];

		$sel_agency="select * from agency_master where `agency_id`=".$get_agency_id;
		$query_agency= mysqli_query($conn,$sel_agency);
		$result_agency=mysqli_fetch_array($query_agency);
		$get_agency_gst_no= $result_agency["agency_gstno"];
		$agency_city= $result_agency["agency_city"];
		$agency_naming= $result_agency["agency_name"];
		$agency_ids= $result_agency["agency_id"];

		$sel_client="select * from client where `client_code`='$client_code'";
		$query_client= mysqli_query($conn,$sel_client);
		$result_client=mysqli_fetch_array($query_client);
		$get_client_gst_no= $result_client["gst_no"];
		$client_city= $result_client["client_city"];
		$clientnaming= $result_client["clientname"];
		$clientid= $result_client["client_code"];

		if($txt_bill_to=="0"){
			$set_gst_nos=$get_agency_gst_no;
			$sel_city="select * from city where `id`=".$agency_city;
			$query_city= mysqli_query($conn,$sel_city);
			$result_city=mysqli_fetch_array($query_city);
			$state_ids=$result_city["state_id"];
			$bill_to_id=$agency_ids;
			$bill_to_name=$agency_naming;
		}else if($txt_bill_to=="1"){
			$set_gst_nos=$get_client_gst_no;
			$sel_city="select * from city where `id`=".$client_city;
			$query_city= mysqli_query($conn,$sel_city);
			$result_city=mysqli_fetch_array($query_city);
			$state_ids=$result_city["state_id"];
			$bill_to_id=$clientid;
			$bill_to_name=$clientnaming;
		}else{
			$set_gst_nos="";
			$state_ids="0";
			$bill_to_id="0";
			$bill_to_name="";
		}
		$fill=array("set_gst_nos" => $set_gst_nos,"state_ids" => $state_ids,"bill_to_id" => $bill_to_id,"bill_to_name" => $bill_to_name);

			echo json_encode($fill);
	} else if($_POST['action_type'] == 'on_make_by_change')
	{
		$txt_make_by=$_POST["txt_make_by"];
		$get_rate_type=$_POST["get_rate_type"];
		$bill_to_id=$_POST["bill_to_id"];
		$get_chk_array= explode(",",$_POST["txt_trf_no"]);
		$job_no=$_POST["txt_job_no"];
		if($txt_make_by=="0")
		{
		$count_rows=0;
		$now_array=array();
		foreach($get_chk_array as $one_chk_array)
		{
		?>
			<tr>
			<td colspan="6"><b style="font-size:14px;">Job No: <?php echo $one_chk_array;?></b></th>
			</tr>
			<?php
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
											$merge_material_id_array=array();
											$merge_material_name_array=array();
											$merge_test_id_array=array();
											$merge_test_name_array=array();
											$merge_test_qty_array=array();
											$merge_test_rate_array=array();
											$merge_test_amt_array=array();

											$select_final_mat="select * from final_material_assign_master where `trf_no`='$one_chk_array' AND `job_no`='$job_no'";

											$get_final_mat=mysqli_query($conn,$select_final_mat);
											if(mysqli_num_rows($get_final_mat) > 0)
											{
											while($one_final_mat_id=mysqli_fetch_array($get_final_mat))
											{

											// code for get test by report no and job no
											$select_test_wise="select * from test_wise_material_rate where `final_material_id`='$one_final_mat_id[final_material_id]' AND `material_cat_id`='$one_final_mat_id[material_category]' AND `material_id`='$one_final_mat_id[material_id]'";
											 $select_test_wise_query=mysqli_query($conn,$select_test_wise);

											$get_total_amt=0;

													if(mysqli_num_rows($select_test_wise_query) > 0)
													{

													while($get_test=mysqli_fetch_array($select_test_wise_query))
													{

														if($one_final_mat_id["material_category"] == "10" && $one_final_mat_id["material_id"] == "135")
														{
															$set_qty= $one_final_mat_id["steel_set_qty"];

														}else if($one_final_mat_id["material_category"] == "5" && $one_final_mat_id["material_id"] == "129")
														{


															$sel_spans="select * from span_material_assign where `final_material_id`='$one_final_mat_id[final_material_id]' AND `material_category`='$one_final_mat_id[material_category]' AND `material_id`='$one_final_mat_id[material_id]' AND `test`='$get_test[test_id]'";
															$result_spans=mysqli_query($conn,$sel_spans);
															$get_spanes=mysqli_fetch_array($result_spans);
															$set_qty= $get_spanes["cc_qty"];

														}else if($one_final_mat_id["material_category"] == "5" && $one_final_mat_id["material_id"] == "143")
														{


															$sel_spans="select * from span_material_assign where `final_material_id`='$one_final_mat_id[final_material_id]' AND `material_category`='$one_final_mat_id[material_category]' AND `material_id`='$one_final_mat_id[material_id]' AND `test`='$get_test[test_id]'";
															$result_spans=mysqli_query($conn,$sel_spans);
															$get_spanes=mysqli_fetch_array($result_spans);
															$set_qty= $get_spanes["cc_qty"];

														}else{
															$set_qty= 1;
														}

														// set logic for qty s setting.php pge
													$sel_from_mterial="select * from material where `filename`='testings.php' AND `mat_category_id`='$one_final_mat_id[material_category]' AND `id`=".$one_final_mat_id["material_id"];
														$result_from_mterial=mysqli_query($conn,$sel_from_mterial);
														if(mysqli_num_rows($result_from_mterial) > 0)
														{
															$sel_span="select * from span_material_assign where `final_material_id`='$one_final_mat_id[final_material_id]' AND `material_category`='$one_final_mat_id[material_category]' AND `material_id`='$one_final_mat_id[material_id]' AND `test`='$get_test[test_id]'";
															$result_span=mysqli_query($conn,$sel_span);
															$get_span=mysqli_fetch_array($result_span);
															$set_qty= $get_span["excel_qty"];
														}

														$get_total_amt += $get_test["amt"];

														$sel_test_name="select * from test_master where `test_id`=".$get_test["test_id"];
														$sel_test_query=mysqli_query($conn,$sel_test_name);
														$get_test_record=mysqli_fetch_array($sel_test_query);

														$sel_cats="select * from material_category where `material_cat_id`=".$get_test_record["mat_category_id"];
														$sel_cats_query=mysqli_query($conn,$sel_cats);
														$get_cats=mysqli_fetch_array($sel_cats_query);

															if($get_rate_type=="0")
															{
																$ratingses= $get_test_record["test_rate_gov"];

																$sel_agency_rate="select * from agency_rate_master where `agency`='$bill_to_id' AND `rate_type`='0' AND `mat_category_id`='$get_test_record[mat_category_id]' AND `test_id`='$get_test[test_id]'";
																$sel_agency_query=mysqli_query($conn,$sel_agency_rate);
																if(mysqli_num_rows($sel_agency_query) > 0){
																	$get_agencys=mysqli_fetch_array($sel_agency_query);
																	$ratingses=$get_agencys["new_rate"];
																}
															}
															if($get_rate_type=="1")
															{
																$ratingses= $get_test_record["test_rate_private"];

																$sel_agency_rate="select * from agency_rate_master where `agency`='$bill_to_id' AND `rate_type`='1' AND `mat_category_id`='$get_test_record[mat_category_id]' AND `test_id`='$get_test[test_id]'";
																$sel_agency_query=mysqli_query($conn,$sel_agency_rate);
																if(mysqli_num_rows($sel_agency_query) > 0){
																	$get_agencys=mysqli_fetch_array($sel_agency_query);
																	$ratingses=$get_agencys["new_rate"];
																}
															}
															if($get_rate_type=="2")
															{
																$ratingses= $get_test_record["test_rate"];
															}

														// if test id not in array
														if (!in_array($get_test_record["test_id"], $merge_test_id_array))
														{
															array_push($merge_material_id_array,$get_cats["material_cat_id"]);
															array_push($merge_material_name_array,$get_cats["material_cat_name"]);
															array_push($merge_test_id_array,$get_test_record["test_id"]);
															array_push($merge_test_name_array,$get_test_record["test_name"]);
															array_push($merge_test_qty_array,$set_qty);
															array_push($merge_test_rate_array,$ratingses);

															$totalings= intval($set_qty) * intval($ratingses);

															array_push($merge_test_amt_array,$totalings);
														}
														else
														{
															// plus qty in qty_array
															$keys = array_search($get_test_record["test_id"], $merge_test_id_array);

															 $get_qty_by_key=$merge_test_qty_array[$keys];
															$plus_qty= intval($get_qty_by_key)+ intval($set_qty);
															$merge_test_qty_array[$keys]= $plus_qty;

															// plus amnt in qty_amt
															$keying = array_search($get_test_record["test_id"], $merge_test_id_array);
															$get_amt_by_key=$merge_test_amt_array[$keying];

															$totalings= intval($set_qty) * intval($ratingses);

															$plus_amt= intval($get_amt_by_key)+ intval($totalings);
															$merge_test_amt_array[$keying]= $plus_amt;
														}
													}

													}
													}
												    }

													//array_reverse($merge_material_name_array);
													foreach($merge_test_id_array as $keyer => $one_test_id)
													{
													?>

													<tr>
														  <td>
														  <input type="hidden" name="mt_id[]" class="class_trf_id" id="trfid_<?php echo $keyer;?>" value="<?php echo $one_chk_array;?>">

														  <input type="hidden" name="mt_id[]" class="class_mate_id" id="mateid_<?php echo $count_rows;?>" value="<?php echo $merge_material_id_array[$keyer]; ?>">
														  <input type="text" name="mat_name[]" class="form-control class_mate_name" id="matename_<?php echo $count_rows;?>" value="<?php echo $merge_material_name_array[$keyer]; ?>" disabled style="width:200px;font-weight:bold;">
														  </td>
														  <td>
															<input type="hidden" name="test_id[]" class="class_test_id" id="testid_<?php echo $count_rows;?>" value="<?php echo $one_test_id;?>">
															<input type="text" name="test_name[]" class="form-control class_test" id="test_<?php echo $count_rows;?>" value="<?php echo $merge_test_name_array[$keyer];?>" >
															</td>
															<td>
															<input type="text" name="qty[]" class="form-control class_qty" id="qty_<?php echo $count_rows;?>" value="<?php echo $merge_test_qty_array[$keyer];?>" >
															</td>
															<td>
															<input type="text" name="rate[]" class="form-control txt_rate_class" id="rate_<?php echo $count_rows;?>" value="<?php echo $merge_test_rate_array[$keyer];?>">
															</td>
															<td>
															  <input type="text" name="amt[]" class="form-control class_amnt" id="amt_<?php echo $count_rows;?>" value="<?php echo $merge_test_qty_array[$keyer] * $merge_test_rate_array[$keyer];?>" disabled>
															</td>
															<!--<td>
																<a href="JavaScript:void(0)" class="remove_button btn btn-primary" title="Remove field" style=""><b>X</b></a>
															</td>-->

														  </tr>
													<?php
													$count_rows++;
													}
													}
	}else{
		$now_array=array();
		$count_rows=0;
		foreach($get_chk_array as $one_chk_arrays)
		{
	   $get_material_id_array=array();
	   $get_material_name_array=array();
	   $get_material_qty_array=array();
	   $get_material_rate_array=array();

	   $sel_test_mater="select *,`final_material_id`,count(final_material_id) as get_count from test_wise_material_rate where `trf_no`='$one_chk_arrays' AND `job_no`='$job_no'  AND `is_deleted`=0 GROUP BY final_material_id";

		$perfoma_query= mysqli_query($conn,$sel_test_mater);

		if(mysqli_num_rows($perfoma_query) > 0)
		{
			while($one_perfoma=mysqli_fetch_array($perfoma_query))
			{
				$material_cat_id=$one_perfoma["material_cat_id"];
				$sel_mat_cat="select `material_cat_name` from material_category where `material_cat_id`=".$material_cat_id;
				$cat_query= mysqli_query($conn,$sel_mat_cat);
				$one_cat_query=mysqli_fetch_array($cat_query);
				$material_cat_name=$one_cat_query["material_cat_name"];

				$material_id=$one_perfoma["material_id"];
				$sel_mat_id="select * from material where `id`=".$material_id;
				$smat_id_query= mysqli_query($conn,$sel_mat_id);
				$one_mat_id=mysqli_fetch_array($smat_id_query);

				if($get_rate_type=="0")
				{
					$material_rates=$one_mat_id["rate_govt"];

					$sel_agency_rate="select * from agency_rate_by_material where `agency_id`='$bill_to_id' AND `rate_type`='0' AND `material_id`='$material_id'";
					$sel_agency_query=mysqli_query($conn,$sel_agency_rate);
					if(mysqli_num_rows($sel_agency_query) > 0){
						$get_agencys=mysqli_fetch_array($sel_agency_query);

						$material_rates=$get_agencys["new_rate"];
					}
				}
				if($get_rate_type=="1")
				{
					$material_rates=$one_mat_id["rate_private"];

					$sel_agency_rate="select * from agency_rate_by_material where `agency_id`='$bill_to_id' AND `rate_type`='1' AND `material_id`='$material_id'";
					$sel_agency_query=mysqli_query($conn,$sel_agency_rate);
					if(mysqli_num_rows($sel_agency_query) > 0){
						$get_agencys=mysqli_fetch_array($sel_agency_query);

						$material_rates=$get_agencys["new_rate"];
					}
				}
				if($get_rate_type=="2")
				{
					$material_rates=$one_mat_id["rate_other"];
				}


				$sel_final="select * from final_material_assign_master where `final_material_id`=".$one_perfoma["final_material_id"];
				$smat_final= mysqli_query($conn,$sel_final);
				$one_final=mysqli_fetch_array($smat_final);

			if($one_final["material_category"] == "10" && $one_final["material_id"] == "135")
			{
				$set_qty= $one_final["steel_set_qty"];

			}else if($one_final["material_category"] == "5" && $one_final["material_id"] == "129")
			{
				$sel_spans="select * from span_material_assign where `final_material_id`='$one_final[final_material_id]' AND `material_category`='$one_final[material_category]' AND `material_id`='$one_final[material_id]'";
				$result_spans=mysqli_query($conn,$sel_spans);
				$get_spans=mysqli_fetch_array($result_spans);

				$set_qty= $get_spans["cc_qty"];
			}else if($one_final["material_category"] == "5" && $one_final["material_id"] == "143")
			{
				$sel_spans="select * from span_material_assign where `final_material_id`='$one_final[final_material_id]' AND `material_category`='$one_final[material_category]' AND `material_id`='$one_final[material_id]'";
				$result_spans=mysqli_query($conn,$sel_spans);
				$get_spans=mysqli_fetch_array($result_spans);

				$set_qty= $get_spans["cc_qty"];
			}else{
				$set_qty= 1;
			}

			$sel_from_mterial="select * from material where `filename`='testings.php' AND `mat_category_id`='$one_final[material_category]' AND `id`=".$one_final["material_id"];
			$result_from_mterial=mysqli_query($conn,$sel_from_mterial);
			if(mysqli_num_rows($result_from_mterial) > 0)
			{
				$sel_span="select * from span_material_assign where `final_material_id`='$one_final[final_material_id]' AND `material_category`='$one_final[material_category]' AND `material_id`='$one_final[material_id]'";
				$result_span=mysqli_query($conn,$sel_span);
				if(mysqli_num_rows($result_span) > 0)
				{
					$set_qty=0;
					while($get_span=mysqli_fetch_array($result_span))
					{
						$set_qty= intval($get_span["excel_qty"]);
					}
				}

			}

			if (!in_array($material_cat_id, $get_material_id_array))
			{
				array_push($get_material_id_array,$material_cat_id);
				array_push($get_material_name_array,$material_cat_name);
				array_push($get_material_qty_array,$set_qty);
				array_push($get_material_rate_array,$material_rates);
			}
			else{
				$keys = array_search ($material_cat_id, $get_material_id_array);
				$plus= intval($get_material_qty_array[$keys]) + intval($set_qty);
				$get_material_qty_array[$keys] = $plus;
			}
			}

		}
		?>
		<tr>
		<td colspan="6"><b style="font-size:14px;">Job No: <?php echo $one_chk_arrays;?></b></th>
		</tr>
		<?php
		$sel_jobs="select nameofwork from job where `trf_no`='$one_chk_arrays'";
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
		foreach($get_material_id_array as $mat_key=> $one_material)
		{
		?>
		<tr>
		<td>
		<input type="hidden" name="mt_id[]" class="class_trf_id" id="trfid_<?php echo $keyer;?>" value="<?php echo $one_chk_arrays;?>">
		<input type="hidden" name="material_ids[]" class="form-control class_material_id" id="" value="<?php echo $one_material; ?>" disabled>
		<input type="text" name="material_names[]" class="form-control class_material_name" id="material_names" value="<?php echo $get_material_name_array[$mat_key]; ?>" disabled>
		</td>
		<td>
		<input type="text" name="material_qty[]" class="form-control class_material_qty" id="materialqty_<?php echo $count_rows;?>" value="<?php echo $get_material_qty_array[$mat_key]; ?>" >
		</td>
		<td>
		<input type="text" name="material_rating[]" class="form-control class_material_rates" id="materialrating_<?php echo $count_rows;?>" value="<?php echo $get_material_rate_array[$mat_key]; ?>" >
		</td>
		<td>

		<?php
		// multification of qty and material_rate
			$multi_of_qty_and_mate_rate= intval($get_material_qty_array[$mat_key]) * intval($get_material_rate_array[$mat_key]);
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
