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
    
    echo '<table border="1" cellpadding="5">';
    echo '<tr>';
    echo "<th>Bookstore</th>";
    echo "<th>ISBN</th>";
    echo "<th>Title</th>";
    echo "<th>Author</th>";
    echo "<th>Price</th>";
    echo "<th>Course</th>";
    echo "<th>Quantity</th>";
    echo "<th>NEW QUANTITY</th>";
    echo '</tr>';
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
    }
    $stmt = $conn->prepare('select section.Section_Name, course.Num, department.Name from (section join course course on section.Course_Number = course.Num) join department on department.Code = section.Dept_Code');
    $stmt->execute();

    echo '<tr><form method="post" action="addbook.php">';
    echo '<td><input type="text" name="bookstore" placeholder="Bookstore" value="Acadia"></td>';
    echo '<td><input type="text" name="isbn" placeholder="ISBN"></td>';
    echo '<td><input type="text" name="title" placeholder="Title"></td>';
    echo '<td><input type="text" name="author" placeholder="Author"></td>';
    echo '<td><input type="number" name="price" placeholder="Price (In Pennies!!)"></td>';
    echo '<td><select name="course">';
    echo '<option value="">None</option>';
    while ($ret = $stmt->fetch()) {
    echo '<option>'.$ret['Name'].' '.$ret['Num'].' '.$ret['Section_Name'].'</option>';
    }
    echo '</select></td>';
    echo '<td><input type="number" name="quantity" placeholder="Quantity"></td>';
    echo '<td><input type="submit" value="Add">';
    echo '</form></td>';
    echo '</tr>';
    echo '</table>';
  } catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
?>
<a href="index.php">Back to Index</a>
