/**
 * Nicholas Whitford
 * Nov 28, 2021
 * Javascript and jQuery related to user tasks
 * Signup, Login or Update User
 */

/**
 * Sign up a new user
 * 
 */
export function signUpUser() {
  const firstname = $('#signup-first-name').val();
    const lastname = $('#signup-last-name').val();
    const email = $('#signup-email').val();
    const password = $('#signup-password').val();

    // console.log(`Firstname: ${firstname.val()}, Lastname: ${lastname.val()}, Email: ${email.val()}, Password: ${password.val()}`)

    // Check if any fields are empty
    if (firstname == '' || lastname == '' || email == '' || password == ''){
      $('#signup-message').addClass('error-message').text('Please complete all fields.');
      return;
    }
    // Check if password is at least 6 characters long
    if (password.length < 6) {
      $('#signup-message').addClass('error-message').text('Password must be at least 6 characters long.');
      return;
    }
    
    const params = {
      firstname: firstname,
      lastname: lastname,
      email: email,
      password: password
    }
    
    // Add user to database
    $.post("php/signup.php", params, function(data, status, xhr){
      // console.log(`Data: ${data}, Status: ${status}`);

      if (data == -2) {
        $('#signup-message').addClass('error-message').text(`Error, the email ${email} is being used by someone else.`);
      } else if (data == 1) {
        $('#signup-message').addClass('success-message').text(`${firstname} has been signed up!`).append('<br/><a class="text-white" href="loginPage.php">Click HERE to log in</a>'); 
        
        // Clear form fields
        $('#signup-first-name').val('');
        $('#signup-last-name').val('');
        $('#signup-email').val('');
        $('#signup-password').val('');

      } else {
        $('#signup-message').addClass('error-message').text(`Error, unable to sign up ${firstname}.`);
      }
    });
}

/**
 * Log in a user
 * 
 */
export function loginUser() {
  // Get form inputs
    const email = $('#login-email');
    const password = $('#login-password');

    // console.log(`Email: ${email.val()}, Password: ${password.val()}`);

    // Check if fields are empty
    if (email.val() == '' || password.val() == '') {
      $('#login-message').addClass('error-message').text('Please complete all fields.');
      return;
    }

    const params = {
      email: email.val(),
      password: password.val()
    }

    // Send form parameters to login script to try logging in
    $.post('php/login.php', params, (data, status) => {
      // console.log(`Data: ${data}, Status: ${status}`);

      if (data == 1) {
        window.location.replace("https://nickreads.whitforddesign.ca/booksPage.php");
      } else {
        $('#login-message').addClass('error-message').text(`Error, invalid email or password.`);
      }
    });
}

/**
 * Update information about a user's proflie
 * 
 */
export function updateUserAccount() {
  // get form inputs
  const userid = $('#account-userid').val();
  const firstname = $('#account-first-name').val();
  const lastname = $('#account-last-name').val();
  const email = $('#account-email').val();
  const currentPassword = $('#account-password').val();
  const newPassword = $('#account-new-password').val();

  // console.log(`Userid: ${userid}, Firstname: ${firstname}, Lastname: ${lastname}, Email: ${email}, Password: ${password}`);

  // Check if fields are empty
  if (userid == '' || firstname == '' || lastname == '' || email == '') {
    $('#account-message').addClass('error-message').text('First Name, Last Name and Email fields must be completed.');
    return;
  }

      // Check if password is at least 6 characters long
  if (newPassword != '') {
    if (newPassword.length < 6) {
      $('#account-message').addClass('error-message').text('Password must be at least 6 characters long.');
      return;
    }
  }

  const params = {
    userid: userid,
    firstname: firstname,
    lastname: lastname,
    email: email,
    currentPassword: currentPassword,
    newPassword: newPassword
  };

  // Update user's account information in database
  $.post('php/updateAccount.php', params, (data, status) => {
    // console.log(`Data: ${data}, Status: ${status}`);

    if (data == 1 || data == 2) {
      $('#account-message').addClass('success-message').text(`Your account has been updated!`);
      $('#account-password').val('');
      $('#account-new-password').val('');
    } else if (data == -3) {
      $('#account-message').addClass('error-message').text(`Error, unable to update password, current password does not match.`);
    }
     else {
      $('#account-message').addClass('error-message').text(`Error, unable to update account information.`);
    }
  });
}