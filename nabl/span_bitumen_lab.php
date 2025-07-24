<?php
session_start(); 
include("connection.php");	
	if($_POST['action_type'] == 'save_file')
	{
	 $test_check ="";
	 $grades ="";
	 $tank ="";
	 $lot ="";
	 $make ="";
	 $report_no=$_POST['report_no']; 	
	 $job_no=$_POST['job_no']; 	
	 $lab_no=$_POST['lab_no']; 	
	 $select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.report_no='$report_no' AND span_material_assign.job_number='$job_no' AND span_material_assign.lab_no='$lab_no' and span_material_assign.isdeleted='0'"; 
		$result_select1 = mysqli_query($conn, $select_query1);
		$rows1=mysqli_num_rows($result_select1);
		while($r1 = mysqli_fetch_array($result_select1))
		{
			if($r1['test_code'] == "pen")
			{
				$test_check.="pen,";
			}
			else if($r1['test_code'] == "kin")
			{
				$test_check.="kin,";
			}
			else if($r1['test_code'] == "abs")
			{ 
				$test_check.="abs,";
			}
			else if($r1['test_code'] == "wtr")
			{ 
				$test_check.="wtr,";
			}
			else if($r1['test_code'] == "sof")
			{ 
				$test_check.="sof,";
			}
			else if($r1['test_code'] == "duc")
			{ 
				$test_check.="duc,";
			}			
			else if($r1['test_code'] == "fla")
			{ 
				$test_check.="fla,";
			}
			else if($r1['test_code'] == "los")
			{ 
				$test_check.="los,";
			}
			$grades = $r1['bitumin_grade'];
			$tank = $r1['tanker_no'];
			$lot = $r1['lot_no'];
			$make = $r1['bitumin_make'];
			
		}
		$fill = array('test_check' => $test_check,
		'grades' =>$grades,
		'tank' =>$tank,
		'lot' =>$lot,
		'make' =>$make
		);
		echo json_encode($fill);
	}
		?>
		
		
		
