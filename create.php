<?php
// Include config file
require_once "config.php";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //take name from form
    $name =$_POST['name'];

    //take deparment from form
    $department = $_POST['department'];

    //take salary from form
    $salary = $_POST['salary'];

    // Prepare an insert statement
    $sql = "INSERT INTO employees (name, department, salary) VALUES (?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssi", $param_name, $param_department, $param_salary);

        // Set parameters
        $param_name = $name;
        $param_department = $department;
        $param_salary = $salary;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records created successfully. Redirect to landing page
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
}
?>

<h2>Create Record</h2>

<p>Please fill this form and submit to add employee record to the database.</p>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

<label>Name</label>
<input type="text" name="name">
<label>Address</label>
<input type="text" name="department">
<label>Salary</label>
<input type="text" name="salary">
<input type="submit" value="Submit">
<a href="index.php">Cancel</a>
</form>
