<?php
session_start(); 
include("connection.php");	
	if($_POST['action_type'] == 'save_file')
	{
	 $test_check ="";
	 $paver_grade ="";
	 $paver_shape ="";
	 $paver_thickness ="";
	 $paver_age ="";
	 $paver_color ="";
	 $report_no=$_POST['report_no']; 	
	 $job_no=$_POST['job_no']; 	
	 $lab_no=$_POST['lab_no']; 	
	 $select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.report_no='$report_no' AND span_material_assign.job_number='$job_no' AND span_material_assign.lab_no='$lab_no' and span_material_assign.isdeleted='0'"; 
		$result_select1 = mysqli_query($conn, $select_query1);
		$rows1=mysqli_num_rows($result_select1);
		while($r1 = mysqli_fetch_array($result_select1))
		{
			 if($r1['test_code'] == "com")
			{ 
				$test_check.="com,";
			}
			else if($r1['test_code'] == "wtr")
			{ 
				$test_check.="wtr,";
			}
			
			$paver_shape = $r1['paver_shape'];
			$paver_age = $r1['paver_age'];
			$paver_thickness = $r1['paver_thickness'];
			$paver_grade = $r1['paver_grade'];
			$paver_color = $r1['paver_color'];
			
		}
		$fill = array('test_check' => $test_check,
		'paver_shape' =>$paver_shape,
		'paver_age' =>$paver_age,
		'paver_thickness' =>$paver_thickness,
		'paver_grade' =>$paver_grade,
		'paver_color' =>$paver_color
		);
		echo json_encode($fill);
	}
		?>
		
		
		
