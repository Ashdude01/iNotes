<?php
session_start();
$title = $_POST['title'];
    if (strlen($title) <= 3) {
        echo "<script>
        alert('Enter a valid Title, greater than 3 character');
        location.href = 'dashboard.php';
        </script>";
    } else {
        include 'config.php';
        $sql = "INSERT INTO notes (title,description,time,username) VALUES('$title', '{$_POST['description']}', '{$_POST['time']}', '{$_SESSION['user']}')";
        if ($conn->query($sql) === TRUE) {
        header("Location: /dashboard.php");
        }else{
            echo $conn->connect_error;
        }
    }
    mysqli_close($conn);

    ?>
