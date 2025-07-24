<?php
session_start();
include("../connection.php");
include("function_calling.php");
error_reporting(1); ?>

<style>
	.tdclass {
		border: 1px solid black;
		
		font-family : Calibri;
	}

	.test {
		border-collapse: collapse;
		
		font-family : Calibri;
	}

	.tdclass1 {

		
		font-family : Calibri;
	}
</style>
<html>

<body>
	<?php
	/*$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
		 $select_tiles_query = "select * from wbm_53_22_4 WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
					include_once 'sample_id.php';
				}
				
			}
			
			 $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$source= $row_select4['agg_source'];
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
	<page size="A4" layout="landscape">
		<table align="center" width="90%" class="test" border="1px">
			<tr>
				<td colspan="12" style="font-size:13px">
					<center><b>Test Results of Cement </b></center>
				</td>

			</tr>
			<tr>
				<td colspan="6" rowspan="6" style="padding:5px;vertical-align: top;"><b>Forwarded to ;</b></td>
				<td colspan="6" rowspan="9"><b>Name Of Customer :</b><br><b> Name Of Work :</b><br><br><b>Ref. No. & Date:</b><br><b>Sample sent by:</b>Customer<br><b>Name Of Agency :</b>--</td>
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
				<td colspan="6" width="45%"><b>Date Of Sample Received : </b>0 </td>

				<td colspan="6" width="45%"><b>Type of Sample : </b>Paver Block </td>

			</tr>
			<tr>
				<td colspan="6" width="45%"><b>No. of Sample(s):</b>16 Nos.</td>

				<td colspan="6" width="45%"><b>Specification of Sample:</b> -- </td>

			</tr>
			<tr>
				<td colspan="6" width="45%"><b>Condition of Sample on Receipt:</b>Sealed Ok</td>

				<td colspan="6" width="45%"><b>Garde of Sample :</b></td>

			</tr>
			<tr>
				<td colspan="6" width="45%"><b>Name of Test:</b>As mentioned below</td>

				<td colspan="6" width="45%"><b>Brand of Sample:</b></td>

			</tr>
			<tr>
				<td colspan="6" width="45%"><b>Test Method Standard:</b>As mentioned below</td>

				<td colspan="6" width="45%"><b>Environmental Condition during test :</b>As per the test procedure</td>

			</tr>

			<tr>
				<td colspan="6" width="45%"><b>Date of Test Starting :</b></td>

				<td colspan="6" width="45%"><b>Date of Test Completion :</b></td>

			</tr>
			<tr>
				<td width="5%">
					<center><b>Sr.<br>No.</b></center>
				</td>
				<td width="35%" colspan="5">
					<center><b>Type of Test</b></center>
				</td>
				<td width="20%" colspan="2">
					<center><b>Test Method<br>Standard</b></center>
				</td>
				<td width="10%">
					<center><b>Results<br>obtained</b></center>
				</td>
				<td width="20%" colspan="2">
					<center><b>Specifications<br>As per IS - 269</b></center>
				</td>
				<td width="10%">
					<center><b>Remarks</b></center>
				</td>
			</tr>
			<tr>
				<td width="5%">
					<center><b>1</b></center>
				</td>
				<td width="35%" colspan="5"><b>Finesness</b></center>
				</td>
				<td width="20%" colspan="2">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2">
					<center></b></center>
				</td>
				<td width="10%" rowspan="14">
					<center></center>
				</td>
			</tr>
			<tr>
				<td width="5%">
					<center></center>
				</td>
				<td width="35%" colspan="5">a. By blaine air permeability method ( m2/kg)</td>
				<td width="20%" colspan="2">
					<center>IS - 4031-P-2</center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2">Min. 225 ( m2/Kg)</td>
			</tr>
			<tr>
				<td width="5%">
					<center></center>
				</td>
				<td width="35%" colspan="5">b. By dry sieving (%)</td>
				<td width="20%" colspan="2">
					<center>IS - 4031-P-1</center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2"></td>
			</tr>
			<tr>
				<td width="5%">
					<center><b>2</b></center>
				</td>
				<td width="35%" colspan="5"><b>Normal Consistency (%)</b></td>
				<td width="20%" colspan="2">
					<center>IS - 4031-P-4</center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2"></td>
			</tr>
			<tr>
				<td width="5%">
					<center><b>3</b></center>
				</td>
				<td width="35%" colspan="5"><b>Setting Time ( Minutes )</b></td>
				<td width="20%" colspan="2">
					<center>IS - 4031-P-5</center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2"></td>
			</tr>
			<tr>
				<td width="5%">
					<center><b></b></center>
				</td>
				<td width="35%" colspan="5">a. Initial</td>
				<td width="20%" colspan="2">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2">Min. 30</td>
			</tr>
			<tr>
				<td width="5%">
					<center><b></b></center>
				</td>
				<td width="35%" colspan="5">b. Final</td>
				<td width="20%" colspan="2">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2">Max. 600</td>
			</tr>
			<tr>
				<td width="5%">
					<center><b>4</b></center>
				</td>
				<td width="35%" colspan="5"><b>Soundness</b></td>
				<td width="20%" colspan="2">
					<center>IS - 4031-P-3</center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2"></td>
			</tr>
			<tr>
				<td width="5%">
					<center><b></b></center>
				</td>
				<td width="35%" colspan="5">a. Le-Chatelier Expansion (mm)</td>
				<td width="20%" colspan="2">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2">Max. 10 mm</td>
			</tr>
			<tr>
				<td width="5%">
					<center><b></b></center>
				</td>
				<td width="35%" colspan="5">b. Autoclave Expansion (%)</td>
				<td width="20%" colspan="2">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2">Max. 0.8 %</td>
			</tr>
			<tr>
				<td width="5%">
					<center><b>5</b></center>
				</td>
				<td width="35%" colspan="5"><b>Compressive Strength (Mpa)</b></td>
				<td width="20%" colspan="2">
					<center>IS - 4031-P-6</center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2"></td>
			</tr>
			<tr>
				<td width="5%">
					<center><b></b></center>
				</td>
				<td width="35%" colspan="5">a. 3 days ( 72 ± 1 hr. )</td>
				<td width="20%" colspan="2">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2">Min. 27</td>
			</tr>
			<tr>
				<td width="5%">
					<center><b></b></center>
				</td>
				<td width="35%" colspan="5">b. 7 days ( 168 ± 2. hr. )</td>
				<td width="20%" colspan="2">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2">Min. 27</td>
			</tr>
			<tr>
				<td width="5%">
					<center><b></b></center>
				</td>
				<td width="35%" colspan="5">C. 28 days ( 672 ± 4. hr. )</td>
				<td width="20%" colspan="2">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2">Min. 53</td>
			</tr>
			<tr>
				<td width="5%">
					<center><b>6</b></center>
				</td>
				<td width="35%" colspan="5"><b>Chemical Properties</b></td>
				<td width="20%" colspan="2">
					<center>IS - 4031-P-6</center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2">Min. 53</td>
				<td width="10%" rowspan="7">
					<center></center>
				</td>
			</tr>
			<tr>
				<td width="5%">
					<center><b></b></center>
				</td>
				<td width="35%" colspan="5">a. Ratio Percentage CaO-0.7 SO₃ 2.8 SiO₂ + 1.2 Al₂O₃ + 0.65 Fe₃O</td>
				<td width="20%" colspan="2">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2">Not more than 1.02 and not <br>less than 0.8</td>

			</tr>
			<tr>
				<td width="5%">
					<center><b></b></center>
				</td>
				<td width="35%" colspan="5">b. Ratio of % Alumina (CA) to that of Iron oxide</td>
				<td width="20%" colspan="2">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2">More than 0.66</td>
			</tr>
			<tr>
				<td width="5%">
					<center><b></b></center>
				</td>
				<td width="35%" colspan="5">c.Insoluble residue % by Mass</td>
				<td width="20%" colspan="2">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2">Not more than 2</td>
			</tr>
			<tr>
				<td width="5%">
					<center><b></b></center>
				</td>
				<td width="35%" colspan="5">d. Magnesia % by Mass</td>
				<td width="20%" colspan="2">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2">Not more than 6</td>
			</tr>
			<tr>
				<td width="5%">
					<center><b></b></center>
				</td>
				<td width="35%" colspan="5">e. Total Loss on Ignition %</td>
				<td width="20%" colspan="2">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2">Not more than 4</td>
			</tr>
			<tr>
				<td width="5%">
					<center><b></b></center>
				</td>
				<td width="35%" colspan="5">f.Total Sulphur content calculated as Sulphuric anhydride (S₃O) % by Mass</td>
				<td width="20%" colspan="2">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="20%" colspan="2">Not more than 2.5 & 3 when tricalcium Aluminate % by mass is 5 or Less & grater than 5 respectively</td>
			</tr>
			<tr>
				<td style="transform: rotate(270deg);">
					<center><B>NOTES</B></center>
				</td>
				<td colspan="8"> * The test result relates to the samples submitted by Customer/Agency.<br>* The Results / Reports are issued with specific understanding that Span Infrastructure will not<br>&nbsp;&nbsp;&nbsp; in way be involved in acting following interpretation of the test results.<br> * The Results / Reports are not supposed to be used for publicity.</td>
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