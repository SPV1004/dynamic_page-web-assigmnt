<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Mark List</title>
</head>
<body>
    <?php

    $hostname = "localhost";
    $username = "root";
    $password = "root";
    $database = "school";

    
    $connection = mysqli_connect($hostname, $username, $password, $database);

  
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve input values
        $studentname = $_POST["studentname"];
        $marks = $_POST["marks"];

        if (isset($_POST['insert'])) {
          
            $sql = "INSERT INTO marklist (studentname, marks) VALUES ('$studentname', '$marks')";
            if (mysqli_query($connection, $sql)) {
                echo "New student marks inserted successfully.<br>";
            } else {
                echo "Error inserting student marks: " . mysqli_error($connection);
            }
        }

        if (isset($_POST['update'])) {
           
            $sql = "UPDATE marklist SET marks='$marks' WHERE studentname='$studentname'";
            if (mysqli_query($connection, $sql)) {
                echo "Student marks updated successfully.<br>";
            } else {
                echo "Error updating student marks: " . mysqli_error($connection);
            }
        }

        if (isset($_POST['delete'])) {
          
            $sql = "DELETE FROM marklist WHERE studentname='$studentname'";
            if (mysqli_query($connection, $sql)) {
                echo "Student marks deleted successfully.<br>";
            } else {
                echo "Error deleting student marks: " . mysqli_error($connection);
            }
        }

        if (isset($_POST['list'])) {
           
            $sql = "SELECT * FROM marklist";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<h3>Student Marks List:</h3>";
                echo "<table border='1'>
                        <tr>
                            <th>Student Name</th>
                            <th>Marks</th>
                        </tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['studentname']}</td>
                            <td>{$row['marks']}</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "No student marks found.<br>";
            }
        }
    }

    
    mysqli_close($connection);
    ?>

    <h2>School Mark List Management</h2>
    <form action="" method="post">
        <label for="studentname">Student Name:</label>
        <input type="text" name="studentname"><br>

        <label for="marks">Marks:</label>
        <input type="number" id="marks" name="marks" min="0" max="100"><br>

        <!-- Buttons for different actions -->
        <input type="submit" name="insert" value="Insert">
        <input type="submit" name="update" value="Update">
        <input type="submit" name="delete" value="Delete">
        <input type="submit" name="list" value="List All Students">
    </form>
</body>
</html>
