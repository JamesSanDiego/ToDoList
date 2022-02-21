<?php 

#Check if POST variable is available
if(isset($_POST['id'])){
  require '../db_conn.php';

  $id = $_POST['id'];

  if(empty($id)){
    echo "error";
  }else{
    $todos = $conn->prepare("SELECT id, checked FROM todo WHERE id=?");
    $todos->execute([$id]);

    $todo = $todos->fetch();
    $uId = $todo["id"];
    $checked = $todo["checked"];

    $uChecked = $checked ? 0 : 1;

    $res = $conn->query("UPDATE todo SET checked=$uChecked WHERE id=$uId");

    if($res){
      echo $checked;
    }else{
      echo "error";
    }

    #Close Connection with Database
    $conn = null;
    exit();

  }
} else{
  header("Location: ../index.php?mess=error");
}

?>