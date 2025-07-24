										<div id="designdata" name="designdata">
										</div>
											<div class="col-sm-1">
												<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="grain1" name="grain1">
											</div>
											<div class="col-sm-1">
												<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="grain2" name="grain2">
											</div>
											<div class="col-sm-1">
												<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="grain3" name="grain3">
											</div>
											<div class="col-sm-1">
												<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="atter1" name="atter1">
											</div>
											<div class="col-sm-1">
												<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="atter2" name="atter2">
											</div>
											<div class="col-sm-1">
												<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="atter3" name="atter3">
											</div>
											<div class="col-sm-1">
												<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="atter4" name="atter4">
											</div>
											<div class="col-sm-1">
												<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="atter5" name="atter5">
											</div>
											<div class="row">	
												<div class="col-lg-12">
													<div class="form-group">
														<div class="col-sm-1">
															<input type="checkbox" name="chk"  id="chk" value="chk">2.<br>
														</div>
													</div>
												</div>
											</div>
													
<script>
$('#chk').change(function() {
   if($(this).is(":checked")) {
      //'checked' event code
	 $.ajax({
        type: 'POST',
        url: 'design.php',
        success:function(html){
            $('#designdata').html(html);

        }
    });  
	  
    return;
   }
   //'unchecked' event code
});
</script>