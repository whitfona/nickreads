<?php
/**
 * Nicholas Whitford
 * Nov 28, 2021
 * Adds new book to the database
 */

 include "connect.php";

  $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
  $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = filter_input(INPUT_POST, 'password');
  $hash = password_hash($password, PASSWORD_DEFAULT);
  
  if ($firstname === null || $lastname === null || $email === null || $password === null ) {
    echo "All fields must be completed to sign up";
    die();
  }

  if (strlen($password) < 6) {
    echo "Password must be at least six characters long.";
    die();
  } 

  // Check if email is already in the database
  function checkIfEmailExists(PDO $dbh, $email) {
    $command = "SELECT email FROM users where email = ?;";
    $stmt = $dbh->prepare($command);
    $params = [$email];
    $success = $stmt->execute($params);

    if ($stmt->fetch() > 0 && $success) {
      return true;
    }

    return false;
  }
  
  if (checkIfEmailExists($dbh, $email) == true) {
    echo -2;
  } else {
    $command = "INSERT INTO users VALUES (Null, ?, ?, ?, ?)";
    $stmt = $dbh->prepare($command);
    $params = [$firstname, $lastname, $email, $hash];
    $success = $stmt->execute($params);
  
    if ($success) {
      echo "1";
    } else {
      echo "-1";
    }

  }
