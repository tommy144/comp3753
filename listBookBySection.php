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
    
    $stmt = $conn->prepare('SELECT * FROM (join_Book_Section join section on section.Num=join_Book_Section.Section_Number) join book on book.ISBN=join_Book_Section.Book_ISBN WHERE join_Book_Section.Section_Number=:SECT AND join_Book_Section.Course_Number=:COURSE');
    $stmt->bindParam(':COURSE', $_GET['Course_Num'], PDO::PARAM_STR);
    $stmt->bindParam(':SECT', $_GET['Section_Num'], PDO::PARAM_STR);
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


