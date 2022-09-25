<?php
/**
 * Nicholas Whitford
 * Nov 28, 2021
 * Index page - Landing page that welcomes people to Nickreads and explains how it works
 */

  session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nickreads</title>
  <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
  <link rel="stylesheet" href="assets/styles/styles.css">
</head>
<body>
  <div class="container">
  <?php
  if (isset($_SESSION["user_id"])) {
    ?>
      <nav>
        <div>
          <a href="index.php"><span class="logo">Nick</span>reads</a>
        </div>
        <div>
          <a href="booksPage.php">Books</a>
          <a href="accountPage.php">Account</a>
          <a href="php/logout.php">Signout</a>
        </div>
        </nav>
        <?php
      } else {
    ?>
      <nav>
      <div>
        <a href="index.php"><span class="logo">Nick</span>reads</a>
      </div>
      <div>
        <a href="loginPage.php">Login</a>
        <a href="signupPage.php">Signup</a>
      </div>
      </nav>
    <?php
      } 
    ?>

    <main>
      <h1 class="text-white">Welcome to <span class="logo">Nick</span>reads!</h1>
      <h2 class="text-light-grey">Track your favourite books</h2>
      <div class="sub-text">
        <p class="text-white">Manage and track your reading list through Nickreads. Create a free account so you can track and rate your favourite books, or add your next favourite to your wish list.</p> <br />
        <p class="text-white">Nickreads is a full stack web app that uses JavaScript, jQuery, PHP and MySQL. The app is mobile responsive and uses coding best practices to protect user's information.</p>
      </div>
    </main>

    <footer class="text-light-grey">
      &copy;2021 | <a href="https://nickreads.whitforddesign.ca/">Nick Whitford</a>
    </footer>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="module" src="js/app.js"></script>
</body>
</html>