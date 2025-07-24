<?php include("header.php");?>
<?php 
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
}
?>

<?php

if(isset($_POST["btn_add_data"])){
	
	foreach($_FILES['desk_img']['name'] as $key=>$val)
	{
            // File upload path
             $fileName = rand(999,999999)."_".basename($_FILES['desk_img']['name'][$key]);
		
            $targetFilePath = "../images/desk_gallery/".$fileName;
			if(move_uploaded_file($_FILES["desk_img"]["tmp_name"][$key], $targetFilePath)){
				
				 $ins="insert into desktop_images(`desk_img`) VALUES('$fileName')";
				mysqli_query($conn,$ins);
				
				
			}
	}
	
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>view_desk_gallery.php";
	</script>
	<?php
}

?>

<style>
/* required style*/ 
.none{display: none;}

/* optional styles */
table tr th, table tr td{font-size: 1.2rem;}

.glyphicon{font-size: 20px;}
.glyphicon-plus{float: right;}
a.glyphicon{text-decoration: none;}

</style>
<div class="content-wrapper" style="margin-left: 0px !important;">
<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
			<?php include("menu.php") ?>
			<div class="row" style="margin: 0px 0px 0px 0px;">
		
					<h1 style="text-align:center;">
					Add Desktop Images
						
					</h1>
			</div>
			<div class="row mx-2">
				<a class="btn btn-primary" href="view_desk_gallery.php">View Gallery</a>
				<hr style="border: 1px solid #ddd;">
				<br>
				<form name="frm_desk" method="post" enctype="multipart/form-data">
				<div class="row" style="margin: 0px 0px 0px 0px;">
					<div class="col-md-1">
						<label for="inputEmail3" class="control-label">Desk Images:</label>
					</div>
					<div class="col-md-1">
						<input type="file" name="desk_img[]" multiple>
					</div>
					
					<div class="col-md-3" style="text-align:center;">
						<button type="submit" class="btn btn-info" name="btn_add_data" id="btn_add_data" tabindex="25" >Save</button>
					</div>
				
			
				</div>
				
				</form>
			</div>
				
	  </div>
			<!-- /.row -->
		</section>
	</div>
<?php 
include("footer.php");
?>	
