<!-- DataTables -->
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
<?php 
session_start();
include("connection.php");
error_reporting("ALL");
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="index.php";
	</script>
	<?php
}

if($_POST['from_date']!="" || $_POST['to_date']!="")
{
$ref_dayc1_0=substr($_POST['from_date'],0,2);
$ref_monthc1_0=substr($_POST['from_date'],3,2);
$ref_yearc1_0=substr($_POST['from_date'],6,4);
$start_date = $ref_yearc1_0."-".$ref_monthc1_0."-".$ref_dayc1_0;

$ref_dayc2_0=substr($_POST['to_date'],0,2);
$ref_monthc2_0=substr($_POST['to_date'],3,2);
$ref_yearc2_0=substr($_POST['to_date'],6,4);
$end_date = $ref_yearc2_0."-".$ref_monthc2_0."-".$ref_dayc2_0;

	$where=" AND bill_date BETWEEN '" . $start_date . "' AND  '" . $end_date."'";
}else{
	$where="";
}

?>								
									
									<form action="admin_inward_print.php" method="POST" target="_blank">
									
									<input type="hidden" name="chk_job_card" value="<?php echo $base_url; ?>set_purchase_print_out.php?&&start_date=<?php echo $start_date;?>&&end_date=<?php echo $end_date;?>">
									<input type="submit" name="submit_job_card" value="PRINT" class="btn btn-primary form-control" style="height:0%;width:10%;">
									</form>
									<table id="example1" width="100%" class="table table-bordered table-striped">
									<thead>
									<tr>
										
										<th style="text-align:center;">Sr. No</th>
										<th style="text-align:center;">Purchase Code</th>	
										<th style="text-align:center;">Party Name</th>
										<th style="text-align:center;">Gst No</th>
										<th style="text-align:center;">Bill No</th>
										<th style="text-align:center;">Bill Date</th>
										<th style="text-align:center;">Payment Type</th>
										<th style="text-align:center;">Total Amount</th>
										<th style="text-align:center;">Remark</th>							
										<th style="text-align:center;">Action</th>							
								
									</tr>
								</thead>
								<tbody>
									<?php
									
										$count=0;
										
										$query="select * from purchages_out where `is_deleted`=0".$where." ORDER BY purchage_out_id ASC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{$mt_cnt=0;
											$count++;
											
									?>
											<tr>
											<td><?php echo $count;?></td>
											
											<td><?php echo $row["purchage_out_code"];?></td>
											<td><?php echo $row["party_name"];?></td>
											<td><?php echo $row["gst_no"];?></td>
											<td><?php echo $row["bill_no"];?></td>
											<td><?php echo date('d/m/Y', strtotime($row['bill_date']));?></td>
											<td><?php echo $row["payment_type"];?></td>
											<td><?php echo $row["total_amnt"];?></td>
											<td><?php echo $row["remark"];?></td>
											<td>
										<a href="edit_purchage_out.php?ids=<?php echo $row['purchage_out_id'];?>" class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
											
											<a href="javascript:void(0)" class="btn btn-danger delete_vouch" title="Delete" data-id="<?php echo $row['purchage_out_id'];?>">
											<i class="fa fa-trash"></i>
											</a>
											</td>
										</tr>
									<?php
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

<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
$(document).ready(function(){
	var table = $('#example1').DataTable( {
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