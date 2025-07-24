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
    $select_tiles_query = "select * from slump_test WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
        $source = $row_select4['agg_source'];
        $mark = $row_select4['mark'];
        $brick_specification = $row_select4['brick_specification'];
    }
    ?>

	<br>
	<br>
	<br>
		<page size="A4">
			
		<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse; ">
            <!-- header design -->
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
                        <tr>
                            <td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">MIX DESIGN</td>
                        </tr>
                        <tr>
                            <td style="padding: 1px;border: 1px solid;"></td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;">SLUMP TEST</td>
                        </tr>
                        <tr>
                            <td style="padding: 1px;border: 1px solid;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Format No :-</td>
                            <td style="padding: 5px;">ICT-SLUMP-TST-01</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Job No :-</td>
                            <td style="padding: 5px;"><?php echo $sample_id;?></td>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Testing Date :-</td>
                            <td style="padding: 5px;"><?php echo $start_date;?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Material Description :-</td>
                            <td style="padding: 5px;"><?php echo $mt_name;?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="padding: 1px;border: 1px solid;" colspan="4"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 8%;">Reference Code :-</td>
                            <td style="padding: 5px;border-left: 1px solid;">IS:516:2021, IS:1199:2018, (Part-02),</td>
                        </tr>
                        <tr>
                            <td style="padding: 1px;border: 1px solid;" colspan="2"></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;font-weight: bold;text-align: center;padding: 5px;border-top: 0;width: 8%;" colspan="2">Results:</td>
                        </tr>
                        <tr>
                            <td style="padding: 1px;border: 1px solid;" colspan="2"></td>
                        </tr>
                        <tr>
                            <td style="padding: 1px;border: 1px solid;" colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                        <td style="font-weight: bold;text-align: left;padding: 5px;border: 1px solid; border-bottom:0px solid; width:20%;"><b> MIX DESIGN GRADE :-</b></td>
                        <td style="padding: 5px;">M :- &nbsp<?php echo $row_select_pipe['slm_temp'];?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- table design -->
            <tr>
                <td>
                    <?php $cnt=1; ?>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">

                    <tr>
                        <td style="border:1px solid; text-align:center; font-size:14px; padding:5px;" colspan="16">
                           <b> Proportion Used</b>
                        </td>
                    </tr>
                        
                        <tr style="height:40px;">
                            <td style="width:9%; font-weight: bold;text-align: center;padding: 5px;border: 1px solid;border-bottom: 1px solid;" rowspan="2" >Proportion</td>
                            <td style="width:9%; font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"rowspan="2" >Water</td>
							<td style="width:9%; font-weight: bold;text-align: center;padding: 5px;border: 1px solid;" rowspan="2">Cement</td>
							<td style="width:9%; font-weight: bold;text-align: center;padding: 5px;border: 1px solid;" rowspan="2">Flaysh</td>
							<td style="width:9%; font-weight: bold;text-align: center;padding: 5px;border: 1px solid;" rowspan="2">Admixure</td>
                            <td style="width:36%; font-weight: bold;text-align: center;padding: 5px;border: 1px solid;" colspan="4"> Aggregates</td>
								
                        </tr>
                        
                        <tr style="height:40px;">
							<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;" >Sand</td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;" >40mm</td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;" >20mm</td>
							<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;" >10mm</td>
                        </tr>

                   
                    <tr style="height:40px;">
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; height:40%;">Proportion</td>
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $row_select_pipe['or_1'];?></td>
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $row_select_pipe['or_2'];?></td>
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $row_select_pipe['or_3'];?></td>
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $row_select_pipe['or_4'];?></td>
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $row_select_pipe['sl_3'];?></td>
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $row_select_pipe['sl_4'];?></td>
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $row_select_pipe['sl_5'];?></td>
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $row_select_pipe['sl_6'];?></td>
                    </tr>
                   
                    <tr style="height:40px;">
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; height:40%;">By Weight (Kg)</td>
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $row_select_pipe['or_1'];?></td>
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $row_select_pipe['or_2'];?></td>
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $row_select_pipe['or_3'];?></td>
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $row_select_pipe['or_4'];?></td>
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $row_select_pipe['sl_3'];?></td>
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $row_select_pipe['sl_4'];?></td>
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $row_select_pipe['sl_5'];?></td>
                    <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $row_select_pipe['sl_6'];?></td>
                    </tr>
                    </table>
                    
                </td>
            </tr>
            
           
            
            
           
			<!-- footer design -->
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2'];?></td>
			</tr> -->
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>
                </td>
            </tr>
            
        </table>


		</page>

</body>

</html>

<script type="text/javascript">


</script>