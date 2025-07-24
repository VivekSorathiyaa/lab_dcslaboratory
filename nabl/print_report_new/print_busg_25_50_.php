<?php
session_start();
include("../connection.php");
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
		font-family: Arial;

	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family: Arial;
	}

	.tdclass1 {

		font-size: 12px;
		font-family: Arial;
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
	$select_tiles_query = "select * from busg_25_50_mm WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	}


	?>


	<page size="A4">
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family:Cambria;margin-top:80px;border-bottom:0px solid black;">
		    <tr>
		  		<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
			</tr>
			<tr>
				<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Properties of Aggregate</b></td>
			</tr>


			<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">Mechanical-Buildings Material</td>
						<td style="width:21%;padding-bottom: 4px;"> 
						<?php if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null) {
																echo "ULR No.  " . $row_select_pipe['ulr'];  
															} ?>
						</td>
					</tr>

					<tr style="">
						<td style="width:6%;padding-bottom: 4px;">Sample ID No.</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $sample_id_no;?></td>
						<td style="width:0%;padding-bottom: 4px;;text-align:left;"> Date of Report</td>
						<td style="width:6%;padding-bottom: 4px;text-align:center;"> &raquo;</td>
						<td style="width:40%padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
					</tr>
					<tr style="">
						<td style="width:6%;padding-bottom: 6px;">Report Ref No</td>
						<td style="width:6%;padding-bottom: 6px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 6px;"><?php echo $report_no; ?></td>
					</tr>
				</table>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">

						<?php
						if ($clientname != "") {
						?>
							<tr>
							    <td style="width:12%;padding-bottom: 4px;padding-top: 14px;">Customer</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;padding-top: 14px;"> &raquo;</td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;padding-top: 14px;"><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																														$result_selectc = mysqli_query($conn, $select_queryc);

																														if (mysqli_num_rows($result_selectc) > 0) {
																															$row_selectc = mysqli_fetch_assoc($result_selectc);
																															$ct_nm = $row_selectc['city_name'];
																														}
																														echo $clientname; ?>
								</td>
							</tr>
					
						<?php
						}
						if ($name_of_work != "") {
						?>
							<tr>
							<td style="width:12%;padding-bottom: 4px;">Name of Work</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $name_of_work; ?>
								</td>
							</tr>

						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 4px;">Agency</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $agency_name; ?>
								</td>
							</tr>
							
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 4px;">Agg No.</td>
								<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"> <?php echo $agreement_no; ?></td>
							</tr>


						<?php
						}
						if ($r_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom:14px;">Reference No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 14px;"><?php echo $r_name; ?></td>
							</tr>

						<?php
						}
						?>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;padding: 4px 0;margin-bottom:4px;    border-collapse: inherit;">
					    <tr>
							<td style="width:12%;padding-bottom: 4px;">Letter No.</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $letter_no;?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Sample of Source</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo $source; ?></td>
						</tr>

						<tr>
						<td style="width:12%;padding-bottom: 4px;">Date of letter</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $date_of_latter;?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td>
							<!-- <td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td> -->
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Completed</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;">Method of Test</td>
							<td style="width:6%;text-align: center;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;">IS 2386</td>
							<td style="width:21%;text-align:right;">Specification Requirement</td>
							<td style="width:6%;text-align: center;"> &raquo;</td>
							<td style="width:40%;">as per <span>MORTH</span></td>
						</tr>
						
					</table>
				</td>
			</tr>
			<tr>
			    <td>
                    <table align="left" width="100%" border="0px" cellspacing="0" cellpadding="0" class="test" style="font-family: Cambria;margin-top:10px;">
                        <tr>
                             <td colspan="2" style="padding-bottom:4px;font-weight:bold;font-size:11px;">A) Sieves Analysis :</td>
                        </tr>

                        <tr style="display:flex;">
                            <td colspan="2" style="width:100%;vertical-align:top;margin-bottom:10px;">
                                <table align="top" width="100%" class="test" style="max-width:400px;font-size:10px;font-family: Cambria;">
                                <tr>
											<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;" colspan="3"><b>Particle Size Distribution Test</b></td>
										</tr>
										<tr>
											<td colspan="3" style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;" ><b>IS 2386 Part-1</b></td>
										</tr>


										<tr>
											<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;"> Sieve Size</td>

												<td style="border-right:1px solid black;">
													<table style="width:100%;border-collapse: collapse;">
														<tr>
															<td style="font-size:10px;text-align:center;border-bottom:0px solid black;padding:5px 4px;">Test Result</td>
														</tr>
														<tr style="">
															<td style="font-size:10px;text-align:center;border-top:1px solid black;padding:5px 4px;">% Passing</td>
														</tr>
													</table>
											    </td>
										</tr>
                                    <tr>
                                        <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">53 mm</td>
                                        <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['pass_sample_1']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">45 mm</td>
                                        <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['pass_sample_2']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">26.5 mm</td>
                                        <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['pass_sample_3']; ?></td>
                                    </tr>
									<tr>
                                        <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">22.4 mm</td>
                                        <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['pass_sample_4']; ?></td>
                                    </tr>
									<tr>
                                        <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">19 mm</td>
                                        <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['pass_sample_5']; ?></td>
                                    </tr>
									
                                </table>
                            </td>

                            <?php
                            if ($row_select_pipe['alk_10'] != "" && $row_select_pipe['alk_10'] != "0") {
                            ?>
                                <td colspan="6" style="width:100%">
                                    <table align="center" width="100%" class="test" style="margin-left:15px;max-width:350px;font-size:10px;font-family: Cambria;">
                                        <tr>
                                            <td colspan="3" style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;"><b>Test Name</b></td>
                                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;"><b>Acceptance Critaria</b></td>
                                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;"><b>Test Method</b></td>
                                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;"><b>Test Results</b></td>
                                        </tr>

                                        <tr>
                                            <td colspan="3" style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;"><b>III) Alkali Reactivity Test (Gravimetric Method)</b></td>
                                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;">--</td>
                                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;">IS 2386-7</td>
                                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;"><?php echo $row_select_pipe['alk_10']; ?></td>
                                        </tr>
                                    </table>
                                </td>
                            <?php
                            }
                            ?>
                        </tr>

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
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;">Name Of Test</td>
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;">Test Method</td>
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;">Test Results</td>
												<!-- <td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;">Req. as per Morth</td> -->
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;width:25%;">Acceptance Critaria as per MoRTH</td>
											</tr>

                                        <?php
                                        if ($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Flakiness + Elongation %</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-1</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['combined_index']; ?></td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Max. 35%</td>
                                            </tr>
                                            

                                        <?php
                                        }
                                        if ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Impact Value %</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-4</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['imp_value']; ?></td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Max. 30%</td>
                                            </tr>

									<?php
                                        }
                                        if ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Crushing Value %</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-4</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['cru_value']; ?></td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Max. 30%</td>
                                            </tr>

									<?php
                                        }
                                        if ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">LA Abrasion Value %</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-4</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['abr_index']; ?></td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Max. 40%</td>
                                            </tr>


                                        <?php
                                        }
                                        if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Specific Gravity</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-3</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['sp_specific_gravity']; ?></td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Water Absorption %</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-3</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['sp_water_abr']; ?></td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Max. 2%</td>
                                            </tr>
                                       

                                        
                                        <?php
                                        }
                                        if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Bulk Density kg/Lit.</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-3</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['bdl']; ?></td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>


                                        <?php
                                        }
                                        if ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">10% Fine Value KN</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-4</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['fines_value']; ?></td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>

                                        <?php
                                        }
                                        if ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Liquid Limit (LL)</td>
                                                <td rowspan="3" style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2720 Part-5</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['liquide_limit']; ?></td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Max 25%</td>
                                            </tr>
                                            <tr>

                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Plastic Limit (PL)</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['plastic_limit']; ?></td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>
                                            <tr>

                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Plasticity Index (PI)</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['pi_value']; ?></td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">&lt; 6%</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Soundness Na<sub>2</sub>SO<sub>4</sub> %</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-5</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['soundness']; ?></td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Max. 12%</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['mdd'] != "" && $row_select_pipe['mdd'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">MDD (g/cc)</td>
                                                <td rowspan="2" style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2720 Part-8</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['mdd']; ?></td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['omc'] != "" && $row_select_pipe['omc'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">OMC %</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['omc']; ?></td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['cbr'] != "" && $row_select_pipe['cbr'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">California Bearing Ratio %</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2720 Part-16</td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['cbr']; ?></td>
                                                <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Min. 30</td>
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
				

				<!-- <td>
					<table align="left" width="100%" border="0px" cellspacing="0" cellpadding="0" class="test" style="">
						<tr>
							<td colspan="2" style="width:49%"><b>(I) Sieves Analysis</b></td>
							<td style="width:2%"><b>&nbsp;</b></td>
							<?php
							if (($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0") || ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0") || ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0") || ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0") || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0") || ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0") || ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0") || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") || ($row_select_pipe['cbr'] != "" && $row_select_pipe['cbr'] != "0") || ($row_select_pipe['mdd'] != "" && $row_select_pipe['mdd'] != "0") || ($row_select_pipe['omc'] != "" && $row_select_pipe['omc'] != "0")) {

							?>
								<td colspan="3" style="width:49%"><b>(II) Other Tests</b></td>
							<?php } else { ?>
								<td colspan="3" style="width:49%"><b>&nbsp;</b></td>
							<?php
							}
							?>
						</tr>
						<tr>

							<td colspan="2" style="width:49%;vertical-align:top">
								<table align="top" width="100%" class="test" style="height:100%;width:100%;">
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;" colspan="3"><b>Particle Size Distribution Test</b></td>
									</tr>
									<tr>
										<td colspan="3" style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>IS 2386-1963-RA 2016: P-1</b></td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>IS Sieve Size</b></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>% of Retained</b></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>% of Passing</b></td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">53 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['cum_ret_1']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_1']; ?></td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">26.5 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['cum_ret_2']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_2']; ?></td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">22.4 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['cum_ret_3']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_3']; ?></td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">13.2 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['cum_ret_4']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_4']; ?></td>
									</tr>




								</table>
							</td>
							<td style="width:2%"></td>
							<td colspan="3" style="width:49%;vertical-align:top">
								<table align="top" width="100%" class="test" style="height:100%;width:100%;">
									<?php
									if (($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0") || ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0") || ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0") || ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0") || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0") || ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0") || ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0") || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") || ($row_select_pipe['cbr'] != "" && $row_select_pipe['cbr'] != "0") || ($row_select_pipe['mdd'] != "" && $row_select_pipe['mdd'] != "0") || ($row_select_pipe['omc'] != "" && $row_select_pipe['omc'] != "0")) {

									?>
										<tr>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Test Name</b></td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Req. as per<br>IS 383-2016</b></td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Test<br>Method</b></td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Test Results</b></td>
										</tr>
										<?php
										if ($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0") {
										?>
											<tr>
												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Flakiness %</td>
												<td rowspan="2" style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 35%</td>
												<td rowspan="2" style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-1</td>
												<td rowspan="2" style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['combined_index']; ?></td>
											</tr>
											<tr>
												<td style="text-align:left;border:1px solid black;border-right:0px solid black;">Elongation %</td>


											</tr>
										<?php
										}
										if ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") {
										?>
											<tr>
												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Impact Value %</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 30%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-4</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['imp_value']; ?></td>
											</tr>
										<?php
										}
										if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0") {
										?>
											<tr>
												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Specific Gravity</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-3</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['sp_specific_gravity']; ?></td>
											</tr>
										<?php
										}
										if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0") {
										?>
											<tr>
												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Water Absorption %</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 2%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-3</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['sp_water_abr']; ?></td>
											</tr>
										<?php
										}
										if ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0") {
										?>
											<tr>
												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Crushing Value %</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 30%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-4</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['cru_value']; ?></td>
											</tr>
										<?php
										}
										if ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0") {
										?>
											<tr>
												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Abrasion Value %</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 40%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-4</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['abr_index']; ?></td>
											</tr>
										<?php
										}
										if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0") {
										?>
											<tr>
												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Bulk Density kg/Lit.</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-3</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['bdl']; ?></td>
											</tr>
										<?php
										}
										if ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0") {
										?>
											<tr>
												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">10% Fine Value KN</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-4</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['fines_value']; ?></td>
											</tr>
										<?php
										}
										if ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0") {
										?>
											<tr>

												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Liquid Limit %</td>
												<td rowspan="3" style="text-align:center;border:1px solid black;border-right:0px solid black;">Max 25%</td>
												<td rowspan="3" style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2720-5</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['liquide_limit']; ?></td>
											</tr>
											<tr>

												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Plastic Limit %</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['plastic_limit']; ?></td>
											</tr>
											<tr>

												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Plasticity Index %</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['pi_value']; ?></td>
											</tr>
										<?php
										}
										if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") {
										?>
											<tr>

												<td style="text-align:left;border:1px solid black;border-right:0px solid black;">Soundness Na<sub>2</sub>SO<sub>4</sub> %</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 12%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-5</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['soundness']; ?></td>
											</tr>
									<?php
										}
									}
									?>
								</table>

							</td>
						</tr>
						<tr>
							<td colspan="2" style="width:49%"><b>&nbsp;</b></td>
							<td style="width:2%"><b>&nbsp;</b></td>
							<td colspan="3" style="width:49%"><b></b></td>
						</tr>
						<tr>
							<?php
							if ($row_select_pipe['alk_10'] != "" && $row_select_pipe['alk_10'] != "0") {
							?>
								<td colspan="6" style="width:100%">
									<table align="center" width="100%" class="test" style="height:100%;width:100%;">
										<tr>
											<td colspan="3" style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Test Name</b></td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Acceptance Critaria</b></td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Test Method</b></td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Test Results</b></td>
										</tr>

										<tr>
											<td colspan="3" style="text-align:left;border:1px solid black;border-right:0px solid black;"><b>III) Alkali Reactivity Test (Gravimetric Method)</b></td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-7</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['alk_10']; ?></td>
										</tr>


									</table>

								</td>
							<?php
							}
							?>


						</tr>


					</table>

				</td> -->
			</tr>
		</table>



		<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family: Cambria;" class="test">
						<tr>
							<td style="width:60%;text-align:center;font-weight:bold;padding:7px 0;">
									** End of Report ** 
							</td>																		
						</tr>
		</table>

	    <table align="center" width="100%" class="test">
		        <tr>
					<td style="text-align:center;font-size:10px;">
						<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;border-top:1px solid black;border-bottom:1px solid black;">
							<tr>
								<td><b>Note :-</b></td>
								<td></td>
							</tr>
							<tr>
								<td style="font-size:10px;width:50%;padding:3px 0;"> 1. &nbsp;The results are given only for the sample submitted by the Customer/Agency.</td>
								<td style="text-align:center;width:15%;font-style:italic;font-size:11px;"><b>Reviewed & Authorized By</b></td>
							</tr>
							<tr>
								<td style="font-size:10px;padding:3px 0;"> 2. &nbsp;The test report shall not be reproduced except in full , Without written approval of the laboratory.</td>
								<td></td>
							</tr>
							<tr>
								<td style="font-size:10px;padding:3px 0;">3. &nbsp;Manglam Consultancy services is not responsible for any kind of interpretation of test results.</td>
								<td></td>
							</tr>
							<tr>
								<td style="font-size:10px;padding:3px 0;">4. &nbsp;The Results/Report are not used for publicity.</td>
								<td style="text-align:center;font-style:italic;font-size:11px;"><b>(D.H.Shah/M.D.Shah)</b></td>
							</tr>
							<tr>
								<td style="font-size:10px;padding:3px 0;">5. &nbsp;*As informed by Customer/Agency.</td>
								<td style="text-align:center;font-style:italic;font-size:11px;"><b>Director/TM</b></td>
							</tr>
						</table>
					</td>
			    </tr>
		</table>

		<table width="100%" align="center" style="font-family:Cambria;font-size:10px;">
						<tr>
							<td style="width:40%;text-align:right;font-weight:bold;font-style:italic;font-size:11px;">
								Doc ID : FMT-TST-28/ Page 1/1
							</td>
						</tr>
		</table>
		

	</page>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">


</script>