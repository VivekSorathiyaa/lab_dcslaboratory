<!-- DataTables -->
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
<?php 
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
array($_POST["search_sam_date"]," AND `sample_rec_date` LIKE '%".$_POST['search_sam_date']."%'")
);

$where="";
foreach($arraying as $keys =>$one_array)
{
	if($one_array[0]!="")
	{
		$where .=$one_array[1];
	}
}
?>

	<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">S.R.F. No</th>
										<!--<th style="text-align:center;">Job No</th>-->
										<th style="text-align:center;">Received sample Date</th>
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										
										$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='1' AND `job_owner_eng_and_qm`=2  AND `print_done_by_biller_for_qm_see`=1 ".$where." ORDER BY job_id DESC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											if($row["appoved_by_qm_to_print"] =="1" || $row["appoved_by_qm_to_print"] =="2")
											{
											$count++;
									
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>
											<!--<td style="white-space:nowrap;text-align:center;"><?php //echo $row['job_number'];?></td>-->
											<td style="white-space:nowrap;text-align:center;"><?php
											$date = new DateTime($row['sample_rec_date']);
											echo $date->format('d-m-Y');
											?></td>
											
											
											<td style="text-align:center;">
											<?php
											if($row["morr"]=="r")
											{
											?>
											
											<a href="edit_span_material_assigning_by_qm.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> Edit</a>&nbsp;
											
											
											<a href="view_job_by_qlty_manager.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> View</a>&nbsp;
											
											<a href="edit_only_trf.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>" class="btn btn-success btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> Edit Trf</a>&nbsp;
											
											<?php if($row['print_done_by_biller_for_qm_see']==1){ ?>
											<a href="download_data.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>" class="btn btn-success btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> Downlaod</a>&nbsp;
											<?php } 
											}
											?>
											</td>
										</tr>
									<?php
										}	
										
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