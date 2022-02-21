<?php 

#Check if POST variable is available
if(isset($_POST['id'])){
  require '../db_conn.php';

  $id = $_POST['id'];

  if(empty($id)){
    echo 0;
  }else{
    $stmt = $conn ->prepare("DELETE FROM todo WHERE id=?");
    $res = $stmt->execute([$id]);

    if($res){
      echo 1;

    }else{
      echo 0;

    }

    #Close Connection with Database
    $conn = null;
    exit();

  }
} else{
  header("Location: ../index.php?mess=error");

}

?>