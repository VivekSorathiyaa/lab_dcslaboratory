<?php
include 'DB.php';
$db = new DB();
$tblName = 'authority';
if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'data'){
        $conditions['where'] = array('id'=>$_POST['id']);
        $conditions['return_type'] = 'single';
        $auth = $db->getRows($tblName,$conditions);
        echo json_encode($auth);
    }elseif($_POST['action_type'] == 'view'){
        $auths = $db->getRows($tblName,array('order_by'=>'id DESC'));
        if(!empty($auths)){
			
            $count = 0;
            foreach($auths as $auth): $count++;
                
				echo '<tr>';
                echo '<td>#'.$count.'</td>';
  
                echo '<td>'.$auth['auth_name'].'</td>';
				
                echo '<td>Activate</td>';
                echo '<td><a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editauth(\''.$auth['id'].'\')"></a><a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm(\'Are you sure to delete data?\')?authAction(\'delete\',\''.$auth['id'].'\'):false;"></a></td>';
                echo '</tr>';
						
			endforeach;
			
        }else{
            echo '<tr><td colspan="5">No auth(s) found......</td></tr>';
        }
    }else if($_POST['action_type'] == 'add'){
        $authData = array(
            'auth_name' => $_POST['auth_name'],
            'auth_status' => $_POST['auth_status'],
            'auth_isdeleted' => 1 
        );
        $insert = $db->insert($tblName,$authData);
         ECHO $insert?'ok':'err'; 
    }elseif($_POST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $authData = array(
                'auth_name' => $_POST['auth_name'],
                'auth_status' => $_POST['auth_status'],
				'auth_isdeleted' => 1 
            );
            $condition = array('id' => $_POST['id']);
            $update = $db->update($tblName,$authData,$condition);
            echo $update?'ok':'err';
        }
    }elseif($_POST['action_type'] == 'delete'){
        if(!empty($_POST['id'])){
				$authData = array(
             
					'auth_status' => 0,
					'auth_isdeleted' => 0
				);
            $condition = array('id' => $_POST['id']);
            $delete = $db->update($tblName,$authData,$condition);
            echo $delete?'ok':'err';
        }
    }
    exit;
}