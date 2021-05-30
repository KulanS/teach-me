$('document').ready(function() {
  // data: {'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'};
  var csrf_name = $('#csrf_name').val();
  var csrf_hash = $('#csrf_hash').val();
  
  //get all cookies
var x = document.cookie;
//search for the csrf cookie name
var posname = x.search('csrf_cookie_name');
//slice out hash itself which is always 32 characters long and these numbers work
var hash = x.slice(posname+17,posname+49);
console.log(hash);
var csfrData = {};
     csfrData[csrf_name]
                       = hash;

  /*$('#btSubject').click(function(){
   if($('#selectGrade').val() == null){
     alert("Please select a grade");
   }else{
     $('#selectSubject').selectpicker('refresh');
     $('#selectSubject').empty();
     var request_data = {
       //csrf_name : hash,
       audience_list : $('#selectGrade').val()
     }
     console.log(csrf_name + 1212);
     console.log(csrf_hash + 1212);
     $.ajax({
             type : "POST",
             dataType :'json',
             url : "<?php echo base_url('registration/get_subject_list') ?>",
             data : {
				 //csrf_name : hash,
				 audience_list : $('#selectGrade').val()
			 },
             success : function(data) {
               jQuery(data).each(function(i, item){
                 $('#selectSubject').append($("<option></option>").attr("value", item.subjectid).text(item.subjectname));
               });
               $('#selectSubject').selectpicker('refresh');
             }

           });
         }
    });*/
  /***************************************************/
  $('#response-alert').removeClass("hide").hide();
  $('#form').submit(function(e) {


    e.preventDefault();
    var validated = true;


    var firstName = $('#firstName').val().charAt(0).toUpperCase() + $('#firstName').val().slice(1);
    var lastName = $('#lastName').val().charAt(0).toUpperCase() + $('#firstName').val().slice(1);
    var nic = $('#nic').val().toUpperCase();
    var phone = $('#phone').val();
    var qualifications = $('#qualifications').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var confirmPassword = $('#confirmPassword').val();
    var selectMedium = $('#selectMedium').val();
    var selectGrade = $('#selectGrade').val();
    var selectSubject = $('#selectSubject').val();
    var selectDistrict = $('#selectDistrict').val();

    console.log(csrf_name);
    console.log(csrf_hash);

  $('.alert').alert();

	$('.validation').remove();

    if(firstName.length == 0) {
      $('#firstName').after('<span class="validation" style="color:red">*required</span>');
      validated = false;
    }
    if(lastName.length == 0) {
      $('#lastName').after('<span class="validation" style="color:red">*required</span>');
      validated = false;
    }
    if(nic.length == 0) {
      $('#nic').after('<span class="validation" style="color:red">*required</span>');
      validated = false;
    }
    if(phone.length == 0) {
      $('#phone').after('<span class="validation" style="color:red">*required</span>');
      validated = false;
    }
    if(qualifications.length == 0) {
      $('#qualifications').after('<span class="validation" style="color:red">*required</span>');
      validated = false;
    }
    if(email.length == 0) {
      $('#email').after('<span class="validation" style="color:red">*required</span>');
      validated = false;
    }
    if(password.length != 0) {
      if(password.length > 7) {
		  if(confirmPassword.length != 0) {
			  if(password == confirmPassword) {

			  }else {
				  $('#confirmPassword').after('<span class="validation" style="color:red">*password does not match</span>');
          validated = false;
			  }
		  }else{
			  $('#confirmPassword').after('<span class="validation" style="color:red">*required</span>');
        validated = false;
		  }
	  }else {
		  $('#password').after('<span class="validation" style="color:red">*required 8 or more chracters</span>');
      validated = false;
	  }
    } else {
		$('#password').after('<span class="validation" style="color:red">*required</span>');
    validated = false;
	}
	if(selectMedium == null){
		$('#selectMediumGroup').after('<span class="validation" style="color:red">*required</span>');
    validated = false;
	}
	if(selectGrade == null){
		$('#selectGradeGroup').after('<span class="validation" style="color:red">*required</span>');
    validated = false;
	}
	if(selectSubject == null){
		$('#selectSubjectGroup').after('<span class="validation" style="color:red">*required</span>');
    validated = false;
	}
	if(selectDistrict == null){
		$('#selectDistrictGroup').after('<span class="validation" style="color:red">*required</span>');
    validated = false;
	}

  if(validated) {
    var request_data = {
      csrf_name : hash,
	  firstName : firstName,
      lastName : lastName,
      nic : nic,
      phone : phone,
      qualifications : qualifications,
      email : email,
      password : password,
      mediumList : selectMedium,
      gradeList : selectGrade,
      subjectList : selectSubject,
      districtList : selectDistrict
    };
    $.ajax({
      type : "POST",
      dataType : 'json',
      url : "<?php echo base_url('registration/register_user') ?>",
      data : request_data,
      success : function(data) {
        if(data['responseCode'] == '00') {
          $('#response-alert').removeClass("hide").show();
          $('#response-alert').addClass('alert-success');
          $('#response-alert').append('<strong>Holy guacamole!</strong> You should check in on some of those fields below.');
        }else {

        }
      }
    });
  }else {
    $('#response-alert').removeClass("hide").show();
    $('#response-alert').addClass('alert-danger');
    $('#response-alert').append('<strong>Holy guacamole!</strong> You should check in on some of those fields below.');
    // $('#response-alert').addClass('alert-warning');
    $("html, body").animate({ scrollTop: 0 }, "slow");
  }
  });

});
