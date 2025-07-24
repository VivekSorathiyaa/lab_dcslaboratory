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

		font-size: 11px;
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
	$select_tiles_query = "select * from span_brick_fly WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	$cons = $row_select['condition_of_sample_receved'];
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
		$mark = $row_select4['mark'];
		$brick_specification = $row_select4['brick_specification'];
	}

	?>

	<br>
	<br>

	<page size="A4">
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-004</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION AND CALCULATION SHEET FOR TEST ON <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>
		<br>	
		<table align="center" width="94%" class="test1" height="20%">

			<tr style="border: 1px solid black;">
				<td colspan="2" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of Sample &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample;?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $lab_no."_01"?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Type of brick</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $detail_sample;?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Identification mark</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $mark;?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of Specimen</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d - m - y",strtotime($rec_sample_date)); ?></td>
			</tr>
		</table>
		<br>
		<table align="center" width="94%" class="test1" style="border: 1px solid black;" height="4%">
			<tr style="border: 0px solid black;">
				<td width="60%" rowspan="2" style="border: 0px solid black;border-right: 1px solid black;vticle-align:bottom;"><b>&nbsp; &nbsp; A. Dimensions and Tolerance </b></td>
				<td width="20%" style="border: 0px solid black;"><b>&nbsp; Date:</b></td>
			</tr>
			<tr>
				<td style="border-top: 1px solid black;border-right: 1px solid black;text-align:center;"><b>IS:1077-1992</b></td>
			</tr>
			
		</table>
		<table align="center" width="94%" class="test1" style="border: 1px solid black;" height="4%">
			<tr style="border: 0px solid black;">
				<td width="60%" rowspan="2" style="border: 0px solid black;border-right: 1px solid black;vticle-align:bottom;"><b>&nbsp; &nbsp; A. Dimensions and Tolerance </b></td>
				<td width="20%" style="border: 0px solid black;"><b>&nbsp; Date:</b></td>
			</tr>
			<tr>
				<td style="border-top: 1px solid black;border-right: 1px solid black;text-align:center;"><b>IS:1077-1992</b></td>
			</tr>
			
		</table>
		
		<?php $count=1?>
		<table align="center" width="94%" class="test1" style="border-right:1px solid;border-bottom:1px solid;margin-top:-1px;" Height="33%">
			<tr style="border-top:1px solid;" >
				<td rowspan="2" style="width:10%;border-left:1px solid;text-align:center;"><b>Sr.No</b></td>
				<td style="width:18%;border-left:1px solid;text-align:center;"><b>Weight of the<br>sample<br>(completely<br>submerged in<br>Water)<br>W<sub>a</sub></b></td>
				<td style="width:18%;border-left:1px solid;text-align:center;"><b>Weight of the<br>Sample (After<br>Drain 1 min or SSD)<br>Ww	</b></td>
				<td style="width:18%;border-left:1px solid;text-align:center;"><b>Volume =<br>(Ww-Wa) x 10-3 Thickness</b></td>
				<td style="width:16%;border-left:1px solid;text-align:center;"><b>(Volume / Thickness) </b></td>
				<td style="width:20%;border-left:1px solid;text-align:center;"><b>Plan Area = </b></td>
			</tr>
			<tr>
				<td style="border-left:1px solid;text-align:center;"><b>N </b></td>
				<td style="border-left:1px solid;text-align:center;"><b>N</b></td>
				<td style="border-left:1px solid;text-align:center;"><b>m<sup>3</sup></b></td>
				<td style="border-left:1px solid;text-align:center;"><b>mm</b></td>
				<td style="border-left:1px solid;text-align:center;"><b>mm<sup>2</sup></b></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++;?></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++;?></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++;?></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++;?></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++;?></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++;?></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++;?></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++;?></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			
		</table>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:3px solid;">
			<tr style="padding-top:2px;">
				<td style="width:25%;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;"><center>Prepared by:</center></td>
				<td style="width:16.67%;"><center>Approved by:</center></td>
				<td style="width:16.67%;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style=""><center>Page 1 of 5</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>
			<br>
			<br>
		<div class="pagebreak"></div>
		<br>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-007</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE PAVERS BLOCKS</b></center>
				</td>
			</tr>
		</table>
	</page>

</body>

</html>


<script type="text/javascript">

</script>