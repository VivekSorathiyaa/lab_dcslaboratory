<?php
session_start();
include("connection.php");
?>
<?php
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
}
?>
<style>
@page { margin: 0; }


@media print{@page }

.tdclass{
    border: 1px solid black;
    font-size:9px;
	 font-family: Book Antiqua;
}
.test {
    border-collapse: collapse;
}
	.tdclass1{

    font-size:9px;
	 font-family: Book Antiqua;
}
.pagebreak { page-break-before: always; }

</style>
<html>
	<body>
<?php
		// get estimate by report no and job no
		$get_report_no=$_GET["trf_no"];
		$get_job_no=$_GET["job_no"];
		$sel_estiamte="select * from job where `trf_no`='$get_report_no'";
		$result_estiamte =mysqli_query($conn,$sel_estiamte);
		$row_estiamte =mysqli_fetch_array($result_estiamte);


		$setting_date=date_create($row_estiamte["jobcreateddate"]);
		$jobcreateddate= date_format($setting_date,"d.m.Y");

		$setting_dating=date_create($row_estiamte["date"]);
		$trf_date= date_format($setting_dating,"d.m.Y");


		// get name of agency by report no and job no from agency table
		$sel_agency_id=$row_estiamte["agency"];

		$sel_agency="select * from agency_master where `agency_id`=".$sel_agency_id;
		$result_agency =mysqli_query($conn,$sel_agency);
		$row_agency =mysqli_fetch_array($result_agency);
		$agency_name=$row_agency["agency_name"];
		$agency_address=$row_agency["agency_address"];
		$agency_gst=$row_agency["agency_gstno"];
		$agency_email=$row_agency["agency_email"];


		$name_of_work= strip_tags(html_entity_decode($row_estiamte["nameofwork"]),"<strong><em>");

?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<br>
		<br>
		<page size="A4">
		<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black;font-family: Book Antiqua;">
				<tr >
					<td colspan="4" rowspan="4" style="height:50px;width:80px;border: 2px solid black;"><img src="images/mat_logo.png" style="height:100%;width:100%"></td>
					<td colspan="4" rowspan="4" style="font-size:16px;border: 2px solid black;"><b>MATTEST ENGINEERING <Br> SERVICES<br>
					<br>
					<br>TEST REQUST FORM&nbsp;(B)</b></td>
					<td colspan="2" style="border: 2px solid black;padding-left: 5px;"><b>Doc. No.</b></td>
					<td colspan="6" style="border: 2px solid black;padding-left: 5px;"><b>F / 7.1 / 01</b></td>
				</tr>
				<tr style="border: 2px solid black;">

					<td colspan="2" style="border: 2px solid black;padding-left: 5px;"><b>Issue. No.</b></td>
					<td colspan="2" style="border: 2px solid black;"><b>03</b></td>
					<td colspan="2" style="border: 2px solid black;padding-left: 5px;"><b>Issue Date.</b></td>
					<td colspan="2" style="border: 2px solid black;"><b>01.10.2018</b></td>
				</tr>
				<tr style="border: 2px solid black;">

					<td colspan="2" style="border: 2px solid black;padding-left: 5px;"><b>Amend No.</b></td>
					<td colspan="2" style="border: 2px solid black;"><b>00</b></td>
					<td colspan="2" style="border: 2px solid black;padding-left: 5px;"><b>Amend Date.</b></td>
					<td colspan="2" style="border: 2px solid black;"><b>-</b></td>
				</tr>
				<tr style="border: 2px solid black;">

					<td colspan="8" style="border: 2px solid black;padding-left: 5px;"><b>Page No. 1 of 2</b></td>

				</tr>
			</table>
		<br>
		<table align="center" width="90%" class="test" border="1px" style="border: 1px solid black; font-family: Book Antiqua;">
		<tr>
		<td style="padding-left: 5px;width:230px;">
		<b>Test Request No.</b><br>
		<span style="font-size:12px;padding-left: 15px;">(For Lab Use only)</span>
		</td>
		<td style="padding-left: 5px;width:237px;"><span style="font-size:10px;"><?php echo $row_estiamte["trf_no"];?></span></td>
		<td style="padding-left: 5px;"><b>Date:</b>&nbsp;<span style="font-size:10px;"><?php echo $trf_date; ?></span></td>
		</tr>

		<tr>
		<td style="padding-left: 5px;width:230px;"><b>Name of Customer</b></td>
		<td colspan="2" style="padding-left: 5px;font-size:10px;"><?php echo $row_estiamte["clientname"].", ".$row_estiamte["clientaddress"];?></td>
		</tr>

		<tr>
		<td style="padding-left: 5px;width:230px;"><b>Name of Agency</b></td>
		<td colspan="2" style="padding-left: 5px;font-size:10px;"><?php echo $agency_name;?></td>
		</tr>

		<tr>
		<td style="padding-left: 5px;width:230px;">
		<b>Contact No.</b><br>
		</td>
		<td style="padding-left: 5px;width:237px;font-size:10px;"><?php echo $row_estiamte["person_auth_mobile"];?></td>
		<td style="padding-left: 5px;"><b>Email:</b>&nbsp;<span style="font-size:10px;"><?php echo $agency_email;?></span></td>
		</tr>

		<tr>
		<td style="padding-left: 5px;width:230px;"><b>Contact Person</b></td>
		<td colspan="2" style="padding-left: 5px;font-size:10px;"><?php echo $row_estiamte["person_name"];?></td>
		</tr>

		<tr>
		<td style="padding-left: 5px;width:230px;height:50px;padding-bottom: 40px;">
		<b>Name of Work/Project</b><br>
		</td>
		<td colspan="2" style="padding-left: 5px;width:237px;font-size:10px;">
		<textarea id="txt_now" style="width:100%;height:50px;"><?php echo $name_of_work;?></textarea>
		</td>
		</tr>

		<tr>
		<td colspan="2" style="padding-left: 5px;font-size:10px;">
		In case of the testing laboratory subcontracting of testing
		activities to competent subcontractor, are you agree?
		</td>
		<td style="padding-left: 5px;">Yes / No</td>
		</tr>

		<tr>
		<td colspan="2" style="padding-left: 5px;font-size:10px;">
		Do wish to incorporate the conformity statement in the
		Test Report?
		</td>
		<td style="padding-left: 5px;">Yes / No</td>
		</tr>

		<td colspan="3" style="padding-left: 5px;font-size:10px;">
		If Yes,Decision Rule:
		</td>
		</tr>
		</table>
		<br>
		<table align="center" width="90%" class="test" border="1px" style="font-family: Book Antiqua;">
			<tr>
			<td colspan="8"><b style="font-size: 14px;">TEST TO BE PERFORM</b></td>
		    </tr>

			<tr>
			<td style="width:10%"><b style="font-size: 12px;padding: 10px;">Sr No.</b></td>
			<td style="width:13%"><b style="font-size: 12px;padding: 10px;">Material</b></td>
			<td style="width:7%"><b style="font-size: 12px;padding: 10px;">Id <br>&nbsp;&nbsp;&nbsp;mark</b></td>
			<td style="width:5%"><b style="font-size: 12px;padding: 10px;">Qty.</b></td>
			<td style="width:15%"><b style="font-size: 12px;padding: 10px;">Nature Of Sample</b></td>
			<td style="width:20%"><b style="font-size: 12px;padding: 10px;">Test Description</b></td>
			<td style="width:15%"><b style="font-size: 12px;padding: 10px;">Test Method</b></td>
			<td style="width:15%"><b style="font-size: 12px;padding: 10px;">Remark</b></td>
		    </tr>




		<?php
		// static ulr no logic
		$sel_static_ulr_no="select * from ulr_no where `ulr_status`=0 AND `ulr_is_deleted`=0";
		$query_static_ulr_no=mysqli_query($conn,$sel_static_ulr_no);
		$row_static_ulr_no =mysqli_fetch_array($query_static_ulr_no);
		$static_ulr_nos= $row_static_ulr_no["ulr_no"];

		// final material assign table data
		$get_final_material="select * from final_material_assign_master where `trf_no`='$get_report_no' AND `job_no`='$get_job_no' AND `is_deleted`='0'";
		$result_final_materials =mysqli_query($conn,$get_final_material);
		$counts=1;
		if(mysqli_num_rows($result_final_materials)>0)
		{
			while($one_final_materials=mysqli_fetch_array($result_final_materials))
			{
				// material name get code
				$materials_ids= $one_final_materials["material_id"];
				$sel_materials_names="select * from material where `id`=$materials_ids AND `mt_isdeleted`=0";
				$result_material_name =mysqli_query($conn,$sel_materials_names);
				$row_material_name =mysqli_fetch_array($result_material_name);

				$sel_material_assign="select * from span_material_assign where `material_category`='$one_final_materials[material_category]' AND `material_id`='$one_final_materials[material_id]' AND `trf_no`='$one_final_materials[trf_no]' AND `job_number`='$one_final_materials[job_no]' AND `lab_no`='$one_final_materials[lab_no]'";
				$result_material_assign =mysqli_query($conn,$sel_material_assign);

				$joint_test="";
				$joint_test_methods="";
				while($one_material_assign=mysqli_fetch_array($result_material_assign))
				{
					$sel_test_names="select * from test_master where `test_id`=$one_material_assign[test] AND `test_isdeleted`=0";
					$result_test_names =mysqli_query($conn,$sel_test_names);
					$row_test_names =mysqli_fetch_array($result_test_names);

					$joint_test .='<tr><td style="padding-left: 10px;font-size: 11px;border-bottom: 1px solid;">';
					$joint_test .=$row_test_names["test_name"];
					$joint_test .='</td></tr>';

					$joint_test_methods .='<tr><td style="padding-left: 10px;font-size: 11px;border-bottom: 1px solid;">';
					$joint_test_methods .=$row_test_names["test_method"];
					$joint_test_methods .='</td></tr>';
				}
				?>


		<tr>
			<td style="padding-left: 10px;font-size: 11px;"><?php echo $counts;?></td>
			<td style="padding-left: 10px;font-size: 10px;"><?php echo $row_material_name["mt_name"];?></td>
			<td style="padding-left: 10px;font-size: 11px;">&nbsp;</td>
			<td style="padding-left: 10px;font-size: 11px;">
			
			<input type="text" class="txt_qty" value="1" style="width: 100%;border:0px;">
			
			</td>
			<td style="padding-left: 10px;font-size: 11px;">&nbsp;</td>

			<td style="font-size: 11px;">
			
				<table align="center" width="100%" class="test"  style="font-family: Book Antiqua;">
					<?php echo $joint_test;?>
				</table>
			
			</td>

			<td style="font-size: 11px;">
			
				<table align="center" width="100%" class="test"  style="font-family: Book Antiqua;">
					<?php echo $joint_test_methods;?>
				</table>
			
			</td>
			<td style="padding-left: 10px;font-size: 11px;">
			
			<?php echo $static_ulr_nos.$one_final_materials["ulr_no"]."F";?>
			
			</td>
		    </tr>
			<?php
			$counts++;
			}
		}

		?>
		<tr>
				<td colspan="8" style="padding: 5px;">
				<b>Customer's Name & Signature:</b>
				</td>
		</tr>
		</table>
		<br>
		<table align="center" width="90%" class="test" border="1px" style="font-family: Book Antiqua;">
		<tr style="background-color:#A9A9A9">
				<td colspan="2" style="padding: 5px;">
				<b>Prepared & Issued by:QM</b>
				</td>
				<td colspan="2" style="padding: 5px;">
				<b>Reviewed & Approved by: CEO</b>
				</td>
		</tr>
		</table>

</page>
		<div class="pagebreak"> </div>

		<page size="A4">
		<br>
		<br>
		<br>
		<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black;font-family: Book Antiqua;">
				<tr >
					<td colspan="4" rowspan="4" style="height:50px;width:80px;border: 2px solid black;"><img src="images/mat_logo.png" style="height:100%;width:100%"></td>
					<td colspan="4" rowspan="4" style="font-size:16px;border: 2px solid black;"><b>MATTEST ENGINEERING <Br> SERVICES<br>
					<br>
					<br>TEST REQUST FORM&nbsp;(B)</b></td>
					<td colspan="2" style="border: 2px solid black;padding-left: 5px;"><b>Doc. No.</b></td>
					<td colspan="6" style="border: 2px solid black;padding-left: 5px;"><b>F / 7.1 / 01</b></td>
				</tr>
				<tr style="border: 2px solid black;">

					<td colspan="2" style="border: 2px solid black;padding-left: 5px;"><b>Issue. No.</b></td>
					<td colspan="2" style="border: 2px solid black;"><b>03</b></td>
					<td colspan="2" style="border: 2px solid black;padding-left: 5px;"><b>Issue Date.</b></td>
					<td colspan="2" style="border: 2px solid black;"><b>01.10.2018</b></td>
				</tr>
				<tr style="border: 2px solid black;">

					<td colspan="2" style="border: 2px solid black;padding-left: 5px;"><b>Amend No.</b></td>
					<td colspan="2" style="border: 2px solid black;"><b>00</b></td>
					<td colspan="2" style="border: 2px solid black;padding-left: 5px;"><b>Amend Date.</b></td>
					<td colspan="2" style="border: 2px solid black;"><b>-</b></td>
				</tr>
				<tr style="border: 2px solid black;">

					<td colspan="8" style="border: 2px solid black;padding-left: 5px;"><b>Page No. 2 of 2</b></td>

				</tr>
			</table>
			<br>
			<br>
		<table align="center" width="90%" class="test" border="1px" style="font-family: Book Antiqua;">
		<tr style="background-color:#A9A9A9">
				<td colspan="3" style="padding: 5px;">
				<b>CHECKLIST-TEST ITEM/SAMPLE RECEIVING:(please tick mark)</b>
				</td>
		</tr>
		<tr>
				<td style="padding: 5px;">
				Does sample bear proper indentification/label?
				</td>
				<td style="padding: 5px;"><b>Yes</b></td>
				<td style="padding: 5px;"><b>No</b></td>
		</tr>
		<tr>
				<td style="padding: 5px;">
				Does sample have sufficient quality?
				</td>
				<td style="padding: 5px;"><b>Yes</b></td>
				<td style="padding: 5px;"><b>No</b></td>
		</tr>
		<tr>
				<td style="padding: 5px;">
				Does sample pack in proper bag/container?
				</td>
				<td style="padding: 5px;"><b>Yes</b></td>
				<td style="padding: 5px;"><b>No</b></td>
		</tr>
		<tr>
				<td style="padding: 5px;">
				Test witness by the customer?
				</td>
				<td style="padding: 5px;"><b>Yes</b></td>
				<td style="padding: 5px;"><b>No</b></td>
		</tr>
		<tr>
				<td style="padding: 5px;">
				Test Report required under NABL?
				</td>
				<td style="padding: 5px;"><b>Yes</b></td>
				<td style="padding: 5px;"><b>No</b></td>
		</tr>
		<tr>
				<td colspan="3" style="padding: 5px;">
				<b>Sample condition for Testing at the time of receipt:</b>&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox">&nbsp;&nbsp;Acceptable&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox">&nbsp;&nbsp;Not Acceptable<br>
				If Not acceptable Remark:
				</td>
		</tr>
		<tr>
				<td colspan="3" style="padding: 5px;">
				<b style="font-size: 15px;">RECEIVER'S SIGNATURE:</b>
				</td>
		</tr>

		</table>
		<br>
		<table align="center" width="90%" class="test" border="1px" style="font-family: Book Antiqua;">
		<tr>
				<td colspan="2" style="padding: 5px;background-color:#A9A9A9">
				<b>REQUIREMENT REVIEW</b>
				</td>
				<td colspan="2" style="padding: 5px;">
				<b>PI. Tick Mark</b>
				</td>
		</tr>
		<tr>
				<td colspan="2" style="padding: 5px;">
				The requirements. including the test methods to be used,are adequately defined,documented and understood by the laboratory;
				</td>
				<td style="padding: 5px;">Yes</td>
				<td style="padding: 5px;">No</td>
		</tr>
		<tr>
				<td colspan="2" style="padding: 5px;">
				The laboratory has the capability and resources to meet the requirements;
				</td>
				<td style="padding: 5px;">Yes</td>
				<td style="padding: 5px;">No</td>
		</tr>
		<tr>
				<td colspan="2" style="padding: 5px;">
				The appropriate test method is selected and is capable of meeting the customer's requirements.
				</td>
				<td style="padding: 5px;">Yes</td>
				<td style="padding: 5px;">No</td>
		</tr>
		<tr>
				<td colspan="2" style="padding: 5px;">
				Whether tests to be subcontract?
				</td>
				<td style="padding: 5px;">Yes</td>
				<td style="padding: 5px;">No</td>
		</tr>
		<tr>
				<td colspan="2" style="padding: 5px;">
				Whether decision rule defined clearly and agreed by the customer?
				</td>
				<td style="padding: 5px;">Yes</td>
				<td style="padding: 5px;">No</td>
		</tr>
		<tr>
				<td colspan="4" style="padding: 5px;">
				<b style="font-size: 15px;">REQUIREMENT REVIEWER'S SIGNATURE(TM / Dy. TM):</b>
				</td>
		</tr>

		</table>
		<br>
		<table align="center" width="90%" class="test" border="1px" style="font-family: Book Antiqua;">
		<tr>
				<td colspan="4" style="padding: 5px;background-color:#A9A9A9">
				<b>DETAILS OF SAMPLE DISPOSAL</b>
				</td>
		</tr>
		<tr>
				<td colspan="4" style="padding: 5px;">
				Sample Dispose Date..............................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;By...............................................................
				</td>

		</tr>
		</table>
		<br>
		<table align="center" width="90%" class="test" border="1px" style="font-family: Book Antiqua;">
		<tr style="background-color:#A9A9A9">
				<td colspan="2" style="padding: 5px;">
				<b>Prepared & Issued by:QM</b>
				</td>
				<td colspan="2" style="padding: 5px;">
				<b>Reviewed & Approved by: CEO</b>
				</td>
		</tr>
		</table>
		<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">
	</body>
</html>
	<script src="bower_components/ckeditor/ckeditor.js"></script>
	<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('txt_auth_address')
    //bootstrap WYSIHTML5 - text editor
   // $('.textarea').wysihtml5()
  })
</script>
<script type="text/javascript">
window.onload = function(){
	setTimeout(function()
		{

			//window.print();
		},
		1000);

}

$("#print_button").on("click",function(){
	$('#print_button').hide();
	window.print();
});

</script>
