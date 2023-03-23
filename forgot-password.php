<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
}else{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Login to iNotes and start adding todos right away">
        <title>Forgot Password Recovery - iNotes</title>
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
                    <h2 class="mb-5">Recover Your Password <i class="bi bi-refresh"></i></h2>
                    <?php

                        if (isset($_POST['login'])) {
                            include 'config.php';
                            $data = $_POST['email'];
                            $check = "SELECT username,email,token FROM user WHERE email = '$data' OR username = '$data'";
                            $res = $conn->query($check);
                            if ($res->num_rows < 1) {
                            echo "<div class='alert alert-danger fade show' role='alert'>
                                <strong>$data</strong> is not found in the database! - <a href='register.php'>Register Now</a></div>";
                            } else {
                                $user = $res->fetch_assoc();
                                $recepient = $user['email'];
                                $name = $user['username'];
                                
                                include_once('smtp/PHPMailerAutoload.php');
                                echo send_mail($recepient,$name,$user['token']);

                                function send_mail($recepient, $name, $token){
                                    
                                    $mail = new PHPMailer;
                                    $mail->isSMTP();
                                    $mail->SMTPDebug = 2;
                                    $mail->Host = '';
                                    $mail->Port = ;
                                    $mail->SMTPAuth = true;
                                    $mail->Username = '';
                                    $mail->Password = '';
                                    $mail->setFrom();
                                    $mail->addReplyTo($recepient, $name);
                                    $mail->addAddress($recepient, $name);
                                    $mail->Subject = 'Account Verification';
                                    $mail->SMTPOptions=array('ssl'=>array(
                                        'verify_peer'=>false,
                                        'verify_peer_name'=>false,
                                        'allow_self_signed'=>false
                                    ));
                                    // $mail->msgHTML(file_get_contents('message.html'), __DIR__);
                                    $mail->Body = "Click the link to verify you account on inotes.vermatimes.com <br>
                                    <a href='$token'>$token</a>";
                                    //$mail->addAttachment('attachment.txt');
                                    if (!$mail->send()) {
                                        echo "<div class='alert alert-danger fade show' role='alert'>
                                        <strong>Error Occured - </strong>$mail->ErrorInfo</div>";
                                    } else {
                                        echo "<div class='alert alert-primary fade show' role='alert'>
                                        click on the link sent to your email id <strong>$recepient</strong></div>";
                                    }
                                }
                            
                            }
                        $conn->close();
                         }
                    ?>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

                        <div class="mb-3">
                            <label for="data" class="form-label"><strong>Username/Email ID</strong></label>
                            <input type="text" name="email" class="form-control" id="data" required>
                        </div>
                        <button type="submit" name='login' class="btn btn-primary">Recover</button>
                    </form>
                </div>
            </div>
        </main>
    <?php
    include 'footer.php'; }
    ?>
    </body>

    </html>
