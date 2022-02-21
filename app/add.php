<?php 

#Check if POST variable is available
if(isset($_POST['title'])){
  require '../db_conn.php';

  $title = $_POST['title'];

  if(empty($title)){
    header("Location: ../index.php?mess=error");
  }else{
    $stmt = $conn ->prepare("INSERT INTO todo(title) VALUE(?)");
    $res = $stmt->execute([$title]);

    #If able to execute the SQL statement display mess=success
    if($res){
      header("Location: ../index.php?mess=success");

    }else{
      header("Location: ../index.php");

    }

    #Close Connection with Database
    $conn = null;
    exit();

  }
} else{
  header("Location: ../index.php?mess=error");
}

?>