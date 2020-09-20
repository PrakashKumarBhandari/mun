$("#contact-us-form").validate({

				
	/* @validation states + elements 
	------------------------------------------- */
	errorClass: "state-error",
	validClass: "state-success",
	errorElement: "em",
	onkeyup: false,
	onclick: false,
	
	/* @validation rules 
	------------------------------------------ */
	rules: {
        name: {
            required: true,
            minlength: 2
        },
        email: {
            required: true,
            email: true
		},
		subject: {
            required: true
		},
		message: {
            required: true
        },
		invalidCheck: {
            required: true
        }
    },
    messages: {
        name: {
            required: 'Enter your name here',
            minlength: 'Name must be at least 2 characters'
        },
        email: {
            required: 'Enter your email address',
            email: 'Enter a VALID email address'
        },
        subject: {
            required: 'Please enter subject '
		},
		message: {
            required: 'Please enter your message'
		},
		invalidCheck: {
            required: 'Please Agree before submit'
		}
    },

	/* @validation highlighting + error placement  
	---------------------------------------------------- */
	highlight: function(element, errorClass, validClass) {
			$(element).closest('.field').addClass(errorClass).removeClass(validClass);
	},
	unhighlight: function(element, errorClass, validClass) {
			$(element).closest('.field').removeClass(errorClass).addClass(validClass);
	},
	errorPlacement: function(error, element) {
	   if (element.is(":radio") || element.is(":checkbox")) {
				element.closest('.form-group').after(error);
	   } else {
				error.insertAfter(element.parent());
	   }
	},	
	
	/* @ajax form submition 
	---------------------------------------------------- */						
	submitHandler:function(form) {
		var name = jQuery('#name').val();
		var email = jQuery('#email').val();
		var subject = jQuery('#subject').val();
		var phone = jQuery('#phone').val();
		var message = jQuery('#message').val();
		var recaptchaResponse = jQuery('#recaptchaResponse').val();
		jQuery.ajax({
		  url: contact_object.ajax_url,
		  type:"POST",
		  dataType:'json',
		  data: {
			  action:'save_ajax_contact_form', 
			  name:name,                     
			  email:email,
			  subject:subject,
			  phone:phone,
			  message:message,
			  recaptchaResponse:recaptchaResponse
		  }, success: function(data){          
			if(data.success == 0){
			  jQuery("#error_msg").css("display","block");     		  
			  
			  console.log(data.message);
			}else{
			  jQuery("#success_msg").css("display","block");
			  //form.classList.remove('was-validated');
			 
			  jQuery('#contact-us-form').resetForm();
			}         
		  }, error: function(data){
			console.log("Unexcepted error");
			}
		});
		
	}
	
});