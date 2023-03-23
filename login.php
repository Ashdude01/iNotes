<?php
session_start();
if(isset($_SESSION['user'])){
    header('Location: dashboard.php');
}else{?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login to iNotes and start adding todos right away">
    <title>Login to iNotes</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include 'header.php';

    ?>
    <main>
        <div class="container mt-5 mb-5">

            <div class="box">
                <!-- Add Note Section -->
                <h2 class="mb-5">Login to iNotes <i class="bi bi-person"></i></h2>
                <?php
                if (isset($_POST['login'])) {
                    include 'config.php';
                    $user_name = mysqli_real_escape_string($conn, $_POST['username']);
                    $pass = mysqli_real_escape_string($conn, $_POST['password']);
                    $check = "SELECT id,username,password FROM user WHERE username = '$user_name'";
                    $res = $conn->query($check);
                    if ($res->num_rows < 1) {
                        echo "<div class='alert alert-danger fade show' role='alert'>
                                <strong>$user_name</strong> is not registered! - <a href='register.php'>Register Now</a></div>";
                    } else {
                        $user = $res->fetch_assoc();
                        if(password_verify($pass, $user['password'])== FALSE || $user_name != $user['username']){
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    Incorrect <strong>username</strong> or <strong>password</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                        }else{
                            $_SESSION['user'] = $user['username'];
                            $_SESSION['id'] = $user['id'];
                            echo "<div class='alert alert-success fade show' role='alert'>
                                    welcome <strong>{$user['username']}</strong>, Opening Dashboard...</div>";
                            echo "<script>
                                    setTimeout(function(){location.href = 'dashboard.php';},2000);
                                    </script>";
                        }
                    }
                    $conn->close();
                }
                ?>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="mb-3">
                        <label for="exampleInputname" class="form-label"><strong>Username</strong></label>
                        <input type="text" name='username' class="form-control" id="exampleInputname" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"><strong>Password</strong></label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                    </div>
                    <button type="submit" name='login' class="btn btn-primary">Login</button>
                    <a href="forgot-password.php" class="btn btn-danger">Forgot Password</a>
                    <a href="register.php" class="btn btn-success">New user? Register here</a>
                </form>
            </div>
        </div>
    </main>
    <?php
    include 'footer.php';
            }
    ?>
</body>

</html>