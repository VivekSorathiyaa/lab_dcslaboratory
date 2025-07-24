<?php 
session_start(); 
include("header.php");
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
}

$sel_voch="select * from st_voucher ORDER BY voucher_id DESC LIMIT 0,1";
$query_vouch=mysqli_query($conn,$sel_voch);
if(mysqli_num_rows($query_vouch) > 0)
{
	$one_vouch=mysqli_fetch_array($query_vouch);
	$explodings=explode("/",$one_vouch["voucher_code"]);
	$lasts=intval($explodings[1])+1;
	$sets= sprintf('%04d', $lasts);
	
	$txt_vouch=$vou_first_parts.$sets;
}else{
	$txt_vouch=$vou_first_parts."0001";
}

?>

<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}
.form-control { 
font-size: 16px;; 
}

/* only for 3d button effects */

.btn3d {
    transition:all .08s linear;
    position:relative;
    outline:medium none;
    -moz-outline-style:none;
    border:0px;
    margin-right:10px;
    margin-top:15px;
}
.btn3d:focus {
    outline:medium none;
    -moz-outline-style:none;
}
.btn3d:active {
    top:9px;
}
.btn-primary {
    box-shadow:0 0 0 1px #428bca inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #357ebd, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#428bca;
}


</style>

<div class="content-wrapper" style="margin-left: 0px !important;">

	<!-- Content Header (Page header) -->

	<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
	<?php include("menu.php") ?>
	<div class="row">
		
		<h1 style="text-align:center;">
		Add Voucher
		</h1>
	</div>
		<div class="row">
			<div class="col-md-12">
			<div class="box box-info">
				<div class="col-md-12">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<div class="active tab-pane" id="clients">
					<form class="" method="post" >
					
						
							<div class="row">							
							<div class="col-md-4">
								<label>Voucher Code:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="" id="voucher_code" name="voucher_code" value="<?php echo $txt_vouch;?>" disabled>
							</div>
							
							<div class="col-md-4">
								<label>Voucher Date:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="" id="voucher_date" name="voucher_date" value="<?php echo date('d/m/Y');?>">
							</div>
							
							<div class="col-md-4">
								<label>Given To Person:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter Person Name" id="given_person" name="given_person">
							</div>
							</div>
							<br>
							<div class="row">							
							
							<div class="col-md-4">
								<label>Amount:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter Amount" id="amounts" name="amounts">
							</div>							
							<div class="col-md-4">
								<label>Payment Type:</label>
									<select class="form-control select2" name="pay_type" id="pay_type" >
										<option value="">Select-Payment Type</option>
										<option value="Cash">Cash</option>
										<option value="Cheque">Cheque</option>
										<option value="RTGS">RTGS</option>
									</select>
							</div>
							<div class="col-md-4">
								<label>Remark Type:</label>
									<select class="form-control select2" name="remark_type" id="remark_type" >
										<option value="">Select-Remark Type</option>
										<option value="Transportation">Transportation</option>
										<option value="Accommodation">Accommodation</option>
										<option value="Commission">Commission</option>
										<option value="Other">Other</option>
									</select>
							</div>
							
							</div>
							<br>
							<div class="row">							
							
							
							<div class="col-md-12">
								<label>Description:</label>
									<textarea id="editor1" name="editor1" tabindex="5" class="col-sm-12 form-control"required ></textarea>
							</div>
							</div>
						<br>
									<div class="row">
									<div class="col-sm-4">&nbsp;</div>
									
									<div class="col-sm-4" style="text-align: center;">
											<button type="button" class="btn btn-primary btn-lg btn3d " id="btn_save_client" name="sub_client" tabindex="25" onclick="saveclient('add_vouchers')" style="margin-bottom:25px;    border-radius: 20px;"><span class="glyphicon glyphicon-cloud"></span> Save</button>
									        <span id="available_msg" style="color:red;font-size:20px;"></span>
											
											<!--<button type="button" class="btn btn-primary btn-lg btn3d " id="btn_save_client1" name="sub_client1" tabindex="25" onclick="saveclient('add_and_next')" style="margin-bottom:25px;    border-radius: 20px;"><span class="glyphicon glyphicon-cloud"></span> Save & Next</button>-->
									</div>
									
									<div class="col-sm-4">
									</div>
								</div>
							
							
						</form>
					</div>
			  <div id = "myDiv" style="display:none"><img id = "myImage" src = "https://cdn-images-1.medium.com/max/1600/0*JVdgKzSfU4q4psf6.gif"></div>
					<!-- /.tab-pane -->

					</div>
				<!-- /.tab-content -->
			</div>
          <!-- /.nav-tabs-custom -->
        </div>
</section>
</div>
</div>
		
<?php include("footer.php");?>
<script>

 $('#voucher_date').datepicker({
		  autoclose: true,
		  format: 'dd/mm/yyyy'
	});

  $(function () {
    $('.select2').select2();
  });


// client save
function saveclient(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add_vouchers') {		
				var voucher_code = $('#voucher_code').val(); 
				var voucher_date = $('#voucher_date').val(); 
				var given_person = $('#given_person').val(); 
				var amounts = $('#amounts').val(); 
				var pay_type = $('#pay_type').val();
				var remark_type = $('#remark_type').val();
				var discripts = CKEDITOR.instances.editor1.getData();
				
				if(voucher_date =="")
				{
					alert("Please Select Voucher Date");
					return false;
				}
				
				if(given_person =="")
				{
					alert("Please Enter Given Name");
					return false;
				}
				
				if(amounts=="")
				{
					alert("Please Enter Amount");
					return false;
				}
				
				if(pay_type=="")
				{
					alert("Please Select Payment Type");
					return false;
				}
				
				if(remark_type=="")
				{
					alert("Please Select Remark Type");
					return false;
				}

				//billData = '&action_type='+type+'&sends='+sends+'&user_type='+user_type+'&totals='+totals+'&paids='+paids+'&remains='+remains;
				
	
	}
	else{
			
	
				billData = 'action_type='+type+'&id='+id;
    }
	
	// set blank message to submit
	
		form_data = new FormData();
	
		
		form_data.append("action_type", type);
		form_data.append("voucher_code", voucher_code);
		form_data.append("voucher_date", voucher_date);
		form_data.append("given_person", given_person);
		form_data.append("amounts", amounts);
		form_data.append("pay_type", pay_type);
		form_data.append("remark_type", remark_type);
		form_data.append("discripts", discripts);
		
    $.ajax({
        url : "<?php $base_url; ?>save_voucher.php",
		type: "POST",
		dataType:'JSON',
		data : form_data,
		processData: false,
		contentType: false,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},
        success:function(data){
			document.getElementById("overlay_div").style.display="none";
			if(data.status=="0")
			{
				alert(data.msg);
				return false;
			}else{
				alert("Voucher Is Successfully Saved");
				window.location.href="<?php $base_url; ?>voucher_list.php";
			}
			
			
			
        }
    });
  
}

$(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })

</script>