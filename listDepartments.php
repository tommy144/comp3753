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
	include 'config.php';
	$link = mysql_connect('localhost', USERNAME, PASSWORD)
    or die('Could not connect: ' . mysql_error());
	mysql_select_db(DATABASE) or die('Could not select database');
	$query = "SELECT Name FROM department ORDER BY Name";
	$out = mysql_query($query) or die('query error ' . mysql_error());

	echo "<table>\n";
	while ($line = mysql_fetch_array($out, MYSQL_ASSOC)) 
	{
    	echo "\t<tr>\n";
    	foreach ($line as $col_value)
		{
       		echo "\t\t<td>";
			echo "<a href=listBooksforDept.php?var=".$col_value.">".$col_value."</a>";
			echo "</td>\n";
    	}
    	echo "\t</tr>\n";
	}
	echo "</table>\n";

	mysql_free_result($query);
	mysql_close($link);
?>
</p>
<a href="index.php">Home</a>

</body>

</html>


