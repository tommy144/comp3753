<?php
session_start(); ?>
<!DOCTYPE HTML>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <title></title>
</head>

<body>

<h1></h1>
<?php
  try {
    $conn = new PDO('mysql:host=localhost;dbname=bookstore', 'root', 'steeze');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare('SELECT DISTINCT ISBN, Title FROM (join_Book_Section JOIN book on join_Book_Section.Book_ISBN=book.ISBN) JOIN department ON department.Code=join_Book_Section.Dept_Code WHERE department.Name = :dept');

    $stmt->bindParam(':dept', $_GET['var'], PDO::PARAM_STR);
    $stmt->execute();
    
    echo "<table>\n";
    while ($line = $stmt->fetch())
    {
      echo "\t<tr>\n";
      echo "\t\t<td> <a href=bookinfo.php?var=".$line['ISBN'].">".$line['ISBN']."</a><br></td>\n\n";
      echo "\t\t<td> <a href=bookinfo.php?var=".$line['ISBN'].">".$line['Title']."</a><br></td>\n\n";
      echo "\t\t<td> <a href=bookinfo.php?var=".$line['ISBN'].">".$line['Author']."</a><br></td>\n\n";
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


