<?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "exercise4";

    $conn = mysqli_connect($servername, $username, $password, $dbname)
            OR DIE ("Connection failed!");

    // Get matric number
    $matric = $_GET['matric'];
    // Fetch student data for the matric number
    $sql = $conn->query("SELECT * FROM student WHERE std_matric = '$matric'");
    $row = $sql->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        *, *:before, *:after {
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f7f7f7;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h2 {
            color: #333;
        }
        form {
            background: #fff;
            padding: 20px;
            width: 500px;
            border-radius: 10px;
            box-shadow: 0px 0px 8px rgba(0,0,0,0.1);
        }
        input[type = "text"], select, input[type = "file"] {
            width: 100%;
            padding: 8px;
            margin-top: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        input[type = "submit"] {
            background-color: #007BFF;
            color: white;
            width: 100%;
            padding: 8px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        input[type = "submit"]:hover {
            background-color: #0056b3;
        }
        img {
            margin-bottom: 30px;
            width: 100px;
            border-radius: 4px;
        }
    </style>

    <script>
        // Confirmation dialog for update
        function confirmUpdate() {
            return confirm("Are you sure you want to update this student?");
        }
    </script>
</head>
<body>
    <h2>Edit Student</h2>
    <!-- Form to update student info -->
    <form method = "POST" action = "update.php" enctype = "multipart/form-data" onsubmit = "return confirmUpdate();">
        <input type = "hidden" name = "matric" value = "<?php echo $row['std_matric']; ?>">

        <label>Name:</label>
        <input type = "text" name = "name" value = "<?php echo htmlspecialchars($row['std_name']); ?>" required>

        <label>Email:</label>
        <input type = "text" name = "email" value = "<?php echo htmlspecialchars($row['std_email']); ?>" required>

        <label>Race:</label>
        <select name = "race" required>
            <option value = "" disabled <?php echo empty($row['std_race']) ? 'selected' : ''; ?>>-- No selected --</option>
            <option value = "Malay" <?php echo ($row['std_race'] == 'Malay') ? 'selected' : ''; ?>>Malay</option>
            <option value = "Chinese" <?php echo ($row['std_race'] == 'Chinese') ? 'selected' : ''; ?>>Chinese</option>
            <option value = "Indian" <?php echo ($row['std_race'] == 'Indian')  ? 'selected' : ''; ?>>Indian</option>
        </select>

        <label>Gender:</label>
        <select name = "gender" required>
            <option value = "" disabled <?php echo empty($row['std_gender']) ? 'selected' : ''; ?>>-- No selected --</option>
            <option value = "Male" <?php echo ($row['std_gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
            <option value = "Female" <?php echo ($row['std_gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
        </select>

        <label>Image:</label>
        <input type = "file" name = "image">
        <?php 
            // Show current image if available
            if (!empty($row['std_image'])) 
                echo "<img src = '" . $row['std_image'] . "' alt = 'Student Image'><br>"; 
        ?>

        <input type = "submit" value = "Update">
    </form>
</body>
</html>
