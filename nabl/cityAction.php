<?php
include 'DB.php';
$db = new DB();
$tblName = 'city';
if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'data'){
        $conditions['where'] = array('id'=>$_POST['id']);
        $conditions['return_type'] = 'single';
        $city = $db->getRows($tblName,$conditions);
        echo json_encode($city);
    }elseif($_POST['action_type'] == 'view'){
        $citys = $db->getRows($tblName,array('order_by'=>'id DESC'));
        if(!empty($citys)){
            $count = 0;
            foreach($citys as $city): $count++;
				 if($city['city_isdeleted'] == 0){
					echo '<tr>';
					echo '<td>#'.$count.'</td>';
					echo '<td>'.$city['city_name'].'</td>';
					if($city['city_status'] == 0){
						$status="Activate";
					}
					else{
						$status="Dectivate";
					}
					echo '<td>'.$status.'</td>';
					echo '<td><a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editcity(\''.$city['id'].'\')"></a><a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm(\'Are you sure to delete data?\')?cityAction(\'delete\',\''.$city['id'].'\'):false;"></a></td>';
					echo '</tr>';
				 }
            endforeach;
        }else{
            echo '<tr><td colspan="5">No city(s) found......</td></tr>';
        }
    }elseif($_POST['action_type'] == 'add'){
        $cityData = array(
            'city_name' => $_POST['city_name'],
            'city_status' => $_POST['city_status'],
            'city_isdeleted' => "0"
        );
        $insert = $db->insert($tblName,$cityData);
         ECHO $insert?'ok':'err'; 
    }elseif($_POST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){
            $cityData = array(
                'city_name' => $_POST['city_name'],
                'city_status' => $_POST['city_status'],
                'city_isdeleted' => "0"
            );
            $condition = array('id' => $_POST['id']);
            $update = $db->update($tblName,$cityData,$condition);
            echo $update?'ok':'err';
        }
    }elseif($_POST['action_type'] == 'delete'){
        if(!empty($_POST['id'])){
			$cityData = array(
             
					'city_status' => 1,
					'city_isdeleted' => 1

					
				);
            $condition = array('id' => $_POST['id']);
            $delete = $db->update($tblName,$cityData,$condition);
            echo $delete?'ok':'err';
        }
    }
    exit;
}