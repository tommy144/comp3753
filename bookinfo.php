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
        echo '<h3> Title: '.$line['Title'].'</h3>';
        echo '<h3> Author: '.$line['Author'].'</h3>';
        echo '<h3> ISBN: '.$line['ISBN'].'</h3>';
        echo '<h3> Price: '.$line['Price'].'</h3>';
        echo '<h3> Quantity: '.$line['Quantity'].'</h3>';
    } else {
      echo 'Not a valid book, guy.';
    }

  } catch (PDOException $e) {
    echo 'ERROR PLS: '.$e->getMessage();
  }
/*
	echo $_GET['var'];
	$link = mysql_connect('localhost', 'root', 'steeze')
    or die('Could not connect: ' . mysql_error());
	mysql_select_db('bookstore') or die('Could not select database');
	//$query = 'select * from student';
	//$query = 'SELECT * FROM department WHERE department.Name="'.$_POST['input'].'"';
	$query = 'SELECT Title
FROM (join_Book_Section JOIN book on join_Book_Section.Book_ISBN=book.ISBN)
JOIN department
ON department.Code=join_Book_Section.Dept_Code
WHERE book.Title="'.$_GET['var'].'"';
	//echo $query;
	$out = mysql_query($query) or die('query error ' . mysql_error());

	echo "<table>\n";
	while ($line = mysql_fetch_array($out, MYSQL_ASSOC)) 
	{
    	echo "\t<tr>\n";
    	foreach ($line as $col_value)
		{
       		echo "\t\t<td>$col_value</td>\n";
    	}
    	echo "\t</tr>\n";
	}
	echo "</table>\n";

	mysql_free_result($query);
	mysql_close($link);
*/
?>
</p>

</body>

</html>


