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
	echo $_GET['var'];
  try {
    $conn = new PDO('mysql:host=localhost;dbname=bookstore', 'root', 'steeze');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->('SELECT Title
      FROM (join_Book_Section JOIN book on join_Book_Section.Book_ISBN=book.ISBN)
      JOIN department
      ON department.Code=join_Book_Section.Dept_Code
      WHERE book.Title = :title');
 
    $stmt->bindParam(':title', $_GET['var'], PDO::PARAM_STR);
    $stmt->execute();
    echo "<table>\n";
    while ($line = $stmt->fetch())
    {
        echo "\t<tr>\n";
        foreach ($line as $col_value)
        {
            echo "\t\t<td>$col_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";

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


