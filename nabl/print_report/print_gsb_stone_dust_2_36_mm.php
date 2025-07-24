<?php
session_start();
include("../connection.php");
include("function_calling.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0 40px;
	}

	.pagebreak {
		page-break-before: always;
	}

	page[size="A4"] {
		width: 21cm;
		height: 29.7cm;

	}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 12px;
		font-family : Calibri;

	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family : Calibri;
	}

	.tdclass1 {

		font-size: 12px;
		font-family : Calibri;
	}

	div.vertical-sentence {
		-ms-writing-mode: tb-rl;
		/* for IE */
		-webkit-writing-mode: vertical-rl;
		/* for Webkit */
		writing-mode: vertical-rl;

	}

	.rotate-characters-back-to-horizontal {
		-webkit-text-orientation: upright;
		/* for Webkit */
		text-orientation: upright;
	}
</style>

<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from gsb_stone_dust WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];

	$client_address = $row_select['clientaddress'];
	$r_name = $row_select['refno'];
	$agreement_no = $row_select['agreement_no'];

	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	
	$authorize_by = $row_select['reported_by_authorize'];
	$verify_by = $row_select['reported_by_review'];

$user_name = "select * from `multi_login` WHERE `id`='$authorize_by'";
	$result_for_select = mysqli_query($conn, $user_name);
	$user = mysqli_fetch_array($result_for_select);
	
	$a_name = $user['staff_fullname'];
	
	$verify_name = "select * from `multi_login` WHERE `id`='$verify_by'";
	$result_for_verify_select = mysqli_query($conn, $verify_name);
	$user_1 = mysqli_fetch_array($result_for_verify_select);	

	$v_name = $user_1['staff_fullname'];
	
	if ($cons == 0) {
		$con_sample = "Sealed";
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


	if ($row_select["agency_name"] != "") {
		$agency_name = $row_select['agency_name'];
	}

	$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `isdeleted`='0'";
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
			include_once 'sample_id.php';
			if (
				strpos($row_select3["mt_name"], "WMM (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "GSB - I MIX (M4-1)") !== false ||
				strpos($row_select3["mt_name"], "GSB - II MIX (M4-2)") !== false ||
				strpos($row_select3["mt_name"], "GSB - III MIX (M4-1)") !== false ||
				strpos($row_select3["mt_name"], "GSB - IV MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - V MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - VI MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - I MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - III MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - II MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - I MIX (M4-2)") !== false ||
				strpos($row_select3["mt_name"], "GSB - II MIX (M4-1)") !== false ||
				strpos($row_select3["mt_name"], "GSB - III MIX (M4-2)") !== false ||
				strpos($row_select3["mt_name"], "MSS - A (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "MSS - B (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BUSG - CA") !== false ||
				strpos($row_select3["mt_name"], "BUSG - KA") !== false ||
				strpos($row_select3["mt_name"], "BM - 2 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BM - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BC - 2 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BC - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "DBM - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "DBM - 2 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "SDBC - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "Seal Coat") !== false ||
				strpos($row_select3["mt_name"], "Premix Carpet") !== false ||
				strpos($row_select3["mt_name"], "BUSG - KA") !== false ||
				strpos($row_select3["mt_name"], "BUSG - CA") !== false ||
				strpos($row_select3["mt_name"], "SDBC - 2 (MIX MATERIAL)") !== false
			) {
				$mt_name = $row_select3['mt_name'];
			} else {
				$ans = substr($row_select3["mt_name"], strpos($row_select3["mt_name"], "(") + 1);
				$explodeing = explode(")", $ans);
				$mt_name = $explodeing[0];
			}
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
	}


	?>

<page size="A4">
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
 <?php if($_SESSION['isadmin']!=4){ ?>
       <table align="center" width="95%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
		<tr>
			<td>
				<table  style="width: 100%;font-family: 'Calibri';font-size:12px;border: 1px solid;border-bottom:0px solid;text-align: left;" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;font-weight: bold;width: 25%;">ULR No.</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;width: 25%;"><?php if(strlen($_GET['ulr'])>15){echo $_GET['ulr'];}?></td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;font-weight: bold;width: 25%;">Test Report No.</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;width: 25%;"><?php echo $report_no; ?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Report Issue</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($issue_date));?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Sample Received</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Sample Name</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo $mt;?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Unique Identity of Sample</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php echo $lab_no;?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Letter</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php  if ($row_select['date'] != "" && $row_select['date'] != null && $row_select['date'] != "0") { echo date('d/m/Y', strtotime($row_select["date"])); } else {echo "---NIL---";}?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Letter No.</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php  if ($r_name != "" && $r_name != null && $r_name != "0") { echo $r_name; } else {echo "---NIL---";}?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Test Start</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($start_date));?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Test Complete</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($end_date));?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Sampling Quantity</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">20 Kg</td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Source of Sample *</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php if ($source != "" && $source != null && $source != "0") { echo $source; } else {echo "-";}?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Name of Client</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo $clientname;?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Nominal Size of Aggregate</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php echo $mt;?> </td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Agency/Name & Address </td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;" colspan="3"><?php echo $clientname;?>,<?php echo $client_address;?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;;">Name of Work</td>
            <td style="padding: 2px 5px;;border-bottom: 1px solid;" colspan="3"><?php echo $name_of_work;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Discipline/Group</td>
            <td style="padding: 2px 5px;border-bottom: 1px solid;" colspan="3">Mechanical- Buildings Materials</td>
		</tr>
	  </table>
				
				   <?php } ?>


		

			<!--START-->
			<tr>
			    <td>
                    <table align="left" width="100%" border="0px" cellspacing="0" cellpadding="0" class="test" style="font-family : Calibri; border-right:2px solid black; border-left:2px solid black;">

					<?php
                                        if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != "0") {
                                        ?>
                                      
                        <tr>
                             <td colspan="2" style="font-weight:bold;font-size:11px;">A) Sieves Analysis :</td>
                        </tr>

                        <tr style="display:flex; ">
                            <td colspan="2" style="width:100%;vertical-align:top">
							<table align="top" width="100%" class="test" style="max-width:300px;font-size:11px;font-family : Calibri;">
								    <tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 0px solid black;font-weight:bold;padding:7px 4px;" colspan="3"><b>Particle Size Distribution Test</b></td>
									</tr>
									<tr>
										<td colspan="3" style="font-size:11px;text-align:center;border:1px solid black;border-left: 0px solid black;font-weight:bold;padding:7px 4px;"><b>IS 2386 Part-1</b></td>
										<!-- <td colspan="3" style="text-align:center;border:1px solid black;border-left:1px solid black;"><b>IS 2386-1963 : P-1</b></td> -->
									</tr>

									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>IS Sieve Size</b></td>
										    <td style="border-right:1px solid black;width:50%;">
												<table style="width:100%;border-collapse: collapse;">
													<tr>
														<td style="font-size:11px;text-align:center;border-bottom:0px solid black;font-weight:bold;padding:5px 4px;">Test Results</td>
													</tr>
													<tr style="">
														<td style="font-size:11px;text-align:center;font-weight:bold;border-top:1px solid black;padding:5px 4px;">% of Passing</td>
													</tr>
												</table>
											</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>% of Retained</b></td>
									</tr>
									
									<tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:5px 0;">9.5 mm</td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;"><?php echo $row_select_pipe['pass_sample_1']; ?></td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;"><?php echo $row_select_pipe['cum_ret_1']; ?></td>
									</tr>
									<tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:5px 0;">4.75 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_2']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['cum_ret_2']; ?></td>
									</tr>
									<tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:5px 0;">2.36 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_3']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['cum_ret_3']; ?></td>
									</tr>
									<tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:5px 0;">0.425 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_4']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['cum_ret_4']; ?></td>
									</tr>
									<tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:5px 0;">0.075 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_5']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['cum_ret_5']; ?></td>
									</tr>
								</table>
										</td>

                           
                        </tr>
						<?php
                                      }
                                        ?>
                                      
                        <tr>  
                          <?php
                            if (($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0") || ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0") || ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0") || ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0") || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0") || ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0") || ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0") || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") || ($row_select_pipe['cbr'] != "" && $row_select_pipe['cbr'] != "0") || ($row_select_pipe['mdd'] != "" && $row_select_pipe['mdd'] != "0") || ($row_select_pipe['omc'] != "" && $row_select_pipe['omc'] != "0")) {

                            ?>
                                <td colspan="3" style="padding-bottom:4px;font-weight:bold;font-size:11px;padding-top:4px;">B) Other Test :</td>
								<?php } else { ?>
							    <td colspan="3" style="padding-bottom:4px;font-weight:bold;font-size:11px;"><b>&nbsp;</b></td>
                            <?php
                            }
                            ?>
                        </tr>

                        <tr>
                          <td colspan="3" style="width:49%;vertical-align:top">
                                <table align="top" width="100%" class="test" style="height:100%;width:100%;">
                                    <?php
                                    if (($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0") || ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0") || ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0") || ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0") || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0") || ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0") || ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0") || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") || ($row_select_pipe['cbr'] != "" && $row_select_pipe['cbr'] != "0") || ($row_select_pipe['mdd'] != "" && $row_select_pipe['mdd'] != "0") || ($row_select_pipe['omc'] != "" && $row_select_pipe['omc'] != "0")) {

                                    ?>
                                       <tr>
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 0px solid black;font-weight:bold;padding:5px 4px;">Name Of Test</td>
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;">Test Method</td>
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;">Test Results</td>
												<!-- <td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;">Req. as per Morth</td> -->
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;border-right: 0px solid black;font-weight:bold;padding:5px 4px;width:25%;">Acceptance Critaria as per MoRTH</td>
											</tr>

                                        <?php
                                        if ($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Flakiness + Elongation %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-1</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['combined_index']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;border-right: 0px solid black;padding:2px 4px;">Max. 35%</td>
                                            </tr>
                                            

                                        <?php
                                        }
                                        if ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Impact Value %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-4</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['imp_value']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;border-right: 0px solid black;padding:2px 4px;">Max. 24%</td>
                                            </tr>

									<?php
                                        }
                                        if ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Crushing Value %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-4</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['cru_value']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;border-right: 0px solid black;padding:2px 4px;">Max. 30%</td>
                                            </tr>

									<?php
                                        }
                                        if ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">LA Abrasion Value %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-4</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['abr_index']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;border-right: 0px solid black;padding:2px 4px;">Max. 30%</td>
                                            </tr>


                                        <?php
                                        }
                                        if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Specific Gravity</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-3</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['sp_specific_gravity']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;border-right: 0px solid black;padding:2px 4px;">--</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Water Absorption %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-3</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['sp_water_abr']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;border-right: 0px solid black;padding:2px 4px;">Max. 2%</td>
                                            </tr>
                                       

                                        
                                        <?php
                                        }
                                        if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Bulk Density kg/Lit.</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-3</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['bdl']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>


                                        <?php
                                        }
                                        if ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">10% Fine Value KN</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-4</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['fines_value']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>

                                        <?php
                                        }
                                        if ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Liquid Limit (LL)</td>
                                                <td rowspan="3" style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2720 Part-5</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['liquide_limit']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Max 25%</td>
                                            </tr>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Plastic Limit (PL)</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['plastic_limit']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Plasticity Index (PI)</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['pi_value']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">&lt; 6%</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px; border-bottom:0px;">Soundness Na<sub>2</sub>SO<sub>4</sub> %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;border-bottom:0px;">IS 2386 Part-5</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;border-bottom:0px;"><?php echo $row_select_pipe['soundness']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;border-bottom:0px;border-right: 0px solid black;">Max. 12%</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['mdd'] != "" && $row_select_pipe['mdd'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">MDD (g/cc)</td>
                                                <td rowspan="2" style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2720 Part-8</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['mdd']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['omc'] != "" && $row_select_pipe['omc'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">OMC %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['omc']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>
                                        <?php
										}
										 if ($row_select_pipe['alk_10'] != "" && $row_select_pipe['alk_10'] != "0") {
											?>
	
												<tr>
													<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Alkali Reactivity Test (Gravimetric Method)</td>
													<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386-7</td>
													<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['alk_10']; ?></td>
													<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--`</td>
													</tr>
	
                                       <?php }
                                        if ($row_select_pipe['cbr'] != "" && $row_select_pipe['cbr'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">California Bearing Ratio %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2720 Part-16</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['cbr']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Min. 30</td>
                                            </tr>
											
											
                                    <?php
										
                                        }
                                    }

                                    ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>

				
			</tr>
		</table>

		
		</table>
	<br>
	<table  style="width: 95%;font-family:Calibri;font-size:15px;border: 1px solid;border-top:0px solid;" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td style="padding: 0 10px;border-top:1px solid;" colspan="5"><i><b> Remarks: - </b>The Sample Confirms to IS: 383 :2016 w.r.t above test only </i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;" colspan="5"><i><b>&#8226;</b>&nbsp;&nbsp;&nbsp;&nbsp;* Indicates information provided by the customer.</i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;" colspan="5"><i><b>&#8226;</b>&nbsp;&nbsp;&nbsp;&nbsp;The test results given above pertain to the sample as received.</i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;text-align: center;border-top: 1px solid;" colspan="6"><i><b>***End of Report***<br>(Jai Hind)</b></i></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-right: 1px solid;height: 100px;text-align: center;vertical-align: bottom;" colspan="3"><i><b>Reviewed By<br><u><?php echo $v_name; ?> </u></b></i></td>
                <td style="border-top: 1px solid;height: 100px;text-align: center;vertical-align: bottom;" colspan="3"><i><b>Authorized By<br></b><u><?php echo $a_name; ?> </u></i></td>
            </tr>
        </table>
			</td>
		</tr>
		</table>
			</td>
		</tr>
		</table>


	</page>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>