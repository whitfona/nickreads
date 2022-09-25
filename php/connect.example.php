<?php
/**
 * Nicholas Whitford
 * Nov 28, 2021
 * Creates connection to database
 */

  try {
    $dbh= new PDO("mysql:host=localhost;dbname=DBNAME","USERNAME","PASSWORD");
  } 
  catch(Exception$e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
  }