<?php

include('database_connection.php');

session_start();

$output = '';
if(isset($_POST["action"]))
{

	if ($_POST["action"] == "fetch")
	{

		$query = "
		SELECT * FROM tbl_student
		INNER JOIN tbl_grade
		ON tbl_grade.grade_id = tbl_student.student_grade_id
		";

		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			WHERE tbl_student.student_name LIKE "%'.$_POST["search"]["value"].'%"
			OR tbl_student.student_roll_number LIKE "%'.$_POST["search"]["value"].'%" 
			OR tbl_student.student_dob LIKE "%'.$_POST["search"]["value"].'%"
			OR tbl_grade.grade_name LIKE "%'.$_POST["search"]["value"].'%"
			';
		}
		if(isset($_POST["order"]))
		{
		 	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$query .= '
				ORDER BY tbl_student.student_id DESC
			';
		}
		if($_POST["length"] != -1)
		{
		 	$query .= 'LIMIT ' . $_POST['start'] . ', '.$_POST['length'];
		}
		
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$filtered_row = $statement->rowCount();

	    $data = array();

	    foreach ($result as $row) {
	    	
	    	$sub_array = array();

	    	$sub_array[] = $row['student_name'];
	    	$sub_array[] = $row['student_roll_number'];
	    	$sub_array[] = $row['student_dob'];
	    	$sub_array[] = $row['grade_name'];
	    	$sub_array[] = '<a href="edit_student.php?action='.base64_encode($row['student_id']).'"><button type="button" class="btn btn-primary btn-sm edit_student" name="edit_student" id="'.$row['student_id'].'">Edit</button></a>';
	    	$sub_array[] = '<button type="button" class="btn btn-danger btn-sm delete_student" name="delete_student" id="'.$row['student_id'].'">Delete</button>';
	    	$data[] = $sub_array;
	    }

	    $output = array(
	    	
	    	"draw" => intval($_POST['draw']),
	    	"recordsTotal" => $filtered_row,
	    	"recordsFiltered" => get_total_records($connect, 'tbl_student'),
	    	"data" => $data

	    );
	}

	    if($_POST["action"] == 'Add' || $_POST["action"] == 'Edit')
	    {
	    	$student_name = '';
	    	$student_roll_number = '';
	    	$student_dob = '';
	    	$student_grade_id = '';
	    	$error_student_name = '';
	    	$error_student_roll_number = '';
	    	$error_student_dob = '';
	    	$error_student_grade_id = '';

	    	$error = 0;

	    	if(empty($_POST['student_name']))
	    	{
	    		$error_student_name = 'Enter student name ';
	    		$error++;
	    	}
	    	else
	    	{
	    		$student_name = $_POST['student_name'];
	    	}

	    	if(empty($_POST['student_roll_number']))
	    	{
	    		$error_student_roll_number = 'Enter your roll number';
	    		$error++;

	    	}
	    	else
	    	{
	    		$student_roll_number = $_POST['student_roll_number'];
	    	}

	    	if (empty($_POST['student_dob']))
	    	{
	    		$error_student_dob = 'Enter Date of Birth';
	    		$error++;
	    	}
	    	else
	    	{
	    		$student_dob = $_POST['student_dob'];
	    	}
	    	if (empty($_POST['student_grade_id']))
	    	{
	    		$error_student_grade_id = 'Enter grade id';
	    		$error++;
	    	}
	    	else
	    	{
	    		$student_grade_id = $_POST["student_grade_id"];
	    	}

	    	if ($error > 0)
			{
				$output = array(

					'error' => true,
					'error_student_name' => $error_student_name,
					'error_student_roll_number' =>$error_student_roll_number,
					'error_student_dob' => $error_student_dob,
					'error_student_grade_id' =>$error_student_grade_id

				);
			}
			else
			{
				if($_POST["action"] == 'Add')
				{
					$data = array(

						':student_name' => $student_name,
						':student_roll_number' => $student_roll_number,
						':student_dob' => $student_dob,
						':student_grade_id' => $student_grade_id
					);

					$query = "INSERT INTO tbl_student (student_name, student_roll_number, student_dob, student_grade_id) 
					VALUES (:student_name, :student_roll_number, :student_dob, :student_grade_id)
					";

					$statement = $connect->prepare($query);
					if($statement->execute($data))
					{
						$output = array(
							'success' => 'Data Added Successfully'
						);
					}
				}
			}

	    }
	echo json_encode($output);
	
	if($_POST["action"] == "delete")
	{
		$query = "
			DELETE FROM tbl_student
			WHERE student_id = '".$_POST["student_id"]."'
		";

		$statement = $connect->prepare($query);
		if ($statement->execute()) {
			
			echo "Data Delete Successfully";

		}
	}



}





?>