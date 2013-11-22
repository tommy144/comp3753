<?php session_start();
if ($_SESSION['user']) {
  header("Location: index.php?flag=6");
  die();
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
</head>
<body>
<?php
if ($_GET['flag']) {
  if ($_GET['flag'] == 1) { ?>
<div style="background: red; width:100%;">Check Again!</div>
<?php  } } ?>

  
<form method="post" action="create.php">
  <label for="name">Name</label>
	<input id="name" type="text" name="Name">
  <br>
  <label for="uname">Student Number *</label>
	<input id="uname" type="text" name="Num">
  <br>
  <label for="pword">Passwordi *</label>
	<input id="pword" type="password" name="Password">
  <br>
  <label for="pword">Re enter Password *</label>
	<input id="pword" type="password" name="Passwordagain">
  
  <input type="submit" value="Create">
</form>
<br><br><a href="index.php">Home</a>

</body>
</html>

