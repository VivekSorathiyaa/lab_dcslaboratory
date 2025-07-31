<?php
error_reporting(1);
session_start();
include("connection.php");
// get estimate by report no and job no
$get_report_no = $_GET["trf_no"];
$get_job_no = $_GET["job_no"];
$temporary_trf_no = $_GET["temporary_trf_no"];
$sel_estiamte = "select * from job where `trf_no`='$get_report_no' AND `temporary_trf_no`='$temporary_trf_no'";
$result_estiamte = mysqli_query($conn, $sel_estiamte);
$row_estiamte = mysqli_fetch_array($result_estiamte);
$branch_id = $row_estiamte["branch_id"];

$sel_branch = "select * from branches where `branch_id`=" . $branch_id;
$query_branch = mysqli_query($conn, $sel_branch);
$row_branch = mysqli_fetch_array($query_branch);
$company_name = $row_branch["company_name"];
$company_logo = $row_branch["company_logo"];
$company_address = $row_branch["company_address"];

$radio_1 = $row_estiamte["radio_1"];
$radio_2 = $row_estiamte["radio_2"];
$radio_3 = $row_estiamte["radio_3"];
$radio_4 = $row_estiamte["radio_4"];
$radio_5 = $row_estiamte["radio_5"];
$radio_6 = $row_estiamte["radio_6"];
$radio_7 = $row_estiamte["radio_7"];
$radio_8 = $row_estiamte["radio_8"];
$radio_9 = $row_estiamte["radio_9"];
$radio_10 = $row_estiamte["radio_10"];
$radio_11 = $row_estiamte["radio_11"];
$acceptable = $row_estiamte["acceptable"];
$applicable = $row_estiamte["applicable"];
$deviation = $row_estiamte["deviation"];

if ($radio_1 == "yes") {
	$radio_1 = "&#10004;";

} else {

	$radio_1 = "&#10006;";
}

if ($radio_2 == "yes") {
	$radio_2 = "&#10004;";

} else {

	$radio_2 = "&#10006;";
}

if ($radio_3 == "yes") {
	$radio_3 = "&#10004;";

} else {

	$radio_3 = "&#10006;";
}

if ($radio_4 == "yes") {
	$radio_4 = "&#10004;";

} else {

	$radio_4 = "&#10006;";
}


if ($radio_8 == "yes") {
	$radio_8 = "&#10004;";

} else {

	$radio_8 = "&#10006;";
}

if ($radio_9 == "yes") {
	$radio_9 = "&#10004;";

} else {

	$radio_9 = "&#10006;";
}





if ($radio_5 == "yes") {
	$radio_5_y = "Yes";
	$radio_5_n = "<strike>No</strike>";
} else {
	$radio_5_y = "<strike>Yes</strike>";
	$radio_5_n = "No";
}

if ($radio_6 == "yes") {
	$radio_6_y = "Yes";
	$radio_6_n = "<strike>No</strike>";
} else {
	$radio_6_y = "<strike>Yes</strike>";
	$radio_6_n = "No";
}

if ($radio_7 == "yes") {
	$radio_7_y = "Yes";
	$radio_7_n = "<strike>No</strike>";
} else {
	$radio_7_y = "<strike>Yes</strike>";
	$radio_7_n = "No";
}



if ($radio_10 == "yes") {
	$radio_10_y = "Yes";
	$radio_10_n = "<strike>No</strike>";
} else {
	$radio_10_y = "<strike>Yes</strike>";
	$radio_10_n = "No";
}

if ($radio_11 == "yes") {
	$radio_11_y = "Yes";
	$radio_11_n = "<strike>No</strike>";
	$radio_11_na = "<strike>NA</strike>";
} elseif ($radio_11 == "no") {
	$radio_11_y = "<strike>Yes</strike>";
	$radio_11_n = "No";
	$radio_11_na = "<strike>NA</strike>";
} else {
	$radio_11_y = "<strike>Yes</strike>";
	$radio_11_n = "<strike>Yes</strike>";
	$radio_11_na = "NA";
}



if ($applicable == "yes") {
	$applicable_y = "checked";
	$applicable_n = "";
} else {
	$applicable_y = "";
	$applicable_n = "checked";
}

if ($deviation == "yes") {
	$deviation_y = "checked";
	$deviation_n = "";
} else {
	$deviation_y = "";
	$deviation_n = "checked";
}


$setting_date = date_create($row_estiamte["sample_rec_date"]);
$put_sample_rec_date = date_format($setting_date, "d.m.Y");

$setting_date_ref = date_create($row_estiamte["date"]);
$refrence_date = date_format($setting_date_ref, "d/m/Y");


// get name of agency by report no and job no from agency table
$sel_agency_id = $row_estiamte["agency"];

$sel_agency = "select * from agency_master where `isdeleted`=0 AND `agency_id`=" . $sel_agency_id;
$result_agency = mysqli_query($conn, $sel_agency);
$row_agency = mysqli_fetch_array($result_agency);
$agency_name = $row_agency["agency_name"];
$agency_address = $row_agency["agency_address"];
$agency_gst = $row_agency["agency_gstno"];
$agency_email = $row_agency["agency_email"];


$name_of_work = strip_tags(html_entity_decode($row_estiamte["nameofwork"]), "<strong><em>");


$matreials_id_array = array();
$matreials_name_array = array();
$matreials_desc_array = array();
$matreials_qty_array = array();
$matreials_test_array = array();
$matreials__method_array = array();
$matreials_ulr_array = array();
// static ulr no logic
$sel_static_ulr_no = "select * from ulr_no where `ulr_status`=0 AND `ulr_is_deleted`=0";
$query_static_ulr_no = mysqli_query($conn, $sel_static_ulr_no);
$row_static_ulr_no = mysqli_fetch_array($query_static_ulr_no);
$static_ulr_nos = $row_static_ulr_no["ulr_no"];

// final material assign table data
$get_final_material = "select * from final_material_assign_master where `trf_no`='$get_report_no' AND `job_no`='$get_job_no' AND `is_deleted`='0' ORDER BY final_material_id ASC";
$result_final_materials = mysqli_query($conn, $get_final_material);
$counts = 1;
$labs_nos = "";
if (mysqli_num_rows($result_final_materials) > 0) {
	while ($one_final_materials = mysqli_fetch_array($result_final_materials)) {
		// material name get code
		$materials_ids = $one_final_materials["material_id"];
		$sel_materials_names = "select * from material where `id`=$materials_ids AND `mt_isdeleted`=0";
		$result_material_name = mysqli_query($conn, $sel_materials_names);
		$row_material_name = mysqli_fetch_array($result_material_name);



		//data by trf_no/job_no/labno/m_cate_material
		$sel_material_assign = "select * from span_material_assign where `material_category`='$one_final_materials[material_category]' AND `material_id`='$one_final_materials[material_id]' AND `trf_no`='$one_final_materials[trf_no]' AND `job_number`='$one_final_materials[job_no]' AND `lab_no`='$one_final_materials[lab_no]'";
		$result_material_assign = mysqli_query($conn, $sel_material_assign);

		$labs_nos = $one_final_materials['lab_no'];
		$joint_test = "";
		$joint_test_methods = "";
		$counts_of_tr = mysqli_num_rows($result_material_assign);
		$counts_materials = 1;
		while ($one_material_assign = mysqli_fetch_array($result_material_assign)) {
			// test name by test id
			$sel_test_names = "select * from test_master where `test_id`=$one_material_assign[test] AND `test_isdeleted`=0";
			$result_test_names = mysqli_query($conn, $sel_test_names);
			$row_test_names = mysqli_fetch_array($result_test_names);

			//$joint_test .=$row_test_names["test_name"]."<br>";
			//$joint_test_methods .=$row_test_names["test_method"]."<br>";
			if ($counts_materials != $counts_of_tr) {
				$class_setting = "padding-left: 0px;font-size: 11px;border-bottom: 1px solid;";
			} else {

				$class_setting = "padding-left: 0px;font-size: 11px;border-bottom: 0px solid;";
			}

			$joint_test .= '<tr><td style="' . $class_setting . '">';
			$joint_test .= $row_test_names["test_name"];
			$joint_test .= '</td></tr>';

			$joint_test_methods .= '<tr><td style="' . $class_setting . '">';
			$joint_test_methods .= $row_test_names["test_method"];
			$joint_test_methods .= '</td></tr>';

			$counts_materials++;
		}

		//data by trf_no/job_no/labno/m_cate_material for description
		$sel_material_assign_descri = "select * from span_material_assign where `material_category`='$one_final_materials[material_category]' AND `material_id`='$one_final_materials[material_id]' AND `trf_no`='$one_final_materials[trf_no]' AND `job_number`='$one_final_materials[job_no]' AND `lab_no`='$one_final_materials[lab_no]'";
		$result_material_assign_descri = mysqli_query($conn, $sel_material_assign_descri);
		$one_material_assign_descri = mysqli_fetch_assoc($result_material_assign_descri);

		// condition of material prefix
		$joint_desciptions = "";
		$qty_parm = 1;
		if ($row_material_name["mt_prefix"] == "CM") {
			if ($one_material_assign_descri["type_of_cement"] != "") {
				$joint_desciptions .= "Type: " . $one_material_assign_descri["type_of_cement"] . "<br>";
			}
			if ($one_material_assign_descri["cement_grade"] != "") {
				$joint_desciptions .= " Grade: " . $one_material_assign_descri["cement_grade"] . "<br>";
			}
			if ($one_material_assign_descri["cement_brand"] != "") {
				$joint_desciptions .= " Brand: " . $one_material_assign_descri["cement_brand"] . "<br>";
			}
			if ($one_material_assign_descri["week_number"] != "") {
				$joint_desciptions .= " Week No.: " . $one_material_assign_descri["week_number"] . "<br>";
			}
			$qty_parm = "1 Bag.";
		}

		if ($row_material_name["mt_prefix"] == "CA") {
			if ($one_material_assign_descri["agg_source"] != "") {
				$joint_desciptions .= " Source: " . $one_material_assign_descri["agg_source"] . "<br>";
			}
			if (
				strpos($row_material_name["mt_name"], "WMM (MIX MATERIAL)") !== false ||
				strpos($row_material_name["mt_name"], "GSB - I MIX (M4-1)") !== false ||
				strpos($row_material_name["mt_name"], "GSB - II MIX (M4-2)") !== false ||
				strpos($row_material_name["mt_name"], "GSB - III MIX (M4-1)") !== false ||
				strpos($row_material_name["mt_name"], "GSB - IV MIX (M5)") !== false ||
				strpos($row_material_name["mt_name"], "GSB - V MIX (M5)") !== false ||
				strpos($row_material_name["mt_name"], "GSB - VI MIX (M5)") !== false ||
				strpos($row_material_name["mt_name"], "GSB - I MIX (M5)") !== false ||
				strpos($row_material_name["mt_name"], "GSB - III MIX (M5)") !== false ||
				strpos($row_material_name["mt_name"], "GSB - II MIX (M5)") !== false ||
				strpos($row_material_name["mt_name"], "GSB - I MIX (M4-2)") !== false ||
				strpos($row_material_name["mt_name"], "GSB - II MIX (M4-1)") !== false ||
				strpos($row_material_name["mt_name"], "GSB - III MIX (M4-2)") !== false ||
				strpos($row_material_name["mt_name"], "GSB - I MIX (COARSE GRADED)") !== false ||
				strpos($row_material_name["mt_name"], "GSB - II MIX (COARSE GRADED)") !== false ||
				strpos($row_material_name["mt_name"], "GSB - III MIX (COARSE GRADED)") !== false ||
				strpos($row_material_name["mt_name"], "MSS - A (MIX MATERIAL)") !== false ||
				strpos($row_material_name["mt_name"], "MSS - B (MIX MATERIAL)") !== false ||
				strpos($row_material_name["mt_name"], "BM - 2 (MIX MATERIAL)") !== false ||
				strpos($row_material_name["mt_name"], "BM - 1 (MIX MATERIAL)") !== false ||
				strpos($row_material_name["mt_name"], "BC - 2 (MIX MATERIAL)") !== false ||
				strpos($row_material_name["mt_name"], "BC - 1 (MIX MATERIAL)") !== false ||
				strpos($row_material_name["mt_name"], "DBM - 1 (MIX MATERIAL)") !== false ||
				strpos($row_material_name["mt_name"], "DBM - 2 (MIX MATERIAL)") !== false ||
				strpos($row_material_name["mt_name"], "SDBC - 1 (MIX MATERIAL)") !== false ||
				strpos($row_material_name["mt_name"], "SDBC - 2 (MIX MATERIAL)") !== false
			) {



				$joint_desciptions .= " Grade: " . ($row_material_name["mt_name"]) . "<br>";
			} else {
				if (strpos($row_material_name["mt_name"], "Seal Coat") !== false || strpos($row_material_name["mt_name"], "BUSG - CA") !== false || strpos($row_material_name["mt_name"], "BUSG - KA") !== false || strpos($row_material_name["mt_name"], "Premix Carpet") !== false) {
					$joint_desciptions .= " Size of Aggregate: " . $row_material_name["mt_name"] . "<br>";
				} else {
					$ans = substr($row_material_name["mt_name"], strpos($row_material_name["mt_name"], "(") + 1);
					$explodeing = explode(")", $ans);
					$second = $explodeing[0];
					$joint_desciptions .= " Size of Aggregate: " . ($second) . "<br>";
				}

			}
			$qty_parm = "1 Bag.";
		}


		if ($row_material_name["mt_prefix"] == "CO") {
			$joint_desciptions .= " Source: " . $one_material_assign_descri["agg_source"] . "<br>";
			$joint_desciptions .= " Size of Aggregate: " . $one_material_assign_descri["sample_de"] . "<br>";

			$qty_parm = "1 Bag.";
		}

		if ($row_material_name["mt_prefix"] == "BRK") {


			if ($one_material_assign_descri["brick_mark"] != "") {
				$joint_desciptions .= " Mark: " . $one_material_assign_descri["brick_mark"] . "<br>";
			}
			if ($one_material_assign_descri["brick_size"] != "") {
				$joint_desciptions .= " Brick_Size: " . $one_material_assign_descri["brick_size"] . "<br>";
			}
			if ($one_material_assign_descri["brick_specification"] != "") {
				$joint_desciptions .= " Specification: " . $one_material_assign_descri["brick_specification"] . "<br>";
			}
			$qty_parm = "20 Nos.";
		}

		if ($row_material_name["mt_prefix"] == "FB") {
			$joint_desciptions .= " Type: FLY ASH BRICK<br>";
			if ($one_material_assign_descri["brick_mark"] != "") {
				$joint_desciptions .= " Mark: " . $one_material_assign_descri["brick_mark"] . "<br>";
			}
			if ($one_material_assign_descri["brick_specification"] != "") {
				$joint_desciptions .= " Specification: " . $one_material_assign_descri["brick_specification"] . "<br>";
			}
			$qty_parm = "20 Nos.";
		}

		if ($row_material_name["mt_prefix"] == "BIT") {
			if ($one_material_assign_descri["tanker_no"] != "") {
				$joint_desciptions .= " Tanker No: " . $one_material_assign_descri["tanker_no"] . "<br>";
			}
			if ($one_material_assign_descri["lot_no"] != "") {
				$joint_desciptions .= " Bitumen Pass No.: " . $one_material_assign_descri["lot_no"] . "<br>";
			}
			if ($one_material_assign_descri["bitumin_grade"] != "") {
				$joint_desciptions .= " Type of Sample: " . $one_material_assign_descri["bitumin_grade"] . "<br>";
			}
			if ($one_material_assign_descri["bitumin_make"] != "") {
				$joint_desciptions .= " Make.: " . $one_material_assign_descri["bitumin_make"] . "<br>";
			}
			$qty_parm = "1 Con.";
		}

		if ($row_material_name["mt_prefix"] == "HCC") {
			$joint_desciptions .= "Type: " . $row_material_name["mt_name"] . "<br>";
			if ($one_material_assign_descri["casting_date"] != "") {

				$testing_days = $one_material_assign_descri["cc_day"];
				$testing_dates = date('Y-m-d', strtotime($one_material_assign_descri["casting_date"] . ' + ' . $testing_days . ' days'));
				if ($one_material_assign_descri["cc_set_of_cube"] != "") {
					$joint_desciptions .= " Set of Cube: " . $one_material_assign_descri["cc_set_of_cube"] . "<br>";
				}
				if ($one_material_assign_descri["cc_no_of_cube"] != "") {
					$joint_desciptions .= " No of Cube: " . $one_material_assign_descri["cc_no_of_cube"] . "<br> ";
				}
				$joint_desciptions .= " Casting Date: " . date(("d-m-Y"), strtotime($one_material_assign_descri["casting_date"])) . "<br>";
			}
			if ($one_material_assign_descri["cc_day"] != "") {
				$joint_desciptions .= " Days: " . $one_material_assign_descri["cc_day"] . "<br>";
			}


			if ($one_material_assign_descri["cc_identification_mark"] != "") {
				$joint_desciptions .= " ID Mark: " . $one_material_assign_descri["cc_identification_mark"] . "<br>";
			}
			if ($one_material_assign_descri["cc_grade"] != "") {
				$joint_desciptions .= " Grade: " . $one_material_assign_descri["cc_grade"] . "<br>";
			}


			$joint_desciptions .= "<br>";
			$qty_parm = "3 Nos.";

		}

		if ($row_material_name["mt_prefix"] == "FX") {
			$joint_desciptions .= "Type: Flexural Beam<br>";
			if ($one_material_assign_descri["casting_date"] != "") {

				$testing_days = $one_material_assign_descri["cc_day"];
				$testing_dates = date('Y-m-d', strtotime($one_material_assign_descri["casting_date"] . ' + ' . $testing_days . ' days'));
				if ($one_material_assign_descri["cc_set_of_cube"] != "") {
					$joint_desciptions .= " Set of Beam: " . $one_material_assign_descri["cc_set_of_cube"] . "<br>";
				}
				if ($one_material_assign_descri["cc_no_of_cube"] != "") {
					$joint_desciptions .= " No of Beam: " . $one_material_assign_descri["cc_no_of_cube"] . "<br> ";
				}
				$joint_desciptions .= " Casting Date: " . date(("d-m-Y"), strtotime($one_material_assign_descri["casting_date"])) . "<br> Testing Date: " . date(("d-m-Y"), strtotime($testing_dates)) . "<br>";
			}
			if ($one_material_assign_descri["cc_day"] != "") {
				$joint_desciptions .= " Days: " . $one_material_assign_descri["cc_day"] . "<br>";
			}


			if ($one_material_assign_descri["cc_identification_mark"] != "") {
				$joint_desciptions .= " ID Mark: " . $one_material_assign_descri["cc_identification_mark"] . "<br>";
			}
			if ($one_material_assign_descri["cc_grade"] != "") {
				$joint_desciptions .= " Grade: " . $one_material_assign_descri["cc_grade"] . "<br>";
			}


			$joint_desciptions .= "<br>";
			$qty_parm = "3 Nos.";
		}

		if ($row_material_name["mt_prefix"] == "PB") {
			if ($one_material_assign_descri["paver_shape"] != "") {
				$joint_desciptions .= " Shape: " . $one_material_assign_descri["paver_shape"] . "<br>";
			}
			/* if($one_material_assign_descri["paver_age"] !=""){
				$joint_desciptions .= " Age: ".$one_material_assign_descri["paver_age"]."<br>";
			} */
			if ($one_material_assign_descri["paver_color"] != "") {
				$joint_desciptions .= " Color: " . $one_material_assign_descri["paver_color"] . "<br>";
			}
			if ($one_material_assign_descri["paver_thickness"] != "") {
				$joint_desciptions .= " Thickness: " . $one_material_assign_descri["paver_thickness"] . "<br>";
			}
			if ($one_material_assign_descri["paver_grade"] != "") {
				$joint_desciptions .= " Grade: " . $one_material_assign_descri["paver_grade"] . "<br>";
			}
			$qty_parm = "11 Nos.";
		}

		if ($row_material_name["mt_prefix"] == "SFSR") {
			if ($one_material_assign_descri["chainage_no"] != "") {
				$joint_desciptions .= " Chainage No: " . $one_material_assign_descri["chainage_no"] . "";
			}
			$qty_parm = "1 Bag.";

		}

		if ($row_material_name["mt_prefix"] == "SO") {
			if ($one_material_assign_descri["soil_location"] != "") {
				$joint_desciptions .= " Type: " . $one_material_assign_descri["soil_location"] . "<br>";
			}
			if ($one_material_assign_descri["soil_source"] != "") {
				$joint_desciptions .= " Source: " . $one_material_assign_descri["soil_source"] . "";
			}
			$qty_parm = "1 Bag.";
		}

		if ($row_material_name["mt_prefix"] == "MU") {
			if ($one_material_assign_descri["soil_location"] != "") {
				$joint_desciptions .= " Location: " . $one_material_assign_descri["soil_location"] . "<br>";
			}
			if ($one_material_assign_descri["chainage_no"] != "") {
				$joint_desciptions .= " Chainage No: " . $one_material_assign_descri["chainage_no"] . "";
			}
			$qty_parm = "1 Bag.";
		}

		if ($row_material_name["mt_prefix"] == "SC") {
			if ($one_material_assign_descri["type_method"] != "") {
				$joint_desciptions .= " Type: " . $one_material_assign_descri["type_method"] . "<br>";
			}
			if ($one_material_assign_descri["chainage_no"] != "") {
				$joint_desciptions .= " Chainage No: " . $one_material_assign_descri["chainage_no"] . "";
			}
			$qty_parm = "1 Nos.";
		}

		if ($row_material_name["mt_prefix"] == "DC") {
			if ($one_material_assign_descri["type_method"] != "") {
				$joint_desciptions .= " Type: " . $one_material_assign_descri["type_method"] . "<br>";
			}

			if ($one_material_assign_descri["chainage_no"] != "") {
				$joint_desciptions .= " Chainage No: " . $one_material_assign_descri["chainage_no"] . "";
			}
			$qty_parm = "1 Nos.";
		}

		if ($row_material_name["mt_prefix"] == "DD") {
			if ($one_material_assign_descri["type_method"] != "") {
				$joint_desciptions .= " Type: " . $one_material_assign_descri["type_method"] . "<br>";
			}
			if ($one_material_assign_descri["chainage_no"] != "") {
				$joint_desciptions .= " Chainage No: " . $one_material_assign_descri["chainage_no"] . "";
			}
			$qty_parm = "1 Nos.";
		}

		if ($row_material_name["mt_prefix"] == "ST") {
			if ($one_material_assign_descri["steel_dia"] != "") {
				$joint_desciptions .= " Dia: " . $one_material_assign_descri["steel_dia"] . "<br>";
			}
			if ($one_material_assign_descri["steel_grade"] != "") {
				$joint_desciptions .= " Grade: " . $one_material_assign_descri["steel_grade"] . "<br>";
			}
			if ($one_material_assign_descri["steel_brand"] != "") {
				$joint_desciptions .= " Brand: " . $one_material_assign_descri["steel_brand"] . "<br>";
			}
			$qty_parm = "3 Nos.";
		}

		if ($row_material_name["mt_prefix"] == "WA") {
			if ($one_material_assign_descri["water_source"] != "") {
				$joint_desciptions .= " Source: " . $one_material_assign_descri["water_source"] . "<br>";
			}
		}

		if ($row_material_name["mt_prefix"] == "TI") {
			if ($one_material_assign_descri["water_specification"] != "") {
				$joint_desciptions .= " Specification: " . $one_material_assign_descri["water_specification"] . "<br>";
			}
			if ($one_material_assign_descri["water_brand"] != "") {
				$joint_desciptions .= " Brand: " . $one_material_assign_descri["water_brand"] . "<br>";
			}
		}

		if ($row_material_name["mt_prefix"] == "FI") {
			if ($one_material_assign_descri["fine_aggregate_source"] != "") {
				$joint_desciptions .= " Source: " . $one_material_assign_descri["fine_aggregate_source"] . "<br>";
			}
			if ($one_material_assign_descri["fine_agg_type"] != "") {
				$joint_desciptions .= " Type: " . $one_material_assign_descri["fine_agg_type"] . "<br>";
			}
			$qty_parm = "1 Bag.";
		}

		if ($row_material_name["mt_prefix"] == "QU") {
			if ($one_material_assign_descri["quarry_spall_source"] != "") {
				$joint_desciptions .= " Source: " . $one_material_assign_descri["quarry_spall_source"] . "<br>";
			}
			$qty_parm = "1 Bag.";
		}

		if ($row_material_name["mt_prefix"] == "BM") {
			if ($one_material_assign_descri["bit_mix"] != "") {
				$joint_desciptions .= " Type: " . $one_material_assign_descri["bit_mix"] . "<br>";
			}
			$qty_parm = "3 Mould.";
		}


		array_push($matreials_id_array, $materials_ids);
		if (
			strpos($row_material_name["mt_name"], "WMM (MIX MATERIAL)") !== false ||
			strpos($row_material_name["mt_name"], "GSB - I MIX (M4-1)") !== false ||
			strpos($row_material_name["mt_name"], "GSB - II MIX (M4-2)") !== false ||
			strpos($row_material_name["mt_name"], "GSB - III MIX (M4-1)") !== false ||
			strpos($row_material_name["mt_name"], "GSB - IV MIX (M5)") !== false ||
			strpos($row_material_name["mt_name"], "GSB - V MIX (M5)") !== false ||
			strpos($row_material_name["mt_name"], "GSB - VI MIX (M5)") !== false ||
			strpos($row_material_name["mt_name"], "GSB - I MIX (M5)") !== false ||
			strpos($row_material_name["mt_name"], "GSB - III MIX (M5)") !== false ||
			strpos($row_material_name["mt_name"], "GSB - II MIX (M5)") !== false ||
			strpos($row_material_name["mt_name"], "GSB - I MIX (M4-2)") !== false ||
			strpos($row_material_name["mt_name"], "GSB - II MIX (M4-1)") !== false ||
			strpos($row_material_name["mt_name"], "GSB - III MIX (M4-2)") !== false ||
			strpos($row_material_name["mt_name"], "GSB - I MIX (COARSE GRADED)") !== false ||
			strpos($row_material_name["mt_name"], "GSB - II MIX (COARSE GRADED)") !== false ||
			strpos($row_material_name["mt_name"], "GSB - III MIX (COARSE GRADED)") !== false ||
			strpos($row_material_name["mt_name"], "MSS - A (MIX MATERIAL)") !== false ||
			strpos($row_material_name["mt_name"], "MSS - B (MIX MATERIAL)") !== false ||
			strpos($row_material_name["mt_name"], "BUSG - CA") !== false ||
			strpos($row_material_name["mt_name"], "BUSG - KA") !== false ||
			strpos($row_material_name["mt_name"], "BM - 2 (MIX MATERIAL)") !== false ||
			strpos($row_material_name["mt_name"], "BM - 1 (MIX MATERIAL)") !== false ||
			strpos($row_material_name["mt_name"], "BC - 2 (MIX MATERIAL)") !== false ||
			strpos($row_material_name["mt_name"], "BC - 1 (MIX MATERIAL)") !== false ||
			strpos($row_material_name["mt_name"], "DBM - 1 (MIX MATERIAL)") !== false ||
			strpos($row_material_name["mt_name"], "DBM - 2 (MIX MATERIAL)") !== false ||
			strpos($row_material_name["mt_name"], "SDBC - 1 (MIX MATERIAL)") !== false ||
			strpos($row_material_name["mt_name"], "SDBC - 1 (MIX MATERIAL)") !== false ||
			strpos($row_material_name["mt_name"], "SDBC - 2 (MIX MATERIAL)") !== false
		) {

			if (strpos($row_material_name["mt_name"], "WMM") !== false) {
				$ansss = "WMM";
			} else if (strpos($row_material_name["mt_name"], "GSB") !== false) {
				$ansss = "GSB";

			} else if (strpos($row_material_name["mt_name"], "MSS") !== false) {
				$ansss = "MSS";

			} else if (strpos($row_material_name["mt_name"], "BUSG") !== false) {
				$ansss = "BUSG";

			} else if (strpos($row_material_name["mt_name"], "DBM") !== false) {
				$ansss = "DBM";

			} else if (strpos($row_material_name["mt_name"], "BM") !== false) {
				$ansss = "BM";

			} else if (strpos($row_material_name["mt_name"], "SDBC") !== false) {
				$ansss = "SDBC";

			} else if (strpos($row_material_name["mt_name"], "BC") !== false) {
				$ansss = "BC";

			} else if (strpos($row_material_name["mt_name"], "SEAL COAT") !== false) {
				$ansss = "SEAL COAT";

			}






		} else {
			if (
				strpos($row_material_name["mt_name"], "WMM") !== false ||
				strpos($row_material_name["mt_name"], "WBM") !== false ||
				strpos($row_material_name["mt_name"], "RCC") !== false ||
				strpos($row_material_name["mt_name"], "GSB") !== false ||
				strpos($row_material_name["mt_name"], "BM") !== false ||
				strpos($row_material_name["mt_name"], "BC") !== false ||
				strpos($row_material_name["mt_name"], "SDBC") !== false ||
				strpos($row_material_name["mt_name"], "MSS") !== false ||
				strpos($row_material_name["mt_name"], "DBM") !== false ||
				strpos($row_material_name["mt_name"], "BUSG") !== false ||
				strpos($row_material_name["mt_name"], "Seal Coat") !== false ||
				strpos($row_material_name["mt_name"], "SEAL COAT") !== false ||
				strpos($row_material_name["mt_name"], "CARPET") !== false ||
				strpos($row_material_name["mt_name"], "carpet") !== false ||
				strpos($row_material_name["mt_name"], "Premix Carpet") !== false
			) {
				$ansss = "Coarse Aggregate";
			} else if (
				strpos($row_material_name["mt_name"], "Cement Physical") !== false ||
				strpos($row_material_name["mt_name"], "Cement Chemical") !== false
			) {
				$ansss = "Cement";
			} else {
				if (strpos($row_material_name["mt_name"], "C.C.Cube") !== false || strpos($row_material_name["mt_name"], "Flexural Strength of Concrete Beam") !== false || strpos($row_material_name["mt_name"], "DLC Cube") !== false) {
					//$ansss = "Concrete";
					$ansss = $row_material_name["mt_name"];
				} else {
					if (strpos($row_material_name["mt_name"], "FLY ASH BRICK") !== false || strpos($row_material_name["mt_name"], "BURNT CLAY BRICK") !== false) {
						$ansss = "Brick";
					} else {
						$ansss = $row_material_name["mt_name"];
					}

				}

			}

		}



		array_push($matreials_name_array, $ansss);
		array_push($matreials_desc_array, $joint_desciptions);
		array_push($matreials_qty_array, $qty_parm);
		array_push($matreials_test_array, $joint_test);
		array_push($matreials__method_array, $joint_test_methods);
		array_push($matreials_ulr_array, ltrim($one_final_materials["lab_no"], "0"));
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<br>
	<br>
	<table align="center"
		style="width: 100%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"
		cellspacing="0" cellpadding="2px" bordercolor="black">
		<tr>
			<td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img
					src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;">
			</td>

		</tr>
		<tr>
			<td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">
				NextGenLIMS Technologies</td>
		</tr>

		<tr>
			<td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7"><b>Regd.
					Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
		</tr>
		<tr>
			<td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">District
				Kangra Himachal Pradesh (176081)</td>
		</tr>
		<tr>
			<td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">Mobile :
				+91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com</td>
		</tr>
	</table>
	<table align="center"
		style="width: 100%;text-align: center;font-family: 'calibri';font-size: 12px;border-right:1px solid;border-left:1px solid;"
		cellspacing="0" cellpadding="2px">
		<tr>
			<td style="text-align: right;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="4">QSF-0601
			</td>
		</tr>
		<tr>
			<td style="width:25%;text-align: center;border-bottom:1px solid;"><b>Sample Booking :</b> </td>
			<td style="width:25%;text-align: center;border-bottom:1px solid;"> 9.00 am to 5.30 pm</td>
			<td style="width:25%;text-align: center;border-bottom:1px solid;"> <b>Report Collection</b></td>
			<td style="width:25%;text-align: center;border-bottom:1px solid;"> 9.00 am to 5.30 pm </td>
		</tr>
	</table>
	<br><br>
	<table align="center" style="width: 100%;text-align: center;font-family: 'calibri';font-size: 12px;" cellspacing="0"
		cellpadding="2px">
		<tr>
			<td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 17px;font-weight:bold;padding: 2px;"
				colspan="2"><u>SERVICE REQUEST FORM</u></td>
		</tr>
	</table>
	<table align="center"
		style="width: 100%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px;"
		cellspacing="0" cellpadding="2px">

		<tr>
			<td style="width:65%;text-align: left;" rowspan="2">&nbsp;<b>1. Name and Address of Customer
				</b><br>&nbsp;<?php echo $agency_name; ?> <br>&nbsp;Govt Contractor
				<br>&nbsp;<?php echo $agency_address; ?></td>
			<td style="width:35%;text-align: left;border-left: 1px solid;" colspan="">&nbsp;<b>Date of Booking:</b>
				<?php echo $put_sample_rec_date; ?></td>
		</tr>
		<tr>
			<td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="">
				&nbsp;<u><b>CONTACT</b></u><br>&nbsp;Person: <?php echo $row_estiamte["person_name"]; ?><br>&nbsp;Phone/
				Mobile: <?php echo $row_estiamte["person_auth_mobile"]; ?> </td>
		</tr>
		<tr>
			<td style="width:65%;text-align: left;border-top: 1px solid;" rowspan="">&nbsp;<b>2. Name of
					Work/Project</b></td>
			<td style="width:35%;text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="">
				&nbsp;E-mail: <?php echo $row_estiamte["email"]; ?></td>
		</tr>
		<tr>
			<td style="width:65%;text-align: left;" rowspan="3">&nbsp;<?php echo $name_of_work; ?></td>
			<td style="width:35%;text-align: left;border-left: 1px solid;" colspan="">&nbsp;<u><b>Mode of Dispatch of
						Report</b></u></td>
		</tr>
		<tr>
			<td style="width:35%;text-align: left;border-left: 1px solid;" colspan="">&nbsp;by Post <input
					type="checkbox"></td>
		</tr>
		<tr>
			<td style="width:35%;text-align: left;border-left: 1px solid;" colspan="">&nbsp;Collect Personally <input
					type="checkbox"></td>
		</tr>
	</table>
	<table align="center"
		style="width: 100%;text-align: center;font-family: 'calibri';font-size: 12px;border-right:1px solid;border-left:1px solid;"
		cellspacing="0" cellpadding="2px">
		<tr style="text-align:left;">
			<td style="width:25%;border-right:1px solid;"><b>Reference no </b> </td>
			<td style="width:25%;border-right:1px solid;"><?php echo $row_estiamte["refno"]; ?></td>
			<td style="width:25%;border-right:1px solid;"><b>Date of Reference letter No </b></td>
			<td style="width:25%;"><?php echo $refrence_date; ?></td>
		</tr>
		<tr style="text-align:left;">
			<td style="width:25%;border-top: 1px solid;border-right:1px solid;border-bottom:1px solid;"><b>Name of
					sample</b> </td>
			<td style="width:25%;border-top: 1px solid;border-right:1px solid;border-bottom:1px solid;">
				<?php foreach ($matreials_name_array as $keying => $matreials_name_one) {
					$counts = $keying + 1;

					echo $matreials_name_array[$keying];
				}
				?>
			</td>
			<td style="width:25%;border-top: 1px solid;border-right:1px solid;border-bottom:1px solid;"> <b>Source of
					sample</b></td>
			<td style="width:25%;border-top: 1px solid;border-bottom:1px solid;">-</td>
		</tr>
	</table>
	<table align="center"
		style="width: 100%;text-align: center;font-family: 'calibri';font-size: 12px;border-left:1px solid;border-right:1px solid;"
		cellspacing="0" cellpadding="2px">
		<tr>
			<td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 17px;font-weight:bold;padding-top:20px;"
				colspan="2"><u>TESTING REQUIREMENT </u></td>
		</tr>
	</table>





	<table align="center"
		style="width: 100%;text-align: center;font-family: 'calibri';font-size: 12px;border:1px solid;" cellspacing="0"
		cellpadding="0px">
		<tr style="text-align:center;">
			<td style="width:25%;border-right:1px solid;border-bottom:1px solid;"><b>Quantity of Sample</b> </td>
			<td style="width:25%;border-right:1px solid;border-bottom:1px solid;"><b>Sample Description</b></td>
			<td style="width:25%;border-right:1px solid;border-bottom:1px solid;"><b>Test to be Performed</b></td>
			<td style="width:25%;border-bottom:1px solid;"><b>Test Method to be Used</b></td>
		</tr>
		<?php
		foreach ($matreials_name_array as $keying => $matreials_name_one) {
			$counts = $keying + 1;
			?>
			<tr style="text-align:center;">
				<td style="border-right:1px ;border-right:1px solid;height:10px;">
					<?php echo $matreials_qty_array[$keying]; ?></td>
				<td style="border-right:1px solid;"><?php echo $matreials_desc_array[$keying]; ?></td>
				<td style="border-right:1px solid;text-align:left;">
					<table cellpadding="0" cellspacing="0" align="center" width="100%" class="test"
						style="font-family: Book Antiqua;">
						<?php echo $matreials_test_array[$keying]; ?>
					</table>
				</td>
				<td style="border-right:0px solid;text-align:center;">
					<table cellpadding="0" cellspacing="0" align="center" width="100%" class="test"
						style="font-family: Book Antiqua;">
						<?php echo $matreials__method_array[$keying]; ?>
					</table>
				</td>
			</tr>
		</table>


		<!--			   <td style="border-top: 1px solid;border-right:0px solid;text-align:center;" >
					<table align="center" width="100%" height="1px" class="test"  style="font-family: Book Antiqua;">
					<?php echo $matreials__method_array[$keying]; ?>
			
				
			</tr>
				</table>
				</td>-->
	<?php } ?>

	<!-- </table>-->


	<table align="center"
		style="width: 100%;text-align: center;font-family: 'calibri';font-size: 12px;border-right:1px solid;border-left:1px solid;"
		cellspacing="0" cellpadding="2px">
		<tr>
			<td style="text-align:left;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="2">Review
				Remarks</td>
		</tr>
		<tr style="text-align:left">
			<td style="width:40%;border-top: 1px solid;text-align:left;">&nbsp;1. Method of testing, capability and
				resources acceptable</td>
			<td style="width:10%;border:1px solid;text-align:center"><?php echo $radio_1; ?></td>
			<td style="border-top: 1px solid;text-align:center;border-bottom:1px solid;font-weight:bold;vertical-align:bottom"
				rowspan="4">&nbsp;&nbsp;Signature of <br>CUSTOMER'S REPRESENTATIVE</td>
		</tr>
		<tr style="text-align:left">
			<td style="border-top: 1px solid;text-align:left;">&nbsp;2. Testing services requested may please be carried
				out. </td>
			<td style="border:1px solid;text-align:center"><?php echo $radio_2; ?></td>
		</tr>
		<tr style="text-align:left">
			<td style="border-top: 1px solid;text-align:left;">&nbsp;3. Terms and Conditions of Testing acceptable as
				per review remarks.</td>
			<td style="border:1px solid;text-align:center"><?php echo $radio_3; ?></td>
		</tr>
		<tr style="text-align:left">
			<td style="border-top: 1px solid;text-align:left;border-bottom:1px solid;">&nbsp;4. Statement of Conformity
				Required/Not Required by the Customer</td>
			<td style="border:1px solid;text-align:center"><?php echo $radio_4; ?></td>

		</tr>
	</table>
	<table align="center" style="width: 100%;text-align: center;font-family: 'calibri';font-size: 12px;" cellspacing="0"
		cellpadding="2px">
		<tr>
			<td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 17px;font-weight:bold;padding-top:20px;border-left:1px solid;border-right:1px solid;"
				colspan="2"><u>FOR OFFICE USE ONLY</u></td>
		</tr>
	</table>
	<table align="center"
		style="width: 100%;text-align: center;font-family: 'calibri';font-size: 12px;border:1px solid;" cellspacing="0"
		cellpadding="2px">
		<tr>
			<td style="text-align:left;font-size: 11px;font-family: 'calibri';font-size: 13px;border-right:1px solid;font-weight:bold;"
				colspan="2"><u>&nbsp;Comments:</u></td>
			<td style="text-align:left;font-size: 11px;font-family: 'calibri';font-size: 13px;font-weight:bold;">
				&nbsp;JOB CARD No.</td>
			<td style="text-align:left;font-size: 11px;font-family: 'calibri';font-size: 13px;font-weight:bold;">
				&nbsp;DATE</td>
		</tr>
		<tr>
			<td style="width:40%;text-align:left;font-size: 11px;font-family: 'calibri';font-size: 13px;">&nbsp;1.
				Requirements defined and understood </td>
			<td style="width:10%;padding-right:3px;border:1px solid;"><?php echo $radio_8; ?></td>
			<td style="width:25%;padding-right:3px;border:1px solid;"><?php echo $get_job_no; ?></td>
			<td style="width:25%;padding-right:3px;border:1px solid;"><?php echo $put_sample_rec_date; ?></td>
		</tr>
		<tr>
			<td style="text-align:left;font-size: 11px;font-family: 'calibri';font-size: 13px;">&nbsp;2. Capability and
				Resources available </td>
			<td style="border:1px solid;"><?php echo $radio_9; ?></td>
			<td style="text-align:left;font-size: 11px;font-family: 'calibri';font-size: 13px;"></td>
			<td style="text-align:left;font-size: 11px;font-family: 'calibri';font-size: 13px;"></td>
		</tr>
		<tr>
			<td style="text-align:left;font-size: 11px;font-family: 'calibri';font-size: 13px;border-right:1px solid;"
				colspan="2">&nbsp;</td>
			<td style="text-align:left;font-size: 11px;font-family: 'calibri';font-size: 13px;font-weight:bold;"
				colspan="2">&nbsp;UNIQUE IDENTITY OF SAMPLE</td>
		</tr>
		<tr>
			<td style="text-align:left;font-size: 11px;font-family: 'calibri';font-size: 13px;">&nbsp;3. Condition of
				Sample Received </td>
			<td style="border:1px solid;"><?php echo $acceptable; ?></td>
			<td style="padding-right:3px;border:1px solid;"><?php echo $labs_nos; ?></td>
			<td style="text-align:left;font-size: 11px;font-family: 'calibri';font-size: 13px;"></td>
		</tr>
		<tr>
			<td style="text-align:left;font-size: 11px;font-family: 'calibri';font-size: 13px;border-right:1px solid;"
				colspan="2">&nbsp;4. Discussion with Customer, if any</td>
		</tr>
		<tr>
			<td style="text-align:center;font-size: 11px;font-family: 'calibri';font-size: 13px;border-bottom:1px solid;border-right:1px solid;"
				colspan="2">&nbsp;<br><br><br><br></td>
			<td style="text-align:center;font-size: 11px;font-family: 'calibri';font-size: 13px;border-bottom:1px solid;"
				colspan="2">&nbsp;Authorized Signatory <br>&nbsp;Miss Ujjwal Katoch <br>&nbsp;(Customer Service Cell)
			</td>

		</tr>

	</table>
	<br><br>
	</table>
</body>

</html>