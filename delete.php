<?php
require_once "db.php";

if (isset($_GET['studid'])) {
    $studentID = $_GET['studid'];

    $stmt1 = $conn->prepare("DELETE FROM students WHERE studid = :studid");
    $stmt1->bindParam(":studid", $studentID);

    if ($stmt1->execute()) {
        header("Location: student-listing.php");
        exit();
    } else {
        echo "<script>alert('Error deleting student.');</script>";
    }
} 

if (isset($_GET['collid'])) {
    $collid = $_GET['collid'];

    $stmt1 = $conn->prepare("DELETE FROM colleges WHERE collid = :collid");
    $stmt1->bindParam(":collid", $collid);

    if ($stmt1->execute()) {
        header("Location: college-listing.php");
        exit();
    } else {
        echo "<script>alert('Error deleting college.');</script>";
    }
} 

if (isset($_GET['deptid'])) {
    $deptid = $_GET['deptid'];

    $stmt1 = $conn->prepare("DELETE FROM departments WHERE deptid = :deptid");
    $stmt1->bindParam(":deptid", $deptid);

    if ($stmt1->execute()) {
        header("Location: department-listing.php");
        exit();
    } else {
        echo "<script>alert('Error deleting department.');</script>";
    }
}

if (isset($_GET['progid'])) {
    $progid = $_GET['progid'];

    $stmt1 = $conn->prepare("DELETE FROM programs WHERE progid = :progid");
    $stmt1->bindParam(":progid", $progid);

    if ($stmt1->execute()) {
        header("Location: program-listing.php");
        exit();
    } else {
        echo "<script>alert('Error deleting program.');</script>";
    }
}
?>