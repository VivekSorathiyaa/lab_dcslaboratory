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
	$txt_trf_no= $_GET["trf_no"];
	$txt_jobs= $_GET["job_no"];  
	$temporary_trf_no= $_GET["temporary_trf_no"]; 
	
	$get_jobs="select  * from job where `trf_no`='$txt_trf_no' AND `job_number`='$txt_jobs' AND `temporary_trf_no`='$temporary_trf_no'";
	$query_job=mysqli_query($conn,$get_jobs);
	$job_row=mysqli_fetch_array($query_job);
	
	$query_final="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$job_row[job_number]' AND `trf_no`='$job_row[trf_no]' ORDER BY final_material_id DESC";
	$result_final=mysqli_query($conn,$query_final);
	$row_final=mysqli_fetch_array($result_final);
	
	$sel_static_ulr="select  * from ulr_no where `ulr_status`=0 AND `ulr_is_deleted`=0";
	$query_static_ulr=mysqli_query($conn,$sel_static_ulr);
	$result_static_ulr=mysqli_fetch_array($query_static_ulr);
	$static_ulr=$result_static_ulr["ulr_no"];
?>

<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">
   
  
<section class="content view-reports-by-eng-trf-box">
			<?php include("menu.php") ?>
			<div class="row">
		
		<h1 style="text-align:center;">
		View Reports
		</h1>
	</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body">
							<br>
								<div class="row">
									
											<div class="col-sm-2">
												<label>S.R.F. NO</label>
												<input type="text" class="form-control" value="<?php echo $_GET['trf_no'];?>" id="trf_no" name="trf_no" disabled>
											</div>
											<div class="col-sm-2">
												<label>JOB NO</label>
												<input type="text" class="form-control" value="<?php echo $_GET['job_no'];?>" id="job_no" name="job_no" disabled>
											</div>
											<div class="col-sm-2">
												<label>UNIQUE IDENTIFICATION NO</label>
												<input type="text" class="form-control" value="<?php echo $row_final['lab_no'];?>" id="lab_no" name="lab_no" disabled>
											</div>
											<div class="col-sm-2">
												<label>REPORT NO</label>
												<input type="text" class="form-control" value="<?php echo $row_final['report_no'];?>" id="report_no" name="report_no" disabled>
											</div>
											<div class="col-sm-2">
												<label>ULR NO</label>
												<input type="text" class="form-control" value="<?php echo $static_ulr.$row_final['ulr_no']."F";?>" id="ulr_no" name="ulr_no" disabled>
											</div>
											<div class="col-sm-2">
												<label>DATE</label>
												<input type="text" class="form-control" value="<?php echo date('d-m-Y',strtotime($job_row['sample_rec_date']));?>" id="old_date" name="txt_job_no" disabled style="font-size:20px;font-weight:bold;">
												<input type="hidden" class="form-control" value="<?php echo $job_row['temporary_trf_no'];?>" id="temporary_trf_no" name="temporary_trf_no">
											</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-12" style="font-size:20px;font-weight:bold;">
									<center>
										You Can Check the Number By Date From Here
									</center>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-12" style="font-size:20px;font-weight:bold;">
									<center>
										<input type="text" class="form-control" value="<?php echo date('d-m-Y');?>" id="chek_date" name="chek_date" style="font-size:20px;font-weight:bold;width:15%">
										<br>
										<a href="javascript:void(0);" class="btn btn-primary btn3d search_job_by_qm"><span class="glyphicon glyphicon-question-ok"></span> CHECK</a>
									</center>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-12" style="font-size:20px;font-weight:bold;">
									<center id="display_data_report">
										
									</center>
									</div>
								</div>
								
								
							
							<br>
						</div>
					</div>
				</div>
</section>	
</div>
  
	
<?php include("footer.php");?>
	  	  
<script>
$(document).ready(function(){
	$('#chek_date').datepicker({
		  autoclose: true,
		  format: 'dd-mm-yyyy',
		  endDate: "today"
	})

});

$(".search_job_by_qm").click(function()
{
					
	var chek_date = $('#chek_date').val(); 
	if(chek_date =="")
	{
		alert("Please Enter Date Proper");
		return false;
	}
		var postData = '&type=search_all_job_for_admin&chek_date='+chek_date;
			
		$.ajax({
			url : "<?php echo $base_url; ?>search_date.php",
			type: "POST",
			data : postData,
			beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
			success: function(data,status,  xhr)
			{
				document.getElementById("overlay_div").style.display="none";
				$("#display_data_report").html(data);
			}
			}); 
});


$(document).on("click", ".delete_old_jobs", function () 
{
				var trf_no= $("#trf_no").val();
				var job_no= $("#job_no").val();
				var lab_no= $("#lab_no").val();
				var report_no= $("#report_no").val();
				var ulr_no= $("#ulr_no").val();
				var old_date= $("#old_date").val();
				var temporary_trf_no= $("#temporary_trf_no").val();
				var chek_date= $("#chek_date").val();
				
				form_data = new FormData();
				form_data.append("action_type", "delete_old_jobs");
				form_data.append("trf_no", trf_no);
				form_data.append("job_no", job_no);
				form_data.append("lab_no", lab_no);
				form_data.append("report_no", report_no);
				form_data.append("ulr_no", ulr_no);
				form_data.append("old_date", old_date);
				form_data.append("temporary_trf_no", temporary_trf_no);
				form_data.append("chek_date", chek_date);
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete Old Report?",
        buttons: {
			confirm: function () {
		$.ajax({
			url : "<?php $base_url; ?>delete_old_jobs.php",
			type: "POST",
			dataType:'JSON',
			data : form_data,
			processData: false,
			contentType: false,
			beforeSend: function(){
			document.getElementById("overlay_div").style.display="block";
			},
			success:function(data){
				document.getElementById("overlay_div").style.display="none";
				if(data.statuses=='1'){
				alert("Job Is Successfully Deleted");
				window.location.href="<?php $base_url; ?>list_of_completed_job_report_for_deleter.php";
				}
				
			}
		});
	
	},
            cancel: function () {
				return;
            }
			}
        })
});


</script>
