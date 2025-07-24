<?php
	session_start();
	include("../connection.php");
	error_reporting(0); ?>
	<style>
		@page {
			margin: 0;
		}

		.pagebreak {
			page-break-before: always;
		}

		page[size="A4"] {
			width: 21cm;
			height: 29.7cm;
			transform: scale(.7);
		}

		@media print {
			#header_hide_show {
				display: none !important;
			}
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
			font-size: 11.5px;
			font-family : Calibri;
		}

		.tdclass1 {

			font-size: 10px;
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

		select {
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			border: none;
			/* If you want to remove the border as well */
			background: none;
		}
	</style>
	<html>

	<body>
		<?php
		$job_no = $_GET['job_no'];
		$lab_no = $_GET['lab_no'];
		$report_no = $_GET['report_no'];
		$trf_no = $_GET['trf_no'];
		$select_tiles_query = "select * from ws_bela_stone WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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

		$select_query1 = "select * from agency_master where `isdeleted`=0 and `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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
			$rec_sample_date = $row_select2['receive_date'];
			$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
			$result_select3 = mysqli_query($conn, $select_query3);

			if (mysqli_num_rows($result_select3) > 0) {
				$row_select3 = mysqli_fetch_assoc($result_select3);
				$mt_name = $row_select3['mt_name'];
			}
		}

		$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
		$result_select4 = mysqli_query($conn, $select_query4);

		if (mysqli_num_rows($result_select4) > 0) {
			$row_select4 = mysqli_fetch_assoc($result_select4);
						$bitumin_grade= $row_select4['bitumin_grade'];
					$lot_no= $row_select4['lot_no'];
					$bitumin_make= $row_select4['bitumin_make'];
					$tank_no= $row_select4['tanker_no'];
					$material_location= $row_select4['material_location'];
		}
		
		
		$first_tag = $row_select['first_tag'];
					$second_tag = $row_select['second_tag'];
					$third_tag = $row_select['third_tag'];
					$fourth_tag = $row_select['fourth_tag'];
					
					$first_txt = $row_select['first_txt'];
					$second_txt = $row_select['second_txt'];
					$third_txt = $row_select['third_txt'];
					$fourth_txt = $row_select['fourth_txt'];
					
					
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
				
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
						<tr>
							<td style="padding: 0 2px;text-align: left;">&nbsp;<?php echo $report_no; ?></td>
							
							<td style="padding: 0 2px;text-align: left;">&nbsp;<?php if(strlen($_GET['ulr'])>15){echo $_GET['ulr'];}?></td>
							<td style="padding: 0 2px;text-align: right;">&nbsp;Page 1 of 1</td>
						</tr>
						<tr>
							<td style="width: 80%;padding: 0 2px;text-align: left;border-top:1px solid;" colspan="2">&nbsp;Prepared by : Technical Manager</td>
							<td style="padding: 0 2px;width:20%;text-align: right;border-top:1px solid;">&nbsp;Approved by : Quality Manager</td>
						</tr>
						
				</table>
				<br>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;">
						<tr>
							<td style="width: 58.5%;padding: 0 2px;text-align: right;">&nbsp;Discipline:- Mechanical</td>
							<td style="padding: 0 2px;width:45%;text-align: right;">&nbsp;Date:<?php echo date('d/m/Y', strtotime($end_date));?></td>
						</tr>
						
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;">
						<tr>
							<td style="width: 100%;padding: 0 2px;text-align: center;">&nbsp;Group:- Building Materials</td>
						</tr>
						
				</table>
				<br>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 15px;padding: 2px 0;"  colspan="4">TITLE : TEST REPORT OF BELA
						</td>
					</tr>
				</table>
				<br>	
				<br>	
				<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; border: 1px solid;">
    <?php if ($name_of_work != "") { ?>
	<tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Work </td>
        <td style="padding:2px;text-align: left;" colspan="6"><b>&nbsp; : &nbsp;</b><?php echo $name_of_work;?></td>
    </tr>
	<?php }if ($agency_name != "") { ?>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Agency </td>
        <td style="padding:2px;text-align: left;" colspan="6"><b>&nbsp; : &nbsp;</b><?php echo $agency_name;?></td>
    </tr>
	<?php }?>
	<tr>
		<?php
					if ($row_select['tpi_name'] != "") {
						?>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Consultant </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $row_select['tpi_name']; ?></td>
					<?php } if ($agreement_no != "") {?>
		<td style="padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Agreement No</td>
		<td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $agreement_no; ?></td>
					<?php }?>
	</tr>    
	
    <tr>
		<?php
						if ($clientname != "") {
						?>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Client </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $clientname;?></td>
						<?php }?>
    </tr>   
    <tr>
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;font-weight: bold;">&nbsp;Date of Receipt Sample </td>
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
        <td style="text-align: left;font-weight: bold;" rowspan="2">&nbsp;Sender's Reference</td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $r_name; ?>&nbsp;&nbsp;<?php
            if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
            ?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
            } else {
            }
        ?></td>
    </tr>
    
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Date of Test Performed </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b>From</td>
        <td style="padding:2px;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
        <td style="padding:2px;text-align: center;">&nbsp;To</td>
        <td style="padding:2px;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
        <td style="padding:2px;text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;Date <b>&nbsp; : &nbsp;</b> <?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Enviromental Condition </td>
        <td style="padding:2px;text-align: left;font-weight:bold;" colspan="2"><b>&nbsp; : &nbsp;</b>Temperature</td>
        <td style="padding:2px;text-align: center;"><b>&nbsp; : &nbsp;</b>27˚± 2 ˚c</td>
        <td style="padding:2px;text-align: center;"><b></td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Location</td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php if ($material_location == 1) {echo "In Laboratory";} else {echo "In Field";} ?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Sampling Method </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b>Sample Collected by the Supplier</td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Job No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $job_no;?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Identification Mark </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $mark; ?></td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Lab No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $lab_no;?></td>
    </tr>
</table>
				<!--<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;padding-top:20px;padding-bottom:20px;">
						<tr>
							<td style="width: 50%;padding: 0 2px;text-align: left;font-size:15px;">&nbsp;Size of Brick <?php echo $row_select4['brick_size'];?> Cm</td>
						</tr>
						
				</table>-->
				
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; padding-top:20px;border-bottom: 1px solid;">
			
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9.6%">Sr. No.</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Tests</td>                            
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Result Obtained</td>                            
                <td style="border-top:1px solid;border-right:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Test Method</td>
            </tr>
			<?php $cnt=1;?>
			<?php if ($row_select_pipe['avg_spg'] != "" && $row_select_pipe['avg_spg'] != null && $row_select_pipe['avg_spg'] != "0") { 
			?>
			
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Specific gravity</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['avg_spg'];?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;" >IS: 1128-1975</td>
            </tr>
			<?php 
			} 
			if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != null && $row_select_pipe['avg_wtr'] != "0") { 
			?>
			
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Water Absorption (%)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['avg_wtr'];?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;">IS: 1597 (Part-1) 1967</td>
            </tr>
			<?php 
			} 
			if ($row_select_pipe['avg_com1'] != "" && $row_select_pipe['avg_com1'] != null && $row_select_pipe['avg_com1'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" rowspan="3"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Compressive strength (Kg/Cm<sup>2</sup>)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-bottom:0px;" ></td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Dry</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['avg_com1']; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-bottom:0px;" rowspan="2">IS: 1123-1975</td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Wet</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['avg_com2']; ?></td>
            </tr>
			
			<?php } ?>
			
	</table>
	<br>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
			
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
						
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">NOTES :-</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;padding-left:60px;" colspan="2">1) Test results related to sample collected by Customer.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;padding-left:60px;" colspan="2">2) Results/Reports are issued with the specific understanding that Stern Testing & Consultancy Pvt. Ltd. will not, in any case, be involved in action following the interpretation of test results.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;padding-left:60px;" colspan="2">3) The reports/results are not supposed to be used for Publicity.</td>
						</tr>
						
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;width:70%;padding-top:50px;"></td>
							<td style="padding: 1px 2px;font-weight: bold;width:30%;">Stern Testing & Consultancy Pvt. Ltd.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;width:70%;padding-top:80px;"></td>
							<td style="padding: 1px 2px;font-weight: bold;width:30%;padding-left:5%;">Authorized Signature</td>
						</tr>
						
					</table>
				</td>
			</tr>

		</table>
			</td>
		</tr>
</TABLE>
		<!--</table>
				<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:0px solid;border-bottom:0px;">
			<tr>
					<td  style="text-align:center; font-size:20px;font-family:Algerian; "><b>TEST REPORT</b></td>
				</tr>
				</table>
			<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:0px solid;border-bottom:0px;">
				<tr>
					<td>
			
			<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid black; ">
				
				<tr style="border: 1px solid black;height:20px;font-size:11px;"> 
					<td width="33%" style="text-align:left; margin:15px;  "><?php if($report_no != "" && $report_no != "0" && $report_no != null){
						echo "<b>&nbsp;&nbsp;Report No:</b>  ".$report_no;}?></td>
					<td width="33%" style="">&nbsp;&nbsp; <?php if($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null){
						echo "<b>ULR No: </b> ".$row_select_pipe['ulr'];}?></td>
					
					<td width="33%" style="text-align:right; margin:15px;"><b> Date:</b> <?php echo date('d-m-Y', strtotime($issue_date));?>&nbsp;&nbsp;&nbsp;</td>
				</tr>
			</table>
			<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:0px solid black; ">
			
				<tr style="border: 1px solid black;">
				<td style="border-bottom: 1px solid black;border: 1px solid black;min-height:100px;height:100px;vertical-align:top;border-top:0px;width:33%;">&nbsp;<b> Submited To,</b><br><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'"; 
															$result_selectc = mysqli_query($conn, $select_queryc);

															if (mysqli_num_rows($result_selectc) > 0) {
																$row_selectc = mysqli_fetch_assoc($result_selectc);
																$ct_nm= $row_selectc['city_name'];
															}
															echo "&nbsp;&nbsp;".$clientname;
															if($client_address!=null && $client_address!="" && $client_address!="undefined"){ echo "<br>&nbsp;&nbsp;".$client_address;}
															?> </td>
				<td style="border-bottom: 1px solid black;border-right: 1px solid black;min-height:100px;height:100px;vertical-align:top;border-top:0px;width:67%;  "><div style="text-align: justify;
  text-align-last: left;padding-left:3px"><b>&nbsp;&nbsp;Customer Name :</b>
				<br><?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'"; 
															$result_selectc1 = mysqli_query($conn, $select_queryc1);

															if (mysqli_num_rows($result_selectc1) > 0) {
																$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
																$ct_nm1= $row_selectc1['city_name'];
															}
															echo "&nbsp;&nbsp;".$agency_name." ".$ct_nm1;?><br>
															<br><div style="text-align: justify;
  text-align-last: left;padding-left:3px"><b>Name of Work :</b><br><?php echo $name_of_work;?></div>
															</td>
				
			</tr>
				</table>
				<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid black;border-top:0px; ">
			
				
				
				<tr style="border: 0px solid black;height:20px;">
				<td style="border-bottom: 0px solid black;border-right: 0px solid black;width:15%; ">&nbsp;&nbsp;<b> Name of PMC :</b></td>
					<td style="border-bottom: 0px solid black;width:18%; ">&nbsp;&nbsp; <?php 
					if($first_tag != null && $first_tag != ""){
						echo $first_txt;
					}
					else
					{
						echo "Not declared";
					}
					?> </td>
					<td style="border-bottom: 0px solid black;border-right: 0px solid black;width:28%; ">&nbsp;&nbsp;<b> Reference Letter No. :</b></td>
					<td style="border-bottom: 0px solid black;width:40%; ">&nbsp;&nbsp; <?php 
					echo $r_name." Date:".date('d/m/Y', strtotime($row_select2["letter_date"])); 
					
					?> </td>
				</tr>
				<tr style="border: 0px solid black;height:20px;">
				
					
					<td style="border-bottom: 0px solid black;border-right: 0px solid black; ">&nbsp;&nbsp;<b> Sample Received :</b></td>
					<td style="border-bottom: 0px solid black; ">&nbsp;&nbsp; <?php 
					echo date('d-m-Y', strtotime($rec_sample_date)); 
					
					?> </td>
					<td style="border-bottom: 0px solid black;border-right: 0px solid black; ">&nbsp;&nbsp;<b> Specification of Sample:</b></td>
					<td style="border-bottom: 0px solid black; ">&nbsp;&nbsp; Bella</td>
				</tr>
				<tr style="border: 0px solid black;height:20px;">
				
					
					<td style="border-bottom: 0px solid black;border-right: 0px solid black; ">&nbsp;&nbsp;<b> No. of Sample :</b></td>
					<td style="border-bottom: 0px solid black; ">&nbsp;&nbsp; <?php 
					echo "10 Nos.";
					
					?> </td>
					<td style="border-bottom: 0px solid black;border-right: 0px solid black; ">&nbsp;&nbsp;<b> Sample Condition on Received :</b></td>
					<td style="border-bottom: 0px solid black; ">&nbsp;&nbsp;  <select style="font-size:11px;border:0px;font-family : Calibri;" onchange="put_details()" id="details_of_sample"><option>Satisfactory</option><option>Not satisfactory</option></select></td>
				</tr>
				
				<tr style="border: 0px solid black;height:20px;">
				
					
					<td style="border-bottom: 0px solid black;border-right: 0px solid black; ">&nbsp;&nbsp;<b> Type of Sample :</b></td>
					<td style="border-bottom: 0px solid black; ">&nbsp;&nbsp; White Stone Bella</td>
					<td style="border-bottom: 0px solid black;border-right: 0px solid black; ">&nbsp;&nbsp;<b> Environmental Condition during test :</b></td>
					<td style="border-bottom: 0px solid black; ">&nbsp;&nbsp; As per the test procedure</td>
				</tr>
				<tr style="border: 0px solid black;height:20px;">
				
					
					<td style="border-bottom: 0px solid black;border-right: 0px solid black; ">&nbsp;&nbsp;<b> Name of Test :</b></td>
					<td style="border-bottom: 0px solid black; ">&nbsp;&nbsp; As mentioned below</td>
					<td style="border-bottom: 0px solid black;border-right: 0px solid black; ">&nbsp;&nbsp;<b> Reference Standard :</b></td>
					<td style="border-bottom: 0px solid black; ">&nbsp;&nbsp; As mentioned below</td>
				</tr>
				<tr style="border: 0px solid black;height:20px;">
				
					
					<td style="border-bottom: 0px solid black;border-right: 0px solid black; ">&nbsp;&nbsp;<b> Test Starting Date :</b></td>
					<td style="border-bottom: 0px solid black; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
					<td style="border-bottom: 0px solid black;border-right: 0px solid black; ">&nbsp;&nbsp;<b> Test End Date :</b></td>
					<td style="border-bottom: 0px solid black; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
				</tr>
				
				</table>
				
			<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid black;border-top:0px; ">
			
				<tr style="border: 0px solid black;height:20px;">
				
					
					<td style="border-bottom: 0px solid black;border-right: 0px solid black;width:15% ">&nbsp;&nbsp;<b> Discipline :</b></td>
					<td style="border-bottom: 0px solid black;width:18% ">&nbsp;&nbsp; Mechanical</td>
					<?php if($identification!=""){?>
					<td style="border-bottom: 0px solid black;border-right: 0px solid black;width:28%; ">&nbsp;&nbsp;<b> Source :</b></td>
					<td style="border-bottom: 0px solid black;width:40%; ">&nbsp;&nbsp; <?php if($identification!=""){echo $identification;}else{echo "--";}?></td>
					<?php }else{?>
					<td style="border-bottom: 0px solid black;border-right: 0px solid black;width:28%; ">&nbsp;&nbsp;<b></b></td>
					<td style="border-bottom: 0px solid black;width:40%; ">&nbsp;&nbsp;</td>
					<?php }?>
				</tr>
				<tr style="border: 0px solid black;height:20px;">
				
					
					<td style="border-bottom: 0px solid black;border-right: 0px solid black; ">&nbsp;&nbsp;<b> Group :</b></td>
					<td style="border-bottom: 0px solid black; ">&nbsp;&nbsp; Building Materials</td>
					<?php if($second_txt!=""){?>
					<td style="border-bottom: 0px solid black;border-right: 0px solid black; ">&nbsp;&nbsp;<b> Witness By :</b></td>
					<td style="border-bottom: 0px solid black; ">&nbsp;&nbsp; <?php echo $second_txt;?></td>
						<?php }else{?>
					<td style="border-bottom: 0px solid black;border-right: 0px solid black; ">&nbsp;&nbsp;<b> </b></td>
					<td style="border-bottom: 0px solid black; ">&nbsp;&nbsp; </td>	
						<?php }?>
				</tr>
				<?php if($third_txt!="" || $fourth_txt!=""){?>
				<tr style="border: 0px solid black;height:20px;">
				
					<?php if($third_txt!=""){?>
					<td style="border-bottom: 0px solid black;border-right: 0px solid black; ">&nbsp;&nbsp;<b> <?php echo $third_tag;?> :</b></td>
					<td style="border-bottom: 0px solid black; ">&nbsp;&nbsp; <?php echo $third_txt;?></td>
					<?php }else{?>
					<td style="border-bottom: 0px solid black;border-right: 0px solid black; ">&nbsp;&nbsp;<b> </b></td>
					<td style="border-bottom: 0px solid black; ">&nbsp;&nbsp;</td>
					<?php }?>
					<?php if($fourth_txt!=""){?>
					<td style="border-bottom: 0px solid black;border-right: 0px solid black; ">&nbsp;&nbsp;<b> <?php echo $fourth_tag;?> :</b></td>
					<td style="border-bottom: 0px solid black; ">&nbsp;&nbsp; <?php echo $fourth_txt;?></td>
						<?php }else{?>
					<td style="border-bottom: 0px solid black;border-right: 0px solid black; ">&nbsp;&nbsp;<b> </b></td>
					<td style="border-bottom: 0px solid black; ">&nbsp;&nbsp; </td>	
						<?php }?>
				</tr>
				<?php }?>
				
				
				
				</table>
			
				<table align="center" width="100%" class="test" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				
			
			<tr height="30px">
				<td style="border: 1px solid black;font-weight:bold;text-align:center;">Sr No.</td>
				<td style="border: 1px solid black;font-weight:bold;text-align:center;">Description</td>
				<td style="border: 1px solid black;font-weight:bold;text-align:center;">Results</td>
				<td style="border: 1px solid black;font-weight:bold;text-align:center;">Method</td>
			</tr>
			<tr height="50px">
				<td style="border: 1px solid black;text-align:center;">1</td>
				<td style="border: 1px solid black;text-align:left;">&nbsp; COMPRESSIVE STRENGTH N/mm<sup>2</sup></td>
				<td style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['com7']!="" && $row_select_pipe['com7']!=null && $row_select_pipe['com7']!="0"){echo $row_select_pipe['com7']; }else{echo "-";}?></td>
				<td style="border: 1px solid black;text-align:center;"> (IS 1597 (Part-1) 1992</td>
			</tr>
			<tr height="50px">
				<td style="border: 1px solid black;text-align:center;">2</td>
				<td style="border: 1px solid black;text-align:left;">&nbsp; WATER ABSORPTION %</td>
				<td style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['wtr3']!="" && $row_select_pipe['wtr3']!=null && $row_select_pipe['wtr3']!="0"){echo $row_select_pipe['wtr3']; }else{echo "-";}?></td>
				<td style="border: 1px solid black;text-align:center;"> IS 1124-1974 </td>
			</tr>
			<tr height="50px">
				<td style="border: 1px solid black;text-align:center;">3</td>
				<td style="border: 1px solid black;text-align:left;">&nbsp; True Specific Gravity °C</td>
				<td style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['tsg6']!="" && $row_select_pipe['tsg6']!=null && $row_select_pipe['tsg6']!="0"){echo $row_select_pipe['tsg6']; }else{echo "-";}?></td>
				<td style="border: 1px solid black;text-align:center;"> (IS 1122)</td>
			</tr>
			<tr height="50px">
				<td style="border: 1px solid black;text-align:center;">4</td>
				<td style="border: 1px solid black;text-align:left;">&nbsp; Apparent Specific Gravity </td>
				<td style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['asg3']!="" && $row_select_pipe['asg3']!=null && $row_select_pipe['asg3']!="0"){echo $row_select_pipe['asg3']; }else{ echo "-"; }?></td>
				<td style="border: 1px solid black;text-align:center;"> (IS 1124)</td>
			</tr>
		</table>
			
			<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="height:auto;border-left:1px solid black;border-right:1px solid black;font-family : Calibri;">
			
				
				
				<tr style="border: 0px solid black;height:20px;">
				<td style="border-bottom: 0px solid black;border-right: 0px solid black;width:20%; ">&nbsp;&nbsp;</td>
					<td style="border-bottom: 0px solid black;width:80%; ">&nbsp;&nbsp; </td>
					
				</tr>
				
				</table>
																	
			
			
			<table align="center" width="100%"  class="test" style="height:auto;border:1px solid black;font-family : Calibri; " >
				<tr>
					<td style="font-family:Algerian;border-right:1px solid;-webkit-transform: rotate(-90deg);
	-moz-transform: rotate(-90deg);
	-o-transform: rotate(-90deg);
	-ms-transform: rotate(-90deg);
	transform: rotate(-90deg);text-align:center;width:5%;"><b style="">NOTE</td>
					<td style="width:75%;"><p style="align:justify;font-size:11px;">1). The Results Given above are Related to the Sample supplied by Customer / Agency. The Customer Asked for the above tests only. <br>2). This Test Reports will not be generated again, either Partly or wholly, without prior written permission of the laboratory. <br>3). This Test Report  will not be used for any publicity / Legal Purpose. <br>4). The Results / Reports are issued with specific Understanding that REE will not in way be involved in acting following interpretation of the test results.<br><br></p></td>
					<td style="text-align:Center;border-left:1px solid;font-size:11px;width:20%;"><p style="align:Center;font-weight:bold;">for REE TEHCNOLOGY LLP<br><br><br><br><br><br>Authorised Signatory</p></td>
				</tr>
			</table>
			</td>
			</tr>
			</table>
				<?php if($row_select_pipe['rem_data']!="" && $row_select_pipe['rem_data']!=null){?>
			<table align="center" width="92%" style="font-family : Calibri;">
				<tr style="border: 0px solid black;height:20px;">
							
					<td style="border-bottom: 0px solid black;border-right: 0px solid black;font-size:11px;">&nbsp;&nbsp;<b> Remarks:</b>  <?php echo $row_select_pipe['rem_data'];?></td>
				
				</tr>
			</table>
				<?php }?>
			<table align="center" width="92%" style="font-family : Calibri;">
				<tr>
					<td style="width:40%;">
						<div style="">
							
						</div>
					</td>
					<td style="width:60%;">
						<div style="">
							<b style="font-size:11px;">&#x2022;&#x2022; END OF REPORT &#x2022;&#x2022;</b>
						</div>
					</td>
				</tr>
				<tr>
					<td style="width:40%;">
						<div style="">
							<b style="font-size:11px;">Page: 1 of 1</b>
						</div>
					</td>
					<td style="width:60%;">
						<div style="">
							
						</div>
					</td>
				</tr>
			</table>-->
			
			</page>
			
				
	</body>

	</html>
	<script src="jquery.min.js"></script>
	<script type="text/javascript">
		function header() {
			if (document.querySelector('#header_hide_show').checked) {
				document.getElementById('header').innerHTML = '';
				document.getElementById("header").insertAdjacentHTML("afterbegin", '<img src="../images/header.png" width="150px">');
				document.getElementById("footer").insertAdjacentHTML("afterbegin", '<img src="../images/stamp_tag.png" width="160px">');
				document.getElementById('sign').innerHTML = '';
				document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/sign.png" width="160px">');
			} else {
				document.getElementById('header').innerHTML = '';
				document.getElementById("header").insertAdjacentHTML("afterbegin", '<br><br><br><br>');
				document.getElementById("footer").innerHTML = '';
				document.getElementById('sign').innerHTML = '';
				document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../../images/stamp.png" width="160px">');
			}
		}

		function header_2() {
			if (document.querySelector('#header_hide_show_2').checked) {
				document.getElementById('header_2').innerHTML = '';
				document.getElementById("header_2").insertAdjacentHTML("afterbegin", '<img src="../images/header.png" width="150px">');
				document.getElementById("footer_2").insertAdjacentHTML("afterbegin", '<img src="../images/stamp_tag.png" width="160px">');
				document.getElementById('sign_2').innerHTML = '';
				document.getElementById("sign_2").insertAdjacentHTML("afterbegin", '<img src="../images/sign.png" width="160px">');
			} else {
				document.getElementById('header_2').innerHTML = '';
				document.getElementById("header_2").insertAdjacentHTML("afterbegin", '<br><br><br><br><br><br><br><br><br>');
				document.getElementById("footer_2").innerHTML = '';
				document.getElementById('sign_2').innerHTML = '';
				document.getElementById("sign_2").insertAdjacentHTML("afterbegin", '<img src="../../images/stamp.png" width="160px">');
			}
		}


		
		
		
		// function put_details(){
			// var get_data = document.getElementById('details_of_sample').value;
			// document.getElementById('put_details').innerHTML = get_data;
			 // var d = document.getElementById("put_details");
				// d.remove(d.selectedIndex);
		// }
	</script>