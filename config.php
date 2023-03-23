<?php
        $servername = "localhost";
        $username = "u131394882_dinkoo";
        $password = ">wsk?N0@=#0P";
        $database = "u131394882_my_todonotes";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Database Connection Error" . $conn->connect_error);
        }?>