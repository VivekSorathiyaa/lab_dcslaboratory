<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0;
	}

	.pagebreak {
		page-break-before: always;
	}

	page[size="A4"] {
		width: 29.7cm;
		height: 21cm;
	}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 10px;
		font-family: Arial;
	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family: Arial;
	}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family: Arial;

	}

	.tdclass1 {

		
		font-family: Arial;
	}

	.details {
		margin: 0px auto;
		padding: 0px;
	}
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from water_test WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);


	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];
	$r_name = $row_select['refno'];
	$sr_no = $row_select['sr_no'];
	$sample_no = $row_select['job_no'];
	$rec_sample_date = $row_select['sample_rec_date'];
	$agreement_no = $row_select['agreement_no'];
	$cons = $row_select['condition_of_sample_receved'];
	// $job_no= $row_select['job_no'];			
	if ($cons == 0) {
		$con_sample = "Sealed Ok";
	} else {
		$con_sample = "Unsealed";
	}
	$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

	$select_query1 = "select * from agency_master WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
	$result_select1 = mysqli_query($conn, $select_query1);

	if (mysqli_num_rows($result_select1) > 0) {
		$row_select1 = mysqli_fetch_assoc($result_select1);
		$agency_name = $row_select1['agency_name'];
	}

	$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
	$result_select2 = mysqli_query($conn, $select_query2);

	if (mysqli_num_rows($result_select2) > 0) {
		$row_select2 = mysqli_fetch_assoc($result_select2);
		$start_date = $row_select2['start_date'];
		$end_date = $row_select2['end_date'];

		$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
		$result_select3 = mysqli_query($conn, $select_query3);

		if (mysqli_num_rows($result_select3) > 0) {
			$row_select3 = mysqli_fetch_assoc($result_select3);
			$detail_sample = $row_select3['mt_name'];
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
		$mark = $row_select4['mark'];
		$brick_specification = $row_select4['brick_specification'];
	}
	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
		$material_location = $row_select4['material_location'];
	}
	?>



	<page size="A4">
		<input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()">
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
			<tr>
				<td style="text-align:center; font-size:18px;padding-bottom:15px; "><b><u>TEST REPORT OF WATER</u></b></td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Authority</td>
							<td style="border-left: 1px solid black;width:42%;text-align:left; "></td>
							<td style="border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp;&nbsp; Project No.</td>
							<td style="border-left: 1px solid black;border-right: 1px solid;width:19%;">&nbsp;&nbsp;</td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Name Of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; "></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid;"></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Name Of EPC</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; "></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; </td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; PMC</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; "></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; </td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Sample Receive Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; "></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp;Sample Testing Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%; border-right: 1px solid;">&nbsp;&nbsp;</td>
						</tr>


					</table><br>

				</td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;width:30%;font-weight:bold; text-align:left;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Sample Done By</td>
							<td style="border-left: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; </td>

						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left; padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp;Material Under Testing</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp;</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:2px;padding-top:2px;  ">&nbsp;&nbsp;No.of Sample/Agreement No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp;</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left; padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp;Lab ID</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp;</td>
						</tr>
					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:left; font-size:18px; "><u><b>Test Results of The Water Sample</b></u></td>
			</tr>

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:left;font-size:12px; ">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;border-top:1px solid;width:5%;font-weight:bold; text-align:center;padding-bottom:10px;padding-top:10px; "><u>Sr.<br>NO.</u></td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:20%;text-align:center;font-weight:bold; "><u>Test Description</u></td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:25%; text-align:center;font-weight:bold;"><u>Test Method</u></td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:15%;font-weight:bold;text-align:center; "><u>Results</u></td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:20%;text-align:center;font-weight:bold;"><u>As Per <br>IS 456:2000<br> Permission Limit</u></td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:15%;text-align:center;font-weight:bold;"><u>Unit</u></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; "></td>
							<td style="border-left: 1px solid black;width:25%; text-align:center;border-top:1px solid;"></td>
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;font-weight:bold;"></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;"></td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;"></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; "></td>
							<td style="border-left: 1px solid black;width:25%; text-align:center;border-top:1px solid;"></td>
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;font-weight:bold;"></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;"></td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;"></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; "></td>
							<td style="border-left: 1px solid black;width:25%; text-align:center;border-top:1px solid;"></td>
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;font-weight:bold;"></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;"></td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;"></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; "></td>
							<td style="border-left: 1px solid black;width:25%; text-align:center;border-top:1px solid;"></td>
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;font-weight:bold;"></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;"></td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;"></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; "></td>
							<td style="border-left: 1px solid black;width:25%; text-align:center;border-top:1px solid;"></td>
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;font-weight:bold;"></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;"></td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;"></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; "></td>
							<td style="border-left: 1px solid black;width:25%; text-align:center;border-top:1px solid;"></td>
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;font-weight:bold;"></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;"></td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;"></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; "></td>
							<td style="border-left: 1px solid black;width:25%; text-align:center;border-top:1px solid;"></td>
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;font-weight:bold;"></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;"></td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;"></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; "></td>
							<td style="border-left: 1px solid black;width:25%; text-align:center;border-top:1px solid;"></td>
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;font-weight:bold;"></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;"></td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;"></td>
						</tr>

					</table>

				</td>
			</tr>


			<tr>
				<td style="text-align:center; "><br>
					<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;font-size:14px; ">
						<tr>
							<td><b>Note :-</b></td>
						</tr>
						<tr>
							<td><b> > &nbsp;</b>Test rcsults are related to samples submitted by customers only.</td>
						</tr>
						<tr>
							<td><b> > &nbsp;</b> Test results are issued wilh specifïc understanding that GEC will not in any case be involved in action Following the information of the test results.</td>

						</tr>
						<tr>
							<td><b> > &nbsp;</b> The Test reports are not supposed to be used for publicity.</td>

						</tr>
						<tr>
							<td><b> > &nbsp;</b> Test report shall not be reproduced except in full Without written approvaI of GEC.</td>

						</tr>
						<tr>
							<td><b> * &nbsp;</b> 2000mg/L for Concrete not containing embedded steel and 500 mg/L for reinforced Concrete Work</td>

						</tr>

					</table>
				</td>
			</tr>

			<tr>
				<td style="text-align:right;font-size:11px;padding-right:80px; "><br><br><br><br><br><br>
					<table align="right" width="80%" class="test" style="height:auto;font-family: Cambria; ">
						<tr>
							<td style="text-align:right"><b>Approved By</b></td>
						</tr>
						<tr>
							<td style="text-align:right"><b>For, Goma Engineering Consultancy,</b></td>
						</tr>

						<tr>

							<td style="text-align:right"><b>| Darshan Patel |</b></td>

						</tr>
						<tr>

							<td style="text-align:right"><b>Authorized Signatory</b></td>

						</tr>
					</table>
				</td>
			</tr>


		</table>



		<br>
		<table align="center" width="92%" style="font-family:Cambria;margin-left:35px;font-size:12px;">
			<tr>

				<td style="width:40%;text-align:left;font-weight:bold;">
					Page No. 1 of 1
				</td>
				<td style="width:60%;text-align:left;font-weight:bold;">
					. . . . . . .END OF REPORT. . . . . . .
				</td>
			</tr>

		</table>
		<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


		</div>
	</page>

</body>

</html>

<script type="text/javascript">


</script>