<?php include("header.php");
  
?>

<?php 
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
}



	$m_c_id= base64_decode($_GET["m_c_id"]);
	$explode_m_c_id=explode("|",$m_c_id);
	
	$m_cat_ids=$explode_m_c_id[0];
	$m_ids=$explode_m_c_id[1];
	
	// select material category name
	$sel_mcat_by_id="select * from material_category where `material_cat_id`=$m_cat_ids";
	$query_m_category=mysqli_query($conn,$sel_mcat_by_id);
	$one_cat=mysqli_fetch_array($query_m_category);
	
	// select material name
	$sel_m_by_id="select * from material where `id`=$m_ids";
	$query_m_name=mysqli_query($conn,$sel_m_by_id);
	$one_m_name=mysqli_fetch_array($query_m_name);
	
    // select test from test master
	$sel_test_by_cat_id="select * from test_master where `mat_category_id`='$m_cat_ids' AND `test_isdeleted`=0 ORDER BY test_name ASC";
	$query_m_wise_test=mysqli_query($conn,$sel_test_by_cat_id);
	
	//select test by m category and material id wise if available in particular test table
	
	$sel_parti_test="select * from particular_test where `mate_cat_id`=$m_cat_ids AND `mate_id`=$m_ids AND `is_deleted`=0";
	$query_parti_test=mysqli_query($conn,$sel_parti_test);
	if(mysqli_num_rows($query_parti_test)>0){
	
	$result_parti_test=mysqli_fetch_array($query_parti_test);
	$testing_array=$result_parti_test["test_ids"];
	$testing_setings=$result_parti_test["test_chk"];
	$exploded_tests=explode(",",$testing_array);
	$exploded_seting=explode(",",$testing_setings);
	}else{
		$exploded_tests=array();
		$exploded_seting=array();
	}
	

?>

<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}






.custom_chk
{
	background-color: red;
    margin-left: 10px;
    margin-top: 10px;
	width: 19%;
    height: 39px;
    padding-left: 7px;
}


ul.ks-cboxtags {
    list-style: none;
    padding: 20px;
}
ul.ks-cboxtags li{
  display: inline;
}
ul.ks-cboxtags li label{
    display: inline-block;
    background-color: brown;
    border: 2px solid rgba(139, 139, 139, .3);
    color: silver;
    border-radius: 25px;
    white-space: nowrap;
    margin: 3px 0px;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    transition: all .2s;
}

ul.ks-cboxtags li label {
    padding: 8px 12px;
    cursor: pointer;
}

ul.ks-cboxtags li input[type="checkbox"]:checked + label {
       border: 2px solid #1bdbf8;
    background-color: #4DEC3B;
    color: black;
    transition: all .2s;
    font-weight: bold;
}

ul.ks-cboxtags li input[type="checkbox"] {
  display: absolute;
}
ul.ks-cboxtags li input[type="checkbox"] {
  position: absolute;
  opacity: 0;
}
ul.ks-cboxtags li input[type="checkbox"]:focus + label {
  border: 2px solid #e9a1ff;
}


</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">
<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
			<?php include("menu.php") ?>
			<div class="row">
		
		<h1 style="text-align:center;">
		Material Wise Test Testing
		</h1>
	</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body"  style="border:1px groove #ddd;">
							<br>
								<div class="row">
									<div class="col-sm-6">
									<label for="inputEmail3" class="col-sm-6 control-label"> Material Category:</label>
									</div>
									
									<div class="col-sm-6">
									<label for="inputEmail3" class="col-sm-6 control-label">Material Name:</label>
									</div>
									
								</div>
								<div class="row">
									
										  <div class="col-sm-6">
											<input type="text" class="form-control" value="<?php echo $one_cat['material_cat_name'];?>" id="txt_m_cat_name" name="txt_m_cat_name" disabled>
										  </div>
										
										
										  
											<div class="col-sm-6">
												
													<input type="text" class="form-control" value="<?php echo $one_m_name['mt_name'];?>" id="txt_m_name" name="txt_m_name" disabled>
											</div>
								</div>
								<input type="hidden" name="txt_m_cat_id" id="txt_m_cat_id" value="<?php echo $m_cat_ids;?>">
								<input type="hidden" name="txt_m_id" id="txt_m_id" value="<?php echo $m_ids;?>">
								<br>
								
								
							<div class="panel-group">
								<div class="box box-info">
									<div class="box-body">
									  <div class="" id="display_data">
										<div class="row">
									<ul class="ks-cboxtags">
										<?php
										if(mysqli_num_rows($query_m_wise_test) > 0)
										{
											$counts=0;
											while($one_test=mysqli_fetch_array($query_m_wise_test))
											{
												if (in_array($one_test['test_id'], $exploded_tests))
													{
													  $checkeded="checked";
													}
													else
													{
													  $checkeded="";
													}
													
												if (in_array($one_test['test_id'], $exploded_seting))
												{
													$set_chk="checked";
												}else{
													$set_chk="";
												}
										?>
									    <!--<div class="col-sm-2 custom_chk">
										<input type="checkbox" class="control-form" value="<?php //echo $one_test['test_id'];?>"><?php //echo $one_test['test_name'];?>
										</div>-->
										<li><input type="checkbox" name="chk_test" id="<?php echo $one_test['test_id'];?>" value="<?php echo $one_test['test_id'];?>" <?php echo $checkeded;?>><label for="<?php echo $one_test['test_id'];?>"><?php echo $one_test['test_name'];?></label></li>
										<?php 
										
										?>
										<input type="checkbox" name="setings" id="chk_<?php echo $one_test['test_id'];?>" value="<?php echo $one_test['test_id'];?>" <?php echo $set_chk; ?>>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							
										<?php
										
										$counts++;
											}
										}
										?>
    
    
										</ul>	
									  </div>
										  <div class="row">
										   <div class="col-md-12" align="center">
											<a href="javascript:void(0);" class="btn btn-primary btn3d test_done"><span class="glyphicon glyphicon-question-ok"></span> Done</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<br>
						</div>
					</div>
				</div>
</section>	
</div>
  
	
<?php include("footer.php");?>
	  	  
<script>


$(document).on("click", ".test_done", function () {
				var txt_m_cat_name = $("#txt_m_cat_name").val(); 
				var txt_m_name = $("#txt_m_name").val(); 
				var txt_m_cat_id = $("#txt_m_cat_id").val(); 
				var txt_m_id = $("#txt_m_id").val(); 
				var array_test = [];
				var array_settings = [];
				
            $.each($("input[name='chk_test']:checked"), function(){
                array_test.push($(this).val());
			});
			
			$.each($("input[name='setings']:checked"), function(){
                array_settings.push($(this).val());
				
			});
			

			
			
			
			
			if (array_test.length === 0) {
				alert("Any Test Not Selected");
				return false;
			};
	
	$.confirm({
        title: "warning",
        content: "Are You Sure To Done ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_set_material_wise_test.php',
        data: 'action_type=test_done&txt_m_cat_name='+txt_m_cat_name+'&txt_m_name='+txt_m_name+'&txt_m_cat_id='+txt_m_cat_id+'&txt_m_id='+txt_m_id+'&array_test='+array_test+'&array_settings='+array_settings,
        success:function(html){
			location.reload();
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});



</script>
