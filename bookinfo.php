<?php session_start(); ?>
<!DOCTYPE HTML>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <title></title>
</head>

<body>

<h1></h1>
<p>
<?php
  try {
    $conn = new PDO('mysql:host=localhost;dbname=bookstore', 'root', 'steeze');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare('SELECT * FROM book WHERE ISBN = :isbn');
 
    $stmt->bindParam(':isbn', $_GET['var'], PDO::PARAM_STR);
    $stmt->execute();

    echo "<table>\n";
    if ($line = $stmt->fetch())
    {
      $price = $line['Price']/100;
      echo '<h1>'.$line['Title'].'</h1>';
      echo '<h3>'.$line['Author'].'</h3>';
      echo '<p>ISBN: '.$line['ISBN'].'</p>';
      echo '<p><strong>Price</strong>: $'.$price.'</p>';
      echo '<p><strong>Available Quantity</strong>: '.$line['Quantity'].'</p>';
      echo '<form method="post" action="order.php?isbn='.$row['ISBN'].'">';
      echo '<input type="number" name="quantity">';
      echo '<input type="submit">';
      echo '</form>';
    } else {
      echo 'Not a valid book, guy.';
    }

  } catch (PDOException $e) {
    echo 'ERROR PLS: '.$e->getMessage();
  }
?>
</p>

</body>

</html>


