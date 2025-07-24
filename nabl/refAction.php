<?php
include 'DB.php';
$db = new DB();
$tblName = 'reference';
if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'data'){
        $conditions['where'] = array('id'=>$_POST['id']);
        $conditions['return_type'] = 'single';
        $ref = $db->getRows($tblName,$conditions);
        echo json_encode($ref);
    }elseif($_POST['action_type'] == 'view'){
        $refs = $db->getRows($tblName,array('order_by'=>'id DESC'));
        if(!empty($refs)){
            $count = 0;
            foreach($refs as $ref): $count++;
			 if($ref['ref_isdeleted'] == 1){
                echo '<tr>';
                echo '<td>#'.$count.'</td>';
                echo '<td>'.$ref['ref_name'].'</td>';
				if($ref['ref_status'] == 1){
					$status="Activate";
				}
				else{
					$status="Dectivate";
				}
                echo '<td>'.$status.'</td>';
                echo '<td><a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editref(\''.$ref['id'].'\')"></a><a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm(\'Are you sure to delete data?\')?refAction(\'delete\',\''.$ref['id'].'\'):false;"></a></td>';
                echo '</tr>';
			 }
            endforeach;
        }else{
            echo '<tr><td colspan="5">No ref(s) found......</td></tr>';
        }
    }elseif($_POST['action_type'] == 'add'){
        $refData = array(
            'ref_name' => $_POST['ref_name'],
            'ref_status' => $_POST['ref_status'],
			'ref_isdeleted' => 1 

        );
        $insert = $db->insert($tblName,$refData);
         ECHO $insert?'ok':'err'; 
    }elseif($_POST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $refData = array(
                'ref_name' => $_POST['ref_name'],
                'ref_status' => $_POST['ref_status'],
				'ref_isdeleted' => 1 
            );
            $condition = array('id' => $_POST['id']);
            $update = $db->update($tblName,$refData,$condition);
            echo $update?'ok':'err';
        }
    }elseif($_POST['action_type'] == 'delete'){
        if(!empty($_POST['id'])){
			 $refData = array(
					'ref_status' => 0,
					'ref_isdeleted' => 0
			  );		
            $condition = array('id' => $_POST['id']);
            $delete = $db->update($tblName,$refData,$condition);
            echo $delete?'ok':'err';
        }
    }
    exit;
}