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

$sel_voch="select * from purchages_out ORDER BY purchage_out_id DESC LIMIT 0,1";
$query_vouch=mysqli_query($conn,$sel_voch);
if(mysqli_num_rows($query_vouch) > 0)
{
	$one_vouch=mysqli_fetch_array($query_vouch);
	$explodings=explode("/",$one_vouch["purchage_out_code"]);
	$lasts=intval($explodings[2])+1;
	$sets= sprintf('%04d', $lasts);
	
	$txt_vouch=$pur_out_first_parts.$sets;
}else{
	$txt_vouch=$pur_out_first_parts."0001";
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
		Add Payment Out
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
								<label>Payment Out Code:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="" id="pur_code" name="pur_code" value="<?php echo $txt_vouch;?>" disabled>
							</div>
							
							<div class="col-md-2">
								<label>Party Name:</label>
								<select id="party_name" name="party_name" class="form-control select2">
								<option value="">Select Party</option>
								<?php
								$sql = "select * from party_master where `is_deleted`=0";
								$result = mysqli_query($conn, $sql);
								while($row = mysqli_fetch_array($result)) {
								   ?>
								  <option value="<?php echo $row['party_id'].'|'.$row['party_name'];?>"><?php echo $row['party_name'];?></option>
								  <?php
								}
								?>
								
								</select>
							</div>
							<div class="col-md-1">
														<input type="button" value="NEW" class="col-sm-10 btn btn-info" data-toggle="modal" data-target="#modal-agency" style="margin-top:20px;">
												</div>
							
							<div class="col-md-2">
								<label>GST No:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter GST No" id="gst_no" name="gst_no">
							</div>
							<div class="col-md-2">
								<label>Bill No:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter Bill No" id="bill_no" name="bill_no">
							</div>
							<div class="col-md-2">
								<label>Bill Date:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="" id="bill_date" name="bill_date" value="<?php echo date('d/m/Y');?>">
							</div>
							
							
							
							</div>
							<br>
							<div class="row">
								<div class="col-md-2">
								<label>Total:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="" id="get_totals" name="get_totals" value="0">
								</div>
								
								<div class="col-md-2">
								<label>Paid:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="" id="get_paid" name="get_paid" value="0">
								</div>
								
								<div class="col-md-2">
								<label>Remain:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="" id="get_remain" name="get_remain" value="0">
								</div>
							</div>
							<br>
							<div class="row">
							<!--<div class="col-md-2">
								<label>Taxable Value:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter Taxable Amount" id="taxable_amnt" name="taxable_amnt">
							</div>
							
							<div class="col-md-2">
								<label>CGST Amount:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter CGST Amount" id="cgst_amnt" name="cgst_amnt">
							</div>
							
							<div class="col-md-2">
								<label>SGST Amount:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter SGST Amount" id="sgst_amnt" name="sgst_amnt">
							</div>
							
							<div class="col-md-2">
								<label>IGST Amount:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter IGST Amount" id="igst_amnt" name="igst_amnt">
							</div>-->
							
							<div class="col-md-2">
								<label>Total Amount:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter Total Amount" id="total_amnt" name="total_amnt">
							</div>
							
							<div class="col-md-2">
								<label>TDS Amount:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter TDS Amount" id="tds_amnt" name="tds_amnt" value="0">
							</div>
							<div class="col-md-2">
								<label>Payment Type:</label>
								<select id="payment_type" name="payment_type" class="form-control select2">
								<option value="">Select payment type</option>
								<option value="cash">Cash</option>
								<option value="cheque">Cheque</option>
								<option value="rtgs">RTGS</option>
								</select>
							</div>
							
							<div class="col-md-4">
								<label>Remark:</label>
									<textarea id="editor1" name="editor1" tabindex="5" class="col-sm-12 form-control"required ></textarea>
							</div>
							
							<div class="col-sm-4" style="text-align: center;">
											<button type="button" class="btn btn-primary btn-lg btn3d " id="btn_save_client" name="sub_client" tabindex="25" onclick="saveclient('add_purchase_out')" style="margin-bottom:25px;    border-radius: 20px;"><span class="glyphicon glyphicon-cloud"></span> Add Purchase</button>
									        <span id="available_msg" style="color:red;font-size:20px;"></span>
											
											<!--<button type="button" class="btn btn-primary btn-lg btn3d " id="btn_save_client1" name="sub_client1" tabindex="25" onclick="saveclient('add_and_next')" style="margin-bottom:25px;    border-radius: 20px;"><span class="glyphicon glyphicon-cloud"></span> Save & Next</button>-->
									</div>
							
							</div>
							<br>
							
							
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

<div class="modal fade" id="modal-agency">
          <div class="modal-dialog" style="width:80%">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Party</h4>
              </div>
				<form id="form_agency" name="form_agency" method="post">
					<div class="modal-body">
						<div class="form-group">
							<div class="row">
									<div class="col-md-6">													
											<input type="text" class="form-control" PlaceHolder="Enter  Name." name="agency_name" id="add_agency_name" required >
										</div>
										
										<div class="col-md-6">												
											<input type="text" class="form-control"  PlaceHolder="Enter  Mobile No." name="add_agency_mobile" id="add_agency_mobile" required >
										</div>
									</div>
												<br>
												<div class="row">
												<div class="col-md-6">													
													<textarea name="add_agency_address" placeholder="Enter  Address." id="add_agency_address" class="col-sm-12 form-control"required ></textarea>
												</div>
												
												
												</div>
												<br>
												<div class="row">
												
												<div class="col-md-6">													
													<input type="text" class="form-control" placeholder="Enter  Email Id" name="add_agency_email" id="add_agency_email" required >
												</div>
												
												<div class="col-md-6">													
													<input type="text" class="form-control" placeholder="Enter  GST No." name="add_agency_gstno" id="add_agency_gstno" required >
												</div>
												
												</div>
												
												
								
											</div>
					</div>
					<div class="modal-footer">	
					
						<button type="button" class="btn btn-primary" id="btn_add_agency" name="btn_add_agency" data-dismiss="modal">Add Party</button>
					</div>
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
		
<?php include("footer.php");?>
<script>

 $('#bill_date').datepicker({
		  autoclose: true,
		  format: 'dd/mm/yyyy'
	});

  $(function () {
    $('.select2').select2();
  });

$(document).on("change","#taxable_amnt", function(){
	var taxable_amnt= $("#taxable_amnt").val();
	
	if(taxable_amnt !="" && taxable_amnt =="0")
	{
		alert("Please Enter Amount Properly");
		return false;
	}
	
	if(taxable_amnt =="")
				{
					alert("Please Enter Amount");
					return false;
				}
	
	form_data = new FormData();
	
		
		form_data.append("action_type", "change_amnt");
		form_data.append("taxable_amnt", taxable_amnt);
		
    $.ajax({
        url : "<?php $base_url; ?>save_purchase.php",
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
			$("#cgst_amnt").val(data.c_gst_amt);
			$("#sgst_amnt").val(data.s_gst_amt);
			$("#igst_amnt").val("0");
			$("#total_amnt").val(data.totals);
			
			
			
			
        }
    });
	
})


$(document).on("change","#party_name", function(){
	var party_name= $("#party_name").val();
	
	if(party_name =="")
	{
		alert("Please Select Party");
		return false;
	}
	
	
	
	form_data = new FormData();
	
		
		form_data.append("action_type", "change_party");
		form_data.append("party_name", party_name);
		
    $.ajax({
        url : "<?php $base_url; ?>save_purchase_out.php",
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
			$("#gst_no").val(data.party_gst);	
			$("#get_totals").val(data.get_totals);	
			$("#get_paid").val(data.get_paid);	
			$("#get_remain").val(data.get_remain);	
        }
    });
	
})


// client save
function saveclient(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add_purchase_out') {
				var pur_code = $('#pur_code').val(); 
				var party_name = $('#party_name').val(); 
				var gst_no = $('#gst_no').val();
				var bill_no = $('#bill_no').val();
				var bill_date = $('#bill_date').val(); 
				var payment_type = $('#payment_type').val(); 
				var taxable_amnt = "0"; 
				var cgst_amnt = "0"; 
				var sgst_amnt = "0"; 
				var igst_amnt = "0"; 
				var total_amnt = $('#total_amnt').val(); 
				var tds_amnt = $('#tds_amnt').val(); 
				var discripts = CKEDITOR.instances.editor1.getData();
				

				
				if(party_name =="")
				{
					alert("Please Enter Name");
					return false;
				}
				
				if(gst_no =="")
				{
					alert("Please Enter Gst No");
					return false;
				}
				if(bill_no =="")
				{
					alert("Please Enter Bill No");
					return false;
				}
				if(bill_date =="")
				{
					alert("Please Enter Bill Date");
					return false;
				}
				
				if(total_amnt =="")
				{
					alert("Please Enter Total Amount");
					return false;
				}
				
				if(total_amnt !="" && total_amnt =="0")
				{
					alert("Please Enter total Amount Properly");
					return false;
				}
				
	}
	else{
			
	
				billData = 'action_type='+type+'&id='+id;
    }
	
	// set blank message to submit
	
		form_data = new FormData();
	
		
		form_data.append("action_type", type);
		form_data.append("pur_code", pur_code);
		form_data.append("party_name", party_name);
		form_data.append("gst_no", gst_no);
		form_data.append("bill_no", bill_no);
		form_data.append("bill_date", bill_date);
		form_data.append("taxable_amnt", taxable_amnt);
		form_data.append("cgst_amnt", cgst_amnt);
		form_data.append("sgst_amnt", sgst_amnt);
		form_data.append("igst_amnt", igst_amnt);
		form_data.append("total_amnt", total_amnt);
		form_data.append("tds_amnt", tds_amnt);
		form_data.append("discripts", discripts);
		form_data.append("payment_type", payment_type);
		
    $.ajax({
        url : "<?php $base_url; ?>save_purchase_out.php",
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
				alert("Purchage Out Bill Is Successfully Saved");
				window.location.href="<?php $base_url; ?>purchage_list_out.php";
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
        url : "<?php $base_url; ?>save_receipt.php",
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
  
$("#btn_add_agency").click(function(){
 var agency_name = $('#add_agency_name').val(); 
 let str = $('#add_agency_name').val();
let newStr = str.replace(/'/g,'zxctxavb');
let newStr1 = newStr.replace(/&/g,'qwerfdsa');
var agency_mobile = $('#add_agency_mobile').val(); 
 var agency_address = $('#add_agency_address').val(); 
  var agency_email = $('#add_agency_email').val(); 
 var agency_gstno = $('#add_agency_gstno').val(); 
 
 var postData = '&agency_name='+newStr1+'&agency_mobile='+agency_mobile+'&agency_address='+agency_address+'&agency_email='+agency_email+'&agency_gstno='+agency_gstno;
	
	if(newStr1!=""){
	  $.ajax({
		url : "<?php $base_url; ?>purchase_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
		
			$("#party_name").html(data);
			$( '#form_agency' ).each(function(){
				this.reset();
			});
		 }

	}); 
}else{
	alert("All Fields Are Required..");
	return false;
}
});

</script>