<!-- Take all info from db_conn.php file and put it into index.php -->
<?php require 'db_conn.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To Do List</title>
  <link rel="stylesheet" href="css/style.css" >
</head>

<body>
  <h1> My To Do List</h1>

  <div class="main-section">
    <div class="add-section" >
      <form action="app/add.php" method="POST" autocomplete="off" >
        <!-- Beginning of if/else statement -->
        <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){?>
          <input type="text" name="title" style="border-color: red" placeholder="this field is required!"/>
          <button type="submit">
            Add &nbsp; <span> &#43;</span>
          </button>
        <?php } else { ?>
          <input type="text" name="title" placeholder="What do you need to do today?"/>
          <button type="submit">
            Add &nbsp; <span> &#43;</span>
          </button>
        <!-- End of If/Else statement-->
        <?php } ?>
      </form>
    </div>

    <!-- Sql query to grab all info from database, in descending order -->
    <?php $todo = $conn->query("SELECT * FROM todo ORDER BY id desc"); ?>

    <div class="show-todo-section">
      <!-- If Row Count is Less than or equal to 0, display contents of h1 tag below -->
      <?php if($todo->rowCount() <= 0) { ?>

      <div class="todo-item"> 
        <div class="empty">
          <h1> Nothing to do </h1>
        </div>
      </div>
      <!-- If Statement Ending Brace -->
      <?php } ?>

      <?php while($todos = $todo->fetch(PDO::FETCH_ASSOC)) { ?>

      <div class="todo-item"> 
        <span id="<?php echo $todos['id'];?>" class="remove-to-do">
          x
        </span>

        <!-- if Checked -->
        <?php if($todos['checked']){ ?>
        <input type="checkbox" data-todo-id = "<?php echo $todos['id']; ?>" class="check-box" checked />
        <h3 class="checked">
        <!-- Access Column 'title' and displaying it in a h3 tag -->
        <?php echo $todos['title'] ?>
        </h3>
      <!-- Closing If Statement Brace -->
        <?php } else { ?>
        <input type="checkbox" data-todo-id="<?php echo $todos['id']; ?>" class="check-box" />
        <h3>
        <!-- Access Column 'title' and displaying it in a h3 tag -->
        <?php echo $todos['title'] ?>
        </h3>

        <?php } ?>

        <br>
        <small> Created: <?php echo $todos['date_time'] ?> </small>
        </div>

      <!-- Ending Loop Brace -->
        <?php } ?>

    </div>

  </div>

  <script src="js/jquery.js"> </script>

  <!-- jQuery Functions below-->
  <script> 
    $(document).ready(function(){
      $(".remove-to-do").click(function(){
        const id = $(this).attr("id");
        
        $.post("app/remove.php", 
        {
          id: id

        },
        (data) => {
         if(data){
           $(this).parent().hide(600);
         }
        }
        
        );
      }); //End of Click Function for .remove-to-do

      $(".check-box").click(function(e){
        const id = $(this).attr("data-todo-id");

        $.post("app/check.php",
        {
          id: id
        },
        (data) => {
          if(data != 'error'){
            const h2 = $(this).next();

            if(data === '1'){
              h2.removeClass("checked");

            }else{
              h2.addClass("checked");

            }
          }
        }
        
        );
        
      }); //End of Click Function for .check-box


    }); //End of Document.Ready
  </script>
  
</body>

</html>