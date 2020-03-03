<?php
    $servername = "localhost";
    $username = "ashley";
    $password = "1234";
    $dbname = "crud";

    // Create connection
    $db = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>