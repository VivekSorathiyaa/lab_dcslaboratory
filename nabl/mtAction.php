<?php
include 'DB.php';
$db = new DB();
session_start();
$tblName = 'material';
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
                if($mt['mt_status'] == 1){
				
				$get_cat_conditions['where'] = array('material_cat_id'=>$mt['mat_category_id']);
				$get_only_category = $db->getRows("material_category",$get_cat_conditions);
				echo '<tr>';
                echo '<td>#'.$count.'</td>';
				echo '<td><a href="set_material_wise_test.php?m_c_id=base64_encode('.$mt['mat_category_id'].'|'.$mt['id'].')" target="" title="Add Test" class="glyphicon glyphicon-filter"></a><a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editmt(\''.$mt['id'].'\')"></a><a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm(\'Are you sure to delete data?\')?mtAction(\'delete\',\''.$mt['id'].'\'):false;"></a></td>';
                echo '<td>'.$mt['mt_name'].'</td>';
                echo '<td>'.$get_only_category[0]['material_cat_name'].'</td>';
                /* echo '<td>'.$mt['per_day_limit'].'</td>';
                echo '<td>'.$mt['mt_prefix'].'</td>'; */
                echo '<td>'.$mt['filename'].'</td>';
                echo '<td>'.$mt['filename_lab'].'</td>';
                echo '<td>'.$mt['table_name'].'</td>';
                echo '<td>'.$mt['print_report'].'</td>';
                echo '<td>'.$mt['print_back'].'</td>';
                echo '<td>'.$mt['in_nabl'].'</td>';
                echo '<td>'.$mt['rate_other'].'</td>';
                echo '<td>'.$mt['rate_private'].'</td>';
                echo '<td>'.$mt['rate_govt'].'</td>';
				if($mt['mt_status'] == 1){
					$status="Activate";
				}
				else{
					$status="Dectivate";
				}
                echo '<td>'.$status.'</td>';
                
                echo '</tr>';
				}		
			endforeach;
			
        }else{
            echo '<tr><td colspan="5">No mt(s) found......</td></tr>';
        }
    }
	elseif($_POST['action_type'] == 'add'){
		
		if(isset($_POST['in_nabl'])){
			$in_nabl="yes";
		}else{
			$in_nabl="no";
		}
		
        $mtData = array(
            'mat_category_id' => $_POST['sel_mt_category'],
            'mt_name' => $_POST['mt_name'],
            'in_nabl' => $_POST['sel_nabl'],
			'mt_prefix' => $_POST['prefix'],
            'filename' => $_POST['filename'],
            'filename_lab' => $_POST['filename_lab'],
            'table_name' => $_POST['table_name'],
            'print_report' => $_POST['print_report'],
            'print_back' => $_POST['print_back'],
            'per_day_limit' => $_POST['per_day_limit'],
            'rate_other' => $_POST['rate_other'],
            'rate_govt' => $_POST['rate_govt'],
            'rate_private' => $_POST['rate_private'],
            'mt_createdby' => $_SESSION['name'],
            'mt_createdate' => date("Y-m-d"),
            'mt_modifiedby' => "",
            'mt_modifieddate' => "0000-00-00",
            'mt_isdeleted' => 0 
        );
        $insert = $db->insert($tblName,$mtData);
         ECHO $insert?'ok':'err'; 
    }
	elseif($_POST['action_type'] == 'edit'){
		
		if(!empty($_POST['id'])){
            $mtData = array(
			'mat_category_id' => $_POST['sel_mt_category_edit'],
			'mt_name' => $_POST['mt_name_edit'],
			'in_nabl' => $_POST['edit_sel_nabl'],
			'mt_prefix' => $_POST['prefix_edit'],
            'filename' => $_POST['filename_edit'],
            'filename_lab' => $_POST['filename_lab_edit'],
            'table_name' => $_POST['table_name_edit'],
            'print_report' => $_POST['print_report_edit'],
            'print_back' => $_POST['print_back_edit'],
            'per_day_limit' => $_POST['per_day_limit_edit'],
            'rate_other' => $_POST['rate_other_edit'],
            'rate_govt' => $_POST['rate_govt_edit'],
            'rate_private' => $_POST['rate_private_edit'],
            'mt_modifiedby' => $_SESSION['name'],
            'mt_modifieddate' => date("Y-m-d"),
            'mt_isdeleted' => 0 
            );
            $condition = array('id' => $_POST['id']);
            $update = $db->update($tblName,$mtData,$condition);
            echo $update?'ok':'err';
        }
    }elseif($_POST['action_type'] == 'delete'){
        if(!empty($_POST['id'])){
				$mtData = array(
             
					'mt_status' => 0,
					'mt_isdeleted' => 0
				);
            $condition = array('id' => $_POST['id']);
            $delete = $db->update($tblName,$mtData,$condition);
            echo $delete?'ok':'err';
        }
    }
    exit;
}
?>
