<?php
include 'DB.php';
$db = new DB();
session_start();
$tblName = 'material_category';
if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'data'){
        $conditions['where'] = array('material_cat_id'=>$_POST['id']);
        $conditions['return_type'] = 'single';
        $mt = $db->getRows($tblName,$conditions);
        echo json_encode($mt);
    }elseif($_POST['action_type'] == 'view'){
        $mts = $db->getRows($tblName,array('order_by'=>'material_cat_id DESC'));
        if(!empty($mts)){
			
            $count = 0;
            foreach($mts as $mt): $count++;
			$sel_staff_name="select * from multi_login where `id`=$mt[material_engineer] AND `staff_isdeleted`=0";
			$query_staff_name=mysqli_query($conn,$sel_staff_name);
			$one_staff_name=mysqli_fetch_array($query_staff_name);
			if($mt['material_cat_isdelete']==0){
				echo '<tr>';
                echo '<td>#'.$count.'</td>';
                echo '<td>'.$mt['material_cat_name'].'</td>';
                echo '<td>'.$mt['cat_prefix'].'</td>';
                echo '<td>'.$one_staff_name['staff_fullname'].'</td>';
				if($mt['material_cat_status'] == 1){
					$status="Activate";
				}
				else{
					$status="Dectivate";
				}
                echo '<td>'.$status.'</td>';
                echo '<td><a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editmt(\''.$mt['material_cat_id'].'\')"></a><a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm(\'Are you sure to delete data?\')?mate_catAction(\'delete\',\''.$mt['material_cat_id'].'\'):false;"></a></td>';
                echo '</tr>';
		}		
		 endforeach;
		
        }else{
            echo '<tr><td colspan="5">No mt(s) found......</td></tr>';
        }
    }elseif($_POST['action_type'] == 'add'){		
        $mtData = array(
            'material_cat_name' => $_POST['material_catname'],
            'cat_prefix' => $_POST['prefix'],
            'material_engineer' => $_POST['engineer'],
            'material_cat_status' => $_POST['status']
      
        );
        $insert = $db->insert($tblName,$mtData);
         ECHO $insert?'ok':'err'; 
    }elseif($_POST['action_type'] == 'edit'){
		
        if(!empty($_POST['id'])){
			
            $mtData = array(
			'material_cat_name' => $_POST['mate_catname_edit'],
			'cat_prefix' => $_POST['prefix_edit'],
			'material_engineer' => $_POST['engineer_edit'],
            'material_cat_status' => $_POST['mate_status_edit']
            );
			
            $condition = array('material_cat_id' => $_POST['id']);
            $update = $db->update($tblName,$mtData,$condition);
            echo $update?'ok':'err';
        }
    }elseif($_POST['action_type'] == 'delete'){
		if(!empty($_POST['id'])){
				$mtData = array(
             
					'material_cat_isdelete' => 1
					
				);
            $condition = array('material_cat_id' => $_POST['id']);         
		   $delete = $db->update($tblName,$mtData,$condition);
            echo $delete?'ok':'err';
        }
    }
    exit;
}
?>
