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
$user_id=$_GET['userid'];
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
		<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
			<?php include("menu.php") ?>
			
				<div class="col-md-12">
				
		<div class="row">
		
		<h1 style="text-align:center;">
		Job List of Engineer
		</h1>
	</div>
<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">
				
				<!-- /.box-header -->
					
					
						<div class="box-body">
						<div id="display_data_report">
								<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">Serial No</th>
										<!--<th style="text-align:center;">S.R.F. No</th>-->
										<th style="text-align:center;">Lab No</th>
										<th style="text-align:center;">Received sample Date</th>
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1  AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='1' AND  `job_sent_to_qm`=0 AND `job_owner` != 1 ORDER BY job_id DESC";
										
										
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
										if($row["job_owner"] !='2')
										{
											$tested_by_explode=explode(",",$row["tested_by"]);
											$tested_by_status_explode=explode(",",$row["tested_by_status"]);
											if (in_array($_GET["userid"], $tested_by_explode))
											{
												$value_position=array_search($_GET["userid"],$tested_by_explode,true);
												
												if($tested_by_status_explode[$value_position]=="0")
												{
												$count++;
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<!--<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>-->
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['job_number'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php
											$date = new DateTime($row['sample_rec_date']);
											echo $date->format('d-m-Y');
											?></td>
											<td style="text-align:center;">
											
											<a href="view_job_by_eng_for_super_admin.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>&&user_id=<?php echo $_GET['userid'];?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> View</a>
											&nbsp;
											
											<?php 
											//if all report not sent to qm the job submit button disabled
											
											$sel_span_table="select `lab_no` from span_material_assign where `tested_by`='$_GET[userid]' AND `isdeleted`=0 AND `trf_no`='$row[trf_no]'";
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
											
											if($row["report_received"]==1){?>
											<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d job_send_to_qm <?php echo $disabling;?>" data-id="<?php echo $row['trf_no']."|".$row['job_number']."|".$_GET['userid'];?>" title="Material Assign" ><span class="glyphicon glyphicon-question-list"></span> Submit</a>
										<?php }
												
												?>
											
											</td>
										</tr>
									<?php
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
    } );
 } );

	
$(function () {
		$('.select2').select2()
})
	
	
$(document).on("click", ".job_send_to_qm", function () {
				var clicked_id = $(this).attr("data-id");
				var splitedd= clicked_id.split("|");
				var users_id= splitedd[2];
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
	    window.location.href="<?php echo $base_url; ?>job_inward_lab.php?userid="+users_id;
			
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