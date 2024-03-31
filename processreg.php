<?php
include_once("db.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
        $user_name = $_POST['username'];
        $user_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $user_name);
        $stmt->bindParam(':password', $user_password);
        $stmt->execute();
        
        echo "<script>confirm('You successfully created an account!'); window.location='login.php';</script>";
        header("Location: login.php"); 
    }
    $conn = null;

?>