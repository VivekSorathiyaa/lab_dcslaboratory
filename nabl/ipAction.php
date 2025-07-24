<?php
include 'DB.php';
$db = new DB();
session_start();
$tblName = 'ip_master';
if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'data'){
        $conditions['where'] = array('id'=>$_POST['id']);
        $conditions['return_type'] = 'single';
        $mt = $db->getRows($tblName,$conditions);
        echo json_encode($mt);
    }elseif($_POST['action_type'] == 'view'){
        $mts = $db->getRows($tblName,array('order_by'=>'id DESC'));
        if(!empty($mts)){
			
            $count = 0;
            foreach($mts as $mt): $count++;
                if($mt['status'] == 1){
				echo '<tr>';
                echo '<td>#'.$count.'</td>';
                echo '<td>'.$mt['ipaddress'].'</td>';
                echo '<td>'.$mt['Remarks'].'</td>';
				if($mt['status'] == 1){
					$status="Activate";
				}
				else{
					$status="Dectivate";
				}
                echo '<td>'.$status.'</td>';
                echo '<td><a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editmt(\''.$mt['id'].'\')"></a><a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm(\'Are you sure to delete data?\')?ipAction(\'delete\',\''.$mt['id'].'\'):false;"></a></td>';
                echo '</tr>';
				}		
			endforeach;
			
        }else{
            echo '<tr><td colspan="5">No mt(s) found......</td></tr>';
        }
    }elseif($_POST['action_type'] == 'add'){
        $mtData = array(
            'ipaddress' => $_POST['ipaddress'],
            'Remarks' => $_POST['Remarks'],
            'status' => $_POST['status']
      
        );
        $insert = $db->insert($tblName,$mtData);
         ECHO $insert?'ok':'err'; 
    }elseif($_POST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $mtData = array(
			'ipaddress' => $_POST['ipaddress_edit'],
            'Remarks' => $_POST['Remarks_edit'],
            'status' => $_POST['status_edit']
            );
            $condition = array('id' => $_POST['id']);
            $update = $db->update($tblName,$mtData,$condition);
            echo $update?'ok':'err';
        }
    }elseif($_POST['action_type'] == 'delete'){
        if(!empty($_POST['id'])){
				$mtData = array(
             
					'status' => 0
					
				);
            $condition = array('id' => $_POST['id']);
            $delete = $db->update($tblName,$mtData,$condition);
            echo $delete?'ok':'err';
        }
    }
    exit;
}
?>
