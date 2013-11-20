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
    
    $stmt = $conn->('SELECT ISBN, Title
      FROM (join_Book_Section JOIN book on join_Book_Section.Book_ISBN=book.ISBN)
      JOIN department
      ON department.Code=join_Book_Section.Dept_Code
      WHERE department.Name = :dept');

    $stmt->bindParam(':dept', $_GET['var'], PDO::PARAM_STR);
    $stmt->execute();

    echo "<table>\n";
    while ($line = $stmt->fetch())
    {
        echo "\t<tr>\n";
        //echo $line[1];
      $i = 1;
      foreach ($line as $col_value)
      {
            
        echo "\t\t<td> <a href=bookinfo.php?var=".$col_value.">".$col_value."</a></td>\n";
        
        $i++;
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";

  } catch (PDOException $e) {
    echo 'ERROR PLS: '.$e->getMessage();
  }


/*
	$link = mysql_connect('localhost', 'root', 'steeze')
    or die('Could not connect: ' . mysql_error());
	mysql_select_db('bookstore') or die('Could not select database');
	//$query = 'select * from student';
	//$query = 'SELECT * FROM department WHERE department.Name="'.$_POST['input'].'"';
	$query = 'SELECT ISBN, Title
FROM (join_Book_Section JOIN book on join_Book_Section.Book_ISBN=book.ISBN)
JOIN department
ON department.Code=join_Book_Section.Dept_Code
WHERE department.Name="'.$_GET['var'].'"';
	//echo $query;
	$out = mysql_query($query) or die('query error ' . mysql_error());

	echo "<table>\n";
	while ($line = mysql_fetch_array($out, MYSQL_ASSOC)) 
	{
    	echo "\t<tr>\n";
    	//echo $line[1];
		$i = 1;
		foreach ($line as $col_value)
		{
       		
			echo "\t\t<td> <a href=bookinfo.php?var=".$col_value.">".$col_value."</a></td>\n";
			
			$i++;
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


