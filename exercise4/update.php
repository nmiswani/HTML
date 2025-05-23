<?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "exercise4";

    $conn = mysqli_connect($servername, $username, $password, $dbname)
            OR DIE ("Connection failed!");

    // Retrieve updated student data - POST request
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $race = $_POST['race'];
    $gender = $_POST['gender'];

    $imagePath = null;
    // Check if user uploaded a new image file
    if ($_FILES['image']['name']) {
        $target = "uploads/" . basename($_FILES['image']['name']);
        // Move uploaded file to 'uploads' folder
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $imagePath = $target;
    }

    // Sql update student data in the database
    $sql = "UPDATE student SET std_name = '$name', std_email = '$email', std_race = '$race', std_gender = '$gender'";
    if ($imagePath) {
        $sql .= ", std_image = '$imagePath'";
    }
    $sql .= " WHERE std_matric = '$matric'";
    $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Updating Progress</title>
    <script>
        // Alert user of successful update, then redirect back to list.php
        alert("Record updated successful!");
        window.location.href = "list.php";
    </script>
</head>
<body></body>
</html>
