<?php

include('header.php');



?>
<body>
	

<div class="container-fluid" style="background-color: #EFEFEF">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-8">
				<div class="card shadow-lg mt-3">
					<div class="card-header">
						<div class="row">
							<div class="col-md-9">Attendance List</div>
							<div class="col-md-3" align="right">
								<!-- <button type="button" class="btn-danger btn btn-sm" id="report_button" >Report</button> -->
								<button class="btn btn-sm btn-info" type="button" id="add_button">Add</button>
							</div>
						</div>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<span id="message_operation"></span>
							<table class="table table-striped table-bordered" id="attendance_table">
								<thead>
									<tr>
										<th>Student Name</th>
										<th>Roll Number</th>
										<th>Grade</th>
										<th>Attendance status</th>
										<th>Attendance date</th>
										
									</tr>
								</thead>
								<tbody>
									
								</tbody>
								
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4"> 
				<div class="card shadow-lg mt-3">
					<div class="card-header">
							<h5 class="text-center">Report</h5>
					</div>
					<div class="card-body">
							<div class="form-group">
								<div>
									<label>From Date</label>
									<input type="Date" name="from_date" id="from_date" class="form-control">
									<span class="text-danger" id="error_from_date"></span>
									<br>
									<label>To Date</label>
									<input type="Date" name="to_date" id="to_date" class="form-control">
									<span class="text-danger" id="error_to_date"></span>
								</div>
							</div>	
					</div>

					<div class="modal-footer">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-6">
									<button type="button" name="create_report" id="create_report" class="btn btn-sm btn-success">Create Report</button>
								</div>

							</div>		
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>

<!-- Date picker Link -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php

	$query="
		SELECT * FROM tbl_grade WHERE grade_id = (SELECT teacher_grade_id FROM tbl_teacher WHERE teacher_id = '".$_SESSION["teacher_id"]."')

	";

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();



?>

<div class="modal" id="formModal">
	<div class="modal-dialog">
	<form method="POST" id="attendance_form" enctype="multipart/form-data">
		<div class="modal-content">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modal_title"></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<?php
						foreach ($result as $row ) 
						{
					?>
							<div class="form-group">
							<div class="row">
								<label class="col-md-4 text-right">Grade<span class="text-danger">*</span></label>
								<div class="col-md-8">
									<?php echo '<label>'.$row["grade_name"].'</label>'?>
								</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<label class="col-md-4 text-right">Attendance Date<span class="text-danger">*</span></label>
							<div class="col-md-8">
								<input type="text" name="attendance_date" id="attendance_date" class="form-control" readonly>
								<span id="error_attendance_date" class="text-danger"></span>
							</div>
						</div>
					</div>


					<div class="form-group" id="stuent_details">
						<div class="table-responsive">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<td>Roll no.</td>
										<td>Student Name</td>
										<td>Present</td>
										<td>Absent</td>
									</tr>
								</thead>
							

					<?php

						$sub_query = "
							SELECT * FROM tbl_student
							WHERE student_grade_id = '".$row["grade_id"]."'
						";
						$statement = $connect->prepare($sub_query);
						$statement->execute();
						$student_resule = $statement->fetchAll();
						foreach ($student_resule as $student)
						{
						?>
							<tr>
								<td><?php echo $student["student_roll_number"];?></td>
								<td><?php echo $student["student_name"];?>
									<input type="hidden" name="student_id[]" value="<?php echo $student["student_id"];?>">
								</td>
								<td>
									<input type="radio" name="attendance_status<?php echo $student["student_id"];?>" value ="Present" >
								</td>
								<td>
									<input type="radio" name="attendance_status<?php echo $student["student_id"];?>" checked value ="Absent" >
								</td>
							</tr>
						<?php
						}
						?>
						</table>
						</div>
					</div>
						<?php
						}
					?>
				</div>


			<div class="modal-footer">
					<input type="hidden" name="action" id="action" value="Add">
					<input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Add">
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				</div>
		</div>
	</form>
	</div>
</div>


<script>
	
	$(document).ready(function() {
		
		var dataTable = $('#attendance_table').DataTable({

			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{

				url:"attendance_action.php",
				method:"POST",
				data:{action:"fetch"}

			}
		});

		$('#attendance_date').datepicker({
		dateFormat:'yy-mm-dd',
		autoclose:true,
		container:'#formModal modal-body'
		});

		function clear_field(){
			$('#attendance_form')[0].reset();
			$('#error_attendance_date').text('');
		}

		$('#add_button').click(function(){
			
			$('#modal_title').text('Add Attendance');
			$('#formModal').modal('show');
			clear_field();
		});


		$('#attendance_form').on('submit', function(event) {
			event.preventDefault();
			
			$.ajax({
				url:"attendance_action.php",
				method:"POST",
				data:$(this).serialize(),
				dataType:"json",
				beforeSend:function()
				{
					$('#button_action').val('Validate...');
					$('#button_action').attr('disabled','disabled');
				},
				success:function(data)
				{

					$('#button_action').attr('disabled',false);
					$('#button_action').val($('#action').val());

					if (data.success)
					{
						$('#message_operation').html('<div class="alert alert-success" >'+data.success+'</div>');
						clear_field();
						$('#formModal').modal('hide');
						dataTable.ajax.reload();
					}
					if(data.error)
					{
						if(data.error_attendance_date != '')
						{
							$('#error_attendance_date').text(data.error_attendance_date);
						}
						else
						{
							$('#error_attendance_date').text('');
						}
					}
				}
			})
		});


		$('#create_report').click(function() {
			
			var from_date = $('#from_date').val();
			var to_date = $('#to_date').val();
			var error = 0;
			if(from_date == '')
			{
 				$('#error_from_date').text('From Date is Required');
 				error++;
			}
			else
			{
				$('#error_from_date').text('');
			}
			if(to_date == '')
			{
				$('#error_to_date').text('To Date is Required');
				error++;
			}
			else
			{
				$('#error_to_date').text('');
			}
			if(error == 0)
			{
				$('#from_date').val('');
				$('#to_date').val('');
				window.open("report.php?action=attendance_report&from_date="+from_date+"&to_date="+to_date);
			}

		});

	});

</script>

