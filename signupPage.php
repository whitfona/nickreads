<?php
/**
 * Nicholas Whitford
 * Nov 28, 2021
 * Signup page
 */

 session_start();

 // If user_id is set in session array, take user to books.php page
 if (isset($_SESSION["user_id"])) {
   header('Location: http://localhost/bookapp/booksPage.php');
  } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nickreads - Signup</title>
  <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
  <link rel="stylesheet" href="assets/styles/styles.css">
</head>
<body>
  <div class="container">
    <nav id="nav-loggedout">
      <div>
        <a href="index.php"><span class="logo">Nick</span>reads</a>
      </div>
      <div>
        <a href="loginPage.php">Login</a>
        <a href="signupPage.php">Signup</a>
      </div>
    </nav>

    <main>
      <h1 class="text-white"><span class="logo">Nick</span>reads</h1>
      <h2 class="text-light-grey">Signup</h2>
      <form action="#" method="POST" id="signup-form">
        <label class="text-white" for="signup-first-name">First Name
          <input type="text" inputmode="text" name="signup-first-name" id="signup-first-name" required>
        </label>
        <label class="text-white" for="signup-last-name">Last Name
          <input type="text" inputmode="text" name="signup-last-name" id="signup-last-name" required>
        </label>
        <label class="text-white" for="signup-email">Email
          <input type="email" inputmode="email" name="signup-email" id="signup-email" required>
        </label>
        <label class="text-white" for="signup-password">Password
          <input type="password" inputmode="text" name="signup-password" id="signup-password" placeholder="6+ characters" required>
        </label>
        <p id="signup-show-password" class="show-password text-white">Show Password</p>
        <div>
          <p id="signup-message" class="result-message"></p>
        </div>
        <button type="submit">Signup</button>
      </form>
    </main>

    <footer class="text-light-grey">
      &copy;2021 | <a href="https://whitforddesign.ca/">Nick Whitford</a>
    </footer>
  </div>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="module" src="js/app.js"></script>
</body>
</html>