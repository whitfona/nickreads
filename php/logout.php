<?php
/**
 * Nicholas Whitford
 * Nov 28, 2021
 * Adds new book to the database
 */

session_start();
session_unset();
session_destroy();

header( 'Location: https://nickreads.whitforddesign.ca/index.php' );
