<?php session_start(); 
  if (!$_SESSION['user'])
  {
    header('Location: index.php');
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
<?php
  try {
    $conn = new PDO('mysql:host=localhost;dbname=bookstore', 'root', 'steeze');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare('');
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
    foreach ($newarr as $row) {
      echo '<tr>';
      echo '<td>'.$row['ISBN'].'</td>';
      echo '<td>'.$row['Title'].'</td>';
      echo '<td>'.$row['Author'].'</td>';
      echo '<td>'.$row['Price'].'</td>';
      echo '<td>'.$row['Quantity'].'</td>';
      echo '<td><input type="checkbox" name="bools" checked></td>';
      echo '</tr>';
    }
    echo '<input type="submit" value="ORDER SELECTED!">';
    echo '</form></table>';


  } catch(PDOException $e) {
    echo 'ERROR ERROR: ' . $e->getMessage();
  }
?>
<?php $isbn = array(123456789,'123abc456');
  $arr = http_build_query(array('isbn' => $isbn));
?>
<form method="post" action="order.php?<?php echo $arr; ?>">
  <input type="hidden" name="quantity" value="1">
  <input type="submit" value="ORDER ALL">
</form>
 
</body>
</html>



