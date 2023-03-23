<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - iNotes</title>
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
            <h2 class="mb-5">Account Settings <i class="bi bi-gear"></i></h2>
            <?php
            include 'config.php';
            $sql = "SELECT email,password FROM user WHERE id = {$_SESSION['id']} AND username = '{$_SESSION['user']}'";
            $query = $conn->query($sql);
            if ($query->num_rows < 1) {
                echo "No Records Found !";
            } else {
                $user = mysqli_fetch_assoc($query);
            ?>
                <!-- Edit Note Section -->
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="row g-3 align-items-center">
                        <label for="email" class="form-label">Your Email - <strong><?php echo $user['email'] ?></strong></label>
                        <div class="col-auto">
                            <input type="email" placeholder="change Email" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="col-auto">
                            <button type='submit' name="update_email" class="btn btn-primary"> Update</button>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_POST['update_email'])) {
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $update_email = "UPDATE user SET email='$email' WHERE username = '{$_SESSION['user']}'";
                    if ($conn->query($update_email) === TRUE) {
                        echo "<div class='alert alert-success alert-dismissible fade show my-3' role='alert'>
                        <strong>Email Updated</strong></div>";
                    } else {
                        echo "<div class='alert alert-danger fade show my-3' role='alert'>
                        <strong>Error Occured !</strong> - <a href='contact.php'>Contact us</a></div>";
                    }
                }
                ?>
                <form class='mt-5' action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="row g-3 align-items-center">
                        <label class="form-label"><strong>Update Password</strong></label>
                        <div class="col-auto">
                            <input type="text" placeholder="enter new password" name="new_pass" class="form-control" id="pass2" required>
                        </div>
                        <div class="col-auto">
                            <button type='submit' name='update_pass' class="btn btn-primary"> Update</button>
                        </div>
                    </div>
                </form>
            <?php
                if (isset($_POST['update_pass'])) {
                    $newpass = md5($_POST['new_pass']);

                    $updatepass = "UPDATE user SET password='$newpass' WHERE username = '{$_SESSION['user']}'";
                    if ($conn->query($updatepass) === TRUE) {
                        echo "<div class='alert alert-success fade show my-3' role='alert'>
                        <strong>Password</strong> is updated successfully</div>";
                    } else {
                        echo "<div class='alert alert-danger fade show my-3' role='alert'>
                        <strong>Error Occured !</strong> - <a href='contact.php'>Contact us</a></div>";
                    }
                }
            }
            ?>
        </div>
    </main>
    <?php include 'footer.php' ?>
</body>

</html>