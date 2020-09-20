function openFormModal(post_id){
	jQuery('#sendReservation').trigger("reset");
	jQuery("#reservation_post_id").val(post_id);
	jQuery('#sendReservationModal').modal('show');
}

jQuery("#openFormModal").click(function(){	
	jQuery('#sendReservationModal').modal('show');
});

jQuery('#sendReservation').on("submit",function(e) {
	e.preventDefault();
	//alert("Confirm formSubmitted");
	var reservation_post_id = jQuery("#reservation_post_id").val();
	
	var confirmReject = jQuery("#confirmReject").val();
	if(confirmReject == '')
	{
		alert('Please choose any of confirm or reject option');
		return false;
	}
	var confirm_booking = jQuery("#confirm_booking").val();
	var confirm_booking_email = jQuery("#confirm_booking_email").val();

	var reject_booking = jQuery("#reject_booking").val();
	var reject_booking_email = jQuery("#reject_booking_email").val();

	jQuery.ajax({
		url: pkb_object.ajax_url,
		type:"POST",
		dataType:'json',
		data: {
			action:'sendBookingResponse', 
			reservation_post_id : reservation_post_id,   
			confirmReject: confirmReject,  
			confirm_booking: confirm_booking,  
			confirm_booking_email: confirm_booking_email,  
			reject_booking: reject_booking,  
			reject_booking_email: reject_booking_email
		}, success: function(data){     
			
			if(data.success == 0){
				jQuery("#error_msg").css("display","block"); 
			}else{
				jQuery("#success_msg").css("display","block");
				jQuery("#s_msg_disp").html(data.message); 				
			} 
			       
			setTimeout(function() { 				
				jQuery('#sendReservationModal').modal('hide');
				location.reload(); 
			 }, 5000);			
			 
		}, error: function(data){
		  console.log("Unexcepted error");
		  }
	  });
	 


});

jQuery('#submit_reserve').attr('disabled','disabled');

jQuery("#confirmReject").change(function(){	
	var choosen  = jQuery(this).val();
	jQuery('.email_message').hide();
	jQuery('#submit_reserve').attr('disabled','disabled');
	
	if( choosen =='confirm'){
		//jQuery('#confirm').show();
		jQuery('#submit_reserve').removeAttr('disabled');
	}
	else if(choosen =='reject'){
		//jQuery('#reject').show();
		jQuery('#submit_reserve').removeAttr('disabled');
	}	
});