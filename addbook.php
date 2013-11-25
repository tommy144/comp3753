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
	if (!$_SESSION[admin])
	{
		header("Location: index.php?flag=3");
		die();
	}
	try
	{
		include 'config.php';
		$conn = new PDO('mysql:host=localhost;dbname'.DATABASE, USERNAME, PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$s1 = $conn->prepare('INSERT INTO book VALUES('.$_POST['isbn'].$_POST[title].$_POST[author].$_POST[price].$_POST[quantity].$_POST[bookstore].')');
		$s->execute();
	}
?>
