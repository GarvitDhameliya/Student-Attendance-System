<?php

include('header.php');


if (base64_decode($_GET["action"]) == true)
{
	$id = base64_decode($_GET["action"]);

	$query = "SELECT * FROM tbl_student WHERE student_id = '$id'";

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach ($result as $row)
	{

	}
}
else
{
	header('location:student.php');
}



?>

<body style="background-color: #EFEFEF">

<div class="container">
	<div class="card shadow-lg mt-5">
		<form method="post" id="profile_form" enctype="multipart/form-data">
			<div class="card-header">
				<div class="row">
					<div class="col-md-9">Edit Student</div>
					<div class="col-md-3" align="right"></div>
				</div>
			</div>

			<div class="card-body">


					<div class="form-group">
						<div class="row">
							<label class="col-md-4 text-right">student Name<span class="text-danger">*</span></label>
							<div class="col-md-8">
								<input type="text" name="student_name" id="student_name" class="form-control">
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<label class="col-md-4 text-right">Roll number<span class="text-danger">*</span></label>
							<div class="col-md-8">
								<textarea id="student_roll_number" name="student_roll_number" class="form-control"></textarea>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<label class="col-md-4 text-right">Date of Birth<span class="text-danger">*</span></label>
							<div class="col-md-8">
								<input type="Date" name="student_dob" id="student_dob" class="form-control">
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<label class="col-md-4 text-right">Grade Name<span class="text-danger">*</span></label>
							<div class="col-md-8">
								<select class="form-control" id="student_grade_id" name="student_grade_id">
									<option value="">Select Grade</option>
									<?php echo load_grade_list($connect)?>
								</select>
							</div>
						</div>
					</div>
			</div>


			<div class="card-footer"  align="center">
					<button name="button_action" class="btn btn-success">Edit Student</button>
				</div>
				
		</form>
	</div>
</div>	
</body>
</html>

<script>
	
	$(document).ready(function() 
	{	
		$('#student_name').val("<?php echo $row['student_name'];?>");
		$('#student_roll_number').val("<?php echo $row['student_roll_number'];?>");
		$('#student_dob').val("<?php echo $row['student_dob'];?>");
		$('#student_grade_id').val("<?php echo $row['student_grade_id'];?>");
	});
</script>

<?php
	if (isset($_POST["button_action"]))
	{
		$student_name = $_POST["student_name"];
		$student_roll_number = $_POST["student_roll_number"];
		$student_dob = $_POST["student_dob"];
		$student_grade_id = $_POST["student_grade_id"];

		$sub_query = "
			UPDATE tbl_student 
			SET student_name = '$student_name',
				student_roll_number = '$student_roll_number',
				student_dob = '$student_dob',
				student_grade_id = '$student_grade_id'
			WHERE student_id = '$id'

		";

		$statement = $connect->prepare($sub_query);
		

		if ($statement->execute())
		{
			?>
				<script>
					window.location.replace("student.php");
				</script>
			<?php
		}

		
	}

?>