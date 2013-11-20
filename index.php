<?php session_start(); ?>
<!DOCTYPE HTML>
<html> 
<body>
<h1>Bookstore Junk</h1>

<?php
if ($_GET['flag'] == 1)
  echo "<p>INCORRECT LOGIN</p>";
?>

<?php if(!$_SESSION['user']) { ?>
<form method="post" action="login.php">
  <label for="uname">Student Number</label>
	<input id="uname" type="text" name="Num">
  
  <label for="pword">Password</label>
	<input id="pword" type="password" name="Password">
  
  <input type="submit">
</form>

<br>

<?php } else { ?>
<h3>Welcome <?php echo $_SESSION['user']; if ($_SESSION['admin'] == 1) echo "... the ADMIN!"; ?></h3>
<a href="logout.php">Logout</a><br>
<?php } ?>

<a href="#" onclick="window.open('listDepartments.php', 'newwindow', 'width=300, height=500'); return false;">List of Departments</a>

<form method="post" action="book.php">
  <label for="dept">Department</label>
	<input id="dept" type="text" name="dept">
  <input type="submit">
</form>

<hr>
<a href="#" onclick="window.open('listCourses.php', 'newwindow', 'width=700, height=500'); return false;">List of Courses</a>
<br>

<form method="post" action="book1.php">
  <label for="course">Male</label>
	<input id="course" type="text" name="course">
</form>

</body>
</html>
