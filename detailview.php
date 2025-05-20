<?php include('header.php'); ?>
<?php
    // Enable error reporting for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include_once('controller/connect.php');
    
    $dbs = new database();
    $db = $dbs->connection();
    
    // Verify connection
    if(mysqli_connect_errno()) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Initialize variables
    $row = [];
    $gendern = [];
    $maritaln = [];
    $cityn = [];
    $staten = [];
    $countryn = [];
    $positionn = [];
    $rolen = [];
    $citizenshipn = [];
    
    // Formatting functions
    function formatSSSNumber($sss) {
        if(!empty($sss) && strlen($sss) == 10) {
            return substr($sss, 0, 2) . '-' . substr($sss, 2, 7) . '-' . substr($sss, 9, 1);
        }
        return $sss;
    }

    function formatPagIbigNumber($pagibig) {
        if(!empty($pagibig) && strlen($pagibig) == 12) {
            return substr($pagibig, 0, 4) . '-' . 
                   substr($pagibig, 4, 4) . '-' . 
                   substr($pagibig, 8, 4);
        }
        return $pagibig;
    }

    function formatPhilhealthNumber($philhealth) {
        if(!empty($philhealth) && strlen($philhealth) == 12) {
            return substr($philhealth, 0, 2) . '-' . 
                   substr($philhealth, 2, 9) . '-' . 
                   substr($philhealth, 11, 1);
        }
        return $philhealth;
    }

    function formatTINNumber($tin) {
        if(!empty($tin) && strlen($tin) == 12) {
            return substr($tin, 0, 4) . '-' . 
                   substr($tin, 4, 4) . '-' . 
                   substr($tin, 8, 4);
        }
        return $tin;
    }
    
    if(isset($_GET['employeeid'])) {
        $empid = mysqli_real_escape_string($db, $_GET['employeeid']);

        $view = mysqli_query($db, "SELECT * FROM employee WHERE EmployeeId = '$empid'");
        
        if(!$view) {
            die("Query failed: " . mysqli_error($db));
        }

        $row = mysqli_fetch_assoc($view);
        
        if($row) {
            // Get gender information
            $genderid = isset($row['Gender']) ? $row['Gender'] : null;
            if($genderid) {
                $gid = mysqli_query($db, "SELECT * FROM gender WHERE GenderId = '$genderid'");
                $gendern = $gid ? mysqli_fetch_assoc($gid) : [];
            }

            // Get marital status
            $maritalid = isset($row['MaritalStatus']) ? $row['MaritalStatus'] : null;
            if($maritalid) {
                $mid = mysqli_query($db, "SELECT * FROM maritalstatus WHERE MaritalId = '$maritalid'");
                $maritaln = $mid ? mysqli_fetch_assoc($mid) : [];
            }

            // Get city information
            $cityid = isset($row['CityId']) ? $row['CityId'] : null;
            if($cityid) {
                $cid = mysqli_query($db, "SELECT * FROM city WHERE CityId = '$cityid'");
                $cityn = $cid ? mysqli_fetch_assoc($cid) : [];
                
                // Get state information
                if($cityn && isset($cityn['StateId'])) {
                    $stateid = $cityn['StateId'];
                    $sid = mysqli_query($db, "SELECT * FROM state WHERE StateId = '$stateid'");
                    $staten = $sid ? mysqli_fetch_assoc($sid) : [];
                    
                    // Get country information
                    if($staten && isset($staten['CountryId'])) {
                        $countryid = $staten['CountryId'];
                        $couid = mysqli_query($db, "SELECT * FROM country WHERE CountryId = '$countryid'");
                        $countryn = $couid ? mysqli_fetch_assoc($couid) : [];
                    }
                }
            }

            // Get position information
            $positionid = isset($row['PositionId']) ? $row['PositionId'] : null;
            if($positionid) {
                $pid = mysqli_query($db, "SELECT * FROM position WHERE PositinId = '$positionid'");
                $positionn = $pid ? mysqli_fetch_assoc($pid) : [];
            }

            // Get role information
            $roleid = isset($row['RoleId']) ? $row['RoleId'] : null;
            if($roleid) {
                $rid = mysqli_query($db, "SELECT * FROM role WHERE RoleId = '$roleid'");
                $rolen = $rid ? mysqli_fetch_assoc($rid) : [];
            }

            // Get citizenship information
            $citizenshipid = isset($row['citizenship']) ? $row['citizenship'] : null;
            if($citizenshipid) {
                $cdd = mysqli_query($db, "SELECT * FROM citizen WHERE Citizenid = '$citizenshipid'");
                $citizenshipn = $cdd ? mysqli_fetch_assoc($cdd) : [];
            }
        }
    }
    
    // Handle form actions
    if(isset($_POST['delete'])) {
        header("Location: employeeview.php?empid=$empid");
        exit();
    }
    else if(isset($_POST['edit'])) {
        header("Location: employeeadd.php?empid=$empid");
        exit();
    }
?>
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();
      $('#table-breakpoint').basictable({ breakpoint: 768 });
      $('#table-swap-axis').basictable({ swapAxis: true });
      $('#table-force-off').basictable({ forceResponsive: false });
      $('#table-no-resize').basictable({ noResize: true });
      $('#table-two-axis').basictable();
      $('#table-max-height').basictable({ tableWrapper: true });
    });
</script>
<ol class="breadcrumb" style="margin: 10px 0px ! important;">
    <li class="breadcrumb-item"><a href="Home.php">Home</a><i class="fa fa-angle-right"></i>Tables<i class="fa fa-angle-right"></i>Employee View<i class="fa fa-angle-right"></i>Detail View</li>
</ol>
<div class="validation-form" style="margin-top: 0;">
    <h2 style="text-transform: capitalize; margin: 0px;">
        <?php 
            if(!empty($row)) { 
                echo htmlspecialchars(
                    (!empty($row['FirstName']) ? $row['FirstName'] : '') . " " . 
                    (!empty($row['MiddleName']) ? $row['MiddleName'] : '') . " " . 
                    (!empty($row['LastName']) ? $row['LastName'] : '')
                ); 
            } else { 
                echo "Employee Not Found"; 
            } 
        ?> 
        <font color="black">
            <?php 
                if(!empty($row)) { 
                    echo "Employee ID :: " . (!empty($row['EmployeeId']) ? $row['EmployeeId'] : 'N/A'); 
                } else { 
                    echo "<b>Employee ID</b> :: N/A"; 
                }
            ?>
        </font>
    </h2>
    <div class="row">
        <div class="col-md-5">
            <table>
                <tbody>
                    <tr>
                        <td rowspan="2" style="text-align: right;"><b>Photo</b>&nbsp; ::</td>
                        <td rowspan="2">
                            <img src="image/<?php echo !empty($row['ImageName']) ? htmlspecialchars($row['ImageName']) : 'default.png'; ?>" 
                                 style="height: 100px; border: double;" 
                                 onerror="this.src='image/default.png'">
                        </td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Present Address</b> &nbsp;::</td>
                        <td><?php echo !empty($row['PresentAddress']) ? htmlspecialchars($row['PresentAddress']) : 'Not provided'; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><b>Permanent Address</b> &nbsp;::</td>
                        <td><?php echo !empty($row['PermanentAddress']) ? htmlspecialchars($row['PermanentAddress']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td></td>
                        <td>
                            <?php 
                                echo (!empty($cityn['Name']) ? ucfirst($cityn['Name']) : 'Not provided') . ', ';
                                echo (!empty($staten['Name']) ? ucfirst($staten['Name']) : 'Not provided') . ', ';
                                echo (!empty($countryn['Name']) ? ucfirst($countryn['Name']) : 'Not provided');
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>SSS</b> ::</td>
                        <td><?php echo !empty($row['sss']) ? formatSSSNumber($row['sss']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Philhealth</b> ::</td>
                        <td><?php echo !empty($row['philhealth']) ? formatPhilhealthNumber($row['philhealth']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Pag-IBIG</b> ::</td>
                        <td><?php echo !empty($row['pagibig']) ? formatPagIbigNumber($row['pagibig']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>TIN</b> ::</td>
                        <td><?php echo !empty($row['taxidentification']) ? formatTINNumber($row['taxidentification']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Gender</b> ::</td>
                        <td><?php echo !empty($gendern['Name']) ? ucfirst($gendern['Name']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Marital Status</b> ::</td>
                        <td><?php echo !empty($maritaln['Name']) ? $maritaln['Name'] : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Birth Date</b> ::</td>
                        <td><?php echo !empty($row['Birthdate']) ? $row['Birthdate'] : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Email</b> ::</td>
                        <td><?php echo !empty($row['Email']) ? htmlspecialchars($row['Email']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Mobile</b> ::</td>
                        <td><?php echo !empty($row['Mobile']) ? htmlspecialchars($row['Mobile']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Barangay</b> ::</td>
                        <td><?php echo !empty($row['barangay']) ? htmlspecialchars($row['barangay']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Birth Certificate</b> ::</td>
                        <td><?php echo !empty($row['birthcertificate']) ? htmlspecialchars($row['birthcertificate']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Marriage Certificate</b> ::</td>
                        <td><?php echo !empty($row['marriagecert']) ? htmlspecialchars($row['marriagecert']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Diploma/TOR</b> ::</td>
                        <td><?php echo !empty($row['diplomator']) ? htmlspecialchars($row['diplomator']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Health Certificate</b> ::</td>
                        <td><?php echo !empty($row['healtcertificate']) ? htmlspecialchars($row['healtcertificate']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Educational Background</b> ::</td>
                        <td><?php echo !empty($row['educationalbackground']) ? htmlspecialchars($row['educationalbackground']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Educational Course</b> ::</td>
                        <td><?php echo !empty($row['educcourse']) ? htmlspecialchars($row['educcourse']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="col-md-3">
            <table>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Role</b> ::</td>
                        <td><?php echo !empty($rolen['Name']) ? ucfirst($rolen['Name']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Position</b> ::</td>
                        <td><?php echo !empty($positionn['Name']) ? $positionn['Name'] : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Join Date</b> ::</td>
                        <td><?php echo !empty($row['JoinDate']) ? $row['JoinDate'] : 'Not provided'; ?></td>
                    </tr>
                </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Citizenship</b> ::</td>
                        <td><?php echo !empty($citizenshipn['Name']) ? ucfirst($citizenshipn['Name']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Place of Birth</b> ::</td>
                        <td><?php echo !empty($row['placeofbirth']) ? htmlspecialchars($row['placeofbirth']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Religion</b> ::</td>
                        <td><?php echo !empty($row['religion']) ? htmlspecialchars($row['religion']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Height</b> ::</td>
                        <td><?php echo !empty($row['height']) ? htmlspecialchars($row['height']).' cm' : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Weight</b> ::</td>
                        <td><?php echo !empty($row['weight']) ? htmlspecialchars($row['weight']).' kg' : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Contact Person Name</b> ::</td>
                        <td><?php echo !empty($row['contactpersonname']) ? htmlspecialchars($row['contactpersonname']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Contact Person Number</b> ::</td>
                        <td><?php echo !empty($row['contactpersonnumber']) ? htmlspecialchars($row['contactpersonnumber']) : 'Not provided'; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row" style="text-align: center; margin-top: 2%;">
        <div class="col-md-12 form-group">
                <button id="btnEdit" class="btn btn-primary">Edit</button>
                <button id="btnDelete" class="btn btn-default">Delete</button>
            <button id="btnClose" class="btn btn-primary">Close</button>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("btnClose").addEventListener("click", function(){
            window.location.href = "employeeview.php";
        });
        const params = new URLSearchParams(window.location.search);
        const empId = params.get("employeeid");
        const deleteBtn = document.getElementById("btnDelete");
        const editBtn = document.getElementById("btnEdit");
        if (empId) {
            deleteBtn.addEventListener('click', function () {
                if (confirm("Are you sure you want to delete this employee?")) {
                    window.location.href = "employeeview.php?empid=" + empId;
                }
            });
            editBtn.addEventListener('click', function () {
                window.location.href = "employeeadd.php?empedit=" + empId;
            });
        }
    });
</script>
<?php include('footer.php'); ?>