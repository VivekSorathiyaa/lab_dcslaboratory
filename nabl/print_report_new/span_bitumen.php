<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<!--style>
@page { margin: 0; }
.pagebreak { page-break-before: always; }
page[size="A4"] {
  width: 21cm;
  height: 29.7cm;  
} 

</style-->
<style>
	.tdclass {
		border: 1px solid black;
		
		font-family: arial;
	}

	.test {
		border-collapse: collapse;
		
		font-family: arial;
	}

	.tdclass1 {

		
		font-family: arial;
	}
</style>
<html>

<body>
	<?php
	/*$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
		 $select_tiles_query = "select * from span_paver_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);	
				
			 $select_query = "select * from job WHERE `report_no`='$report_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn,$select_query);				
			
			$row_select = mysqli_fetch_array($result_select);
			$clientname= $row_select['clientname'];
			$r_name= $row_select['refno'];
			$sr_no= $row_select['sr_no'];
			$sample_no= $row_select['job_no'];
			$rec_sample_date= $row_select['sample_rec_date'];	
			$cons= $row_select['condition_of_sample_receved'];			
			if($cons == 0)
			{
				$con_sample = "Sealed Ok";
			}
			else
			{
				$con_sample = "Unsealed";
			}
			$name_of_work= strip_tags(html_entity_decode($row_select['nameofwork']),"<strong><em>");						

			$select_query1 = "select * from agency_master WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
			$result_select1 = mysqli_query($conn, $select_query1);

			if (mysqli_num_rows($result_select1) > 0) {
				$row_select1 = mysqli_fetch_assoc($result_select1);
				$agency_name= $row_select1['agency_name'];
			}
			
			$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
			$result_select2 = mysqli_query($conn, $select_query2);

			if (mysqli_num_rows($result_select2) > 0) {
				$row_select2 = mysqli_fetch_assoc($result_select2);
				$start_date= $row_select2['start_date'];
				$end_date= $row_select2['end_date'];
								
				$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'"; 
				$result_select3 = mysqli_query($conn, $select_query3);

				if (mysqli_num_rows($result_select3) > 0) {
					$row_select3 = mysqli_fetch_assoc($result_select3);
					$mt_name= $row_select3['mt_name'];
				}
				
			}
			
			 $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$paver_shape= $row_select4['paver_shape'];
					$paver_age= $row_select4['paver_age'];
					$paver_color= $row_select4['paver_color'];
					$paver_thickness= $row_select4['paver_thickness'];
					$paver_grade= $row_select4['paver_grade'];
				}
				*/

	?>

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
	<page size="A4">
		<table align="center" width="90%" height="80%" class="test" border="1px">
			<tr>
				<td colspan="12" style="font-size:13px">
					<center><b>Test Results of Bituminous Material</b></center>
				</td>

			</tr>
			<tr>
				<td colspan="6" rowspan="6" style="padding:5px;vertical-align: top;"><b>Forwarded to ;</b>&nbsp;&nbsp; <?php if ($sent_by == 0) {
																															echo $clientname;
																														} else {
																															echo $agency_name;
																														}
																														?></td>

				<td colspan="8" rowspan="9">
					<b>Name Of Customer :</b> &nbsp;&nbsp;<?php echo $clientname; ?>
					<br>
					<b> Name Of Work :</b>&nbsp;&nbsp;<?php echo $name_of_work; ?>
					<br>
					<br>
					<b>Ref.No.& Date :</b>&nbsp;&nbsp;<?php echo $r_name; ?>
					<br>
					<b>Sample Sent By :</b> Customer
					<br>
					<b>Name Of Agency :</b>&nbsp;&nbsp;<?php echo $agency_name; ?>
				</td>


			</tr>
			<tr>
			</tr>
			<tr>
			</tr>
			<tr>
			</tr>
			<tr>
			</tr>
			<tr>
			</tr>
			<tr>
				<td colspan="6" rowspan="3"><b>Report No :</b><br><b>Page :</b>1 of 1<br><b>Date :</b></td>
			</tr>
			<tr>
			</tr>
			<tr>
			</tr>

			<tr>
				<td colspan="6" width="45%"><b>Date Of Sample Received : </b></td>

				<td colspan="6" width="45%"><b>Type of Sample : </b></td>

			</tr>
			<tr>
				<td colspan="6" width="45%"><b>No. of Sample(s):</b></td>

				<td colspan="6" width="45%"><b>Specification of Sample:</b>--</td>

			</tr>
			<tr>
				<td colspan="6" width="45%"><b>Condition of Sample on Receipt:</b>Sealed Ok</td>

				<td colspan="6" width="45%"></td>

			</tr>
			<tr>
				<td colspan="6" width="45%"><b>Name of Test:</b>As mentioned below</td>

				<td colspan="6" width="45%"><b>Source of Sample :</b>--</td>

			</tr>
			<tr>
				<td colspan="6" width="45%"><b>Test Method Standard:</b>As mentioned below</td>

				<td colspan="6" width="45%"><b>Grade of Sample:</b></td>

			</tr>

			<tr>
				<td colspan="6" width="45%"><b>Environmental Condition during test :</b>As per the test procedure</td>

				<td colspan="6" width="45%"></td>

			</tr>
			<tr>
				<td colspan="6" width="45%"><b>Date of Test Starting :</b></td>

				<td colspan="6" width="45%"><b>Date of Test Completion :</b></td>

			</tr>
			<tr>
				<td width="8%">
					<center><b>Sr.<br>No.</b></center>
				</td>
				<td colspan="3" width="30%">
					<center><b>Type of Test</b></center>
				</td>
				<td colspan="2" width="13%">
					<center><b>Test Method<br>Standard</b></center>
				</td>
				<td colspan="2" width="13%">
					<center><b>Test Results<br>Obtained</b></center>
				</td>
				<td colspan="2" width="13%">
					<center><b>Specific Limits<br>as per IS - 73</b></center>
				</td>
				<td colspan="2" width="13%">
					<center><b>Remark</b></center>
				</td>
			</tr>
			<tr>
				<td width="8%">
					<center>1</center>
				</td>
				<td colspan="3" width="30%">Specific Gravity at 27 0 c</td>
				<td colspan="2" width="13">
					<center>IS : 1202</center>
				</td>
				<td colspan="2" width="13">
					<center>--</center>
				</td>
				<td colspan="2" width="13">
					<center>Min 0.99</center>
				</td>
				<td colspan="2" width="13" rowspan="7">
					<center></center>
				</td>
			</tr>
			<tr>
				<td width="8%">
					<center>2</center>
				</td>
				<td colspan="3" width="30%">Penetration(1/10mm) at 25 0c,5sec.,100 g</td>
				<td colspan="2" width="13">
					<center>IS : 1203</center>
				</td>
				<td colspan="2" width="13">
					<center></center>
				</td>
				<td colspan="2" width="13">
					<center>Min 45 mm</center>
				</td>

			</tr>
			<tr>
				<td width="8%">
					<center>3</center>
				</td>
				<td colspan="3" width="30%">Ductility (cm) at 27 0 c</td>
				<td colspan="2" width="13">
					<center>IS : 1208</center>
				</td>
				<td colspan="2" width="13">
					<center></center>
				</td>
				<td colspan="2" width="13">
					<center>Min 75 Cm</center>
				</td>

			</tr>
			<tr>
				<td width="8%">
					<center>4</center>
				</td>
				<td colspan="3" width="30%">Softening Point (0c)</td>
				<td colspan="2" width="13">
					<center>IS : 1205</center>
				</td>
				<td colspan="2" width="13">
					<center></center>
				</td>
				<td colspan="2" width="13">
					<center>45-55</center>
				</td>

			</tr>
			<tr>
				<td width="8%">
					<center>5</center>
				</td>
				<td colspan="3" width="30%">Absolute viscosity at 60°C, Poises</td>
				<td colspan="2" width="13">
					<center>IS: 1206- P-2</center>
				</td>
				<td colspan="2" width="13">
					<center></center>
				</td>
				<td colspan="2" width="13">
					<center>Min 2400</center>
				</td>

			</tr>
			<tr>
				<td width="8%">
					<center>6</center>
				</td>
				<td colspan="3" width="30%">Kinematic viscosity at 135°C, cSt, Min</td>
				<td colspan="2" width="13">
					<center>IS: 1206- P-3</center>
				</td>
				<td colspan="2" width="13">
					<center></center>
				</td>
				<td colspan="2" width="13">
					<center>Min 350</center>
				</td>

			</tr>
			<tr>
				<td width="8%">
					<center>7</center>
				</td>
				<td colspan="3" width="40%">Loss on Heating by Thin Film Oven</td>
				<td colspan="2" width="13">
					<center>IS: 1212</center>
				</td>
				<td colspan="2" width="13">
					<center></center>
				</td>
				<td colspan="2" width="13">
					<center>Max 1%</center>
				</td>

			</tr>
			<tr>
				<td style="transform: rotate(270deg);">
					<center><B>NOTES</B></center>
				</td>
				<td colspan="7"> * The test result relates to the samples submitted by Customer/Agency.<br>* The Results / Reports are issued with specific understanding that Span Infrastructure will not<br>&nbsp;&nbsp;&nbsp; in way be involved in acting following interpretation of the test results.<br> * The Results / Reports are not supposed to be used for publicity.</td>
				<td colspan="4">
					<center>for <b>Span Infrastructure</b><br><br><br>Authorised Signatory</center>
				</td>
			</tr>


		</table>


		<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">

	</page>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$("#print_button").on("click", function() {
		$('#print_button').hide();
		window.print();
	});
</script>