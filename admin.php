<?php 
  session_start();

  if (!$_SESSION['admin']) {
    header("Location: index.php");
    die();
  }

  try {
    $conn = new PDO('mysql:host=localhost;dbname=bookstore', 'root', 'steeze');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare('SELECT * FROM book');
    $stmt->execute();
    
    echo '<table border="1" cellpadding="5">';
    echo '<tr>';
    echo "<th>Bookstore</th>";
    echo "<th>ISBN</th>";
    echo "<th>Title</th>";
    echo "<th>Author</th>";
    echo "<th>Price</th>";
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
