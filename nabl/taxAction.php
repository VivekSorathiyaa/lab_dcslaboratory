<?php
include 'DB.php';
$db = new DB();
$tblName = 'tax';
if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'data'){
        $conditions['where'] = array('id'=>$_POST['id']);
        $conditions['return_type'] = 'single';
        $tax = $db->getRows($tblName,$conditions);
        echo json_encode($tax);
    }elseif($_POST['action_type'] == 'view'){
        $taxs = $db->getRows($tblName,array('order_by'=>'id DESC'));
        if(!empty($taxs)){
            $count = 0;
            foreach($taxs as $tax): $count++;
                echo '<tr>';
                echo '<td>#'.$count.'</td>';
                echo '<td>'.$tax['tax_cgst'].'</td>';
                echo '<td>'.$tax['tax_sgst'].'</td>';
                echo '<td>'.$tax['tax_igst'].'</td>';
                echo '<td><a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="edittax(\''.$tax['id'].'\')"></a>';
                echo '</tr>';
            endforeach;
        }else{
            echo '<tr><td colspan="5">No tax(s) found......</td></tr>';
        }
    }elseif($_POST['action_type'] == 'add'){
        $taxData = array(
            'tax_cgst' => $_POST['tax_cgst'],
            'tax_sgst' => $_POST['tax_sgst'],
            'tax_igst' => $_POST['tax_igst']
        );
        $insert = $db->insert($tblName,$taxData);
         ECHO $insert?'ok':'err'; 
    }elseif($_POST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $taxData = array(
                'tax_cgst' => $_POST['tax_cgst'],
                'tax_sgst' => $_POST['tax_sgst'],
                'tax_igst' => $_POST['tax_igst']
            );
            $condition = array('id' => $_POST['id']);
            $update = $db->update($tblName,$taxData,$condition);
            echo $update?'ok':'err';
        }
    }elseif($_POST['action_type'] == 'delete'){
        if(!empty($_POST['id'])){
            $condition = array('id' => $_POST['id']);
            $delete = $db->delete($tblName,$condition);
            echo $delete?'ok':'err';
        }
    }
    exit;
}