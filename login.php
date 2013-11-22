<?php 
  session_start();
  //echo 'Start, u: '.$_POST['Num'].', p: '.$_POST['Password'].'<br>';

  try {
    $conn = new PDO('mysql:host=localhost;dbname=bookstore', 'root', 'steeze');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare('SELECT Num, Password, Pwsalt, Is_Employee FROM student WHERE Num = :num');
    $stmt->bindParam(':num', $_POST['Num'], PDO::PARAM_INT);
    $stmt->execute();
    
    if ($row = $stmt->fetch()) {
      //print_r($row);
      if (hash('sha256', $_POST['Password'].$row['Pwsalt']) != $row['Password'])
      {
        //Login Failed
        header("Location: index.php?flag=4");
        die();
      }
      else
      {
        $_SESSION['user'] = $_POST['Num'];
        $_SESSION['admin'] = $row['Is_Employee'];
        header("Location: index.php");
        die();
      }
    }
    else
    {
      header("Location: index.php?flag=4");
      die();
    }
  } catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
?>
