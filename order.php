<?php session_start();


  if (!$_SESSION['user']) {
    header("Location: index.php");
    die();
  }

  print_r($_GET['isbn']);
  echo '<br>';

  try {
    $conn = new PDO('mysql:host=localhost;dbname=bookstore', 'root', 'steeze');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt0 = $conn->prepare('SELECT MAX(Num) AS Num FROM orderb');
    $stmt0->execute();
    
    if (!($num = $stmt0->fetch()))
      $next = 1;
    else
      $next = 1 + $num['Num'];
    
    $stmt = $conn->prepare('INSERT INTO orderb (Num, ODate, Student_Num, Bookstore_Name) 
      VALUES (:next, CURDATE(), :stu, "Acadia")');
    $stmt->bindParam(':next', $next, PDO::PARAM_INT);
    $stmt->bindParam(':stu', $_SESSION['user'], PDO::PARAM_INT);
    $stmt->execute();

    foreach ($_GET['isbn'])  
    $stmt1 = $conn->prepare('INSERT INTO lineitem');

  } catch(PDOException $e) {
    echo 'ERROR ERROR: ' . $e->getMessage();
  }

?>
