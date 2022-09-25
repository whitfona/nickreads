<?php
/**
 * Nicholas Whitford
 * Nov 28, 2021
 * Update user's account information
 */

 include "connect.php";

  $userid = filter_input(INPUT_POST, 'userid', FILTER_VALIDATE_INT);
  $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
  $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $currentPassword = filter_input(INPUT_POST, 'currentPassword');
  $newPassword = filter_input(INPUT_POST, 'newPassword');
  $hash = password_hash($newPassword, PASSWORD_DEFAULT);
  
  if ($userid == null || $userid == false || $firstname === null || $lastname === null || $email === null ) {
    echo "All fields must be completed to sign up";
    die();
  }

  if ($newPassword != null) {
    if (strlen($newPassword) < 6) {
      echo "Password must be at least six characters long.";
      die();
    }
  } 

  // If currentPassword and newPassword are null, that means user is not updating their password
  if ($newPassword == null) {
    $command = "UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE user_id = ?;";
    $stmt = $dbh->prepare($command);
    $params = [$firstname, $lastname, $email, $userid];
    $success = $stmt->execute($params);
    
    if ($success) {
      $_SESSION["first_name"] = $firstname;
      echo 1;
    } else {
      echo -1;
    }
  } else {
    // Check if password in database matches password entered into form
    $command = "SELECT password FROM users WHERE user_id = ?;";
    $stmt = $dbh->prepare($command);
    $params = [$userid];
    $success = $stmt->execute($params);

    if ($success) {
      $row = $stmt->fetch();

      // If Passwords match, update new password
      if (password_verify($currentPassword, $row["password"])) {
        $command = "UPDATE users SET password = ? WHERE user_id = ?;";
        $stmt = $dbh->prepare($command);
        $params = [$hash, $userid];
        $success = $stmt->execute($params);

        if ($success) {
          echo 2;
        } else {
          echo -2;
        }
        
      } else {
        // Passwords do not match
        echo -3;
      }
    }
  }


