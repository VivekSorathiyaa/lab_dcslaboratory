<?php
session_start(); 
include("connection.php");	
	if($_POST['action_type'] == 'save_file')
	{
	 $test_check ="";
	 $report_no=$_POST['report_no']; 	
	 $job_no=$_POST['job_no']; 	
	 $lab_no=$_POST['lab_no']; 	
	 $select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.report_no='$report_no' AND span_material_assign.job_number='$job_no' AND span_material_assign.lab_no='$lab_no' and span_material_assign.isdeleted='0'"; 
		$result_select1 = mysqli_query($conn, $select_query1);
		$rows1=mysqli_num_rows($result_select1);
		while($r1 = mysqli_fetch_array($result_select1))
		{
			if($r1['test_code'] == "grd")
			{
				$test_check.="grd,";
			}
			else if($r1['test_code'] == "imp")
			{
				$test_check.="imp,";
			}
			else if($r1['test_code'] == "cru")
			{ 
				$test_check.="cru,";
			}
			else if($r1['test_code'] == "mdd")
			{ 
				$test_check.="mdd,";
			}
			else if($r1['test_code'] == "str")
			{ 
				$test_check.="str,";
			}
			else if($r1['test_code'] == "lll")
			{ 
				$test_check.="lll,";
			}			
			else if($r1['test_code'] == "alk")
			{ 
				$test_check.="alk,";
			}
			else if($r1['test_code'] == "fin")
			{ 
				$test_check.="fin,";
			}
			else if($r1['test_code'] == "den")
			{ 
				$test_check.="den,";
			}
			else if($r1['test_code'] == "sou")
			{ 
				$test_check.="sou,";
			}
			else if($r1['test_code'] == "cru")
			{ 
				$test_check.="cru,";
			}
			else if($r1['test_code'] == "abr")
			{	
				$test_check.="abr,";
			}
			else if($r1['test_code'] == "wtr")
			{ 
				$test_check.="wtr,";
			}
			else if($r1['test_code'] == "flk")
			{ 
				$test_check.="flk,";
			}
			
		}
		$fill = array('test_check' => $test_check);
		echo json_encode($fill);
	}
		?>
		
		
		
