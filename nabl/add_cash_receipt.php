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

$sel_voch="select * from cash_receipt ORDER BY receipt_id DESC LIMIT 0,1";
$query_vouch=mysqli_query($conn,$sel_voch);
if(mysqli_num_rows($query_vouch) > 0)
{
	$one_vouch=mysqli_fetch_array($query_vouch);
	$explodings=explode("/",$one_vouch["receipt_code"]);
	$lasts=intval($explodings[1])+1;
	$sets= sprintf('%04d', $lasts);
	
	$txt_vouch=$cash_first_parts.$sets;
}else{
	$txt_vouch=$cash_first_parts."0001";
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
		Add Cash Receipt
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
							<div class="col-md-2">
								<label>AGENCY:</label>
									<select class="form-control select2" name="sel_client" id="sel_client" >
									<option value="">Select-Agency</option>
									<?php
									$clients="select * from agency_master where `isdeleted`=0";
									$query_client=mysqli_query($conn,$clients);
									if(mysqli_num_rows($query_client) > 0)
									{
										while($one_client=mysqli_fetch_array($query_client))
										{
									?>
										<option value="<?php echo $one_client["agency_id"];?>"><?php echo $one_client["agency_name"];?></option>
									<?php
										}
									}
									?>
									</select>
							</div>
							
							<div class="col-md-2">
							<label>OR</label>
							</div>
							<div class="col-md-2">
								<label>CLIENT:</label>
									<select class="form-control select2" name="sel_auth" id="sel_auth" >
									<option value="">Select-Client</option>
									<?php
									$clients="select * from client where `clientisdeleted`=0";
									$query_client=mysqli_query($conn,$clients);
									if(mysqli_num_rows($query_client) > 0)
									{
										while($one_client=mysqli_fetch_array($query_client))
										{
									?>
										<option value="<?php echo $one_client["client_code"];?>"><?php echo $one_client["clientname"];?></option>
									<?php
										}
									}
									?>
									</select>
							</div>
							
							</div>
							<br>
							<div class="row">
							<div class="col-md-4">
								<label>TOTAL:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="" id="total" name="total" value="0" disabled>
							</div>
							
							<div class="col-md-4">
								<label>PAID:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="" id="paid" name="paid" value="0" disabled>
							</div>
							
							<div class="col-md-4">
								<label>REMAIN:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter Person Name" id="remain" name="remain" value="0" disabled>
							</div>
							</div>
							<br>
							<div class="row">
							<div class="col-md-4">
								<label>Receipt Code:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="" id="receipt_code" name="receipt_code" value="<?php echo $txt_vouch;?>" disabled>
							</div>
							
							<div class="col-md-4">
								<label>Receipt Date:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="" id="receipt_date" name="receipt_date" value="<?php echo date('d/m/Y');?>">
							</div>
							
							<div class="col-md-4">
								<label>Payment Type:</label>
									<select class="form-control select2" name="pay_type" id="pay_type" >
										<option value="Cash">Cash</option>
									</select>
							</div>
							
							</div>
							<br>
							<div class="row">							
							
							<div class="col-md-4">
								<label>Payment Amount:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter Payment Amount" id="payment_amounts" name="payment_amounts" value="0">
							</div>
							
							<div class="col-md-4">
								<label>Tds Amount:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter Tds Amount" id="tds_amounts" name="tds_amounts" value="0">
							</div>
							
							<div class="col-md-4">
								<label>Total Amount:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter Total Amount" id="total_amounts" name="total_amounts" disabled>
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
							<div class="col-md-12" id="display_data"></div>
						</div>
						
						<br>
									<div class="row">
									<div class="col-sm-4">&nbsp;</div>
									
									<div class="col-sm-4" style="text-align: center;">
											<button type="button" class="btn btn-primary btn-lg btn3d " id="btn_save_client" name="sub_client" tabindex="25" onclick="saveclient('add_receipt')" style="margin-bottom:25px;    border-radius: 20px;"><span class="glyphicon glyphicon-cloud"></span> Save</button>
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

 $('#receipt_date').datepicker({
		  autoclose: true,
		  format: 'dd/mm/yyyy'
	});

  $(function () {
    $('.select2').select2();
  });

$(document).on("change","#sel_client", function(){
	var sel_client= $("#sel_client").val();
	var sel_auth= $("#sel_auth").val();
	if(sel_client !="" && sel_auth !="")
	{
		alert("Please Select Any One,Client Or Authority");
		return false;
	}
	
	
	
	if(sel_client !="" && sel_auth =="")
	{
		form_data = new FormData();
	
		
		form_data.append("action_type", "one_changes");
		form_data.append("user_types", "agency");
		form_data.append("sends", sel_client);
		
		$.ajax({
        url : "<?php $base_url; ?>save_cash_receipt.php",
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
			$("#total").val(data.total_balance);
			$("#paid").val(data.paid_balance);
			$("#remain").val(data.remain_balance);
			$("#paid").css("color","green");
			$("#remain").css("color","red");
			
			//for_bill_gets("0",sel_client);
        }
		});
	}
})


$(document).on("change","#sel_auth", function(){
	var sel_client= $("#sel_client").val();
	var sel_auth= $("#sel_auth").val();
	if(sel_client !="" && sel_auth !="")
	{
		alert("Please Select Any One,Client Or Authority");
		return false;
	}
	if(sel_client =="" && sel_auth !="")
	{
		form_data = new FormData();
	
		
		form_data.append("action_type", "one_changes");
		form_data.append("user_types", "clients");
		form_data.append("sends", sel_auth);
		
		$.ajax({
        url : "<?php $base_url; ?>save_cash_receipt.php",
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
			$("#total").val(data.total_balance);
			$("#paid").val(data.paid_balance);
			$("#remain").val(data.remain_balance);
			
			$("#paid").css("color","green");
			$("#remain").css("color","red");
			
			//for_bill_gets("1",sel_auth);
        }
		});
	}
})

$(document).on("change","#sel_other", function(){
	var sel_client= $("#sel_client").val();
	var sel_auth= $("#sel_auth").val();
	var sel_other= $("#sel_other").val();
	if(sel_client !="" && sel_auth !="" && sel_other !="")
	{
		alert("Please Select Any One,Client Or Authority");
		return false;
	}
	if(sel_client !="" && sel_auth !="" && sel_other =="")
	{
		alert("Please Select Any One,Client Or Authority");
		return false;
	}
	if(sel_client !="" && sel_auth =="" && sel_other !="")
	{
		alert("Please Select Any One,Client Or Authority");
		return false;
	}
	
	if(sel_client =="" && sel_auth =="" && sel_other !="")
	{
		form_data = new FormData();
	
		
		form_data.append("action_type", "one_changes");
		form_data.append("user_types", "other_customer");
		form_data.append("sends", sel_other);
		
		$.ajax({
        url : "<?php $base_url; ?>save_cash_receipt.php",
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
			$("#total").val(data.total_balance);
			$("#paid").val(data.paid_balance);
			$("#remain").val(data.remain_balance);
			
			$("#paid").css("color","green");
			$("#remain").css("color","red");
			
			for_bill_gets("2",sel_other);
        }
		});
	}
})

$(document).on("change","#payment_amounts", function(){
	var payment_amounts= $("#payment_amounts").val();
	var tds_amounts= $("#tds_amounts").val();
	
	
	var tots= parseInt(payment_amounts) + parseInt(tds_amounts);
	$("#total_amounts").val(tots);
	
})

$(document).on("change","#tds_amounts", function(){
	var payment_amounts= $("#payment_amounts").val();
	var tds_amounts= $("#tds_amounts").val();
	
	
	var tots= parseInt(payment_amounts) + parseInt(tds_amounts);
	$("#total_amounts").val(tots);
	
})
// client save
function saveclient(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add_receipt') {
				var remain = $('#remain').val(); 
				var sel_client = $('#sel_client').val(); 
				var sel_auth = $('#sel_auth').val();
				var sel_other = $('#sel_other').val();
				var receipt_date = $('#receipt_date').val(); 
				var pay_type = $('#pay_type').val(); 
				var payment_amounts = $('#payment_amounts').val(); 
				var tds_amounts = $('#tds_amounts').val(); 
				var total_amounts = $('#total_amounts').val(); 
				var pay_type = $('#pay_type').val();
				var remark_type = $('#remark_type').val();
				var discripts = CKEDITOR.instances.editor1.getData();
				
				if(sel_client =="" && sel_auth =="")
				{
					alert("Please Select Client Or Agency");
					return false;
				}
				
				if(sel_client !="" && sel_auth !="")
				{
					alert("Please Select Only One, Client Or Agency");
					return false;
				}
				
				
				
				
				
				
				
				if(sel_client !="" && sel_auth =="")
				{
					var user_type="agency";
					var sends=$('#sel_client').val();
				}
				
				if(sel_client =="" && sel_auth !="")
				{
					var user_type="clients";
					var sends=$('#sel_auth').val();
				}
				
				
				if(receipt_date =="")
				{
					alert("Please Select Receipt Date");
					return false;
				}
				
				if(pay_type =="")
				{
					alert("Please Select Pyment Type");
					return false;
				}
				
				if(payment_amounts=="")
				{
					alert("Please Enter Payment Amount");
					return false;
				}
				
				if(payment_amounts=="0")
				{
					alert("Please Enter Payment Amount More Than 0");
					return false;
				}
				
				if(tds_amounts=="")
				{
					alert("Please Enter Tds Amount");
					return false;
				}
				
				if(total_amounts=="")
				{
					alert("Total Is Empty");
					return false;
				}
				
				if(remain=="0")
				{
					alert("Payment Not Remain For This Clients");
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
		form_data.append("user_type", user_type);
		form_data.append("sends", sends);
		form_data.append("receipt_date", receipt_date);
		form_data.append("pay_type", pay_type);
		form_data.append("payment_amounts", payment_amounts);
		form_data.append("tds_amounts", tds_amounts);
		form_data.append("discripts", discripts);
		form_data.append("total_amounts", total_amounts);
		
    $.ajax({
        url : "<?php $base_url; ?>save_cash_receipt.php",
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
				alert("Cash Receipt Is Successfully Saved");
				window.location.href="<?php $base_url; ?>cash_receipt_list.php";
			}
			
			
			
        }
    });
  
}


function for_bill_gets(bill_to,user_ids){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
			
				var bill_to = bill_to; 
				var user_ids = user_ids; 
				form_data = new FormData();
	
		
		form_data.append("action_type", "for_bill_gets");
		form_data.append("bill_to", bill_to);
		form_data.append("user_ids", user_ids);
		
    $.ajax({
        url : "<?php $base_url; ?>save_cash_receipt.php",
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
			$("#display_data").html(data.designs);
			
			
			
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