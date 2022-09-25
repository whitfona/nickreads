/**
 * Nicholas Whitford
 * Nov 28, 2021
 * Javascript and jQuery related book tasks.
 * Add, Update or Delete Book and Get books from database
 */

/**
 * Add book to database
 * 
 */
export function addBook() {
  // Get form inputs
  const userid = parseInt($('#userid').val());
  const title = $('#title').val();
  const author = $('#author').val();
  const rating = parseInt($('#rating').val());
  const isWishlist = $('#isWishlist');
  let isWishlistAsBool = false;

  if (isWishlist.is(':checked')) {
    isWishlistAsBool = true;
  }

  // console.log(`Title: ${title}, Author: ${author}, Rating: ${rating}, isWishlist: ${isWishlist.is(':checked')}, isWishlistAsBool: ${isWishlistAsBool}`);

  // Check if any fields are empty
  if (title == '' || author == '' || rating == '') {
    $('#books-message').css('display', 'block').addClass('error-message').text('Please complete all fields.');
    return;
  }
  
  const params = {
    userid: userid,
    title: title,
    author: author,
    rating: rating,
    isWishlist: isWishlistAsBool
  }
  
  // Send book to database
  $.post('php/addbook.php', params, (data, status) => {
    // console.log(`Data: ${data}, Status: ${status}`);

    if (data == 1) {
      $('#books-message').css('display', 'block').addClass('success-message').text('Book successfully added!').delay(3000).fadeOut();
      getBooks();
      resetBookInputs();

    } else {
      $('#books-message').css('display', 'block').addClass('error-message').text('Error, unable to add book');
    }
  });
}

/**
 * Delete one book from database
 * 
 */
export function deleteBook() {
  const bookid =  parseInt($('#update-bookid').val());

  $.get('php/deleteBook.php', {bookid}, (data, status) => {
    // console.log(`Data: ${data}, Status: ${status}`);

    if (data == 1) {
      $('#books-message').css('display', 'block').addClass('success-message').text('Book successfully deleted!').delay(3000).fadeOut();
      getBooks();
      resetBookInputs();
      resetBookButtons();

    } else {
      $('#books-message').css('display', 'block').addClass('error-message').text('Error, unable to delete book');
    }
  })
}

/**
 * Update information about a specific book
 * 
 */
export function updateBook() {
// Get inputs from form
  const bookid = parseInt($('#update-bookid').val());
  const title = $('#title').val();
  const author = $('#author').val();
  const rating = parseInt($('#rating').val());
  const isWishlist = $('#isWishlist');
  let isWishlistAsBool = false;

  if (isWishlist.is(':checked')) {
    isWishlistAsBool = true;
  }

  // console.log(`BookID: ${bookid}, Title: ${title}, Author: ${author}, Rating: ${rating}, isWishlist: ${isWishlist.is(':checked')}`);

  // Check if any fields are empty
  if (title == '' || author == '' || rating == '') {
    $('#books-message').css('display', 'block').addClass('error-message').text('Please complete all fields.');
    return;
  }
  
  const params = {
    bookid: bookid,
    title: title,
    author: author,
    rating: rating,
    isWishlist: isWishlistAsBool
  }

  // Update book in database
  $.post('php/updateBook.php', params, (data, status) => {
    // console.log(`Data: ${data}, Status: ${status}`);

    if (data == 1) {
      $('#books-message').css('display', 'block').addClass('success-message').text('Book successfully updated!').delay(3000).fadeOut();
      getBooks();
      resetBookInputs();
      resetBookButtons();

    } else {
      $('#books-message').css('display', 'block').addClass('error-message').text('Error, unable to update book');
    }
  });   
}

export function getBooks() {
  
  const userid = $('#userid').val();
  // Clear previous books from list
  $("#read-books").find($("tr")).slice(1).remove()
  $("#wishlist").find($("tr")).slice(1).remove()
    
  $.getJSON('php/getBooks.php', { userid }, (data) => {
  
    let readArray = [];
    let wishlistArray = [];

    // Split the books into two arrays if they are read books or wishlist books
    data.forEach(book => {
      if (book.isWishlist == 1) {
        readArray.push(book);
      } else {
        wishlistArray.push(book);
      }
    });
    
    // Append each book to read list
    readArray.reverse().forEach(book => {
      const element = `
      <tr id="${book.book_id}">
        <td>${book.title}</td>
        <td>${book.author}</td>
        <td>${book.rating}</td>
        <td><img class="edit" src="./assets/images/pencil.png" alt="Edit book information"></td>
      </tr>
      `;

      $('#read-books').append(element);
    });

      // Append each book to wishlist
    wishlistArray.reverse().forEach(book => {
      const element = `
      <tr id="${book.book_id}">
        <td>${book.title}</td>
        <td>${book.author}</td>
        <td>${book.rating}</td>
        <td><img class="edit" src="./assets/images/pencil.png" alt="Edit book information"></td>
      </tr>
      `;

      $('#wishlist').append(element);
    });
  });
}

/**
 * Clear book form when cancel button is pushed
 * 
 */
export function clearBookForm() {
    // Reset form fields
    resetBookInputs();
    $('#books-message').text('');

    // Toggle buttons
    resetBookButtons();
}

/**
 * Resets all the book input form values back to default
 * 
 */
function resetBookInputs() {
  $('#update-bookid').val('');
  $('#title').val('');
  $('#author').val('');
  $('#rating').val('5');
}

/**
 * Resets all the book form buttoms back to default
 * 
 */
function resetBookButtons() {
  $('#add-book-button').toggleClass('hide');
  $('#update-book-button').toggleClass('hide');
  $('#delete-book-button').toggleClass('hide');
  $('#cancel-book-button').toggleClass('hide');
}