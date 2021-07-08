 
 
 
 $(document).ready(function(){
	 
	
	
	 
	 
	 $('#post').prop('disabled', true);

  function validateNextButton() {
    var buttonDisabled = $('#titlexpand').val().trim() === '' || $('#writerexpand').val().trim() === ''  || $('#description').val().trim() === '';
    $('#post').prop('disabled', buttonDisabled);
  }

  $('#titlexpand').on('keyup', validateNextButton);
  $('#writerexpand').on('keyup', validateNextButton);
  $('#description').on('keyup', validateNextButton);
  
  
  
  	 $('#postquote').prop('disabled', true);

  function validateNexttButton() {
    var buttonDisabled = $('#qwriter').val().trim() === '' || $('#qquote').val().trim() === '';
    $('#postquote').prop('disabled', buttonDisabled);
  }

  $('#qwriter').on('keyup', validateNexttButton);
  $('#qquote').on('keyup', validateNexttButton);
   
   
     $(".deletebookComment").click(function(event){
		 event.preventDefault();
 
  event.stopImmediatePropagation();
 	  var formNumber = $(this).data("commentuniquenumber");
	  var deletecomment = $(this).data("deletecommentid");
	  var deletebookcid = $(this).data("deletebookid");
 

Dialogify.confirm('Are You Sure?', {
  ok: function(){
    // confirm callback
	$.post("index.php",{"deletecomment":deletecomment,"deletebookcid":deletebookcid},
       function(data) {
 
 
  		   $("#cclearfix"+formNumber).remove(); 

 

       }
    );
  },
  cancel: function(){
    // cancel callback
  }
});
    
  });

	 $(".deletebookreply").click(function(event){
		 event.preventDefault();
 
  event.stopImmediatePropagation();
 	  var formNumber = $(this).data("replyuniquenumber");
	  var deletereply = $(this).data("deletereplyid");
	  var deletebookrid = $(this).data("deletereplybookid");
 

Dialogify.confirm('Are You Sure?', {
  ok: function(){
    // confirm callback
	$.post("index.php",{"deletereply":deletereply,"deletebookrid":deletebookrid},
       function(data) {
 
 
  		   $("#rclearfix"+formNumber).remove(); 

 

       }
    );
  },
  cancel: function(){
    // cancel callback
  }
});
    
  }); 
	 
 $(".deletequoteComment").click(function(event){
		 event.preventDefault();
 
  event.stopImmediatePropagation();
 	  var formNumber = $(this).data("qcommentuniquenumber");
	  var deletequotecomment = $(this).data("qdeletecommentid");
	  var deletequotecid = $(this).data("deletequoteid");
 

Dialogify.confirm('Are You Sure?', {
  ok: function(){
    // confirm callback
	$.post("quotes.php",{"deletequotecomment":deletequotecomment,"deletequotecid":deletequotecid},
       function(data) {
 
 
  		   $("#qcclearfix"+formNumber).remove(); 

 

       }
    );
  },
  cancel: function(){
    // cancel callback
  }
});
    
  });	 
  
   $(".deletequotereply").click(function(event){
		 event.preventDefault();
 
  event.stopImmediatePropagation();
 	  var formNumber = $(this).data("qreplyuniquenumber");
	  var deleteqreply = $(this).data("deleteqreplyid");
	  var deletequoterid = $(this).data("deletereplyquoteid");
 

Dialogify.confirm('Are You Sure?', {
  ok: function(){
    // confirm callback
	$.post("quotes.php",{"deleteqreply":deleteqreply,"deletequoterid":deletequoterid},
       function(data) {
 
 
  		   $("#qrclearfix"+formNumber).remove(); 

 

       }
    );
  },
  cancel: function(){
    // cancel callback
  }
});
    
  }); 
  
	 $(".del").click(function(event){
		 event.preventDefault();
 
  event.stopImmediatePropagation();
 	  var formNumber = $(this).data("bookdelete");
	  var deleteb =$(this).data("idbookdelete");
Dialogify.confirm('Are You Sure you want to delete this Book?', {
  ok: function(){
    // confirm callback
	  $.post("index.php",{"deletebook_id":deleteb},
       function(data) {
 
		   var parsedeletedata = JSON.parse(data);
		   $("#middle-class"+formNumber).remove(); 
           $('#myModal').remove();
           $(".modal-backdrop.in").hide();
		   $("#mid-midpp"+formNumber).remove(); 


  				 $('.deletedcontent').html(parsedeletedata.bookdeletesuccess);
setTimeout(function() { $(".deletedcontent").hide(); }, 5000);

       }
    );
  },
  cancel: function(){
    // cancel callback
  }
});
  
  });
  
  
 
  
   $(".delquote").click(function(event){
		 event.preventDefault();
 
  event.stopImmediatePropagation();
 	  var formNumber = $(this).data("quotedelete");
	  var deleteq =$(this).data("idquotedelete");
Dialogify.confirm('Are You Sure?', {
  ok: function(){
    // confirm callback
	$.post("quotes.php",{"deletequote_id":deleteq},
       function(data) {
 
 
		   var parsedeletequote= JSON.parse(data);
 		   $("#middle-class-quote"+formNumber).remove(); 

  				 $('.deletedquotecontent').html(parsedeletequote.quotedeletesuccess);
setTimeout(function() { $(".deletedquotecontent").hide(); }, 5000);

       }
    );
  },
  cancel: function(){
    // cancel callback
  }
});
    
  });
  
  $(".savebookp").click(function(event){
	  event.preventDefault();
 
  event.stopImmediatePropagation();
 	  var saveb =$(this).data("idbooksave");
 	  var usersave =$(this).data("idusersave");

    $.post("index.php",{"savebook_id":saveb, "usersave":usersave},
       function(data) {
 
		   var parsesavedata = JSON.parse(data);
 
  				 $('.savedcontent').html(parsesavedata.booksavesuccess);
setTimeout(function() { $(".savedcontent").hide(); }, 5000);

       }
    );
  });
	 
	   $(document).on('keyup',"#quotecomment_form",function(event) {
		
   if (event.which === 13) { 
         event.preventDefault();
 
  event.stopImmediatePropagation();
    
	  var formNumber = $(this).data('qnumer');


    var cquoteid= $(this).serialize();
	 
    if($('#qcomment_text'+formNumber).val().trim() === ""){
         $('#quotecomment_form').attr('disabled', 'disabled');
}else{
              $.ajax({
  url:"quotes.php",
  type: 'POST',
  dataType: 'html',
			 data:{
 				 add_quote_call: true,
				 cquoteid:cquoteid}}
			 
			 ).done(function(data){
				 		 					var parsequotedata = JSON.parse(data);
 
 if (data === "error") {
					alert('There was an error adding comment. Please try again');
				}else { 
					 $("#qdeletespan"+formNumber).remove(); 

					 $("#qcomments-wrapper"+formNumber).prepend(parsequotedata.qcomment);
					 $('#qcomments_count'+formNumber).text(parsequotedata.qcomments_co); 
                     $('#qcomment_text'+formNumber).val('');		
                     $('#qcomment_text'+formNumber).trigger('reset'); 			
                            
				}
   });}} });
 	
	  
				
	
	   
				$(document).on('keyup',"#reply_form",function(event) {
		
   if (event.which === 13) { 
         event.preventDefault();
 
  event.stopImmediatePropagation();
    
	  var formNumber = $(this).data('numereply');


    var replyid= $(this).serialize();
	if($('#reply_text'+formNumber).val().trim() === ""){
         $('#reply_form').attr('disabled', 'disabled');
}else{
              $.ajax({
  url:"index.php",
  type: 'POST',
  dataType: 'html',
			 data:{
 				 add_reply_call: true,
				 replyid:replyid}}
			 
			 ).done(function(data){
				 		 					var parsereplydata = JSON.parse(data);
 
 if (data === "error") {
					alert('There was an error adding comment. Please try again');
				}else { 
					 $("#replies-wrapper"+formNumber).prepend(parsereplydata.replycomment);
                      $('#reply_text'+formNumber).val('');		
                     $('#reply_text'+formNumber).trigger('reset'); 					
                            
				}
   });} } });
 	
	   $(document).on('keyup',"#comment_form",function(event) {
		
   if (event.which === 13) { 
         event.preventDefault();
 
  event.stopImmediatePropagation();
    
	  var formNumber = $(this).data('numer');


    var Bookid= $(this).serialize();
	
	 
    if($('#comment_text'+formNumber).val().trim() === ""){
         $('#comment_form').attr('disabled', 'disabled');
}else{
              $.ajax({
  url:"index.php",
  type: 'POST',
  dataType: 'html',
			 data:{
 				 add_books_call: true,
				 Bookid:Bookid}}
			 
			 ).done(function(data){
 
				 		 					var parsedata = JSON.parse(data);
 if (data === "error") {
					alert('There was an error adding comment. Please try again');
				}else { 
				       $("#deletespan"+formNumber).remove(); 

					 $("#comments-wrapper"+formNumber).prepend(parsedata.comment);
					 $('#comments_count'+formNumber).text(parsedata.comments_count); 
                     $('#comment_text'+formNumber).val('');
	  
                     $('#comment_text'+formNumber).trigger('reset'); 					
                            
				}
});}}  });
				
	
 
  	       $(document).on('click', '#btn_more', function(event){  
		   
		   event.preventDefault();
		     event.stopImmediatePropagation();

 
		    var formNumber = $(this).data('numers');
		var repnum = $(this).data('rep');

		   var commentrating = $(this).data('com');

			var Bookidd= $(this).data('nuo');

            var last_video_id = $(this).data("vid");
 
            $.ajax({  
                url:"load-comments.php",  
                method:"POST",  
                data:{last_video_id:last_video_id,
				formNumber:formNumber,
				Bookidd:Bookidd,
				commentrating:commentrating,
				repnum:repnum
				},  
                dataType:"text",  
                success:function(data)  
				
                {  
				
				
                     if(data != '')  
						 
					 
					 
                     {    
					 
						  $("#remove_row"+formNumber).remove(); 
 
					 $("#comments-wrapper"+formNumber).append(data);



                     }  
                     else  
                     {  
                          $('#btn_more').html("No Data");  
                     } 	 
	 	 
		    
               
		   }});  });
		   
		   
		    $(document).on('click', '#btn_moreqreplies', function(event){  
		   
		   event.preventDefault();
		     event.stopImmediatePropagation();

 
		    var formrqrNumber = $(this).data('qnumerr');
 
			var quotecommentidd= $(this).data('qcrid');

            var last_quotereply = $(this).data("qreplycid");
 
            $.ajax({  
                url:"load-quotesreplies.php",  
                method:"POST",  
                data:{
				last_quotereply:last_quotereply,
				formrqrNumber:formrqrNumber,
				quotecommentidd:quotecommentidd

 				},  
                dataType:"text",  
                success:function(data)  
				
                {  
				
				
                     if(data != '')  
						 
					 
					 
                     {    
					 
						  $("#remove_rowqr"+formrqrNumber).remove(); 
 
					 $("#qreplies-wrapper"+formrqrNumber).append(data);



                     }  
                     else  
                     {  
                          $('#btn_morereplies').html("No Data");  
                     } 	 
	 	 
		    
               
		   }});  });
	  
	  $(document).on('keyup',"#quotereply_form",function(event) {
		
   if (event.which === 13) { 
         event.preventDefault();
 
  event.stopImmediatePropagation();
    
	  var formNumber = $(this).data('numeqreply');


    var quotereplyid= $(this).serialize();
	if($('#quotereply_text'+formNumber).val().trim() === ""){
         $('#quotereply_form').attr('disabled', 'disabled');
}else{
              $.ajax({
  url:"quotes.php",
  type: 'POST',
  dataType: 'html',
			 data:{
 				 add_quotereply_call: true,
				 quotereplyid:quotereplyid}}
			 
			 ).done(function(data){
				 		 					var parseqreplydata = JSON.parse(data);
 
 if (data === "error") {
					alert('There was an error adding comment. Please try again');
				}else { 
					 $("#qreplies-wrapper"+formNumber).prepend(parseqreplydata.replycomment);
                      $('#quotereply_text'+formNumber).val('');		
                     $('#quotereply_text'+formNumber).trigger('reset'); 				
                            
				}
   });}}  });
 	
	
	
	  
	  $(document).on('click', '#btn_morereplies', function(event){  
		   
		   event.preventDefault();
		     event.stopImmediatePropagation();

 
		    var formrNumber = $(this).data('numerr');
 
			var commentidd= $(this).data('crid');

            var last_reply = $(this).data("replycid");
 
            $.ajax({  
                url:"load-replies.php",  
                method:"POST",  
                data:{last_reply:last_reply,
				formrNumber:formrNumber,
				commentidd:commentidd

 				},  
                dataType:"text",  
                success:function(data)  
				
                {  
				
				
                     if(data != '')  
						 
					 
					 
                     {    
					 
						  $("#remove_rowr"+formrNumber).remove(); 
 
					 $("#replies-wrapper"+formrNumber).append(data);



                     }  
                     else  
                     {  
                          $('#btn_morereplies').html("No Data");  
                     } 	 
	 	 
		    
               
		   }});  });
	   $(document).on('click', '#btn_morequotes', function(event){  
		   
		   event.preventDefault();
		     event.stopImmediatePropagation();

 
		    var quoteformNumber = $(this).data('qnumers');
			var qrepnum = $(this).data('qrep');

		   var qcommentrating = $(this).data('qcom');
			var quoteidd= $(this).data('qnuo');

            var last_quote_id = $(this).data("qqid");
 
            $.ajax({  
                url:"load-quotescomments.php",  
                method:"POST",  
                data:{last_quote_id:last_quote_id,
				quoteformNumber:quoteformNumber,
				quoteidd:quoteidd,
				qrepnum:qrepnum,
				qcommentrating:qcommentrating
				},  
                dataType:"text",  
                success:function(data)  
				
                {  
				
				
                     if(data != '')  
						 
					 
					 
                     {    
					 
						  $("#qremove_row"+quoteformNumber).remove(); 
 
					 $("#qcomments-wrapper"+quoteformNumber).append(data);



                     }  
                     else  
                     {  
                          $('#btn_more').html("No Data");  
                     } 	 
	 	 
		    
               
		   }});  });
	  
	  
	  
	  $(document).on('submit','#postBook_form',function(event) {
		
  
         event.preventDefault();
 
  event.stopImmediatePropagation();
    
  
              $.ajax({
  url:"index.php",
  type: 'POST',
  processData: false,
   contentType: false,
            cache: false,
			  dataType: 'html',

			 data:new FormData(this),
			 beforeSend : function(){
   $('#post').attr("disabled","disabled");
			  $('#postBook_form').css("opacity",".5");	 }}).done(function(data){
			  
			 
                 	var parsebookdata = JSON.parse(data);
 $(".postBook_middle-class").prepend(parsebookdata.Bookposted);
 				 $('.postedcontent').html(parsebookdata.postedbsuccess);
setTimeout(function() { $(".postedcontent").hide(); }, 5000);
                      $('#mid-mid-BookTitle').val('');
                      $('#mid-mid-BookDescription').val('');	
                      $('#mid-mid-BookCover').val('');	
                      	
					  
                $('#postBook_form').trigger('reset'); 
 
                $('#postBook_form').css("opacity","");
                $("#post").removeAttr("disabled");
				 	
              
			  
			  }
			 
			 ); 
			 });
			 


 $(document).on('submit','#reportBook_form',function(event) {
		
  
         event.preventDefault();
 
  event.stopImmediatePropagation();
    
  
              $.ajax({
  url:"report.php",
  type: 'POST',
  processData: false,
   contentType: false,
            cache: false,
			  dataType: 'html',

			 data:new FormData(this),
			 beforeSend : function(){
   $('#report_button').attr("disabled","disabled");
			  $('#reportBook_form').css("opacity",".5");	 }}).done(function(data){
			  
			 
                 	var parsereportdata = JSON.parse(data);
					if (failed_report= "no"){
						  $('#reportBook_form').css("opacity","");
						  

  window.location = "report.php?successmessage="+parsereportdata.success_report;
				 	}else{
					 window.location = "report.php?failedmessage="+parsereportdata.failed_report;

						
					}
              
			  
			  }
			 
			 ); 
			 });
			 
			 
 $(document).on('submit','#postquote_form',function(event) {
		
  
         event.preventDefault();
 
  event.stopImmediatePropagation();
    
 

 
              $.ajax({
  url:"quotes.php",
  type: 'POST',
  processData: false,
   contentType: false,
            cache: false,
			  dataType: 'html',

			 data:new FormData(this),
			 beforeSend : function(){
   $('#postquote').attr("disabled","disabled");
			  $('#postquote_form').css("opacity",".5");	 }}).done(function(data){
			  
			 
                 	var parsequotedata = JSON.parse(data);
 $(".postquote_middle-class").prepend(parsequotedata.quoteposted);
                      
					   $('#mid-mid-quoteTitle').val('');
                      $('#mid-mid-quote').val('');	
                  
                      	
                $('#postquote_form').trigger('reset'); 
 
                $('#postquote_form').css("opacity","");
                $("#postquote").removeAttr("disabled");
				
				 	
              
			  
			  }
			 
			 ); 
			 });
			 
			 
			 
			 
			   $(document).on('submit','#login_form',function(event) {
		
  
         event.preventDefault();
 
  event.stopImmediatePropagation();
    
  
 $.ajax({
  url:"login.php",
  type: 'POST',
  processData: false,
   contentType: false,
            cache: false,
			  dataType: 'html',

			 data:new FormData(this),
			 beforeSend : function(){
   $('#login').attr("disabled","disabled");
			  $('#login_form').css("opacity",".5");	 }}).done(function(data){
		  	var parselogindata = JSON.parse(data);

			   $('#login_form').trigger('reset'); 
 
                $('#login_form').css("opacity","");
                $("#login").removeAttr("disabled");
					
					if(parselogindata.success_login=="success"){
						  window.location.href= "/index.php";

					}					
			if(parselogindata.success_login =="Verify your Email First."){					
						
						alert(parselogindata.success_login+ parselogindata.failed_login);
	           window.location ='verify_email.php?code='+parselogindata.user_activlog_code;

					}
					
								if(parselogindata.failed_login =="Email or Password wrong"){					

						  $('.form_response').html('<div class="alert alert-danger">'+parselogindata.failed_login+'</div>');

					}
				 	
              
			  
			  }
			 
			 ); 
			 });
			 
		 $(document).on('submit','#forgetpass_form',function(event) {
		
  
         event.preventDefault();
 
  event.stopImmediatePropagation();
    
  
 $.ajax({
  url:"login.php",
  type: 'POST',
  processData: false,
   contentType: false,
            cache: false,
			  dataType: 'html',

			 data:new FormData(this),
			 beforeSend : function(){
   $('#forgetpass_form').attr("disabled","disabled");
			  $('#forgetpass_form').css("opacity",".5");	 }}).done(function(data){
		  	var parseforgetdata = JSON.parse(data);

			   $('#forgetpass_form').trigger('reset'); 
 
                $('#forgetpass_form').css("opacity","");
                $("#forgetpassword").removeAttr("disabled");
					
					if(parseforgetdata.success_forget=="yes"){
						  window.location = "Changepassword.php?changecode="+parseforgetdata.user_activflog_code+"&step2";

					}else{					

						  $('.form_response').html(parseforgetdata.failed_forget);

					}
				 	
              
			  
			  }
			 
			 ); 
			 });	 
			 
			$(document).on('submit','#register_form',function(event) {
		
  
         event.preventDefault();
 
  event.stopImmediatePropagation();
    
  
 $.ajax({
  url:"register.php",
  type: 'POST',
  processData: false,
   contentType: false,
            cache: false,
			  dataType: 'html',

			 data:new FormData(this),
			 beforeSend : function(){
   $('#register').attr("disabled","disabled");
			  $('#register_form').css("opacity",".5");	 }}).done(function(data){
		  	var parseregisterdata = JSON.parse(data);
   if(parseregisterdata.success_register == 'error' && parseregisterdata.failed_register == 'error'){
	   if(parseregisterdata.error_user_name != ''){
	   $(".error_name").html("Please Enter Valid Username");}
if(parseregisterdata.error_user_email != ''){
	   $(".error_email").html("Please Enter Valid email");}
	   
	   if(parseregisterdata.error_user_country != ''){
	   $(".error_country").html("Please Enter Valid Country");}
	   
	    if(parseregisterdata.error_user_password != ''){
	if(parseregisterdata.error_user_password == 'Enter Password'){

	$(".error_password").html("Please Enter Valid Password");}else{
		$(".error_password").html("Password should be at least 6 digits long");
		
	}}
  
                $('#register_form').css("opacity","");
                $("#register").removeAttr("disabled");
   }else{
			   $('#register_form').trigger('reset'); 
 
                $('#register_form').css("opacity","");
                $("#register").removeAttr("disabled");
					
					if(parseregisterdata.success_register=="check your email to verify your account"){
						            window.location ='verify_email.php?code='+parseregisterdata.user_activation_code;
;          

					}else{
						  $('.form_response').html(parseregisterdata.failed_register);

					}
				 	
              
			  
			  }}
			 
			 ); 
			 }); 
			 
			 
			 
	$("#sendOtp").on("click", function(e){ 
      e.preventDefault();    
  
  e.stopImmediatePropagation();
      var email = $("#email").val();
 
 
      $.ajax({
        url  : "send_otp.php",
        type : "POST",
        cache:false,
	   beforeSend: function() { 
       $("#emailForm").prop('disabled', true);
	     $('#emailForm').css("opacity",".5");
    },
        data : {email:email

		
		},
        success:function(result){
			
			$('#emailForm').trigger('reset'); 
 
                $('#emailForm').css("opacity","");
                $("#emailForm").removeAttr("disabled");
          if (result == "yes") {
 
            $("#otpForm,.alert-success").show();

            $("#emailForm").hide();
           }
          if (result =="no") {
            $(".error-message").html("Please enter valid email");
          }else{
			  
			              $(".error-message").html("Invalid URL!!");

			  
		  }		  
        }
      });  
    });   
	
	 
    // Verify OTP email jquery
    $("#verifyOtp").on("click",function(e){
e.preventDefault();    
  
  e.stopImmediatePropagation();
  var otp = $("#otp").val();
    var codeverification = $("#codever").val();

 
      $.ajax({
        url  : "verify_otp.php",
        type : "POST",
	   	beforeSend: function() { 
       $("#otpForm").prop('disabled', true);
	     $('#otpForm').css("opacity",".5");
    },
        cache:false,
        data : {otp:otp, codeverification:codeverification	},
	
        success:function(response){
			
			$('#otpForm').trigger('reset'); 
 
                $('#otpForm').css("opacity","");
                $("#otpForm").removeAttr("disabled");
          if (response == "yes") {
            window.location.href='login.php';
			 



          }
          if (response =="no") {
            $(".otp-message").html("Please enter valid Code");
          }        
        }
      });
    });		 
			 
			 
	$("#check_otp").on("click",function(e){
e.preventDefault();    
  
  e.stopImmediatePropagation();
  var u_otp = $("#user_otp").val();
    var us_code = $("#user_code").val();

 
      $.ajax({
        url  : "checkcode.php",
        type : "POST",
        cache:false,
		beforeSend : function(){
   $('#check_otp_form').attr("disabled","disabled");
			  $('#check_otp_form').css("opacity",".5");	 },
        data : {u_otp:u_otp, us_code:us_code},
		
        success:function(response){
			
			
  
                $('#check_otp_form').css("opacity","");
                $("#check_otp_form").removeAttr("disabled");
				
			if(u_otp ==''){
	       $(".otp-message").html("Please check your email for valid code");

			}
          if (response == "yes") {
            window.location = "Changepassword.php?changecode="+us_code+"&step3";
	   }
          if (response =="no") {
            $(".otp-message").html("Please enter valid Code");
          }        
        }
      });
    });		 
			 		 
			 $(document).on('submit','#newoldpassword',function(e) {
 e.preventDefault();    
  
  e.stopImmediatePropagation();
 


 
      $.ajax({
        url  : "changed.php",
        type : "POST",
        processData: false,
        contentType: false,
        cache: false,
		dataType: 'html',
		beforeSend : function(){
   $('#newoldpassword').attr("disabled","disabled");
			  $('#newoldpassword').css("opacity",".5");	 },
        data:new FormData(this)}).done(function(data){
			
			
  
                $('#newoldpassword').css("opacity","");
                $("#newoldpassword").removeAttr("disabled");
			if(data== "length prblm"){
							$(".otp-message").html("Password should be of size 6 digits at least. ");

				
			}
			if(data == "empty"){
			$(".otp-message").html("Enter Valid passwords");

			}
			else{
            if (data == "yes") {
            window.location = "login.php?reset_password=success";
	   }
          if (data =="No") {
            $(".otp-message").html("Please enter matching passwords");
			}  }      
    
		
	  });
      });
   	 		 
			 
			 
			 
$(".like").click(function(event){
	
	event.preventDefault();
 
  event.stopImmediatePropagation();
 
 let button = $(this);
 let post_id = $(button).data('postid');
 var formid= $(this).data('likeun');
  var usernotifid= $(this).data('userlikenotifid');

 	
	if ($(button).hasClass('notlikedyet'+formid)) {
  	action = 'like';
  } else if($(button).hasClass('alreadyliked'+formid)){
  	action = 'dislike';
  }
  
  
$.post("index.php",
 {
  		'action': action,
  		'post_id': post_id,
    'usernotifid':usernotifid
   	},
function(data, status){
	
   		res = JSON.parse(data);
 		if (action == "like") {
		    $(button).removeClass('notlikedyet'+formid);
  			$(button).addClass('alreadyliked'+formid);
		 

			}else if(action == "dislike") {
  			$(button).removeClass('alreadyliked'+formid);
  			$(button).addClass('notlikedyet'+formid);
     
  
 
  		} 
    
  
 	   
    $("#likeid"+formid).text(res.likes);
    $("#dislikeid"+formid).text(res.dislikes);
 $("button.alreadydisliked"+formid).removeClass('alreadydisliked'+formid).addClass('notdislikedyet'+formid);
 $("button.notdislikedyet"+formid).css("color", "rgba(0, 0, 0, 0.4)");
 $("button.alreadydisliked"+formid).css("color", "rgb(6, 95, 212)");
 $("button.alreadyliked"+formid).css("color", "#ffc60a");
 $("button.notlikedyet"+formid).css("color", "rgba(0, 0, 0, 0.4)");

  

  });		

});
 
 
$(".unlike").click(function(event){
	event.preventDefault();
 
  event.stopImmediatePropagation();
      let button = $(this)
    let post_id = $(button).data('postid')
	 var formid= $(this).data('likeun');
  var usernotifid= $(this).data('userlikenotifid');

	if ($(button).hasClass('notdislikedyet'+formid)) {
  	action = 'unlike';
  } else if($(button).hasClass('alreadydisliked'+formid)){
  	action = 'disliked';
  }
  
$.post("index.php",
 
{
        'action': action,
        'post_id': post_id,
		'usernotifid':usernotifid
  },

function(data, status){
 
  			  
   		res = JSON.parse(data);

      	  		if (action == "unlike") {
		    $(button).removeClass('notdislikedyet'+formid);
  			$(button).addClass('alreadydisliked'+formid);
  

			}else if(action == "disliked") {
  			$(button).removeClass('alreadydisliked'+formid);
  			$(button).addClass('notdislikedyet'+formid);
    		}
        
	 
 
      
    $("#likeid"+formid).text(res.likes);
    $("#dislikeid"+formid).text(res.dislikes);
 $("button.alreadyliked"+formid).removeClass('alreadyliked'+formid).addClass('notlikedyet'+formid);
  $("button.notdislikedyet"+formid).css("color", "rgba(0, 0, 0, 0.4)");
  $("button.alreadyliked"+formid).css("color", "#ffc60a");
 $("button.notlikedyet"+formid).css("color", "rgba(0, 0, 0, 0.4)");
  $("button.alreadydisliked"+formid).css("color", "rgb(6, 95, 212)");

});
});



$(document).on('click', '.viewprofilepic', function(event){
	event.preventDefault();
 
  event.stopImmediatePropagation();
	var id = $(this).attr('id');
 var options = {
    ajaxPrefix: '',
    ajaxData: {'id':id},
    ajaxComplete: function(){
       this.buttons([ {
		  type: Dialogify.BUTTON_PRIMARY,
          text: 'Close',
          click: function(e){
               this.close();
          }
	   }
        ]);
		
    }
};

new Dialogify('fetch_single_data.php', options)
    .title('Details')
    .show();
    
 });

 

$(document).on('click', '.updateprofilepic', function(event){
	event.preventDefault();
 
  event.stopImmediatePropagation();
  	var idup = $(this).attr('id');

   var options = {
    ajaxPrefix: '',
    ajaxData: {'idup':idup},
    ajaxComplete: function(){
       this.buttons([ {
		  type: Dialogify.BUTTON_PRIMARY,
          text: 'Cancel',
          click: function(e){
               this.close();
          }
	   },
	  {
       text:'Save',
       type:Dialogify.BUTTON_PRIMARY,
       click:function(e)
       {
        var image_data = $('#images').prop("files")[0];
 
		        var form_data = new FormData(document.getElementById('uploadimg'));
		   if(document.getElementById("images").files.length == 0 ){
						 
						 Dialogify.alert('You cant Update an empty picture', {
                            close: function(){
                                 console.log('You cant Update an empty picture');
                                            }
                                              });
					 }else{

 		 $.ajax({
         method:"POST",
         url:'profile.php',
         data:form_data,
		 dataType: 'json',
         contentType:false,
         cache:false,
         processData:false,
         success:function(data)
{
          if(data.error != '')
          {
           $('#form_response').html('<div class="alert alert-danger">'+data.error+'</div>');
          }
          else
          {
 		    
           }
          location.reload();
         }
        });	
					

	}
		this.close();

	}}
        ]);
		
    }
};

new Dialogify('edit_data_form.php', options)
    .title('Upload profile picture')
    .show();
 });









 $(".Follow").click(function(event){
	 event.preventDefault();
 
  event.stopImmediatePropagation();
	
 let button = $(this);
 let user_id = $(button).data('userid');
let act ='';
	 if ($(button).hasClass('Unfollow')) {
  	act = 'followed';
	  
$.post("profile.php",
 {
  		'act': act,
  		'user_id': user_id
 
   	},
function(data, status){
    		reso = JSON.parse(data);

  		if (act == "followed") {
		    $(button).removeClass('Unfollow');
  			$(button).addClass('Followw');
		 $(button).text ("Followed");
	

			}else if(act == "unfollowed") {
				
  			$(button).removeClass('Followw');
  			$(button).addClass('Unfollow');
			
			$(button).text("Follow");

			 
             }

  
      $("span.folllowers").text(reso.followers);
     
  
  	 
     
 });
  } else if($(button).hasClass('Followw')){
Dialogify.confirm('Are You Sure you want to unfollow?', {
  ok: function(){
    	act = 'unfollowed';
$.post("profile.php",
 {
  		'act': act,
  		'user_id': user_id
 
   	},
function(data, status){
    		reso = JSON.parse(data);

  		if (act == "followed") {
		    $(button).removeClass('Unfollow');
  			$(button).addClass('Followw');
		 $(button).text ("Followed");
	

			}else if(act == "unfollowed") {
				
  			$(button).removeClass('Followw');
  			$(button).addClass('Unfollow');
			
			$(button).text("Follow");

			 
             }

  
      $("span.folllowers").text(reso.followers);
     
  
  	 
     
 });
  },
  cancel: function(){
	    	 
     this.close;
  
  	 
     
}});
  }
});
 
 

$(".qlike").click(function(event){
	event.preventDefault();
 
  event.stopImmediatePropagation();
	
 let button = $(this);
 let quote_id = $(button).data('quoteid');
	 var formid= $(button).data('qlikeun');
	   var userquotenotifid= $(this).data('userquotenotifid');


	if ($(button).hasClass('notlikedyetq'+formid)) {
  	qact = 'likeq';
  } else if($(button).hasClass('alreadylikedq'+formid)){
  	qact= 'dislikeq';
  }
  
  
$.post("quotes.php",
 {
  		'qact': qact,
  		'quote_id': quote_id,
 'userquotenotifid':userquotenotifid
   	},
function(data, status){
	
   		resi = JSON.parse(data);
 		if (qact == "likeq") {
		    $(button).removeClass('notlikedyetq'+formid);
  			$(button).addClass('alreadylikedq'+formid);
		 

			}else if(qact == "dislikeq") {
  			$(button).removeClass('alreadylikedq'+formid);
  			$(button).addClass('notlikedyetq'+formid);
     
  
 
  		} 
    
  
 	     
    $("#likeidq"+formid).text(resi.likesq);
    $("#dislikeidq"+formid).text(resi.dislikesq);
$("button.alreadydislikedq"+formid).removeClass('alreadydislikedq'+formid).addClass('notdislikedyetq'+formid);
$("button.notdislikedyetq"+formid).css("color", "rgba(0, 0, 0, 0.4)");
  $("button.alreadylikedq"+formid).css("color", "#ffc60a");
 $("button.notlikedyetq"+formid).css("color", "rgba(0, 0, 0, 0.4)");
  $("button.alreadydislikedq"+formid).css("color", "rgb(6, 95, 212)");



  

  });		

});
 
 
$(".qunlike").click(function(event){
	event.preventDefault();
 
  event.stopImmediatePropagation();
      let button = $(this)
    let quote_id = $(button).data('quoteid')
   var formid= $(this).data('qlikeun');
   	   var userquotenotifid= $(this).data('userquotenotifid');


	if ($(button).hasClass('notdislikedyetq'+formid)) {
  	qact = 'unlikeq';
  } else if($(button).hasClass('alreadydislikedq'+formid)){
  	qact = 'dislikedq';
  }
  
$.post("quotes.php",
 
{
        'qact': qact,
        'quote_id': quote_id,
		 'userquotenotifid':userquotenotifid

  },

function(data, status){
 
  			  
   		resi = JSON.parse(data);

      	  		if (qact == "unlikeq") {
		    $(button).removeClass('notdislikedyetq'+formid);
  			$(button).addClass('alreadydislikedq'+formid);
  

			}else if(qact  == "dislikedq") {
  			$(button).removeClass('alreadydislikedq'+formid);
  			$(button).addClass('notdislikedyetq'+formid);
    		}
        
	 
       $("#likeidq"+formid).text(resi.likesq);
    $("#dislikeidq"+formid).text(resi.dislikesq);
 $("button.alreadylikedq"+formid).removeClass('alreadylikedq'+formid).addClass('notlikedyetq'+formid);
 $("button.notdislikedyetq"+formid).css("color", "rgba(0, 0, 0, 0.4)");
  $("button.alreadylikedq"+formid).css("color", "#ffc60a");
 $("button.notlikedyetq"+formid).css("color", "rgba(0, 0, 0, 0.4)");
  $("button.alreadydislikedq"+formid).css("color", "rgb(6, 95, 212)");
});
});


$(".likecomment").click(function(event){
	   event.preventDefault();
 
  event.stopImmediatePropagation();
	
 let button = $(this);
 let comment_id = $(button).data('commentid');
 var formid= $(this).data('likeunc');
	
	if ($(button).hasClass('notlikedyetc'+formid)) {
  	actioncomment = 'likec';
  } else if($(button).hasClass('alreadylikedc'+formid)){
  	actioncomment = 'dislikec';
  }
  
  
$.post("index.php",
 {
  		'actioncomment': actioncomment,
  		'comment_id': comment_id
 
   	},
function(data, status){
	
   		resc = JSON.parse(data);
 		if (actioncomment == "likec") {
		    $(button).removeClass('notlikedyetc'+formid);
  			$(button).addClass('alreadylikedc'+formid);
		 

			}else if(actioncomment == "dislikec") {
  			$(button).removeClass('alreadylikedc'+formid);
  			$(button).addClass('notlikedyetc'+formid);
     
  
 
  		} 
    
  
 
    $("#likecommentid"+formid).text(resc.likesc);
  $("button.alreadylikedc"+formid).css("color", "#ffc60a");
 $("button.notlikedyetc"+formid).css("color", "rgba(0, 0, 0, 0.4)");

  

  });		

});
$(".edit_quote").click(function(event){
	   event.preventDefault();
 
  event.stopImmediatePropagation();
            var qid = $(this).data('editquoteid');
            var wname = $.trim(document.getElementById("mid-mid-quoteTitle"+qid).innerHTML);
			var qname = $.trim(document.getElementById("mid-mid-quotehidden"+qid).innerHTML);

            
			localStorage.setItem('wname',wname);
			localStorage.setItem('qname',qname);

		 
			
		var options = {
		    ajaxPrefix: '',
			 
		};

    new Dialogify('editquote-form.php', options)
            .title('Edit Quote')
            .buttons([
                {
                    text: 'Cancel',
                    click: function (e) {
                        console.log('cancel click');
                        this.close();
                    }
                },
                {
                    text: 'Okay',
                    type: Dialogify.BUTTON_PRIMARY,
                    click: function (e) {
					  					   
                        var wname = $('#qwritername').val();
						var qname = $('#descquote').val();
						 if(wname ==="" || qname===""){
						 
						 Dialogify.alert('You cant publish an empty Quote', {
                            close: function(){
                                 console.log('You cant publish empty Quote');
                                            }
                                              });
					 }else{
                       
                        $.ajax
                                ({
                                    type: 'post',
                                    url: 'quotes.php',
									dataType: 'html',
                                    data: {
										editquote_row: 'editquote_row',
                                        qid: qid,
                                        wname: wname,
										qname:qname
                                         
                                    },
                                    success: function (response) {
                                         
											                 	var resqedit = JSON.parse(response);

											    $("#mid-mid-quoteTitle"+qid).text(resqedit.qtitleupdate);
 											    $("#mid-mid-quote"+qid).text(resqedit.qdescupdate);
                                     $("#mid-mid-quoteTitle"+qid).val('');
                      $("#mid-mid-quote"+qid).val('');
                                             

                                             
                                    
									}});
					 }
                        this.close();

                    }
					}
            ]).show();
			
    $('#qwritername').val(wname);
	$('#descquote').val(qname);

     
});
$(".edit_book").click(function(event){
	   event.preventDefault();
 
  event.stopImmediatePropagation();
            var id = $(this).data('editbookid');
            var name = $.trim(document.getElementById("mid-mid-BookTitlehidden"+id).innerHTML);
			var descname = $.trim(document.getElementById("mid-mid-BookDescriptionhidden"+id).innerHTML);
            
			localStorage.setItem('name',name);
			localStorage.setItem('descname',descname);

		 
			
		var options = {
		    ajaxPrefix: '',
			 
		};

    new Dialogify('edit-form.php', options)
            .title('Edit Book')
		 
            .buttons([
                {
                    text: 'Cancel',
                    click: function (e) {
                        console.log('cancel click');
                        this.close();
                    }
                },
                {
                    text: 'Save',
                     type: Dialogify.BUTTON_PRIMARY,
                    click: function (e) {
                 	var name = $('#username').val();
						var descname = $('#descbook').val();
					 if(name ==="" || descname===""){
						 
						 Dialogify.alert('You cant publish an empty book details', {
                            close: function(){
                                 console.log('You cant publish empty fields');
                                            }
                                              });
					 }else{

                        $.ajax
                                ({
                                    type: 'post',
                                    url: 'index.php',
									dataType: 'html',
                                    data: {
										edit_row: 'edit_row',
                                        id: id,
                                        name: name,
										descname:descname
                                         
                                    },
                                    success: function (response) {
                                         
											                 	var resedit = JSON.parse(response);
                   
											    $("#mid-mid-BookTitle"+id).text(resedit.titleupdate);
 											    $("#mid-mid-BookDescription"+id).text(resedit.descupdate);
                                     $("#mid-mid-BookTitle"+id).val('');
                      $("#mid-mid-BookDescription"+id).val('');
                                             

                                             
                                    
									}});

                    }
					                        this.close();

				}}
            ]).show();
			
    $('#username').val(name);
	$('#descbook').val(descname);

     
});
 
$(".likequotecomment").click(function(event){
	  event.preventDefault();
 
  event.stopImmediatePropagation();
	
	
 let button = $(this);
 let quotecomment_id = $(button).data('qcommentid');
 var formid= $(this).data('likequoteunc');
	
	if ($(button).hasClass('notlikedyetquotec'+formid)) {
  	actionquotecomment = 'likequotec';
  } else if($(button).hasClass('alreadylikedquotec'+formid)){
  	actionquotecomment = 'dislikequotec';
  }
  
  
$.post("quotes.php",
 {
  		'actionquotecomment': actionquotecomment,
  		'quotecomment_id': quotecomment_id
 
   	},
function(data, status){
	
   		resqcoments = JSON.parse(data);
 		if (actionquotecomment == "likequotec") {
		    $(button).removeClass('notlikedyetquotec'+formid);
  			$(button).addClass('alreadylikedquotec'+formid);
		 

			}else if(actionquotecomment == "dislikequotec") {
  			$(button).removeClass('alreadylikedquotec'+formid);
  			$(button).addClass('notlikedyetquotec'+formid);
     
  
 
  		} 
    
  
 
    $("#likequotecommentid"+formid).text(resqcoments.likesquotec);
  $("button.alreadylikedquotec"+formid).css("color", "#ffc60a");
 $("button.notlikedyetquotec"+formid).css("color", "rgba(0, 0, 0, 0.4)");

  

  });		

});	 



 $('.openModal').click(function(event){
	
      var id = $(this).attr('data-idb');
	  var usermodalid = $(this).attr('data-idu');
	  var usermodal_id = $(this).attr('data-me');

      $.ajax({
 									type: 'POST',
								    url: 'modal_ajax.php',

                                    data:{
										'id': id,
                                        'usermodal_id': usermodal_id,
										'usermodalid': usermodalid

										
                                         
                                    },
		   cache:false,
		   success:function(result){
          $(".modal-content").html(result);
		 return false; }});
  });




  
  
 });


 
function fill(Value) {
   //Assigning value to "search" div in "search.php" file.
   $('#search').val(Value);
   //Hiding "display" div in "search.php" file.
   $('#display').hide();
}
$(document).ready(function() {
   //On pressing a key on "Search box" in "search.php" file. This function will be called.
   $("#search").keyup(function() {
       //Assigning search box value to javascript variable named as "name".
       var name = $('#search').val();
       //Validating, if "name" is empty.
       if (name == "") {
           //Assigning empty value to "display" div in "search.php" file.
           $("#display").html("");
       }
       //If name is not empty.
       else {
           //AJAX is called.
           $.ajax({
               //AJAX type is "Post".
               type: "POST",
               //Data will be sent to "ajax.php".
               url: "ajax.php",
               //Data, that will be sent to "ajax.php".
               data: {
                   //Assigning value of "name" into "search" variable.
                   search: name
               },
               //If result found, this funtion will be called.
               success: function(html) {
                   //Assigning result to "display" div in "search.php" file.
                   $("#display").html(html).show();
               }
           });
       }
   });
});




  
  
 $(function(){
    $('.Replylink').on('click', function(e){
        e.preventDefault();
        $(this).next('.reply-form').show();
    });
});

 $(function(){
    $('.quoteReplylink').on('click', function(e){
        e.preventDefault();
        $(this).next('.quotereply-form').show();
		
    });
});
 
