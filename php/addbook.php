<?php
/**
 * Nicholas Whitford 
 * Nov 28, 2021
 * Adds new book to the database
 */

 include "connect.php";

  $userid = filter_input(INPUT_POST, 'userid', FILTER_VALIDATE_INT);
  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
  $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
  $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
  $isWishlist = filter_input(INPUT_POST, 'isWishlist', FILTER_VALIDATE_BOOLEAN);
  $isWishlistAsInt = 1;
  
  if ($userid === null || $userid === false || $title === null || $author === null || $rating === null || $rating === false || $isWishlist === null) {
    echo "All fields must be completed to add a book.";
    die();
  }

  if ($isWishlist == true) {
    $isWishlistAsInt = 0;
  }

  $command = "INSERT INTO books VALUES (Null, ?, ?, ?, ?, ?)";
  $stmt = $dbh->prepare($command);
  $params = [$userid, $title, $author, (int)$rating, $isWishlistAsInt];
  $success = $stmt->execute($params);

  if ($success) {
    echo 1;
  } else {
    echo -1;
  }