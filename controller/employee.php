<?php
	include_once('./connect.php');
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	$dbs = new database();
	$db=$dbs->connection();
	session_start();
	if(isset($_POST['submit']))
	{
		$data=$_POST;
		$editid = isset($_GET['empedit']) && !empty($_GET['empedit']) ? $_GET['empedit'] : false;
		$empid=$data['empid'];
		$img=$_FILES['imagefilename']['name'];
		$gender=$data['gender'];
		$fname=$data['fname'];
		$mname=$data['mname'];
		$lname=$data['lname'];
		$bdate=$data['bdate'];
		$mnumber=$data['mnumber'];
		$email=$data['email'];
		$address1=$data['PresentAddress'];
		$address2=$data['PermanentAddress'];
		// $address3=$data['address3'];
		$city=$data['city'];
		$joindate=$data['joindate'];
		// $leavedate=$data['leavedate'];
		$status=$data['status'];
		$role=$data['role'];
		$password=$data['password'];
		$marital=$data['marital'];
		$position=$data['position'];
		$sss=$data['sss'] ?? '';
		$philhealth = $data['philhealth'] ?? '';
		$pagibig = $data['pagibig'] ?? '';
		$taxidentification = $data['taxidentification'] ?? '';
		$barangay = $data['barangay'];
		$birthcertificate = $data['birthcertificate'];
		$marriagecert = $data['marriagecert'];
		$diplomator = $data['diplomator'];
		$healtcertificate = $data['healtcertificate'];
		$educationalbackground = $data['educationalbackground'];
		$educcourse = $data['educcourse'];
		$citizenship = $data['citizenship'];
		$placeofbirth = $data['placeofbirth'];
		$religion = $data['religion'];
		$height = $data['height'];
		$weight = $data['weight'];
		$emergencyname = $data['contactpersonname'];
		$emercontact = $data['contactpersonnumber'];
		// $memo = $data['memo'];
		// $memodate = $data['memodate'];
		// $memonote = $data['memonote'];
		$ImageComplete=false;

		if(!$editid){
			$sql = mysqli_query($db,"select * from employee where Email='$email'");
		}
		else{
			$stmt = $db->prepare("SELECT * FROM employee WHERE Email = ? AND EmployeeId != ?");
			$stmt->bind_param("ss", $email, $editid);
			$stmt->execute();
			$sql = $stmt->get_result();
		}
		
		if(mysqli_num_rows($sql) > 0)
		{
			header("location:../employeeadd.php?msg=Email address all ready existed!");exit;
		}
		else
		{
			if(!empty($_FILES['imagefilename']['name']))
			{
				$name=$_FILES['imagefilename']['name'];
				$temp=$_FILES['imagefilename']['tmp_name'];
				$size=$_FILES['imagefilename']['size'];
				$type=$_FILES['imagefilename']['type'];
				echo 'image world';
	
				if($type != "image/jpg" && $type != "image/png" && $type != "image/jpeg" && $type != "image/gif")
				{
					 header("location:../employeeadd.php?msg=Invalid image !");exit;
				}
				else
				{
					if($size > 5000000)
					{
						 header("location:../employeeadd.php?msg=File size upto 1MB required ! ");exit;
					}
					else
					{	
						$ImageComplete=true;
					}				
				}
			}
			else
			{
				$in = $_POST["imagefilename"];
				
				if(file_exists("../image/".$in))
				{
					$ImageComplete=true;
				}
				else
				{
					 header("location:../employeeadd.php?msg=Pleaes Select Profile Image! ");exit;	
				}
			}	
		}

		if($ImageComplete)
		{
			$roleid = $_SESSION['User']['RoleId'];
			date_default_timezone_set("Asia/Manila");
			$datetime = date("Y-m-d h:i:s");

			if(!$editid)
			{
				if(!empty($_FILES['imagefilename']['name']))
				{
					$name = rand(222,333333).$name;
					move_uploaded_file($temp,"../image/".$name);
				}
				else
				{
					$name = $_POST["imagefilename"];
				}
// dito 
				$stmt = $db->prepare("INSERT INTO employee(
				EmployeeId, Firstname, MiddleName, LastName, Birthdate, Gender, PresentAddress, PermanentAddress, CityId, Mobile, Email, Password, MaritalStatus, PositionId, CreatedBy, JoinDate, StatusId, RoleId, sss, philhealth, pagibig, taxidentification, barangay, birthcertificate, marriagecert, diplomator, healtcertificate, educationalbackground, educcourse, citizenship, placeofbirth, religion, height, weight, contactpersonname, contactpersonnumber, ImageName)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$stmt->bind_param("sssssssssssssssssssssssssssssssssssss", $empid, $fname, $mname, $lname, $bdate, $gender, $address1, $address2, $city, $mnumber, $email, $password, $marital, $position, $roleid, $joindate, $status, $role, $sss, $philhealth, $pagibig, $taxidentification, $barangay, $birthcertificate, $marriagecert, $diplomator, $healtcertificate, $educationalbackground, $educcourse, $citizenship, $placeofbirth, $religion, $height, $weight, $emergencyname, $emercontact, $name);

				if($stmt->execute())
				{
					header("location:../detailview.php?employeeid=$empid ");exit;
				}
				else
				{
					echo 'error';
					echo mysqli_error($db);
				 header("location:../employeeadd.php?msg=Error in adding employee!");exit;
				}



			}
			else
			{
				if(!empty($_FILES['imagefilename']['name']))
				{
					$name = rand(222,333333).$name;
					move_uploaded_file($temp,"../image/".$name);
				}
				else
				{
					$name = $_POST["imagefilename"];
				}

				if(!empty($_FILES['imagefilename']['name']))
				{
					$stmt = $db->prepare("UPDATE employee SET 
						EmployeeId=?, 
						Firstname=?, 
						MiddleName=?, 
						LastName=?, 
						Birthdate=?, 
						Gender=?, 
						PresentAddress=?, 
						PermanentAddress=?, 
						CityId=?, 
						Mobile=?, 
						Email=?, 
						Password=?, 
						MaritalStatus=?, 
						PositionId=?, 
						CreatedBy=?, 
						JoinDate=?, 
						StatusId=?, 
						RoleId=?, 
						sss=?, 
						philhealth=?, 
						pagibig=?, 
						taxidentification=?, 
						barangay=?, 
						birthcertificate=?, 
						marriagecert=?, 
						diplomator=?, 
						healtcertificate=?, 
						educationalbackground=?, 
						educcourse=?, 
						citizenship=?, 
						placeofbirth=?, 
						religion=?, 
						height=?, 
						weight=?,
						contactpersonname=?,
						contactpersonnumber=?,
						ImageName=? 
					WHERE EmployeeId=?");

					$stmt->bind_param("ssssssssssssssssssssssssssssssssssssss", $editid, $fname, $mname, $lname, $bdate, $gender, $address1, $address2, $city, $mnumber, $email, $password, $marital, $position, $roleid, $joindate, $status, $role, $sss, $philhealth, $pagibig,$taxidentification,$barangay,$birthcertificate,$marriagecert,$diplomator,$healtcertificate,$educationalbackground,$educcourse,$citizenship,$placeofbirth,$religion,$height,$weight, $emergencyname, $emercontact, $name, $editid);
				}
				else
				{
					$stmt = $db->prepare("UPDATE employee SET 
						EmployeeId=?, 
						Firstname=?, 
						MiddleName=?, 
						LastName=?, 
						Birthdate=?, 
						Gender=?, 
						PresentAddress=?, 
						PermanentAddress=?, 
						CityId=?, 
						Mobile=?, 
						Email=?, 
						Password=?, 
						MaritalStatus=?, 
						PositionId=?, 
						CreatedBy=?, 
						JoinDate=?, 
						StatusId=?, 
						RoleId=?, 
						sss=?, 
						philhealth=?, 
						pagibig=?, 
						taxidentification=?, 
						barangay=?, 
						birthcertificate=?, 
						marriagecert=?, 
						diplomator=?, 
						healtcertificate=?, 
						educationalbackground=?, 
						educcourse=?, 
						citizenship=?, 
						placeofbirth=?, 
						religion=?, 
						height=?, 
						weight=?,
						contactpersonname=?,
						contactpersonnumber=?
					WHERE EmployeeId=?");

					$stmt->bind_param("sssssssssssssssssssssssssssssssssssss", $editid, $fname, $mname, $lname, $bdate, $gender, $address1, $address2, $city, $mnumber, $email, $password, $marital, $position, $roleid, $joindate, $status, $role, $sss, $philhealth, $pagibig,$taxidentification,$barangay,$birthcertificate,$marriagecert,$diplomator,$healtcertificate,$educationalbackground,$educcourse,$citizenship,$placeofbirth,$religion,$height,$weight, $emergencyname, $emercontact, $editid);
				}

				if($stmt->execute())
				{
					header("location:../detailview.php?employeeid=$editid");exit;
				}
				else
				{
					echo 'error';
					echo mysqli_error($db);
					header("location:../employeeadd.php?msg=Error in adding employee!");exit;
				}

			}
			/*"(EmpId,EmployeeId,FirstName,MiddleName,LastName,Birthdate,Gender,Address1,Address2,Address3,CityId,Mobile,Email,Password,AadharNumber,MaritalStatus,PositionId,CreatedBy,CreatedDate,ModifiedBy,ModifiedDate,JoinDate,LeaveDate,LastLogin,LastLogout,StatusId,RoleId,ImageName,MacAddress)";*/
		}
	}
?>