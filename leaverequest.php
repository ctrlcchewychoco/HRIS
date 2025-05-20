<?php include('header.php');?>
<?php
  include_once('controller/connect.php');
  
  $dbs = new database();
  $db=$dbs->connection();
  $Statusl = "Pending";
  $leavedetails = mysqli_query($db,"select * from leavedetails where LeaveStatus='$Statusl'");
  if(isset($_GET['id']))
  {
    $acceptid = $_GET['id'];
    $accept = "Accept";
    mysqli_query($db,"update leavedetails set LeaveStatus='$accept' where Detail_Id='$acceptid'");
    echo "<script>window.location='leaverequest.php';</script>";
  }
  else if(isset($_GET['msg']))
  {
    $deniedid = $_GET['msg'];
    $denied = "Denied";
    mysqli_query($db,"update leavedetails set LeaveStatus='$denied' where Detail_Id='$deniedid'");
    echo "<script>window.location='leaverequest.php';</script>";
  }

  $laccept = mysqli_query($db,"SELECT l.*,e.FirstName,e.LastName,lt.Type_of_Name FROM leavedetails l JOIN employee e ON l.EmpId=e.EmployeeId JOIN type_of_leave lt on l.TypesLeaveId=lt.LeaveId WHERE LeaveStatus='Accept'");
  $ldenied = mysqli_query($db,"SELECT l.*,e.FirstName,e.LastName,lt.Type_of_Name FROM leavedetails l JOIN employee e ON l.EmpId=e.EmployeeId JOIN type_of_leave lt on l.TypesLeaveId=lt.LeaveId WHERE LeaveStatus='Denied'");
  
?>
<ol class="breadcrumb" style="margin: 10px 0px ! important;">
    <li class="breadcrumb-item"><a href="Home.php">Home</a><i class="fa fa-angle-right"></i>Leave<i class="fa fa-angle-right"></i>Leave</li>
</ol>
<form method="POST">
<div class="validation-form">
  <h2>Request Leave</h2>
  <div class="row" style="color: white; margin-right: 0; margin-left: 0;">
    <div style="background: #202a29;" class="col-md-1 control-label">
            <h5>ID</h5>
        </div>
        <div style="background: #202a29;" class="col-md-2 control-label">
            <h5>Name</h5>
        </div>
        <div style="background: #202a29; text-align: center;" class="col-md-1 control-label">
            <h5>Emp ID</h5>
        </div>
        <div style="background: #202a29;" class="col-md-2 control-label">
            <h5>Leave Status</h5>
        </div>
        <div style="background: #202a29; " class="col-md-1 control-label">
            <h5>Reason</h5>
        </div>
        <div style="background: #202a29; text-align: center;" class="col-md-2 control-label">
            <h5>StartDate</h5>
        </div>
        <div style="background: #202a29; text-align: center;" class="col-md-2 control-label">
            <h5>EndDate</h5>
        </div>
        <div style="background: #202a29; text-align: center;" class="col-md-1 control-label">
            <h5>Action</h5>
        </div>
    </div>
    
    <?php $i=1; 
    if ($leavedetails) {  // Check if query was successful
        while($row = mysqli_fetch_assoc($leavedetails)) {
            $empid = isset($row['EmpId']) ? $row['EmpId'] : '';
            
            // Use prepared statement to prevent SQL injection
            $stmt = mysqli_prepare($db, "SELECT * FROM employee WHERE EmployeeId=?");
            mysqli_stmt_bind_param($stmt, 's', $empid);
            mysqli_stmt_execute($stmt);
            $name = mysqli_stmt_get_result($stmt);
            $empname = mysqli_fetch_assoc($name);
            
            // Safely concatenate names
            $firstName = isset($empname['FirstName']) ? ucfirst($empname['FirstName']) : '';
            $lastName = isset($empname['LastName']) ? ucfirst($empname['LastName']) : '';
            $namem = $firstName . ($firstName && $lastName ? " " : "") . $lastName;
            
            // Get leave type safely
            $typen = isset($row['TypesLeaveId']) ? $row['TypesLeaveId'] : '';
            if ($typen) {
                $stmt = mysqli_prepare($db, "SELECT * FROM type_of_leave WHERE LeaveId=?");
                mysqli_stmt_bind_param($stmt, 's', $typen);
                mysqli_stmt_execute($stmt);
                $typeid = mysqli_stmt_get_result($stmt);
                $typename = mysqli_fetch_assoc($typeid);
            }
    ?>
    <div class="row" style="margin-right: 0; margin-top: 10px; margin-left: 0;">
      <div class="col-md-1"><?php echo $i++; ?></div>
      <div class="col-md-2"><?php echo htmlspecialchars($namem); ?></div>
      <div class="col-md-1" style="text-align: center;">
          <?php echo htmlspecialchars($empid); ?>
      </div>
      <div class="col-md-2">
          <?php echo isset($typename['Type_of_Name']) ? htmlspecialchars(ucfirst($typename['Type_of_Name'])) : ''; ?>
      </div>
      <div class="col-md-1">
          <?php echo isset($row['Reason']) ? htmlspecialchars(ucfirst($row['Reason'])) : ''; ?>
      </div>
      <div class="col-md-2" style="text-align: center;">
          <?php echo isset($row['StateDate']) ? htmlspecialchars($row['StateDate']) : ''; ?>
      </div>
      <div class="col-md-2" style="text-align: center;">
          <?php echo isset($row['EndDate']) ? htmlspecialchars($row['EndDate']) : ''; ?>
      </div>
      
      <div class="col-md-1" style="text-align: center;">
        <a href="#" onclick="return confirmAccept('<?php echo $row['Detail_Id'];?>')" title="Accept">
            <i class="fa fa-check" aria-hidden="true"></i>
        </a>
        &nbsp;&nbsp;
        <a href="#" onclick="return confirmDeny('<?php echo $row['Detail_Id'];?>')" title="Denied">
            <i class="fa fa-times" style="color: #202a29;" aria-hidden="true"></i>
        </a>
      </div>
    </div><hr style="margin-bottom: 0px;margin-top: 0px;border-top: 1px solid #eee;">
      <?php }}?>    
</div>

<div class="validation-form" style="margin-bottom: 0px;margin-top: 10px;">
<h2>Accepted Leave</h2>
<div class="row" style="color: white; margin-right: 0; margin-left: 0;">
  <div class="col-md-1" style="background-color: #202a29;">
    <h5>ID</h5>
  </div>
  <div class="col-md-4" style="background-color: #202a29;">
    <h5>Name</h5>
  </div>
  <div class="col-md-3" style="background-color: #202a29;">
    <h5>Leave Type</h5>
  </div>
  <div class="col-md-2" style="background-color: #202a29;">
    <h5>Start Date</h5>
  </div>
  <div class="col-md-2" style="background-color: #202a29;">
    <h5>End Date</h5>
  </div>
</div>

    <?php $i=1; while($row = mysqli_fetch_assoc($laccept)) { 
      $name = ucfirst($row['FirstName']." ".$row['LastName']);
      ?>
<div class="row" style="margin-right: 0; margin-left: 0;">
  <div class="col-md-1">
    <h5><?php $i=$i; echo $i; $i++;?></h5>
  </div>
  <div class="col-md-4">
    <h5><?php echo(isset($name))?$name:"";?></h5>
  </div>
  <div class="col-md-3">
    <h5><?php echo(isset($row['Type_of_Name']))?$row['Type_of_Name']:"";?></h5>
  </div>
  <div class="col-md-2">
    <h5><?php echo(isset($row['StateDate']))?$row['StateDate']:"";?></h5>
  </div>
  <div class="col-md-2">
    <h5><?php echo(isset($row['EndDate']))?$row['EndDate']:"";?></h5>
  </div>
</div><hr style="margin-bottom: 0px;margin-top: 0px;border-top: 1px solid #eee;">
<?php } ?>
<div class="clearfix"></div>
</div>

<div class="validation-form" style="margin-bottom: 30px;margin-top: 10px;">
<h2>Denied Leave</h2>
<div class="row" style="color: white; margin-right: 0; margin-left: 0;">
  <div class="col-md-1" style="background-color: #202a29;">
    <h5>ID</h5>
  </div>
  <div class="col-md-4" style="background-color: #202a29;">
    <h5>Name</h5>
  </div>
  <div class="col-md-3" style="background-color: #202a29;">
    <h5>Leave Type</h5>
  </div>
  <div class="col-md-2" style="background-color: #202a29;">
    <h5>Start Date</h5>
  </div>
  <div class="col-md-2" style="background-color: #202a29;">
    <h5>End Date</h5>
  </div>
</div>

    <?php $i=1; while($row = mysqli_fetch_assoc($ldenied)) {
      $name = ucfirst($row['FirstName']." ".$row['LastName']);
      ?>
<div class="row" style="margin-right: 0; margin-left: 0;">
  <div class="col-md-1">
    <h5><?php $i=$i; echo $i; $i++;?></h5>
  </div>
  <div class="col-md-4">
    <h5><?php echo(isset($name))?$name:"";?></h5>
  </div>
  <div class="col-md-3">
    <h5><?php echo(isset($row['Type_of_Name']))?$row['Type_of_Name']:"";?></h5>
  </div>
  <div class="col-md-2">
    <h5><?php echo(isset($row['StateDate']))?$row['StateDate']:"";?></h5>
  </div>
  <div class="col-md-2">
    <h5><?php echo(isset($row['EndDate']))?$row['EndDate']:"";?></h5>
  </div>
</div><hr style="margin-bottom: 0px;margin-top: 0px;border-top: 1px solid #eee;">
<?php } ?>
</div>
<div class="clearfix"></div>
</form>
<script>
function confirmAccept(id) {
    if(confirm("Are you sure you want to accept this leave request?")) {
        window.location.href = "?id=" + id;
    }
    return false;
}

function confirmDeny(id) {
    if(confirm("Are you sure you want to deny this leave request?")) {
        window.location.href = "?msg=" + id;
    }
    return false;
}
</script>
<?php include('footer.php'); ?>


