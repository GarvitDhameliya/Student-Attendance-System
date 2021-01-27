<?php



include('header.php');

if (base64_decode($_GET["action"]) == true)
{
$id =  base64_decode($_GET["action"]);


$query = "SELECT * FROM tbl_grade WHERE grade_id ='".$id."'";

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

foreach ($result as $row)
{
	
}
}
else
{
	header('location:grade.php');
}

?>
<body style="background-color: #EFEFEF">

<div class="container" >
	
		<div class="row">
			<div class="col-md-4">
				
			</div>
			<div class="col-md-4" style="margin-top: 150px">
				<div class="card shadow-lg rounded-lg border-secondary">
					<div class="card-header bg-secondary text-white" style="font-family: sans-serif;">Edit Grade</div>
					<div class="card-body">
						<form method="post">
							<div class="form-group">
								<input type="text" name="Edit_grade" class="form-control rounded-pill" value="<?php echo $row['grade_name']; ?>" />
							</div>
							<div class="form-group">
								<input type="submit" name="edit"  class="btn btn-info  rounded" value="Edit" />
							</div>
						</form>	
					</div>	
				</div>
			</div>
			<div class="col-md-4">
				
			</div>
		</div>
	</div>

</body>
</html>

<?php

if (isset($_POST["edit"]))
{
	$grade = $_POST["Edit_grade"];
	$sub_query = "
		UPDATE tbl_grade SET grade_name = '$grade' WHERE grade_id = '$id'
	";

	$statement = $connect->prepare($sub_query);
	$statement->execute();

	header('location:grade.php');
}
?>