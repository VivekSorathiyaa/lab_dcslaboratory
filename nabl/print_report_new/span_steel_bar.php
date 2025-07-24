<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<!--style>
@page { margin: 0; }
.pagebreak { page-break-before: always; }
page[size="A4"][layout="lanscape"] {
  width: 29.7cm;
  height: 21cm;  
}
@media print{@page {size: landscape}}
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
		 $select_tiles_query = "select * from wbm_45_90_mm WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		<table align="center" width="80%" class="test" border="1px">
			<tr>
				<td colspan="12" style="font-size:13px">
					<center><b>Test Results of TMT Steel Bar</b></center>
				</td>

			</tr>
			<tr>
				<td colspan="6" rowspan="6" style="padding:5px;vertical-align: top;"><b>Forwarded to ;</b></td>


				<td colspan="8" rowspan="9"><b>Name Of Customer :</b><br><b> Name Of Work :</b><br><br><b>Ref.No.& Date :</b><br><b>Sample Sent By :</b> Customer<br><b>Name Of Agency :</b>
					<br><b>Agreement No.:</b>
					<br><b>Structure(s) Name :</b>
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
				<td colspan="6" rowspan="3" width="45%"><b>Report No :</b>&nbsp;&nbsp;<?php echo $report_no; ?><br><b>Page :</b>1 of 1<br><b>Date :</b>&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($end_date)); ?></td>
			</tr>
			<tr>
			</tr>
			<tr>
			</tr>

			<tr>
				<td colspan="6"><b>Date Of Sample Received : </b></td>

				<td colspan="6"><b>Type Of Sample : </b> TMT Steel Bar</td>

			</tr>
			<tr>
				<td colspan="6"><b>No. of Sample(S):</b></td>

				<td colspan="6"><b>Diameter of Sample :</b></td>

			</tr>
			<tr>
				<td colspan="6"><b>Condition of Sample on Receipt :</b>Satisfactory</td>

				<td colspan="6"><b>Specification of Sample :</b></td>

			</tr>
			<tr>
				<td colspan="6"><b>Name of Test :</b>As mentioned below</td>

				<td colspan="6"><b>Grade of Sample :</b></td>

			</tr>
			<tr>
				<td colspan="6"><b>Test Method Standard :</b>As mentioned below</td>

				<td colspan="6"><b>Environmental Condition During Test :</b>As Par the test</td>

			</tr>
			<tr>
				<td colspan="6"><b>Date of Test Standard :</b></td>

				<td colspan="6"><b>Date of Test Completion</b></td>

			</tr>
		</table>
		<br>
		<table align="center" width="80%" class="test">
			<tr>

				<td colspan="12">
					<center><b>Test Result</b></center>
				</td>

			</tr>
		</table>
		<table align="center" width="80%" class="test" border="1px">
			<tr>

				<td>
					<center><b>Sample ID</b></center>
				</td>
				<td>
					<center><b>Diia(mm)</b></center>
				</td>
				<td>
					<center><b>Mass per Meter(Kg/m)</b></center>
				</td>
				<td>
					<center><b>Yield Stress<br>N/mm<sup>2</sup></b></center>
				</td>
				<td>
					<center><b>Ultimate Tensile<br>Strength N/mm<sup>2</sup></b></center>
				</td>
				<td>
					<center><b>Elongation %</b></center>
				</td>
				<td>
					<center><b>Bend Test</b></center>
				</td>
				<td>
					<center><b>Rebend Test</b></center>
				</td>

			</tr>
			<tr>

				<td>
					<center>1</center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>

			</tr>
			<tr>

				<td>
					<center>2</center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>

			</tr>
			<tr>

				<td>
					<center>3</center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>

			</tr>
			<tr>

				<td>
					<center>4</center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>

			</tr>
			<tr>

				<td>
					<center>5</center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>

			</tr>
			<tr>

				<td>
					<center>6</center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>
				<td>
					<center></center>
				</td>

			</tr>
			<tr>

				<td>
					<center>Test Method</center>
				</td>
				<td>
					<center>-</center>
				</td>
				<td>
					<center>IS:1786,RA 2013</center>
				</td>
				<td>
					<center>IS:1608,RA<br>2005</center>
				</td>
				<td>
					<center>IS:1608,RA<br>2005</center>
				</td>
				<td>
					<center>IS:1786,RA<br>2013</center>
				</td>
				<td>
					<center>IS:1599,RA<br>2012</center>
				</td>
				<td>
					<center>IS:1786,RA<br>2013</center>
				</td>

			</tr>
		</table>
		<br>
		<table align="center" width="80%" class="test">
			<tr>
				<td>
					<center><b>Requirement as per I.S.1786-2008,Clause 6.3 &7.2.3 (Reaffirmed 2013) </b></center>
				</td>
			</tr>
		</table>
		<table align="center" width="80%" class="test" height="10%" border="1px">
			<tr>

				<td colspan="2" width="20%">
					<center><b>Diameter(MM)</b></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>

			</tr>
			<tr>

				<td colspan="2" width="20%">
					<center><b>Mass par<br>Meter(Kg/m)<b></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>
				<td width="10%">
					<center></center>
				</td>

			</tr>
			<tr>

				<td colspan="2" width="20%">
					<center><b>Tolerances on Nominal Mass<b></center>
				</td>
				<td width="20%" colspan="2">
					<center></center>
				</td>
				<td width="20%" colspan="2">
					<center></center>
				</td>
				<td width="30%" colspan="3">
					<center></center>
				</td>
			</tr>
		</table>
		<br>
		<table align="center" width="80%" class="test">
			<tr>
				<td>
					<center><b>Requirement as per I.S.1786-2008,Clause 9.1 Table-3 (Reaffirmed 2013)</b></center>
				</td>
			</tr>
		</table>
		<table align="center" width="80%" class="test" height="10%" border="1px">
			<tr>
				<td width="24%">
					<center>Grade</center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
			</tr>
			<tr>
				<td width="24%">
					<center>Yield Stress N/mm<sup>2</sup></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
			</tr>
			<tr>
				<td width="24%">
					<center>Ultimate Tensile Stress N/mm<sup>2</sup></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
			</tr>
			<tr>
				<td width="24%">
					<center>Elongation %</center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
				<td width="11%">
					<center></center>
				</td>
			</tr>
		</table>
		<br>
		<table align="center" width="80%" class="test" height="10%" border="1px">
			<tr>
				<td style="transform: rotate(270deg);">
					<center><B>NOTES</B></center>
				</td>
				<td colspan="8"> * The test result relates to the samples submitted by Customer/Agency.<br>* The Results / Reports are issued with specific understanding that Span Infrastructure will not<br>&nbsp;&nbsp;&nbsp; in way be involved in acting following interpretation of the test results.<br> * The Results / Reports are not supposed to be used for publicity.</td>
				<td colspan="3">
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