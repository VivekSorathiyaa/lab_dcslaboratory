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
			if($r1['test_code'] == "con")
			{
				$test_check.="con,";
			}
			else if($r1['test_code'] == "set")
			{
				$test_check.="set,";
			}
			else if($r1['test_code'] == "com")
			{ 
				$test_check.="com,";
			}
			else if($r1['test_code'] == "sou")
			{ 
				$test_check.="sou,";
			}
			else if($r1['test_code'] == "fin")
			{ 
				$test_check.="fin,";
			}
			else if($r1['test_code'] == "den")
			{ 
				$test_check.="den,";
			}			
			else if($r1['test_code'] == "che")
			{ 
				$test_check.="che,";
			}
			
			$type_of_cement = $r1['type_of_cement'];
			$cement_grade = $r1['cement_grade'];
			$cement_brand = $r1['cement_brand'];
			$week_number = $r1['week_number'];
			$week_number = $r1['week_number'];
			
		}
		$fill = array('test_check' => $test_check,
		'type_of_cement' =>$type_of_cement,
		'cement_grade' =>$cement_grade,
		'cement_brand' =>$cement_brand,
		'week_number' =>$week_number
		);
		echo json_encode($fill);
	}
		?>
		
		
		
