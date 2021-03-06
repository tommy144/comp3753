<?php 
  session_start();

  if (!$_SESSION['admin']) {
    header("Location: index.php?flag=3");
    die();
  }
  if ($_POST['quantity'] < 0) {
    header("Location: admin.php");
    die();
  }

  try {
    include 'config.php';
    $conn = new PDO('mysql:host=localhost;dbname='.DATABASE, USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare('UPDATE book SET Quantity = :quantity WHERE ISBN = :isbn');
    $stmt->bindParam(':quantity', $_POST['quantity'], PDO::PARAM_INT);
    $stmt->bindParam(':isbn', $_GET['isbn'], PDO::PARAM_STR);
    $stmt->execute();
    
    header("Location: admin.php");
    die();

  } catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
?>
