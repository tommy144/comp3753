<?php session_start();
/*
  echo '<pre>';
  var_dump($_POST);
  echo '</pre>';
  echo '<br>';
  echo $_POST['bookstore'].'<br>';
  echo $_POST['isbn'].'<br>';
  echo $_POST['title'].'<br>';
  echo $_POST['author'].'<br>';
  echo $_POST['price'].'<br>';
  echo $_POST['course'].'<br>';
  echo $_POST['quantity'].'<br>';
  $arr = explode(" ", $_POST['course']);
  echo '<pre>';
  var_dump($arr);
  echo '</pre>';
 */
	if (!$_SESSION['admin'])
	{
		header("Location: index.php?flag=3");
		die();
  }

  if ($_POST['quantity'] < 0)
  {
    header("Location: admin.php");
    die();
  }
  
  try
	{
    include 'config.php';
    $conn = new PDO('mysql:host=localhost;dbname='.DATABASE, USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_POST['Title'] == "") {
			$arr = explode(" ", $_POST['course']);
      $stmt = $conn->prepare('INSERT INTO join_Book_Section (Book_ISBN, Section_Number, Dept_Code, Course_Number) 
        VALUES (:isbn, :section, :dept, :course)');
      $stmt->bindParam(':isbn', $_POST['isbn'], PDO::PARAM_STR);
      $stmt->bindParam(':section', $arr[2], PDO::PARAM_INT);
      $stmt->bindParam(':dept', $arr[0], PDO::PARAM_INT);
      $stmt->bindParam(':course', $arr[1], PDO::PARAM_INT);
      $stmt->execute();
      
      header("Location: admin.php");
      die();
    }

    $stmt = $conn->prepare('INSERT INTO book (ISBN, Title, Author, Price, Quantity, Bookstore_Name) 
      VALUES (:isbn, :title, :author, :price, :quantity, :bookstore)');
    $stmt->bindParam(':isbn', $_POST['isbn'], PDO::PARAM_STR);
    $stmt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
    $stmt->bindParam(':author', $_POST['author'], PDO::PARAM_STR);
    $stmt->bindParam(':price', $_POST['price'], PDO::PARAM_INT);
    $stmt->bindParam(':quantity', $_POST['quantity'], PDO::PARAM_INT);
    $stmt->bindParam(':bookstore', $_POST['bookstore'], PDO::PARAM_STR);
		$stmt->execute();
		
		if ($_POST['course'] != "")
		{
			$arr = explode(" ", $_POST['course']);
      $stmt = $conn->prepare('INSERT INTO join_Book_Section (Book_ISBN, Section_Number, Dept_Code, Course_Number) 
        VALUES (:isbn, :section, :dept, :course)');
      $stmt->bindParam(':isbn', $_POST['isbn'], PDO::PARAM_STR);
      $stmt->bindParam(':section', $arr[2], PDO::PARAM_INT);
      $stmt->bindParam(':dept', $arr[0], PDO::PARAM_INT);
      $stmt->bindParam(':course', $arr[1], PDO::PARAM_INT);
      $stmt->execute();
    }

    header("Location: admin.php");
    die();

  } catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
?>
