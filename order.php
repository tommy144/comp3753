<?php session_start();

  if (!$_SESSION['user'] || $_POST['quantity'] <= 0) {
    header("Location: index.php");
    die();
  }

  //print_r($_GET['isbn']);
  //echo '<br>';

  try {
    $conn = new PDO('mysql:host=localhost;dbname=bookstore', 'root', 'steeze');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare('SELECT MAX(Num) AS Num FROM orderb');
    $stmt->execute();
    
    if (!($num = $stmt->fetch()))
      $next = 1;
    else
      $next = 1 + $num['Num'];
    
    $stmt = $conn->prepare('INSERT INTO orderb (Num, ODate, Student_Num, Bookstore_Name) 
      VALUES (:next, CURDATE(), :stu, "Acadia")');
    $stmt->bindParam(':next', $next, PDO::PARAM_INT);
    $stmt->bindParam(':stu', $_SESSION['user'], PDO::PARAM_INT);
    $stmt->execute();

    foreach ($_GET['isbn'] as $isbn) {
      $stmt = $conn->prepare('SELECT Quantity FROM book WHERE ISBN = :isbn_book');
      $stmt->bindParam(':isbn_book', $isbn, PDO::PARAM_STR);
      $stmt->execute();
      if (!$var = $stmt->fetch())
        continue;
      else {
        if ($var['Quantity'] <= 0 || $var['Quantity'] < $_POST['quantity'])
        {
          print_r($var);
          echo 'VAR: '.$var['Quantity'].' junks: '.$_POST['quantity'];
          continue;
        }
      }

      $stmt = $conn->prepare('SELECT MAX(Num) AS Num FROM lineitem');
      $stmt->execute();
      if (!$num = $stmt->fetch())
        $linenext = 1;
      else
        $linenext = 1 + $num['Num'];
      
      $stmt = $conn->prepare('INSERT INTO lineitem (Num, Quantity, Order_Number, Student_Number, Item_ISBN, Bookstore_Name)
        VALUES (:num, :quantity, :order_num, :student_num, :isbn, "Acadia")');
      $stmt->bindParam(':num', $linenext, PDO::PARAM_INT);
      $stmt->bindParam(':quantity', $_POST['quantity'], PDO::PARAM_INT);
      $stmt->bindParam(':order_num', $next, PDO::PARAM_INT);
      $stmt->bindParam(':student_num', $_SESSION['user'], PDO::PARAM_INT);
      $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR); 
      $stmt->execute();

      $stmt = $conn->prepare('UPDATE book SET Quantity = Quantity - :quan WHERE ISBN = :isbn_update');
      $stmt->bindParam(':quan', $_POST['quantity'], PDO::PARAM_INT);
      $stmt->bindParam(':isbn_update', $isbn, PDO::PARAM_STR); 
      $stmt->execute();
    }

    header("Location: index.php");
    die();

  } catch(PDOException $e) {
    echo 'ERROR ERROR: ' . $e->getMessage();
  }

?>
