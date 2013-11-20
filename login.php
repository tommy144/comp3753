<?php 
  session_start();

  $db = mysqli('localhost', 'root', 'steeze', 'bookstore');
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }

  if ( !($stmt = $mysqli->prepare("SELECT Num, Password, Pwsalt FROM students WHERE Num=(?)")) ) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
  }

  if (!$stmt->bind_param("i", $_POST['number'])) {
    echo "Bind failed: (".$stmt->errno.") ".$stmt->error;
  }
  if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
  }

  $out_num = NULL;
  $out_pw = NULL;
  $out_pwsalt = NULL;

  if (!$stmt->bind_result($out_num, $out_pw, $out_pwsalt)) {
        echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
  }
	//$out = mysql_query($query) or die('query error ' . mysql_error());
  
  //if ()
?>
