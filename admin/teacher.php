<?php

include('header.php');


?>
<body style="background-color: #EFEFEF">
<div class="container " style="margin-top: 30px">
	<div class="card shadow-lg mt-3">
		<div class="card-header">
			<div class="row">
				<div class="col-md-9">Teacher List</div>
				<div class="col-md-3" align="right">
					<button type="button" id="add_button" class="btn btn-info btn-sm">Add</button>
				</div>
			</div>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<span id="message_operation"></span>
				<table class="table-striped table table-bordered" id="teacher_table">
					<thead>
						<tr>
							<th>Image</th>
							<th>Teacher Name</th>
							<th>Email Address</th>
							<th>Grade</th>
							<th>View</th>
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
	<form method="POST" id="teacher_form" enctype="multipart/form-data">
		<div class="modal-content">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="form-group">
						<div class="row">
							<label class="col-md-4 text-right">Teacher Name<span class="text-danger">*</span></label>
							<div class="col-md-8">
								<input type="text" name="teacher_name" id="teacher_name" class="form-control">
								<span id="error_teacher_name" class="text-danger"></span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<label class="col-md-4 text-right">Teacher Address<span class="text-danger">*</span></label>
							<div class="col-md-8">
								<textarea id="teacher_address" name="teacher_address" class="form-control"></textarea>
								<span id="error_teacher_address" class="text-danger"></span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<label class="col-md-4 text-right">Email Address<span class="text-danger">*</span></label>
							<div class="col-md-8">
								<input type="text" name="teacher_emailid" id="teacher_emailid" class="form-control">
								<span id="error_teacher_emailid" class="text-danger"></span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<label class="col-md-4 text-right">Password<span class="text-danger">*</span></label>
							<div class="col-md-8">
								<input type="Password" name="teacher_password" id="teacher_password" class="form-control">
								<span id="error_teacher_password" class="text-danger"></span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<label class="col-md-4 text-right">Teacher Qualification<span class="text-danger">*</span></label>
							<div class="col-md-8">
								<input type="text" name="teacher_qualification" id="teacher_qualification" class="form-control">
								<span id="error_teacher_qualification" class="text-danger"></span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<label class="col-md-4 text-right">Teacher Grade<span class="text-danger">*</span></label>
							<div class="col-md-8">
								<select class="form-control" id="teacher_grade_id" name="teacher_grade_id">
									<option value="">Select Grade</option>
									<?php echo load_grade_list($connect)?>
								</select>
								<span id="error_teacher_grade_id" class="text-danger"></span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<label class="col-md-4 text-right">Date of joining<span class="text-danger">*</span></label>
							<div class="col-md-8">
								<input type="text" name="teacher_doj" id="teacher_doj" class="form-control" readonly>
								<span id="error_teacher_doj" class="text-danger" ></span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<label class="col-md-4 text-right">Image<span class="text-danger">*</span></label>
							<div class="col-md-8">
								<input type="file" name="teacher_image" id="teacher_image" class="form-control">
								<span class="text-muted"> Only .jpg and .png allowed</span><br />
								<span class="text-danger" id="error_teacher_image"></span>
							</div>
						</div>
					</div>
				</div>


				<div class="modal-footer">
					<input type="hidden" name="hidden_teacher_image" id="hidden_teacher_image">
					<input type="hidden" name="teacher_id" id="teacher_id">
					<input type="hidden" name="action" id="action" value="Add">
					<input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Add">
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</form>
	</div>
</div>


<div class="modal" id="viewModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			
			<div class="modal-header">
				<h4 class="modal-title">Teacher Details</h4>
				<button type="button" class="close" data-dismiss = "modal">&times;</button>
			</div>

			<div class="modal-body" id="teacher_details">
				
			</div>

			<div class="modal-footer">
				<button class="btn btn-danger btn-sm" type="button" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- delete modal -->

<!-- The Modal -->
<div class="modal" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <h3 align="center">Are you sure you want to delete ?</h3>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	<button class="btn btn-primary btn-sm" type="button" id="ok_button" name="ok_button">OK</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!-- Date picker Link -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

	$(document).ready(function(){
		
		var dataTable = $('#teacher_table').DataTable({

			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"teacher_action.php",
				type:"POST",
				data:{action:'fetch'}
			}
			
		}); 

	$('#teacher_doj').datepicker({
		dateFormat:'yy-mm-dd',
		autoclose:true,
		container:'#formModal modal-body'
	});

	function clear_field(){
		$('#teacher_form')[0].reset();
		$('#error_teacher_name').text('');
		$('#error_teacher_address').text('');
		$('#error_teacher_emailid').text('');
		$('#error_teacher_password').text('');
		$('#error_teacher_qualification').text('');
		$('#error_teacher_doj').text('');
		$('#error_teacher_image').text('');
		$('#error_teacher_grade_id').text('');

	}

	$('#add_button').click(function() {
		$('#modal-title').text('Add Teacher');
		$('#button_action').val('Add');
		$('#action').val('Add');
		$('#formModal').modal('show');
		clear_field();
	});


	$('#teacher_form').on('submit', function(event) {
		event.preventDefault();
		
		$.ajax({
			url : "teacher_action.php",
			method:"POST",
			data: new FormData(this),
			dataType :"json",
			contentType:false,
			processData:false,
			before:function(){
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
					if(data.error_teacher_name != '')
					{
						$('#error_teacher_name').text(data.error_teacher_name);
					}
					else
					{
						$('#error_teacher_name').text('');
					}
					if(data.error_teacher_address != '')
					{
						$('#error_teacher_address').text(data.error_teacher_address);
					}
					else
					{
						$('#error_teacher_address').text('');
					}
					if (data.error_teacher_emailid != '')
					{
						$('#error_teacher_emailid').text(data.error_teacher_emailid);
					}
					else
					{
						$('#error_teacher_emailid').text('');
					}
					if(data.error_teacher_password != '')
					{
						$('#error_teacher_password').text(data.error_teacher_password);
					}
					else
					{
						$('#error_teacher_password').text('');
					}
					if(data.error_teacher_qualification != '')
					{
						$('#error_teacher_qualification').text(data.error_teacher_qualification);
					}
					else
					{
						$('#error_teacher_qualification').text('');
					}
					if(data.error_teacher_grade_id != '')
					{
						$('#error_teacher_grade_id').text(data.error_teacher_grade_id);
					}
					else
					{
						$('#error_teacher_grade_id').text('');
					}
					if(data.error_teacher_doj != '')
					{
						$('#error_teacher_doj').text(data.error_teacher_doj);
					} 
					else
					{
						$('#error_teacher_doj').text('');
					}
					if(error_teacher_image != '')
					{
						$('#error_teacher_image').text(data.error_teacher_image);
					}
					else
					{
						$('#error_teacher_image').text('');
					}

				}

			}
		})
	});		


	var teacher_id	= '';

	$(document).on('click' , '.view_teacher', function(){

		teacher_id = $(this).attr('id');

		$.ajax({

			url:"teacher_action.php",
			method:"POST",
			data:{action:'single_fetch' , teacher_id:teacher_id},

			success:function(data){
				$('#viewModal').modal('show');
				$('#teacher_details').html(data);
			}
		})
	});		



	$(document).on('click', '.delete_teacher', function() {
		
		teacher_id = $(this).attr('id');
		$('#deleteModal').modal('show');

		$('#ok_button').click(function() {
			
			$.ajax({

				url:"teacher_action.php",
				method:"POST",
				data:{teacher_id:teacher_id , action:'delete'},
				success:function(data){
					$('#message_operation').html('<div class="alert alert-success">'+data+'</div>');
					
					dataTable.ajax.reload();
					$('#deleteModal').modal('hide');
				}

			});

		});

	});	

});
</script>
