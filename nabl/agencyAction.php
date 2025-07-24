<?php
session_start();
include 'DB.php';
$db = new DB();
$tblName = 'agency_master';
if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'data'){
        $conditions['where'] = array('agency_id'=>$_POST['id']);
         $conditions['return_type'] = 'single';
        $agency = $db->getRows($tblName,$conditions);
        echo json_encode($agency);
    }elseif($_POST['action_type'] == 'view'){
        $agencys = $db->getRows($tblName,array('order_by'=>'agency_id DESC'));
        if(!empty($agencys)){
			
            $count = 0;
            foreach($agencys as $agency): $count++;
                if($agency['isdeleted']==0){
				echo '<tr>';
                echo '<td>#'.$count.'</td>';
  
                echo '<td>'.$agency['agency_name'].'</td>';
                echo '<td>'.$agency['agency_mobile'].'</td>';
                echo '<td>'.$agency['agency_pincode'].'</td>';
                echo '<td>'.$agency['agency_email'].'</td>';
				if($agency['agency_status'] == 0){
					$status="Activate";
				}
				else{
					$status="Dectivate";
				}
                echo '<td>'.$status.'</td>';
                echo '<td><a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editagency(\''.$agency['agency_id'].'\')"></a><a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm(\'Are you sure to delete data?\')?agencyAction(\'delete\',\''.$agency['agency_id'].'\'):false;"></a></td>';
                echo '</tr>';
		}		
			endforeach;
			
        }else{
            echo '<tr><td colspan="5">No agency(s) found......</td></tr>';
        }
    }elseif($_POST['action_type'] == 'add'){
        $agencyData = array(
            'agency_name' => $_POST['agency_name'],
            'agency_address' => $_POST['agency_address'],
            'agency_mobile' => $_POST['agency_mobile'],
            'agency_city' => $_POST['sel_agency_city'],
            'agency_pincode' => $_POST['agency_pincode'],
            'agency_email' => $_POST['agency_email'],
            'agency_gstno' => $_POST['agency_gstno'],
            'agency_status' => $_POST['agency_status'],
            'perfoma_make_by' => $_POST['perfoma_make_by'],
            'rate_by' => $_POST['add_rate']
             
        );
        $insert = $db->insert($tblName,$agencyData);
         ECHO $insert?'ok':'err'; 
    }elseif($_POST['action_type'] == 'edit'){
		if(!empty($_POST['edit_id'])){
            $agencyData = array(
            'agency_name' => $_POST['agency_name_edit'],
            'agency_address' => $_POST['agency_address_edit'],
            'agency_mobile' => $_POST['agency_mobile_edit'],
            'agency_city' => $_POST['sel_agency_city_edit'],
            'agency_pincode' => $_POST['agency_pincode_edit'],
            'agency_email' => $_POST['agency_email_edit'],
            'agency_gstno' => $_POST['agency_gstno_edit'],
            'agency_status' => $_POST['agency_status_edit'],
            'perfoma_make_by' => $_POST['perfoma_make_by_edit'],
            'rate_by' => $_POST['add_rate_edit']
             
        );
           $condition = array('agency_id' => $_POST['edit_id']);
            $update = $db->update($tblName,$agencyData,$condition);
            echo $update?'ok':'err';
        }
    }elseif($_POST['action_type'] == 'delete'){
        if(!empty($_POST['id'])){
				$agencyData = array(
             
					'isdeleted' => 1
				);
            $condition = array('agency_id' => $_POST['id']);
            $delete = $db->update($tblName,$agencyData,$condition);
            echo $delete?'ok':'err';
        }
    }
    exit;
}