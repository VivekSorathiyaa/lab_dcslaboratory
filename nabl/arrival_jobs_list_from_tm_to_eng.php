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
$user_id=$_SESSION['u_id'];
?>

<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}



.disabled{
  pointer-events: none;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 0px !important;">
		<!-- Main content -->
<section class="content job-listing-for-engineer-box" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
			<?php include("menu.php") ?>
	<div class="row m-0">		
		<div class="col-md-12">
			<div class="row m-0">
				<h1 style="text-align:center;">
				<?php
			
				echo "ARRIVAL JOB LIST ";
				
				?>
				
				</h1>
			</div>
           <div class="row m-0">
              <div class="col-xs-12 p-0">
			<div class="box box-info">
				<!-- /.box-header -->
						<div class="box-body">
						<div id="display_data_report">
								<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;width:5%;">SN</th>
										<th style="text-align:center;width:5%;">Action</th>
										<th style="text-align:left;width:5%;">S.R.F. No</th>
									
										<!--<th style="text-align:center;width:1%;">Material</th>-->
							
										<th style="text-align:center;width:5%;">Sample Date</th>
				
										</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										$query="select * from job WHERE `jobisdeleted`=0 AND `rec_to_tm`='1' AND `tm_to_eng_blank`='1' AND `return_eng_to_tm`='0'  ORDER BY job_id DESC";
										
										
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
										$sel_agency="select * from agency_master where `isdeleted`=0 and agency_id=".$row["agency"];
										$result_agency=mysqli_query($conn,$sel_agency);
										$row_agency=mysqli_fetch_array($result_agency);
										$agency_name=$row_agency["agency_name"];
										$count++;
											if($row["client_code"] !=""){
											$sel_client="select * from client where `clientisdeleted`=0 and `client_code`='$row[client_code]'";
											$result_client =mysqli_query($conn,$sel_client);
											$row_client =mysqli_fetch_array($result_client);
											$client_name=$row_client["clientname"];
											}else{
												$client_name="";
											}
											
											$explode_tested_by=explode(",",$row["tested_by"]);
											
											if (in_array($_SESSION['u_id'], $explode_tested_by))
											{
												
											
												
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											
											<td style="text-align:center;">
											<?php
											if($row["morr"]=="r")
											{
											?>
											<a href="view_job_by_eng_for_downloads_obs.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>&&temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-primary" title="View Job"><span class="fa fa-eye"></span></a>
												
												
											
											&nbsp;
											
											<?php 
											//if all report not sent to qm the job submit button disabled
											
											$sel_span_table="select `lab_no` from span_material_assign where `tested_by`='$_SESSION[u_id]' AND `isdeleted`=0 AND `trf_no`='$row[trf_no]'";
											$query_span_table=mysqli_query($conn,$sel_span_table);
											
											if(mysqli_num_rows($query_span_table) >0)
											{
												$lab_nos=array();
												while($one_lab_no=mysqli_fetch_array($query_span_table))
												{
													if (!in_array($one_lab_no["lab_no"], $lab_nos))
													{
														array_push($lab_nos,$one_lab_no["lab_no"]);
													}
												}
											}
											 $disabling="";
											 foreach($lab_nos as $one_array_lab)
											 {
											   $select_job_for_eng="select `report_sent_to_qm` from job_for_engineer where `report_sent_to_qm`=0 AND `lab_no` = '$one_array_lab'";
												$query_job_for_eng=mysqli_query($conn,$select_job_for_eng);
												if(mysqli_num_rows($query_job_for_eng) >0)
												{
													$disabling="disabled";
												}
											 } 
											
												if($row["report_received"]==1){ ?>
												<!--<a href="javascript:void(0);" class="btn btn-success job_send_to_qm <?php //echo $disabling;?>" data-id="<?php //echo $row['trf_no']."|".$row['job_number']."|".$_SESSION['u_id'];?>" title="Material Assign" ><span class="fa fa-arrow-circle-right fa-lg"></span></a>-->
												<?php }
											
											}	
												?>
											
											</td>
											
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>
											
											<td style="white-space:nowrap;text-align:center;">
											<?php
											$date=date_create($row['sample_rec_date']);
											echo date_format($date,"d/m/Y");
											?></td>
												
										</tr>
									<?php
										}										
										}										
									?>
								</tbody>
								
							  </table>
								
							</div>
							
							
						</div>
				<!-- /.box-body -->
				</div>
			</div>
		</div>
	<!---------third table----------------->
	</div>
</section>	
</div>  
	
<?php include("footer.php");?>		  
		  
<script>
    $(document).ready(function() {
    var table = $('#example1').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
    } );
	
	var table = $('#example2').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		"lengthMenu": [[100, 200, 250, -1], [100, 200, 250, "All"]]
    } );
 } );

	
$(function () {
		$('.select2').select2()
})
	
	
$(document).on("click", ".job_send_to_qm", function () {
				var clicked_id = $(this).attr("data-id"); 
	$.confirm({
        title: "warning",
        content: "Are You Sure To Send This Job To Quality Manager?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=send_job_to_qlty_manager&clicked_id='+clicked_id,
        success:function(html){
	    window.location.href="<?php echo $base_url; ?>job_listing_for_engineer.php";
			
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