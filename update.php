<?php
// Include config file
require_once "config.php";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    $input_name = trim($_POST["name"]);
    $name = $input_name;

    $input_department = trim($_POST["department"]);
    $department = $input_department;

    $input_salary = trim($_POST["salary"]);
    $salary = $input_salary;

    $sql = "UPDATE employees SET name=?, department=?, salary=? WHERE id=?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssii", $param_name, $param_department, $param_salary, $param_id);

        // Set parameters
        $param_name = $name;
        $param_department = $department;
        $param_salary = $salary;
        $param_id = $id;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records updated successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM employees WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $name = $row["name"];
                    $department = $row["department"];
                    $salary = $row["salary"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<h2>Update Record</h2>
<p>Please edit the input values and submit to update the record.</p>
<form action="<?php echo basename($_SERVER['REQUEST_URI']); ?>" method="post">
    <label>Name</label>
    <input type="text" name="name" value="<?php echo $name; ?>">
    <label>Department</label>
    <input type="text" name="department" value="<?php echo $department; ?>">
    <label>Salary</label>
    <input type="text" name="salary" value="<?php echo $salary; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    <input type="submit" value="Submit">
    <a href="index.php">Cancel</a>
</form>
