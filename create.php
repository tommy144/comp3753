<?php 
  session_start();

  if ($_POST['Password'] != $_POST['Passwordagain']) {
    header("Location: register.php?flag=1");
    die();
  } else if (!$_POST['Num'] || !$_POST['Password'] || !$_POST['Passwordagain']) {
    header("Location: register.php?flag=1");
    die();
  }

  try {
    $conn = new PDO('mysql:host=localhost;dbname=bookstore', 'root', 'steeze');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare('SELECT * FROM student WHERE Num = :number');
    $stmt->bindParam(':number', $_POST['Num'], PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->fetch()) {
      header("Location: index.php?flag=7");
      die();
    }
    srand(mktime());
    $salt = rand();
    $pw = hash('sha256', $_POST['Password'].$salt);
    
    $stmt = $conn->prepare('INSERT INTO student (Num, Name, Is_Employee, Pwsalt, Password)
      VALUES (:num, :name, 0, :salt, :pw)');
    $stmt->bindParam(':num', $_POST['Num'], PDO::PARAM_INT);
    $stmt->bindParam(':name', $_POST['Name'], PDO::PARAM_STR);
    $stmt->bindParam(':salt', $salt, PDO::PARAM_INT);
    $stmt->bindParam(':pw', $pw, PDO::PARAM_STR);
    $stmt->execute();

    $_SESSION['user'] = $_POST['Num'];
    
    header("Location: index.php?flag=8");
    die();

  } catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
?>
