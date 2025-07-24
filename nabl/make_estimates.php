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

	$sel_estiamte="select * from estimate_total_span where `perfoma_no`='$_GET[perfoma_nos]'";
 
 $estiamte_query= mysqli_query($conn,$sel_estiamte);
 if(mysqli_num_rows($estiamte_query) > 0){
	 
	 $get_estimate= mysqli_fetch_array($estiamte_query);
	 $get_rate_type= $get_estimate["rate_type"];
	 $get_gst_type= $get_estimate["gst_type"];
	 $get_c_gst_amt= $get_estimate["c_gst_amt"];
	 $get_s_gst_amt= $get_estimate["s_gst_amt"];
	 $get_i_gst_amt= $get_estimate["i_gst_amt"];
	 $get_grand_total= $get_estimate["grand_total"];
	 $charge_one= $get_estimate["charge_one"];
	 $charge_one_percentage= $get_estimate["charge_one_percentage"];
	 $charge_one_amount= $get_estimate["charge_one_amount"];
	 $charge_two= $get_estimate["charge_two"];
	 $charge_two_percentage= $get_estimate["charge_two_percentage"];
	 $charge_two_amount= $get_estimate["charge_two_amount"];
	 $taxable_amnt= $get_estimate["taxable_amnt"];
	 $round_up_amnt= $get_estimate["round_up_amnt"];
	 $get_total_amount= $get_estimate["total_amt"];
	 $get_total_amt_in_word= $get_estimate["total_amt_in_word"];
	 $hsn_codes= $get_estimate["hsn_codes"];
	 $estimate_perfoma_no= $get_estimate["perfoma_no"];
	 $bill_to= $get_estimate["bill_to"];
	 $other_customer_name= $get_estimate["other_customer_name"];
	 $other_customer_address= $get_estimate["other_customer_address"];
	 $other_customer_gst_no= $get_estimate["other_customer_gst_no"];
	 $discount_percentage= $get_estimate["discount_percentage"];
	 $discount_amnt= $get_estimate["discount_amnt"];
	 $perfoma_date= date("d/m/Y",strtotime($get_estimate["estimate_date"]));
	 
	 $letter_heading= $get_estimate["letter_heading"];
	 $letter_nos= $get_estimate["letter_nos"];
	 $letter_dated= $get_estimate["letter_dated"];
	 $est_id= $get_estimate["est_id"];
	 $nabl_type= $get_estimate["nabl_type"];
	 
	 $gst_in_or_ex= $get_estimate["gst_in_or_ex"];
	 $mate_ids= explode(",",$get_estimate["mat_ids"]);
	 $mate_name= explode(",",$get_estimate["mate_name"]);
	 $material_qty= explode(",",$get_estimate["material_qty"]);
	 $material_rates= explode(",",$get_estimate["material_rates"]);
	 $material_amnt= explode(",",$get_estimate["material_amnt"]);
	 $trf_no_array= explode(",",$get_estimate["trf_no_array"]);
	 
	 $branch_short_code = $get_estimate["branch_short_code"];
	
	 $sel_branch = "select * from branches where `branch_short_code`='$branch_short_code'";
	 $query_branch = mysqli_query($conn, $sel_branch);
	 $row_branch = mysqli_fetch_array($query_branch);
	 $estimate_start=$row_branch["estimate_start"];
	 
 }
	$get_chk_array= explode(",",$get_estimate["trf_no"]);
	
	$txt_trf_no= $get_chk_array[0];
	$txt_jobs= $get_chk_array[0];
	$sel_job="select * from job where `trf_no`='$txt_trf_no'";
$query_job= mysqli_query($conn,$sel_job);
$result_job=mysqli_fetch_array($query_job);
  
// to get job for agency id
$sel_job="select * from job where `trf_no`='$txt_trf_no'";
$query_job= mysqli_query($conn,$sel_job);
$result_job=mysqli_fetch_array($query_job);
$get_agency_id= $result_job["agency"];
$agency_city= $result_job["agency_city"];
$clientnaming= $result_job["clientname"];

$sel_agency="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$get_agency_id;
$query_agency= mysqli_query($conn,$sel_agency);
$result_agency=mysqli_fetch_array($query_agency);
$get_agency_gst_no= $result_agency["agency_gstno"];
$agency_naming= $result_agency["agency_name"];

	$merge_upload_document='';
		foreach($get_chk_array as $one_chk_array)
		{
			$sel_jobs_doc="select * from `job` where `trf_no`='$one_chk_array'";
			$query_jobs_doc = mysqli_query($conn, $sel_jobs_doc);
			$result_jobs_doc = mysqli_fetch_array($query_jobs_doc);
			if($result_jobs_doc["scan_document"]!="")
			{
				$merge_upload_document .='<iframe src="'.$base_url.'scan_document/'.$result_jobs_doc["scan_document"].'" style="height:1120px;width:1105px;"></iframe>';
			}
		}
		
	//set estimate no 
	$sel_estimate_no="select MAX(estimate_numbers) as maxes from estimate_total_span where estimate_numbers !='0' order by est_id ASC LIMIT 0,1";
	$query_estimate_no=mysqli_query($conn,$sel_estimate_no);
	if(mysqli_num_rows($query_estimate_no) > 0)
	{
		$result_est_no = mysqli_fetch_array($query_estimate_no);
		$estiamtes_no=$result_est_no["maxes"];
		$explode_esti_no=explode("/",$estiamtes_no);
		$plus_nos= intval(end($explode_esti_no)) + 1;
		
		$set_est_no= sprintf('%04d', $plus_nos);
		$estimates_no=$estimate_start.$set_est_no;
	}
	else
	{
		$estimates_no=$estimate_start."0001";
	}
	
	$today= date("Y-m-d");	
	$sel_fy_years="select * from fyearmaster where `id`='$_SESSION[fy_id]'";
	$query_f_year=mysqli_query($conn, $sel_fy_years);
	$result_f_year = mysqli_fetch_array($query_f_year);
	
	$starting_date=date('Y-m-d H:i:s', strtotime($result_f_year["fy_startdate"]));
	
	
	$end_year_date=date('Y-m-d H:i:s', strtotime($result_f_year["fy_enddate"]));
	
	if($today < $end_year_date){
		
		$ending_date= $today;
	}else{
		$ending_date=date('Y-m-d H:i:s', strtotime($result_f_year["fy_enddate"]));
	}
	
?>

<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}



.form-control { 
font-size: 14px;
height: 35px;
}



</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">
 
<section class="content">
			<?php include("menu.php") ?>
			<div class="row">
				<h1 style="text-align:center;">
					Estimate
				</h1>
			</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body"  style="border:1px groove #ddd;">
							
								<div class="row">
									<div class="col-md-3">
									<label for="inputEmail3" class="col-md-12 control-label">S.R.F. No:</label>
									</div>
									
									<div class="col-md-2">
									<label for="inputEmail3" class="col-md-12 control-label">Perfoma Date:</label>
									</div>
									
									<div class="col-md-2">
									<label for="inputEmail3" class="col-md-12 control-label">Proforma No:</label>
									</div>
									
									<div class="col-md-2">
									<label for="inputEmail3" class="col-md-12 control-label">Estimate Date:</label>
									</div>
									
									<div class="col-md-2">
									<label for="inputEmail3" class="col-md-12 control-label">Estimate No:</label>
									</div>
								</div>
								<div class="row">
									
										  <div class="col-sm-3"><?php echo $get_estimate["trf_no"];?></div>
										  <div class="col-md-2">
										  <?php echo $perfoma_date;?>
										  <input type="hidden" id="estimate_perfoma_no" value="<?php echo $estimate_perfoma_no;?>">
										  <input type="hidden" id="est_id" value="<?php echo $est_id;?>">
										  <input type="hidden" id="nabl_type" value="<?php echo $nabl_type;?>">
										  </div>
										  <div class="col-md-2"><?php echo $estimate_perfoma_no;?></div>
										  <div class="col-md-2">
											<input type="text"  class="form-control" name="estimate_dates" id="estimate_dates" value="<?php echo date('d/m/Y')?>">
										  </div>
										  <div class="col-md-2">
											<input type="text"  class="form-control" name="estimate_number" id="estimate_number" placeholder="" value="<?php echo $estimates_no;?>" disabled>
										  </div>
									
								</div>
								
							
							<br>
							<div class="box box-info">
							<br>
							<div class="row">
									<div class="col-md-5">&nbsp;</div>
									<div class="col-md-6">
									
									<button type="button" class="btn btn-info"  onclick="addData('save_final_estimate')" name="btn_add_data" id="btn_add_data" style="width:150px;font-size:14px;" >Save Estiamte</button>
									</div>
									
								</div>
							</div>
							
							
							
							</div>
						
					</div>
				</div>
</section>	
</div>

	
<?php include("footer.php");?>
		  	  
<script>
$(document).ready(function(){
	
	var starting_date='<?php echo $starting_date;?>';
	var ending_date='<?php echo $ending_date;?>';
	
	var d = new Date(starting_date);
	
	var curr_date = d.getDate();
	var curr_month = d.getMonth() + 1; //Months are zero based
	var curr_year = d.getFullYear();
	var started_date=(curr_date + "/" + curr_month + "/" + curr_year);
	var d_one = new Date(ending_date);
	var curr_date1 = d_one.getDate();
	var curr_month1 = d_one.getMonth() + 1; //Months are zero based
	var curr_year1 = d_one.getFullYear();
	var ended_date=(curr_date1 + "/" + curr_month1 + "/" + curr_year1);
	$('#estimate_dates').datepicker({
		  autoclose: true,
		  format: 'dd/mm/yyyy',
		  startDate: "'"+started_date+"'",
		  endDate: "'"+ended_date+"'"
	});
	

});


function addData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'save_final_estimate') {
				var estimate_dates = $('#estimate_dates').val(); 
				var estimate_perfoma_no = $('#estimate_perfoma_no').val(); 
				var estimate_number = $('#estimate_number').val();
				var est_id = $('#est_id').val();
				var nabl_type = $('#nabl_type').val();
				
				billData = '&action_type='+type+'&estimate_dates='+estimate_dates+'&estimate_perfoma_no='+estimate_perfoma_no+'&estimate_number='+estimate_number+'&est_id='+est_id+'&nabl_type='+nabl_type;
	}
		if(estimate_dates=="")
		{
			alert("Please Enter Estimate Date..");
			return false;
		}
		
		
			$.confirm({
        title: "warning",
        content: "Are You Sure To Save As Estimate ?",
        buttons: {
			confirm: function () {
			$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>save_span_set_rate_merging_perfoma.php',
			dataType:'JSON',
			data: billData,
			beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
				},
			success:function(msgs){
				document.getElementById("overlay_div").style.display="none";
				if(msgs.set_status=="1")
					{
						alert(msgs.msg);
						window.location.href="<?php echo $base_url; ?>list_of_completed_perfoma_for_biller.php";
					}
			}
			});
			},
            cancel: function () {
				return;
            }
			}
        })
}

</script>
