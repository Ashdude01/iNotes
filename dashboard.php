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
    <title>Dashboard - iNotes</title>
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
            <h2 class="text-center">Welcome! <a href='account.php'><strong><?php echo $_SESSION['user']?> <i class="bi bi-gear"></i></strong></a></h2>
            <p class="text-center mb-5">What's in your mind today! Write down your todos and start Doing it..</p>
            <div class="flexdiv mt-5">
                <div class="left bg-warning p-5">
                    <!-- Add Note Section -->
                    <h3 class="mb-5"><strong>Add a Note <i class="bi bi-plus-square"></i></strong></h3>
                    <form action="addnote.php" method="post">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><strong>Title</strong></label>
                            <input type="text" name='title' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label"><strong>Description</strong></label>
                            <input type="text" name="description" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="time" class="form-label"><strong>Time</strong></label>
                            <input type="text" name="time" class="form-control" id="time">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Note</button>
                    </form>
                </div>
                <!-- Show Notes Section -->
                <div class="todos right w-100 p-4">
                    <h3 class="mb-4"><strong> My notes <i class="bi bi-card-checklist"></i></strong></h3>
                    <?php
                    include 'config.php';
                    $sql = "SELECT * FROM notes WHERE isdone = 0 AND username = '{$_SESSION['user']}'";
                    $data = mysqli_query($conn, $sql);
                    if ($data->num_rows < 1) {echo "<p class='text-warning'>No Record Found !</p>";} else {

                    while ($todo = mysqli_fetch_assoc($data)) {
                    ?>
                        <div class='form-check'>
                            <input class='form-check-input checkmark check' type='checkbox' id='<?php echo $todo['id'] ?>' />
                            <label class=' form-check-label fs-5' for='<?php echo $todo['id'] ?>'>
                                <b><?php echo $todo['title'] ?></b>
                            </label>
                            <div class="action ms-3">
                                <a href="edit.php?id=<?php echo $todo['id'] ?>"><i class="bi bi-pencil-square"></i></a>
                                <a href="delete.php?id=<?php echo $todo['id'] ?>"><i class="bi bi-trash3-fill"></i></a>
                            </div>
                            <p><span><strong class="text-primary"><i class="bi bi-alarm"></i> <?php echo $todo['time'] ?></strong> - <?php echo $todo['description'] ?></span>
                            <p>
                        </div>
                    <?php }} ?>
                </div>
            </div>
            <!-- Completed Task Section -->
            <div class="completed">
                <div class="accordion accordion-flush" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Completed Tasks
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body text-secondary">
                                <?php
                                $csql = "SELECT * FROM notes WHERE isdone = 1 AND username = '{$_SESSION['user']}'";
                                $cdata = $conn->query($csql);
                                if ($cdata->num_rows < 1) {echo "<p class='text-warning'>No Record Found !</p>";} else {
                                    while ($ctodo = $cdata->fetch_assoc()) {
                                ?>

                                        <div class='form-check'>
                                            <input class='form-check-input checkmark uncheck' type='checkbox' id='<?php echo $ctodo['id'] ?>' checked />
                                            <label class=' form-check-label' for='<?php echo $ctodo['id'] ?>'>
                                                <b><?php echo $ctodo['title'] ?></b>
                                            </label>
                                            <div class="action">
                                                <a href="delete.php?id=<?php echo $ctodo['id'] ?>"><i class="bi bi-trash3-fill"></i></a>
                                            </div>
                                            <span><?php echo $ctodo['description'] ?></span>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </main>
    <?php include 'footer.php' ?>
    <script>
        $(document).ready(function() {

            $(".check").change(function() {
                if (this.checked) {
                    let id = $(this).attr("id");
                    setTimeout(function() {
                        location.href = `check.php?id=${id}`;
                    }, 200);

                }
            });

            $(".uncheck").change(function() {
                if (!this.checked) {
                    let id = $(this).attr("id");
                    setTimeout(function() {
                        location.href = `uncheck.php?id=${id}`;
                    }, 80);

                }
            });
        })
    </script>

</body>

</html>