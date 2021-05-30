$('document').ready(function() {
  $('#form').submit(function(e) {

    e.preventDefault();

    var firstName = $('#firstName').val();
    var lastName = $('#lastName').val();
    var nic = $('#nic').val();
    var phone = $('#phone').val();
    var qualifications = $('#qualifications').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var confirmPassword = $('#confirmPassword').val();
    var selectMedium = $('#selectMedium').val();
    var selectGrade = $('#selectGrade').val();
    var selectSubject = $('#selectSubject').val();
    var selectDistrict = $('#selectDistrict').val();

    $('#firstName').click(function() {
      $('.classFirstname').empty();
    });

    $('.required').empty();

    if(firstName.length == 0) {
      // validateInput();
      $('#firstName').after('<span class="" style="color:red">*required</span>');
    }
    if(lastName.length == 0) {
      $('#lastName').after('<span class="" style="color:red">*required</span>');
    }
    if(nic.length == 0) {
      $('#nic').after('<span class="" style="color:red">*required</span>');
    }
    if(phone.length == 0) {
      $('#phone').after('<span class="" style="color:red">*required</span>');
    }
    if(qualifications.length == 0) {
      $('#nic').after('<span class="" style="color:red">*required</span>');
    }
    if(email.length == 0) {
      $('#nic').after('<span class="" style="color:red">*required</span>');
    }
    if(password.length == 0) {
      $('#nic').after('<span class="" style="color:red">*required</span>');
    }
  });
});
