<?php
/**
 * Nicholas Whitford
 * Nov 28, 2021
 * Update specific book in the database
 */

 include "connect.php";

  $bookid = filter_input(INPUT_POST, 'bookid', FILTER_VALIDATE_INT);
  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
  $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
  $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
  $isWishlist = filter_input(INPUT_POST, 'isWishlist', FILTER_VALIDATE_BOOLEAN);
  $isWishlistAsInt = 1;
  
  if ($bookid === null || $bookid === false || $title === null || $author === null || $rating === null || $isWishlist === null) {
    echo "All fields must be completed to add a book.";
    die();
  }

  if ($isWishlist == true) {
    $isWishlistAsInt = 0;
  }

  $command = "UPDATE books SET title = ?, author = ?, rating = ?, isWishlist = ? WHERE book_id = ?;";
  $stmt = $dbh->prepare($command);
  $params = [$title, $author, (int)$rating, $isWishlistAsInt, (int)$bookid];
  $success = $stmt->execute($params);

  if ($success) {
    echo 1;
  } else {
    echo -1;
  }