<?php

include('database_connection.php');


session_start();


if(!isset($_SESSION["admin_id"]))
{

	header('location:login.php');

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Student Attendance System</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">

  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  	<link rel="stylesheet"  href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
  	
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
     
    <!-- datatable -->
  	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> 
  
     
</head>

	<nav class="navbar navbar-expand-md navbar-dark bg-dark ">
  <a class="navbar-brand " href="index.php">Student Attendance System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarNav">
    <ul class="navbar-nav ml-auto">
       <li class="nav-item">
        <a class="nav-link " href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="grade.php">Grade</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="teacher.php">Teacher</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="student.php">Student</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="attendance.php">Attendance</a>
      </li>
      <li class="nav-item ml-2">
       <a class="nav-link btn btn-sm btn-danger rounded-pill" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
