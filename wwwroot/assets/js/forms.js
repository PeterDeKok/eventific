$(document).ready(function () {
  $('body').on('submit', 'form#signup', function (e) {
		
		var form = $(this);
		var username = form.find('[name=username]')
		var password = form.find('[name=password]')
		var email = form.find('[name=email]')
		var confirmpwd = form.find('[name=confirmpwd]')
		
		if(DEBUG) console.log('Submit form: '+form.attr('name'));
		
		if(regformhash(form, username, email, password, confirmpwd)) {
			if(DEBUG) console.log('Comfirmed form, sending!');
			return true;
		}
	});
});

function formhash(form, password) {
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
 
    // Finally submit the form. 
    form.submit();
}
 
function regformhash(form, uid, email, password, conf) {
     // Check each field has a value
    if (uid.val() == ''         || 
          email.val() == ''     || 
          password.val() == ''  || 
          conf.val() == '') {
 
        alert('You must provide all the requested details. Please try again');
        return false;
    }
 
    // Check the username
 
    re = /^\w+$/; 
    if(!re.test(uid.val())) { 
        alert("Username must contain only letters, numbers and underscores. Please try again"); 
        username.focus();
        return false; 
    }
 
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.val().length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        password.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.val())) {
        alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        return false;
    }
 
    // Check password and confirmation are the same
    if (password.val() != conf.val()) {
        alert('Your password and confirmation do not match. Please try again');
        password.focus();
        return false;
    }
 
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.append(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.val());
 
    // Make sure the plaintext password doesn't get sent. 
    password.val("");
    conf.val("");
		
		return true;
}

function changeformhash(form, email, oldpass, password, conf) {
     // Check each field has a value
    if (email.value == ''         || 
          oldpass.value == ''     || 
          password.value == ''  || 
          conf.value == '') {
 
        alert('You must provide all the requested details. Please try again');
        return false;
    }
 
    // Check the username
 
    re = /^\w+$/; 
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        return false;
    }
 
    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }
 
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
    var p_old = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    form.appendChild(p_old);
    p_old.name = "p_old";
    p_old.type = "hidden";
    p_old.value = hex_sha512(oldpass.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";
    oldpass.value = "";
 
    // Finally submit the form. 
    form.submit();
    return true;
}
