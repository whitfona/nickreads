/**
 * Nicholas Whitford
 * Nov 28, 2021
 * Javascript and jQuery for Nickreads
 */

import { signUpUser, loginUser, updateUserAccount } from './user.js';
import { getBooks, addBook, deleteBook, updateBook, clearBookForm } from './book.js';

$(document).ready(function() {
  
  getBooks();

  /**
   * Sign up a new user when sign up form is submitted.
   */

  $('#signup-form').submit((e) => {
    e.preventDefault();

    signUpUser();
    
  })

  /**
   * Login User when log in form is submitted.
   */
  $('#login-form').submit((e) => {
    e.preventDefault();

    loginUser();
    
  });

  /**
   * Update user's account information when update account form is submitted.
   */
  $('#account-form').submit((e) => {
    e.preventDefault();

    updateUserAccount();

  });

  /**
   * Add new book when book form is submitted.
   */
  $('#add-book').submit((e) => {
    e.preventDefault();

    addBook();
    
  })
  
  /**
   * Get books from database for specific user
   */
  $('#get-books').click((e) => {
    e.preventDefault();

    getBooks();
    
  })

  /**
   * Populate book form with information from the selected book, and change the buttons
   */
  $(document).on('click', '.edit', (bookToEdit) => {
    // Get information for the book to edit
    const bookParent = bookToEdit.target.parentElement;
    const bookid = bookParent.parentElement.id;
    const title = bookParent.previousElementSibling.previousElementSibling.previousElementSibling.innerHTML;
    const author = bookParent.previousElementSibling.previousElementSibling.innerHTML;
    const rating = bookParent.previousElementSibling.innerHTML;
  
    // console.log(`Parent: ${bookParent}, Bookid: ${bookid}, Title: ${title}, Author: ${author}, Rating: ${rating}`);

    // Put targetted book into Add Book form and add Update, Delete and Cancel buttons
    $('#update-bookid').val(bookid);
    $('#title').val(title);
    $('#author').val(author);
    $('#rating').val(rating);

    if ($('#update-book-button').hasClass('hide') || $('#delete-book-button').hasClass('hide') || $('#cancel-book-button').hasClass('hide')) {
      $('#update-book-button').toggleClass('hide');
      $('#delete-book-button').toggleClass('hide');
      $('#cancel-book-button').toggleClass('hide');
      $('#add-book-button').toggleClass('hide');
    }

    $(document).scrollTop(200);
  });

  /**
  * Reset form and buttons when cancel button is clicked while a book is being updated
  */
  $('#cancel-book-button').click((e) => {
    e.preventDefault();

    clearBookForm();

  });

  /**
   * Delete book when delete button is clicked
   */
  $('#delete-book-button').click((e) => {
    e.preventDefault();

    deleteBook();

  })

  /**
   * Update book when update button is clicked
   */
  $('#update-book-button').click((e) => {
    e.preventDefault();

    updateBook(); 

  })

  /**
   * Toggle password in plain text when 'Show Password' is clicked on signup page
   */
  $('#signup-show-password').click(() => {
    if ($('#signup-password').is('input[type="password"]')) {
      $('#signup-password').attr('type', 'text');
    } else {
      $('#signup-password').attr('type', 'password')
    }
  });

  /**
   * Toggle password in plain text when 'Show Password' is clicked on account page
   */
  $('#account-show-password').click(() => {
    if ($('#account-new-password').is('input[type="password"]')) {
      $('#account-new-password').attr('type', 'text');
    } else {
      $('#account-new-password').attr('type', 'password')
    }
  });

  /**
   * Toggle 'Rating' to 'Excitement' when Read/Wishlist slider changes
   */
  $('#isWishlist').change(function () {
    if (this.checked) {
      console.log('Wishlist');
      $('label[for="rating"]').text('Excitement');
    } else {
      console.log('Read');
      $('label[for="rating"]').text('Rating');
    }
  });

//END OF FILE
});

