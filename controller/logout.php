<?php
	session_start();
	include_once('connect.php');
	
	$dbs = new database();
	$db=$dbs->connection();
	
	if (isset($_SESSION['User']['EmployeeId'])) {
		$emp = $_SESSION['User']['EmployeeId'];
	} else {
		$emp = null;
	}
	
	if ($emp == 1) {
		// Admin logout, no need to update DB
	} else if ($emp) {
		// Non-admin: update logout time and workload
		$email = $_SESSION['User']['Email'];
		date_default_timezone_set("Asia/Kolkata");
		$datetime = date("Y-m-d H:i:s");
		$date = date("Y-m-d");
		$empid = $_SESSION['User']['EmployeeId'];
		mysqli_query($db,"update employee set LastLogout='$datetime' where Email='$email' ");
		
		if (isset($_SESSION['dailyid'])) {
			$datetimeid = $_SESSION['dailyid'];
			$logindateid = mysqli_query($db,"select * from dailyworkload where DailyWorkLoadId='$datetimeid'");	
			$LoginDate = mysqli_fetch_assoc($logindateid);
			$logind = $LoginDate['LoginDate'];

			/*hours count*/
			$date1 = date($logind);
			$date2 = date($datetime);
			$hours = ((strtotime($date2) - strtotime($date1))/60);
			/*end */ 

			/*Day count*/
			$date11=date_create($date1);
			$date22=date_create($date2);
			$diff=date_diff($date11,$date22);
			$n = $diff->format("%a");
			/*end */

			mysqli_query($db,"update dailyworkload set LogoutDate='$datetime',DailyWorkingminutes='$hours' where EmpId='$empid' and cast(LoginDate as date) = '$date'");
		}
	}

	// Unset all session variables
	$_SESSION = array();

	// If session uses cookies, delete the session cookie
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}

	// Destroy the session
	session_destroy();

	// Redirect
	if ($emp == 1) {
		header('Location: ../index.php');
	} else {
		header('Location: ../user/index.php');
	}
	exit;