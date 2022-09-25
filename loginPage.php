<?php
/**
 * Nicholas Whitford
 * Nov 28, 2021
 * Login page
 */

 session_start();

 // If user_id is set in session array, take user to books.php page
 if (isset($_SESSION["user_id"])) {
   header('Location: https://nickreads.whitforddesign.ca/loginPage.php');
  } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nickreads - Login</title>
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
      <h2 class="text-light-grey">Login</h2>
      <form action="/books.html" method="POST" id="login-form">
        <label class="text-white" for="login-email">Email
          <input type="email" inputmode="email" name="login-email" id="login-email" required>
        </label>
        <label class="text-white" for="login-password">Password
          <input type="password" inputmode="text" name="login-password" id="login-password" required>
        </label>
        <p id="login-message" class="result-message"></p>
        <button type="submit">Login</button>
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