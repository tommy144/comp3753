<?php session_start(); 
  if (!$_SESSION['user'])
  {
    header('Location: index.php?flag=2');
    die();
  }
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
<a href="index.php">Home</a><br><br>
<?php
  try {
    $conn = new PDO('mysql:host=localhost;dbname=bookstore', 'root', 'steeze');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare('SELECT book.* FROM ((student JOIN join_Student_Section ON student.Num=join_Student_Section.Student_Number) JOIN join_Book_Section ON join_Student_Section.Section_Number=join_Book_Section.Section_Number AND join_Student_Section.Course_Number=join_Book_Section.Course_Number) JOIN book ON book.ISBN=join_Book_Section.Book_ISBN WHERE student.Num=:student');
    $stmt->bindParam(':student', $_SESSION['user'], PDO::PARAM_INT);
    $stmt->execute();

    $arr = array();
    $newarr = array();

    while ($row = $stmt->fetch()) {
      array_push($newarr, $row);
      array_push($arr, $row['ISBN']);
    }
    $arr = http_build_query(array('isbn' => $arr));
 
    echo '<table border="1" cellpadding="5">';
    echo '<form method="post" action="order.php?'.$arr.'">';
    echo '<tr>';
    echo "<th>ISBN</th>";
    echo "<th>Title</th>";
    echo "<th>Author</th>";
    echo "<th>Price</th>";
    echo "<th>Quantity</th>";
    echo "<th>Order?</th>";
    echo '</tr>';
    $index = 0;
    foreach ($newarr as $row) {
      echo '<tr>';
      echo '<td>'.$row['ISBN'].'</td>';
      echo '<td>'.$row['Title'].'</td>';
      echo '<td>'.$row['Author'].'</td>';
      echo '<td>'.$row['Price'].'</td>';
      echo '<td>'.$row['Quantity'].'</td>';
      echo '<td><input type="checkbox" name="bools'.$index.'" checked></td>';
      echo '</tr>';
      $index++;
    }
    echo '<input type="hidden" name="quantity" value="1">';
    echo '<input type="submit" value="ORDER SELECTED!">';
    echo '</form></table>';
    echo '<hr><hr>';


    $stmt = $conn->prepare('select orderb.Num, orderb.ODate, lineitem.Num, book.*, lineitem.Quantity from (orderb join lineitem on orderb.Num=lineitem.Order_Number) join book on lineitem.Item_ISBN=book.ISBN where orderb.Student_Num=:stud');
    $stmt->bindParam(':stud', $_SESSION['user'], PDO::PARAM_INT);
    $stmt->execute();
    if ($row = $stmt->fetch()) {
      $var = $row[0];
      echo '<h3>ORDERS</h3>';
      echo '<table border="1"><tr><th>Order '.$row[0].' on '.$row['ODate'].'</th></tr>
        <tr>
        <td>'.$row['ISBN'].'</td>
        <td>'.$row['Title'].'</td>
        <td>'.$row['Author'].'</td>
        <td>'.$row['Quantity'].'</td>
        <td>$'.($row['Price']/100).'</td>
        </tr>';
      while ($row1 = $stmt->fetch()) {
        if ($var == $row1[0]) {
          echo '<tr>
          <td>'.$row1['ISBN'].'</td>
          <td>'.$row1['Title'].'</td>
          <td>'.$row1['Author'].'</td>
          <td>'.$row['Quantity'].'</td>
          <td>$'.($row1['Price']/100).'</td>
          </tr>';
        } else {
          $var = $row1[0];
          echo '</table><br><hr><br>';
          echo '<table border="1"><tr><th>Order '.$row1[0].' on '.$row1['ODate'].'</th></tr>
            <tr>
            <td>'.$row1['ISBN'].'</td>
            <td>'.$row1['Title'].'</td>
            <td>'.$row1['Author'].'</td>
            <td>'.$row['Quantity'].'</td>
            <td>$'.($row1['Price']/100).'</td>
            </tr>';
        }
      }
      echo '</table>';
    }


  } catch(PDOException $e) {
    echo 'ERROR ERROR: ' . $e->getMessage();
  }
?>
<a href="index.php">Home</a>
</body>
</html>



