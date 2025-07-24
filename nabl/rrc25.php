<?php 
include "include/header.php";
include "include/sidebar.php";
include "include/conn.php";
?>
	<div class="content-wrapper">
			<section class="content-header">
				<h1>
				 Payment List
				   <small>Preview</small>
				</h1>
				<ol class="breadcrumb">
				   <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				   <li class="active">Payment List</li>
				</ol>
			</section>
		
			<section class="content">

				<div class="row">
					<div class="col-md-12">
					   <!-- general form elements -->
						<div class="box box-primary " id="view-item">
							<div class="box-header with-border">
								<h3 class="box-title">Payment List</h3>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2">
								<label>Company Name</label>
									<select name="sel_company" id="sel_company" class="form-control select2">
										<option value="">Select Company</option>
										<?php
											$sel_company="select * from company where `is_deleted`=0 ORDER BY company_id DESC";
											$result_com=mysqli_query($conn,$sel_company);
											if(mysqli_num_rows($result_com) > 0)
											{ 
											while($get_com=mysqli_fetch_array($result_com))
											{
											?>
													<option value="<?php echo $get_com["company_id"];?>"><?php echo $get_com["company_name"];?></option>
											<?php 
											}
											}
										?>
									</select>
								</div>
								
								<div class="col-md-2">
								<label>From Date</label>
									<input type="text" class="form-control" id="from_date" placeholder="from date(dd/mm/yyyy)" name="from_date" >
								</div>
								
								<div class="col-md-2">
								<label>To date</label>
									<input type="text" class="form-control" id="to_date" placeholder="To date(dd/mm/yyyy)" name="to_date" >
								</div>
								
								<div class="col-md-2">
								<label>Payment Type</label>
									<select name="sel_type" id="sel_type" class="form-control select2">
										<option value="">Select Payment Type</option>
										<option value="Cash">Cash</option>
										<option value="Cheque">Cheque</option>
										<option value="Rtgs">Rtgs</option>
										<option value="Other">Other</option>
										
									</select>
								</div>
								
								
								<div class="col-md-2">
								<label>&nbsp;</label>
									<input type="button" style="width:100%;" class="btn btn-success" name="search" id="search" value="Search" autocomplete="off" data-role="search" >
								</div>
							</div>
							<div class="box-body" id="data_display">
									
						  </div>    <!-- /.box -->
						</div>  <!-- box primary -->
					</div>
				</div>
			</section>
		</div>

<?php 
include "include/footer.php";
?>
<script>

$(function () {
    $('.select2').select2();
  });
 $( window ).on("load", function() {
			action_type="view_payment_list";
				$.ajax({					
				type: "POST",					
				url: "process_payment.php",					
				data: '&action_type='+action_type,														
						success: function(data){
								$("#data_display").html(data);
						}					
				});	
		}); 
		
		$('#from_date,#to_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
		
		
$(document).on('click','.delete_payment',function(){	
		form_data = new FormData();
	
		var aa ="";
		var payment_id= $(this).attr("data-id");
		if(confirm("Are You Sure To Delete? ") !=true)
		{
			
			return false;
		}
		
       if(aa!=""){
			alert(aa);	
			return false;
		}
		else{
			form_data.append("payment_id",payment_id);
			form_data.append("action_type",'delete_payment');

		$.ajax({					
				type: "POST",					
				url: "process_payment.php",
				data: form_data,
				processData: false,
				contentType: false,
				success: function(data,status,  xhr)
				{
								
					   alert("Payment Deleted Successfully");
						var set_ids="#tr_"+payment_id;
						$(set_ids).remove();
				}		
									
			});
		}		
	});
	
	
	$(document).on('click','#search',function(){

	form_data = new FormData();
	var aa ="";
	
	var sel_company= $("#sel_company").val();
	var from_date= $("#from_date").val();
	var to_date= $("#to_date").val();
	var sel_type= $("#sel_type").val();
	if(sel_company == "" && from_date == "" && to_date == "" && sel_type == "")
	{
		alert("Please Select Atleast One");	
		return false;
	}
	
	if(from_date != "" && to_date == "")
	{
		alert("Please Enter Date Properly");	
		return false;
	}
	if(from_date == "" && to_date != "")
	{
		alert("Please Enter Date Properly");	
		return false;
	}
	
			action_type="view_payment_list_search";
				$.ajax({					
				type: "POST",					
				url: "process_payment.php",					
				data: '&action_type='+action_type+'&sel_company='+sel_company+'&from_date='+from_date+'&to_date='+to_date+'&sel_type='+sel_type,														
						success: function(data){
								$("#data_display").html(data);
						}					
				});	
		});

</script>