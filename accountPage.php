<?php
/**
 * Nicholas Whitford
 * Nov 28, 2021
 * Account page - update user's account information
 */

 session_start();

 include "./php/connect.php";

 // If user_id is set in session array, take user to books.php page
  if (isset($_SESSION["user_id"])) {
    $userid = $_SESSION['user_id'];
  } else {
    header('Location: https://nickreads.whitforddesign.ca/loginPage.php');
  }

  // Get logged in user information from database
  $command = "SELECT first_name, last_name, email FROM users WHERE user_id = ?;";
  $stmt = $dbh->prepare($command);
  $params = [$userid];
  $success = $stmt->execute($params);

  if ($success) {
    $row = $stmt->fetch();

    $firstname = $row["first_name"];
    $lastname = $row["last_name"];
    $email = $row["email"];
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nickreads - Account</title>
  <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
  <link rel="stylesheet" href="assets/styles/styles.css">
</head>
<body>
  <div class="container">
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

  <main id="account-page">
      <h1 class="text-white">Account</h1>
      <h2 class="text-light-grey">Update your account information</h2>
      <form action="#" method="POST" id="account-form">
        <input type="hidden" name="userid" id="account-userid" type="number" value="<?= $userid ?>" >
        <label class="text-white" for="account-first-name">First Name
          <input type="text" inputmode="text" name="account-first-name" id="account-first-name" value="<?= $firstname ?>" required>
        </label>
        <label class="text-white" for="account-last-name">Last Name
          <input type="text" inputmode="text" name="account-last-name" id="account-last-name" value="<?= $lastname ?>" required>
        </label>
        <label class="text-white" for="account-email">Email
          <input type="email" inputmode="email" name="account-email" id="account-email" value="<?= $email ?>" required>
        </label>
        <label class="text-white" for="account-password">Current Password
          <input type="password" inputmode="text" name="account-password" id="account-password">
        </label>
        <label class="text-white" for="account-new-password">New Password
          <input type="password" inputmode="text" name="account-new-password" id="account-new-password">
        </label>
        <p id="account-show-password" class="show-password text-white">Show Password</p>
        <p id="account-message" class="result-message"></p>
        <button type="submit">Update Profile</button>
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