<?php include('header.php'); ?>
<?php
	include_once('controller/connect.php');
	
	$dbs = new database();
	$db=$dbs->connection();

	$page="";
	if(isset($_GET['search']))
	{
		$SearchName = $_GET['search'];
		$RecordeLimit = 10;
		$search = mysqli_query($db,"select count(EmpId) as total from employee where RoleId !='1' and (FirstName like '%".$SearchName."%' or MiddleName like '%".$SearchName."%' or LastName like '%".$SearchName."%' or EmployeeId like '%".$SearchName."%')");
		
		$SName = mysqli_fetch_array($search);
		
		$number_of_row =ceil($SName['total']/10); 
		if(isset($_GET['bn']) &&intval($_GET['bn']) <= $number_of_row && intval($_GET['bn'] !=0))
		{

			$Skip = (intval($_GET["bn"]) * $RecordeLimit) - $RecordeLimit;

			$sql = mysqli_query($db,"select * from employee where RoleId !='1' and (FirstName like '%".$SearchName."%' or MiddleName like '%".$SearchName."%' or LastName like '%".$SearchName."%' or EmployeeId like '%".$SearchName."%') LIMIT $Skip,$RecordeLimit ");
		}
		else
		{
			$sql = mysqli_query($db,"select * from employee where RoleId !='1' and (FirstName like '%".$SearchName."%' or MiddleName like '%".$SearchName."%' or LastName like '%".$SearchName."%' or EmployeeId like '%".$SearchName."%') LIMIT $RecordeLimit");
			
		}

		for($i=0;$i<$number_of_row;$i++)
		{
			$d = $i+1;
			if(isset($_GET["search"]))
			{
				$page .= "<a href='?search=$SearchName&bn=$d'>$d</a>&nbsp &nbsp &nbsp";
			}
			else
			{
				$page .= "<a href='?bn=$d'>$d</a>&nbsp &nbsp &nbsp";
			}					            
		} 
	}
	else if(isset($_GET['empid']))
	{
		$empid = $_GET['empid'];
		mysqli_query($db,"delete from employee where EmployeeId='$empid'");
		echo "<script>window.location='employeeview.php';</script>";
	}
	else
	{
		$RecordeLimit = 10;
		$search = mysqli_query($db,"select count(EmployeeId) as total from employee ");
		$SName = mysqli_fetch_array($search);
		
		$number_of_row =ceil($SName['total']/10);
		if(isset($_GET['bn']) && intval($_GET['bn']) <= $number_of_row && intval($_GET['bn'] != 0 ))
		{
			$Skip = (intval($_GET["bn"]) * $RecordeLimit) - $RecordeLimit;
			$sql = mysqli_query($db,"select * from employee where RoleId !='1' LIMIT $Skip,$RecordeLimit");
		}
		else
		{
			$sql = mysqli_query($db,"select * from employee where RoleId !='1' LIMIT $RecordeLimit");
		}

		for($i=0;$i<$number_of_row;$i++)
		{
			$d = $i+1;
		    $page .= "<a href='?bn=$d'>$d</a>&nbsp &nbsp &nbsp";
		}
	}
?>
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<!-- <link rel="stylesheet" type="text/css" href="css/basictable.css" /> -->
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>
<style>
.profile-container {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid #ddd;
    margin: 5px auto;
}

.profile-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.profile-img:hover {
    transform: scale(1.1);
}

.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
}

.modal-content {
    margin: auto;
    display: block;
    width: 320px;
    height: 320px;
    max-width: 700px;
    position: relative;
    top: 50%;
    transform: translateY(-50%);
    object-fit: cover;
    border-radius: 8px;
}
</style>
<ol class="breadcrumb" style="margin: 10px 0px ! important;">
    <li class="breadcrumb-item"><a href="Home.php">Home</a><i class="fa fa-angle-right"></i>Employee<i class="fa fa-angle-right"></i>Employee View</li>
</ol>

<div class="validation-system" style="margin-top: 0;">	
<div class="validation-form">
 	<div>
		<div class="w3l-table-info">
		<h2>Employee View</h2>
		<br>
	  	<form method="GET" action="#">
			<input style="float: right;" type="submit" name="searchview">
			<input style="float: right;" placeholder="Search" value="<?php echo(isset($SearchName))?$SearchName:''; ?>" type="search-box" name="search"><br>
		</form>
		<table id="table">
		<thead>
			<tr>
				<th style="text-transform: capitalize;">Profile Photo</th>
				<th style="text-transform: capitalize;">Name</th>
				<th style="text-transform: capitalize; text-align: center;">Employee Id</th>
				<th style="text-transform: capitalize; text-align: center;">Full Detail</th>
			</tr>
		</thead>
		<tbody>
		<?php while($row = mysqli_fetch_assoc($sql)) { ?>
			<tr>
				<td style="width: 140px;">
				    <div class="profile-container">
				        <img class="profile-img" 
				             alt="<?php 
				                $fname = (isset($row['FirstName'])) ? $row['FirstName'] : "";
				                $mname = (isset($row['MiddleName'])) ? $row['MiddleName'] : "";
				                $lname = (isset($row['LastName'])) ? $row['LastName'] : "";
				                echo ucfirst($fname)."&nbsp;".$mname."&nbsp;".$lname;
				             ?>" 
				             src="image/<?php echo !empty($row['ImageName']) ? htmlspecialchars($row['ImageName']) : 'default.png'; ?>" 
				             onclick="openImageModal(this)">
				    </div>
				</td>
				
				<td><?php $fname= (isset($row['FirstName']))?$row['FirstName']:""; $mname=(isset($row['MiddleName']))?$row['MiddleName']:""; $lname=(isset($row['LastName']))?$row['LastName']:"";echo ucfirst($fname)."&nbsp;".$mname."&nbsp;".$lname; ?></td>

				<td style="width: 105px;"><?php $emp = (isset($row['EmployeeId']))?$row['EmployeeId']:"";  echo ucfirst("<center>".$emp."</center>"); ?></td>
				<td style="text-align: center;"><a href="detailview.php?employeeid=<?php echo $row['EmployeeId'];?>"><u>View</u></a></td>
			</tr>
		<?php }?>
		</tbody>
		</table>
		<div><?php echo $page; ?></div>
		</div>  
	</div>
 </div>
</div>
<!-- The Modal -->
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>

<?php include('footer.php'); ?>



<!--image Popup-->
<script>
function openImageModal(img) {
    var modal = document.getElementById('myModal');
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    
    modal.style.display = "block";
    modalImg.src = img.src;
    captionText.innerHTML = img.alt;
}

// Close modal when clicking outside
window.onclick = function(event) {
    var modal = document.getElementById('myModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Close on X button
document.getElementsByClassName("close")[0].onclick = function() {
    document.getElementById('myModal').style.display = "none";
}

// Close on Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === "Escape") {
        document.getElementById('myModal').style.display = "none";
    }
});
</script>
<!--End image Popup -->