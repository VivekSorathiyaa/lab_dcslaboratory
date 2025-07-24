<?php 
session_start();
include("connection.php");
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<style>

@page {  
margin: 5mm 5mm 5mm 5mm; 
}




.tdclass{
    border-top:2px solid black;
	width:500px;
	font-size:60px;
	text-align:center;
	font-family: Book Antiqua;
}
.test {
    border-collapse: collapse;
}
.tdclass1{
    text-align:center;
    border-top:2px solid black;
	width:500px;
	font-size:30px;
	font-family: Book Antiqua;
}

@media print {
	@page
    .pagebreak { page-break-after: always; } /* page-break-after works, as well */
}


	/*#table_1 {
        page-break-inside: auto;
		
      }
     #table_1 tr {
        page-break-inside: avoid;
        page-break-after: avoid;
		
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
  }*/

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
		
		
		// get name of agency by report no and job no from agency table
		$sel_agency_id=$row_estiamte["agency"];
		
		$sel_agency="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$sel_agency_id;
		$result_agency =mysqli_query($conn,$sel_agency);
		$row_agency =mysqli_fetch_array($result_agency);
		$agency_name=$row_agency["agency_name"];
		$agency_address=$row_agency["agency_address"];
		$agency_gst=$row_agency["agency_gstno"];
		$agency_email=$row_agency["agency_email"];
		
		
		$name_of_work= strip_tags(html_entity_decode($row_estiamte["nameofwork"]),"<strong><em>");
			
?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
		
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
		$query_static_ulr_no=mysqli_query($conn,$sel_static_ulr_no);
		$row_static_ulr_no =mysqli_fetch_array($query_static_ulr_no);
		$static_ulr_nos= $row_static_ulr_no["ulr_no"];
		
		// final material assign table data
		$get_final_material="select * from final_material_assign_master where `trf_no`='$get_report_no' AND `job_no`='$get_job_no' AND `is_deleted`='0' ORDER BY `final_material_id` ASC";
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
				

				
				//data by trf_no/job_no/labno/m_cate_material
				$sel_material_assign="select * from span_material_assign where `material_category`='$one_final_materials[material_category]' AND `material_id`='$one_final_materials[material_id]' AND `trf_no`='$one_final_materials[trf_no]' AND `job_number`='$one_final_materials[job_no]' AND `lab_no`='$one_final_materials[lab_no]'";
				$result_material_assign =mysqli_query($conn,$sel_material_assign);
				
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
				$sel_material_assign_descri="select * from span_material_assign where `material_category`='$one_final_materials[material_category]' AND `material_id`='$one_final_materials[material_id]' AND `trf_no`='$one_final_materials[trf_no]' AND `job_number`='$one_final_materials[job_no]' AND `lab_no`='$one_final_materials[lab_no]'";
				$result_material_assign_descri =mysqli_query($conn,$sel_material_assign_descri);
				$one_material_assign_descri=mysqli_fetch_assoc($result_material_assign_descri);
				
				// condition of material prefix
				$joint_desciptions="";
				
				if($row_material_name["mt_prefix"]=="CM")
				{
				    if($one_material_assign_descri["type_of_cement"] !=""){
						//$joint_desciptions .= "Type: ".$one_material_assign_descri["type_of_cement"]."<br>";
					}
					if($one_material_assign_descri["cement_grade"] !=""){
						$joint_desciptions .= " Grade: ".$one_material_assign_descri["cement_grade"]."<br>";
					}
					if($one_material_assign_descri["cement_brand"] !=""){
						//$joint_desciptions .= " Brand: ".$one_material_assign_descri["cement_brand"]."<br>";
					}
					if($one_material_assign_descri["week_number"] !=""){
						//$joint_desciptions .= " Week No.: ".$one_material_assign_descri["week_number"]."<br>";
					}
				}
				
				if($row_material_name["mt_prefix"]=="CA")
				{
				    if($one_material_assign_descri["agg_source"] !=""){
						$joint_desciptions .= " Source: ".$one_material_assign_descri["agg_source"]."<br>";
					}
				}
				
				if($row_material_name["mt_prefix"]=="BR")
				{
				    if($one_material_assign_descri["brick_mark"] !=""){
						$joint_desciptions .= " Mark: ".$one_material_assign_descri["brick_mark"]."<br>";
					}
					if($one_material_assign_descri["brick_specification"] !=""){
						$joint_desciptions .= " Specification: ".$one_material_assign_descri["brick_specification"]."<br>";
					}
				}
				
				if($row_material_name["mt_prefix"]=="FB")
				{
				    if($one_material_assign_descri["brick_mark"] !=""){
						$joint_desciptions .= " Mark: ".$one_material_assign_descri["brick_mark"]."<br>";
					}
					if($one_material_assign_descri["brick_specification"] !=""){
						$joint_desciptions .= " Specification: ".$one_material_assign_descri["brick_specification"]."<br>";
					}
				}
				
				if($row_material_name["mt_prefix"]=="BT")
				{
				    if($one_material_assign_descri["tanker_no"] !=""){
						$joint_desciptions .= " Tanker No: ".$one_material_assign_descri["tanker_no"]."<br>";
					}
					if($one_material_assign_descri["lot_no"] !=""){
						$joint_desciptions .= " Lot No: ".$one_material_assign_descri["lot_no"]."<br>";
					}
					if($one_material_assign_descri["bitumin_grade"] !=""){
						$joint_desciptions .= " Grade: ".$one_material_assign_descri["bitumin_grade"]."<br>";
					}
					if($one_material_assign_descri["bitumin_make"] !=""){
						$joint_desciptions .= " Make.: ".$one_material_assign_descri["bitumin_make"]."<br>";
					}
				}
				
				if($row_material_name["mt_prefix"]=="CC")
				{
				    
					if($one_material_assign_descri["casting_date"] !=""){
					
                    $testing_days=$one_material_assign_descri["cc_day"];					
					$testing_dates=date('Y-m-d', strtotime($one_material_assign_descri["casting_date"]. ' + '.$testing_days.' days'));
					
					$joint_desciptions .= " Casting Date: ". date(("d-m-Y"),strtotime($one_material_assign_descri["casting_date"]))."<br>"." Testing Date:".date(("d-m-Y"),strtotime($testing_dates))."<br>";
					}
					if($one_material_assign_descri["cc_day"] !=""){
						$joint_desciptions .= " Days: ".$one_material_assign_descri["cc_day"]."<br>";
					}
					
					
				}
				
				if($row_material_name["mt_prefix"]=="FX")
				{
				    if($one_material_assign_descri["casting_date"] !=""){
					
                    $testing_days=$one_material_assign_descri["cc_day"];					
					$testing_dates=date('Y-m-d', strtotime($one_material_assign_descri["casting_date"]. ' + '.$testing_days.' days'));
					
					$joint_desciptions .= " Casting Date: ". date(("d-m-Y"),strtotime($one_material_assign_descri["casting_date"]))."<br>"." Testing Date:".date(("d-m-Y"),strtotime($testing_dates))."<br>";
					}
					if($one_material_assign_descri["cc_day"] !=""){
						$joint_desciptions .= " Days: ".$one_material_assign_descri["cc_day"]."<br>";
					}
					
				}
				
				if($row_material_name["mt_prefix"]=="PB")
				{
				    if($one_material_assign_descri["paver_shape"] !=""){
						$joint_desciptions .= " Shape: ".$one_material_assign_descri["paver_shape"]."<br>";
					}
					if($one_material_assign_descri["paver_age"] !=""){
						$joint_desciptions .= " Age: ".$one_material_assign_descri["paver_age"]."<br>";
					}
					if($one_material_assign_descri["paver_color"] !=""){
						$joint_desciptions .= " Color: ".$one_material_assign_descri["paver_color"]."<br>";
					}
					if($one_material_assign_descri["paver_thickness"] !=""){
						$joint_desciptions .= " Thickness: ".$one_material_assign_descri["paver_thickness"]."<br>";
					}
					if($one_material_assign_descri["paver_grade"] !=""){
						$joint_desciptions .= " Grade: ".$one_material_assign_descri["paver_grade"]."<br>";
					}
				}
				
				if($row_material_name["mt_prefix"]=="SO")
				{
				    if($one_material_assign_descri["soil_location"] !=""){
						$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
				}
				
				if($row_material_name["mt_prefix"]=="MU")
				{
				    if($one_material_assign_descri["soil_location"] !=""){
						$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
				}
				
				if($row_material_name["mt_prefix"]=="SC")
				{
				    if($one_material_assign_descri["soil_location"] !=""){
						$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
				}
				
				if($row_material_name["mt_prefix"]=="DC")
				{
				    if($one_material_assign_descri["soil_location"] !=""){
						$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
				}
				
				if($row_material_name["mt_prefix"]=="DD")
				{
				    if($one_material_assign_descri["soil_location"] !=""){
						$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
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
				}
				
				if($row_material_name["mt_prefix"]=="QU")
				{
				    if($one_material_assign_descri["quarry_spall_source"] !=""){
						$joint_desciptions .= " Source: ".$one_material_assign_descri["quarry_spall_source"]."<br>";
					}
				}
				
				if($row_material_name["mt_prefix"]=="BM")
				{
				    if($one_material_assign_descri["bit_mix"] !=""){
						$joint_desciptions .= " Source: ".$one_material_assign_descri["bit_mix"]."<br>";
					}
				}
				
				
				  
				        array_push($matreials_id_array,$materials_ids);
						array_push($matreials_name_array,$row_material_name["mt_name"]);
						array_push($matreials_desc_array,$joint_desciptions);
						array_push($matreials_qty_array,1);
						array_push($matreials_test_array,$joint_test);
						array_push($matreials__method_array,$joint_test_methods);
						array_push($matreials_ulr_array,$one_final_materials["lab_no"]);
				  
			}
			}
			?>
			
			<page size="A4">
			<?php
			$material_counts=1;
			foreach($matreials_name_array as $keying => $matreials_name_one )
			{  
			?>
					
					<!--<div style="height:350px;width:500px;">-->
					<table align="center" style="border: 3px solid black; font-family: Book Antiqua;height:370;width:500px;float:left;margin:8px;">
					
					<tr>
						<td  colspan="2" class="tdclass">Job No</td>
					</tr>
					<tr>
						<td colspan="2" class="tdclass1">					
						<?php 
							$explode_url_for_counts=explode(",",$matreials_ulr_array[$keying]);
							
							echo ltrim($explode_url_for_counts[0],"0");
							
							?>					
						</td>
					</tr>
					<tr>
						<td  colspan="2" class="tdclass">Material Name</td>
					</tr>
					<tr>
						<td colspan="2" class="tdclass1">
						<?php echo $matreials_name_one; ?>					
						</td>
					</tr>
					
					</table>
					
					<?php 
					$material_counts++;
					if($material_counts==8){
						
						?>
					<div class="pagebreak"></div>
					<?php
					$material_counts=1;
					} ?>
					<!--</div>-->
					
					
					
			<?php
			
			}	
			?>
			</page>
					
			
		
	
	</body>
</html>

<script type="text/javascript">
window.onload = function(){ 
	setTimeout(function()
		{
			
			window.print();
		}, 
		1000);

}



</script>