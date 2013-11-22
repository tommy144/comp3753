<?php 
  session_start();

  if (!$_SESSION['admin']) {
    header("Location: index.php?flag=3");
    die();
  }

  try {
    $conn = new PDO('mysql:host=localhost;dbname=bookstore', 'root', 'steeze');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare('SELECT DISTINCT book.*, department.Name, join_Book_Section.Course_Number FROM (book join join_Book_Section ON book.ISBN = join_Book_Section.Book_ISBN) JOIN department ON join_Book_Section.Dept_Code=department.Code');
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
      echo '<td>'.$row['Price'].'</td>';
      echo '<td>'.$row['Name'].' '.$row['Course_Number'].'</td>';
      echo '<td>'.$row['Quantity'].'</td>';
      echo '<td><form method="post" action="update.php?isbn='.$row['ISBN'].'">';
      echo '<input type="number" name="quantity" value="'.$row['Quantity'].'">';
      echo '<input type="submit">';
      echo '</form></td>';
      echo '</tr>';
    }
    echo '</table>';
  } catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
?>
<a href="index.php">Back to Index</a>
