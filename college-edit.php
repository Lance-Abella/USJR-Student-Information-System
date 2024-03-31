<?php
    //Starting db connection
    require_once "db.php";

    //Fetching values from colleges
    $collid = $_GET['collid'];
    $stmt = $conn->prepare("SELECT collid, collfullname, collshortname FROM colleges
    WHERE collid = :collid");
    $stmt->bindParam(':collid', $collid, PDO::PARAM_INT);
    $stmt->execute();
    $collegeData = $stmt->fetch(PDO::FETCH_ASSOC);  

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        $id = $_POST['collid'];
        $collfullname = $_POST['collfullname'];
        $collshortname = $_POST['collshortname']; 

        $stmt = $conn->prepare("UPDATE colleges SET
            collfullname = :collfullname,
            collshortname = :collshortname
            where collid= :collid");

        $stmt->bindParam(':collid', $id);
        $stmt->bindParam(':collfullname', $collfullname);
        $stmt->bindParam(':collshortname', $collshortname);
        $stmt->execute();
        header("Location: college-listing.php");
        exit();
           
    } 
    $conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USJ-R</title>
    <link rel="icon" href="../USJR/images/logo.png" type="image">
    <link rel="stylesheet" href="bootstrap.min.css">
    <script defer src="bootstrap.bundle.min.js"></script>
    <style>

        body{
            padding-bottom: 5%;
        }

        .horizontal-line1 {
            top: 0;
            left: 0;
            width: 100%;
            height: 5px; 
            background-color: #FFC436;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); 
        }

        .horizontal-line2 {
            margin-top: 1%;
            left: 0;
            width: 100%;
            height: 60px; 
            background-color: #004225;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            align-items: center;
            padding-top: 12px;
            padding-left: 7.5%;
        }

        .header{
            margin-top: 1%; 
        }

        .profile{
            margin-left: 54.5%;
        }

        .drop{
            margin-left: -15px;
        }

        .drop, .drop:focus, .drop:active{
            outline: none; 
            border: none;  
        }

        .link{
            text-decoration: none;
            color: white;
            font-size: 20px;
            margin-right: 2%;
        }

        .active{
            pointer-events: none;
            color: white;
            font-size: 20px;
            text-decoration: underline;
            text-decoration-thickness: 1.5px;
            text-underline-offset: 5px;
            cursor: not-allowed;
            margin-right: 2%;
        }

        .space{
            margin-right: 3%;
        }

        .space1{
            margin-right: 1%;
        }

        .viewdiv{
            width:480px;
            margin-top: 1%;
            margin-left: 1%;
            text-align: start;
        }

        .viewbtn{
            width: 90px;
            border-color: black;
            color: black;
        }

        .viewbtn:hover{
            border-color: white;
            color: white;
        }

        h4 {
            text-align: center;
        }

        .formDiv {
            margin-top: 3%;
            border: 1px solid black;
            width: 700px;
            padding-bottom: 20px;
            padding-top: 20px;
        }

        .entry {
            width: 550px; 
            margin-top: 20px;
            margin-left: 60px;
        }

        .formbtn1{
            width:200px;
            margin-left: 15px;
            border-color: black;
            color: black;
        }

        .formbtn1:hover{
            border-color: white;
            color: white;
        }

        .formbtn2{
            width:200px;
            margin-left: 120px;
            border-color: black;
            color: black;
        }

        .formbtn2:hover{
            border-color: white;
            color: white;
        }

    </style>
</head>
<body>
    <div class="horizontal-line1">

    </div>

    <div class="container header">
        <img src="images/usjr-header-logo.png" class="img-fluid" alt="image">

        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="40" fill="currentColor" class="bi bi-envelope profile space" viewBox="0 0 16 16">
            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
        </svg>

        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="31" fill="currentColor" class="bi bi-chat-square-text space" viewBox="0 0 16 16">
            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
            <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
        </svg>

        <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="currentColor" class="bi bi-bell space1" viewBox="0 0 16 16">
            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
        </svg>

        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="45" fill="currentColor" class="bi bi-grip-vertical space1" viewBox="0 0 16 16">
            <path d="M7 2a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M7 5a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M7 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-3 3a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-3 3a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
        </svg>

        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person " viewBox="0 0 16 16">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"/>
        </svg>

        <button class="btn dropdown-toggle drop" type="button" data-bs-toggle="dropdown" aria-expanded="false">                
        </button>

        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="login.php">Logout</a></li>
        </ul>
    </div>

    <div class="horizontal-line2">
        <a class="link" href="student-listing.php">Students</a>
        <a class="active" href="college-listing.php">Colleges</a>
        <a class="link" href="department-listing.php">Departments</a>
        <a class="link" href="program-listing.php">Programs</a>
    </div>

    <div class="container viewdiv">
        <button type="submit" class="btn btn-outline-warning viewbtn" onclick="window.location.href='college-listing.php'">Back</button>
    </div>

    <div class="container formDiv">
        <h4>College Information Data Entry</h4>
        <form action="" method="post" class="entry" onsubmit="return confirmAction()">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="collid" name="collid" value="<?php echo $collegeData['collid']; ?>" readonly>
                <label for="collid">College ID</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="collfullname" id="collfullname" value="<?php echo $collegeData['collfullname']; ?>" required>
                <label for="collfullname">College Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="collshortname" id="collshortname" value="<?php echo $collegeData['collshortname']; ?>" required>
                <label for="collshortname">Abbreviation</label>
            </div>

            <button type="submit" class="btn btn-outline-warning formbtn1">Save changes</button>
            <button type="button" class="btn btn-outline-warning formbtn2" onclick="clearField()">Clear</button>

        </form>
    </div>

    <script>

        function confirmAction() {
            return confirm("Are you sure you want to save changes?");
        }

        function clearField() {
            document.getElementById('collid').value = '';
            document.getElementById('collfullname').value = '';
            document.getElementById('collshortname').value = '';
        }
    </script>
</body>
</html>

