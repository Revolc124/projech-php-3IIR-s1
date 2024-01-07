<?php
    $conn = mysqli_connect("localhost","root","","login-db");

    if(!$conn){
        die("connection failed" . mysqli_connect_error());
    }
    echo '<script>document.getElementById("server-statut").innerHTML = "connected to server";</script>';

    
?>