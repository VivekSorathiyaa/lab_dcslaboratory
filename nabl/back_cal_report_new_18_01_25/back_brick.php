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
		font-family : Calibri;
	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family : Calibri;
	}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family : Calibri;

	}

	.tdclass1 {

		font-size: 11px;
		font-family : Calibri;
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
	$branch_name = $row_select['branch_name'];
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
        $issue_date = $row_select2['issue_date'];

		$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
		$result_select3 = mysqli_query($conn, $select_query3);

		if (mysqli_num_rows($result_select3) > 0) {
			$row_select3 = mysqli_fetch_assoc($result_select3);
			$mt_name= $row_select3['mt_name'];
			
			include_once 'sample_id.php';
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
		
		<!-- header design -->
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
				<!-- <tr>
					<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">CONCRETE</td>
				</tr>
				<tr>
					<td style="padding: 1px;border: 1px solid;"></td>
				</tr> -->
				<tr>
					<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;"><?php echo $mt_name; ?></td>
				</tr>
				<tr>
					<td style="padding: 1px;border: 1px solid;"></td>
				</tr>
		</table>
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 21%;">Format No :-</td>
				<td style="font-weight: bold;padding: 5px;width:30%;">FMT-OBS</td>
				<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Date of receipt :-</td>
				<td style="font-weight: bold;padding: 5px;"><?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
			</tr>
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
				<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
				<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Material Description :-</td>
				<td style="font-weight: bold;padding: 5px;"><?php echo $mt_name; ?></td>
			</tr>
			<tr>
				<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
			</tr>
		</table>
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 15%;">Test Method :-</td>
				<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS 2062:2011  Grade:<?php echo $row_select_pipe['ms_grade']; ?></td>
			</tr>
			<tr>
				<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
			</tr> -->
			<tr>
				<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
			</tr>
			<tr>
				<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
			</tr>
		</table>
		<table align="center" width="100%" class="test1">
			<tr style="border: 1px solid black;border-top: 0;">
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Type of brick</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $detail_sample;?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Identification mark</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $mark;?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of Specimen</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d/m/Y",strtotime($rec_sample_date)); ?></td>
			</tr>
		</table>
		<br>
		<table align="center" width="100%" class="test1" style="border: 1px solid black;" height="4%">
			<tr style="border: 0px solid black;">
				<td width="60%" rowspan="2" style="border: 0px solid black;border-right: 1px solid black;vticle-align:bottom;"><b>&nbsp; &nbsp; A. Dimensions and Tolerance </b></td>
				<td width="20%" style="border: 0px solid black;"><b>&nbsp; Date:</b></td>
			</tr>
			<tr>
				<td style="border-top: 1px solid black;border-right: 1px solid black;text-align:center;"><b>IS:1077-1992</b></td>
			</tr>
			
		</table>
		<table align="center" width="100%" class="test1" style="border: 1px solid black;" height="4%">
			<tr style="border: 0px solid black;">
				<td width="60%" rowspan="2" style="border: 0px solid black;border-right: 1px solid black;vticle-align:bottom;"><b>&nbsp; &nbsp; A. Dimensions and Tolerance </b></td>
				<td width="20%" style="border: 0px solid black;"><b>&nbsp; Date:</b></td>
			</tr>
			<tr>
				<td style="border-top: 1px solid black;border-right: 1px solid black;text-align:center;"><b>IS:1077-1992</b></td>
			</tr>
			
		</table>
		
		<?php $count=1?>
		<table align="center" width="100%" class="test1" style="border-right:1px solid;border-bottom:1px solid;margin-top:-1px;" Height="33%">
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
		<!-- footer design -->
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2'];?></td>
			</tr> -->
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border-left: 1px solid;border-top: 1px solid;">Checked By :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding: 5px;width: 12%;border: 1px solid;">Tested By :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>
			<br>
		<div class="pagebreak"></div>
		<br>
		
		<!-- <?php if ($branch_name == "Nadiad") {?>
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:100px;width:120px;border: 1px solid black;"><center><img src="../images/nadiad.png" style="height:150%;width:70%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format Om Geo Tech Services, Nadiad</b></center>
				</td>
			</tr>
			
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-004</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>
		<?php } else {?>
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><center><img src="../images/manglam.jpg" style="height:95%;width:90%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;text-transform:capitalize;">
					<center><b>Laboratory Quality System Format Manglam Consultancy Services, <Span style="text-transform:capitalize;"><?php echo $branch_name;?></span></b></center>
				</td>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-004</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>
		<?php }?>	 -->
		
	</page>

</body>

</html>


<script type="text/javascript">

</script>