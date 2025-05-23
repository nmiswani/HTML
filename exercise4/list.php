<?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "exercise4";

    $conn = mysqli_connect($servername, $username, $password, $dbname)
            OR DIE ("Connection failed!");

    $data = [];
    // Race filter - GET request
    if (!empty($_GET['race'])) {
        $race = $_GET['race'];
        $data[] = "std_race = '$race'";
    }
    // Gender filter - GET request
    if (!empty($_GET['gender'])) {
        $gender = $_GET['gender'];
        $data[] = "std_gender = '$gender'";
    }
    // Sql query for select all student
    $sql = "SELECT * FROM student";
    // Append WHERE clause if filters exist
    if (!empty($data)) {
        $sql .= " WHERE " . implode(" AND ", $data);
    }
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Student List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f7f7f7;
        }
        h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.1);
        }
        select {
            padding: 6px 12px;
            margin-right: 10px;
        }
        input[type = "submit"] {
            background-color: #007BFF;
            color: white;
            padding: 8px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        input[type = "submit"]:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0px 0px 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #e6f2ff;
        }
        img {
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h2>Search Student</h2>
    <!-- Filter form race and gender -->
    <form method = "get">
        Race:
        <select name = "race">
            <option value = "">-- Select --</option>
            <option <?php echo (isset($_GET['race']) && $_GET['race'] == 'Malay') ? 'selected' : ''; ?>>Malay</option>
            <option <?php echo (isset($_GET['race']) && $_GET['race'] == 'Chinese') ? 'selected' : ''; ?>>Chinese</option>
            <option <?php echo (isset($_GET['race']) && $_GET['race'] == 'Indian') ? 'selected' : ''; ?>>Indian</option>
        </select>
        Gender:
        <select name = "gender">
            <option value = "">-- Select --</option>
            <option <?php echo (isset($_GET['gender']) && $_GET['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
            <option <?php echo (isset($_GET['gender']) && $_GET['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
        </select>
        <input type = "submit" value = "Search">
    </form>

    <h2>Student List</h2>
    <table>
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Email</th>
            <th>Race</th>
            <th>Gender</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php 
            // Loop through all students fetched from database
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['std_matric'] . "</td>";
                echo "<td>" . $row['std_name'] . "</td>";
                echo "<td>" . $row['std_email'] . "</td>";
                echo "<td>" . (!empty($row['std_race']) ? $row['std_race'] : '-') . "</td>";
                echo "<td>" . (!empty($row['std_gender']) ? $row['std_gender'] : '-') . "</td>";
                echo "<td>";
                    // Show image if available
                    if (!empty($row['std_image'])) {
                        echo "<img src = '" . $row['std_image'] . "' width = '60'>";
                    } else {
                        echo "No image";
                    }
                echo "</td>";
                // Link to edit.php
                echo "<td><a href = 'edit.php?matric=" . $row['std_matric'] . "' title = 'Edit'><i class = 'fas fa-pencil'></i></a></td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>
