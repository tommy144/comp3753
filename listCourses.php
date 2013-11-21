<?php
	session_start();
?>
<!DOCTYPE HTML>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <title></title>
</head>

<body>

<form method="get" action="listDepartments.php">

<h1></h1>
<p>
<?php
	$link = mysql_connect('localhost', 'root', 'steeze')
    or die('Could not connect: ' . mysql_error());
	mysql_select_db('bookstore') or die('Could not select database');
	$query = "SELECT Num, Title, Dept_Code Description FROM course ORDER BY Title";
	$out = mysql_query($query) or die('query error ' . mysql_error());
	$col_value;
	echo "<table>\n";
	while ($line = mysql_fetch_array($out, MYSQL_ASSOC)) 
	{
    	
		echo "\t<tr>\n";
		
		echo "\t\t<td>";
		echo "<a href=listsection.php?var=".$line[Num]."&var2=".$line[Dept_Code].">".$line[Num]."</a>";
		echo "</td>\n";
    	
		echo "\t\t<td>";
//		echo "<a href=book.php?var=".$line[Num].">".$line[Title]."</a>";

		echo "<a href=listsection.php?var=".$line[Num]."&var2=".$line[Dept_Code].">".$line[Title]."</a>";
		echo "</td>\n";
		
		echo "\t\t<td>";
		echo $line[Description];
		echo "</td>\n";
		
		echo "\t</tr>\n";
	}
	echo "</table>\n";

	mysql_free_result($query);
	mysql_close($link);
?>
</p>

</body>

</html>


