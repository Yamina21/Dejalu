<?php 	session_start();

 $user= $_SESSION['ID'];

?>
 
<div class="form-group">
	  <form  method="POST" enctype="multipart/form-data" id="uploadimg" >
				 
 						 
 		<img class="col-md-6 col-xs-offset-3 " id="blah" name="blah" src="#" alt="" />
</br>
		<input type="file" required name="images" class="form-control col-md-12" accept="image/x-png, image/jpeg" id="images"  />
		<input type="hidden" id="userimgid" name="userimgid" value="<?php echo $user?>"  /> 

   		</form>					
  					
					<!-- End Avatar Field -->
					<!-- Start Submit Field -->
 						 
					</div>
		 
<script>
 
   function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#images").change(function(){
        readURL(this);
    });
	</script>