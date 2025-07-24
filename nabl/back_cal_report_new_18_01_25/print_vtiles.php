<?php
session_start();
include("../connection.php");
error_reporting(0); ?>
<style>
    @page {
        margin: 0 30px;
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
    $select_vtiles_query = "select * from vit_tiles WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
    $result_vtiles_select = mysqli_query($conn, $select_vtiles_query);
    $row_select_pipe = mysqli_fetch_array($result_vtiles_select);

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
        $mark = $row_select4['brick_mark'];
        $brick_specification = $row_select4['brick_specification'];
    }
    ?>

<br>
<br>
<?php //if (($row_select_pipe['spl_avg1'] != "" && $row_select_pipe['spl_avg1'] != "0" && $row_select_pipe['spl_avg1'] != null) || ($row_select_pipe['avg_wtr_1'] != "" && $row_select_pipe['avg_wtr_1'] != "0" && $row_select_pipe['avg_wtr_1'] != null)) { ?>		
<page size="A4">
                <tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: REE/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : 2</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:100px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style="" > OBSERVATION AND CALCULATION SHEET FOR TEST ON STEEL</td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;border-bottom:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-bottom:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-bottom:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
				
				
				
		<?php if (($row_select_pipe['len1'] != "" && $row_select_pipe['len1'] != "0" && $row_select_pipe['len1'] != null)) { ?>		

    <br>
		<?php $cnt=1;?>
        <table align="center" height="25%" width="100%" class="test" style="border: 1px solid black;margin-top:-1px;">
            <tr>
					<td style="border-top:1px solid black;border-bottom:1px solid black;text-align:center;padding: 1px 4px;width: 12.12%;font-size: 13px;text-transform: uppercase;" colspan="7"><b>Dimensions & Surface Quality : (IS 13630 P-1)</b></td>
				</tr>
			<tr>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:10%;">Sr No</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:15%;">Length</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:15%;">Width</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:15%;">Thickness</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:15%;">Straightness Deviation (%)</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:15%;">Rectangularity Deviation (%)</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:15%;">Surface Flatness Deviation (%)</td>
            </tr>
			<?php if ($row_select_pipe['len1'] != "" && $row_select_pipe['len1'] != "0" && $row_select_pipe['len1'] != null) {?>
            <tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                 <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len1'] != "" && $row_select_pipe['len1'] != "0" && $row_select_pipe['len1'] != null) {echo $row_select_pipe['len1'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid1'] != "" && $row_select_pipe['wid1'] != "0" && $row_select_pipe['wid1'] != null) {echo $row_select_pipe['wid1'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk1'] != "" && $row_select_pipe['thk1'] != "0" && $row_select_pipe['thk1'] != null) {echo $row_select_pipe['thk1'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['str1'] != "" && $row_select_pipe['str1'] != "0" && $row_select_pipe['str1'] != null) {echo $row_select_pipe['str1'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['rec1'] != "" && $row_select_pipe['rec1'] != "0" && $row_select_pipe['rec1'] != null) {echo $row_select_pipe['rec1'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['sur1'] != "" && $row_select_pipe['sur1'] != "0" && $row_select_pipe['sur1'] != null) {echo $row_select_pipe['sur1'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['len2'] != "" && $row_select_pipe['len2'] != "0" && $row_select_pipe['len2'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                 <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len2'] != "" && $row_select_pipe['len2'] != "0" && $row_select_pipe['len2'] != null) {echo $row_select_pipe['len2'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid2'] != "" && $row_select_pipe['wid2'] != "0" && $row_select_pipe['wid2'] != null) {echo $row_select_pipe['wid2'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk2'] != "" && $row_select_pipe['thk2'] != "0" && $row_select_pipe['thk2'] != null) {echo $row_select_pipe['thk2'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['str2'] != "" && $row_select_pipe['str2'] != "0" && $row_select_pipe['str2'] != null) {echo $row_select_pipe['str2'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['rec2'] != "" && $row_select_pipe['rec2'] != "0" && $row_select_pipe['rec2'] != null) {echo $row_select_pipe['rec2'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['sur2'] != "" && $row_select_pipe['sur2'] != "0" && $row_select_pipe['sur2'] != null) {echo $row_select_pipe['sur2'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['len3'] != "" && $row_select_pipe['len3'] != "0" && $row_select_pipe['len3'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                 <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len3'] != "" && $row_select_pipe['len3'] != "0" && $row_select_pipe['len3'] != null) {echo $row_select_pipe['len3'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid3'] != "" && $row_select_pipe['wid3'] != "0" && $row_select_pipe['wid3'] != null) {echo $row_select_pipe['wid3'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk3'] != "" && $row_select_pipe['thk3'] != "0" && $row_select_pipe['thk3'] != null) {echo $row_select_pipe['thk3'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['str3'] != "" && $row_select_pipe['str3'] != "0" && $row_select_pipe['str3'] != null) {echo $row_select_pipe['str3'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['rec3'] != "" && $row_select_pipe['rec3'] != "0" && $row_select_pipe['rec3'] != null) {echo $row_select_pipe['rec3'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['sur3'] != "" && $row_select_pipe['sur3'] != "0" && $row_select_pipe['sur3'] != null) {echo $row_select_pipe['sur3'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['len4'] != "" && $row_select_pipe['len4'] != "0" && $row_select_pipe['len4'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len4'] != "" && $row_select_pipe['len4'] != "0" && $row_select_pipe['len4'] != null) {echo $row_select_pipe['len4'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid4'] != "" && $row_select_pipe['wid4'] != "0" && $row_select_pipe['wid4'] != null) {echo $row_select_pipe['wid4'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk4'] != "" && $row_select_pipe['thk4'] != "0" && $row_select_pipe['thk4'] != null) {echo $row_select_pipe['thk4'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['str4'] != "" && $row_select_pipe['str4'] != "0" && $row_select_pipe['str4'] != null) {echo $row_select_pipe['str4'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['rec4'] != "" && $row_select_pipe['rec4'] != "0" && $row_select_pipe['rec4'] != null) {echo $row_select_pipe['rec4'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['sur4'] != "" && $row_select_pipe['sur4'] != "0" && $row_select_pipe['sur4'] != null) {echo $row_select_pipe['sur4'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['len5'] != "" && $row_select_pipe['len5'] != "0" && $row_select_pipe['len5'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len5'] != "" && $row_select_pipe['len5'] != "0" && $row_select_pipe['len5'] != null) {echo $row_select_pipe['len5'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid5'] != "" && $row_select_pipe['wid5'] != "0" && $row_select_pipe['wid5'] != null) {echo $row_select_pipe['wid5'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk5'] != "" && $row_select_pipe['thk5'] != "0" && $row_select_pipe['thk5'] != null) {echo $row_select_pipe['thk5'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['str5'] != "" && $row_select_pipe['str5'] != "0" && $row_select_pipe['str5'] != null) {echo $row_select_pipe['str5'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['rec5'] != "" && $row_select_pipe['rec5'] != "0" && $row_select_pipe['rec5'] != null) {echo $row_select_pipe['rec5'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['sur5'] != "" && $row_select_pipe['sur5'] != "0" && $row_select_pipe['sur5'] != null) {echo $row_select_pipe['sur5'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['len6'] != "" && $row_select_pipe['len6'] != "0" && $row_select_pipe['len6'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len6'] != "" && $row_select_pipe['len6'] != "0" && $row_select_pipe['len6'] != null) {echo $row_select_pipe['len6'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid6'] != "" && $row_select_pipe['wid6'] != "0" && $row_select_pipe['wid6'] != null) {echo $row_select_pipe['wid6'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk6'] != "" && $row_select_pipe['thk6'] != "0" && $row_select_pipe['thk6'] != null) {echo $row_select_pipe['thk6'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['str6'] != "" && $row_select_pipe['str6'] != "0" && $row_select_pipe['str6'] != null) {echo $row_select_pipe['str6'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['rec6'] != "" && $row_select_pipe['rec6'] != "0" && $row_select_pipe['rec6'] != null) {echo $row_select_pipe['rec6'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['sur6'] != "" && $row_select_pipe['sur6'] != "0" && $row_select_pipe['sur6'] != null) {echo $row_select_pipe['sur6'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['len7'] != "" && $row_select_pipe['len7'] != "0" && $row_select_pipe['len7'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len7'] != "" && $row_select_pipe['len7'] != "0" && $row_select_pipe['len7'] != null) {echo $row_select_pipe['len7'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid7'] != "" && $row_select_pipe['wid7'] != "0" && $row_select_pipe['wid7'] != null) {echo $row_select_pipe['wid7'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk7'] != "" && $row_select_pipe['thk7'] != "0" && $row_select_pipe['thk7'] != null) {echo $row_select_pipe['thk7'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['str7'] != "" && $row_select_pipe['str7'] != "0" && $row_select_pipe['str7'] != null) {echo $row_select_pipe['str7'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['rec7'] != "" && $row_select_pipe['rec7'] != "0" && $row_select_pipe['rec7'] != null) {echo $row_select_pipe['rec7'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['sur7'] != "" && $row_select_pipe['sur7'] != "0" && $row_select_pipe['sur7'] != null) {echo $row_select_pipe['sur7'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['len8'] != "" && $row_select_pipe['len8'] != "0" && $row_select_pipe['len8'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len8'] != "" && $row_select_pipe['len8'] != "0" && $row_select_pipe['len8'] != null) {echo $row_select_pipe['len8'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid8'] != "" && $row_select_pipe['wid8'] != "0" && $row_select_pipe['wid8'] != null) {echo $row_select_pipe['wid8'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk8'] != "" && $row_select_pipe['thk8'] != "0" && $row_select_pipe['thk8'] != null) {echo $row_select_pipe['thk8'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['str8'] != "" && $row_select_pipe['str8'] != "0" && $row_select_pipe['str8'] != null) {echo $row_select_pipe['str8'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['rec8'] != "" && $row_select_pipe['rec8'] != "0" && $row_select_pipe['rec8'] != null) {echo $row_select_pipe['rec8'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['sur8'] != "" && $row_select_pipe['sur8'] != "0" && $row_select_pipe['sur8'] != null) {echo $row_select_pipe['sur8'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['len9'] != "" && $row_select_pipe['len9'] != "0" && $row_select_pipe['len9'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len9'] != "" && $row_select_pipe['len9'] != "0" && $row_select_pipe['len9'] != null) {echo $row_select_pipe['len9'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid9'] != "" && $row_select_pipe['wid9'] != "0" && $row_select_pipe['wid9'] != null) {echo $row_select_pipe['wid9'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk9'] != "" && $row_select_pipe['thk9'] != "0" && $row_select_pipe['thk9'] != null) {echo $row_select_pipe['thk9'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['str9'] != "" && $row_select_pipe['str9'] != "0" && $row_select_pipe['str9'] != null) {echo $row_select_pipe['str9'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['rec9'] != "" && $row_select_pipe['rec9'] != "0" && $row_select_pipe['rec9'] != null) {echo $row_select_pipe['rec9'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['sur9'] != "" && $row_select_pipe['sur9'] != "0" && $row_select_pipe['sur9'] != null) {echo $row_select_pipe['sur9'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['len10'] != "" && $row_select_pipe['len10'] != "0" && $row_select_pipe['len10'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len10'] != "" && $row_select_pipe['len10'] != "0" && $row_select_pipe['len10'] != null) {echo $row_select_pipe['len10'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid10'] != "" && $row_select_pipe['wid10'] != "0" && $row_select_pipe['wid10'] != null) {echo $row_select_pipe['wid10'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk10'] != "" && $row_select_pipe['thk10'] != "0" && $row_select_pipe['thk10'] != null) {echo $row_select_pipe['thk10'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['str10'] != "" && $row_select_pipe['str10'] != "0" && $row_select_pipe['str10'] != null) {echo $row_select_pipe['str10'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['rec10'] != "" && $row_select_pipe['rec10'] != "0" && $row_select_pipe['rec10'] != null) {echo $row_select_pipe['rec10'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['sur10'] != "" && $row_select_pipe['sur10'] != "0" && $row_select_pipe['sur10'] != null) {echo $row_select_pipe['sur10'];} else {echo "-";} ?></td>
            </tr>
			<?php }?>
			<tr>
                <td style="font-weight:bold;border: 1px solid black;text-align:center;width:10%;">Average</td>
                <td style="font-weight:bold;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avglen'] != "" && $row_select_pipe['avglen'] != "0" && $row_select_pipe['avglen'] != null) {echo $row_select_pipe['avglen'];} else {echo "-";} ?></td>
                <td style="font-weight:bold;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avgwid'] != "" && $row_select_pipe['avgwid'] != "0" && $row_select_pipe['avgwid'] != null) {echo $row_select_pipe['avgwid'];} else {echo "-";} ?></td>
                <td style="font-weight:bold;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avgthk'] != "" && $row_select_pipe['avgthk'] != "0" && $row_select_pipe['avgthk'] != null) {echo $row_select_pipe['avgthk'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;font-weight:bold;"><?php if ($row_select_pipe['avgstr'] != "" && $row_select_pipe['avgstr'] != "0" && $row_select_pipe['avgstr'] != null) {echo $row_select_pipe['avgstr'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;font-weight:bold;"><?php if ($row_select_pipe['avgrec'] != "" && $row_select_pipe['avgrec'] != "0" && $row_select_pipe['avgrec'] != null) {echo $row_select_pipe['avgrec'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;font-weight:bold;"><?php if ($row_select_pipe['avgsur'] != "" && $row_select_pipe['avgsur'] != "0" && $row_select_pipe['avgsur'] != null) {echo $row_select_pipe['avgsur'];} else {echo "-";} ?></td>
            </tr>
			
        </table>

        <?php } if (($row_select_pipe['avg_wtr_1'] != "" && $row_select_pipe['avg_wtr_1'] != "0" && $row_select_pipe['avg_wtr_1'] != null)) { ?>
		<br>
        <table align="center" height="25%;" width="100%" class="test" style="border: 1px solid black;margin-top:-1px;">
			<tr>
					<td style="border-top:1px solid black;border-bottom:1px solid black;text-align:center;padding: 1px 4px;width: 12.12%;font-size: 13px;text-transform: uppercase;" colspan="4"><b>WATER ABSORPTION(IS 13630 P-2)</b></td>
				</tr>
		   <tr>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:10%">Sr No</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:30%">Weight of Oven Dry <br> Sample in gm (A)</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:30%">Weight of Saturated <br> Surface Dry in gm (B)</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:30%">Water Absorption in % <br> = 100(B-A)/A</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">1</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_1'] != "" && $row_select_pipe['wtr_a_1'] != "0" && $row_select_pipe['wtr_a_1'] != null) {
                                                                            echo $row_select_pipe['wtr_a_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_1'] != "" && $row_select_pipe['wtr_b_1'] != "0" && $row_select_pipe['wtr_b_1'] != null) {
                                                                            echo $row_select_pipe['wtr_b_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != "0" && $row_select_pipe['wtr_1'] != null) {
                                                                            echo $row_select_pipe['wtr_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">2</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_2'] != "" && $row_select_pipe['wtr_a_2'] != "0" && $row_select_pipe['wtr_a_2'] != null) {
                                                                            echo $row_select_pipe['wtr_a_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_2'] != "" && $row_select_pipe['wtr_b_2'] != "0" && $row_select_pipe['wtr_b_2'] != null) {
                                                                            echo $row_select_pipe['wtr_b_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_2'] != "" && $row_select_pipe['wtr_2'] != "0" && $row_select_pipe['wtr_2'] != null) {
                                                                            echo $row_select_pipe['wtr_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">3</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_3'] != "" && $row_select_pipe['wtr_a_3'] != "0" && $row_select_pipe['wtr_a_3'] != null) {
                                                                            echo $row_select_pipe['wtr_a_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_3'] != "" && $row_select_pipe['wtr_b_3'] != "0" && $row_select_pipe['wtr_b_3'] != null) {
                                                                            echo $row_select_pipe['wtr_b_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_3'] != "" && $row_select_pipe['wtr_3'] != "0" && $row_select_pipe['wtr_3'] != null) {
                                                                            echo $row_select_pipe['wtr_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">4</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_4'] != "" && $row_select_pipe['wtr_a_4'] != "0" && $row_select_pipe['wtr_a_4'] != null) {echo $row_select_pipe['wtr_a_4'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_4'] != "" && $row_select_pipe['wtr_b_4'] != "0" && $row_select_pipe['wtr_b_4'] != null) {echo $row_select_pipe['wtr_b_4'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_4'] != "" && $row_select_pipe['wtr_4'] != "0" && $row_select_pipe['wtr_4'] != null) {echo $row_select_pipe['wtr_4'];} else {echo "-";} ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">5</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_5'] != "" && $row_select_pipe['wtr_a_5'] != "0" && $row_select_pipe['wtr_a_5'] != null) {echo $row_select_pipe['wtr_a_5'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_5'] != "" && $row_select_pipe['wtr_b_5'] != "0" && $row_select_pipe['wtr_b_5'] != null) {echo $row_select_pipe['wtr_b_5'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_5'] != "" && $row_select_pipe['wtr_5'] != "0" && $row_select_pipe['wtr_5'] != null) {echo $row_select_pipe['wtr_5'];} else {echo "-";} ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">6</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_6'] != "" && $row_select_pipe['wtr_a_6'] != "0" && $row_select_pipe['wtr_a_6'] != null) {echo $row_select_pipe['wtr_a_6'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_6'] != "" && $row_select_pipe['wtr_b_6'] != "0" && $row_select_pipe['wtr_b_6'] != null) {echo $row_select_pipe['wtr_b_6'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_6'] != "" && $row_select_pipe['wtr_6'] != "0" && $row_select_pipe['wtr_6'] != null) {echo $row_select_pipe['wtr_6'];} else {echo "-";} ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">7</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_7'] != "" && $row_select_pipe['wtr_a_7'] != "0" && $row_select_pipe['wtr_a_7'] != null) {echo $row_select_pipe['wtr_a_7'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_7'] != "" && $row_select_pipe['wtr_b_7'] != "0" && $row_select_pipe['wtr_b_7'] != null) {echo $row_select_pipe['wtr_b_7'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_7'] != "" && $row_select_pipe['wtr_7'] != "0" && $row_select_pipe['wtr_7'] != null) {echo $row_select_pipe['wtr_7'];} else {echo "-";} ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">8</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_8'] != "" && $row_select_pipe['wtr_a_8'] != "0" && $row_select_pipe['wtr_a_8'] != null) {echo $row_select_pipe['wtr_a_8'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_8'] != "" && $row_select_pipe['wtr_b_8'] != "0" && $row_select_pipe['wtr_b_8'] != null) {echo $row_select_pipe['wtr_b_8'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_8'] != "" && $row_select_pipe['wtr_8'] != "0" && $row_select_pipe['wtr_8'] != null) {echo $row_select_pipe['wtr_8'];} else {echo "-";} ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">9</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_9'] != "" && $row_select_pipe['wtr_a_9'] != "0" && $row_select_pipe['wtr_a_9'] != null) {echo $row_select_pipe['wtr_a_9'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_9'] != "" && $row_select_pipe['wtr_b_9'] != "0" && $row_select_pipe['wtr_b_9'] != null) {echo $row_select_pipe['wtr_b_9'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_9'] != "" && $row_select_pipe['wtr_9'] != "0" && $row_select_pipe['wtr_9'] != null) {echo $row_select_pipe['wtr_9'];} else {echo "-";} ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">10</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_10'] != "" && $row_select_pipe['wtr_a_10'] != "0" && $row_select_pipe['wtr_a_10'] != null) {echo $row_select_pipe['wtr_a_10'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_10'] != "" && $row_select_pipe['wtr_b_10'] != "0" && $row_select_pipe['wtr_b_10'] != null) {echo $row_select_pipe['wtr_b_10'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_10'] != "" && $row_select_pipe['wtr_10'] != "0" && $row_select_pipe['wtr_10'] != null) {echo $row_select_pipe['wtr_10'];} else {echo "-";} ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;"></td>
                <td style="border: 1px solid black;text-align:center;"></td>
                <td style="border: 1px solid black;text-align:right;font-weight:bold;">Average &nbsp; &nbsp;</td>
                <td style="border: 1px solid black;text-align:center;font-weight:bold;"><?php if ($row_select_pipe['avg_wtr_1'] != "" && $row_select_pipe['avg_wtr_1'] != "0" && $row_select_pipe['avg_wtr_1'] != null) {echo $row_select_pipe['avg_wtr_1'];} else {echo "-";} ?></td>
            </tr>
        </table>
        <br>
		
		<?php } ?>

        <table align="center" width="100%" class="test1" height="Auto" style="border-top:0px solid;">
				<tr>
					<td>
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
								<td style="height: 25px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>
						
						</table>
					</td>
				</tr>
				<!--<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  03</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue Date :-  <?php echo date('d/m/Y', strtotime($issue_date)); ?>   </td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Prepared & Issued By</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Reviewed & Approved By</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend No :-  01</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend Date :- <?php echo date('d-m-Y', strtotime($row_select_pipe["amend_date"])); ?></td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Quality Manager)</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Chief Executive Officer)</td>
							</tr>
							<tr>
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 1</td>
							</tr>
						
						</table>
					</td>
				</tr>-->
			</table>
		
<div class="pagebreak">
<br>		
<br>		
			
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: REE/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : 2</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:100px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style="" > OBSERVATION AND CALCULATION SHEET FOR TEST ON STEEL</td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;border-bottom:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-bottom:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-bottom:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
				
				
				
		<?php //if (($row_select_pipe['spl_avg1'] != "" && $row_select_pipe['spl_avg1'] != "0" && $row_select_pipe['spl_avg1'] != null)) { ?>		

       <br>
		<?php $cnt=1;?>
        <?php if ($row_select_pipe['brk1'] != "" && $row_select_pipe['brk1'] != "0" && $row_select_pipe['brk1'] != null) {?>
		<table align="center" height="25%" width="100%" class="test" style="border: 1px solid black;margin-top:-1px;">
<tr>
					<td style="border-top:1px solid black;border-bottom:1px solid black;text-align:center;padding: 1px 4px;width: 12.12%;font-size: 13px;text-transform: uppercase;" colspan="7"><b>PHYSICAL PROPERTIES</b></td>
				</tr>
			<tr>           
		   <tr>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:10%;">Sr No</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:15%;">Breaking Strength (N)</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:15%;">Modulus of Rupture (N/mm<sup>2</sup>)</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:15%;">Scratch Hardness of surface ( Moh's Scale )</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:15%;">Density (gm/cc)</td>
            </tr>
			<?php if ($row_select_pipe['brk1'] != "" && $row_select_pipe['brk1'] != "0" && $row_select_pipe['brk1'] != null) {?>
            <tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                 <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['brk1'] != "" && $row_select_pipe['brk1'] != "0" && $row_select_pipe['brk1'] != null) {echo $row_select_pipe['brk1'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['mod1'] != "" && $row_select_pipe['mod1'] != "0" && $row_select_pipe['mod1'] != null) {echo $row_select_pipe['mod1'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hrd1'] != "" && $row_select_pipe['hrd1'] != "0" && $row_select_pipe['hrd1'] != null) {echo $row_select_pipe['hrd1'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['den1'] != "" && $row_select_pipe['den1'] != "0" && $row_select_pipe['den1'] != null) {echo $row_select_pipe['den1'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['brk2'] != "" && $row_select_pipe['brk2'] != "0" && $row_select_pipe['brk2'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                 <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['brk2'] != "" && $row_select_pipe['brk2'] != "0" && $row_select_pipe['brk2'] != null) {echo $row_select_pipe['brk2'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['mod2'] != "" && $row_select_pipe['mod2'] != "0" && $row_select_pipe['mod2'] != null) {echo $row_select_pipe['mod2'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hrd2'] != "" && $row_select_pipe['hrd2'] != "0" && $row_select_pipe['hrd2'] != null) {echo $row_select_pipe['hrd2'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['den2'] != "" && $row_select_pipe['den2'] != "0" && $row_select_pipe['den2'] != null) {echo $row_select_pipe['den2'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['brk3'] != "" && $row_select_pipe['brk3'] != "0" && $row_select_pipe['brk3'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['brk3'] != "" && $row_select_pipe['brk3'] != "0" && $row_select_pipe['brk3'] != null) {echo $row_select_pipe['brk3'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['mod3'] != "" && $row_select_pipe['mod3'] != "0" && $row_select_pipe['mod3'] != null) {echo $row_select_pipe['mod3'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hrd3'] != "" && $row_select_pipe['hrd3'] != "0" && $row_select_pipe['hrd3'] != null) {echo $row_select_pipe['hrd3'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['den3'] != "" && $row_select_pipe['den3'] != "0" && $row_select_pipe['den3'] != null) {echo $row_select_pipe['den3'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['brk4'] != "" && $row_select_pipe['brk4'] != "0" && $row_select_pipe['brk4'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['brk4'] != "" && $row_select_pipe['brk4'] != "0" && $row_select_pipe['brk4'] != null) {echo $row_select_pipe['brk4'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['mod4'] != "" && $row_select_pipe['mod4'] != "0" && $row_select_pipe['mod4'] != null) {echo $row_select_pipe['mod4'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hrd4'] != "" && $row_select_pipe['hrd4'] != "0" && $row_select_pipe['hrd4'] != null) {echo $row_select_pipe['hrd4'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['den4'] != "" && $row_select_pipe['den4'] != "0" && $row_select_pipe['den4'] != null) {echo $row_select_pipe['den4'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['brk5'] != "" && $row_select_pipe['brk5'] != "0" && $row_select_pipe['brk5'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                 <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['brk5'] != "" && $row_select_pipe['brk5'] != "0" && $row_select_pipe['brk5'] != null) {echo $row_select_pipe['brk5'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['mod5'] != "" && $row_select_pipe['mod5'] != "0" && $row_select_pipe['mod5'] != null) {echo $row_select_pipe['mod5'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hrd5'] != "" && $row_select_pipe['hrd5'] != "0" && $row_select_pipe['hrd5'] != null) {echo $row_select_pipe['hrd5'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['den5'] != "" && $row_select_pipe['den5'] != "0" && $row_select_pipe['den5'] != null) {echo $row_select_pipe['den5'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['brk6'] != "" && $row_select_pipe['brk6'] != "0" && $row_select_pipe['brk6'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                 <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['brk6'] != "" && $row_select_pipe['brk6'] != "0" && $row_select_pipe['brk6'] != null) {echo $row_select_pipe['brk6'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['mod6'] != "" && $row_select_pipe['mod6'] != "0" && $row_select_pipe['mod6'] != null) {echo $row_select_pipe['mod6'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hrd6'] != "" && $row_select_pipe['hrd6'] != "0" && $row_select_pipe['hrd6'] != null) {echo $row_select_pipe['hrd6'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['den6'] != "" && $row_select_pipe['den6'] != "0" && $row_select_pipe['den6'] != null) {echo $row_select_pipe['den6'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['brk7'] != "" && $row_select_pipe['brk7'] != "0" && $row_select_pipe['brk7'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                 <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['brk7'] != "" && $row_select_pipe['brk7'] != "0" && $row_select_pipe['brk7'] != null) {echo $row_select_pipe['brk7'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['mod7'] != "" && $row_select_pipe['mod7'] != "0" && $row_select_pipe['mod7'] != null) {echo $row_select_pipe['mod7'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hrd7'] != "" && $row_select_pipe['hrd7'] != "0" && $row_select_pipe['hrd7'] != null) {echo $row_select_pipe['hrd7'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['den7'] != "" && $row_select_pipe['den7'] != "0" && $row_select_pipe['den7'] != null) {echo $row_select_pipe['den7'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['brk8'] != "" && $row_select_pipe['brk8'] != "0" && $row_select_pipe['brk8'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                 <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['brk8'] != "" && $row_select_pipe['brk8'] != "0" && $row_select_pipe['brk8'] != null) {echo $row_select_pipe['brk8'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['mod8'] != "" && $row_select_pipe['mod8'] != "0" && $row_select_pipe['mod8'] != null) {echo $row_select_pipe['mod8'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hrd8'] != "" && $row_select_pipe['hrd8'] != "0" && $row_select_pipe['hrd8'] != null) {echo $row_select_pipe['hrd8'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['den8'] != "" && $row_select_pipe['den8'] != "0" && $row_select_pipe['den8'] != null) {echo $row_select_pipe['den8'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['brk9'] != "" && $row_select_pipe['brk9'] != "0" && $row_select_pipe['brk9'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                 <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['brk9'] != "" && $row_select_pipe['brk9'] != "0" && $row_select_pipe['brk9'] != null) {echo $row_select_pipe['brk9'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['mod9'] != "" && $row_select_pipe['mod9'] != "0" && $row_select_pipe['mod9'] != null) {echo $row_select_pipe['mod9'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hrd9'] != "" && $row_select_pipe['hrd9'] != "0" && $row_select_pipe['hrd9'] != null) {echo $row_select_pipe['hrd9'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['den9'] != "" && $row_select_pipe['den9'] != "0" && $row_select_pipe['den9'] != null) {echo $row_select_pipe['den9'];} else {echo "-";} ?></td>
            </tr>
			<?php } if ($row_select_pipe['brk10'] != "" && $row_select_pipe['brk10'] != "0" && $row_select_pipe['brk10'] != null) {?>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                 <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['brk10'] != "" && $row_select_pipe['brk10'] != "0" && $row_select_pipe['brk10'] != null) {echo $row_select_pipe['brk10'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['mod10'] != "" && $row_select_pipe['mod10'] != "0" && $row_select_pipe['mod10'] != null) {echo $row_select_pipe['mod10'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hrd10'] != "" && $row_select_pipe['hrd10'] != "0" && $row_select_pipe['hrd10'] != null) {echo $row_select_pipe['hrd10'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['den10'] != "" && $row_select_pipe['den10'] != "0" && $row_select_pipe['den10'] != null) {echo $row_select_pipe['den10'];} else {echo "-";} ?></td>
            </tr>
			<?php }?>
			<tr>
                <td style="font-weight:bold;border: 1px solid black;text-align:center;width:10%;">Average</td>
                 <td style="border: 1px solid black;text-align:center;font-weight:bold;"><?php if ($row_select_pipe['avgbrk'] != "" && $row_select_pipe['avgbrk'] != "0" && $row_select_pipe['avgbrk'] != null) {echo $row_select_pipe['avgbrk'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;font-weight:bold;"><?php if ($row_select_pipe['avgmod'] != "" && $row_select_pipe['avgmod'] != "0" && $row_select_pipe['avgmod'] != null) {echo $row_select_pipe['avgmod'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;font-weight:bold;"><?php if ($row_select_pipe['avghrd'] != "" && $row_select_pipe['avghrd'] != "0" && $row_select_pipe['avghrd'] != null) {echo $row_select_pipe['avghrd'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;font-weight:bold;"><?php if ($row_select_pipe['avgden'] != "" && $row_select_pipe['avgden'] != "0" && $row_select_pipe['avgden'] != null) {echo $row_select_pipe['avgden'];} else {echo "-";} ?></td>
            </tr>
			
        </table>

        <?php} $cnt=1; if (($row_select_pipe['res1'] != "" && $row_select_pipe['res1'] != "0" && $row_select_pipe['res1'] != null)) { ?>
		<br>
        <table align="center" height="20%;" width="100%" class="test" style="border: 1px solid black;margin-top:-1px;">
			<tr>
					<td style="border-top:1px solid black;border-bottom:1px solid black;text-align:center;padding: 1px 4px;width: 12.12%;font-size: 13px;text-transform: uppercase;" colspan="4"><b>CHEMICAL PROPERTIES</b></td>
				</tr>
		   <tr>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:10%">Sr No</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:30%">Resistance to Staining of glazed tiles</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:30%">Resistance to Household Chemicals</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:30%">Resistance to Acid and Alkali</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['res1'] != "" && $row_select_pipe['res1'] != "0" && $row_select_pipe['res1'] != null) {
                                                                            echo $row_select_pipe['res1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hou1'] != "" && $row_select_pipe['hou1'] != "0" && $row_select_pipe['hou1'] != null) {
                                                                            echo $row_select_pipe['hou1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['alk1'] != "" && $row_select_pipe['alk1'] != "0" && $row_select_pipe['alk1'] != null) {
                                                                            echo $row_select_pipe['alk1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            
            <tr>
                <td style="border: 1px solid black;text-align:center;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['res2'] != "" && $row_select_pipe['res2'] != "0" && $row_select_pipe['res2'] != null) {echo $row_select_pipe['res2'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hou2'] != "" && $row_select_pipe['hou2'] != "0" && $row_select_pipe['hou2'] != null) {echo $row_select_pipe['hou2'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['alk2'] != "" && $row_select_pipe['alk2'] != "0" && $row_select_pipe['alk2'] != null) {echo $row_select_pipe['alk2'];} else {echo "-";} ?></td>
            </tr>
			<tr>
                <td style="border: 1px solid black;text-align:center;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['res3'] != "" && $row_select_pipe['res3'] != "0" && $row_select_pipe['res3'] != null) {echo $row_select_pipe['res3'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hou3'] != "" && $row_select_pipe['hou3'] != "0" && $row_select_pipe['hou3'] != null) {echo $row_select_pipe['hou3'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['alk3'] != "" && $row_select_pipe['alk3'] != "0" && $row_select_pipe['alk3'] != null) {echo $row_select_pipe['alk3'];} else {echo "-";} ?></td>
            </tr>
			<tr>
                <td style="border: 1px solid black;text-align:center;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['res4'] != "" && $row_select_pipe['res4'] != "0" && $row_select_pipe['res4'] != null) {echo $row_select_pipe['res4'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hou4'] != "" && $row_select_pipe['hou4'] != "0" && $row_select_pipe['hou4'] != null) {echo $row_select_pipe['hou4'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['alk4'] != "" && $row_select_pipe['alk4'] != "0" && $row_select_pipe['alk4'] != null) {echo $row_select_pipe['alk4'];} else {echo "-";} ?></td>
            </tr>
			<tr>
                <td style="border: 1px solid black;text-align:center;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['res5'] != "" && $row_select_pipe['res5'] != "0" && $row_select_pipe['res5'] != null) {echo $row_select_pipe['res5'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hou5'] != "" && $row_select_pipe['hou5'] != "0" && $row_select_pipe['hou5'] != null) {echo $row_select_pipe['hou5'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['alk5'] != "" && $row_select_pipe['alk5'] != "0" && $row_select_pipe['alk5'] != null) {echo $row_select_pipe['alk5'];} else {echo "-";} ?></td>
            </tr>
			
            <tr>
                <td style="border: 1px solid black;text-align:center;font-weight:bold;">Average</td>
               <td style="border: 1px solid black;text-align:center;font-weight:bold;"><?php if ($row_select_pipe['avgres'] != "" && $row_select_pipe['avgres'] != "0" && $row_select_pipe['avgres'] != null) {echo $row_select_pipe['avgres'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;font-weight:bold;"><?php if ($row_select_pipe['avghou'] != "" && $row_select_pipe['avghou'] != "0" && $row_select_pipe['avghou'] != null) {echo $row_select_pipe['avghou'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;font-weight:bold;"><?php if ($row_select_pipe['avgalk'] != "" && $row_select_pipe['avgalk'] != "0" && $row_select_pipe['avgalk'] != null) {echo $row_select_pipe['avgalk'];} else {echo "-";} ?></td>
            </tr>
        </table>
        <br>
		
		<?php } ?>

        <table align="center" width="100%" class="test1" height="Auto" style="border-top:0px solid;">
				<tr>
					<td>
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
								<td style="height: 25px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>
						
						</table>
					</td>
				</tr>
				<!--<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  03</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue Date :-  <?php echo date('d/m/Y', strtotime($issue_date)); ?>   </td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Prepared & Issued By</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Reviewed & Approved By</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend No :-  01</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend Date :- <?php echo date('d-m-Y', strtotime($row_select_pipe["amend_date"])); ?></td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Quality Manager)</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Chief Executive Officer)</td>
							</tr>
							<tr>
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 1</td>
							</tr>
						
						</table>
					</td>
				</tr>-->
			</table>
        
    </page>
	<?php //} ?>
</body>

</html>