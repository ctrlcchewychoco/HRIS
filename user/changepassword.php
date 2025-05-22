<?php include('userheader.php'); ?>
<?php
	$result="";
	if(isset($_GET['msg']))
	{
		$result=$_GET['msg'];
	}
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];	
	}
?>
    <div class="s-12 l-10">
    <h1>Change Password</h1><hr>
    <div class="clearfix"></div>
    </div>
    <div class="s-12 l-6">
      	<form action="../controller/login.php" method="post">
		    <label for="fname">Old Password</label>
		    <div class="password-container">
		        <input type="password" id="oldpass" title="Old Password" name="oldpass" placeholder="Enter Old Password" onkeyup="checkCapsLock(event, 'oldpassWarning')">
		        <i class="fa fa-eye-slash" onclick="togglePassword('oldpass', this)" style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"></i>
		        <div id="oldpassWarning" class="caps-warning">
		            <i class="fa fa-exclamation-triangle"></i> CAPS LOCK is ON
		        </div>
		    </div>

		    <label for="lname">New Password</label>
		    <div class="password-container">
		        <input type="password" id="npassword" title="New Password" name="npassword" placeholder="Enter New Password" onkeyup="checkCapsLock(event, 'newpassWarning')">
		        <i class="fa fa-eye-slash" onclick="togglePassword('npassword', this)" style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"></i>
		        <div id="newpassWarning" class="caps-warning">
		            <i class="fa fa-exclamation-triangle"></i> CAPS LOCK is ON
		        </div>
		    </div>

		    <label for="message">Retry Password</label>
		    <div class="password-container">
		        <input type="password" id="cpassword" name="cpassword" title="Retry Password" placeholder="Enter Retry Password" onkeyup="checkCapsLock(event, 'retrypassWarning')">
		        <i class="fa fa-eye-slash" onclick="togglePassword('cpassword', this)" style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"></i>
		        <div id="retrypassWarning" class="caps-warning">
		            <i class="fa fa-exclamation-triangle"></i> CAPS LOCK is ON
		        </div>
		    </div>

		    <?php if($result) { ?>
		    <h5 style="color: #E73D3D;"><?php echo (isset($result))?$result:""; } else { ?></h5>
		    <h5 style="color: #127409;"><?php echo (isset($id))?$id:""; } ?></h5>

		    <input type="submit" title="Submit" name="usave" value="Submit">
	  	</form>
               </div>

<style>
.password-container {
    position: relative;
    margin-bottom: 15px;
}

.password-container input {
    width: 100%;
    padding-right: 35px;
}

.password-container i {
    color: #666;
}

.password-container i:hover {
    color: #333;
}

.caps-warning {
    color: #ff9900;
    font-size: 12px;
    margin-top: 5px;
    display: none;
}
</style>

<script>
function togglePassword(inputId, icon) {
    const passwordInput = document.getElementById(inputId);
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.className = 'fa fa-eye';
    } else {
        passwordInput.type = 'password';
        icon.className = 'fa fa-eye-slash';
    }
}

function checkCapsLock(event, warningId) {
    const warning = document.getElementById(warningId);
    if (event.getModifierState('CapsLock')) {
        warning.style.display = 'block';
    } else {
        warning.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    ['oldpass', 'npassword', 'cpassword'].forEach(function(id) {
        const input = document.getElementById(id);
        const warningId = id === 'oldpass' ? 'oldpassWarning' : 
                         id === 'npassword' ? 'newpassWarning' : 'retrypassWarning';
        
        input.addEventListener('focus', function(e) {
            if (e.getModifierState('CapsLock')) {
                document.getElementById(warningId).style.display = 'block';
            }
        });
        
        input.addEventListener('blur', function() {
            document.getElementById(warningId).style.display = 'none';
        });
    });
});
</script>

<?php include('userfooter.php'); ?>