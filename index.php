<?php session_start(); ?>
<!DOCTYPE HTML>
<html> 
<body>

<?php

if ($_GET['flag']) {
  if ($_GET['flag'] == 1) { ?>
<div style="background: green; width:100%;">Book(s) ordered successfully!</div>
<?php  } else if ($_GET['flag'] == 2) { ?>
<div style="background: red; width:100%;">Not Logged In!</div>
<?php  } else if ($_GET['flag'] == 3) { ?>
<div style="background: red; width:100%;">Insufficient permission!</div>
<?php  } else if ($_GET['flag'] == 4) { ?>
<div style="background: red; width:100%;">Incorrect Login Credentials!</div>
<?php  } else if ($_GET['flag'] == 5) { ?>
<div style="background: green; width:100%;">Logged out successfully!</div>
<?php }
}

?>

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
<a href="profile.php">Profile</a><br>
<a href="logout.php">Logout</a><br>
<?php if ($_SESSION['admin'] == 1) { ?>
<a href="admin.php">ADMIN</a><br>
<?php } ?>
<?php } ?>

<hr>
<?php /*<a href="#" onclick="window.open('listDepartments.php', 'newwindow', 'width=300, height=500'); return false;">List of Departments</a><hr>
<a href="#" onclick="window.open('listCourses.php', 'newwindow', 'width=700, height=500'); return false;">List by Sections</a><br><hr>
<a href="#" onclick="window.open('listCourses1.php', 'newwindow', 'width=700, height=500'); return false;">List by Courses</a><br> */ ?>

<a href="allbooks.php">All Books</a><br><hr>
<a href="listDepartments.php">List by Department</a><hr>
<a href="listCourses.php">List by Section</a><br><hr>
<a href="listCourses1.php">List by Course</a><br>
<br>
</body>
<footer>A Tom and Jeremy Production, 2013</footer>
</html>
