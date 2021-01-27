<?php

include('header.php');

?>

<body style="background-color: #EFEFEF">
<div class="container-fluid"  style="margin-top: 10px">
	<div class="col-md-12" >
		<div class="row">
			<div class="col-md-8">
				<div class="card shadow-lg mt-3">
					<div class="card-header">
						<div class="row">
							<div class="col-md-9">Attendance List</div>
							<div class="col-md-3" align="right">
								<button class="btn btn-danger btn-sm" id="chart_button" name="chart_button">Chart</button>
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
										<th>Teacher</th>
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
								<select name="grade_id" id="grade_id" class="form-control">
									<option value="">Select Grade</option>
									<?php echo load_grade_list($connect);?>
								</select>
								<span id="error_grade_id" class="text-danger"></span>
							</div>
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


<!-- Add menu -->
<div class="modal" id="chartModal">
	<div class="modal-dialog">
		<form method="POST" id="grade_form">
			<div class="modal-content">

				<!-- modal header -->
				<div class="modal-header">
					<h4 class="modal-title" id="modal_title"></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- modal body -->
				<div class="modal-body">
					<div class="form-group">
								<select name="chart_grade_id" id="chart_grade_id" class="form-control">
									<option value="">Select Grade</option>
									<?php echo load_grade_list($connect);?>
								</select>
								<span id="error_chart_grade_id" class="text-danger"></span>
					</div>

					<div class="form-group">
								<div class="input-daterange">
									<label>Select Date</label>
									<input type="Date" name="attendance_date" id="attendance_date" class="form-control">
									<span class="text-danger" id="error_attendance_date"></span>
								</div>
					</div>
				</div>


				<!-- modal footer -->
				<div class="modal-footer">
					<button type="button" name="create_chart" id="create_chart" class="btn btn-success btn-sm">Create Chart</button>
					<input type="button" class="btn btn-danger btn-sm" data-dismiss="modal" value="Close">
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
				type:"POST",
				data:{action:'fetch'}
			}
		});

		$(document).on('click', '#report_button', function() {
			
			$('#report_button').modal('show');
		});

		$('#create_report').click(function() {
			/* Act on the event */

			var grade_id = $('#grade_id').val();
			var from_date = $('#from_date').val();
			var to_date = $('#to_date').val();
			var error = 0;

			if(grade_id == '')
			{
 				$('#error_grade_id').text('Grade is Required');
 				error++;
			}
			else
			{
				$('#error_grade_id').text('');
			}
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
				window.open("report.php?action=attendance_report&grade_id="+grade_id+"&from_date="+from_date+"&to_date="+to_date);
			}

		});


		$('#chart_button').click(function() {
				
				$('#chart_grade_id').val();
				$('#attendance_date').val();
				$('#chartModal').modal('show');
		});

		$('#create_chart').click(function() {
			var grade_id = $('#chart_grade_id').val();
			var attendance_date = $('#attendance_date').val();
			var error = 0;

			if(grade_id == '')
			{
 				$('#error_chart_grade_id').text('Grade is Required');
 				error++;
			}
			else
			{
				$('#error_chart_grade_id').text('');
			}
			if(attendance_date == '')
			{
 				$('#error_attendance_date').text('From Date is Required');
 				error++;
			}
			else
			{
				$('#error_attendance_date').text('');
			}

			if(error == 0)
			{
				$('#attendance_date').val('');
				$('#chart_grade_id').val('');
				$('#chartModal').modal('hide');
				window.open("overall_chart.php?action=attendance_report&grade_id="+grade_id+"&date="+attendance_date);
			}
		});
	});
</script>