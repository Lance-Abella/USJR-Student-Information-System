<?php
include_once("db.php");
require_once("login.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_name = $_POST["username"];
    $user_password = $_POST["password"];

    try {
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = :username");
        $stmt->bindParam(':username', $user_name, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($user_password, $result['password'])) {
            echo "<script>confirm('You successfully logged in!'); window.location='student-listing.php';</script>";

        } else {
            echo "<script>confirm('Login failed!'); window.location='login.php';</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}
?>

