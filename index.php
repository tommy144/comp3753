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
<h3>Welcome <?php echo $_SESSION['user']; ?></h3>
<a href="logout.php">Logout</a><br>
<?php if ($_SESSION['admin'] == 1) { ?>
<a href="admin.php">ADMIN</a><br>
<?php } ?>
<?php } ?>

<hr>

<a href="#" onclick="window.open('listDepartments.php', 'newwindow', 'width=300, height=500'); return false;">List of Departments</a>

<hr>
<a href="#" onclick="window.open('listCourses.php', 'newwindow', 'width=700, height=500'); return false;">List by Sections</a>
<br>

<hr>
<a href="#" onclick="window.open('listCourses1.php', 'newwindow', 'width=700, height=500'); return false;">List by Courses</a>
<br>

<?php $isbn = array(123456789,'123abc456');
  $arr = http_build_query(array('isbn' => $isbn));
?>
<form method="post" action="order.php?<?php echo $arr; ?>">
  <input type="hidden" name="quantity" value="1">
  <input type="submit" value="ORDER ALL">
</form>

<br>

<a href="allbooks.php">All Books</a>
<p></p>
</body>
<footer>A Tom and Jeremy Production, 2013</footer>
</html>
