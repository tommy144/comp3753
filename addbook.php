<?php session_start();

  echo '<pre>';
  var_dump($_POST);
  echo '</pre>';
  echo '<br>';
  echo $_POST['bookstore'].'<br>';
  echo $_POST['isbn'].'<br>';
  echo $_POST['title'].'<br>';
  echo $_POST['author'].'<br>';
  echo $_POST['price'].'<br>';
  echo $_POST['course'].'<br>';
  echo $_POST['quantity'].'<br>';

?>
