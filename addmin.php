<?php 
  session_start();

  if (!$_SESSION['admin']) {
    header("Location: index.php?flag=3");
    die();
  }

  try {
    include 'config.php';
    $conn = new PDO('mysql:host=localhost;dbname='.DATABASE, USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare('select Distinct book.ISBN, book.Title, book.Author, book.Price, book.Quantity, book.Bookstore_Name, join_Book_Section.Course_Number, department.Name from (book left join join_Book_Section on book.ISBN = join_Book_Section.Book_ISBN) left join department on join_Book_Section.Dept_Code=department.Code');
    $stmt->execute();
	$stmt2 = $conn->prepare('SELECT * FROM bookstore');
	$stmt2->execute();
	$stmt3 = $conn->prepare('SELECT * FROM (course join department on department.Code=course.Dept_Code) JOIN section on course.Num=section.Course_Number');
    $stmt3->execute();

/*	echo '<table border="1" cellpadding="5">';
    echo '<tr>';
    echo "<th>Bookstore</th>";
    echo "<th>ISBN</th>";
    echo "<th>Title</th>";
    echo "<th>Author</th>";
    echo "<th>Price</th>";
    echo "<th>Course</th>";
    echo "<th>Quantity</th>";
    echo "<th>NEW QUANTITY</th>";
    echo '</tr>';*/
/*
    while ($row = $stmt->fetch()) {
      echo '<tr>';
      echo '<td>'.$row['Bookstore_Name'].'</td>';
      echo '<td>'.$row['ISBN'].'</td>';
      echo '<td>'.$row['Title'].'</td>';
      echo '<td>'.$row['Author'].'</td>';
      echo '<td>$'.($row['Price']/100).'</td>';
      echo '<td>'.$row['Name'].' '.$row['Course_Number'].'</td>';
      echo '<td>'.$row['Quantity'].'</td>';
      echo '<td><form method="post" action="update.php?isbn='.$row['ISBN'].'">';
      echo '<input type="number" name="quantity" value="'.$row['Quantity'].'">';
      echo '<input type="submit">';
      echo '</form></td>';
      echo '</tr>';
    }*/
   // echo '</table>';
  } catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
	echo '<p>';
	//Select book store dropdown
	echo '<select>';
	while ($row = $stmt2->fetch())
	{
		echo '<option value="'.$row[Name].'">'.$row[Name].'</option>';
	}
	echo '</select>';
	
		
//Book info
	echo '<form>
<input type="text" name="ISBN" value="">ISBN<br>
</form>';
	
	echo '<form>
<input type="text" name="TITLE" value="">Title<br>
</form>';

	echo '<form>
<input type="text" name="Author" value="">ISBN<br>
</form>';
	
	echo '<form>
<input type="number" name="Price" value="">Price<br>
</form>';

	echo '<select>';	
    while ($row = $stmt3->fetch()) 
	{
		echo '<option value='.$row[Name].'+'.$row[Code].'+'.$rot[Section_Name].'>'.$row[Name].' '.$row[Code].' '.$row[Section_Name].'</option>';
	}
	
	echo '</select>';	

	echo '<form>
<input type="number" name="Quantity" value="">Quantity<br>
</form>';

?>
<p>
<a href="index.php">Back to Index</a>
