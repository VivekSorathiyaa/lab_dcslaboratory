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
array($_POST["search_sam_date"]," AND `ulr_sequence_date`='".$_POST['search_sam_date']."'"),
array($_POST["search_sam_month"]," AND `ulr_sequence_date` LIKE '%_____".$_POST["search_sam_month"]."___%'")
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
	$w_moth=" AND `ulr_sequence_date` LIKE '%_____".$_POST["search_sam_month"]."___%'";
}
else
{
	$w_moth="";
}	
?>

	<table class="table table-bordered table-striped" width="100%" id="example2"> 
									<thead>
									<tr>
										
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Date</th>
										<th style="text-align:center;">Ulr No</th>
										<th style="text-align:center;">Job No</th>
										<th style="text-align:center;">Unique Identification No</th>
										<th style="text-align:center;">Trf No</th>
										<th style="text-align:center;">Report No</th>
										<th style="text-align:center;">Status</th>
									</tr>
										
								</thead>
								<tbody>
									<?php
									
										$countss=1;
										$querys= "SELECT * FROM ulr_sequence where `is_deleted`=0".$where." order by ulr_sequence ASC";
										$results=mysqli_query($conn,$querys);
										if(mysqli_num_rows($results) > 0)
										{
										
										while($rows=mysqli_fetch_array($results))
										{
									?>
										<tr>
										<td style="white-space:nowrap;text-align:center;"><?php echo $countss;?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo date("d-m-Y",strtotime($rows['ulr_sequence_date']));?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $rows['ulr_sequence'];?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $rows['job_no'];?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $rows['lab_no'];?></td>
										<td style="white-space:nowrap;text-align:center;">
										<?php 
											$only_year=date("Y",strtotime($rows['ulr_sequence_date']));
											$only_month=date("m",strtotime($rows['ulr_sequence_date']));
											echo "DCS/".$only_year."/".$only_month."/".sprintf('%02d', $rows["trf_no"]);
										?>
										</td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $rows['report_no'];?></td>
										<td style="white-space:nowrap;text-align:center;">
										<?php 
										if($rows['ulr_status']=="2"){ echo '<span style="font-weight:bold;color:red;">Used</span>';} else { echo '<span style="font-weight:bold;color:green;">Reserved</span>';}
										?>
										</td>
										
										</tr>
									<?php
									     $countss++;
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