 <?php
session_start();
include 'DB.php';
$db = new DB();
$tblName = 'multi_login';
if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'data'){
        $conditions['where'] = array('id'=>$_POST['id']);
        $conditions['return_type'] = 'single';
        $staff = $db->getRows($tblName,$conditions);
        echo json_encode($staff);
    }elseif($_POST['action_type'] == 'view'){
        $staffs = $db->getRows($tblName,array('order_by'=>'id DESC'));
        if(!empty($staffs)){
			

					$count = 0;
					/*$staff_image=$_POST['staff_image'];
					$img=$_FILES[$staff_image]['name'];
					$dest="uplode/$img";
					$src=$_FILES[$staff_image]['tmp_name'];
					move_uploaded_file($src,$dest);*/
					
					foreach($staffs as $staff): $count++;
						if($staff['staff_isdeleted'] == 0){
						echo '<tr>';
						echo '<td>#'.$count.'</td>';
						echo '<td>'.$staff['staff_fullname'].'</td>';
						echo '<td>'.date('d/m/Y', strtotime($staff['staff_dob'])).'</td>';
						echo '<td>'.$staff['staff_gender'].'</td>';
						echo '<td>'.$staff['staff_contactno'].'</td>';
						echo '<td>'.$staff['staff_email'].'</td>';
						echo '<td>'.$staff['staff_first_pass'].'</td>';
						echo '<td>'.$staff['staff_second_pass'].'</td>';
						//echo '<td>'.$dest.'</td>';
						
						echo '<td>'.$staff['staff_address'].'</td>';
						if($staff['staff_status'] == 1){
							$status="Activate";
						}
						else{
							$status="Dectivate";
						}
						echo '<td>'.$status.'</td>';
						
						
						echo '<td>'.$staff['staff_pan'].'</td>';
						echo '<td>'.$staff['staff_acc'].'</td>';
						echo '<td>'.$staff['staff_accname'].'</td>';
						echo '<td>'.$staff['staff_branch'].'</td>';
						echo '<td>'.$staff['staff_ifsc'].'</td>';
						echo '<td>'.$staff['upload_id'].'</td>';
						echo '<td>'.$staff['upload_pass'].'</td>';
						echo '<td><a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editstaff(\''.$staff['id'].'\')"></a><a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm(\'Are you sure to delete data?\')?staffAction(\'delete\',\''.$staff['id'].'\'):false;"></a></td>';
						echo '</tr>';
						}
					endforeach;
				
        }else{ 
            echo '<tr><td colspan="5">No staff(s) found......</td></tr>';
        }
    }elseif($_POST['action_type'] == 'add'){
		
				$staff_month=substr($_POST['staff_dob'],0,2);
				$staff_day=substr($_POST['staff_dob'],3,2);
				$staff_year=substr($_POST['staff_dob'],6,4);
				$new_staff_date = $staff_year."-".$staff_day."-".$staff_month;
				$staff_role=$_POST["staff_role"];
				$nabl_type=$_POST["nabl_type"];
				
				$nabls="";
				$direct_nabls="";
				
				if (in_array("nabl", $nabl_type))
				{
					$nabls="nabl";
				}
				
				if (in_array("direct_nabl", $nabl_type))
				{
					$direct_nabls="direct_nabl";
				}
			
				$staffData = array(
            'staff_fullname' => $_POST['staff_fullname'],
            'staff_dob' => $new_staff_date,
            'staff_gender' => $_POST['staff_gender'],
            'staff_contactno' => $_POST['staff_contactno'],
            'staff_email' => $_POST['staff_email'],
            'staff_first_pass' => $_POST['staff_pass'],
            'staff_second_pass' => $_POST['staff_pass_non'],
            'nabl' => "$nabls",
            'non_nabl' => "$direct_nabls",
            'staff_address' => $_POST['staff_address'],
            'staff_status' => $_POST['staff_status'],
            'staff_pan' => $_POST['staff_pan'],
            'staff_acc' => $_POST['staff_acc'],
            'staff_accname' => $_POST['staff_accname'],
            'staff_branch' => $_POST['staff_branch'],
            'staff_ifsc' => $_POST['staff_ifsc'],
            'staff_createdby' => $_SESSION['name'],
			'staff_createddate' => date("Y-m-d"),
			'staff_modifiedby' => "",
			'staff_modifieddate' => "0000-00-00",
			'staff_isdeleted' => 0,
			'staff_isadmin' => $staff_role
        );
		
		
		
		//print_r($staffData);exit;
      $insert = $db->insert($tblName,$staffData);
         echo $insert?'ok':'err'; 
    }elseif($_POST['action_type'] == 'edit'){
		
				
				$staff_month=substr($_POST['staff_dob_edit'],0,2);
				$staff_day=substr($_POST['staff_dob_edit'],3,2);
				$staff_year=substr($_POST['staff_dob_edit'],6,4);
				$new_staff_date = $staff_year."-".$staff_day."-".$staff_month;
				$staff_role=$_POST["staff_role_edit"];
				$nabl_type=$_POST["edit_nabl_type"];
				
				$nabls="";
				$direct_nabls="";
				
				if (in_array("nabl", $nabl_type))
				{
					$nabls="nabl";
				}
				
				if (in_array("direct_nabl", $nabl_type))
				{
					$direct_nabls="direct_nabl";
				}
				
        if(!empty($_POST['id'])){
			
        $staffData = array(
            'staff_fullname' => $_POST['staff_fullname_edit'],
            'staff_dob' => $new_staff_date,
            'staff_gender' => $_POST['staff_gender_edit'],
            'staff_contactno' => $_POST['staff_contactno_edit'],
            'staff_email' => $_POST['staff_email_edit'],
            'staff_first_pass' => $_POST['staff_pass_edit'],
            'staff_second_pass' => $_POST['staff_pass_non_edit'],
			'nabl' => "$nabls",
            'non_nabl' => "$direct_nabls",
            'staff_address' => $_POST['staff_address_edit'],
            'staff_status' => $_POST['staff_status_edit'],
			'staff_pan' => $_POST['staff_pan_edit'],
            'staff_acc' => $_POST['staff_acc_edit'],
            'staff_accname' => $_POST['staff_accname_edit'],
            'staff_branch' => $_POST['staff_branch_edit'],
            'staff_ifsc' => $_POST['staff_ifsc_edit'],
            'staff_createdby' => $_SESSION['name'],
			'staff_modifiedby' => $_SESSION['name'],
			'staff_modifieddate' => date("Y-m-d"),
			'staff_isadmin' => $staff_role
        );
		
		
			
			
            $condition = array('id' => $_POST['id']);
            $update = $db->update($tblName,$staffData,$condition);
            echo $update?'ok':'err';
        }
    }elseif($_POST['action_type'] == 'delete'){
        if(!empty($_POST['id'])){
			$staffData = array(
					'staff_status' => 0,
					'staff_isdeleted' => 1
			);		
            $condition = array('id' => $_POST['id']);
            $delete = $db->update($tblName,$staffData,$condition);
            echo $delete?'ok':'err';
        }
    }
    exit;
}