<?php
session_start();
if(!isset($_SESSION['user'])){header("Location: /");}
session_unset();
session_destroy();
echo "<script>
alert('You have been logged out')
location.href = '/';
</script>";

?>
