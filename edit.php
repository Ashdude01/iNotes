<?php
session_start();
if(!isset($_SESSION['user'])){header("Location: /");}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'header.php' ?>
    <main>
        <div class="container mt-5 mb-5">
        <h2 class="mb-5">Edit Note <i class="bi bi-pencil-square"></i></h2>

            <?php

            $id = $_GET['id'];
            include 'config.php';
            $sql = "SELECT * FROM notes WHERE id = $id  AND username = '{$_SESSION['user']}'";
            $query = $conn->query($sql);
            if($query->num_rows < 1){
                echo "No Records Found !";
            }else{
            $note = mysqli_fetch_assoc($query);
            if (isset($_POST['update'])) {
                $id = $_GET['id'];
                $sql = "UPDATE notes SET title = '{$_POST['title']}', description = '{$_POST['description']}', time = '{$_POST['time']}' WHERE id = $id  AND username = '{$_SESSION['user']}'";
                if($conn->query($sql)===TRUE){
                    echo "<div class='alert alert-success fade show' role='alert'>
                    <strong>Updated Successfully</strong></div>";
                }else{
                    echo "<div class='alert alert-danger fade show' role='alert'>
                    <strong>Error Occured! - $conn->error</strong></div>";
                }
                
            }
            ?>
            <!-- Edit Note Section -->
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"><strong>Title</strong></label>
                    <input type="text" name='title' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $note['title'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label"><strong>Description</strong></label>
                    <input type="text" value="<?php echo $note['description'] ?>" name="description" class="form-control" id="exampleInputPassword1" required>
                </div>
                <div class="mb-3">
                    <label for="time" class="form-label"><strong>Time</strong></label>
                    <input type="text" value="<?php echo $note['time'] ?>" name="time" class="form-control" id="time" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                    <label class="form-check-label" for="exampleCheck1">I am Not a Robot</label>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
            <?php }?>
        </div>
    </main>
    <?php include 'footer.php'?>
</body>

</html>