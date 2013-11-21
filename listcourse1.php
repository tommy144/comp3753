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
    
    $stmt = $conn->prepare('select * from section join course on section.Course_Number=course.Num where course.Num=:var ');
    $stmt->bindParam(':var', $_GET['var'], PDO::PARAM_STR);
    $stmt->execute();
	
	$stmt2 = $conn->prepare('SELECT DISTINCT ISBN, Title, Author, Price, Quantity  FROM join_Book_Section JOIN book ON book.ISBN=join_Book_Section.Book_ISBN WHERE join_Book_Section.Course_Number=:cnum');
	$stmt2->bindParam(':cnum', $_GET['var'], PDO::PARAM_STR);
    $stmt2->execute();
	echo "<table>\n";
    while ($line = $stmt->fetch())
    {
      	echo "\t<tr>\n";
		echo "\t\t<td> <a href=book1.php?Course_Num=".$line[Num]."&Section_Num=".$line[0].">".$line[Title]." ".$line[Section_Name]."</a><br></td>\n\n";


      //echo "\t\t<td> <a href=bookinfo.php?var=".$line['ISBN'].">".$line['Section_Name']."</a><br></td>\n\n";
      //echo "\t\t<td> <a href=bookinfo.php?var=".$line['ISBN'].">".$line['Title']."</a><br></td>\n\n";
      echo "\t</tr>\n";
    }
    echo "</table>\n";
	echo "<hr>";
    echo "<table>\n";
    while ($line = $stmt2->fetch())
    {
      echo "\t<tr>\n";
      echo "\t\t<td> <a href=bookinfo.php?var=".$line['ISBN'].">".$line['ISBN']."</a><br></td>\n\n";
      echo "\t\t<td> <a href=bookinfo.php?var=".$line['ISBN'].">".$line['Title']."</a><br></td>\n\n";
      echo "\t</tr>\n";
    }
    echo "</table>\n";

  } catch (PDOException $e) {
    echo 'ERROR PLS: '.$e->getMessage();
  }
?>

</body>

</html>


