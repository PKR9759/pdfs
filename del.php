else if(isset($_POST['delete']))
{
	$sql="DELETE FROM `employees` WHERE `id`=?";
	$d_id=1;
	if($stmt=mysqli_prepare($link,$sql)){
		mysqli_stmt_bind_param($stmt,"i",$d_id);
		if(mysqli_stmt_execute($stmt)){
			header("location:read.php");
			exit();
		}
		else{
			echo"oops!something went wrong !try again later";
		}
		
	}
}
mysqli_close($link);
