<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
<?php
  try {
    include 'config.php';
    $conn = new PDO('mysql:host=localhost;dbname='.DATABASE, USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $arr = array('ISBN', 'Title', 'Author', 'Price', 'Quantity');

    $field = 'ISBN';
    if (in_array($_GET['field'], $arr)) {
      $direction = (isset($_GET['descending'])) ? 'DESC' : 'ASC';
      $field = $_GET['field'];
    }

    $stmt = $conn->prepare('SELECT * FROM book ORDER BY '.$field.' '.$direction);

    $stmt->execute();
    
    echo "<table><tr>";
    echo '<th><a href="allbooks.php?field=ISBN';
    if ($_GET['field'] && $_GET['field'] == "ISBN" && !isset($_GET['descending']))
      echo '&descending=1';
    echo '">ISBN</th>';

    echo '<th><a href="allbooks.php?field=Title';
    if ($_GET['field'] && $_GET['field'] == "Title" && !isset($_GET['descending']))
      echo '&descending=1';
    echo '">Title</th>';

    echo '<th><a href="allbooks.php?field=Author';
    if ($_GET['field'] && $_GET['field'] == "Author" && !isset($_GET['descending']))
      echo '&descending=1';
    echo '">Author</th>';

    echo '<th><a href="allbooks.php?field=Price';
    if ($_GET['field'] && $_GET['field'] == "Price" && !isset($_GET['descending']))
      echo '&descending=1';
    echo '">Price</th>';

    echo '<th><a href="allbooks.php?field=Quantity';
    if ($_GET['field'] && $_GET['field'] == "Quantity" && !isset($_GET['descending']))
      echo '&descending=1';
    echo '">Quantity</th>';
    echo '<tr>';
    while ($line = $stmt->fetch())
    {
      echo "\t<tr>\n";
      echo "\t\t<td> <a href=bookinfo.php?var=".$line['ISBN'].">".$line['ISBN']."</a><br></td>\n\n";
      echo "\t\t<td> <a href=bookinfo.php?var=".$line['ISBN'].">".$line['Title']."</a><br></td>\n\n";
      echo "\t\t<td> <a href=bookinfo.php?var=".$line['ISBN'].">".$line['Author']."</a><br></td>\n\n";
      echo "\t\t<td> <a href=bookinfo.php?var=".$line['ISBN'].">".$line['Price']."</a><br></td>\n\n";
      echo "\t\t<td> <a href=bookinfo.php?var=".$line['ISBN'].">".$line['Quantity']."</a><br></td>\n\n";
      echo "\t</tr>\n";
    }
    echo "</table>\n";
  } catch (PDOException $e) {
    echo 'ERROR PLS: '.$e->getMessage();
  }
?>
<br>
<a href="index.php">Home</a>

</body>
</html>
