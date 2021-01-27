<?php

include('header.php');





?>

<body style="background-color: #EFEFEF">
<div class="container" style="margin-top: 30px">
	<div class="card shadow-lg mt-3">
		<div class="card-header">
			<div class="row">
				<div class="col-md-9">Student List</div>
				<div class="col-md-3" align="right">
					<button type="button" id="add_button" class="btn btn-info btn-sm">Add</button>
				</div>
			</div>
		</div>

		<div class="card-body">
			<div class="table-responsive" id="show">
				<span id="message_operation"></span>
				<table class="table-striped table table-bordered" id="student_table">
					<thead>
						<tr>
							<th>Student Name</th>
							<th>Roll No</th>
							<th>Date of Birth</th>
							<th>Grade</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</body>
</html>


<div class="modal" id="formModal">
	<div class="modal-dialog">
	<form method="POST" id="student_form" enctype="multipart/form-data">
		<div class="modal-content">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="form-group">
						<div class="row">
							<label class="col-md-4 text-right">student Name<span class="text-danger">*</span></label>
							<div class="col-md-8">
								<input type="text" name="student_name" id="student_name" class="form-control">
								<span id="error_student_name" class="text-danger"></span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<label class="col-md-4 text-right">Roll number<span class="text-danger">*</span></label>
							<div class="col-md-8">
								<textarea id="student_roll_number" name="student_roll_number" class="form-control"></textarea>
								<span id="error_student_roll_number" class="text-danger"></span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<label class="col-md-4 text-right">Date of Birth<span class="text-danger">*</span></label>
							<div class="col-md-8">
								<input type="Date" name="student_dob" id="student_dob" class="form-control">
								<span id="error_student_dob" class="text-danger"></span>
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
								<span id="error_student_grade_id" class="text-danger"></span>
							</div>
						</div>
					</div>
			</div>


			<div class="modal-footer">
					<input type="hidden" name="student_id" id="student_id">
					<input type="hidden" name="action" id="action" value="Add">
					<input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Add">
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				</div>
		</div>
	</form>
	</div>
</div>

<script>
	
	$(document).ready(function(){
		
		var dataTable = $('#student_table').DataTable({

			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"student_action.php",
				method:"POST",
				data:{action:'fetch'},
			}

		});


		function clear_field(){
		$('#student_form')[0].reset();
		$('#error_student_name').text('');
		$('#error_student_roll_number').text('');
		$('#error_student_dob').text('');
		$('#error_student_grade_id').text('');

		}


		$('#add_button').click(function() {
			
			$('#modal-title').text('Add Student');
			$('#button_action').val('Add');
			$('#action').val('Add');
			$('#formModal').modal('show');
			clear_field();

		});

		$('#student_form').on('submit', function(event) {
			event.preventDefault();
			
			$.ajax({

				url:"student_action.php",
				method:"POST",
				data: $(this).serialize(),
				dataType:"json",
				beforeSend:function(){
				$('#button_action').val('Validate...');
				$('#button_action').attr('disabled','disabled');
				},

				success:function(data){
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
						if(data.error_student_name != '')
						{
							$('#error_student_name').text(data.error_student_name);
						}
						else
						{
							$('#error_student_name').text('');
						}
						if(data.error_student_roll_number != '')
						{
							$('#error_student_roll_number').text(data.error_student_roll_number);
						}
						else
						{
							$('#error_student_roll_number').text('');
						}
						if (data.error_student_dob != '')
						{
							$('#error_student_dob').text(data.error_student_dob);
						}
						else
						{
							$('#error_student_dob').text('');
						}
						if(data.error_student_grade_id != '')
						{
							$('#error_student_grade_id').text(data.error_student_grade_id);
						}
						else
						{
							$('#error_student_grade_id').text('');
						}
					}
				}


			});


		});

		var student_id = '';

		$(document).on('click', '.delete_student', function() {
			
			if(confirm("Are you sure you want to delete")){
				student_id = $(this).attr('id');

				$.ajax({

					url:"student_action.php",
					method:"POST",
					data:{student_id:student_id, action:'delete'},
					success:function(data){
						$('#message_operation').html('<div class="alert alert-success">'+data+'</div>');
						dataTable.ajax.reload();
					}
				})
			}
			
		});
			
			
		
			


	});
</script>