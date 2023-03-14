<?php
// Include config file
require_once "config.php";

// Attempt select query execution
$sql = "SELECT * FROM employees";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo "<thead>";
        echo "<tr>";
        echo "<th>Id</th>";
        echo "<th>Name</th>";
        echo "<th>Department</th>";
        echo "<th>Salary</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['department'] . "</td>";
            echo "<td>" . $row['salary'] . "</td>";
            echo "<td>";
            echo "<a href='read.php?id=" . $row['id'] . "'>View Record</a>";
            echo "&nbsp;";
            echo "<a href='update.php?id=" . $row['id'] . "'>Update Record</a>";
            echo "&nbsp;";
            echo "<a href='delete.php?id=" . $row['id'] . "'>Delete Record</a>";
            echo "&nbsp;";
            echo "</td>";
            echo "</tr>";
        }
        echo "<tr>";
        echo "<a href='create.php'>Create Record</a>";
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else {
        echo '<em>No records were found.</em>';
    }
} else {
    echo "Oops! Something went wrong. Please try again later.";
}

// Close connection
mysqli_close($link);
