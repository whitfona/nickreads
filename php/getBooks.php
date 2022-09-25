<?php
/**
 * Nicholas Whitford
 * Nov 28, 2021
 * Get books for a selected user
 */
  
  session_start();

  include "connect.php";
  
  $userid = filter_input(INPUT_GET, 'userid', FILTER_VALIDATE_INT);

  if ($userid == null || $userid == false) {
    echo 'No userid found.';
  }

  $books = [];

  // Get books for logged in user
  $command = "SELECT book_id, author, title, rating, isWishlist FROM books WHERE user_id = ?;";
  $stmt = $dbh->prepare($command);
  $params = [$userid];
  // $params = [1];
  $success = $stmt->execute($params);

  if ($success) {
  while ($row = $stmt->fetch()) {

    $booksFromDB = array("book_id"=>$row["book_id"], "author"=>$row["author"], "title"=>$row["title"], "rating"=>$row["rating"], "isWishlist"=>$row["isWishlist"]);

    array_push($books, $booksFromDB);
  }
  } else {
    echo "Error retreving books from database";
  }

  echo json_encode($books);