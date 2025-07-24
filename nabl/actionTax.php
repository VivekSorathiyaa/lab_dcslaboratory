<?php
include 'DB.php';
$db = new DB();
$tblName = 'tax';
if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'data'){
        $conditions['where'] = array('tax_id'=>$_POST['tax_id']);
        $conditions['return_type'] = 'single';
        $user = $db->getRows($tblName,$conditions);
        echo json_encode($user);
    }elseif($_POST['action_type'] == 'view'){
        $users = $db->getRows($tblName,array('order_by'=>'tax_id DESC'));
        if(!empty($users)){
            $count = 0;
            foreach($users as $user): $count++;
                echo '<tr>';
                echo '<td>#'.$count.'</td>';
                echo '<td>'.$user['tax_cgst'].'</td>';
                echo '<td>'.$user['tax_sgst'].'</td>';
                echo '<td>'.$user['tax_igst'].'</td>';
                echo '<td><a href="javascript:votax_id(0);" class="glyphicon glyphicon-edit" onclick="editUser(\''.$user['tax_id'].'\')"></a><a href="javascript:votax_id(0);" class="glyphicon glyphicon-trash" onclick="return confirm(\'Are you sure to delete data?\')?userAction(\'delete\',\''.$user['tax_id'].'\'):false;"></a></td>';
                echo '</tr>';
            endforeach;
        }else{
            echo '<tr><td colspan="5">No user(s) found......</td></tr>';
        }
    }elseif($_POST['action_type'] == 'add'){
        $userData = array(
            'tax_cgst' => $_POST['tax_cgst'],
            'tax_sgst' => $_POST['tax_sgst'],
            'tax_igst' => $_POST['tax_igst']
        );
        $insert = $db->insert($tblName,$userData);
        echo $insert?'ok':'err';
    }elseif($_POST['action_type'] == 'edit'){
        if(!empty($_POST['tax_id'])){
            $userData = array(
                'tax_cgst' => $_POST['tax_cgst'],
                'tax_sgst' => $_POST['tax_sgst'],
                'tax_igst' => $_POST['tax_igst']
            );
            $condition = array('tax_id' => $_POST['tax_id']);
            $update = $db->update($tblName,$userData,$condition);
            echo $update?'ok':'err';
        }
    }elseif($_POST['action_type'] == 'delete'){
        if(!empty($_POST['tax_id'])){
            $condition = array('tax_id' => $_POST['tax_id']);
            $delete = $db->delete($tblName,$condition);
            echo $delete?'ok':'err';
        }
    }
    exit;
}