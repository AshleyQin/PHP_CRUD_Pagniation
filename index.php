<!DOCTYPE html>
<?php
include 'db.php';

$page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
$perPage = (isset($_GET['per-page']) && ((int)$_GET['per-page']) <= 20 ? (int)$_GET['per-page'] : 3);

$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

$sql = "select * from tasks limit ".$start.", ".$perPage." ";

$total = $db->query("select * from tasks")->num_rows;

$pages = ceil($total / $perPage);

$rows = $db->query($sql);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oxanium&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>CRUD to-do list</title>
</head>
<body>
    <div class="title text-center mt-5">
        <h1 class="text-secondary">To Do List</h1>
    </div>
    <div class="container mt-5">
        <div class="col-md-12">
            <table class="table table-hover">

            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#editModal"> Add task </button>
            <button type="button" class="btn btn-info float-right mb-2" onclick="print()"> Print </button>
            <div class="modal fade mt-5" id="editModal" tabindex="-1" role="dialog">
                <div class="modal-dialog mt-5" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="add.php">
                                <div class="form-group">
                                    <label>Task Name</label>
                                    <input class="form-control" type="text" required name="task">
                                </div>
                                <button type="submit" name="send" value="Add Task" class="btn btn-success">Save changes</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
                <thead>
                    <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Task</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php while($row = $rows->fetch_assoc()): ?>
                    <th scope="row"><?php echo $row['id']; ?></th>
                    <td class="col-md-10"><?php echo $row['name']; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a>
                    </td>
                    <td>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <ul class="pagination justify-content-center">
                <?php for($i = 1; $i <= $pages; $i++): ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $i; ?>&per-page=<?php echo $perPage;?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>