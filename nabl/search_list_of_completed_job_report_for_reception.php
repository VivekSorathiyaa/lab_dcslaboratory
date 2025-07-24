<!-- DataTables -->
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
<?php 
error_reporting(1);
session_start();
include("connection.php");
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="index.php";
	</script>
	<?php
}
$arraying=array(
array($_POST["search_trf_no"]," AND `trf_no` LIKE '%".$_POST['search_trf_no']."%'"),
array($_POST["search_sam_date"]," AND `sample_rec_date` LIKE '%".$_POST['search_sam_date']."%'"),
array($_POST["search_agency_name"]," AND `agency_name` LIKE '%".$_POST['search_agency_name']."%'"),
array($_POST["search_client_name"]," AND `clientname` LIKE '%".$_POST['search_client_name']."%'"),
array($_POST["search_pmc_name"]," AND `pmc_name` LIKE '%".$_POST['search_pmc_name']."%'"),
array($_POST["search_tpi_name"]," AND `tpi_name` LIKE '%".$_POST['search_tpi_name']."%'")
);

$where="";
foreach($arraying as $keys =>$one_array)
{
	if($one_array[0]!="")
	{
		$where .=$one_array[1];
	}
}
$w_moth="";
if($_POST["search_sam_month"]!="")
{
	$w_moth=" AND `sample_rec_date` LIKE '%_____".$_POST["search_sam_month"]."___%'";
}
else
{
	$w_moth="";
}	
?>

	<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;width:1%;">SN</th>
										<th style="text-align:center;width:1%;">Action<span style="color:white;">_____________</span></th>
										<th style="text-align:left;width:1%;">S.R.F. No</th>
										<th style="text-align:center;width:1%;">Agency</th>
										<th style="text-align:center;width:1%;">Client</th>
										<th style="text-align:center;width:1%;">Material</th>
										<th style="text-align:center;width:1%;">Tpi</th>
										<th style="text-align:center;width:1%;">pmc</th>
										<th style="text-align:center;width:1%;">Sample Date</th>
										<th style="text-align:center;width:1%;">Reporting Date</th>
										<th style="text-align:center;width:1%;">Refernce</th>
										<th style="text-align:center;width:1%;">Name Of Work</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										
										//$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='1' AND `any_report_done_by_any_qm`='1' AND `dispatch_by_reception`='1' AND `jobcreatedby_id`='$_SESSION[u_id]' ".$where." ORDER BY job_id DESC";
										
										//$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='1' AND `any_report_done_by_any_qm`='1' AND `any_accept_by_tm`='1' AND `jobcreatedby_id`='$_SESSION[u_id]' ".$where." ORDER BY job_id DESC";
										
										$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='1' AND `any_report_done_by_any_qm`='1' AND `accepted_by_qm`=1 AND `job_owner_eng_and_qm`=2 AND `appoved_by_qm_to_print`=1 AND `job_sent_to_qm`=1 AND `job_owner_qm_and_biller`=1 AND `jobcreatedby_id`='$_SESSION[u_id]'".$where.$w_moth."  ORDER BY job_id DESC LIMIT 0,200";
										
										
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											//if($row["appoved_by_qm_to_print"] =="1" || $row["appoved_by_qm_to_print"] =="2")
											//{
											$count++;
											
											if($row["agency"]!= ""){
											$sel_agency="select * from agency_master where `isdeleted`=0 and `agency_id`=".$row["agency"];
											$result_agency =mysqli_query($conn,$sel_agency);
											$row_agency =mysqli_fetch_array($result_agency);
											$agency_name=$row_agency["agency_name"];
											}else{
												$agency_name="";
											}
											
											if($row["client_code"] !=""){
											$sel_client="select * from client where `clientisdeleted`=0 and `client_code`='$row[client_code]'";
											$result_client =mysqli_query($conn,$sel_client);
											$row_client =mysqli_fetch_array($result_client);
											$client_name=$row_client["clientname"];
											}else{
												$client_name="";
											}
											
											$obs_link="";
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
													$obs_link= $row_final["upload_obs"];
													
												}
											}
											
											$job_for_eng="SELECT MIN(issue_date) as datings FROM `job_for_engineer` where `trf_no`='$row[trf_no]'";
											$query_eng=mysqli_query($conn,$job_for_eng);
											if(mysqli_num_rows($query_eng) > 0)
											{
												$row_final=mysqli_fetch_assoc($query_eng);
												$reporting_dates=date("d/m/Y",strtotime($row_final["datings"]));
												
											}else{
												$reporting_dates="";
												
											}
									
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="text-align:center;">
											<?php if($row["morr"]=="r")
											{ ?>
											<!--<a href="view_job_by_reception.php?trf_no=<?php //echo $row['trf_no'];?>&&job_no=<?php// echo $row['job_number'];?>" class="btn btn-primary" title="View Job"><span class="fa fa-truck"></span></a>-->
											
											<a href="download_data.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>" class="btn btn-primary" title="View Job"><span class="fa fa-print"></span></a>
											
											<a href="print_trf.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>" class="btn btn-primary" title="VIEW TRF" target="_blank"><span class="fa fa-tripadvisor"></span> </a>
											
											<a href="<?php echo $base_url."scan_document/".$row['scan_document'] ?>" class="btn btn-primary" title="VIEW LETTER" target="_blank"><span class="fa fa-eye"></span></a>
											
											<?php
											if($row["is_scan"]=="1"){?>
											<a href="view_scan_by_trf_no.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>" class="btn btn-primary" title="SCAN"><span class="fa fa-qrcode"></span></a>
											<?php
											} 
											} ?>
											<a href="upload_wriiten_obs/<?php echo $obs_link;?>" class="btn btn-primary" target="_blank" title="VIEW DOCUMENT">OBS.</a>
											</td>
										
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["agency_name"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["clientname"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $set_materilas;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['tpi_name'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['pmc_name'];?></td>
											<td style="white-space:nowrap;text-align:center;">
											<?php
											$date=date_create($row['sample_rec_date']);
											echo date_format($date,"d/m/Y");
											?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $reporting_dates;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['refno'];?></td>
											<td style="white-space:nowrap;text-align:left;"><?php echo $row['nameofwork'];?></td>
										</tr>
									<?php
										//}	
										
										}
									?>
								</tbody>
								
							  </table>
							  
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.buttons.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.flash.min.js"></script>
<script src="bower_components/datatables.net-bs/js/jszip.min.js"></script>
<script src="bower_components/datatables.net-bs/js/pdfmake.min.js"></script>
<script src="bower_components/datatables.net-bs/js/vfs_fonts.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.html5.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.print.min.js"></script>

<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
$(document).ready(function(){
	var table = $('#example2').DataTable( {
        'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
    });
	
	$(function () {
		$('.select2').select2()
	})

});
</script>