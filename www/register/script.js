//This JavaScript validates the form data from the user input to prevent unacceptable data or spam getting into the database. The following validations will force the user to enter all the form fields with correct data and allows us to display messages for all errors.
$('document').ready(function()
{ 
     /* validation */
	 $("#register-form").validate({
      rules:
	  {
			user_name: {
		    required: true,
			minlength: 3
			},
			password: {
			required: true,
			minlength: 8,
			maxlength: 15
			},
			cpassword: {
			required: true,
			equalTo: '#password'
			},
			user_email: {
            required: true,
            email: true
            },
	   },
       messages:
	   {
            user_name: "Please enter user name",
            password:{
                      required: "Please provide a password",
                      minlength: "Password at least have 8 characters"
                     },
            user_email: "Please enter a valid email address",
			cpassword:{
						required: "Please retype your password",
						equalTo: "Password doesn't match !"
					  }
       },
	   submitHandler: submitForm	
       });  
	   /* validation ends */
           
//After the validation finishes, the code below Will work without reloading the page and will register a new user by giving them a success message.

	   /* form submit */
	   function submitForm()
	   {		
				var data = $("#register-form").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'register.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('&nbsp; sending ...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
											$("#error").html('<div class="alert alert-danger">Sorry email already taken!</div>');
											
											$("#btn-submit").html('Create Account');
										
									});
																				
								}
								else if(data=="registered")
								{
									
									$("#btn-submit").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing Up ...');
									setTimeout('$(".form-signin").fadeOut(500, function(){ $(".signin-form").load("../login/index.php"); }); ',5000);
									
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<div class="alert alert-danger"> &nbsp; '+data+' !</div>');
											
									$("#btn-submit").html('&nbsp; Create Account');
										
									});
											
								}
						   }
				});
				return false;
		}
	   /* form submit */
	   
	   
	 

});

//We have to combine the validation and form submit code for it to work correctly.