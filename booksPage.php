<?php
/**
 * Nicholas Whitford
 * Nov 28, 2021
 * Reading list page (books page)
 */

  session_start();

  if (isset($_SESSION["user_id"])) {
    $userid = $_SESSION['user_id'];
    $username = $_SESSION['first_name'];
  } else {
    header( 'Location: https://nickreads.whitforddesign.ca/loginPage.php' );
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nickreads - Books List</title>
  <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
  <link rel="stylesheet" href="assets/styles/styles.css">
</head>
<body>
  <div class="container">
    <?php 
      if (isset($_SESSION["user_id"])) {
    ?>
      <nav id="nav-loggedin">
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
      <nav id="nav-loggedout">
        <a href="loginPage.php">Login</a>
        <a href="signupPage.php">Signup</a>
      </nav>
    <?php
      } 
    ?>

    <header id="books-header">
      <h1 class="text-white text-center"><?= $username ?>'s Reading List</h1>
      <h2 class="text-light-grey">Add Book</h2>
      <form action="#" method="POST" id="add-book">
        <input type="hidden" name="userid" id="userid" type="number" value="<?= $userid ?>">
        <input type="hidden" name="update-bookid" id="update-bookid" type="number">
        <label class="text-white" for="title">Title
          <input type="text" inputmode="text" name="title" id="title" required>
        </label>
        <label class="text-white" for="author">Author
          <input type="text" inputmode="text" name="author" id="author" required>
        </label>
        <label class="text-white" for="rating">Rating</label>
          <input type="number" inputmode="numeric" name="rating" id="rating" value="5" min="1" max="5" required>
        <div class="checkbox-container">
          <span>Read</span>
          <input type="checkbox" name="isWishlist" id="isWishlist"/>
          <span>Wishlist</span>
        </div>
        <p id="books-message" class="result-message"></p>
        <button id="add-book-button" type="submit">Add Book</button>
        <button id="update-book-button" class="hide" type="submit">Update Book</button>
        <button id="delete-book-button" class="hide" type="submit">Delete Book</button>
        <button id="cancel-book-button" class="hide" type="submit">Cancel</button>
      </form>
    </header>

    <main id="books-main">
      <h3 class="text-light-grey">Wishlist</h3>
      <table id="wishlist">
        <tr>
          <th>Title</th>
          <th>Author</th>
          <th>Excitement</th>
          <th></th>
        </tr>
      </table>

      <h3 class="text-light-grey">Read Books</h3>
      <table id="read-books">
        <tr>
          <th>Title</th>
          <th>Author</th>
          <th>Rating</th>
          <th></th>
        </tr>
      </table>
    </main>

    <footer class="text-light-grey">
      &copy;2021 | <a href="https://whitforddesign.ca/">Nick Whitford</a>
    </footer>
  </div>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="module" src="js/app.js"></script>
</body>
</html>