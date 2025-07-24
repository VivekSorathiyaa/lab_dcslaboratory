 <?php
 session_start();	
include 'DB.php';
$db = new DB();
$tblName = 'agency';
if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'data'){
        $conditions['where'] = array('id'=>$_POST['id'], 'agency_isdeleted' => 0 , 'agency_status' => 1);
        $conditions['return_type'] = 'single';
        $agency = $db->getRows($tblName,$conditions);
        echo json_encode($agency);
    }elseif($_POST['action_type'] == 'view'){
        $agencies = $db->getRows($tblName,array('order_by'=>'id DESC'));
        if(!empty($agencies)){
            $count = 0;
            foreach($agencies as $agency): $count++;
                echo '<tr>';
                echo '<td>#'.$count.'</td>';
                echo '<td>'.$agency['agency_name'].'</td>';
                echo '<td>'.$agency['agency_status'].'</td>';
                echo '<td><a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editagency(\''.$agency['id'].'\')"></a><a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm(\'Are you sure to delete data?\')?actionagency(\'delete\',\''.$agency['id'].'\'):false;"></a></td>';
                echo '</tr>';
            endforeach;
        }else{
            echo '<tr><td colspan="5">No tax(s) found......</td></tr>';
        }
    }elseif($_POST['action_type'] == 'add'){
        $taxData = array(
            'agency_name' => $_POST['agency_name'],
            'agency_status' => $_POST['agency_status'],
            'agency_createdby' => $_SESSION['name'],
            'agency_createddate' => date("y-m-d"),
            'agency_modifiedby' => 0,
            'agency_modifieddate' => 0,
            'agency_isdeleted' => 0
        );
        $insert = $db->insert($tblName,$taxData);
         ECHO $insert?'ok':'err'; 
    }elseif($_POST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $taxData = array(
                'agency_name' => $_POST['agency_name'],
            'agency_status' => $_POST['agency_status'],
            'agency_createdby' => $_SESSION['name'],
            'agency_createddate' => date("y-m-d"),
            'agency_modifiedby' => 0,
            'agency_modifieddate' => "",
            'agency_isdeleted' => 1
            );
            $condition = array('id' => $_POST['id']);
            $update = $db->update($tblName,$taxData,$condition);
            echo $update?'ok':'err';
        }
    }elseif($_POST['action_type'] == 'delete'){
        if(!empty($_POST['id'])){
           $taxData = array(
                'agency_isdeleted' => 0
				
            );
            $condition = array('id' => $_POST['id']);
            $update = $db->update($tblName,$taxData,$condition);
            echo $update?'ok':'err';
        }
    }
    exit;
}