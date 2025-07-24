<?php 
session_start();
include("header.php");?>
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
<section class="content due-job-listing-box" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
	<?php include("menu.php") ?>
	<div class="row m-0">	
	<div class="col-md-12">	
		<div class="row m-0">
			<h1 style="text-align:center;">
			Due Job List of Report
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
										<th style="text-align:center;width:20%;">Action</th>
										<th style="text-align:left;width:1%;">S.R.F. No</th>
										<th style="text-align:center;width:1%;">Reporting Date</th>
										<th style="text-align:center;width:1%;">Agency</th>
										<th style="text-align:center;width:1%;">Client</th>
										<th style="text-align:center;width:1%;">Material</th>
										<th style="text-align:center;width:1%;">Tpi</th>
										<th style="text-align:center;width:1%;">pmc</th>
										<th style="text-align:center;width:1%;">Sample Date</th>
										<th style="text-align:center;width:1%;">Refernce</th>
										<th style="text-align:center;width:1%;">Name Of Work</th>
										</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										 $query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1  AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='1' AND  `job_sent_to_qm`=0 AND `job_owner` != 1 AND `any_verify` = '1' ORDER BY job_id DESC";
										
										
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
										 $sel_agency="select * from agency_master where `isdeleted`=0 and agency_id=".$row["agency"];
										$result_agency=mysqli_query($conn,$sel_agency);
										$row_agency=mysqli_fetch_array($result_agency);
										 $agency_name=$row_agency["agency_name"];
										if($row["job_owner"] !='2')
										{
											 $tested_by_explode=explode(",",$row["tested_by"]);
											$tested_by_status_explode=explode(",",$row["tested_by_status"]);
											if (in_array($_SESSION["u_id"], $tested_by_explode))
											{
												$value_position=array_search($_SESSION["u_id"],$tested_by_explode,true);
												
												if($tested_by_status_explode[$value_position]=="0")
												{
												$count++;
												$set_materilas="";
												 $sel_final="select * from final_material_assign_master where `trf_no`='$row[trf_no]'";
												$query_final=mysqli_query($conn,$sel_final);
												if(mysqli_num_rows($query_final) > 0)
												{
													while($row_final=mysqli_fetch_array($query_final))
													{
														$sel_mates="select * from material where `id`=".$row_final["material_id"];
														$query_mates=mysqli_query($conn,$sel_mates);
														$row_mates=mysqli_fetch_array($query_mates);
														$set_materilas .= $row_mates["mt_name"].", ";
														
													}
												}
												
												if($row["client_code"] !=""){
											$sel_client="select * from client where `clientisdeleted`=0 and `client_code`='$row[client_code]'";
											$result_client =mysqli_query($conn,$sel_client);
											$row_client =mysqli_fetch_array($result_client);
											$client_name=$row_client["clientname"];
											}else{
												$client_name="";
											}
											
											$set_materilas="";
											$sel_final="select * from final_material_assign_master where `trf_no`='$row[trf_no]' AND `temporary_trf_no`='$row[temporary_trf_no]'";
											$query_final=mysqli_query($conn,$sel_final);
											if(mysqli_num_rows($query_final) > 0)
											{
												while($row_final=mysqli_fetch_array($query_final))
												{
													 $sel_mates="select * from material where `id`=".$row_final["material_id"];
													$query_mates=mysqli_query($conn,$sel_mates);
													$row_mates=mysqli_fetch_array($query_mates);
													$set_materilas .= $row_mates["mt_name"].", ";
													
												}
											}
											$classis="btn-primary";
											 $job_for_eng="SELECT MAX(issue_date) as datings FROM `job_for_engineer` where `trf_no`='$row[trf_no]'";
											$query_eng=mysqli_query($conn,$job_for_eng);
											if(mysqli_num_rows($query_eng) > 0)
											{
												$row_final=mysqli_fetch_assoc($query_eng);
												if($row_final["datings"]!=""){
												$reporting_dates=date("d/m/Y",strtotime($row_final["datings"]));
												$date_now = date("Y-m-d");
												
												if ($date_now > $row_final["datings"] || $date_now == $row_final["datings"]) 
												{
													//$classis="btn-warning";
												}
												}else{
													$reporting_dates="-";
												}
												
											}else{
												$reporting_dates="-";
												
											}
											
											if($classis=="btn-warning")
											{
												
											
												
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											
											<td style="text-align:center;">
											<?php
											if($row["morr"]=="r")
											{
											?>
											<a href="view_job_by_eng.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>&&temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn <?php echo $classis;?>" title="View Job"><span class="fa fa-eye"></span></a>
												
												
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
											<td style="white-space:nowrap;text-align:center;"><?php echo $reporting_dates;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["agency_name"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["clientname"];?></td>
											<td style="white-space:nowrap;text-align:left;"><?php echo $set_materilas;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['tpi_name'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['pmc_name'];?></td>
											<td style="white-space:nowrap;text-align:center;">
											<?php
											$date=date_create($row['sample_rec_date']);
											echo date_format($date,"d/m/Y");
											?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['refno'];?></td>
											<td style="white-space:nowrap;text-align:left;"><?php echo $row['nameofwork'];?></td>
										</tr>
									<?php
										}
										}
										}
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