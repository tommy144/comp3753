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
	session_start(); 
	echo $_GET['input'];
	$link = mysql_connect('localhost', 'root', 'steeze')
    or die('Could not connect: ' . mysql_error());
	mysql_select_db('bookstore') or die('Could not select database');
	//$query = 'select * from student';
	//$query = 'SELECT * FROM department WHERE department.Name="'.$_POST['input'].'"';
	$query = 'SELECT Title
FROM (join_Book_Section JOIN book on join_Book_Section.Book_ISBN=book.ISBN)
JOIN department
ON department.Code=join_Book_Section.Dept_Code
WHERE department.Name="'.$_POST['input'].'"';
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
?>
</p>

</body>

</html>


