<?php

include('header.php');

if (base64_decode($_GET["action"]) == true)
{

$teacher_id = base64_decode($_GET["action"]);



$teacher_name ='';
$teacher_address = '';
$teacher_emailid = '';
$teacher_password = '';
$teacher_grade_id = '';
$teacher_qualification = '';
$teacher_doj = '';
$teacher_image = 

$error_teacher_name ='';
$error_teacher_address = '';
$error_teacher_emailid = '';
$error_teacher_password = '';
$error_teacher_grade_id = '';
$error_teacher_qualification = '';
$error_teacher_doj = '';
$error_teacher_image = '';

$error=0;
$success ='';


if(isset($_POST["button_action"]))
{
	$teacher_image = $_POST["hidden_teacher_image"];
	if($_FILES["teacher_image"]["name"] != '')
	{
		$file_name = $_FILES["teacher_image"]["name"];
		$tmp_name = $_FILES["teacher_image"]["tmp_name"];
		$extension_array = explode(".", $file_name);
		$extension = strtolower($extension_array[1]);
		$allow_extension = array('png','jpg');
		if(!in_array($extension,$allow_extension))
		{
			$error_teacher_image = "Invalid Image formate";
			$error++;
		}
		else
		{
			$teacher_image = uniqid() . '.' . $extension;
			$upload_path = 'teacher_image/' . $teacher_image;
			move_uploaded_file($tmp_name, $upload_path);
		}
	}

	if(empty($_POST["teacher_name"]))
	{
		$error_teacher_name = "Name is Required";
		$error++;
	}
	else
	{
		$teacher_name = $_POST["teacher_name"];
	}
	if(empty($_POST["teacher_address"]))
	{
		$error_teacher_address = "Address is Required";
		$error++;
	}
	else
	{
		$teacher_address = $_POST["teacher_address"];
	}
	if(empty($_POST["teacher_emailid"]))
	{
		$error_teacher_emailid = "Email Id Required";
		$error++;
	}
	else
	{
		$teacher_emailid = $_POST["teacher_emailid"];
	}
	if(!empty($_POST["teacher_password"]))
	{
		$teacher_password = $_POST["teacher_password"];
	}
	if(empty($_POST["teacher_grade_id"]))
	{
		$error_teacher_grade_id = "Grade is Required";
		$error++;
	}
	else
	{
		$teacher_grade_id = $_POST["teacher_grade_id"];
	}
	if(empty($_POST["teacher_qualification"]))
	{
		$error_teacher_qualification = "Qualification is Required";
		$error++;
	}
	else
	{
		$teacher_qualification = $_POST["teacher_qualification"];
	}
	if(empty($_POST["teacher_doj"]))
	{
		$error_teacher_doj = "Date of joining Required";
		$error++;
	}
	else
	{
		$teacher_doj = $_POST["teacher_doj"];
	}
	if($error == 0)
	{
		if($teacher_password != '')
		{
			$data = array(
				':teacher_name' => $teacher_name,
				':teacher_address' => $teacher_address,
				':teacher_emailid' => $teacher_emailid,
				':teacher_password' => password_hash($teacher_password, PASSWORD_DEFAULT),
				':teacher_qualification' => $teacher_qualification,
				':teacher_doj' => $teacher_doj,
				':teacher_image' => $teacher_image,
				':teacher_grade_id' => $teacher_grade_id,
				':teacher_id' =>$_POST["teacher_id"]
			);

			$query = "
				UPDATE tbl_teacher
				SET teacher_name = :teacher_name,
					teacher_address = :teacher_address,
					teacher_emailid = :teacher_emailid,
					teacher_password = :teacher_password,
					teacher_grade_id = :teacher_grade_id,
					teacher_qualification = :teacher_qualification,
					teacher_doj = :teacher_doj,
					teacher_image = :teacher_image
					WHERE teacher_id = :teacher_id		
				";
		}
		else
		{
			$data = array(
				':teacher_name' => $teacher_name,
				':teacher_address' => $teacher_address,
				':teacher_emailid' => $teacher_emailid,
				':teacher_qualification' => $teacher_qualification,
				':teacher_doj' => $teacher_doj,
				':teacher_image' => $teacher_image,
				':teacher_grade_id' => $teacher_grade_id,
				':teacher_id' =>$_POST["teacher_id"]
			);

			$query = "
				UPDATE tbl_teacher
				SET teacher_name = :teacher_name,
					teacher_address = :teacher_address,
					teacher_emailid = :teacher_emailid,
					teacher_grade_id = :teacher_grade_id,
					teacher_qualification = :teacher_qualification,
					teacher_doj = :teacher_doj,
					teacher_image = :teacher_image
					WHERE teacher_id = :teacher_id		
				";
		}

		$statement = $connect->prepare($query);
		if($statement->execute($data))
		{
			$success ="<div class='alert alert-success'>Profile Details change successfully</div>";
			header('location:teacher.php');
		}
	}
}


$query = "
	SELECT * FROM tbl_teacher
	WHERE teacher_id ='$teacher_id'
";

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

}
else
{
	header('location:teacher.php');
}
?>
<body style="background-color: #EFEFEF">
<div class="container">
	<span><?php echo $success; ?></span>
	<div class="card shadow-lg mt-3">
		<form method="post" id="profile_form" enctype="multipart/form-data">
			<div class="card-header">
				<div class="row">
					<div class="col-md-9">Edit Details</div>
					<div class="col-md-3" align="right"></div>
				</div>
			</div>

			<div class="card-body">
				<div class="form-group">
					<div class="row">
						<label class="col-md-4 text-right">Teacher Name<span class="text-danger">*</span></label>
						<div class="col-md-8">
							<input type="text" name="teacher_name" id="teacher_name" class="form-control">
							<span class="text-danger"><?php echo $error_teacher_name;?></span>	
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<label class="col-md-4 text-right">Address<span class="text-danger">*</span></label>
						<div class="col-md-8">
							<input type="text" name="teacher_address" id="teacher_address" class="form-control">
							<span class="text-danger"><?php echo $error_teacher_address;?></span>	
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<label class="col-md-4 text-right">Email Address<span class="text-danger">*</span></label>
						<div class="col-md-8">
							<input type="Email" name="teacher_emailid" id="teacher_emailid" class="form-control">
							<span class="text-danger"><?php echo $error_teacher_emailid;?></span>	
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<label class="col-md-4 text-right">Password<span class="text-danger">*</span></label>
						<div class="col-md-8">
							<input type="Password" name="teacher_password" id="teacher_password" class="form-control" placeholder="Leave blank to not change it">
							<span class="text-danger"><?php echo $error_teacher_password;?></span>	
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<label class="col-md-4 text-right">Teacher Qualification<span class="text-danger">*</span></label>
						<div class="col-md-8">
							<input type="text" name="teacher_qualification" id="teacher_qualification" class="form-control" >
							<span class="text-danger"><?php echo $error_teacher_qualification;?></span>	
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<label class="col-md-4 text-right">Grade</label>
						<div class="col-md-8">
							<select name="teacher_grade_id" id="teacher_grade_id" class="form-control">
								<option value="">Select Grade</option>
								<?php
									echo load_grade_list($connect);
								?>
							</select>
							<span class="text-danger"><?php echo $error_teacher_grade_id;?></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<label class="col-md-4 text-right">Date of joining<span class="text-danger">*</span></label>
						<div class="col-md-8">
							<input type="text" name="teacher_doj" id="teacher_doj" class="form-control" readonly>
							<span class="text-danger"><?php echo $error_teacher_doj;?></span>	
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<label class="col-md-4 text-right">Image<span class="text-danger">*</span></label>
						<div class="col-md-8">
							<input type="file" name="teacher_image" id="teacher_image" class="form-control">
							<span class="text-muted">Only jpg and png allow</span>
							<span class="text-danger" id="error_teacher_image"><?php echo $error_teacher_image;?></span>	
						</div>
					</div>
				</div>

			</div>

			<div class="card-footer" align="center">
					<input type="hidden" name="hidden_teacher_image" id="hidden_teacher_image">
					<input type="hidden" name="teacher_id" id="teacher_id">
					<input type="submit" name="button_action" id="button_action" class="btn btn-success" value="Edit Details">
					
				</div>
		</form>
	</div>
</div>
</body>
</html>




<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
  	
  	$(document).ready(function() {
  		
  		<?php

  			foreach ($result as $row)
  			{
  				?>
  				$('#teacher_name').val("<?php echo $row["teacher_name"];?>");
  				$('#teacher_address').val("<?php echo $row["teacher_address"];?>");
  				$('#teacher_emailid').val("<?php echo $row["teacher_emailid"];?>");
  				$('#teacher_qualification').val("<?php echo $row["teacher_qualification"];?>");
  				$('#teacher_grade_id').val("<?php echo $row["teacher_grade_id"];?>");
  				$('#teacher_doj').val("<?php echo $row["teacher_doj"];?>");
  				$('#error_teacher_image').html("<img src='admin/teacher_image/<?php echo $row['teacher_image'];?>' class='img-thumbnail' width='100'/>");
  				$('#hidden_teacher_image').val("<?php echo $row["teacher_image"];?>");
  				$('#teacher_id').val("<?php echo $row["teacher_id"];?>");
	  		<?php
	  		}
	  		?>

	  		$('#teacher_doj').datepicker({
				dateFormat:'yy-mm-dd',
				autoclose:true
			});
 		

  	});

  </script>