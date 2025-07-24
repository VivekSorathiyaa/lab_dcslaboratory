<?php
session_start(); 
include("connection.php");	
	if($_POST['action_type'] == 'save_file')
	{
	 $test_check ="";
	 $cube_grade ="";
	 $casting_date ="";
	 $day ="";
	 $set_of_cube ="";
	 $no_of_cube ="";
	 $day_remark ="";
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
			
			
			$cube_grade = $r1['cc_grade'];
			$casting_date = $r1['casting_date'];
			$day = $r1['cc_day'];
			$set_of_cube = $r1['cc_set_of_cube'];
			$no_of_cube = $r1['cc_no_of_cube'];
			$day_remark = $r1['day_remark'];
			
		}
		$fill = array('test_check' => $test_check,
		'cube_grade' =>$cube_grade,
		'casting_date' =>date('d/m/Y', strtotime($casting_date)),
		'day' =>$day,
		'set_of_cube' =>$set_of_cube,
		'no_of_cube' =>$no_of_cube,
		'day_remark' =>$day_remark
		);
		echo json_encode($fill);
	}
		?>
		
		
		
