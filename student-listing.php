<?php
    // Starting db connection
    require_once "db.php";

    // Pagination
    $rows_per_page = 10;
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $rows_per_page;

    $stmt1 = "SELECT studid, studlastname, studfirstname, studmidname, collfullname, progfullname, studyear FROM students
    inner join colleges on studcollid = collid
    inner join programs on studprogid = progid
    LIMIT :offset, :rows_per_page";
    $prep1 = $conn -> prepare ($stmt1);
    $prep1->bindParam(':offset', $offset, PDO::PARAM_INT);
    $prep1->bindParam(':rows_per_page', $rows_per_page, PDO::PARAM_INT);
    $prep1 -> execute();
    $result1 = $prep1 -> fetchAll(PDO::FETCH_ASSOC);

    $total_rows_stmt = $conn->query("SELECT COUNT(*) as count FROM students");
    $total_rows = $total_rows_stmt->fetchColumn();

    $total_pages = ceil($total_rows / $rows_per_page);
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

        .formDiv{
            margin-top: 1%;
            border:1px solid black;
            height: auto;
        }

        .addbtn{
            width: 200px;
            border-color: black;
            color: black;
        }

        .addbtn:hover{
            border-color: white;
            color: white;
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

        .page-item.active .page-link {
            background-color: #FFC436;
            color: black;
            text-decoration: underline;
            border: 1px solid black;
            outline: none;
            
        }

        .page-item:not(.active) .page-link {
            background-color: white;
            color: black;
            outline: none;
        }

        .page-link:focus,
        .page-link:active {
            outline: none;
            box-shadow: none;
        }

        .nav{
            margin-left: 6%;
            margin-top: 2%;
            text-align: end;
            padding-top: 10px;
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
        <a class="active" href="student-listing.php">Students</a>
        <a class="link" href="college-listing.php">Colleges</a>
        <a class="link" href="department-listing.php">Departments</a>
        <a class="link" href="program-listing.php">Programs</a>
    </div>

    <div class="container nav row">

        <div class="container col-md-6">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo ($current_page - 1); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                        <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?php echo ($current_page == $total_pages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo ($current_page + 1); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="container col-md-4">
            <button type="submit" class="btn btn-outline-warning addbtn" onclick="window.location.href='student-entry.php'">Add Student</button>
        </div>

    </div>
    
    <div class="container formDiv">
        <form action="" method="post" >
            <table class="table">

                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Middle Name</th>
                    <th scope="col">College</th>
                    <th scope="col">Program</th>
                    <th scope="col">Year</th>
                    <th></th>
                    <th></th>
                    
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($result1 as $row): ?>
                    <tr>
                        <td><?php echo $row['studid']; ?></td>
                        <td><?php echo $row['studlastname']; ?></td>
                        <td><?php echo $row['studfirstname']; ?></td>
                        <td><?php echo $row['studmidname']; ?></td>
                        <td><?php echo $row['collfullname']; ?></td>
                        <td><?php echo $row['progfullname']; ?></td>
                        <td><?php echo $row['studyear']; ?></td>
                        <td>
                            <a href="student-edit.php?studid=<?php echo $row['studid']; ?>" class="btn btn-primary btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                            </a>
                        </td>
                        <td>
                            <a href="delete.php?studid=<?php echo $row['studid']; ?>" class="btn btn-danger btn-sm" onclick="return confirmAction()">                        
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                </svg>                        
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>
        </form>
    </div>
    
    <script>

        function confirmAction() {
        return confirm("Are you sure you want to delete the information?");
        }

    </script>
</body>
</html>