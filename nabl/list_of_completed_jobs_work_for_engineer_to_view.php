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
   
<section class="content"  style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
			<?php include("menu.php") ?>
			<!--<div class="row">
		
		<h1 style="text-align:center;">
		View Reports
		</h1>
	</div>-->
<div class="row m-0">
				
		<div class="row m-0">
		
		<h1 style="text-align:center;">
		View Completed Jobs
		</h1>
	</div>		
	<div class="row m-0">
        <div class="col-xs-12">
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
										
										$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='1' AND `job_owner_eng_and_qm`=1 OR `job_owner_eng_and_qm`=2  ORDER BY job_id DESC LIMIT 0,200";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
										//	if($row["appoved_by_qm_to_print"] =="1" || $row["appoved_by_qm_to_print"] =="2")
										//	{
												$explode_tested_by=explode(",",$row["tested_by"]);
											if(in_array($_SESSION["u_id"],$explode_tested_by))
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
											
											$job_for_eng="SELECT MIN(issue_date) as datings FROM `job_for_engineer` where `trf_no`='$row[trf_no]'";
											$query_eng=mysqli_query($conn,$job_for_eng);
											if(mysqli_num_rows($query_eng) > 0)
											{
												$row_final=mysqli_fetch_assoc($query_eng);
												if($row_final["datings"]!=""){
												$reporting_dates=date("d/m/Y",strtotime($row_final["datings"]));
												}else{
													$reporting_dates="-";
												}
												
											}else{
												$reporting_dates="";
												
											}
									
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="text-align:center;">
											<a href="javascript:void(0);"
											   class="btn btn-primary view-report-btn"
											   data-trf="<?php echo $row['trf_no'];?>"
											   data-job="<?php echo $row['job_number'];?>"
											   data-temp="<?php echo $row['temporary_trf_no'];?>"
											   title="View Job">
											   <span class="fa fa-eye"></span>
											</a>

											&nbsp;
											
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
										//}	
										
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
</section>	
</div>
  
	
<?php include("footer.php");?>	
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>   	 
<!-- jQuery UI (for .datepicker and .sortable) -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css">

<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
 
<script>
$(document).ready(function(){
	
	var table = $('#example2').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		"lengthMenu": [[100, 200, 250, -1], [100, 200, 250, "All"]]
    } );

});

$('.startdate_class').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
	
$('.enddate_class').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
$('.expdate_class').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});

//  start date change

$(document).on('change','.startdate_class',function(){
	var get_start_date= $(this).val();
	var get_id= $(this).attr('id');
	var only_id=get_id.split("_");
	var set_id="#enddate_"+only_id[1];
	var get_end_date= $(set_id).val();
	
	var a = moment(get_start_date,'D/M/YYYY');
	var b = moment(get_end_date,'D/M/YYYY');
	var diffDays = b.diff(a, 'days');
	
	var set_day="#day_"+only_id[1];
	$(set_day).val(diffDays);
	
	var labs_id="#labno_"+only_id[1];
	var get_lab_id=$(labs_id).val();
	
	var material_id="#material_"+only_id[1];
	var get_material_id=$(material_id).val();
	
	var test_id="#testlist_"+only_id[1];
	var get_test_id=$(test_id).val();
	
	var expdate="#expdate_"+only_id[1];
	var get_expdate=$(expdate).val();
	
	var get_report_no= $("#txt_report_no").val();
	var get_job_no= $("#txt_job_no").val();
	
	
	// perameter 1 sdate 2 enddate 3 days 4 labid 5 materialid 6 testids 7 reportno 8 jobno 9 expdate
	update_table_job_for_engineer(get_start_date,get_end_date,diffDays,get_lab_id,get_material_id,get_test_id,get_report_no,get_job_no,get_expdate);
   
});

//  end date change

$(document).on('change','.enddate_class',function(){
	var get_end_date= $(this).val();
	var get_id= $(this).attr('id');
	var only_id=get_id.split("_");
	var set_id="#startdate_"+only_id[1];
	var get_start_date= $(set_id).val();
	
	var a = moment(get_start_date,'D/M/YYYY');
	var b = moment(get_end_date,'D/M/YYYY');
	var diffDays = b.diff(a, 'days');
	
	var set_day="#day_"+only_id[1];
	$(set_day).val(diffDays);
     
	 var labs_id="#labno_"+only_id[1];
	var get_lab_id=$(labs_id).val();
	
	var material_id="#material_"+only_id[1];
	var get_material_id=$(material_id).val();
	
	var test_id="#testlist_"+only_id[1];
	var get_test_id=$(test_id).val();
	
	var expdate="#expdate_"+only_id[1];
	var get_expdate=$(expdate).val();
	
	var get_report_no= $("#txt_report_no").val();
	var get_job_no= $("#txt_job_no").val();
	
	
	// perameter 1 sdate 2 enddate 3 days 4 labid 5 materialid 6 testids 7 reportno 8 jobno 9 expdate
	update_table_job_for_engineer(get_start_date,get_end_date,diffDays,get_lab_id,get_material_id,get_test_id,get_report_no,get_job_no,get_expdate);
});


function update_table_job_for_engineer(get_start_date,get_end_date,diffDays,get_lab_id,get_material_id,get_test_id,get_report_no,get_job_no,get_expdate){
	
	var billData = '&action_type=update_engineer'+'&get_start_date='+get_start_date+'&get_end_date='+get_end_date+'&diffDays='+diffDays+'&get_lab_id='+get_lab_id+'&get_material_id='+get_material_id+'&get_test_id='+get_test_id+'&get_report_no='+get_report_no+'&get_job_no='+get_job_no+'&get_expdate='+get_expdate;
	
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: billData,
        success:function(msg){
          
        }
    });
	
	
}
//send report to accept

$(document).on("click", ".report_send_to_accept", function () {
				var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Accept This Report?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=report_send_to_accept&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_pending_job_report_for_qm.php";
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

//send report to print
$(document).on("click", ".view-report-btn", function () {
    var trf_no = $(this).data('trf');
    var job_no = $(this).data('job');
    var temporary_trf_no = $(this).data('temp');

    $.ajax({
        url: 'save_span_engineer.php', // your PHP file
        type: 'POST',
        data: {
            action_type: 'report_view_only',
            trf_no: trf_no,
            job_no: job_no,
            temporary_trf_no: temporary_trf_no,
        },
        success: function(response) {
            
                window.location.href = 'view_reports_by_engineer_by_trf_no.php?trf_no=' + trf_no + '&&job_no=' + job_no + '&&temporary_trf_no=' + temporary_trf_no;
            
        },
        error: function(xhr, status, error) {
            alert('AJAX Error: ' + xhr.status + ' - ' + error);
            console.log(xhr.responseText);
        }
    });
});


$(document).on("click", ".report_send_to_print", function () {
				var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Accept This Report?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=report_send_to_print&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_pending_job_report_for_qm.php";
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

//send job to accept

$(document).on("click", ".job_send_to_accept", function () {
				var clicked_id = $(this).attr("data-id"); 
	$.confirm({
        title: "warning",
        content: "Are You Sure To Accept This Job ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=send_job_to_accept&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_pending_job_report_for_qm.php";
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});



//send job to print

$(document).on("click", ".job_send_to_print", function () {
				var clicked_id = $(this).attr("data-id"); 
	$.confirm({
        title: "warning",
        content: "Are You Sure To SentTo Print This Job ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=job_send_to_print&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_pending_job_report_for_qm.php";
			
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
