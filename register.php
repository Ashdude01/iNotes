<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="sign and register to iNotes and start adding todos right away">
    <title>Register - iNotes</title>
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
                <h2 class="mb-5">New user Registration <i class="bi bi-person"></i></h2>
                <?php
                if (isset($_POST['register'])) {
                    include 'config.php';

                    if (strlen($_POST['username']) < 3) {
                        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        username <strong>{$_POST['username']}</strong> is too small, Try a bigger & unique username !
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                      </div>";
                    } else {
                        if (preg_match('/^[0-9]{10}+$/', $_POST['phone']) == FALSE) {
                            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            Enter 10-digit Valid Phone Number.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                        } else {
                            $validate_email = "SELECT username FROM user WHERE email = '{$_POST['email']}'";
                            if (mysqli_num_rows($conn->query($validate_email)) > 0) {
                                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                    An account with this <strong>email</strong> already exists! use different email id.
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                            } else {
                                // Validate password strength
                                $uppercase = preg_match('@[A-Z]@', $_POST['password']);
                                $lowercase = preg_match('@[a-z]@', $_POST['password']);
                                $number    = preg_match('@[0-9]@', $_POST['password']);
                                $specialChars = preg_match('@[^\w]@', $_POST['password']);

                                if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST['password']) < 8) {
                                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                    Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                                } else {
                                    $username = mysqli_real_escape_string($conn, $_POST['username']);
                                    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                                    $password = mysqli_real_escape_string($conn, $_POST['password']);
                                    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

                                    if ($password === $cpassword) {
                                        $validateuser = "SELECT username FROM user WHERE username = '{$username}'";
                                        $res = $conn->query($validateuser);
                                        if ($res->num_rows > 0) {
                                            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                            <strong>$username</strong> already exists - Try a unique username !
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>";
                                        } else {
                                            $hash = password_hash($password, PASSWORD_BCRYPT);
                                            $token = bin2hex(random_bytes(15));
                                            $adduser = "INSERT INTO user (username,phone,email,token,password) VALUES ('{$username}', '{$phone}','{$email}','{$token}', '{$hash}')";
                                            if ($conn->query($adduser) === TRUE) {
                                                echo "<div class='alert alert-success fade show' role='alert'>
                                                <strong>$username</strong> is registered, you can now <a href='login.php'>Log in</a></div>";
                                            } else {
                                                echo "<div class='alert alert-danger fade show' role='alert'>
                                                <strong>Error Occured!</strong> - <a href='contact.php'>contact us</a></div>";
                                            }
                                        }
                                    } else {
                                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <strong>Password</strong> and <strong> Confirm Password</strong>  not Matching!
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                        </div>";
                                    }
                                }
                            }
                        }
                    }
                    $conn->close();
                }
                ?>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="mb-3">
                        <label for="exampleInputuser" class="form-label"><strong>Username</strong></label>
                        <input type="text" name='username' class="form-control" id="exampleInputuser" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label"><strong>Phone</strong></label>
                        <input type="number" name='phone' class="form-control" id="phone" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label"><strong>Email</strong></label>
                        <input type="email" name='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"><strong>Password</strong></label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword2" class="form-label"><strong>Confirm Password</strong></label>
                        <input type="password" name="cpassword" class="form-control" id="exampleInputPassword2" required>
                    </div>
                    <button type="submit" name='register' class="btn btn-success">Register</button>
                    <a href="login.php" class="btn btn-primary">Already registered? Login here</a>
                </form>
            </div>
        </div>
    </main>
    <?php
    include 'footer.php';

    ?>
</body>

</html>