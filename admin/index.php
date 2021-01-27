<?php


include('header.php');



?>


<body style="background-color: #EFEFEF">

<div class="container" style="margin-top:30px">
	<div class="card shadow-lg " >
		<div class="card-header">
			<div class="row">
				<div class="col-md-9">Overall Student Attendance Status </div>
				<div class="col-md-3" align="right"></div>
			</div>
		</div>

		<div class="card-body"> 
			 <div class="table table-responsive">
			 	<table class="table-striped table-bordered table " id="student_table">
			 		<thead>
						<tr>
							<th>Student Name</th>
							<th>Roll No</th>
							<th>Grade</th>
							<th>Teacher</th>
							<th>Attendance Percentage</th>
							<th>Report</th>
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


<!-- The Modal -->
<div class="modal" id="formModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Make Report</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      	<div class="form-group">
      		<select name="report_action" id="report_action" class="form-control">
        		<option value="pdf_report">PDF Report</option>
        		<option value="chart_report"> Chart Report</option>
        	</select>
      	</div>
        <div class="form-group">
					<div class="input-daterange">

						<label>From Date</label>
						<input type="Date" name="from_date" id="from_date" class="form-control" >
						<span class="text-danger" id="error_from_date"></span>
						<br>
						<label>To Date</label>
						<input type="Date" name="to_date" id="to_date" class="form-control">
						<span class="text-danger" id="error_to_date"></span>
					</div>
			</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	<input type="hidden" name="student_id" id="student_id"/>
      	<button type="button" name="create_report" id="create_report" class="btn btn-sm btn-success">Create Report</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script>

$(document).ready(function() {
		var dataTable = $('#student_table').DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"attendance_action.php",
				type:"POST",
				data:{action:'index_fetch'}
			}
		});

		$(document).on('click', '.report_button', function() {
			
			var student_id = $(this).attr('id');

			$('#student_id').val(student_id);
			$('#formModal').modal('show');

		});


		$('#create_report').click(function() {
			
			var student_id = $('#student_id').val();
			var from_date = $('#from_date').val();
			var to_date = $('#to_date').val();
			var error = 0;
			var action = $('#report_action').val();
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
				$('#formModal').modal('hide');
				if(action == 'pdf_report'){	
				window.open("report.php?action=student_report&student_id="+student_id+"&from_date="+from_date+"&to_date="+to_date);
				}
				if(action == 'chart_report')
				{
					location.href = "chart.php?action=student_chart&student_id="+student_id+"&from_date="+from_date+"&to_date="+to_date;
				}
			}

			
		});
});

</script>