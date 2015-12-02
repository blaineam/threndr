//wait for document to be ready and have every dom element loaded
$(document).ready(function(){
	//load homepage on logo press
	$("#logo").click(function(){
		window.location.href = "/home";
	});
	
	//toggle search box on search menu item click
	$("#searchtoggle").click(function(){
		
		$("#search").toggle();
		
	});
	
	//make product images fill container
	$(".featuredproduct img").each(function(){
		
	if($(this).width() < $(this).parent().width()) {
        //$(this).width('100%');
        //$(this).height('auto');
        //$(this).parent().height($(this).height());
    }
		
	});
	
	
	//start slider
	$('#slider').unslider();
	//start mobile navigation
	//$('#nav').tinyNav({
     //   active: 'selected',
     //   indent: '→'
     // });
      var nav = responsiveNav("#nav");
      //if remove cart item is clicked
      $('.removeitem').click(function(){
	      //confirm user ment to click this
	      if(confirm("Are you sure you want to remove this item from your cart?")){
		  //set nulling value
	      $(this).prev().val('0');
	      //submit changes
	      $('#cartupdater').submit();
	      }
      });
      		//declare conditioner
	      var clicked = false;
	      //check if same as mailing is clicked on the finalize order page
      $("#sameasmailing").click(function(){
	      //check conditioner
	      if(clicked==false){
		      //match billing information to mailing informaiton
	      	$("#billingaddress").val($("#mailingaddress").val());
	      	$("#billingaddressline2").val($("#mailingaddressline2").val());
	      	$("#billingcity").val($("#mailingcity").val());
	      	$("#billingstate").val($("#mailingstate").val());
	      	$("#billingzip").val($("#mailingzip").val());
	      	//change conditioner
		    clicked = true;
	      }else{
		      //empty billing information
		      $("#billingaddress").val('');
	      	$("#billingaddressline2").val('');
	      	$("#billingcity").val('');
	      	$("#billingstate").val('');
	      	$("#billingzip").val('');
	      	//change conditioner
		    clicked = false;
	      }
      });
      //validate final order values on submit
      $("#finalorderform").submit(function(e){
	      //declare phone number pattern
	      var phoneno = /^\d{10}$/;  
	      //declare email pattern
	      var email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	      //check that all required fields have a value
    if ($("#name").val() == ''         || 
          $("#email").val() == ''     || 
          $("#password").val().value == ''  || 
          $("#confirmpassword").val() == ''  || 
          $("#phonenumber").val() == ''  || 
          $("#mailingaddress").val() == ''  ||
          $("#mailingcity").val() == ''  || 
          $("#mailingstate").val() == ''  || 
          $("#mailingzip").val() == ''  || 
          $("#billingaddress").val() == ''  ||
          $("#billingcity").val() == ''  || 
          $("#billingstate").val() == ''  || 
          $("#billingzip").val() == ''  || 
          $("#cardnumber").val() == ''  || 
          $("#nameoncard").val() == ''  || 
          $("#expirationdate").val() == ''  || 
          $("#cvvcode").val() == ''  || 
          $("#paymenttype").val() == '') {
		  //alert user not all fields were completed
        alert('You didn’t fill out all the fields, did you?  Please do!');
        return false;
        //check phone number is valid
    }else if(!$("#phonenumber").val().match(phoneno)){
	    //alert user of improper phone number
	    alert('Please enter a valid US 10 digit phone number.');
	    return false;
	    //check email address is valid
    }else if(!$("#email").val().match(email)){
	    //alert user of improper email address
	    alert('Please enter a valid email address.');
	    return false;
	    //check password meets security requirments
    }else if(!$("#password").val().match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,30}$/)){
	    //alert user of improper password
	    alert('Your password must be between 8 to 30 characters and contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character');
	    return false;
	    //check if password was typed the same both times
    }else if($("#password").val()!=$("#confirmpassword").val()){
	    //alert user of unmatching passwords
	    alert('Your Passwords do not match');
	    return false;
	    //check if creditcard number has a value
    }else if($("#cardnumber").val() != ''){
	    	//declare conditioner
	      var creditcardvalid = false;
	      //check if card number is a proper card number and set payment type from validator
	      $("#cardnumber").validateCreditCard(function(result){
		      creditcardvalid = result.valid;
		      var paymenttype = result.card_type.name;
		      $("#paymenttypehidden").val(paymenttype);
	      });
	      //check conditioner
	      if(creditcardvalid!=true){
		      //alert user of invalid credit card number
	    alert('Please check the card number and payment type.');
	    return false;
    }

	      
	    } 	      
      });
      
      
});