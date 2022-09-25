<?php
/**
 * Nicholas Whitford
 * Nov 28, 2021
 * Delete specific book from databse
 */

 include "connect.php";

  $bookid = filter_input(INPUT_GET, 'bookid', FILTER_VALIDATE_INT);
  
  if ($bookid === null || $bookid === false) {
    echo "Invalid bookid.";
  }

  $command = "DELETE FROM books WHERE book_id = ?;";
  $stmt = $dbh->prepare($command);
  $params = [$bookid];
  $success = $stmt->execute($params);

  if ($success) {
    echo 1;
  } else {
    echo -1;
  }