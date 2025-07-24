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
array($_POST["search_bill_to"]," AND `billing_to_id`='".$_POST['search_bill_to']."'")
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
										<th style="text-align:center;width:1%;">SN</th>
										<th style="text-align:center;">R
										<input type="checkbox" id="chk_all">
										</th>
										<th style="text-align:center;width:3%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										<th style="text-align:left;width:1%;">S.R.F. No</th>
										<th style="width:1%;">Bill To
										<select name="search_sel_agency_ids" id="search_bill_to" class="form-control select2" style="height: 55px;background-color: aquamarine;background-color: aquamarine;height: 55px;font-size: 20px;width: 200px;">
									<option value="">Select-Agency</option>
									<?php 
									$sel_agencys="select `agency_id`,`agency_name` from agency_master where `isdeleted`=0";
									$query_agencys = mysqli_query($conn, $sel_agencys);
									if(mysqli_num_rows($query_agencys)> 0)
									{
									while($get_one_agency=mysqli_fetch_array($query_agencys))
									{ ?>
								    <option value="<?php echo $get_one_agency['agency_id'];?>"><?php echo $get_one_agency['agency_name'];?></option>
									<?php } }?>
									</select>
										</th>
										<th style="text-align:center;width:1%;">Agency</th>
										<th style="text-align:center;width:1%;">Client</th>
										<th style="text-align:center;width:1%;">Tpi</th>
										<th style="text-align:center;width:1%;">pmc</th>
										<th style="text-align:center;width:1%;">Material</th>
										<th style="text-align:center;width:1%;">Sample Date</th>
										<th style="text-align:center;width:1%;">Reporting Date</th>
										<th style="text-align:center;width:1%;">Refernce</th>
										<th style="text-align:center;width:1%;">Name Of Work</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										$query="select * from job WHERE `jobisdeleted`=0 AND `job_for_rec_and_biller`=1 AND `perfoma_completed_by_biller`=0".$where." ORDER BY job_id ASC";
										$result=mysqli_query($conn,$query);
										if(mysqli_num_rows($result)> 0)
										{
										while($row=mysqli_fetch_array($result))
										{
											$count++;
											$sel_agency_id=$row["agency"];
											//$sel_agency="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$sel_agency_id;
											//$result_agency =mysqli_query($conn,$sel_agency);
											//$row_agency =mysqli_fetch_array($result_agency);
											//$agency_name=$row_agency["agency_name"];
											
											$billing_to_id=$row["billing_to_id"];
											$sel_bill_to="select `agency_name` from agency_master where `agency_id`='$billing_to_id'";
											$result_bill =mysqli_query($conn,$sel_bill_to);
											$row_bill =mysqli_fetch_array($result_bill);
											$bill_to=$row_bill["agency_name"];
											
											$name_of_work= strip_tags(html_entity_decode($row["nameofwork"]),"<strong><em>");
											
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
												$reporting_dates=date("d/m/Y",strtotime($row_final["datings"]));
												
											}else{
												$reporting_dates="";
												
											}
											
											if($row["job_owner_eng_and_qm"]=="1")
											{
												$set_pi_class="btn-warning";
											}else
											{
												$set_pi_class="btn-info";
											}
											
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="text-align:center;">
											<input type="checkbox" name="chk_tfr" class="chk_tfr" value="<?php echo $row["trf_no"]; ?>">
											</td>
											
											<td style="text-align:center;">
											<a href="edit_only_trf_by_biller.php?trf_no=<?php echo $row['trf_no'];?>" class="btn btn-primary" title=""><span class="fa fa-edit"></span></a>
											
											<a href="span_set_rate_merging_perfoma.php?chk_array=<?php echo $row['trf_no'];?>" class="btn <?php echo $set_pi_class;?>" title=""><span class="glyphicon glyphicon-question-list"></span> PI</a>
											
											<a href="print_trf.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>" class="btn btn-success" title="" target="_blank"><span class="fa fa-tripadvisor"></span></a>
											</td>
											
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $bill_to;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["agency_name"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["clientname"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['tpi_name'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['pmc_name'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $set_materilas;?></td>
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

<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
$(document).ready(function(){
	var table = $('#example2').DataTable( {
        'autoWidth': true,
		'scrollX': true,
		"lengthMenu": [[100, 200, 250, -1], [100, 200, 250, "All"]],
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
    });
	
	$(function () {
		$('.select2').select2();
	})

});
</script>
