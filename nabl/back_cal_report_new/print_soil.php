<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin:30px 30px;
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
		font-size: 13px;
		font-family: Arial;
	}

	.test1 {
		font-size: 13px;
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
	
	.tr {
		height:30px;
	}
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from soil WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$chainage_no = $row_select4['chainage_no'];
		$type_method = $row_select4['type_method'];
		$source= $row_select4['soil_source'];
		$sample_type= $row_select4['sample_type'];
		$soil_location= $row_select4['soil_location'];
		$material_location= $row_select4['material_location'];
	}

	?>


	<page size="A4">
		<!------------------- page -1 ------------------>
	    <table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>
		<br>
		
		<table align="center" width="100%" class="test1" height="9%">
			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;padding:5px 0px;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample;?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-left:1px solid;width:25%;text-align:left;padding:5px 0px;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;padding:5px 0px;" colspan=3>&nbsp; <?php echo $lab_no."_01"?></td>
			</tr>
            <tr style="border: 1px solid black;">
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp; BH/Sample No.</b></td>
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp; <?php echo $sample_type; ?></td>
                <td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp;Date of Starting</b></td>
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
			</tr>
            <tr style="border: 1px solid black;">
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp; Date of Receipt of Specimen</b></td>
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
                <td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp; Date of Completion</b></td>
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp; <?php echo date('d - m - Y', strtotime($end_date)); ?></td>
			</tr>
		</table>

        <!-- table 1 -->
        <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family: Arial;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;"><b>IS 2720 (Part-16)</b></td>
						</tr>
					</table> 
                    
                    
					<table align="center" width="100%" class="test1" height="9%">
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;">Method of Compaction</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;">Static/Dynamic</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;">Height of Sample (h)</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;">127.3 mm</td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;">Volume of CBR Mould</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;">2250 cm³</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;">Surcharge Weights </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> 5 Kgs </td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> Rate of Penetration </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> 125 mn/minute </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> Arca of Plunger </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> 20 cm³ </td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> Undisturbed Test at </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;">  </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b>FDD =      &nbsp;&nbsp;&nbsp; gm/cc </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b>FMC =      &nbsp;&nbsp;&nbsp;  % </b></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" rowspan=3> Remoulded Specimen at </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> <b>FDD <b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> <b>FDD =      &nbsp;&nbsp;&nbsp;  gm/cc </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> FMC =      &nbsp;&nbsp;&nbsp;  % </b></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> <b>MDD </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> 95% of MDD =  &nbsp;&nbsp;&nbsp; gm/cc </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> OMC =      &nbsp;&nbsp;&nbsp; % </b></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> 70% RD </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> RD =      &nbsp;&nbsp;&nbsp;  gm/cc </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> <b> </b></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=3>1) Weight of Oven dry soil required for cach mould of 2250 cm volume</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=1> gm </td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=3>2) Air dry soil (to be taken passing 20mm)</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=1> gm </td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=3>3) Water to be added to air dry soil taken to get desired moisture</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=1> cc </td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=3>4) Total weight of wet soil for cach mould</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=1> gm </td>
                        </tr>
                    </table>
					</td>
				</tr>																					
		</table>

        <!-- table 2 -->
        <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family: Arial;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;text-underline-offset: 3px;"><b><u>MOULD-1</u></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" height="Auto">
						<tr>
							<td style="border: 1px solid black;width:7%;padding: 4px 3px;"><center><b>No.</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Particulars</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Before Soaking</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>After Soaking</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Mould + Wet Soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Mould in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of wet soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Moisture in %</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Dry Density in gm/cc</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>

         <!-- table 3 -->
         <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;margin-top:10px;">
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" height="Auto">
                        <tr>
							<td style="padding:5px 0;font-size: 13px;" colspan=6><center><b>Moisture Content %</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;width:30%;"><center><b></b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Before Compaction</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>After Compaction</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Top 3 Layer (Before Soaking)</b></center></td>
                            <td style="border: 1px solid black;padding: 4px 3px;"><center><b>Top 3 Layer (After Soaking)</b></center></td>
                            <td style="border: 1px solid black;padding: 4px 3px;"><center><b>Average After Soaking</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;"> Container No</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"> Weight of container + Wet soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"> Weight of container + Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"> Weight of container in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"> Weight of Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"> Weight of Moisture in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"> Moisture Content in%</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
        <br>

        <table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>

        <!-- <div class="pagebreak"></div> -->

        <!-------------------- page -2 ------------------>
        <table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>

        <!-- table 4 -->
        <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family: Arial;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;text-underline-offset: 3px;"><b><u>MOULD-2</u></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" height="Auto">
						<tr>
							<td style="border: 1px solid black;width:7%;padding: 4px 3px;"><center><b>No.</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Particulars</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Before Soaking</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>After Soaking</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Mould + Wet Soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Mould in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of wet soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Moisture in %</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Dry Density in gm/cc</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>

        <!-- table 5 -->
        <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;margin-top:10px;">
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" height="Auto">
                        <tr>
							<td style="padding:5px 0;font-size: 13px;" colspan=6><center><b>Moisture Content %</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;width:30%;"><center><b></b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Before Compaction</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>After Compaction</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Top 3 Layer (Before Soaking)</b></center></td>
                            <td style="border: 1px solid black;padding: 4px 3px;"><center><b>Top 3 Layer (After Soaking)</b></center></td>
                            <td style="border: 1px solid black;padding: 4px 3px;"><center><b>Average After Soaking</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;">Container No</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of container + Wet soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of container + Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of container in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Moisture in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Moisture Content in%</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>

        <!-- table 6 -->
        <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family: Arial;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;text-underline-offset: 3px;"><b><u>MOULD-3</u></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" height="Auto">
						<tr>
							<td style="border: 1px solid black;width:7%;padding: 4px 3px;"><center><b>No.</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Particulars</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Before Soaking</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>After Soaking</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Mould + Wet Soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Mould in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of wet soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Moisture in %</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Dry Density in gm/cc</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
        
        <!-- table 7 -->
        <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;margin-top:10px;">
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" height="Auto">
                        <tr>
							<td style="padding:5px 0;font-size: 13px;" colspan=6><center><b>Moisture Content %</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;width:30%;"><center><b></b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Before Compaction</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>After Compaction</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Top 3 Layer (Before Soaking)</b></center></td>
                            <td style="border: 1px solid black;padding: 4px 3px;"><center><b>Top 3 Layer (After Soaking)</b></center></td>
                            <td style="border: 1px solid black;padding: 4px 3px;"><center><b>Average After Soaking</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;">Container No</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of container + Wet soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of container + Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of container in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Moisture in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Moisture Content in%</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:10px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
		

		<!-------------------- page 3 -------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>


		 <!-- table 8 -->
		 <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family: Arial;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:15px 0;font-size: 13px;text-underline-offset: 3px;"><b><u>MOULD-1</u></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2 rowspan=3><center>Penetration</center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2><center><b>UNSOAKED</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2><center><b>SOAKED</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2 rowspan=4><center>Total Standard  Load</center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp;  Proving Ring Capacity/ <br> &nbsp; Load cell =       <br><br>   &nbsp; Proving Ring Factor =   </td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp;  Proving Ring Capacity/ <br> &nbsp; Load cell =       <br><br>    &nbsp; Proving Ring Factor =   </td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp; Date of Testing:</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp; Date of Testing:</td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; mm</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Inch</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Dial Reading &nbsp; of Proving <br>&nbsp; Ring</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Load</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Dial Reading &nbsp; of Proving <br>&nbsp; Ring</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Load</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:12%;">0.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">0.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">Lb</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">Kg</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>
						
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.1</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3000</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1370</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">4.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">5.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.2</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">4500</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2055</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">7.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.3</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">5700</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2630</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">10.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.4</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">6900</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3180</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">12.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">7800</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3600</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">CBR at 2.5 mm Penetration</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">CBR at 5.0 mm Penetration</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">Final CBR%</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">Remarks</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>



		<!-------------------- page 4 ------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>

		 <!-- table 9 -->
		 <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family: Arial;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:15px 0;font-size: 13px;text-underline-offset: 3px;"><b><u>MOULD-2</u></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2 rowspan=3><center>Penetration</center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2><center><b>UNSOAKED</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2><center><b>SOAKED</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2 rowspan=4><center>Total Standard  Load</center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp;  Proving Ring Capacity/ <br> &nbsp; Load cell =       <br><br>   &nbsp; Proving Ring Factor =   </td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp;  Proving Ring Capacity/ <br> &nbsp; Load cell =       <br><br>    &nbsp; Proving Ring Factor =   </td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp; Date of Testing:</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp; Date of Testing:</td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; mm</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Inch</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Dial Reading &nbsp; of Proving <br>&nbsp; Ring</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Load</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Dial Reading &nbsp; of Proving <br>&nbsp; Ring</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Load</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:12%;">0.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">0.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">Lb</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">Kg</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>
						
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.1</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3000</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1370</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">4.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">5.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.2</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">4500</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2055</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">7.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.3</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">5700</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2630</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">10.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.4</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">6900</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3180</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">12.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">7800</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3600</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">CBR at 2.5 mm Penetration</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">CBR at 5.0 mm Penetration</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">Final CBR%</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">Remarks</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>


		<!------------------------ page 5 --------------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>

		 <!-- table 10 -->
		 <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family: Arial;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:15px 0;font-size: 13px;text-underline-offset: 3px;"><b><u>MOULD-3</u></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2 rowspan=3><center>Penetration</center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2><center><b>UNSOAKED</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2><center><b>SOAKED</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2 rowspan=4><center>Total Standard  Load</center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp;  Proving Ring Capacity/ <br> &nbsp; Load cell =       <br><br>   &nbsp; Proving Ring Factor =   </td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp;  Proving Ring Capacity/ <br> &nbsp; Load cell =       <br><br>    &nbsp; Proving Ring Factor =   </td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp; Date of Testing:</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp; Date of Testing:</td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; mm</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Inch</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Dial Reading &nbsp; of Proving <br>&nbsp; Ring</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Load</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Dial Reading &nbsp; of Proving <br>&nbsp; Ring</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Load</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:12%;">0.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">0.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">Lb</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">Kg</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>
						
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.1</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3000</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1370</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">4.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">5.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.2</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">4500</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2055</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">7.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.3</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">5700</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2630</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">10.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.4</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">6900</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3180</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">12.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">7800</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3600</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">CBR at 2.5 mm Penetration</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">CBR at 5.0 mm Penetration</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">Final CBR%</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">Remarks</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
		
		
		<!---------------------- page 6 --------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>
		
		 <!-- table 11 -->
		 <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family: Arial;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:15px 0 7px;font-size: 13px;"><b>IS 2720 (Part-13)</b></td>
						</tr>
					</table> 
                    
					<table align="center" width="100%" class="test1" style="text-align:center;">
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;padding:6px 3px;width:30%;">Specimen Dimension in cm</td>
                            <td style="border-left:1px solid;padding:6px 3px;width:20%;">L = 60 <br> B = 60 <br> H = 2.5</td>
                            <td style="border-left:1px solid;padding:6px 3px;width:30%;">Normal Stress Kg/cm²</td>
                            <td style="border-left:1px solid;padding:6px 3px; width:20%;">0.5 <br> 1.0 <br> 2.0 <br> 3.0</td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;padding:3px 0px;">Initial Consolidation time in min</td>
                            <td style="border-left:1px solid;padding:3px 0px;">45 min</td>
                            <td style="border-left:1px solid;padding:3px 0px;">Rate of strain in mm/min</td>
                            <td style="border-left:1px solid;padding:3px 0px;">1.25</td>
                        </tr>

                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;padding:3px 0px;" rowspan=3>Type of Test</td>
                            <td style="border-left:1px solid;padding:3px 0px;" colspan=2>(a) Unconsolidated Un drained Test</td>
                            <td style="border-left:1px solid;padding:3px 0px;"></td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;padding:3px 0px;" colspan=2>(b) Consolidated Un drained Test</td>
                            <td style="border-left:1px solid;padding:3px 0px;"></td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;padding:3px 0px;" colspan=2>(c) Consolidated Drained Test</td>
                            <td style="border-left:1px solid;padding:3px 0px;"></td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;padding:3px 0px;">Undisturbed Test at</td>
                            <td style="border-left:1px solid;padding:3px 0px;"></td>
                            <td style="border-left:1px solid;padding:3px 0px;">FDD =   gm/cc</td>
                            <td style="border-left:1px solid;padding:3px 0px;">FMC=    %</td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;padding:3px 0px;" rowspan=3>Remoulded Specimen at</td>
                            <td style="border-left:1px solid;padding:3px 0px;">FDD =   gm/cc</td>
                            <td style="border-left:1px solid;padding:3px 0px;">100% of FDD =   gm/cc</td>
                            <td style="border-left:1px solid;padding:3px 0px;">FMC=    %</td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;">MDD =   gm/cc</td>
                            <td style="border-left:1px solid; padding:3px 0px;">95% of MDD =   gm/cc</td>
                            <td style="border-left:1px solid; padding:3px 0px;">OMC=    %</td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;">70% RD</td>
                            <td style="border-left:1px solid; padding:3px 0px;">RD=    gm/cc</td>
                            <td style="border-left:1px solid; padding:3px 0px;"></td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=4>Remoulding of Specimen</td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=3>1) Volume of Mould in cc</td>
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=1>90 cc</td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=3>2) Weight of oven dry soil to be taken for cake in gm (W = d x V)</td>
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=1></td>
                        </tr>


						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=3>3) Weight of water to be added in gm (OMC or FMC x W / 100)</td>
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=1></td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=3>4) Total weight of wet soil in gm (For one cake) (2) + (3)</td>
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=1></td>
                        </tr>
                    </table>
					</td>
				</tr>																					
		</table>
		<br>

		 <!-- table 12 -->
		 <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" rowspan=2><center><b>Failure time in min</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" rowspan=2><center><b>Corrected Area (Ac) cm³</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" rowspan=2><center><b>Normal Stress Kg/cm²</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"colspan=2><center><b>Max. Shear Stress</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" rowspan=2><center><b>Strain at Failure%</b></center></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>SF=K x Dial reading (Kg)</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Stress = SF/Ac Kg/cm²</b></center></td>
						</tr>

						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>0.50</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>

						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>1.00</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>

						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>2.00</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>

						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>3.00</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br>
		
		 <table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>

        <div class="pagebreak"></div> 
		
		
		<!--------------------- page 7 --------------------->
		 <table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>
		<br> 

		<!-- table 13 -->
		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;text-align:center;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;width:20%;" colspan=3><center><b></b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;width:80%;" colspan=12><center><b>Normal Stress Kg/cm<sup>2</sup></b></center></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=3>Time in min</td>
							<td style="border: 1px solid black;padding: 4px 3px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=3>Corrected <br>Area in cm²</td>
							<td style="border: 1px solid black;padding: 4px 3px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=3>Strain in %</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=3>0.5 kg/cm²</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=3>1.0 Kg/cm²</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=3>2.0 Kg/cm²</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=3>3.0 Kg/cm²</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>PR Dial <br> Reading</td>
							<td style="border: 1px solid black;padding: 4px 3px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=2>Stress <br> Kg/cm²</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>PR Dial <br> Reading</td>
							<td style="border: 1px solid black;padding: 4px 3px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=2>Stress <br> Kg/cm²</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>PR Dial <br> Reading</td>
							<td style="border: 1px solid black;padding: 4px 3px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=2>Stress <br> Kg/cm²</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>PR Dial <br> Reading</td>
							<td style="border: 1px solid black;padding: 4px 3px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=2>Stress <br> Kg/cm²</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">VR</td>
							<td style="border: 1px solid black;padding: 4px 3px;">HR</td>
							<td style="border: 1px solid black;padding: 4px 3px;">VR</td>
							<td style="border: 1px solid black;padding: 4px 3px;">HR</td>
							<td style="border: 1px solid black;padding: 4px 3px;">VR</td>
							<td style="border: 1px solid black;padding: 4px 3px;">HR</td>
							<td style="border: 1px solid black;padding: 4px 3px;">VR</td>
							<td style="border: 1px solid black;padding: 4px 3px;">HR</td>
						</tr>

						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>0.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>36.000</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>0.000</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>

						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>0.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>35.625</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>1.04</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>1.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>35.250</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>2.08</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>1.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>34.875</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>3.13</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>2.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>34.500</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>4.16</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>2.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>34.125</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>5.21</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>3.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>33.750</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>6.25</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>3.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>33.375</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>7.29</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>4.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>33.000</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>8.33</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>4.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>32.625</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>9.38</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>5.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>32.250</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>10.42</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>5.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>31.875</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>11.46</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>6.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>31.500</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>12.50</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>6.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>31.125</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>13.54</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>7.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>30.750</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>14.58</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>7.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>30.375</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>15.03</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>8.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>30.000</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>16.67</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>8.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>29.625</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>17.71</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>9.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>29.250</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>18,75</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>9.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>28.875</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>19.79</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>10.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>28.500</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>20.83</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br> 

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>

        <div class="pagebreak"></div> 
		

		<!---------------------- page 8 ---------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>
		<br><br>

		<!-- table 14 -->
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family: Arial;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;"><b>IS 2720(Part 12), ASTM D4767 & ASTM D7181</b></td>
						</tr>
					</table> 
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Type of Test</center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Saturated/CU/CD</center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Lateral Pressure (σ₃)</center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Kg/cm<sup>2</sup></center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Deformation rate (mm/min)</center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br><br>

		<!-- table 15 -->
		 <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td style="width:38%;">
					    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;" colspan=2><center><b>PRE-SHEAR DATA</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:70%">Initial Diameter (D) cm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>3.80</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Length (Lo) cm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>7.60</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Area (Ao) cm²</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>11.34</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Volume (Vo) cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>86.20</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Dry Density gm/cm²</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Moisture Content %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wet Weight in gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
					<td style="width:2%;">
					    <table align="center" width="100%" class="test1" style="">
							<tr>
								<td style="">&nbsp;</td>
							</tr>
					    </table>
					</td>
					<td style="width:60%;">
					    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" >
							<tr>
								<td style="border: 1px solid black;padding: 12px 3px;" colspan=2><center><b>REMOULDING OF SPECIMEN</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:80%;">Desired Dry Density (D) gm/cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Desired Moisture (M) %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Volume of Mould (Vo) cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>86.20</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of Oven dry soil to be taken (a) = D X Vo</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of water to be added to attain Moisture (M) </td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;"> Exact Wt. of wet soil for one specimen of volume. (Vo)=  d <br> d = (100+M) (a) (0.01) gm.</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br><br>

		<!-- table 16 -->
		<table align="center" width="70%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;" colspan=2><center><b>POST SHEAR MOISTURE CONTENT</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>Specimen Reference</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>Final Water content%</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Container No.</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of cont + wet soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>11.34</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of cont + dry soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>86.20</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of water gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt of can gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt of Dry soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Water Content %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br><br>


		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>

        <div class="pagebreak"></div>


		<!---------------------- page 9 ---------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>
		<br>

		<!-- table 16 -->
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;" colspan=6><center>Saturation</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;" colspan=6><center>Consolidation</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Date</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Time</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Cell <br> Pressure in <br>Kg/cm<sup>2</sup></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Back <br> pressure in <br>kg/cm<sup>2</sup></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Pore <br> Pressure in <br>Kg/cm<sup>2</sup></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>B value</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Date</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Time</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Time in &#8730;second</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Initial reading</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Final reading</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Change in Volume</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2	</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
		

		<!---------------------- page 10 ---------------------->
		 <table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>
		<br>

		<!-- table 17 -->
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">	
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family: Arial;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;"><b>Cell Pressure (σ₃)  <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u> Kg/cm²</b></td>
						</tr>
					</table> 
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Strain e = &#8710; L/L  %</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Axial Load P Kg</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Corrected Area (Ac) cm² σ<sub>1</sub>=  Ao/(1-e)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Deviator Stress p = P/Ac kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>MP Stress σ<sub>1</sub> = P+σ₃ kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Back pressure kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Pore Pressure (U) kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>σ₃ = (σ₃-U) kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>σ<sub>1</sub> = (σ<sub>1</sub> -U)  kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Remark</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">5</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">7</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">8</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">9</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">10</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">11</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">12</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">14</td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">4.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">5.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">7.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">8.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">9.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">10.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">11.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">12.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">13.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">14.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">15.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">16.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">17.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">18.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">19.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">20.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:15px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
		
		
		<!---------------------- page 11 ---------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?> - triaxlal shear test (without pore water pressure measurement)</b></center>
				</td>
			</tr>
		</table>
		<br> 

		<!-- table 18 -->
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family: Arial;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;"><b>IS 2720(Part 12), ASTM D4767 & ASTM D7181</b></td>
						</tr>
					</table> 
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Type of Test</center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Unconsolidated-undrained</center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Lateral Pressure (σ₃)</center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Kg/cm<sup>2</sup></center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Deformation rate</center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>1.25 mm / min</center></td>
						</tr>
						
					</table>
					</td>
				</tr>																					
		</table>
		<br><br>

		<!-- table 19 -->
		 <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td style="width:38%;">
					    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;" colspan=2><center><b>PRE-SHEAR DATA</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:70%">Initial Diameter (D) cm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>3.80</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Length (Lo) cm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>7.60</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Area (Ao) cm²</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>11.34</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Volume (Vo) cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>86.20</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Dry Density gm/cm²</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Moisture Content %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wet Weight in gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
					<td style="width:2%;">
					    <table align="center" width="100%" class="test1" style="">
							<tr>
								<td style="">&nbsp;</td>
							</tr>
					    </table>
					</td>
					<td style="width:60%;">
					    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" >
							<tr>
								<td style="border: 1px solid black;padding: 12px 3px;" colspan=2><center><b>REMOULDING OF SPECIMEN</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:80%;">Desired Dry Density (D) gm/cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Desired Moisture (M) %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Volume of Mould (Vo) cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>86.20</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of Oven dry soil to be taken (a) = D X Vo</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of water to be added to attain Moisture (M) </td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;"> Exact Wt. of wet soil for one specimen of volume. (Vo)=  d <br> d = (100+M) (a) (0.01) gm.</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br><br>

		<!-- table 20 -->
		 <table align="center" width="70%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;" colspan=2><center><b>POST SHEAR MOISTURE CONTENT</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>Specimen Reference</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>Final Water content%</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Container No.</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of cont + wet soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>11.34</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of cont + dry soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>86.20</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of water gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt of can gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt of Dry soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Water Content %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br><br>
		

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
		


		<!---------------------- page 12 ---------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?> - triaxlal shear test (without pore water pressure measurement)</b></center>
				</td>
			</tr>
		</table>
		<br>

		<!-- table 21 -->
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center> Deformation mm &#8710;L</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Dial Gauge (0.01 mm)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Strain e= &#8710;L/L%</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Lateral pressure (Cell pressure) σ₃</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Axial Load Pkg</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Corrected Area (Ac) cm² = Ao/(1-e)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Deviator Stress p=P/Ac kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>MP Stress σ<sub>1</sub> = p+σ₃ kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Area for quick (UU) test 'A' cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Remark</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">5</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">7</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">8</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">9</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">10</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">11</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">12</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">14</td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">4.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">5.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">7.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">8.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">9.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">10.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">11.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">12.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">13.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">14.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">15.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">16.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">17.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">18.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">19.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">20.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:15px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>

        <div class="pagebreak"></div>
		
		
		<!-- star vivek -->
		<!---------------------- page 13 ---------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?> - <span style="text-transform:capitalize;">Unconfined Compressive strength (UCS)</span></b></center>
				</td>
			</tr>
		</table>
		<br>


		<!-- table 22 -->
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
               <tr>
							<td style="padding:7px 0;font-size: 13px;"><br><b>IS 2720(Part 10)</b></td>
						</tr>
				<tr>
					<td style="width:38%;">
					    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;" colspan=2><center><b>PRE-SHEAR DATA</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:70%">Initial Diameter (D) cm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Length (Lo) cm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Area (Ao) cm²</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Volume (Vo) cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Dry Density gm/cm²</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Moisture Content %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wet Weight in gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
					<td style="width:2%;">
					    <table align="center" width="100%" class="test1" style="">
							<tr>
								<td style="">&nbsp;</td>
							</tr>
					    </table>
					</td>
					<td style="width:60%;">
					    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" >
							<tr>
								<td style="border: 1px solid black;padding: 12px 3px;" colspan=2><center><b>REMOULDING OF SPECIMEN</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:80%;">Desired Dry Density (D) gm/cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Desired Moisture (M) %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Volume of Mould (Vo) cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of Oven dry soil to be taken (a) = D X Vo</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of water to be added to attain Moisture (M) </td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;"> Exact Wt. of wet soil for one specimen of volume. (Vo)=  d <br> d = (100+M) (a) (0.01) gm.</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br><br> 


		<!-- table 23 -->
		<table align="center" width="70%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;" colspan=2><center><b>POST SHEAR MOISTURE CONTENT</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>Specimen Reference</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>Final Water content%</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Container No.</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of cont + wet soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of cont + dry soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of water gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt of can gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt of Dry soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Water Content %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br><br><br><br><br><br><br><br><br><br><br>
		

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>

        <div class="pagebreak"></div>
		


		<!---------------------- page 14 ---------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?> - <span style="text-transform:capitalize;">Unconfined Compressive strength (UCS)</span></b></center>
				</td>
			</tr>
		</table>
		<br>

		<!-- table 24 -->
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;" ><center>Deformation mm &#8710;L</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Dial Gauge (0.01 mm)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Strain e= &#8710;L/L%</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Axial Load P kg</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Corrected Area (Ac) cm² = Ao/(1-e)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Deviator Stress p=P/Ac kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Compressive strength (kg/cm²)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Remark</center></td>
							</tr>
                       
							<tr>
								<td style="padding:6px 3px;text-align:center;border-top:2px solid black;border-bottom:2px solid black; border-right: 1px solid black;"><b>1</b></td>
								<td style="padding:6px 3px;text-align:center;border-top:2px solid black;border-bottom:2px solid black; border-right: 1px solid black;"><b>2</b></td>
								<td style="padding:6px 3px;text-align:center;border-top:2px solid black;border-bottom:2px solid black; border-right: 1px solid black;"><b>3</b></td>
								<td style="padding:6px 3px;text-align:center;border-top:2px solid black;border-bottom:2px solid black; border-right: 1px solid black;"><b>5</b></td>
								<td style="padding:6px 3px;text-align:center;border-top:2px solid black;border-bottom:2px solid black; border-right: 1px solid black;"><b>6</b></td>
								<td style="padding:6px 3px;text-align:center;border-top:2px solid black;border-bottom:2px solid black; border-right: 1px solid black;"><b>7</b></td>
								<td style="padding:6px 3px;text-align:center;border-top:2px solid black;border-bottom:2px solid black; border-right: 1px solid black;"><b>8</b></td>
								<td style="padding:6px 3px;text-align:center;border-top:2px solid black;border-bottom:2px solid black; border-right: 1px solid black;"><b>14</b></td>					
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.38</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">38</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.76</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">76</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.14</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">114</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.52</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">152</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.90</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">190</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2.28</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">228</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3.04</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">304</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">4.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3.80</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">380</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">5.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">4.56</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">456</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">5.32</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">532</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">7.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6.08</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">608</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">8.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6.84</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">684</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">9.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">7.60</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">760</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">10.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">8.36</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">836</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">11.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">9.12</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">912</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">12.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">9.88</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">988</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">13.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">10.64</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1064</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">14.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">11.40</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1140</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">15.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">12.16</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1216</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">16.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">12.94</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1294</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">17.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">13.68</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1368</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">18.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">14.44</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1444</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">19.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">15.20</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1520</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">20.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
        

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:15px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>

        <div class="pagebreak"></div>
		<!-- end vivek -->



		<!---------------------- page 15 ---------------------->
		 <table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?> <span style="text-transform:capitalize;"> (permeability test)</span></b></center>
				</td>
			</tr>
		</table>
		<br>
		
		<!-- table 25 -->
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td>
						<table width="100%" class="test1" style="border: 0;font-family: Arial;margin-bottom: 0;" height="Auto">
							<tr>
								<td style="padding:7px 0;font-size: 15px;"><b>IS2720 (Part-17)</b></td>
							</tr>
						</table> 
						<table width="100%" class="test1" style="border: 0;font-family: Arial;margin-bottom: 0;" height="Auto">
							<tr>
								<td style="padding:7px 0;font-size: 13px;"><b>&nbsp;&nbsp; Permeability Test</b></td>
							</tr>
							<tr>
								<td style="text-align:left;padding:3px 3px;">&nbsp;&nbsp; 1. Length of specimen (L) Cm</td>
							</tr>
							<tr>
								<td style="text-align:left;padding:3px 3px;">&nbsp;&nbsp; 2. Area of specimen (A) Cm²</td>
							</tr>
							<tr>
								<td style="text-align:left;padding:3px 3px;">&nbsp;&nbsp; 3 Room Temperature (T) &#8451;</td>
							</tr>
							<tr>
								<td style="text-align:left;padding:3px 3px;">&nbsp;&nbsp; 4. Temperature correction (U) =  <span><u> Viscosity at T°C </u></span> <br> <span style="margin-left:26%;">Viscosity at 27°C </span></td>
							</tr>
							<tr>
								<td style="text-align:left;padding:3px 3px;">&nbsp;&nbsp; 5. Area of stand pipe (a) Cm²</td>
							</tr>
						</table> 
						<table width="100%" class="test1" style="border: 0;font-family: Arial;margin-bottom: 0;" height="Auto">
							<tr>
								<td style="padding:7px 0;font-size: 15px;"><b>Falling Head Permeability Test</b></td>
							</tr>
							<tr>
								<td style="font-size: 13px;">&nbsp;&nbsp; Coefficient of permeability K₁ = <span><u>2.303 X a X L</u></span> Log 10 <u style="text-underline-offset: 2px;">h<sub>1</sub></u></td>
							</tr>
							<tr>
								<td style="font-size: 13px;"><span style="margin-left:30%;">A X t </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; h<sub>2</sub></td>
							</tr>
						</table> 	
					</td>
				</tr>																					
		</table>
		<br>

		<!-- table 26 -->
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;" ><center>Clock time</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>Initial head (h<sub>1</sub>) Cm</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>Final head (h<sub>2</sub>) Cm</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>Elapsed time (t) Sec.</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>Temperature of water (T) °C</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>K<sub>T</sub> Cm/Sec 10<sup>-6</sup></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>K<sub>27</sub> Cm/Sec 10<sup>-6</sup></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>K<sub>27</sub> Cm/Sec 10<sup>-6</sup></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">4</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">5</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br>
		
		<!-- table 26 -->
		 <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;" ><center>Temp.</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>24</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>25</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>26</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>27</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>28</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>29</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>30</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>31</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>32</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">Temp Corr</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.070</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.047</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.023</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.0</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.979</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.958</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.938</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.911</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.899</td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>

		<!-- table 27 -->
        <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">	
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family: Arial;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;"><b>Specimen Details</b></td>
						</tr>
					</table> 
                    
                    
					<table align="center" width="100%" class="test1" height="9%">
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;width:30%;"> Undisturbed Test at </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;width:20%;">  </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;width:30%;"><b>FDD =      &nbsp;&nbsp;&nbsp; gm/cc </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;width:20%;"><b>FMC =      &nbsp;&nbsp;&nbsp;  % </b></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" rowspan=3> Remoulded Specimen at </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> <b>FDD =   &nbsp;&nbsp;&nbsp;  gm/cc <b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> <b>100% of FDD =      &nbsp;&nbsp;&nbsp;  gm/cc </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> FMC =      &nbsp;&nbsp;&nbsp;  % </b></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> <b>MDD =   &nbsp;&nbsp;&nbsp;  gm/cc </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> 95% of MDD =  &nbsp;&nbsp;&nbsp; gm/cc </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> OMC =      &nbsp;&nbsp;&nbsp; % </b></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> 70% RD </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> RD =      &nbsp;&nbsp;&nbsp;  gm/cc </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> <b> </b></td>
                        </tr>
						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=4>Remoulding of Specimen</td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=3>1) Volume of Mould in cc</td>
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=1></td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=3>2) Weight of oven dry soil to be taken for cake in gm (W = d x V)</td>
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=1></td>
                        </tr>


						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=3>3) Weight of water to be added in gm (OMC or FMC x W / 100)</td>
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=1></td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=3>4) Total weight of wet soil in gm (For one cake) (2) + (3)</td>
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=1></td>
                        </tr>
                    </table>
					</td>
				</tr>																					
		</table>
		<br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
			


		<!---------------------- page 17 ---------------------->
		 <table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?> <span style="text-transform:capitalize;"> (Consolidation test)</span></b></center>
				</td>
			</tr>
		</table>

		<!-- table 32 -->
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">	
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family: Arial;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;"><b>IS 2720 (Part-15)</b></td>
						</tr>
					</table> 
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding: 3px 3px;width:35%;" >Dial Gauge No.</td>
								<td style="border: 1px solid black;padding: 3px 3px;width:15%;"><center></center></td>
								<td style="border: 1px solid black;padding: 3px 3px;width:35%;">Least Count of Dial Gauge</td>
								<td style="border: 1px solid black;padding: 3px 3px;width:15%;"><center>0.002 mm</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;">Remoulded/Undisturbed</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;">Sp. Gr. of Soil (G<sub>S</sub>)</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">1.023</td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;">Const. Height (2H) in cm</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">2.0</td>
								<td style="border: 1px solid black; padding:3px 3px;">Density of Water (r<sub>W</sub>)</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">1.0 gm/cc</td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;">Cont Diameter (D) in cm</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">6.0</td>
								<td style="border: 1px solid black; padding:3px 3px;">Dry Wt. of Specimen (W<sub>S</sub>)</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;">Cont Area (A) cm<sup>2</sup></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">28.26</td>
								<td style="border: 1px solid black; padding:3px 3px;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;">Solid Height (2H<sub>o</sub>) = W<sub>8</sub>/G<sub>s</sub> X r<sub>w</sub> X A</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br>

		<!-- table  33-->
		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:7%;" ><center>No.</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>Particulars</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>Before Test</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>After Test</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Container No.</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Wt. of Container + Wt. of Wet soil in gm</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Wt of Container + Wt. of Dry Soil in gm</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Wt. of Water in gm</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Wt of Container in gm</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Wt. of Dry soil in gm</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Water Content in %</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Volume of Specimen in ee</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Dry Density in gm/cc</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Dry Density</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Moisture Content</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Liquid Limit</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br>

		<!-- table 34 -->	
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;" colspan=8><center>Results</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;" ><center>Range of Pressure "p" Kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;"><center>Coefficient of consolidation C<sub>v</sub> = </center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;"><center>Compression Index C<sub>c</sub></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;"><center>Pre consolidation Pressure P<sub>c</sub> Kg/cm³</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;"><center>Swelling Control Load (SCL) Kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;"><center>Coefficient of Volume compressibility (m<sub>v</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;"><center>Coefficient of Compressibility cm²/gm (a<sub>v</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;writing-mode: tb-rl;transform: rotate(-180deg);"><center>Remarks</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.0 - 0.1</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"  rowspan=7></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"  rowspan=7></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.1 - 0.2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.2 - 0.4</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.4 - 0.8</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.8 - 1.6</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">16 - 3.2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3.2 - 6.4</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
			
		 <table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:20px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
         <div class="pagebreak"></div>
			
			

		<!---------------------- page 18 ---------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?> <span style="text-transform:capitalize;"> (Consolidation test)</span></b></center>
				</td>
			</tr>
		</table>

		<!-- table  35-->
		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;margin-top:10px;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;" colspan=2>Date</td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center> </center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;" colspan=2>Time of Starting</td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center> </center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;" colspan=2>Pressure increment Kg/cm² </td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center>0.0  - 0.1</center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center>0.1 - 0.2</center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center>0.2 - 0.4</center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center>0.4 - 0.8</center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center>0.8 - 1.6</center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center>1.6 - 3.2</center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center>3.2 - 6.4</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;">Elapsed Time in minute = t </td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center>&#8730;t</center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;" colspan=7><center>Dial Readings (accuracy 1 division = 0.002 mm)</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">0.00</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">0.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">0.25</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">0.5</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">0.00</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">0.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">1.00</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">1.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">2.25</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">1.5</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">4.00</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">2.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">6.25</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">2.5</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">9.00</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">3.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">12.25</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">3.5</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">16</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">4.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">25</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">5.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">36</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">6.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">49</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">7.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">64</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">8.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr><tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">81</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">9.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">100</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">10.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">121</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">11.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">144</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">12.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">169</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">13.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">196</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">14.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">225</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">15.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">256</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">16.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">289</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">17.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">324</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">18.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">361</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">19.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">400</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">20.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">500</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">22.4</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">600</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">24.5</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">1440 (24hrs)</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">38.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;" colspan=2><b>Unloading</b></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">25</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">5.4</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">100</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">10.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">225</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">15.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">1440</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">38.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
			
		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:10px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
         <div class="pagebreak"></div>


		 <!---------------------- page 18 ---------------------->
		 <table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?> <span style="text-transform:capitalize;"> (Consolidation test)</span></b></center>
				</td>
			</tr>
		</table>

		<!-- table  36-->
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding: 3px 3px;width:10%;"><center>1</center></td>
								<td style="border: 1px solid black;padding: 3px 3px;width:20%;">* P<sub>1</sub></td>
								<td style="border: 1px solid black;padding: 3px 3px;width:20%;"><center></center></td>
								<td style="border: 1px solid black;padding: 3px 3px;width:20%;">* P<sub>2</sub></td>
								<td style="border: 1px solid black;padding: 3px 3px;width:20%;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 3px 3px;width:7%;"><center>1</center></td>
								<td style="border: 1px solid black;padding: 3px 3px;" colspan=3> Co-efficient of compressibility "a<sub>v</sub>" 0.435 Cc / 0.5 (P<sub>1</sub> + P<sub>2</sub>) cm²/gm</td>
								<td style="border: 1px solid black;padding: 3px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 3px 3px;width:7%;"><center>3</center></td>
								<td style="border: 1px solid black;padding: 3px 3px;" colspan=3> Compression Index Cc = e<sub>1</sub>-e<sub>2</sub> / log (P<sub>2</sub>/P<sub>1</sub>) Where, P<sub>2</sub> = 2P<sub>1</sub></td>
								<td style="border: 1px solid black;padding: 3px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 3px 3px;width:7%;"><center>4</center></td>
								<td style="border: 1px solid black;padding: 3px 3px;" colspan=3>Co-efficient of volume compressibility m<sub>v</sub> = a<sub>v</sub> /( 1+ 	e) cm² / gm Where, e = Original Void Ratio</td>
								<td style="border: 1px solid black;padding: 3px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br>

		<!-- table  36-->
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;" rowspan=2 colspan=2><center>Applied <br> Pressure (p)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;" rowspan=2><center>Final Dial <br> Reading (df)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;" rowspan=2><center>Change in <br> Dial Reading</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;" rowspan=2><center>Thickness of <br> Soil Sample (2H)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;" rowspan=2><center>Equivalent <br> of Height of <br> Voids (2H - 2H<sub>o</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;" rowspan=2><center>Void Ratio <br> (2H - 2H<sub>o</sub>/2H<sub>o</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;" colspan=2><center>Fitting Time</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;writing-mode: tb-rl;transform: rotate(-180deg);width:10%;" rowspan=2><center>Mean <br> Thickness <br> (C<sub>v</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;writing-mode: tb-rl;transform: rotate(-180deg);width:10%;" colspan=2><center>Coefficient <br> of consolidation <br> (C<sub>v</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;writing-mode: tb-rl;transform: rotate(-180deg);width:10%;"><center> Coefficient of <br> Compressibility <br> (a<sub>v</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;writing-mode: tb-rl;transform: rotate(-180deg);width:10%;"><center>Coefficient of <br> Volume  Compressibility <br> (m<sub>v</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;writing-mode: tb-rl;transform: rotate(-180deg);width:10%;"><center>Compression <br>Index</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>t<sub>50</sub></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;" ><center>t<sub>90</sub></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>0.197h(C<sup>2</sup>) t<sub>50</sub></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>0.848h t<sub>90</sub></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>= 0.435 Cc/0.5 (P<sub>1</sub> + P<sub>2</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>= a<sub>v</sub> / (1 + e)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center> <u>e <sub>1</sub> - e <sub>2</sub></u> <br> 0.30103</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>Kg/cm<sup>2</sup></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;" ><center>cm</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>cm</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>cm</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;" colspan=2><center>See</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>cm</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;" colspan=2><center> cm <sup>2</sup>/See</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center> cm <sup>2</sup>/gm</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center> cm <sup>2</sup>/gmc</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center></center></td>
							</tr>

							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">P1</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.1</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">P2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">P3</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.4</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">P4</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.8</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">P5</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.6</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">P6</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3.2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">P7</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6.4</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">P18</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							
					    </table>
					</td>
				</tr>																					
		</table>
		<br><br><br><br><br><br>


		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:10px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
         <div class="pagebreak"></div>



		<!---------------------- page 19 ---------------------->
		 <table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?> <span style="text-transform:capitalize;"><br> (determination of liquid and plastic limit)</span></b></center>
				</td>
			</tr>
		</table>
		<br> 

		<!-- table  37-->
		 <table align="center" width="100%" class="test">
					
			<tr>
			    <td VALIGN=BOTTOM colspan="8" style="border: 0px solid black;padding:7px 0px;"><b>IS 2720 (Part-5)</b></td>
			</tr>
			<tr>
				<td rowspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;width:40%;"><b>Particulars</b></td>
				<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;width:30%;"><b> Liquid Limit</b></td>
				<td colspan="2 "style="border: 1px solid black;text-align:center;padding:6px 3px;width:30%;"><b> Plastic Limit</b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:15%;"><b>1</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:15%;"><b>2</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:15%;"><b>1</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:15%;"><b>2</b></td>
			</tr>		
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;Penetration in mm D</td>
				<td colspan="2" style="border: 1px solid black;padding:6px 3px;text-align:center;"><?php echo (($row_select_pipe['pen1'] +$row_select_pipe['pen2']) / 2);?></td>
				<td colspan="2" style="border: 1px solid black;padding:6px 3px;text-align:center;"><?php echo (($row_select_pipe['pen3'] +$row_select_pipe['pen4']) / 2);?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;Container No.</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['cont1'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['cont2'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['cont3'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['cont4'];?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;Wt. of Container + Wt. of wet soil in gm.</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['wc1'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['wc2'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['wc3'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['wc4'];?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;Wt. of Container + Wt. of Oven Dry soil in gm.</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['od1'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['od2'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['od3'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['od4'];?></td>
			</tr>
			
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;Wt. of water in gm</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['ww1'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['ww2'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['ww3'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['ww4'];?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;Wt. of Container in gm</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['wf1'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['wf2'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['wf3'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['wf4'];?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;Wt. of oven dry soil in gm</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['ds1'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['ds2'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['ds3'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['ds4'];?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;Moisture content % </td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['mo1'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['mo2'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['mo3'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['mo4'];?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:4px 0;">&nbsp;&nbsp;Average percent W<sub>N</sub></td>
				<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>&nbsp;&nbsp;W<sub>N</sub></b> = &nbsp; &nbsp; <?php echo (($row_select_pipe['mo1'] + $row_select_pipe['mo2']) / 2) ;?></td>
				<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>&nbsp;&nbsp;W<sub>P</sub></b> = &nbsp; &nbsp; <?php echo (($row_select_pipe['mo3'] + $row_select_pipe['mo4']) / 2) ;?></td>
			</tr>
			<tr>
				<td colspan="5" style="text-align:left;padding:8px;"></td>
			</tr>
			<tr>
				<td colspan="5" style="border: 1px solid black;text-align:left;padding:15px 0;">&nbsp;&nbsp;W<sub>L</sub> = W<sub>N</sub> / [0.65 + ( 0.0175 x D )] OR W<sub>N</sub> / 0.77 log D &nbsp; &nbsp; = &nbsp; &nbsp; <?php echo $row_select_pipe['avg_ll'];?></td>
			</tr>
		</table>	
		<br>
	
		<!-- table  38-->
		 <table align="center" width="100%" class="test">
			<tr>
				<td colspan="5" style="border: 1px solid black;text-align:left;padding:4px;width:100%;text-align:center;"><b>RESULT SUMMARY</b></td>
			</tr>
			<tr>
				<td colspan="3" style="border: 1px solid black;text-align:left;padding:6px 3px;text-align:center;"><b> LIQUID LIMIT</b></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;text-align:center;"><b>PLASTIC LIMIT</b></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;text-align:center;"><b>PLASTICITY INDEX</b></td>
			</tr>
			<tr>
				<td colspan="3" style="border: 1px solid black;text-align:left;padding:6px 3px;text-align:center;"><b>W<sub>L</sub></b></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;text-align:center;"><b>W<sub>p</sub></b></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;text-align:center;"><b>PI = (W<sub>L</sub> - W<sub>P</sub>)</b></td>
			</tr>
			<tr style="height:20px;">
				<td colspan="3" style="border: 1px solid black;text-align:left;padding:8px px;text-align:center;"><?php echo $row_select_pipe['liquide_limit'];?></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['plastic_limit'];?></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pi_value'];?></td>
			</tr>
			<tr style="height:20px;">
				<td colspan="5" style="border: 0px solid black;text-align:left;padding:4px;width:100%;text-align:center;"></td>
			</tr>
			<tr>
				<td colspan="5" style="border: 0px solid black;text-align:left;padding:4px;width:100%;text-align:left;">Where,<br><br> W<sub>L</sub> = Liquid limit of soil <br><br> W<sub>N</sub> = Moisture Content of soil <br><br> D = Depth of penetration in mm</td>
			</tr>
		</table>
		<br><br><br><br><br><br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;">
			<tr style="">
				<td style="width:25%;padding-top:4px;"><center>Amendment No.: 01</center></td>
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
				<td style="text-align:center;">Page  of </td>
			</tr>
		</table>
        <div class="pagebreak"></div>
			


		<!---------------------- page 20 ---------------------->
		 <table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?> <span style="text-transform:capitalize;"><br> (Specific Gravity , Free Swell Test)</span></b></center>
				</td>
			</tr>
		</table>
		
		<!-- table  39-->			
		 <table align="center" width="100%"  class="test tr" style="">
					
			<tr>
			    <td VALIGN=BOTTOM colspan="8" style="border: 0px solid black;padding:7px 0px;"><b>IS 2720 (Part-3)</b></td>
			</tr>
			<tr>
			    <td  style="border: 1px solid black;text-align:center;width:10%;padding:6px 3px;"><b>Sample ID No.</b></td>
				<td  style="border: 1px solid black;text-align:center;writing-mode: tb-rl;transform: rotate(-180deg);width:6%;padding:6px 3px;"><b>Flask No.</b></td>
				<td  style="border: 1px solid black;text-align:center;writing-mode: tb-rl;transform: rotate(-180deg);width:6%;padding:6px 3px;"><b>Temp. of <br> suspension (T<sup>o</sup>C)</b></td>
				<td  style="border: 1px solid black;text-align:center;width:7%;padding:6px 3px;"><b>Wt. of Flask with stopper +  Water or Kerosene ( W<sub>1</sub> ) in gm</b></td>
				<td  style="border: 1px solid black;text-align:center;width:14%;padding:6px 3px;"><b>Wt. of Flask with stopper  + sample + Water or  Kerosene ( W<sub>2</sub> ) in gm</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Wt. of  Flask with  stopper +  Dry soil in gm</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Wt. of  Flask  with  stopper in gm</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Wt. of  Dry Soil  ( W<sub>s</sub> ) i gm </b></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Specific Gravity</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Mean Specific Gravity</b></td>
			</tr>
			<tr>
				<td rowspan="2" style="border: 1px solid black;padding:4px 3px;text-align:center;">1</td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td rowspan="2"  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
			</tr>
			<tr>
				<td rowspan="2"  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td rowspan="2"  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"><td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
			</tr>
			<tr>
				<td  rowspan="2" style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  rowspan="2" style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
			</tr>
			<tr>
				<td rowspan="2"  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td rowspan="2" style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
			</tr>
			<tr>
			    <td colspan="10" style="border: 0px solid black;padding:7px 0px;">&nbsp; Specific gravity at 27 <sup>o</sup> C = W<sub>s</sub> / ( W<sub>s</sub> +  W<sub>1</sub> - W<sub>2</sub> ) X G<sub>L</sub></td>
			</tr>
			<tr>
			    <td colspan="10" style="border: 0px solid black;padding:7px 0px;">&nbsp; Where, W<sub>s</sub> = Wt. of Dry Soil in gm<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;W<sub>1</sub> = Wt. of Flask with stopper + Water or Kerosene in gm <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;W<sub>2</sub> = Wt. of Flask with stopper + sample +	 Water or Kerosene in gm</td>
			</tr>
		</table>

		<!-- table  40-->	
		<table align="center" width="100%" class="test">
					
			<tr>
			    <td VALIGN=BOTTOM colspan="8" style="border: 0px solid black;padding:7px 0px;font-weight:bold;">IS 2720 (Part-40)</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:5%;padding:4px 3px;"><b>Sr. No.</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:10%;padding:4px 3px;"><b> BH No./Sample No./Identification</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:10%;padding:4px 3px;"><b> Sample ID No.</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:10%;padding:4px 3px;"><b> Date of Starting</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:10%;padding:4px 3px;"><b> Date of Completion</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:10%;padding:4px 3px;"><b> Time in Hours</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:10%;padding:4px 3px;"><b> Initial Volume of sample in Kerosene(X)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:10%;padding:4px 3px;"><b> Final Volume of sample in Distilled water (Y)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:10%;padding:4px 3px;"><b> Swelling Index %</b></td>
			</tr>
			
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">1</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">2</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">3</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">4</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">5</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">6</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">7</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">8</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">9</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">10</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td colspan="9"  style="border: 0px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Swelling Index = <u>(Y - X)</u> x 100<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X
				     <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Where,Y = Final Volume of sample in Distilled water,
					 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X = Initial Volume of sample in Kerosene 
				</td> 
			</tr>
		</table> 
		
		 <table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:20px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
			

		
		<!---------------------- page 21 ---------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?> <span style="text-transform:capitalize;"><br> (Sieve Analysis)</span></b></center>
				</td>
			</tr>
		</table>

		<!-- table  41-->
		 <table align="center" width="100%"  class="test">
					
			<tr>
			    <td VALIGN=BOTTOM colspan="8" style="border: 0px solid black;padding:7px 3px;font-weight:bold;">IS 2720 (Part-4)</td>
			</tr>
			<tr>
				<td rowspan="2" style="border: 1px solid black;text-align:center;padding:7px 3px;width:5%"><b>IS Sieve Designation</b></td>
				<td colspan="3" style="border: 1px solid black;text-align:center;padding:7px 3px;width:11%"><b>Weight Retained</b></td>
				<td rowspan="2" style="border: 1px solid black;text-align:center;padding:7px 3px;width:11%"><b>Soil Passing as % of Soil Taken</b></td>
				<td rowspan="2" style="border: 1px solid black;text-align:center;padding:7px 3px;width:11%"><b>Combined %  Passing as % of Total Soil Taken</b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:7px 3px;"><b>Individual</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:7px 3px;"><b>Cumulative</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:7px 3px;"><b>Cumulative %</b></td>
			</tr>
			<tr>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;">80 mm</td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_1'];?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_1'];?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_1'];?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_1'];?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_1'];?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;">63 mm</td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_2'];?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_2'];?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_2'];?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_2'];?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_2'];?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;">40 mm</td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_3'];?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_3'];?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_3'];?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_3'];?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_3'];?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;">25 mm</td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_4'];?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_4'];?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_4'];?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_4'];?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_4'];?></td>
            </tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">10 mm</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_wt_gm_5'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['ret_wt_gm_5'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_ret_5'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_5'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_5'];?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">6.3 mm</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_wt_gm_6'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['ret_wt_gm_6'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_ret_6'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_6'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_6'];?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">4.75 mm</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_wt_gm_7'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['ret_wt_gm_7'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_ret_7'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_7'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_7'];?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">2.00 mm</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_wt_gm_8'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['ret_wt_gm_8'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_ret_8'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_8'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_8'];?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">600 micron </td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_wt_gm_9'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['ret_wt_gm_9'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_ret_9'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_9'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_9'];?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">425 micron </td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_wt_gm_10'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['ret_wt_gm_10'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_ret_10'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_10'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_10'];?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">212 micron</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_wt_gm_11'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['ret_wt_gm_11'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_ret_11'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_11'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_11'];?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">75 micron</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_wt_gm_12'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['ret_wt_gm_12'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_ret_12'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_12'];?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_12'];?></td>
			</tr>
			<tr>
				<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;font-size: 12px;"><b>TOTAL</b></td>
				<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['blank_extra'];?></td>
				<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['ret_wt_gm_1'] + $row_select_pipe['ret_wt_gm_2'] + $row_select_pipe['ret_wt_gm_3'] + $row_select_pipe['ret_wt_gm_4'] + $row_select_pipe['ret_wt_gm_5'] + $row_select_pipe['ret_wt_gm_6'] + $row_select_pipe['ret_wt_gm_7'] + $row_select_pipe['ret_wt_gm_8'] + $row_select_pipe['ret_wt_gm_9'] + $row_select_pipe['ret_wt_gm_10'] + $row_select_pipe['ret_wt_gm_11'] + $row_select_pipe['ret_wt_gm_12']);?></td>
				<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['cum_ret_1'] + $row_select_pipe['cum_ret_2'] + $row_select_pipe['cum_ret_3'] + $row_select_pipe['cum_ret_4'] + $row_select_pipe['cum_ret_5'] + $row_select_pipe['cum_ret_6'] + $row_select_pipe['cum_ret_7'] + $row_select_pipe['cum_ret_8'] + $row_select_pipe['cum_ret_9'] + $row_select_pipe['cum_ret_10'] + $row_select_pipe['cum_ret_11'] + $row_select_pipe['cum_ret_12']);?></td>
				<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['pass_sample_1'] + $row_select_pipe['pass_sample_2'] + $row_select_pipe['pass_sample_3'] + $row_select_pipe['pass_sample_4'] + $row_select_pipe['pass_sample_5'] + $row_select_pipe['pass_sample_6'] + $row_select_pipe['pass_sample_7'] + $row_select_pipe['pass_sample_8'] + $row_select_pipe['pass_sample_9'] + $row_select_pipe['pass_sample_10'] + $row_select_pipe['pass_sample_11'] + $row_select_pipe['pass_sample_12']);?></td>
				<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['pass_sample_1'] + $row_select_pipe['pass_sample_2'] + $row_select_pipe['pass_sample_3'] + $row_select_pipe['pass_sample_4'] + $row_select_pipe['pass_sample_5'] + $row_select_pipe['pass_sample_6'] + $row_select_pipe['pass_sample_7'] + $row_select_pipe['pass_sample_8'] + $row_select_pipe['pass_sample_9'] + $row_select_pipe['pass_sample_10'] + $row_select_pipe['pass_sample_11'] + $row_select_pipe['pass_sample_12']);?></td>
			</tr>
		</table>
		<br>

		
		<!-- table  42-->
		<table align="left" width="100%"  class="test tr">	
					<td style="width:38%;">
					    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">
								<tr>
									<td style="border: 1px solid black;text-align: center;width:20%;padding:4px 3px;">D<sub> 10</sub> =</td>
									<td style="border: 1px solid black;padding:4px 3px;width:20%"></td>
								</tr>
								<tr>
									<td style="border: 1px solid black;padding:4px 3px;text-align: center">D<sub> 30</sub> =</td>
									<td style="border: 1px solid black;padding:4px 3px;"></td>
								</tr>
								<tr>
									<td style="border: 1px solid black;padding:4px 3px;text-align: center">D<sub> 60</sub> =</td>
									<td style="border: 1px solid black;padding:4px 3px;"></td>
								</tr>
								<tr>
									<td style="border: 1px solid black;padding:4px 3px;">&nbsp;C<sub>u</sub> = D<sub>60</sub> / D<sub>10</sub></td>
									<td style="border: 1px solid black;padding:4px 3px;"></td>
								</tr>
								<tr>
									<td style="border: 1px solid black;padding:4px 3px;">&nbsp;C<sub>c</sub> = ( D<sub>30</sub>) <sup>2</sup> / D<sub>60</sub> X D<sub>10</sub>  </td>
									<td style="border: 1px solid black;padding:4px 3px;"></td>
								</tr>
								<tr>
									<td style="border: 1px solid black;padding:4px 3px;">&nbsp;Liquid Limit</td>
									<td style="border: 1px solid black;padding:4px 3px;text-align:center;"><?php echo $row_select_pipe['liquide_limit'];?></td>
								</tr>
								<tr>
									<td style="border: 1px solid black;padding:4px 3px;">&nbsp;Plasticity Index</td>
									<td style="border: 1px solid black;padding:4px 3px;text-align:center;"><?php echo $row_select_pipe['pi_value'];?> </td>
								</tr>
								<tr>
									<td style="border: 1px solid black;padding:4px 3px;">&nbsp;IS Classification</td>
									<td style="border: 1px solid black;padding:4px 3px;"></td>
								</tr>
					    </table>
					</td>
					<td style="width:2%;">
					    <table align="center" width="100%" class="test1" style="">
							<tr>
								<td style="">&nbsp;</td>
							</tr>
					    </table>
					</td>
					<td style="width:60%;">
					    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" >
											<tr>
									<td colspan="5" style="border: 1px solid black;text-align:center;font-size: 12px;padding:12px 3px;"><b>SUMMARY</b></td>
								</tr>
								<tr>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:20%"><b>Fraction</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:20%"><b>Coarse</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:20%"><b>Medium</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:20%"><b>Fine</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:20%"><b>Total %</b></td>
								</tr>
								<tr>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><b>Gravel</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain1'];?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain4'];?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain7'];?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['grain1'] + $row_select_pipe['grain4'] + $row_select_pipe['grain7']);?></td>
								</tr>
								<tr>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><b>Sand</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain2'];?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain5'];?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain8'];?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['grain2'] + $row_select_pipe['grain5'] + $row_select_pipe['grain8']);?></td>
								</tr>
								<tr>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><b>Silt</b></td>
									<td rowspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain3'];?></td>
									<td rowspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain6'];?></td>
									<td rowspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain9'];?></td>
									<td rowspan="2" style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['grain3'] + $row_select_pipe['grain6'] + $row_select_pipe['grain9']);?></td>
								</tr>
								<tr>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><b>Clay</b></td>
								</tr>
								<tr>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;font-size: 12px;"><b>TOTAL</b></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['grain1'] + $row_select_pipe['grain2'] + $row_select_pipe['grain3']);?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['grain4'] + $row_select_pipe['grain5'] + $row_select_pipe['grain6']);?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['grain7'] + $row_select_pipe['grain8'] + $row_select_pipe['grain9']);?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['grain1'] + $row_select_pipe['grain2'] + $row_select_pipe['grain3'] + $row_select_pipe['grain4'] + $row_select_pipe['grain5'] + $row_select_pipe['grain6'] + $row_select_pipe['grain7'] + $row_select_pipe['grain8'] + $row_select_pipe['grain9']);?></td>
								</tr>
					    </table>
					</td>				
			</tr>
		</table>
		<br><br><br>
		

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:20px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>


		<!---------------------- page 22 ---------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?> <span style="text-transform:capitalize;"><br> (Compaction Test Data Sheet)</span></b></center>
				</td>
			</tr>
		</table>

		<!-- table  43-->
		<table align="center" width="100%" class="test">
			<tr>
			    <td VALIGN=BOTTOM colspan="8" style="border: 0px solid black;padding:7px 0px;font-weight:bold;">IS 2720 (Part 7 & 8)</td>
			</tr>
			<tr>
				<td colspan="8"style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>DENSITY</b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;width:2%"><b>Sr. No.</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;width:20%"><b>Particulars</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;width:5%"><b>1</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;width:5%"><b>2</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;width:5%"><b>3</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;width:5%"><b>4</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;width:5%"><b>5</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;width:5%"><b>6</b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">1</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of Mould + Compacted soil (W) in gm </td>
				<td  style="border: 1px solid black;padding:6px 3px;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">2</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of Mould (W<sub>m</sub>) in gm</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">3</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of compacted soil in gm = (1-2)</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">4</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Water Added in %</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">5</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wet Density (m) in gm/cc</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">6</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Moisture Content (M) in %</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">7</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Dry Density (r<sub>d</sub>) in gm/cc</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td colspan="8" style="border: 0px solid black;text-align:left;padding:20px 3px;"></td>
			</tr>
			<tr>
				<td colspan="8"style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>MOISTURE CONTENT</b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>Sr. No.</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>Particulars</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>1</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>2</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>3</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>4</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>5</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>6</b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">1</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Container No.</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">2</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of container + Wt. of wet soil in gm</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">3</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of container + Wt. of dry soil in gm</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">4</td>
				<td  style="border: 1px solid black;text-align:left;">&nbsp;Wt. of water in gm = (2) -(3)</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">5</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of container in gm</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">6</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of oven dry soil in gm = (3) - (5)</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">7</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Moisture Content (M) in % </td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			
		</table>
		<br><br><br><br><br><br><br><br><br><br><br>

		 <table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:20px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>

        <div class="pagebreak"></div>
				

		
		
		<!---------------------- page 23 ---------------------->
		 <table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?> <span style="text-transform:capitalize;"><br> (Natural Moisture Content (NMC) , Relative Density)</span></b></center>
				</td>
			</tr>
		</table>

		<!-- table  44-->
		<table align="center" width="100%" class="test">
					
					<tr>
						<td VALIGN=BOTTOM colspan="8" style="border: 0px solid black;padding:12px 3px;font-weight:bold">IS 2720 (Part-2)</td>
					</tr>	
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;width:35%;">&nbsp;Sample ID No.</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;BH / Sample No.</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Depth in mt.</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td colspan="6" style="border: 1px solid black;text-align:center;padding:6px 3px;font-size:13px"><b>NATURAL MOISTURE CONTENT (NMC)</b></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp; Container No.</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of container + wet soil (Ww) in gm</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of container + dry soil (W<sub>d</sub>) in gm</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of Moisture in gm W<sub>m</sub>=W<sub>w</sub> - W<sub>d</sub></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of container in gm</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of dry soil (W<sub>ds</sub>) in gm</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Moisture Content (m) in % (W<sub>m</sub>/W<sub>ds</sub>) x 100</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
		</table>
		

		<!-- table  45-->
		<table align="center" width="100%" class="test">
					
			<tr>
			    <td VALIGN=BOTTOM colspan="8" style="border: 0px solid black;padding:7px 3px;font-weight:bold;">IS 2720 (Part-14)</td>
			</tr>
			<tr>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:4px 3px;"><b>&nbsp;(A) Minimum Density</b></td>
				<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;"><b>Volume of Mould : 3000 cc / 15000 cc</b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:10%;">Sr. No.</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:55%;">Description</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:25%;">Result</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:15%;">Unit</td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">1</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of sand (Sample) + Mould</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">gm</td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">2</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of Empty Mould</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">gm</td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">3</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of loose sand in mould</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">gm</td>
			</tr>
			<tr>
			    <td  style="border: 1px solid black;text-align:center;padding:4px 3px;">4</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Wt. of Compacted sand <br> &nbsp;Minimum Density =&nbsp;&nbsp; -------------------------------------	<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Volume of Mould</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">gm / cc</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 0px solid black;text-align:left;padding:4px 3px;"></td>
			</tr>
			<tr>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:4px 3px;width:15%;"><b>&nbsp;(B) mum Density</b></td>
				<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:15%;"><b>Volume of Mould : 3000 cc / 15000 cc</b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">Sr. No.</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">Description</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">Result</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">Unit</td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">1</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of sand (Sample) + Mould after vibration</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">gm</td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">2</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of Empty Mould</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">gm</td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">3</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of compacted sand in mould</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">gm</td>
			</tr>
			<tr>
			    <td  style="border: 1px solid black;text-align:center;padding:4px 3px;">4</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Wt. of Compacted sand <br> &nbsp;Minimum Density =&nbsp;&nbsp; -------------------------------------	<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Volume of Mould</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">gm / cc</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 0px solid black;text-align:left;padding:4px 3px;"></td>
			</tr>
			<tr>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:4px 3px;width:15%;"><b>&nbsp;(C) Dry Density at 70 % R.D.</b> = 0.70 (Max. - Min.) + min.</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:15%;"><b>gm / cc</b></td>
			</tr>
		</table>
		<br>
		
		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:23px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
		


		<!---------------------- page 24 ---------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?> <span style="text-transform:capitalize;"><br> (Determination of Shrinkage Limit)</span></b></center>
				</td>
			</tr>
		</table>
		<br>

		<!-- table  46-->
		 <table align="center" width="100%" class="test">
						
				<tr>
					<td VALIGN=BOTTOM colspan="8" style="border: 0px solid black;padding:7px 0px;font-weight:bold;">IS 2720 (Part-6)</td>
				</tr>
				<tr>
					<td rowspan="3" style="border: 1px solid black;text-align:center;padding:7px 3px;width:1%">Sr.<br>No.</td>
					<td rowspan="3" style="border: 1px solid black;text-align:center;padding:7px 3px;width:35%;"><b>Particulars</b></td>
					<td colspan="2" style="border: 1px solid black;text-align:left;padding:7px 3px;width:1%;">&nbsp;<b> Sample ID No..:</b></td>
					<td colspan="2 "style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp;<b> Sample ID No..:</td>
				</tr>
				<tr>
					<td colspan="2" style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp;<b> Depth:</b></td>
					<td colspan="2" style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp;<b> Depth:</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:10%">1</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;">2</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;">1</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;">2</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">1</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Container No.</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">2</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Wt. of Container in gm</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">3</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Wt. of container + wet soil pat in gm</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">4</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Volume of wet soil pat(V) in ml</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">5</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Wt. of Container + dry soil pat in gm</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">6</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Volume of dry soil pat (V<sub>o</sub>) in ml</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">7</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Wt. of Oven dry soil pat (W<sub>o</sub>) in gm</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">8</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Wt. of Water in soil in gm</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">9</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Moisture Content of soil pat (W<sub>1</sub>) in % [(8/7) x 100]</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">10</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Shrinkage Limit (W<sub>s</sub>) in %</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">11</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Volumetric Shirnkage Limit (V<sub>s</sub>) in %</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">12</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Shrinkage ratio (R) in %</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">13</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Linear Shrinkage Limit (L<sub>s</sub>) in %</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">14</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Avg. Shrinkage Limit (W<sub>s</sub>) in %</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td colspan="6" style="text-align:left;padding:7px 0;width:9%;font-size: 14px;"></td>
				</tr>
				<tr>
					<td colspan="6" style="text-align:left;padding:4px 0;width:9%;font-size: 14px;">&nbsp;&#9632;&nbsp;&nbsp; Shrinkage Limit (W<sub>s</sub>) = M.C. - [ Vol. of Wet Pet - Vol. of Dry Pet / Wt. of Dry Pet ] x 100</td>
				</tr>
				<tr>
					<td colspan="6" style="text-align:left;padding:4px 0;width:9%;font-size: 14px;">&nbsp;&#9632;&nbsp;&nbsp; Shrinkage Ratio (R) = W<sub>0</sub> / V<sub>0</sub></td>

				</tr>
				<tr>
					<td colspan="6" style="text-align:left;padding:4px 0;width:9%;font-size: 14px;">&nbsp;&#9632;&nbsp;&nbsp; Volumetric Shrinkage (V<sub>s</sub>) = (W)<sub>1</sub> - W<sub>s</sub> X R</td>
				</tr>
		</table>
		<br><br><br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:23px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
		
		
		<!---------------------- page 24 ---------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?> <span style="text-transform:capitalize;"><br> (Swell Pressure Test)</span></b></center>
				</td>
			</tr>
		</table>

		<!-- table  47-->
		<table align="center" width="100%" class="test">
				<tr>
					<td VALIGN=BOTTOM colspan="3" style="border: 0px solid black;padding:7px 0px;font-weighr:bold;"><b>IS 2720 (Part-41)</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;font-size:13px;"><b>Description</b></td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;width:40%;">&nbsp;Wt. of ring + wet specimen = wl(g)</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;width:40%;">&nbsp;Wt. of ring = Wr (g)</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;width:40%;">&nbsp;Diameter of ring D (cm)</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;width:40%;">&nbsp;Wt. of Wet specimen W=Wl-Wr(g)</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;width:40%;">&nbsp;Initial thickness of wet Specimen H (cm)</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;width:40%;">&nbsp;Volume of Specimen V=(&#960;D<sup>2</sup> H) /4 (cc)</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;width:40%;">&nbsp;Wet Density Yw =W/V (g/cc)</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;width:40%;">&nbsp;Dry Density Y<sub>D</sub> (g/cc)</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td colspan="3" style="border: 0px solid black;text-align:center;padding:4px 3px;"><b></b></td>
				</tr>
				<tr>
					<td colspan="3" style="border: 1px solid black;text-align:center;padding:4px 3px;font-size: 14px;"><b>MOISTURE CONTENT</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"><b>Description</b></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;width:25%;"><b>Before Test</b></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;width:25%;"><b>After Test</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Container No</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of Container + Wet Soil Wl (g)</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of Container + Dry Soil W2 (g)</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of Water W<sub>W</sub> = W1 - W2 (g)</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of Container = Wc (g)</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of Dry Soil Wd = W2-Wc,g</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Water Content(%) = (W<sub>W</sub> / Wd) * 100</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
				</tr>	
		</table>
		<br>

		<!-- table  48-->
		<table align="center" width="100%" class="test">
				<tr>
					<td colspan="3" style="border: 1px solid black;text-align:center;padding:4px 3px;font-size: 14px;"><b>Swell Compression Test</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;width:30%;">Pressure increment (kgf/cm<sup>2</sup>)</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">Compression</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">Change in Thickness of Expanded Specimen</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">0.00-0.05</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">0.05-0.10</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">0.10-0.25</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">0.25-0.50</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">0.50-1.00</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">1.00-2.00</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">2.00-4.00</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">4.00-8.00</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">8.00-16.00</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td colspan="3" style="border: 0px solid black;text-align:left;padding:4px 3px;">&nbsp;NOTE: Change in thickness of expanded specimen =</td>
				</tr>
				<tr>
					<td colspan="3" style="border: 0px solid black;text-align:left;padding:4px 3px;">&nbsp;(Final Reading during compression - Initial Swelling Dial Reading) * Least Count</td>
				</tr>
		</table>
	
		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:23px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>


		<!---------------------- page 25 ---------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?> <span style="text-transform:capitalize;"><br> (Swell Pressure Test)</span></b></center>
				</td>
			</tr>
		</table>
		<br>

		<!-- table  49-->
		<table align="center" width="100%" class="test">
				<tr>
					<td colspan="3" style="border: 1px solid black;text-align:center;padding:6px 3px;font-size: 14px;"><b>Swelling Testing Readings</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:40%;">Elapsed Time in Hours</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;width:60%;">Swelling Dial Reading (Divn.)</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">0</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">0.5</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">1</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">2</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">4</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">8</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">12</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">16</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">20</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">24</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">36</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">48</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">60</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">96</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">120</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">144</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
        </table>
		<br><br><br><br><br><br><br><br><br><br><br><br><br>


		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:23px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>

		
		<!---------------------- page 26 ---------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?> <span style="text-transform:capitalize;"><br> (FDD , FMC)</span></b></center>
				</td>
			</tr>
		</table>
		<br>

		<!-- table  50-->
		<table align="center" width="100%" class="test">
					
			<tr>
			    <td colspan="9" style="border: 0px solid black;padding:7px 0px;font-weight:bold;">IS 2720 (Part 29)</td>
			</tr>
			<tr>
				<td colspan="5" style="border: 1px solid black;text-align:left;font-size:14px;padding:7px 3px;"><b>&nbsp;DS No.:-</b></td>
				<td colspan="4" style="border: 1px solid black;text-align:left;font-size:14px;padding:7px 3px;"><b>&nbsp;Test Condition :-</b></td>
			</tr>
			<tr>
				<td colspan="9" style="border: 1px solid black;text-align:center;font-size:14px;padding:7px 3px;"><b>Field Dry Density</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>Sr. No.</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>Km. No./Sample No</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>Volume (cc)</b></td>
				<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>Wt. of Cutter/Shellby tube-Wet Soil (W<sub>s</sub>)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>Wt. of Cutter/Shellby tube(Wc)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>Wt. of Wet Soil (W<sub>s</sub> - W<sub>c</sub>)</b></td>
				<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>Wet Density (Dw) gm/cc</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;">1</td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;">2</td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;">3</td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;">4</td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;">5</td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			<tr>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;">6</td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
				<td colspan="9" style="border: 1px solid black;text-align:center;font-size:13px;padding:6px 3px;"><b>Field Moisture Content</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:7%;padding:6px 3px;"><b>Sr. No</b></td>
				<td style="border: 1px solid black;text-align:center;width:11%;padding:6px 3px;"><b>Container No.</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Wt. of Wet Soil + Container (g)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Wt. of Dry Soil + Container (g)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Wt. of Container(g)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Wt. of Moisture(g)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Wt. of Dry Soil(g)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Moisture Content m(%)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Dry Density Ds = 100 x Dw / 100 + m(gm / cc)</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
		</table>
		<br><br><br><br><br><br><br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:23px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
		<div class="pagebreak"></div>

		
		<!---------------------- page 27 ---------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
            <tr>
                <td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
                <td colspan="2" style="font-size:14px;border: 1px solid black;">
                    <center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
                </td>
            </tr>
            <tr>
                <td style="font-size:11px;border: 1px solid black;">
                    <center><b>FMT-OBS-10</b></center>
                </td>
                <td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
                    <center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample; ?> <br> HYDROMETER ANALYSIS </b><span style="font-size:13px;text-transform: none;">(On Material passing 75 micron IS Sieve)</span></center>
                </td>
            </tr>
        </table>
        <br>

		<!-- table  51-->
        <?php $cnt = 1; ?>
        <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
            <tr>
                <td>
                    <table width="100%" class="test1" style="border: 0;font-family: Arial;margin-bottom: 0;" height="Auto">
                        <tr>
                            <td style="padding:7px 0;font-size: 13px;"><b>IS 2720 Part-4</b></td>
                        </tr>
                    </table>


                    <table align="center" width="100%" class="test1" height="9%">
                        <tr style="border: 1px solid black;">
                            <td style="width:100px;border-left:1px solid;text-align:left;padding:6px 3px;">Weight of Oven Dry Soil pretreated (W<sub>b</sub>)</td>
                            <td style="width:0px;border-left:1px solid;text-align:left;padding:6px 3px;">25/50 gms</td>
                            <td style="width:0px;border-left:1px solid;text-align:left;padding:6px 3px;">Meniscus Correction (Cm)</td>
                            <td style="width:0px;border-left:1px solid;text-align:left;padding:6px 3px;">0.5</td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:6px 3px;">R<sub>h</sub>-Observed Hydrometer reading at Temp T</td>
                            <td style="border-left:1px solid;text-align:center;padding:6px 3px;">°C</td>
                            <td style="border-left:1px solid;text-align:left;padding:6px 3px;">Temp. Correction (M<sub>1</sub>)</td>
                            <td style="border-left:1px solid;text-align:center;padding:6px 3px;"></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:6px 3px;">W = <span style=" padding-bottom: 5px;"> <u>100 G<sub>s</sub>(R<sub>h</sub>+ M<sub>1</sub>-X)</u></span> <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; W<sub>b</sub> (G<sub>s</sub>-G<sub>w</sub>)</td>

                            <td style="border-left:1px solid;text-align:center;padding:6px 3px;">%</td>
                            <td style="border-left:1px solid;text-align:left;padding:6px 3px;">Dispersing Agent</td>
                            <td style="border-left:1px solid;text-align:left;padding:6px 3px;">Sodium Hexa-Meta Phosphate + Sodium Carbonate
                            </td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:6px 3px;">Specific Gravity of Soil Particles (G<sub>s</sub>)</td>
                            <td style="border-left:1px solid;text-align:center;padding:6px 3px;"></td>
                            <td style="border-left:1px solid;text-align:left;padding:6px 3px;">Dispersing Agent Correction (X)</td>
                            <td style="border-left:1px solid;text-align:left;padding:6px 3px;"></td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
        <br>

		<!-- table  52-->
        <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
            <tr>
                <td>
                    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">

                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Temp<br>'C'</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Clock<br>Time</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Elapsed Time<br>(t)</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Hydrometer Reading<br>(R' <sub>h</sub>)</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">RH =<br>R'<sub>h</sub>+C'<sub>m</sub><br>(Decimals Only)</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Height of Fall<br>(HR) cms</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Eq. DS<br>(D) mm</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">R<sub>h</sub> + M<sub>1</sub> - X</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Percentage<br>Finer (W)</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Combined % age finer than D as % age of Total Soil</td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">30 Sec</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">1 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">2 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">4 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">8 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">15 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">30 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">60 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">120 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">240 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">24 hrs</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br> <br><br><br>

        <table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:15px;">
            <tr style="">
                <td style="width:25%;padding-top:5px;">
                    <center>Amendment No.: 01</center>
                </td>
                <td style="width:25%;padding-top:5px;">
                    <center>Amendment Date: 01.04.2023</center>
                </td>
                <td style="width:16.67%;padding-top:5px;">
                    <center>Prepared by:</center>
                </td>
                <td style="width:16.67%;padding-top:5px;">
                    <center>Approved by:</center>
                </td>
                <td style="width:16.67%;padding-top:5px;">
                    <center>Issued by:</center>
                </td>
            </tr>
            <tr>
                <td style="">
                    <center>Issue No.: 03</center>
                </td>
                <td style="">
                    <center>Issue Date: 01.01.2021 </center>
                </td>
                <td style="">
                    <center>Nodal QM</center>
                </td>
                <td style="">
                    <center>Director</center>
                </td>
                <td style="">
                    <center>Nodal QM</center>
                </td>
            </tr>
            <tr style="font-size:13px;">
                <td style="text-align:center;">Page of </td>
            </tr>

        </table>
        <div class="pagebreak"></div>
	

		<!---------------------- page 28 ---------------------->
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
            <tr>
                <td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
                <td colspan="2" style="font-size:14px;border: 1px solid black;">
                    <center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
                </td>
            </tr>
            <tr>
                <td style="font-size:11px;border: 1px solid black;">
                    <center><b>FMT-OBS-10</b></center>
                </td>
                <td style="font-size:13px;border: 1px solid black;text-transform:uppercase;">
                    <center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample; ?> - HYDROMETER ANALYSIS </b><span style="font-size:13px;text-transform: none;">(On Material passing 75 micron IS Sieve)</span></center>
                </td>
            </tr>
        </table>
        <br>

		<!-- table  53-->
        <?php $cnt = 1; ?>
        <br>
        <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
            <tr>
                <td>
                    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;">


                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;" rowspan="2">IS Sieve Designation</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;" colspan="3">Weight Retained</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;" rowspan="2">Soil Passing as % of Soil Taken</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;" rowspan="2">Combined % Passing as % of Total Soil Taken</td>

                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Individual</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Cumulative</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Cumulative %</td>
                        </tr>


                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">25 mm</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_13'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_13'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_13'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_13'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_13'];?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">10 mm</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_14'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_14'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_14'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_14'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_14'];?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">6.3 mm</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_15'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_15'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_15'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_15'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_15'];?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">4.75 mm</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_16'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_16'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_16'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_16'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_16'];?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">2.00 mm</td>
                           <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_17'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_17'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_17'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_17'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_17'];?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">600 mic</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_18'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_18'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_18'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_18'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_18'];?></td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">425 mic</td>
                           <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_19'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_19'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_19'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_19'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_19'];?></td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">212 mic</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_20'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_20'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_20'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_20'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_20'];?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">75 mic</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_21'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_21'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_21'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_21'];?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_21'];?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><b>TOTAL</b></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['blank_extra_1'];?></td>
                            <td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['ret_wt_gm_13'] + $row_select_pipe['ret_wt_gm_14'] + $row_select_pipe['ret_wt_gm_15'] + $row_select_pipe['ret_wt_gm_16'] + $row_select_pipe['ret_wt_gm_17'] + $row_select_pipe['ret_wt_gm_18'] + $row_select_pipe['ret_wt_gm_19'] + $row_select_pipe['ret_wt_gm_20'] + $row_select_pipe['ret_wt_gm_21']);?></td>
							<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['cum_ret_13'] + $row_select_pipe['cum_ret_14'] + $row_select_pipe['cum_ret_15'] + $row_select_pipe['cum_ret_16'] + $row_select_pipe['cum_ret_17'] + $row_select_pipe['cum_ret_18'] + $row_select_pipe['cum_ret_19'] + $row_select_pipe['cum_ret_20'] + $row_select_pipe['cum_ret_21']);?></td>
							<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['pass_sample_13'] + $row_select_pipe['pass_sample_14'] + $row_select_pipe['pass_sample_15'] + $row_select_pipe['pass_sample_16'] + $row_select_pipe['pass_sample_17'] + $row_select_pipe['pass_sample_18'] + $row_select_pipe['pass_sample_19'] + $row_select_pipe['pass_sample_20'] + $row_select_pipe['pass_sample_21']);?></td>
							<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['pass_sample_13'] + $row_select_pipe['pass_sample_14'] + $row_select_pipe['pass_sample_15'] + $row_select_pipe['pass_sample_16'] + $row_select_pipe['pass_sample_17'] + $row_select_pipe['pass_sample_18'] + $row_select_pipe['pass_sample_19'] + $row_select_pipe['pass_sample_20'] + $row_select_pipe['pass_sample_21']);?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br><br>
       
		<!-- table  54-->
        <table cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">

            <tr>
                <td style="">
                    <table class="test1" style="border: 1px solid black;font-family: Arial;">


                        <tr>
                            <td style="width: 220px;border: 1px solid black;padding: 6px 3px;text-align: center">
                                D <sub>10</sub> =
                            </td>
                            <td style="width: 220px;border: 1px solid black;padding: 6px 3px;text-align: center">
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;padding: 6px 3px;text-align: center">
                                D <sub>30</sub> =
                            </td>
                            <td style="border: 1px solid black;padding: 6px 3px;text-align: center">
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;padding: 6px 3px;text-align: center">
                                D <sub>60</sub> =
                            </td>
                            <td style="border: 1px solid black;padding: 6px 3px;text-align: center">
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left">
                                C<sub>u</sub> = D<sub>60</sub>/ D<sub>10</sub>
                            </td>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left">
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left">
                                C<sub>c</sub> = (D<sub>30</sub>)<sub>2</sub> / D<sub>60</sub> X D<sub>10</sub>
                            </td>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left">
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left">
                                Liquid Limit
                            </td>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left"><?php echo $row_select_pipe['liquide_limit'];?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left">
                                Plasticity Index
                            </td>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left"><?php echo $row_select_pipe['pi_value'];?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left">
                                IS Classification
                            </td>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left"></td>
                        </tr>
                    </table>
                </td>

                <td style="width:4%;">
                </td>

                <td style="">
                    <table class="test1" style="font-family: Arial;margin-bottom: 40px;">
                        <tr>
                            <td style="border: 1px solid black;padding: 6px 3px;text-align:center;" colspan=5>
                                <b>SUMMARY</b>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 90px;border: 1px solid black;padding: 6px 10px;text-align: center">Fraction</td>
                            <td style="width: 90px;border: 1px solid black;padding: 6px 10px;text-align: center">Coarse</td>
                            <td style="width: 90px;border: 1px solid black;padding: 6px 10px;text-align: center">Medium</td>
                            <td style="width: 90px;border: 1px solid black;padding: 6px 10px;text-align: center">Fine</td>
                            <td style="width: 90px;border: 1px solid black;padding: 6px 10px;text-align: center">Total %</td>
                        </tr>
                        <tr>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><b>Gravel</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g1'];?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g5'];?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g9'];?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['g1'] + $row_select_pipe['g5'] + $row_select_pipe['g9']);?></td>
								</tr>
								<tr>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><b>Sand</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g2'];?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g6'];?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g10'];?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['g2'] + $row_select_pipe['g6'] + $row_select_pipe['g10']);?></td>
								</tr>
								<tr>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><b>Silt</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g3'];?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g7'];?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g11'];?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['g3'] + $row_select_pipe['g7'] + $row_select_pipe['g11']);?></td>
								</tr>
								<tr>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><b>Clay</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g4'];?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g8'];?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g12'];?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['g4'] + $row_select_pipe['g8'] + $row_select_pipe['g12']);?></td>
								</tr>
								<tr>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;font-size: 12px;"><b>TOTAL</b></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['g1'] + $row_select_pipe['g2'] + $row_select_pipe['g3'] + $row_select_pipe['g4']);?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['g5'] + $row_select_pipe['g6'] + $row_select_pipe['g7'] + $row_select_pipe['g8']);?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['g9'] + $row_select_pipe['g10'] + $row_select_pipe['g11'] + $row_select_pipe['g12']);?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['g1'] + $row_select_pipe['g2'] + $row_select_pipe['g3'] + $row_select_pipe['g4'] + $row_select_pipe['g5'] + $row_select_pipe['g6'] + $row_select_pipe['g7'] + $row_select_pipe['g8'] + $row_select_pipe['g9'] + $row_select_pipe['g10'] + $row_select_pipe['g11'] + $row_select_pipe['g12']);?></td>
								</tr>
                      
                    </table>
                </td>
            </tr>
        </table>
        <br><br><br><br>
       
        <table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:15px;">
            <tr style="">
                <td style="width:25%;padding-top:5px;">
                    <center>Amendment No.: 01</center>
                </td>
                <td style="width:25%;padding-top:5px;">
                    <center>Amendment Date: 01.04.2023</center>
                </td>
                <td style="width:16.67%;padding-top:5px;">
                    <center>Prepared by:</center>
                </td>
                <td style="width:16.67%;padding-top:5px;">
                    <center>Approved by:</center>
                </td>
                <td style="width:16.67%;padding-top:5px;">
                    <center>Issued by:</center>
                </td>
            </tr>
            <tr>
                <td style="">
                    <center>Issue No.: 03</center>
                </td>
                <td style="">
                    <center>Issue Date: 01.01.2021 </center>
                </td>
                <td style="">
                    <center>Nodal QM</center>
                </td>
                <td style="">
                    <center>Director</center>
                </td>
                <td style="">
                    <center>Nodal QM</center>
                </td>
            </tr>
            <tr style="font-size:13px;">
                <td style="text-align:center;">Page of </td>
            </tr>

        </table>

	</page>
</body>

</html>


<!-- <script type="text/javascript">
	window.onload = function() {
		setTimeout(function() {

				window.print();
			},
			1000);

	}
</script> -->



