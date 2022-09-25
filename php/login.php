<?php
/**
 * Nicholas Whitford
 * Nov 28, 2021
 * Adds new book to the database
 */
  session_start();

 include "connect.php";

  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = filter_input(INPUT_POST, 'password');
  
  if ($email === null || $password === null ) {
    echo "All fields must be completed to sign up";
    die();
  }

  // Check if email exisits in the database
  $command = "SELECT email FROM users where email = ?;";
  $stmt = $dbh->prepare($command);
  $params = [$email];
  $success = $stmt->execute($params);

  if ($stmt->fetch() > 0 && $success) {
    // Check if password in database matches password entered into form
    $command = "SELECT user_id, first_name, password FROM users WHERE email = ?;";
    $stmt = $dbh->prepare(($command));
    $params = [$email];
    $success = $stmt->execute($params);

    if ($success) {
      $row = $stmt->fetch();

      // If Passwords match, add userid and first_name to session array
      if (password_verify($password, $row["password"])) {
        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["first_name"] = $row["first_name"];
        echo 1;
      } else {
        // Passwords do not match
        echo -3;
      }

    } else {
      echo -4;
    }

  } else {
    // Email entered by user could not be found in the database
    echo -2;
  }