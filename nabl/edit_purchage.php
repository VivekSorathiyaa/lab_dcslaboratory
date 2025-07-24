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


$ids=$_GET["ids"];
$sel_voch="select * from purchages where `purchage_id`=".$ids;
$query_vouch=mysqli_query($conn,$sel_voch);

$one_vouch=mysqli_fetch_array($query_vouch);
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
		Edit Purchase In
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
								<label>Purchase Code:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="" id="pur_code" name="pur_code" value="<?php echo $one_vouch["purchage_code"];?>" disabled>
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
								  <option value="<?php echo $row['party_id'].'|'.$row['party_name'];?>" <?php if($row['party_id']==$one_vouch["party_id"]){ echo "selected";}?>><?php echo $row['party_name'];?></option>
								  <?php
								}
								?>
								
								</select>
							</div>
							
							
							<div class="col-md-2">
								<label>GST No:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter GST No" id="gst_no" name="gst_no" value="<?php echo $one_vouch["gst_no"];?>">
							</div>
							<div class="col-md-2">
								<label>Bill No:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter Bill No" id="bill_no" name="bill_no" value="<?php echo $one_vouch["bill_no"];?>">
							</div>
							<div class="col-md-2">
								<label>Bill Date:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="" id="bill_date" name="bill_date" value="<?php echo date('d/m/Y',strtotime($one_vouch["bill_date"]));?>">
							</div>
							
							
							
							</div>
							<br>
							<div class="row">
							<div class="col-md-2">
								<label>Taxable Value:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter Taxable Amount" id="taxable_amnt" name="taxable_amnt" value="<?php echo $one_vouch["taxable_amnt"];?>">
							</div>
							
							<div class="col-md-1">
								<label>Gst Slab:</label>
								<select id="gst_slab" name="gst_slab" class="form-control select2">
								<option value="0">0</option>
								<option value="5">5</option>
								<option value="12">12</option>
								<option value="18">18</option>
								<option value="28">28</option>
								</select>
							</div>							
							
							<div class="col-md-1">
								<label>Gst Type:</label>
								<select id="csi" name="csi" class="form-control select2">
								<option value="cs">C & S</option>
								<option value="i">I</option>
								</select>
							</div>
							
							<div class="col-md-1">
								<label>CGST Amount:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter CGST Amount" id="cgst_amnt" name="cgst_amnt" value="<?php echo $one_vouch["cgst"];?>">
							</div>
							
							<div class="col-md-2">
								<label>SGST Amount:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter SGST Amount" id="sgst_amnt" name="sgst_amnt" value="<?php echo $one_vouch["sgst"];?>">
							</div>
							
							<div class="col-md-2">
								<label>IGST Amount:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter IGST Amount" id="igst_amnt" name="igst_amnt" value="<?php echo $one_vouch["igst"];?>">
							</div>
							
							<div class="col-md-2">
								<label>Total Amount:</label>
								<input type="text" tabindex="18" class="col-md-12 form-control" placeholder="Enter Total Amount" id="total_amnt" name="total_amnt" value="<?php echo $one_vouch["total_amnt"];?>">
							</div>
							
							<div class="col-md-1">
								<label>Bill Upload:</label>
								<input type="file" tabindex="18" class="col-sm-12 form-control" placeholder="" id="upload_img" name="upload_img">
							</div>
							<input type="hidden" id="txt_id" name="txt_id" value="<?php echo $one_vouch["purchage_id"];?>">
							</div>
							<br>
							<div class="row">							
							
							<div class="col-md-5">
								<label>Remark:</label>
									<textarea id="editor1" name="editor1" tabindex="5" class="col-sm-12 form-control"required >
									<?php echo $one_vouch["remark"];?>
									</textarea>
							</div>
							
							<div class="col-sm-4" style="text-align: center;">
											<button type="button" class="btn btn-primary btn-lg btn3d " id="btn_save_client" name="sub_client" tabindex="25" onclick="saveclient('edit_receipt')" style="margin-bottom:25px;    border-radius: 20px;"><span class="glyphicon glyphicon-cloud"></span> Edit Purchase</button>
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


$(document).on("change","#gst_slab", function(){
	
	var gst_slab= $("#gst_slab").val();
	var csi= $("#csi").val();
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
	
		
		form_data.append("action_type", "change_gst_slab");
		form_data.append("taxable_amnt", taxable_amnt);
		form_data.append("gst_slab", gst_slab);
		form_data.append("csi", csi);
		
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
			$("#igst_amnt").val(data.i_gst_amt);
			$("#total_amnt").val(data.totals);
			
			
			
			
        }
    });
	
})

$(document).on("change","#csi", function(){
	var gst_slab= $("#gst_slab").val();
	var csi= $("#csi").val();
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
	
		
		form_data.append("action_type", "change_gst_slab");
		form_data.append("taxable_amnt", taxable_amnt);
		form_data.append("gst_slab", gst_slab);
		form_data.append("csi", csi);
		
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
			$("#igst_amnt").val(data.i_gst_amt);
			$("#total_amnt").val(data.totals);
			
			
			
			
        }
    });
	
})


// client save
function saveclient(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'edit_receipt') {
				var pur_code = $('#pur_code').val(); 
				var party_name = $('#party_name').val(); 
				var gst_no = $('#gst_no').val();
				var bill_no = $('#bill_no').val();
				var bill_date = $('#bill_date').val(); 
				var taxable_amnt = $('#taxable_amnt').val(); 
				var cgst_amnt = $('#cgst_amnt').val(); 
				var sgst_amnt = $('#sgst_amnt').val(); 
				var igst_amnt = $('#igst_amnt').val(); 
				var total_amnt = $('#total_amnt').val(); 
				var txt_id = $('#txt_id').val(); 
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
				if(taxable_amnt =="")
				{
					alert("Please Enter Taxable Amount");
					return false;
				}
				
				if(cgst_amnt =="")
				{
					alert("Please Enter CGST Amount");
					return false;
				}
				if(sgst_amnt =="")
				{
					alert("Please Enter SGST Amount");
					return false;
				}
				if(total_amnt =="")
				{
					alert("Please Enter Total Amount");
					return false;
				}
				if(taxable_amnt !="" && taxable_amnt =="0")
				{
					alert("Please Enter taxable Amount Properly");
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
		
		var acb = $('#upload_img').val();
	
		if(acb !=""){
		form_data.append("file", document.getElementById('upload_img').files[0]);
		
		var name = document.getElementById("upload_img").files[0].name;
		
		var ext = name.split('.').pop().toLowerCase();
		  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg','pdf']) == -1) 
		  {
		   alert("Invalid  File Format");
		   return false;
		  }
		  
		  var f = document.getElementById("upload_img").files[0];
		  var fsize = f.size||f.fileSize;
		  if(fsize > 5242880)
		  {
		   alert("File Size is very big");
		   return false;
		  }
		  
	}
	
		
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
		form_data.append("discripts", discripts);
		form_data.append("txt_id", txt_id);
		
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
			if(data.status=="0")
			{
				alert(data.msg);
				return false;
			}else{
				alert("Purchage Bill Is Successfully Updated");
				window.location.href="<?php $base_url; ?>purchage_list.php";
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

</script>