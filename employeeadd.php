<?php include('header.php'); ?>
<?php 
  error_reporting(E_ALL);
	ini_set('display_errors', 1);
  $CountryId = 0;
  $StateId = 0;
  $CityId = 0;

  include_once('controller/connect.php');
  $dbs = new database();
  $db=$dbs->connection();

  //$cityn = mysqli_query($db,"select * from city ORDER BY Name");
  //$staten = mysqli_query($db,"select * from state  ORDER BY Name");
  $countryn = mysqli_query($db,"select * from country  ORDER BY Name");
  $gendern = mysqli_query($db,"select * from gender  ORDER BY Name");
  $rolen = mysqli_query($db,"select * from role  ORDER BY Name");
  $statusn = mysqli_query($db,"select * from status  ORDER BY Name");
  $maritaln = mysqli_query($db,"select * from maritalstatus  ORDER BY Name");
  $positionn = mysqli_query($db,"select * from position  ORDER BY Name");
  // $citizenshipn = mysqli_query($db, "SELECT * FROM citizen ORDER BY Name");

  

  $result ="";
  $id="";
  if(isset($_GET['msg']))
  {
    $result=$_GET['msg'];
  }
  else if(isset($_GET['id']))
  {
    $id=$_GET['id'];
  }
  else if (isset($_GET['empedit'])) 
  {
    $empid = $_GET['empedit'];
    $editempid = mysqli_query($db,"SELECT e.*,ss.StateId,cc.CountryId FROM employee e join city c on e.CityId=c.CityId join state ss on c.StateId=ss.StateId join country cc on cc.CountryId=ss.CountryId where EmployeeId='$empid'");
    $editemp = mysqli_fetch_assoc($editempid);
    $CountryId = $editemp["CountryId"];
    $StateId = $editemp['StateId'];
    $CityId = $editemp['CityId'];
  }  
?>
<ol class="breadcrumb" style="margin: 10px 0px ! important;">
    <li class="breadcrumb-item"><a href="Home.php">Home</a><i class="fa fa-angle-right"></i>Employee<i class="fa fa-angle-right"></i> Employee Add</li>
</ol>
<!--grid-->
 	<div class="validation-system" style="margin-top: 0;">
 		
 		<div class="validation-form">
 	<!---->
        <form method="POST" action="./controller/employee.php?empedit=<?php echo isset($_GET['empedit']) ? $_GET['empedit'] : ''; ?>" enctype="multipart/form-data">
        <?php 
          if($result)
          {
            echo '<h4 style="color: #FF0000;">'.$result.'</h4>';
          }
          else
          {
            echo '<h4 style="color: #008000;">'.$id.'</h4>'; 
          }
        ?>
        <div class="vali-form-group">
          <div class="col-md-4 control-label">
              <p id="pwError" style="color:red; display: none;"></p>
              <label class="control-label">Employee ID*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
              </span>
              <input type="text" name="empid" title="Employee ID" value="<?php echo(isset($editemp["EmployeeId"]))?$editemp["EmployeeId"]:""; ?>" class="form-control" placeholder="Employee ID" required="" <?php echo isset($_GET['empedit']) ? 'readonly' : ''; ?> >
              </div>
            </div>
            

            <div class="col-md-4 control-label">
              <label class="control-label">Gender*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-male" aria-hidden="true"></i>
              </span>
              <select name="gender" title="Gender" required="" style="padding: 5px 5px; text-transform: capitalize;"">
                <option value="">-- Select Gender --</option>
                <?php while($rw = mysqli_fetch_assoc($gendern)){ ?> 
                <option value="<?php echo $rw["GenderId"]; ?>" <?php if(isset($editemp["Gender"]) && $editemp["Gender"]==$rw["GenderId"]){ echo "Selected"; }?>> <?php echo $rw["Name"]; ?> </option>
                <?php } ?>
              </select>
              </div>
            </div>
            </div>
            <div class="clearfix"> </div>

         	<div class="vali-form-group">
            <div class="col-md-4 control-label">
              <label class="control-label">First Name*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
              </span>
              <input type="text" name="fname" title="First Name" value="<?php echo(isset($editemp["FirstName"]))?$editemp["FirstName"]:""; ?>" class="form-control" placeholder="First Name" required="">
              </div>
            </div>

           <div class="col-md-4 control-label">
  <label class="control-label">Middle Name (Optional)</label> <!-- Removed * -->
  <div class="input-group">             
    <span class="input-group-addon">
      <i class="fa fa-user" aria-hidden="true"></i>
    </span>
    <input type="text" name="mname" title="Middle Name" value="<?php echo(isset($editemp["MiddleName"]))?$editemp["MiddleName"]:""; ?>" class="form-control" placeholder="Middle Name">
  </div>
</div>


            <div class="col-md-4 control-label">
              <label class="control-label">Last Name*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
              </span>
              <input type="text" name="lname" title="Last Name" value="<?php echo(isset($editemp["LastName"]))?$editemp["LastName"]:""; ?>" class="form-control" placeholder="Last Name" required="">
              </div>
            </div>
              <div class="clearfix"> </div>
            </div>

            <div class="vali-form-group">
            <div class="col-md-4 control-label">
              <label class="control-label">Birth Date*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-calendar" aria-hidden="true"></i>
              </span>
              <input type="text" id="Birthdate" title="Birth Date" name="bdate" placeholder="Birth Date" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="<?php echo(isset($editemp["Birthdate"]))?$editemp["Birthdate"]:""; ?>"  class="form-control" required="">
              </div>
            </div>

            <div class="col-md-4 control-label">
              <label class="control-label">Marital*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
              </span>
              <select name="marital" title="Marital" required="" style="text-transform: capitalize;">
                <option value="">-- Select Marital --</option>
                <?php while($rw = mysqli_fetch_assoc($maritaln)){ ?> 
                  <option value="<?php echo $rw["MaritalId"]; ?>" <?php if(isset($editemp["MaritalStatus"]) && $editemp["MaritalStatus"]==$rw["MaritalId"]){ echo "Selected"; }?>> <?php echo $rw["Name"]; ?> </option>
                <?php } ?>
              </select>
              </div>
            </div>

            <div class="col-md-4 control-label">
              <label class="control-label">Mobile Number*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-mobile" aria-hidden="true"></i>
              </span>
              <input type="text" name="mnumber" title="Mobile Number" value="<?php echo(isset($editemp["Mobile"]))?$editemp["Mobile"]:""; ?>" class="form-control" placeholder="Mobile Number" min="10" maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required="">
              </div>
            </div>

            
            </div>
            <div class="clearfix"> </div>

            <div class="col-md-12 control-label">
              <label class="control-label">Present Address*</label>
              <div class="input-group">   
              <span class="input-group-addon">
              <i class="fa fa-pencil " aria-hidden="true"></i>
              </span>          
              <input type="text" name="PresentAddress" title="PresentAddress" value="<?php echo(isset($editemp["PresentAddress"]))?$editemp["PresentAddress"]:""; ?>" class="form-control" placeholder="Present Address" required="">
              </div>
            </div>
            <div class="clearfix"> </div>

            <div class="col-md-12 control-label">
              <label class="control-label">Permanent Address (Optional)</label>
              <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-pencil " aria-hidden="true"></i>
              </span>
                          
              <input type="text" name="PermanentAddress" title="PermanentAddress" value="<?php echo(isset($editemp["PermanentAddress"]))?$editemp["PermanentAddress"]:""; ?>" class="form-control" placeholder="Permanent Address">
              </div>
            </div>
            <div class="clearfix"> </div>
            <div class="col-md-12 control-label">
            </div>
            <div class="clearfix"> </div>



            <div class="vali-form-group">
            <div class="col-md-3 control-label">
              <label class="control-label">Country*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-globe" aria-hidden="true"></i>
              </span>
              <select name="country" id="contryid" title="Country" required="" onchange="contrychange()" style="text-transform: capitalize;">
                <option value="">-- Select Country --</option>
                <?php while($rw = mysqli_fetch_assoc($countryn)){ ?> 
                  <option value="<?php echo $rw["CountryId"]; ?>" <?php if(isset($editemp["CountryId"]) && $editemp["CountryId"]==$rw["CountryId"]){ echo "Selected"; }?>> <?php echo $rw["Name"]; ?> </option>
                <?php } ?>
              </select>
              </div>
            </div>

            <div class="col-md-3 control-label">
              <label class="control-label">State*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              </span>
              <select name="state" id="stateid" title="State" onchange="statechange()" required="" style="text-transform: capitalize;">
                <option value="">-- Select State --</option>
              </select>
              </div>
            </div>

            <div class="col-md-3 control-label">
              <label class="control-label">City*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              </span>
              <select name="city" id="cityid" title="City" required="" style="text-transform: capitalize;">
                <option value="">-- Select City --</option> 
              </select>
              </div>
            </div>
              <div class="clearfix"> </div>
            </div>

            <div class="vali-form-group">
            <div class="col-md-3 control-label">
              <label class="control-label">Join Date*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-calendar" aria-hidden="true"></i>
              </span>
              <input type="text" id="JoinDate" title="Join Date" name="joindate" placeholder="Join Date" value="<?php echo(isset($editemp["JoinDate"]))?$editemp["JoinDate"]:""; ?>" class="form-control" required="" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
              </div>
            </div>

            

            <div class="col-md-3 control-label">
              <label class="control-label">Status</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              </span>
              <select name="status" title="Status" required="" style="text-transform: capitalize;">
                <option value="">-- Select Status --</option>
                <?php while($rw = mysqli_fetch_assoc($statusn)){ ?> 
                  <option value="<?php echo $rw["StatusId"]; ?>" <?php if(isset($editemp["StatusId"]) && $editemp["StatusId"]==$rw["StatusId"]){ echo "Selected"; }?>> <?php echo $rw["Name"]; ?> </option>
                <?php } ?>
              </select>
              </div>
            </div>

            <div class="col-md-3 control-label">
              <label class="control-label">Role*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
              </span>
              <select name="role" required="" title="Role" style="text-transform: capitalize;"  >
                <option value="">-- Select Role --</option>
                <?php while($rw = mysqli_fetch_assoc($rolen)){ ?> 
                  <option value="<?php echo $rw["RoleId"]; ?>" <?php if(isset($editemp["RoleId"]) && $editemp["RoleId"]==$rw["RoleId"]){ echo "Selected"; }?>> <?php echo $rw["Name"]; ?> </option>
                <?php } ?>
              </select>
              </div>
            </div>
            <div class="clearfix"> </div>
            </div>

            <div class="vali-form-group">
            <div class="col-md-3 control-label">
              <label class="control-label">Position*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-language" aria-hidden="true"></i>
              </span>
              <select name="position" title="Position" style="text-transform: capitalize;" required="">
                <option value="">-- Select Position --</option>
                <?php while($rw = mysqli_fetch_assoc($positionn)){ ?> 
                  <option value="<?php echo $rw["PositinId"]; ?>" <?php if(isset($editemp["PositionId"]) && $editemp["PositionId"]==$rw["PositinId"]){ echo "Selected"; }?>> <?php echo $rw["Name"]; ?> </option>
                <?php } ?>
              </select>
              </div>
            </div>

            <div class="vali-form-group">
    <div class="col-md-3 control-label">
        <label class="control-label">Email*</label>
        <div class="input-group">             
            <span class="input-group-addon">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
            <input type="email" name="email" title="Email" value="<?php echo(isset($editemp["Email"]))?$editemp["Email"]:""; ?>" class="form-control" placeholder="Email Address" required="">
        </div>
    </div>
            
    <div class="col-md-3 control-label">
        <label class="control-label">Password*</label>
        <div class="input-group">             
            <span class="input-group-addon">
                <i class="fa fa-pencil" aria-hidden="true"></i>
            </span>
            <input type="password" id="Psw" title="Password" value="<?php echo(isset($editemp["Password"]))?$editemp["Password"]:""; ?>" name="password" placeholder="Password" class="form-control" required minlength="8" maxlength="12">
            <span class="input-group-addon">
                <a><i class='fa fa-eye' aria-hidden='false' onclick="passwordeyes()"></i></a>
            </span>
        </div>              
    </div>
    <div class="clearfix"> </div>
</div>

            <!-- sss -->
            <div class="col-md-4 control-label">
              <label class="control-label">SSS Number*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-mobile" aria-hidden="true"></i>
              </span>
              <input type="text" name="sss" title="SSS Number" value="<?php echo(isset($editemp["sss"]))?$editemp["sss"]:""; ?>" class="form-control" placeholder="SSS Number" min="10" maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" >
              </div>
            </div>

<!-- <script>
function formatSSS(input) {
  let numbers = input.value.replace(/\D/g, '');

  if (numbers.length > 2) {
    numbers = numbers.slice(0, 2) + '-' + numbers.slice(2);
  }
  if (numbers.length > 9) {
    numbers = numbers.slice(0, 10) + '-' + numbers.slice(10, 11);
  }
  if (numbers.length > 12) {
    numbers = numbers.slice(0, 12);
  }

  input.value = numbers;
}
</script> -->


            <div class="col-md-4 control-label">
              <label class="control-label">Philhealth Number*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-mobile" aria-hidden="true"></i>
              </span>
              <input type="text" name="philhealth" title="Philhealth Number" value="<?php echo(isset($editemp["philhealth"]))?$editemp["philhealth"]:""; ?>" class="form-control" placeholder="Philhealth Number" min="12" maxlength="12" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
              </div>
            </div>

            <div class="col-md-4 control-label">
              <label class="control-label">Pag-Ibig Number*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-mobile" aria-hidden="true"></i>
              </span>
              <input type="text" name="pagibig" title="Pag-Ibig Number" value="<?php echo(isset($editemp["pagibig"]))?$editemp["pagibig"]:""; ?>" class="form-control" placeholder="Pag-ibig Number" min="12" maxlength="12" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
              </div>
            </div>

            <div class="col-md-4 control-label">
              <label class="control-label">Tax Identification Number*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-mobile" aria-hidden="true"></i>
              </span>
              <input type="text" name="taxidentification" title="Pag-Ibig Number" value="<?php echo(isset($editemp["taxidentification"]))?$editemp["taxidentification"]:""; ?>" class="form-control" placeholder="Tax Identification Number" min="12" maxlength="12" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
              </div>
            </div>

            <!-- New form -->
            <div class="clearfix"> </div>
            <div class="col-md-3 control-label">
  <label class="control-label">Barangay Certificate Types</label>
  <div class="input-group"> 
    <span class="input-group-addon">
      <i class="fa fa-pencil" aria-hidden="true"></i>
    </span>            
    <select name="barangay" title="Barangay Certificate Type" class="form-control">
      <option value="">Select Certificate Type</option>
      <?php
        $barangayCertificates = [
          "None",
          "Barangay Clearance",
          "Barangay Certificate of Residency",
          "Barangay Certificate of Indigency",
          "Barangay Certificate of Good Moral Character",
          "Barangay Business Clearance",
          "Barangay Certificate for Employment",
          "Barangay Certificate for Solo Parent"
        ];

        $selectedBarangay = isset($editemp["barangay"]) ? $editemp["barangay"] : '';
        foreach ($barangayCertificates as $certificate) {
          $selected = ($certificate == $selectedBarangay) ? 'selected' : '';
          echo "<option value=\"$certificate\" $selected>$certificate</option>";
        }
      ?>
    </select>
  </div>
</div>


            <div class="col-md-3 control-label">
              <label class="control-label">Birth Certificate</label>
              <div class="input-group"> 
              <span class="input-group-addon">
              <i class="fa fa-pencil " aria-hidden="true"></i>
              </span>            
              <select name="birthcertificate" title="Birth Certificate" class="form-control">
                <option value="">Select Certificate Type</option>
                <?php
                    $birthCertTypes = [
                        "None",
                        "PSA Birth Certificate"
                    ];

                    $selectedBirthCert = isset($editemp["birthcertificate"]) ? $editemp["birthcertificate"] : '';
                    foreach ($birthCertTypes as $certType) {
                        $selected = ($certType == $selectedBirthCert) ? 'selected' : '';
                        echo "<option value=\"$certType\" $selected>$certType</option>";
                    }
                ?>
              </select>
              </div>
            </div>

            
            <div class="col-md-3 control-label">
              <label class="control-label">Marriage Certificate</label>
              <div class="input-group"> 
                  <span class="input-group-addon">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                  </span>            
                  <select name="marriagecert" title="Marriage Certificate" class="form-control">
                      <option value="">Select Certificate Type</option>
                      <?php
                          $marriageCertTypes = [
                              "None",
                              "PSA Marriage Certificate",
                              "Church Marriage Certificate",
                              "Civil Marriage Certificate",
                              "Foreign Marriage Certificate"
                          ];

                          $selectedMarriage = isset($editemp["marriagecert"]) ? $editemp["marriagecert"] : '';
                          foreach ($marriageCertTypes as $certType) {
                              $selected = ($certType == $selectedMarriage) ? 'selected' : '';
                              echo "<option value=\"$certType\" $selected>$certType</option>";
                          }
                      ?>
                  </select>
              </div>
            </div>

            <div class="col-md-3 control-label">
    <label class="control-label">Diploma/TOR</label>
    <div class="input-group"> 
        <span class="input-group-addon">
            <i class="fa fa-pencil" aria-hidden="true"></i>
        </span>            
        <select name="diplomator" title="Diploma/TOR" class="form-control">
            <option value="">Select Diploma/TOR Type</option>
            <?php
                $diplomaTypes = [
                    "None",
                    "High School Diploma",
                    "Senior High School Diploma",
                    "Associate Degree Diploma",
                    "Bachelor's Degree Diploma",
                    "Master's Degree Diploma",
                    "Doctorate Degree Diploma",
                    "Transcript of Records (TOR)",
                    "Certificate of Graduation",
                    "Professional License"
                ];

                $selectedDiploma = isset($editemp["diplomator"]) ? $editemp["diplomator"] : '';
                foreach ($diplomaTypes as $diploma) {
                    $selected = ($diploma == $selectedDiploma) ? 'selected' : '';
                    echo "<option value=\"$diploma\" $selected>$diploma</option>";
                }
            ?>
        </select>
    </div>
</div>

            <div class="col-md-3 control-label">
  <label class="control-label">Health Certificate</label>
  <div class="input-group"> 
    <span class="input-group-addon">
      <i class="fa fa-pencil" aria-hidden="true"></i>
    </span>            
    <select name="healtcertificate" title="Health Certificate" class="form-control">
      <option value="">Select Health Certificate Type</option>
      <?php
        $healthCertificates = [
          "None",
          "Medical Certificate",
          "Fit to Work Certificate",
          "Barangay Health Certificate",
          "DOH Health Clearance",
          "Company-Issued Health Certificate",
          "Other"
        ];

        $selectedHealth = isset($editemp["healtcertificate"]) ? $editemp["healtcertificate"] : '';
        foreach ($healthCertificates as $cert) {
          $selected = ($cert == $selectedHealth) ? 'selected' : '';
          echo "<option value=\"$cert\" $selected>$cert</option>";
        }
      ?>
    </select>
  </div>
</div>


            <div class="col-md-3 control-label">
              <label class="control-label">Educational Background</label>
              <div class="input-group"> 
                  <span class="input-group-addon">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                  </span>            
                  <select name="educationalbackground" title="Educational Background" class="form-control">
                      <option value="">Select Educational Background</option>
                      <?php
                          $educationalBackgrounds = [
                              "None",
                              "Elementary",
                              "High School",
                              "Senior High School",
                              "Vocational/Technical School",
                              "Some College",
                              "Associate Degree",
                              "Bachelor's Degree",
                              "Master's Degree",
                              "Doctorate Degree",
                              "Post-Doctorate"
                          ];

                          $selectedEducation = isset($editemp["educationalbackground"]) ? $editemp["educationalbackground"] : '';
                          foreach ($educationalBackgrounds as $education) {
                              $selected = ($education == $selectedEducation) ? 'selected' : '';
                              echo "<option value=\"$education\" $selected>$education</option>";
                          }
                      ?>
                  </select>
              </div>
          </div>

          <div class="col-md-3 control-label">
              <label class="control-label">Educational Course</label>
              <div class="input-group"> 
                  <span class="input-group-addon">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                  </span>            
                  <select name="educcourse" title="Educational Course" class="form-control">
                      <option value="">Select Educational Course</option>
                      <?php
                          $educationalCourses = [
                              "None",
                              "Accountancy",
                              "Architecture",
                              "Biology",
                              "Business Administration",
                              "Civil Engineering",
                              "Computer Engineering",
                              "Computer Science",
                              "Education",
                              "Electrical Engineering",
                              "Electronics Engineering",
                              "Environmental Science",
                              "Finance",
                              "Hotel and Restaurant Management",
                              "Information Technology",
                              "Marketing",
                              "Mathematics",
                              "Mechanical Engineering",
                              "Medicine",
                              "Nursing",
                              "Psychology",
                              "Tourism",
                              "Other"
                          ];

                          $selectedCourse = isset($editemp["educcourse"]) ? $editemp["educcourse"] : '';
                          foreach ($educationalCourses as $course) {
                              $selected = ($course == $selectedCourse) ? 'selected' : '';
                              echo "<option value=\"$course\" $selected>$course</option>";
                          }
                      ?>
                  </select>
              </div>
          </div>

            <!-- new drop box -->

            <div class="col-md-3 control-label">
              <label class="control-label">Place of Birth</label>
              <div class="input-group"> 
              <span class="input-group-addon">
              <i class="fa fa-pencil " aria-hidden="true"></i>
              </span>            
              <input type="text" name="placeofbirth" title="Place of Birth" value="<?php echo(isset($editemp["placeofbirth"]))?$editemp["placeofbirth"]:""; ?>" class="form-control" placeholder="Place Of Birth">
              </div>
            </div>

            <div class="col-md-3 control-label">
  <label class="control-label">Religion</label>
  <div class="input-group">
    <span class="input-group-addon">
      <i class="fa fa-pencil" aria-hidden="true"></i>
    </span>
    <select name="religion" title="Religion" class="form-control">
      <option value="">Select Religion</option>
      <?php
        $religions = [
          "Roman Catholic", 
          "Iglesia ni Cristo", 
          "Evangelical Christianity", 
          "Islam", 
          "Aglipayan (Philippine Independent Church)", 
          "Seventh-day Adventist", 
          "Buddhism", 
          "Jehovah’s Witnesses", 
          "Church of Jesus Christ of Latter-day Saints (Mormon)", 
          "Orthodox Christianity", 
          "Hinduism", 
          "Judaism", 
          "None", 
          "Other"
        ];

        $selectedReligion = isset($editemp['religion']) ? $editemp['religion'] : '';
        foreach ($religions as $religion) {
          $selected = ($religion == $selectedReligion) ? 'selected' : '';
          echo "<option value=\"$religion\" $selected>$religion</option>";
        }
      ?>
    </select>
  </div>
</div>

            

            <div class="col-md-3 control-label">
            <label class="control-label">Citizenship*</label>
            <div class="input-group">             
                <span class="input-group-addon">
                    <i class="fa fa-male" aria-hidden="true"></i>
                </span>
                <select name="citizenship" title="Citizenship" required="" style="padding: 5px 5px; text-transform: capitalize;">
                    <option value="">-- Select Citizenship --</option>
                    <option value="1" <?php if(isset($editemp["citizenship"]) && $editemp["citizenship"]=="1"){ echo "selected"; } ?>>Filipino</option>
                </select>
                  </div>
                </div>
            <div class="clearfix"> </div>


            <div class="col-md-2 control-label">
  <label class="control-label">Height (cm)</label>
  <div class="input-group">
    <span class="input-group-addon">
      <i class="fa fa-pencil" aria-hidden="true"></i>
    </span>
    <select name="height" title="Height in cm" class="form-control">
      <option value="">Select Height</option>
      <?php
        $selectedHeight = isset($editemp['height']) ? $editemp['height'] : '';
        for ($i = 100; $i <= 220; $i++) {
          $selected = ($i == $selectedHeight) ? 'selected' : '';
          echo "<option value='$i' $selected>$i cm</option>";
        }
      ?>
    </select>
  </div>
</div>




            <div class="col-md-2 control-label">
  <label class="control-label">Weight (kg)</label>
  <div class="input-group"> 
    <span class="input-group-addon">
      <i class="fa fa-pencil" aria-hidden="true"></i>
    </span>            
    <select name="weight" title="Weight in kg" class="form-control">
      <option value="">Select Weight</option>
      <?php
        $selectedWeight = isset($editemp['weight']) ? $editemp['weight'] : '';
        for ($i = 30; $i <= 200; $i++) { // You can adjust range as needed
          $selected = ($i == $selectedWeight) ? 'selected' : '';
          echo "<option value='$i' $selected>$i kg</option>";
        }
      ?>
    </select>
  </div>
</div>

            <div class="col-md-4 control-label">
              <label class="control-label">Contact Person Name</label>
              <div class="input-group"> 
              <span class="input-group-addon">
              <i class="fa fa-pencil " aria-hidden="true"></i>
              </span>            
              <input type="text" name="contactpersonname" title="contactpersonname" value="<?php echo(isset($editemp["contactpersonname"]))?$editemp["contactpersonname"]:""; ?>" class="form-control" placeholder="Contact Person Name">
              </div>
            
            </div>

            <div class="col-md-4 control-label">
              <label class="control-label">Contact Person Number*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-mobile" aria-hidden="true"></i>
              </span>
              <input type="text" name="contactpersonnumber" title="contactpersonnumber" value="<?php echo(isset($editemp["contactpersonnumber"]))?$editemp["contactpersonnumber"]:""; ?>" class="form-control" placeholder="Mobile Number" min="10" maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required="">
              </div>
            </div>


            <!-- Memo form -->
          
            <div class="vali-form-group">       
            <!-- END -->

            <div class="col-md-12 form-group" style="text-align: center; margin-top: 20px;">
    <button type="submit" name="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
    <button type="reset" class="btn btn-default" style="margin-right: 10px;">Reset</button>
    <input type="text" name="imagefilename" hidden="" value="<?php echo(isset($editemp['ImageName']))?$editemp['ImageName']:''; ?>">
</div>
          <div class="clearfix"> </div>
        </form>
 	<!---->
 </div>
</div>
<script>
function passwordeyes() {
    var x = document.getElementById("Psw").type;
    if(x=="password")
      document.getElementById("Psw").type="text";
    else
      document.getElementById("Psw").type="password";
}
document.addEventListener("DOMContentLoaded", function(e) {
  const passInput = document.getElementById("Psw");
  const errorMsg = document.getElementById("pwError");

  passInput.addEventListener("keypress", function(e) {
    const charCode = String.fromCharCode(e.which);
    if (!/^[a-zA-Z0-9]/.test(charCode)) {
      e.preventDefault();
      errorMsg.textContent = "Only letters and numbers are allowed.";
    } else {
      errorMsg.textContent = ""; 
    }
  });
});

</script>
<script>
var OneStepBack;
function nmac(val,e){
  if(e.keyCode!=8)
  {
    if(val.length==2)
      document.getElementById("mac").value = val+"-";
    if(val.length==5)
      document.getElementById("mac").value = val+"-";
    if(val.length==8)
      document.getElementById("mac").value = val+"-";
      if(val.length==11)
      document.getElementById("mac").value = val+"-";
      if(val.length==14)
      {
        document.getElementById("mac").value = val+"-";   
      }
  }
}

function nmac1(val,e){
if(e.keyCode==32){
return false;
}

  if(e.keyCode!=8){

    if(val.length==2)
      document.getElementById("mac").value = val+"-";
    if(val.length==5)
      document.getElementById("mac").value = val+"-";
    if(val.length==8)
      document.getElementById("mac").value = val+"-";
      if(val.length==11)
      document.getElementById("mac").value = val+"-";
      if(val.length==14){
      document.getElementById("mac").value = val+"-";   
    }

    if(val.length==17){
        return false;
    }
  } 
}
</script>
<script>
  contrychange();
  function contrychange()
  {
    var selectedstateid = "<?php echo $StateId; ?>";
    var selectedstateid = parseInt(selectedstateid);

    var selectedcountry = $('#contryid').val();
    $.get("controller/getstatecity.php?Type=s&ci="+selectedcountry+"&ss="+selectedstateid,function(data,status){
        $("#stateid").html(data);
    });
    statechange(selectedstateid);
  }
  function statechange(si)
  {

    var selectedstate = $('#stateid').val();
    if(si!=undefined)
      selectedstate=si;

    var selectedcityid = "<?php echo $CityId; ?>";
    selectedcityid = parseInt(selectedcityid);
    
    $.get("controller/getstatecity.php?Type=c&si="+selectedstate+"&sc="+selectedcityid,function(data,status){
      $("#cityid").html(data);
    });
  }
</script>

<script>
  
  $('#Memodates').datetimepicker({
  yearOffset:0,
  lang:'ch',
  timepicker:false,
  format:'Y/m/d',
  formatDate:'Y/m/d',
  //minDate:'-1980/01/01', // yesterday is minimum date
  //maxDate: tdate // and tommorow is maximum date calendar
});
</script>

<script>
  
  var birthdate = $('#Birthdate').val();
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;
    var yy = today.getYear();
    var tdate = yy+"/"+mm+"/"+dd;

$('#Birthdate').datetimepicker({
  yearOffset:0,
  lang:'ch',
  timepicker:false,
  format:'Y/m/d',
  formatDate:'Y/m/d',
  //minDate:'-1980/01/01', // yesterday is minimum date
  maxDate: tdate // and tommorow is maximum date calendar
});

$('#JoinDate').datetimepicker({
  yearOffset:0,
  lang:'ch',
  timepicker:false,
  format:'Y/m/d',
  formatDate:'Y/m/d',
  //minDate:'-1980/01/01', // yesterday is minimum date
  //maxDate: tdate // and tommorow is maximum date calendar
});

$('#LeaveDate').datetimepicker({
  yearOffset:0,
  lang:'ch',
  timepicker:false,
  format:'Y/m/d',
  formatDate:'Y/m/d',
  //minDate:'-1980/01/01', // yesterday is minimum date
  //maxDate: tdate // and tommorow is maximum date calendar
});

</script>
<?php include('footer.php'); ?>