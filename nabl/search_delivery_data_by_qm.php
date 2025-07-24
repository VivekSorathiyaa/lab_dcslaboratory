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
array($_POST["search_dispatch_type"]," AND `dispatch_type` LIKE '%".$_POST['search_dispatch_type']."%'"),
array($_POST["search_report_no"]," AND `report_no` LIKE '%".$_POST['search_report_no']."%'"),
array($_POST["search_ulr_no"]," AND `ulr_no` LIKE '%".$_POST['search_ulr_no']."%'"),
array($_POST["search_lab_no"]," AND `lab_no` LIKE '%".$_POST['search_lab_no']."%'")
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
										<th style="text-align:center;width:1%;">Serial No</th>
										<th style="text-align:center;width:1%;">Dispatched Type</th>
										<th style="text-align:center;width:1%;">Report No</th>
										<th style="text-align:center;width:1%;">Agency Name</th>
										<th style="text-align:center;width:1%;">Client</th>
										<th style="text-align:center;width:1%;">Tpi</th>
										<th style="text-align:center;width:1%;">pmc</th>
										<th style="text-align:center;width:1%;">Material</th>
										<!--<th style="text-align:center;">Ulr No</th>
										<th style="text-align:center;">Lab No</th>
										<th style="text-align:center;">S.R.F. No</th>-->
										<th style="text-align:center;width:1%;">Dispatched Date</th>
										<th style="text-align:center;width:1%;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;

										$query="select * from report_dispatch WHERE `is_deleted`=0 ORDER BY dispatch_id DESC";
										$result=mysqli_query($conn,$query);
										if(mysqli_num_rows($result)>0)
										{
										while($row=mysqli_fetch_array($result))
										{

											$count++;
											$query="select * from job WHERE `jobisdeleted`=0 AND `trf_no`='$row[trf_no]'";
											$results=mysqli_query($conn,$query);
											$rowing=mysqli_fetch_array($results);

											if($rowing["agency"]!= ""){
											$sel_agency="select * from agency_master where `agency_id`=".$rowing["agency"];
											$result_agency =mysqli_query($conn,$sel_agency);
											$row_agency =mysqli_fetch_array($result_agency);
											$agency_name=$row_agency["agency_name"];
											}else{
												$agency_name="";
											}

											if($rowing["client_code"] !=""){
											$sel_client="select * from agency_master where `client_code`='$rowing[client_code]'";
											$result_client =mysqli_query($conn,$sel_client);
											$row_client =mysqli_fetch_array($result_client);
											$client_name=$row_client["client_name"];
											}else{
												$client_name="";
											}

											$set_materilas="";
											$sel_final="select * from final_material_assign_master where `trf_no`='$rowing[trf_no]'";
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

									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>

											<td style="white-space:nowrap;text-align:center;">
											<?php
											if($row['dispatch_type']=="0"){ echo "HAND TO HAND"; }else{ echo "COURIER"; }
											?>
											</td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['report_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $rowing['agency_name'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["clientname"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['tpi_name'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['pmc_name'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $set_materilas;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['courier_date'];?></td>
											<td style="text-align:center;">
											<?php
											if($row['dispatch_type']=="1"){ ?>
											<input type="checkbox" name="dispatch_id" class="dispatch_id" value="<?php echo $row["dispatch_id"]; ?>">
											<?php } ?>

											<a href="javascript:void(0);" class="get_dispatch_report" data-id="<?php echo $row['dispatch_id'];?>" title="VIEW" data-toggle="modal" data-target="#myModal"><span class="fa fa-eye"></span></a>
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
