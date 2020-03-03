<!DOCTYPE html>
<?php
    include 'db.php';

    $id = (int)$_GET['id'];

    $sql = "select * from tasks where id='$id'";

    $rows = $db->query($sql);

    $task = $rows->fetch_assoc();


    if(isset($_POST['send'])){
        $name = htmlspecialchars($_POST['task']);

        $sql2 = "update tasks set name='$name' where id='$id'";
        
        $val = $db->query($sql2);

        if($val){
            header('location: index.php');
        }
    }

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>CRUD to-do list</title>
</head>
<body>
    <div class="title text-center mt-5">
        <h1>Update Task</h1>
    </div>
    <div class="container mt-5">
        <div class="col-md-12">       
            <form method="post">
                <div class="form-group">
                    <label>Task Name</label>
                    <input class="form-control" value="<?php echo $task['name']?>" type="text" required name="task">
                </div>
                <button type="submit" name="send" class="btn btn-success col-md-2">Update Task</button>
                <a href="index.php" class="btn btn-secondary col-md-2">Cancle</a>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>