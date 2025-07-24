<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<!--style>
@page {  size: 4in 6in;
       margin:auto;
       margin-left: 40px;
       margin-right: 0px;
       margin-top: 0px;
       margin-bottom: 5px;
       padding-top:10px;  } 
.pagebreak { page-break-before: always; }

@media print{@page {size: landscape}}
</style-->
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 11px;
		font-family : Calibri;
	}

	.test {
		border-collapse: collapse;
		font-size: 11px;
		font-family : Calibri;
	}

	.tdclass1 {

		font-size: 11px;
		font-family : Calibri;
	}
</style>
<html>

<body>
	<?php
	/*$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
		 $select_tiles_query = "select * from bc_19_0_075_mm WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
				$issue_date= $row_select2['issue_date'];
								
				$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'"; 
				$result_select3 = mysqli_query($conn, $select_query3);

				if (mysqli_num_rows($result_select3) > 0) {
					$row_select3 = mysqli_fetch_assoc($result_select3);
					$detail_sample= $row_select3['mt_name'];
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


	<page size="A4" layout="landscape">
		<table align="center" width="90%" class="test" height="12%" border="1px">
			<tr>
				<td colspan="12" style="font-size:13px"><b>Shree Soil Material Testing Lab</b></td>
			</tr>
			<tr>
				<td colspan="8"><b>Work sheet for Determination of Penetration and Softening Point for Tar and Bituminous Material</b></td>
				<td colspan="4"><b>F/Material/13, Issue No. 01,Page No. 1 of 1</b></td>
			</tr>
			<tr>
				<td colspan="6" width="45%">Sample ID No:</td>
				<td colspan="6" width="45%">Sample Receive date:</td>
			</tr>
			<tr>
				<td colspan="6" width="45%">Type of Material:</td>
				<td colspan="6" width="45%">Sample Testing date:</td>
			</tr>
			<tr>
				<td colspan="6" width="45%">Condition of sample:</td>
				<td colspan="6" width="45%">Grade of Bitumen:</td>
			</tr>
		</table>
		<br>
		<br>
		<table align="center" width="90%" class="test">
			<tr>
				<td colspan="12"><b>Determination of Penetration (IS : 1203)</b></td>

			</tr>
		</table>
		<table align="center" width="90%" height="12%" class="test" border="1px">
			<tr>
				<td colspan="7" width="50%">Pouring temperature, ° C</td>
				<td colspan="5" width="40%"></td>
			</tr>
			<tr>
				<td colspan="7" width="50%">Period of cooling in atmosphere, Hours</td>
				<td colspan="5" width="40%"></td>
			</tr>
			<tr>
				<td colspan="7" width="50%">Period of cooling in water bath, Hours</td>
				<td colspan="5" width="40%"></td>
			</tr>
			<tr>
				<td colspan="7" width="50%">Actual test temperature, ° C</td>
				<td colspan="5" width="40%"></td>
			</tr>
			<tr>
				<td colspan="7" width="50%">Diameter of Container (mm)</td>
				<td colspan="5" width="40%"></td>
			</tr>
			<tr>
				<td colspan="7" width="50%">Internal Depth of Container (mm)</td>
				<td colspan="5" width="40%"></td>
			</tr>
			<tr>
				<td colspan="7" width="50%">Weight placed on the niddle</td>
				<td colspan="5" width="40%"></td>
			</tr>
			<tr>
				<td colspan="7" width="50%">Duration of releasing the penetration needle</td>
				<td colspan="5" width="40%"></td>
			</tr>
		</table>
		<br>
		<br>
		<table align="center" width="90%" class="test">
			<tr>
				<td colspan="12"><b>Test Result:</b></td>

			</tr>
		</table>
		<table align="center" width="90%" height="12%" border="1px" class="test">
			<tr>
				<td rowspan="2"><b>
						<center>Determination</center>
					</b></td>
				<td colspan="3"><b>
						<center>Penetration dial reading</center>
					</b></td>
				<td><b>
						<center>Average Penetration value<br>(1/10mm)</center>
					</b></td>

			</tr>
			<tr>

				<td>
					<center><b>Initial</b></center>
				</td>
				<td>
					<center><b>Final</b></center>
				</td>
				<td>
					<center><b>Penetration<br>value (1/10mm)</b></center>
				</td>
				<td rowspan="4">
					<center></center>
				</td>


			</tr>
			<tr>
				<td>
					<center>Determination-1</center>
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
					<center>Determination-2</center>
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
					<center>Determination-3</center>
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
		</table>
		<br>
		<br>
		<table align="center" width="90%" class="test">
			<tr>
				<td colspan="12"><b>Determination of Softening Point (IS : 1205) </b></td>

			</tr>
		</table>
		<table align="center" width="90%" height="12%" class="test" border="1px">
			<tr>
				<td colspan="7" width="50%">Liquid used in the bath</td>
				<td colspan="5" width="40%">Water/ Glycerin</td>
			</tr>
			<tr>
				<td colspan="7" width="50%">Pouring temperature, ° C</td>
				<td colspan="5" width="40%"></td>
			</tr>
			<tr>
				<td colspan="7" width="50%">Period of cooling in atmosphere, minutes</td>
				<td colspan="5" width="40%"></td>
			</tr>
			<tr>
				<td colspan="7" width="50%">Period of cooling in water bath, minutes</td>
				<td colspan="5" width="40%"></td>
			</tr>
		</table>
		<br>
		<br>
		<table align="center" width="90%" class="test">
			<tr>
				<td colspan="12"><b>Test Result:</b></td>

			</tr>
		</table>
		<table align="center" height="12%" width="90%" border="1px" class="test">
			<tr>
				<td><b>
						<center>Test property</center>
					</b></td>
				<td><b>
						<center>Ball No. 1</center>
					</b></td>
				<td><b>
						<center>Ball No. 2</center>
					</b></td>
				<td><b>
						<center>Mean value, Softening point,<br>° C</center>
					</b></td>

			</tr>
			<tr>
				<td>Temperature° C at which sample<br>touches bottom plate</td>
				<td></td>
				<td></td>
				<td></td>

			</tr>
		</table>
		<br>
		<br>
		<table align="center" width="90%" border="1px" class="test">
			<tr>
				<td colspan="2"><b>Tested by:</b></td>
				<td colspan="2"><b>Checked by:</b></td>
			</tr>

		</table>
		<!-------------------------------------->
		<div class="pagebreak"></div>
		<br>
		<br>
		<br>
		<br>
		<br>
		<table align="center" width="90%" border="1px" height="13%" class="test">
			<tr>
				<td colspan="12">
					<center><b>Shree Soil Material Testing Lab</b></center>
				</td>
			</tr>
			<tr>
				<td colspan="9" width="65%">Work sheet for Determination of Specific Gravity
					and Ductility Bituminous Material</td>
				<td colspan="3" width="25%">F/Material/14, Issue No. 01,
					Page No. 1 of 1</td>
			</tr>
			<tr>
				<td colspan="6" width="45%">Sample ID No:</td>
				<td colspan="6" width="45%">Sample Receive date:</td>
			</tr>
			<tr>
				<td colspan="6" width="45%">Type of Material:</td>
				<td colspan="6" width="45%">Sample Testing date:</td>
			</tr>
			<tr>
				<td colspan="6" width="45%">Condition of sample:</td>
				<td colspan="6" width="45%">Grade of Bitumen:</td>
			</tr>
		</table>
		<br>
		<br>
		<table align="center" width="90%" class="test">
			<tr>
				<td colspan="12"><b>Determination of Specific gravity (IS 1202) </b></td>
			</tr>
			<tr>
				<td colspan="12"><b>Test temperature °C :</b></td>
			</tr>
		</table>
		<table align="center" width="90%" height="13%" border="1px" class="test">
			<tr>
				<td width="10%"><b>
						<center>Sr.<br>No.</center>
					</b></td>
				<td colspan="5" width="60%"><b>
						<center>Particulars</center>
					</b></td>
				<td colspan="2" width="20%"><b>
						<center>Observation</center>
					</b></td>
			</tr>
			<tr>
				<td width="10%">
					<center>1</center>
				</td>
				<td colspan="5" width="60%">Wt. of Sp. Gravity bottle in gm, a</td>
				<td width="10%"></td>
				<td width="10%"></td>
			</tr>
			<tr>
				<td width="10%">
					<center>2</center>
				</td>
				<td colspan="5" width="60%">Wt. of Sp. Gravity bottle filled with distilled water in gm,b</td>
				<td width="10%"></td>
				<td width="10%"></td>
			</tr>
			<tr>
				<td width="10%">
					<center>3</center>
				</td>
				<td colspan="5" width="60%">Wt. of Sp. Gravity bottle about half filled with the material, c</td>
				<td width="10%"></td>
				<td width="10%"></td>
			</tr>
			<tr>
				<td width="10%">
					<center>4</center>
				</td>
				<td colspan="5" width="60%">Wt. of Sp. Gravity bottle about half filled with the material and the rest with distilled water, d</td>
				<td width="10%"></td>
				<td width="10%"></td>
			</tr>
			<tr>
				<td width="10%">
					<center>5</center>
				</td>
				<td colspan="5" width="60%">Wt. of Sp. Gravity bottle completely filled with the material, e</td>
				<td width="10%"></td>
				<td width="10%"></td>
			</tr>
			<tr>
				<td width="10%">
					<center>6</center>
				</td>
				<td colspan="5" width="60%">Specific gravity (Solids &amp; Semisolids)=(a-c) / (b-c)-(d-c)</td>
				<td width="10%"></td>
				<td width="10%"></td>
			</tr>
			<tr>
				<td width="10%">
					<center>7</center>
				</td>
				<td colspan="5" width="60%">Mean Specific gravity Mean Specific gravity</td>
				<td width="10%"></td>
				<td width="10%"></td>
			</tr>
			<tr>
				<td width="10%">
					<center>8</center>
				</td>
				<td colspan="5" width="60%">Specific gravity (Liquids)=(e-a) / (a-b)</td>
				<td width="10%"></td>
				<td width="10%"></td>
			</tr>
			<tr>
				<td width="10%">
					<center>9</center>
				</td>
				<td colspan="5" width="60%">Mean Specific gravity</td>
				<td width="10%"></td>
				<td width="10%"></td>
			</tr>
		</table>
		<br>
		<br>
		<table align="center" width="90%" class="test">
			<tr>
				<td colspan="12"><b>Determination of Ductility (IS 1208) </b></td>
			</tr>
			<tr>
				<td colspan="12"><b><u>Observation:</u></b></td>
			</tr>
		</table>
		<br>
		<table align="center" border="1px" height="13%" width="90%" class="test">
			<tr>
				<td><b>Sr.<br>No.</b></td>
				<td><b>Particular</b></td>
				<td><b>Observation</b></td>
			</tr>
			<tr>
				<td>1</td>
				<td>Pouring temperature,° C</td>
				<td></td>
			</tr>
			<tr>
				<td>2</td>
				<td>Test temperature,° C</td>
				<td></td>
			</tr>
			<tr>
				<td>3</td>
				<td>Period of cooling in air, minutes</td>
				<td></td>
			</tr>
			<tr>
				<td>4</td>
				<td>Period of cooling in water bath before trimming, minutes</td>
				<td></td>
			</tr>
			<tr>
				<td>5</td>
				<td>Period of cooling in water bath after trimming, minutes</td>
				<td></td>
			</tr>

		</table>
		<br>
		<br>
		<table align="center" width="90%" class="test">
			<tr>
				<td colspan="12"><b>Test Result:</b></td>
			</tr>
		</table>
		<br>
		<table align="center" border="1px" height="13%" width="90%" class="test">
			<tr>
				<td><b>
						<center>Observation<br>number</center>
					</b></td>
				<td colspan="2"><b>
						<center>Ductility value in (cm)</center>
					</b></td>
				<td colspan="2"><b>
						<center>Mean value (cm)</center>
					</b></td>
			</tr>
			<tr>
				<td>
					<center>1</center>
				</td>
				<td colspan="2"></td>
				<td colspan="2" rowspan="3"></td>
			</tr>
			<tr>
				<td>
					<center>2</center>
				</td>
				<td colspan="2"></td>

			</tr>
			<tr>
				<td>
					<center>3</center>
				</td>
				<td colspan="2"></td>

			</tr>
		</table>
		<br>
		<table align="center" border="1px" width="90%" height="5%" class="test">
			<tr>
				<td colspan="6"><b>Tested by:</b></td>
				<td colspan="6"><b></b>Checked by:</td>
			</tr>
		</table>
		<!-------------------------------------->
		<div class="pagebreak"></div>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<table align="center" border="1px" height="13%" width="90%" class="test">
			<tr>
				<td colspan="12"><b>
						<center>SShree Soil Material Testing Lab</center>
					</b></td>
			</tr>
			<tr>
				<td colspan="8"><b>Worksheet for Absolute & Kinematic Viscosity Test</b></td>
				<td colspan="4">F/Material/23,Issue No. 01, Page No 1 of 1</td>
			</tr>
			<tr>
				<td colspan="12">Lab ID :</td>
			</tr>
			<tr>
				<td colspan="6">Date of sample Received : </td>
				<td colspan="6">Type of sample :</td>
			</tr>
			<tr>
				<td colspan="6">Date of Test starting :</td>
				<td colspan="6">Date of Test completion : </td>
			</tr>
			<tr>
				<td colspan="12">Condition of sample when received:</td>

			</tr>
		</table>
		<br>
		<br>
		<table align="center" width="90%" class="test">
			<tr>
				<td colspan="12"><b>Absolute Viscosity (IS : 1206 Part -2)</b></td>
			</tr>
		</table>
		<br>
		<table align="center" border="1px" height="13%" width="90%" class="test">
			<tr>
				<td width="6">
					<center><b>Sl.No.</b></center>
				</td>
				<td width="50%">
					<center><b>Description</b></center>
				</td>
				<td width="17%">
					<center><b>Sample 1</b></center>
				</td>
				<td width="17%">
					<center><b>Sample 2</b></center>
				</td>

			</tr>
			<tr>
				<td>
					<center>1</center>
				</td>
				<td>Specific test temperature 0C</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<center>2</center>
				</td>
				<td>Size of the viscometer</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<center>3</center>
				</td>
				<td>Viscometer constant B Bulb (K1)</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<center>4</center>
				</td>
				<td>Test run in seconds (T1)</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<center>5</center>
				</td>
				<td>Viscosity in B Bulb (K1*T1)</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<center>6</center>
				</td>
				<td>Viscometer constant C Bulb (K2)</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<center>7</center>
				</td>
				<td>Test run in seconds (T2)</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<center>8</center>
				</td>
				<td>Viscosity in B Bulb (K2*T2)</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<center>9</center>
				</td>
				<td>Viscosity in poises KT = (K1 *T1+K2*T2)/2</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<center>10</center>
				</td>
				<td>Average viscosity in poises</td>
				<td></td>
				<td></td>
			</tr>
		</table>
		<br>
		<br>
		<table align="center" width="90%" class="test">
			<tr>
				<td colspan="12"><b>Kinematic Viscosity (IS : 1206 Part -3)</b></td>
			</tr>
		</table>
		<br>
		<table align="center" border="1px" height="13%" width="90%" class="test">
			<tr>
				<td width="6">
					<center><b>Sl.No.</b></center>
				</td>
				<td width="50%">
					<center><b>Description</b></center>
				</td>
				<td width="17%">
					<center><b>Sample 1</b></center>
				</td>
				<td width="17%">
					<center><b>Sample 2</b></center>
				</td>

			</tr>
			<tr>
				<td>
					<center>1</center>
				</td>
				<td>Specific test temperature 0C</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<center>2</center>
				</td>
				<td>Viscometer constant</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<center>3</center>
				</td>
				<td>Actual test temperature 0C</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<center>4</center>
				</td>
				<td>Test run in seconds</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<center>5</center>
				</td>
				<td>Viscosity in cst. ( s.no 2 X s.no 4)</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<center>6</center>
				</td>
				<td>Average viscosity in cst.</td>
				<td></td>
				<td></td>
			</tr>
		</table>
		<br>
		<table align="center" border="1px" height="5%" width="90%" class="test">
			<tr>
				<td colspan="6"><b>Tested By :</b></td>
				<td colspan="6"><b>Checked By :</b></td>
			</tr>
		</table>

	</page>
	<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">

</body>

</html>

<script type="text/javascript">
	window.onload = function() {
		setTimeout(function() {

				window.print();
			},
			1000);

	}
</script>