<?php
error_reporting(1);
session_start();
include("connection.php");
include("connection_of_non_nabl_in_nabl.php");
?>
<?php
//if($_SESSION['name']=="")
//{
	?>
	<script >
		//window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
//}
?>
<style>
@page {
margin: 5mm 2mm 2mm 2mm;
}



@media print{@page }

.tdclass{
    border: 1px solid black;
    font-size:11px;
	 font-family: Book Antiqua;
}
.test {
    border-collapse: collapse;
}
	.tdclass1{

    font-size:11px;
	 font-family: Book Antiqua;
}
.pagebreak { page-break-before: always; }

	#table_1 {
        page-break-inside: auto;

      }
     #table_1 tr {
        page-break-inside: avoid;
        page-break-after: auto;

      }
     #table_1 thead {
        display: table-header-group;

      }
     #table_1 tfoot {
        display: table-footer-group;
      }

#content {
    display: table;
}

#pageFooter {
    display: table-footer-group;
}

#pageFooter:after {
    counter-increment: page;
    content:"Page " counter(page);
    left: 0;
    top: 100%;
    white-space: nowrap;
    z-index: 20;
    -moz-border-radius: 5px;
    -moz-box-shadow: 0px 0px 4px #222;
    background-image: -moz-linear-gradient(top, #eeeeee, #cccccc);
  }

</style>
<html>
	<body>
<?php
		// get estimate by report no and job no
		$get_report_no=$_GET["trf_no"];
		$temporary_trf_no=$_GET["temporary_trf_no"];
		$get_job_no=$_GET["job_no"];
		$sel_estiamte="select * from job where `trf_no`='$get_report_no' AND `temporary_trf_no`='$temporary_trf_no'";
		$result_estiamte =mysqli_query($conn_of_non,$sel_estiamte);
		$row_estiamte =mysqli_fetch_array($result_estiamte);


		$setting_date=date_create($row_estiamte["sample_rec_date"]);
		$put_sample_rec_date= date_format($setting_date,"d.m.Y");

		$setting_date_ref=date_create($row_estiamte["date"]);
		$refrence_date= date_format($setting_date_ref,"d/m/Y");


		// get name of agency by report no and job no from agency table
		$sel_agency_id=$row_estiamte["agency"];

		$sel_agency="select * from agency_master where `agency_id`=".$sel_agency_id;
		$result_agency =mysqli_query($conn_of_non,$sel_agency);
		$row_agency =mysqli_fetch_array($result_agency);
		$agency_name=$row_agency["agency_name"];
		$agency_address=$row_agency["agency_address"];
		$agency_gst=$row_agency["agency_gstno"];
		$agency_email=$row_agency["agency_email"];


		$name_of_work= strip_tags(html_entity_decode($row_estiamte["nameofwork"]),"<strong><em>");

?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<div id="content">
		<page size="A4">
		<table align="center" width="98%" class="test" id="table_1" border="1px" style="font-family: Book Antiqua;height: 120px;">
		<tr>
				<td rowspan="6" width="5%">
				<img src="images/mat_logo.png" style="width:150px;">
				</td>
				<td rowspan="6" colspan="3" width="40%">
				<b style="font-size: 19px;">MATTEST ENGINEERING SERVICES</b>
				<p style="margin-top: 6px;margin-bottom: 25px;">A-39,40,41, City Industrial Estate Udhna Navsari</br>
				 Main Road, Udhna, Surat 394210</p>
				<b style="font-size: 15px;">TEST REQUEST FORM</b>
				</td>

				<td style="padding:5px;font-size:12px;"  width="10%">Doc. No.</td>
				<td style="padding:5px;font-size:11px;"  width="10%">F/7.1/01</td>
		</tr>
		<tr>

				<td style="padding:5px;font-size:12px;"  width="10%">Issue No.</td>
				<td style="padding:5px;font-size:11px;"  width="10%">04</td>
		</tr>
		<tr>

				<td style="padding:5px;font-size:12px;"  width="10%">Amend No.</td>
				<td style="padding:5px;font-size:11px;"  width="10%">00</td>
		</tr>
		<tr>

				<td style="padding:5px;font-size:12px;"  width="10%">Issue Date</td>
				<td style="padding:5px;font-size:11px;"  width="10%">01.04.2019</td>
		</tr>
		<tr>

				<td style="padding:5px;font-size:12px;"  width="10%">Amend Date</td>
				<td style="padding:5px;font-size:11px;"  width="10%">--</td>
		</tr>
		<tr>
			    <td colspan="2" style="padding:5px;font-size:12px;" width="10%">Page 1 of 2 </td>
		</tr>

		</table>
		<br>
		<table align="center" width="98%" class="test"  style="font-family: Book Antiqua;">

		<tr style="border:1px solid black;">
			    <td colspan="6" style="padding:5px;font-size:11px;" ><u>Customer Details</u></td>

		</tr>
		<tr style="border:1px solid black;">
			    <td width="20%" style="text-align:left;font-size:11px;">&nbsp;&nbsp;<b>S.R.F. No.</b></td>
			    <td width="5%" style="border:1px solid black;"><b>»</b></td>
			    <td width="40%" class="tdclass">&nbsp;&nbsp;<?php echo $row_estiamte["trf_no"];?></td>
			    <td width="7%" style="text-align:left;font-size:11px;"><b>Date</b></td>
			    <td width="5%" style="border:1px solid black;"><b>»</b></td>
			    <td width="23%"  class="tdclass">&nbsp;&nbsp;<?php echo $put_sample_rec_date;?></td>
		</tr>
		<tr style="border:1px solid black;">
			    <td  style="padding:5px;font-size:11px;"><b>Name of Customer</b></td>
			    <td style="border:1px solid black;"><b>»</b></td>
			    <td colspan="4"  class="tdclass">&nbsp;&nbsp;<?php echo $row_estiamte["clientname"];?></td>

		</tr>

		<tr style="border:1px solid black;">
			    <td  style="padding:5px;font-size:11px;"><b>Address</b></td>
			    <td style="border:1px solid black;"><b>»</b></td>
			    <td colspan="4"  class="tdclass">&nbsp;&nbsp;<?php echo $row_estiamte["clientaddress"];?></td>
		</tr>
		<tr style="border:1px solid black;">
			    <td  style="padding:5px;font-size:11px;"><b>Name of Agency</b></td>
			    <td style="border:1px solid black;"><b>»</b></td>
			    <td colspan="4"  class="tdclass">&nbsp;&nbsp;<?php echo $agency_name;?></td>
		</tr>
		<tr style="height:60px;border:1px solid black;">
			    <td  style="font-size:11px;padding-bottom:6%;">&nbsp;&nbsp;<b>Name of Work/Project</b></td>
			    <td style="padding-bottom:6%;border:1px solid black;"><b>»</b></td>
			    <td colspan="4" class="tdclass">
				<textarea id="txt_now" style="height:60px;width:100%;border:0px;" class="tdclass">&nbsp;&nbsp;<?php echo $name_of_work;?></textarea>
				</td>
		</tr>
		<tr style="border:1px solid black;">
			    <td  style="padding:5px;font-size:11px;"><b>Aggrement No.</b></td>
			    <td style="border:1px solid black;"><b>»</b></td>
			    <td colspan="4" class="tdclass">&nbsp;&nbsp;<?php echo $row_estiamte["agreement_no"];?></td>
		</tr>
		<tr style="border:1px solid black;">
			    <td style="padding:5px;font-size:11px;"><b>Reference No.</b></td>
			    <td style="border:1px solid black;"><b>»</b></td>
			    <td colspan="4" class="tdclass">&nbsp;&nbsp;<?php echo $row_estiamte["refno"];?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Date:&nbsp;</b><?php echo $refrence_date;?>
				</td>
		</tr>
		<tr style="border:1px solid black;">
			    <td colspan="6" style="padding:5px;">&nbsp;</td>
		</tr>
		<tr style="border:1px solid black;">
			    <td  style="padding:5px;font-size:11px;"><b>Contact Person</b></td>
			    <td style="border:1px solid black;"><b>»</b></td>
			    <td colspan="4" class="tdclass">&nbsp;&nbsp;<?php echo $row_estiamte["person_name"];?></td>
		</tr>
		<tr style="border:1px solid black;">
			    <td  style="padding:5px;font-size:11px;"><b>Mobile No.</b></td>
				<td style="border:1px solid black;"><b>»</b></td>
			    <td class="tdclass">&nbsp;&nbsp;<?php echo $row_estiamte["person_auth_mobile"];?></td>
			    <td  style="padding:5px;font-size:11px;"><b>Email</b></td>
			    <td style="border:1px solid black;"><b>»</b></td>
			    <td class="tdclass">&nbsp;&nbsp;<?php echo $agency_email;?></td>
		</tr>

		</table>
		<br>
		<table align="center" width="98%" class="test" id="table_1" border="1px" style="font-family: Book Antiqua;">
		<tr>
			<td colspan="7"><b>TEST TO BE PERFORM</b></td>
		</tr>
		<thead style="margin-top:30px;">

		<tr style="border:1px solid black;">
			<td width="5%;"><b style="font-size:12px;">Sr No.</b></td>
			<td width="15%;"><b style="font-size:12px;">Name of Sample</b></td>
			<td width="20%;"><b style="font-size:12px;">Sample Description<br>
			(Grade/Type/Size/Batch No) etc.</b>
			</td>
			<td width="9%;"><b style="font-size:12px;">Sample Qty.</b></td>
			<td width="30%;"><b style="font-size:12px;">Test Name</b></td>
			<td width="15%;"><b style="font-size:12px;">Test Method</b></td>
			<td width="6%;"><b style="font-size:12px;">Job No.</b></td>
		</tr>
		</thead>
		 <tbody>
		<?php

		$matreials_id_array=array();
		$matreials_name_array=array();
		$matreials_desc_array=array();
		$matreials_qty_array=array();
		$matreials_test_array=array();
		$matreials__method_array=array();
		$matreials_ulr_array=array();
		// static ulr no logic
		$sel_static_ulr_no="select * from ulr_no where `ulr_status`=0 AND `ulr_is_deleted`=0";
		$query_static_ulr_no=mysqli_query($conn_of_non,$sel_static_ulr_no);
		$row_static_ulr_no =mysqli_fetch_array($query_static_ulr_no);
		$static_ulr_nos= $row_static_ulr_no["ulr_no"];

		// final material assign table data
		$get_final_material="select * from final_material_assign_master where `trf_no`='$get_report_no' AND `job_no`='$get_job_no' AND `is_deleted`='0' AND `temporary_trf_no`='$temporary_trf_no' ORDER BY final_material_id ASC";
		$result_final_materials =mysqli_query($conn_of_non,$get_final_material);
		$counts=1;
		if(mysqli_num_rows($result_final_materials)>0)
		{
			while($one_final_materials=mysqli_fetch_array($result_final_materials))
			{
				// material name get code
				$materials_ids= $one_final_materials["material_id"];
				$sel_materials_names="select * from material where `id`=$materials_ids AND `mt_isdeleted`=0";
				$result_material_name =mysqli_query($conn_of_non,$sel_materials_names);
				$row_material_name =mysqli_fetch_array($result_material_name);



				//data by trf_no/job_no/labno/m_cate_material
				$sel_material_assign="select * from span_material_assign where `material_category`='$one_final_materials[material_category]' AND `material_id`='$one_final_materials[material_id]' AND `trf_no`='$one_final_materials[trf_no]' AND `job_number`='$one_final_materials[job_no]' AND `lab_no`='$one_final_materials[lab_no]' AND `temporary_trf_no`='$one_final_materials[temporary_trf_no]'";
				$result_material_assign =mysqli_query($conn_of_non,$sel_material_assign);

				$joint_test="";
				$joint_test_methods="";
				$counts_of_tr= mysqli_num_rows($result_material_assign);
				$counts_materials=1;
				while($one_material_assign=mysqli_fetch_array($result_material_assign))
				{
					// test name by test id
					$sel_test_names="select * from test_master where `test_id`=$one_material_assign[test] AND `test_isdeleted`=0";
					$result_test_names =mysqli_query($conn,$sel_test_names);
					$row_test_names =mysqli_fetch_array($result_test_names);

					//$joint_test .=$row_test_names["test_name"]."<br>";
					//$joint_test_methods .=$row_test_names["test_method"]."<br>";
					if($counts_materials !=$counts_of_tr)
					{
						$class_setting="padding-left: 0px;font-size: 11px;border-bottom: 1px solid;";
					}else{

						$class_setting="padding-left: 0px;font-size: 11px;border-bottom: 0px solid;";
					}

					$joint_test .='<tr><td style="'.$class_setting.'">';
					$joint_test .=$row_test_names["test_name"];
					$joint_test .='</td></tr>';

					$joint_test_methods .='<tr><td style="'.$class_setting.'">';
					$joint_test_methods .=$row_test_names["test_method"];
					$joint_test_methods .='</td></tr>';

					$counts_materials++;
				}

				//data by trf_no/job_no/labno/m_cate_material for description
				$sel_material_assign_descri="select * from span_material_assign where `material_category`='$one_final_materials[material_category]' AND `material_id`='$one_final_materials[material_id]' AND `trf_no`='$one_final_materials[trf_no]' AND `job_number`='$one_final_materials[job_no]' AND `lab_no`='$one_final_materials[lab_no]' AND `temporary_trf_no`='$one_final_materials[temporary_trf_no]'";
				$result_material_assign_descri =mysqli_query($conn_of_non,$sel_material_assign_descri);
				$one_material_assign_descri=mysqli_fetch_assoc($result_material_assign_descri);

				// condition of material prefix
				$joint_desciptions="";
				$qty_parm = 1;
				if($row_material_name["mt_prefix"]=="CM")
				{
				    if($one_material_assign_descri["type_of_cement"] !=""){
						$joint_desciptions .= "Type: ".$one_material_assign_descri["type_of_cement"]."<br>";
					}
					if($one_material_assign_descri["cement_grade"] !=""){
						$joint_desciptions .= " Grade: ".$one_material_assign_descri["cement_grade"]."<br>";
					}
					if($one_material_assign_descri["cement_brand"] !=""){
						$joint_desciptions .= " Brand: ".$one_material_assign_descri["cement_brand"]."<br>";
					}
					if($one_material_assign_descri["week_number"] !=""){
						$joint_desciptions .= " Week No.: ".$one_material_assign_descri["week_number"]."<br>";
					}
					$qty_parm = "1 Bag.";
				}

				if($row_material_name["mt_prefix"]=="CA")
				{
				    if($one_material_assign_descri["agg_source"] !=""){
						$joint_desciptions .= " Source: ".$one_material_assign_descri["agg_source"]."<br>";
					}
						if(strpos($row_material_name["mt_name"],"WMM (MIX MATERIAL)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - I MIX (M4-1)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - II MIX (M4-2)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - III MIX (M4-1)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - IV MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - V MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - VI MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - I MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - III MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - II MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - I MIX (M4-2)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - II MIX (M4-1)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - III MIX (M4-2)") !== false ||
							strpos($row_material_name["mt_name"],"MSS - A (MIX MATERIAL)") !== false ||
							strpos($row_material_name["mt_name"],"MSS - B (MIX MATERIAL)") !== false ||
							strpos($row_material_name["mt_name"],"BM - 2 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"BM - 1 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"BC - 2 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"BC - 1 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"DBM - 1 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"DBM - 2 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"SDBC - 1 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"SDBC - 2 (MIX MATERIAL)") !== false)
							{



								$joint_desciptions .= " Grade: ".($row_material_name["mt_name"])."<br>";
							}
							else
							{
								if(strpos($row_material_name["mt_name"],"Seal Coat") !== false || strpos($row_material_name["mt_name"],"BUSG - CA") !== false || strpos($row_material_name["mt_name"],"BUSG - KA") !== false || strpos($row_material_name["mt_name"],"Premix Carpet") !== false)
								{
									$joint_desciptions .= " Size of Aggregate: ".$row_material_name["mt_name"]."<br>";
								}
								else
								{
									$ans = substr($row_material_name["mt_name"],strpos($row_material_name["mt_name"],"(") + 1);
									$explodeing = explode(")",$ans);
									$second = $explodeing[0];
									$joint_desciptions .= " Size of Aggregate: ".($second)."<br>";
								}

							}
							$qty_parm = "1 Bag.";
				}


				if($row_material_name["mt_prefix"]=="CO")
				{
					$joint_desciptions .= " Source: ".$one_material_assign_descri["agg_source"]."<br>";
					$joint_desciptions .= " Size of Aggregate: ".$one_material_assign_descri["sample_de"]."<br>";

				    $qty_parm = "1 Bag.";
				}

				if($row_material_name["mt_prefix"]=="BR")
				{
					$joint_desciptions .= " Type: CLAY BRICK<br>";

				    if($one_material_assign_descri["brick_mark"] !=""){
						$joint_desciptions .= " Mark: ".$one_material_assign_descri["brick_mark"]."<br>";
					}
					if($one_material_assign_descri["brick_specification"] !=""){
						$joint_desciptions .= " Specification: ".$one_material_assign_descri["brick_specification"]."<br>";
					}
					$qty_parm = "20 Nos.";
				}

				if($row_material_name["mt_prefix"]=="FB")
				{
					$joint_desciptions .= " Type: FLY ASH BRICK<br>";
				    if($one_material_assign_descri["brick_mark"] !=""){
						$joint_desciptions .= " Mark: ".$one_material_assign_descri["brick_mark"]."<br>";
					}
					if($one_material_assign_descri["brick_specification"] !=""){
						$joint_desciptions .= " Specification: ".$one_material_assign_descri["brick_specification"]."<br>";
					}
					$qty_parm = "20 Nos.";
				}

				if($row_material_name["mt_prefix"]=="BT")
				{
				    if($one_material_assign_descri["tanker_no"] !=""){
						$joint_desciptions .= " Tanker No: ".$one_material_assign_descri["tanker_no"]."<br>";
					}
					if($one_material_assign_descri["lot_no"] !=""){
						$joint_desciptions .= " Bitumen Pass No.: ".$one_material_assign_descri["lot_no"]."<br>";
					}
					if($one_material_assign_descri["bitumin_grade"] !=""){
						$joint_desciptions .= " Type of Sample: ".$one_material_assign_descri["bitumin_grade"]."<br>";
					}
					if($one_material_assign_descri["bitumin_make"] !=""){
						$joint_desciptions .= " Make.: ".$one_material_assign_descri["bitumin_make"]."<br>";
					}
					$qty_parm = "1 Con.";
				}

				if($row_material_name["mt_prefix"]=="CC")
				{
					$joint_desciptions .="Type: Concrete Cube<br>";
					if($one_material_assign_descri["casting_date"] !=""){

                    $testing_days=$one_material_assign_descri["cc_day"];
					$testing_dates=date('Y-m-d', strtotime($one_material_assign_descri["casting_date"]. ' + '.$testing_days.' days'));
					if($one_material_assign_descri["cc_set_of_cube"] !=""){
						$joint_desciptions .= " Set of Cube: ".$one_material_assign_descri["cc_set_of_cube"]."<br>";
					}
					if($one_material_assign_descri["cc_no_of_cube"] !=""){
						$joint_desciptions .= " No of Cube: ".$one_material_assign_descri["cc_no_of_cube"]."<br> ";
					}
					$joint_desciptions .= " Casting Date: ". date(("d-m-Y"),strtotime($one_material_assign_descri["casting_date"]))."<br> Testing Date: ".date(("d-m-Y"),strtotime($testing_dates))."<br>";
					}
				    if($one_material_assign_descri["cc_day"] !=""){
						$joint_desciptions .= " Days: ".$one_material_assign_descri["cc_day"]."<br>";
					}


					if($one_material_assign_descri["cc_identification_mark"] !=""){
						$joint_desciptions .= " ID Mark: ".$one_material_assign_descri["cc_identification_mark"]."<br>";
					}
					if($one_material_assign_descri["cc_grade"] !=""){
						$joint_desciptions .= " Grade: ".$one_material_assign_descri["cc_grade"]."<br>";
					}


					$joint_desciptions .="<br>";
					$qty_parm = "3 Nos.";

				}

				if($row_material_name["mt_prefix"]=="FX")
				{
					$joint_desciptions .="Type: Flexural Beam<br>";
				    if($one_material_assign_descri["casting_date"] !=""){

                    $testing_days=$one_material_assign_descri["cc_day"];
					$testing_dates=date('Y-m-d', strtotime($one_material_assign_descri["casting_date"]. ' + '.$testing_days.' days'));
					if($one_material_assign_descri["cc_set_of_cube"] !=""){
						$joint_desciptions .= " Set of Beam: ".$one_material_assign_descri["cc_set_of_cube"]."<br>";
					}
					if($one_material_assign_descri["cc_no_of_cube"] !=""){
						$joint_desciptions .= " No of Beam: ".$one_material_assign_descri["cc_no_of_cube"]."<br> ";
					}
					$joint_desciptions .= " Casting Date: ". date(("d-m-Y"),strtotime($one_material_assign_descri["casting_date"]))."<br> Testing Date: ".date(("d-m-Y"),strtotime($testing_dates))."<br>";
					}
				    if($one_material_assign_descri["cc_day"] !=""){
						$joint_desciptions .= " Days: ".$one_material_assign_descri["cc_day"]."<br>";
					}


					if($one_material_assign_descri["cc_identification_mark"] !=""){
						$joint_desciptions .= " ID Mark: ".$one_material_assign_descri["cc_identification_mark"]."<br>";
					}
					if($one_material_assign_descri["cc_grade"] !=""){
						$joint_desciptions .= " Grade: ".$one_material_assign_descri["cc_grade"]."<br>";
					}


					$joint_desciptions .="<br>";
					$qty_parm = "3 Nos.";
				}

				if($row_material_name["mt_prefix"]=="PB")
				{
				    if($one_material_assign_descri["paver_shape"] !=""){
						$joint_desciptions .= " Shape: ".$one_material_assign_descri["paver_shape"]."<br>";
					}
					/* if($one_material_assign_descri["paver_age"] !=""){
						$joint_desciptions .= " Age: ".$one_material_assign_descri["paver_age"]."<br>";
					} */
					if($one_material_assign_descri["paver_color"] !=""){
						$joint_desciptions .= " Color: ".$one_material_assign_descri["paver_color"]."<br>";
					}
					if($one_material_assign_descri["paver_thickness"] !=""){
						$joint_desciptions .= " Thickness: ".$one_material_assign_descri["paver_thickness"]."<br>";
					}
					if($one_material_assign_descri["paver_grade"] !=""){
						$joint_desciptions .= " Grade: ".$one_material_assign_descri["paver_grade"]."<br>";
					}
					$qty_parm = "11 Nos.";
				}

				if($row_material_name["mt_prefix"]=="SO")
				{
				    if($one_material_assign_descri["soil_location"] !=""){
						$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
					$qty_parm = "1 Bag.";
				}

				if($row_material_name["mt_prefix"]=="MU")
				{
				    if($one_material_assign_descri["soil_location"] !=""){
						$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
					$qty_parm = "1 Bag.";
				}

				if($row_material_name["mt_prefix"]=="SC")
				{
				    if($one_material_assign_descri["type_method"] !=""){
						$joint_desciptions .= " Type: ".$one_material_assign_descri["type_method"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
					$qty_parm = "1 Nos.";
				}

				if($row_material_name["mt_prefix"]=="DC")
				{
				    if($one_material_assign_descri["type_method"] !=""){
						$joint_desciptions .= " Type: ".$one_material_assign_descri["type_method"]."<br>";
					}

					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
					$qty_parm = "1 Nos.";
				}

				if($row_material_name["mt_prefix"]=="DD")
				{
				    if($one_material_assign_descri["type_method"] !=""){
						$joint_desciptions .= " Type: ".$one_material_assign_descri["type_method"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
					$qty_parm = "1 Nos.";
				}

				if($row_material_name["mt_prefix"]=="ST")
				{
				    if($one_material_assign_descri["steel_dia"] !=""){
						$joint_desciptions .= " Dia: ".$one_material_assign_descri["steel_dia"]."<br>";
					}
					if($one_material_assign_descri["steel_grade"] !=""){
						$joint_desciptions .= " Grade: ".$one_material_assign_descri["steel_grade"]."<br>";
					}
					if($one_material_assign_descri["steel_brand"] !=""){
						$joint_desciptions .= " Brand: ".$one_material_assign_descri["steel_brand"]."<br>";
					}
					$qty_parm = "3 Nos.";
				}

				if($row_material_name["mt_prefix"]=="WA")
				{
				    if($one_material_assign_descri["water_source"] !=""){
						$joint_desciptions .= " Source: ".$one_material_assign_descri["water_source"]."<br>";
					}
				}

				if($row_material_name["mt_prefix"]=="TI")
				{
				    if($one_material_assign_descri["water_specification"] !=""){
						$joint_desciptions .= " Specification: ".$one_material_assign_descri["water_specification"]."<br>";
					}
					if($one_material_assign_descri["water_brand"] !=""){
						$joint_desciptions .= " Brand: ".$one_material_assign_descri["water_brand"]."<br>";
					}
				}

				if($row_material_name["mt_prefix"]=="FI")
				{
				    if($one_material_assign_descri["fine_aggregate_source"] !=""){
						$joint_desciptions .= " Source: ".$one_material_assign_descri["fine_aggregate_source"]."<br>";
					}
					if($one_material_assign_descri["fine_agg_type"] !=""){
						$joint_desciptions .= " Type: ".$one_material_assign_descri["fine_agg_type"]."<br>";
					}
					$qty_parm = "1 Bag.";
				}

				if($row_material_name["mt_prefix"]=="QU")
				{
				    if($one_material_assign_descri["quarry_spall_source"] !=""){
						$joint_desciptions .= " Source: ".$one_material_assign_descri["quarry_spall_source"]."<br>";
					}
					$qty_parm = "1 Bag.";
				}

				if($row_material_name["mt_prefix"]=="BM")
				{
				    if($one_material_assign_descri["bit_mix"] !=""){
						$joint_desciptions .= " Type: ".$one_material_assign_descri["bit_mix"]."<br>";
					}
					$qty_parm = "3 Mould.";
				}


				array_push($matreials_id_array,$materials_ids);
						if(strpos($row_material_name["mt_name"],"WMM (MIX MATERIAL)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - I MIX (M4-1)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - II MIX (M4-2)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - III MIX (M4-1)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - IV MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - V MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - VI MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - I MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - III MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - II MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - I MIX (M4-2)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - II MIX (M4-1)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - III MIX (M4-2)") !== false ||
							strpos($row_material_name["mt_name"],"MSS - A (MIX MATERIAL)") !== false ||
							strpos($row_material_name["mt_name"],"MSS - B (MIX MATERIAL)") !== false ||
							strpos($row_material_name["mt_name"],"BUSG - CA") !== false ||
							strpos($row_material_name["mt_name"],"BUSG - KA") !== false ||
							strpos($row_material_name["mt_name"],"BM - 2 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"BM - 1 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"BC - 2 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"BC - 1 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"DBM - 1 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"DBM - 2 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"SDBC - 1 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"SDBC - 2 (MIX MATERIAL)") !== false)
							{

									if(strpos($row_material_name["mt_name"],"WMM") !== false)
									{
										$ansss = "WMM";
									}
									else if(strpos($row_material_name["mt_name"],"GSB") !== false)
									{
										$ansss = "GSB";

									}
									else if(strpos($row_material_name["mt_name"],"MSS") !== false)
									{
										$ansss = "MSS";

									}
									else if(strpos($row_material_name["mt_name"],"BUSG") !== false)
									{
										$ansss = "BUSG";

									}
									else if(strpos($row_material_name["mt_name"],"DBM") !== false)
									{
										$ansss = "DBM";

									}
									else if(strpos($row_material_name["mt_name"],"BM") !== false)
									{
										$ansss = "BM";

									}
									else if(strpos($row_material_name["mt_name"],"SDBC") !== false)
									{
										$ansss = "SDBC";

									}
									else if(strpos($row_material_name["mt_name"],"BC") !== false)
									{
										$ansss = "BC";

									}






							}
							else
							{
								if(strpos($row_material_name["mt_name"],"WMM") !== false ||
									strpos($row_material_name["mt_name"],"WBM") !== false ||
									strpos($row_material_name["mt_name"],"RCC") !== false ||
									strpos($row_material_name["mt_name"],"GSB") !== false ||
									strpos($row_material_name["mt_name"],"BM") !== false ||
									strpos($row_material_name["mt_name"],"BC") !== false ||
									strpos($row_material_name["mt_name"],"SDBC") !== false ||
									strpos($row_material_name["mt_name"],"MSS") !== false ||
									strpos($row_material_name["mt_name"],"DBM") !== false ||
									strpos($row_material_name["mt_name"],"BUSG") !== false ||
									strpos($row_material_name["mt_name"],"Seal Coat") !== false ||
									strpos($row_material_name["mt_name"],"Premix Carpet") !== false)
									{
										$ansss = "Coarse Aggregate";
									}
									else
									{
										if(strpos($row_material_name["mt_name"],"C.C.Cube") !== false || strpos($row_material_name["mt_name"],"Flexural Strength of Concrete Beam") !== false)
										{
											$ansss = "Concrete";
										}
										else
										{
											if(strpos($row_material_name["mt_name"],"FLY ASH BRICK") !== false || strpos($row_material_name["mt_name"],"BURNT CLAY BRICK") !== false)
											{
												$ansss = "Brick";
											}
											else
											{
												$ansss =$row_material_name["mt_name"];
											}

										}

									}

							}



						array_push($matreials_name_array,$ansss);
						array_push($matreials_desc_array,$joint_desciptions);
						array_push($matreials_qty_array,$qty_parm);
						array_push($matreials_test_array,$joint_test);
						array_push($matreials__method_array,$joint_test_methods);
						array_push($matreials_ulr_array,ltrim($one_final_materials["ulr_no"],"0"));

				 /* if (!in_array($materials_ids, $matreials_id_array))
				  {
						array_push($matreials_id_array,$materials_ids);
						if(strpos($row_material_name["mt_name"],"WMM (MIX MATERIAL)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - I MIX (M4-1)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - II MIX (M4-2)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - III MIX (M4-1)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - IV MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - V MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - VI MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - I MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - III MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - II MIX (M5)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - I MIX (M4-2)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - II MIX (M4-1)") !== false ||
							strpos($row_material_name["mt_name"],"GSB - III MIX (M4-2)") !== false ||
							strpos($row_material_name["mt_name"],"MSS - A (MIX MATERIAL)") !== false ||
							strpos($row_material_name["mt_name"],"MSS - B (MIX MATERIAL)") !== false ||
							strpos($row_material_name["mt_name"],"BUSG - CA (MIX MATERIAL)") !== false ||
							strpos($row_material_name["mt_name"],"BUSG - KA (MIX MATERIAL)") !== false ||
							strpos($row_material_name["mt_name"],"BM - 2 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"BM - 1 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"BC - 2 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"BC - 1 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"DBM - 1 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"DBM - 2 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"SDBC - 1 (MIX MATERIAL)") !== false||
							strpos($row_material_name["mt_name"],"SDBC - 2 (MIX MATERIAL)") !== false)
							{

									if(strpos($row_material_name["mt_name"],"WMM") !== false)
									{
										$ansss = "WMM";
									}
									else if(strpos($row_material_name["mt_name"],"GSB") !== false)
									{
										$ansss = "GSB";

									}
									else if(strpos($row_material_name["mt_name"],"MSS") !== false)
									{
										$ansss = "MSS";

									}
									else if(strpos($row_material_name["mt_name"],"BUSG") !== false)
									{
										$ansss = "BUSG";

									}
									else if(strpos($row_material_name["mt_name"],"DBM") !== false)
									{
										$ansss = "DBM";

									}
									else if(strpos($row_material_name["mt_name"],"BM") !== false)
									{
										$ansss = "BM";

									}
									else if(strpos($row_material_name["mt_name"],"SDBC") !== false)
									{
										$ansss = "SDBC";

									}
									else if(strpos($row_material_name["mt_name"],"BC") !== false)
									{
										$ansss = "BC";

									}





							}
							else
							{
								if(strpos($row_material_name["mt_name"],"WMM") !== false ||
									strpos($row_material_name["mt_name"],"WBM") !== false ||
									strpos($row_material_name["mt_name"],"RCC") !== false ||
									strpos($row_material_name["mt_name"],"GSB") !== false ||
									strpos($row_material_name["mt_name"],"BM") !== false ||
									strpos($row_material_name["mt_name"],"BC") !== false ||
									strpos($row_material_name["mt_name"],"SDBC") !== false ||
									strpos($row_material_name["mt_name"],"MSS") !== false ||
									strpos($row_material_name["mt_name"],"DBM") !== false ||
									strpos($row_material_name["mt_name"],"BUSG") !== false)
									{
										$ansss = "Coarse Aggregate";
									}
									else
									{
										if(strpos($row_material_name["mt_name"],"C.C.Cube") !== false || strpos($row_material_name["mt_name"],"Flexural Strength of Concrete Beam") !== false)
										{
											$ansss = "Concrete";
										}
										else
										{
											if(strpos($row_material_name["mt_name"],"FLY ASH BRICK") !== false || strpos($row_material_name["mt_name"],"BURNT CLAY BRICK") !== false)
											{
												$ansss = "Brick";
											}
											else
											{
												$ansss =$row_material_name["mt_name"];
											}

										}

									}

							}



						array_push($matreials_name_array,$ansss);
						array_push($matreials_desc_array,$joint_desciptions);
						array_push($matreials_qty_array,$qty_parm);
						array_push($matreials_test_array,$joint_test);
						array_push($matreials__method_array,$joint_test_methods);
						array_push($matreials_ulr_array,ltrim($one_final_materials["ulr_no"],"0"));
				  }
				else
				  {
				       $key = array_search ($materials_ids, $matreials_id_array);

					   if($row_material_name["mt_prefix"]=="PB")
						{

								$pb_explode = explode(" Nos.",$matreials_qty_array[$key]);
								$pb_ans = $pb_explode[0];
								$pb_qty = intval($pb_ans) + 11;
								$matreials_qty_array[$key] = $pb_qty." Nos.";

						}
						else if($row_material_name["mt_prefix"]=="BR")
						{

								$pb_explode = explode(" Nos.",$matreials_qty_array[$key]);
								$pb_ans = $pb_explode[0];
								$pb_qty = intval($pb_ans) + 20;
								$matreials_qty_array[$key] = $pb_qty." Nos.";

						}
						else if($row_material_name["mt_prefix"]=="FB")
						{

								$pb_explode = explode(" Nos.",$matreials_qty_array[$key]);
								$pb_ans = $pb_explode[0];
								$pb_qty = intval($pb_ans) + 20;
								$matreials_qty_array[$key] = $pb_qty." Nos.";

						}
						else if($row_material_name["mt_prefix"]=="CC")
						{

								$pb_explode = explode(" Nos.",$matreials_qty_array[$key]);
								$pb_ans = $pb_explode[0];
								$pb_qty = intval($pb_ans) + 3;
								$matreials_qty_array[$key] = $pb_qty." Nos.";

						}
						else if($row_material_name["mt_prefix"]=="FX")
						{

								$pb_explode = explode(" Nos.",$matreials_qty_array[$key]);
								$pb_ans = $pb_explode[0];
								$pb_qty = intval($pb_ans) + 3;
								$matreials_qty_array[$key] = $pb_qty." Nos.";

						}
						else if($row_material_name["mt_prefix"]=="ST")
						{

								$pb_explode = explode(" Nos.",$matreials_qty_array[$key]);
								$pb_ans = $pb_explode[0];
								$pb_qty = intval($pb_ans) + 3;
								$matreials_qty_array[$key] = $pb_qty." Nos.";

						}
						else
						{
							$matreials_qty_array[$key]= intval($matreials_qty_array[$key])+1;
						}


					   if($materials_ids==129){
					   $matreials_desc_array[$key]=$matreials_desc_array[$key]."<br>".$joint_desciptions;
					   $matreials_ulr_array[$key]= $matreials_ulr_array[$key]."<br><br>".ltrim($one_final_materials["ulr_no"],"0");
					   }else{

						 $matreials_ulr_array[$key]= $matreials_ulr_array[$key]."<br>".ltrim($one_final_materials["ulr_no"],"0");
					   }

				  }*/

			}
		}

			foreach($matreials_name_array as $keying => $matreials_name_one )
			{  $counts= $keying+1;
			?>
			<tr>
			<td class="tdclass" style="padding:5px;"><?php echo $counts;?></td>
			<td class="tdclass" style="padding:5px;"><?php echo $matreials_name_one;?></td>
			<td class="tdclass" style="padding:5px;"><?php echo $matreials_desc_array[$keying];?></td>
			<td class="tdclass" style="padding:5px;padding-left: 17px;"><input type="text" class="txt_qty" value="<?php echo $matreials_qty_array[$keying];?>" style="width: 100%;height: 36px;border:0px;"></td>
			<td class="tdclass" style="padding:0px">
			
			    <table align="center" width="100%" class="test"  style="font-family: Book Antiqua;">
					<?php echo $matreials_test_array[$keying];?>
				</table>
			
			<?php //echo $joint_test;?>
			</td>
			<td class="tdclass" style="padding:0px;">
			
				<table align="center" width="100%" class="test"  style="font-family: Book Antiqua;">
					<?php echo $matreials__method_array[$keying];?>
				</table>
			
			</td>
			<td class="tdclass" style="padding:5px;text-align:center;"><?php echo $matreials_ulr_array[$keying];?></td>
		</tr>
		 </tbody>
			<?php

			}


		?>
		</table>


		<div class="pagebreak"> </div>


		<br>
		<br>
		<table align="center" width="98%" class="test" id="table_1" border="1px" style="font-family: Book Antiqua;height: 120px;">
		<tr>
				<td rowspan="6" width="5%">
				<img src="images/mat_logo.png" style="width:150px;">
				</td>
				<td rowspan="6" colspan="3" width="40%">
				<b style="font-size: 19px;">MATTEST ENGINEERING SERVICES</b>
				<p style="margin-top: 6px;margin-bottom: 25px;">A-39,40,41, City Industrial Estate Udhna Navsari</br>
				 Main Road, Udhna, Surat 394210</p>
				<b style="font-size: 15px;">TEST REQUEST FORM</b>
				</td>

				<td style="padding:5px;font-size:12px;"  width="10%">Doc. No.</td>
				<td style="padding:5px;font-size:11px;"  width="10%">F/7.1/01</td>
		</tr>
		<tr>

				<td style="padding:5px;font-size:12px;"  width="10%">Issue No.</td>
				<td style="padding:5px;font-size:11px;"  width="10%">04</td>
		</tr>
		<tr>

				<td style="padding:5px;font-size:12px;"  width="10%">Amend No.</td>
				<td style="padding:5px;font-size:11px;"  width="10%">00</td>
		</tr>
		<tr>

				<td style="padding:5px;font-size:12px;"  width="10%">Issue Date</td>
				<td style="padding:5px;font-size:11px;"  width="10%">01.04.2019</td>
		</tr>
		<tr>

				<td style="padding:5px;font-size:12px;"  width="10%">Amend Date</td>
				<td style="padding:5px;font-size:11px;"  width="10%">--</td>
		</tr>
		<tr>
			    <td colspan="2" style="padding:5px;font-size:12px;" width="10%">Page 1 of 2 </td>
		</tr>

		</table>
		<br>
		<table align="center" width="98%" class="test" border="1px" style="font-family: Book Antiqua;">
		<tr class="tdclass">
		<td style="padding: 5px;background-color:#A9A9A9;font-size:12px;">
				<b>REQUIREMENT REVIEW</b>
				</td>
				<td  colspan="2" style="padding: 5px;font-size:12px;background-color:#A9A9A9;border-left:1px solid black;">
				<b>PL. Tick Mark</b>
				</td>
		</tr>
		<tr class="tdclass">
				<td style="padding: 5px;width:86%" >
				Information provided by you are intends to place in the public domain by testing laboratory, are you agree?
				</td>
				<td style="padding: 5px;width:7%">Yes</td>
				<td style="padding: 5px;width:7%">No</td>
		</tr>
		<tr class="tdclass">
				<td style="padding: 5px;">
				Do wish to incorporate the conformity statement in the Test Report?
				</td>
				<td style="padding: 5px;">Yes</td>
				<td style="padding: 5px;">No</td>
		</tr>
		<tr class="tdclass">
				<td style="padding: 5px;">
				Whether decision rule defined clearly and agreed by the customer?
				</td>
				<td style="padding: 5px;">Yes</td>
				<td style="padding: 5px;">No</td>
		</tr>
		<tr class="tdclass">
				<td colspan="3" style="padding: 5px;">If Yes,Decision Rule:</td>
		</tr>
		<tr class="tdclass">
				<td colspan="3" style="padding: 5px;">
				Hard Copy or Soft Copy of the Test Report Required? (please tick Mark)<br>
				(Hard Copy/Soft Copy)<br>
				In case of soft copy, Email-id:...........................................................................
				</td>
		</tr>
		<tr >
				<td colspan="3" style="padding: 5px;font-size:12px;">
				<b>Customer's Name & Signature:</b>
				</td>
		</tr>

		</table>
		<br>
		<table align="center" width="98%" class="test" border="1px" style="font-family: Book Antiqua;">
		<tr style="background-color:#A9A9A9">

				<td  style="padding: 5px;background-color:#A9A9A9;font-size:12px;">
				<b>CHECKLIST-TEST ITEM/SAMPLE RECEIVING</b>
				</td>
				<td colspan="2" style="padding: 5px;font-size:12px;background-color:#A9A9A9;border-left:1px solid black;">
				<b>PL. Tick Mark</b>
				</td>
		</tr>
		<tr class="tdclass">
				<td style="padding: 5px;width:86%">
				Does sample bear proper indentification/label?
				</td>
				<td style="padding: 5px;text-align:center;width:7%"><b>Yes</b></td>
				<td style="padding: 5px;text-align:center;width:7%"><b>No</b></td>
		</tr>
		<tr class="tdclass">
				<td style="padding: 5px;">
				Does sample have sufficient Quantity?
				</td>
				<td style="padding: 5px;text-align:center;"><b>Yes</b></td>
				<td style="padding: 5px;text-align:center;"><b>No</b></td>
		</tr>
		<tr class="tdclass" >
				<td style="padding: 5px;">
				Does sample pack in proper bag/container?
				</td>
				<td style="padding: 5px;text-align:center;"><b>Yes</b></td>
				<td style="padding: 5px;text-align:center;"><b>No</b></td>
		</tr>
		<tr class="tdclass">
				<td style="padding: 5px;">
				Test witness by the customer?
				</td>
				<td style="padding: 5px;text-align:center;"><b>Yes</b></td>
				<td style="padding: 5px;text-align:center;"><b>No</b></td>
		</tr>
		<tr class="tdclass">
				<td colspan="3" style="padding: 5px;">
				<b>Sample condition for Testing at the time of receipt:</b>&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox">&nbsp;&nbsp;Acceptable&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox">&nbsp;&nbsp;Not Acceptable<br>
				If Not acceptable Remark:
				</td>
		</tr>
		<tr>
				<td colspan="3" style="padding: 5px;font-size:12px;">
				<b>RECEIVER'S SIGNATURE:</b>
				</td>
		</tr>

		</table>
		<br>
		<table align="center" width="98%" class="test" border="1px" style="font-family: Book Antiqua;">
		<tr>
				<td colspan="2" style="padding: 5px;background-color:#A9A9A9;font-size:12px;">
				<b>REQUIREMENT REVIEW</b>
				</td>
				<td colspan="2" style="padding: 5px;font-size:12px;background-color:#A9A9A9;border-left:1px solid black;">
				<b>PL. Tick Mark</b>
				</td>
		</tr>
		<tr class="tdclass">
				<td colspan="2" style="padding: 5px;width:86%">
				The requirements, including the test methods to be used,are adequately defined,documented and understood by the laboratory;
				</td>
				<td style="padding: 5px;width:7%">Yes</td>
				<td style="padding: 5px;width:7%">No</td>
		</tr>
		<tr class="tdclass">
				<td colspan="2" style="padding: 5px;">
				The laboratory has the capability and resources to meet the requirements;
				</td>
				<td style="padding: 5px;">Yes</td>
				<td style="padding: 5px;">No</td>
		</tr>
		<tr class="tdclass">
				<td colspan="2" style="padding: 5px;">
				The appropriate test method is selected and is capable of meeting the customer's requirements.
				</td>
				<td style="padding: 5px;">Yes</td>
				<td style="padding: 5px;">No</td>
		</tr>
		<tr class="tdclass">
				<td colspan="4" style="padding: 5px;">
				Request / Contrat review process repeated as amendment is received after work has commenced and the<br>
				amendment has been communicated to lab personnel:&nbsp;&nbsp;<input type="checkbox">&nbsp;&nbsp;<b>Applicable&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox">&nbsp;&nbsp;No applicable</b>
				</td>
		</tr>
		<tr class="tdclass">
				<td colspan="4" style="padding: 5px;">
				Intimate the Customer,if any deviation from the request/contract:&nbsp;&nbsp; <input type="checkbox">&nbsp;&nbsp;<b>Deviation&nbsp;&nbsp;<input type="checkbox">&nbsp;&nbsp;No deviation</b><br>  intimated.
				</td>
		</tr>
		<tr class="tdclass">
				<td style="padding: 5px;font-size:12px;">
				Difference has been satisfactorily resolved before any work commenced.
				</td>
				<td style="padding: 5px;">Yes</td>
				<td style="padding: 5px;">No</td>
				<td style="padding: 5px;">N/A</td>
		</tr>
		<tr>
				<td colspan="4" style="padding: 5px;font-size:12px;">
				<b>REQUIREMENT REVIEWER'S SIGNATURE :</b>
				</td>
		</tr>

		</table>
		<br>
		<table align="center" width="98%" class="test" border="1px" style="font-family: Book Antiqua;">
		<tr>
				<td colspan="4" style="padding: 5px;background-color:#A9A9A9;font-size:12px;">
				<b>DETAILS OF SAMPLE DISPOSAL</b>
				</td>
		</tr>
		<tr class="tdclass">
				<td colspan="4" style="padding: 5px;">
				Sample Dispose Date..............................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;By...............................................................
				</td>

		</tr>
		</table>
		<br>
		<table align="center" width="98%" class="test" border="1px" style="font-family: Book Antiqua;">
		<tr style="background-color:#A9A9A9">
				<td colspan="2" style="padding: 5px;font-size:12px;">
				<b>Prepared & Issued by:&nbsp;&nbsp;QM</b>
				</td>
				<td colspan="2" style="padding: 5px;font-size:12px;">
				<b>Reviewed & Approved by:&nbsp;&nbsp;CEO</b>
				</td>
		</tr>
		</table>
		</page>
		</div>
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
