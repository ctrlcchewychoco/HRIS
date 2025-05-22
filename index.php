<?php
	$result ="";
	if(isset($_GET['msg']))
	{
		$result=$_GET['msg'];
	}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Login Page - Eagle FLy Builders Inc. HRIS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="css/jquery-ui.css"> 
<!-- jQuery -->
<script src="js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<style>
	html{
		min-height: calc(100%);
		width:calc(100%);
	}

    .main-wthree {
        background-image: url('./image/efbibg.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }

	.main-wthree{
		padding-bottom:2em;
		display:flex;
		flex-direction: column;
		align-items:center;
		justify-content:center;
	}
	.footer {
        width: 100%;
        position: fixed;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.8);
        padding: 15px 0;
        text-align: center;
        z-index: 1000;
        backdrop-filter: blur(5px);
    }

    .footer p {
        margin: 0;
        color: #fff;
        font-size: 14px;
    }

    .sin-w3-agile{
		padding:0;
	}
	.login{
		background-color: #010101;
    	background-image: linear-gradient(160deg, #010101 0%, #4e6865 100%);
	}
	.login-w3 {
		width: 100%;
		float: unset;
		text-align: center;
	}
	.main-wthree input[type="submit"]:hover {
		background: #3e5250;
	}
    
    .logo-container {
        margin-bottom: 30px;
    }
    
    .logo-container img {
        max-width: 400px;  /* Increased from 200px to 400px */
        height: auto;
        display: block;
        margin: 0 auto;
        transition: transform 0.3s ease;
    }

    /* Optional: Add hover effect */
    .logo-container img:hover {
        transform: scale(1.02);
    }

    /* Add padding to main content to prevent footer overlap */
    .main-wthree {
        padding-bottom: 80px;
    }

    /* Ensure the login form doesn't get hidden behind footer */
    .sin-w3-agile {
        margin-bottom: 60px;
    }

    /* Add this CSS in the existing <style> section */
	.caps-warning {
	    color: #ff9900;
	    font-size: 12px;
	    margin-top: 5px;
	    display: none;
	}
</style>
</head> 
<body>
	<div class="main-wthree">
		<div class="container">
			<!-- Add logo image here -->
			<div class="logo-container text-center mb-3">
				<img src="image/EAGLEFLYLOGO.PNG" alt="EFBI Logo" class="img-fluid" style="max-width: 400px; margin-bottom: 30px;">
			</div>
			<h1 class="text-center text-white">EAGLE FLY BUILDERS INC. HRIS</h1>
		<div class="sin-w3-agile">
			<h2>Login In</h2>
			<form action="controller/login.php" method="post">
				<div class="email">
					<span class="email">Email:</span>
					<input type="Email" name="name" class="name"  placeholder="Enter Email Address">
					<div class="clearfix"></div>
				</div>
				<div class="password-agileits">
					<span class="username">Password: <i class="fa fa-eye-slash" aria-hidden="false" style="padding-left: 20px;" onclick="passwordeyes(this);"></i></span>
x					<input type="password" name="password" id="Psw" class="password" placeholder="Enter Password" 
           onkeyup="checkCapsLock(event)" onkeypress="return handleCapsLock(event)">
    <div id="caps-warning" class="caps-warning">
        <i class="fa fa-exclamation-triangle"></i> CAPS LOCK is ON
    </div>
					<div class="clearfix"></div>
				</div>
				<h4 style="color: #F1C40F;"><?php echo $result; ?></h4>
				
				<div class="login-w3">
					<input type="submit" name="submit" class="login" value="Sign In">
				</div>
				<div class="clearfix"></div>
			</form>
					<!-- <div class="back">
						<a href="index.php">Back to home</a>
					</div> -->
					<div class="footer">
						<p>EAGLE FLY BUILDERS INC. All Rights Reserved &copy; <?= date("Y") ?> </p>
					</div>
		</div>
		</div>
	</div>
	<script>
function passwordeyes(_this) {
    var x = document.getElementById("Psw").type;
    if(x=="password"){
      document.getElementById("Psw").type="text";
	  _this.setAttribute('class', "fa fa-eye")
    }else{
      document.getElementById("Psw").type="password";
	  _this.setAttribute('class', "fa fa-eye-slash")
	}
}

function checkCapsLock(event) {
    var warning = document.getElementById('caps-warning');
    if (event.getModifierState('CapsLock')) {
        warning.style.display = 'block';
    } else {
        warning.style.display = 'none';
    }
}

// Also check when the window gains focus
window.addEventListener('focus', function(e) {
    if (document.getModifierState('CapsLock')) {
        document.getElementById('caps-warning').style.display = 'block';
    }
});

// Check when user clicks on the password field
document.getElementById('Psw').addEventListener('mousedown', function(e) {
    if (document.getModifierState('CapsLock')) {
        document.getElementById('caps-warning').style.display = 'block';
    }
});

function handleCapsLock(event) {
    if (event.getModifierState('CapsLock')) {
        // Convert the character to lowercase if CAPS LOCK is on
        let char = String.fromCharCode(event.keyCode || event.which);
        if (char.toUpperCase() === char && !event.shiftKey) {
            // Insert lowercase character at cursor position
            let input = event.target;
            let start = input.selectionStart;
            let end = input.selectionEnd;
            let value = input.value;
            
            input.value = value.substring(0, start) + 
                         char.toLowerCase() + 
                         value.substring(end);
            
            // Move cursor to correct position
            input.selectionStart = input.selectionEnd = start + 1;
            
            // Prevent default character insertion
            return false;
        }
    }
    return true;
}
</script>
</body>
</html>

<?php
	/*current computer name get */
	//$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	//echo $hostname;

		/*check to which op system*/
		/*if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    		echo 'This is a server using Windows!';
		} else {
   			 echo 'This is a server not using Windows!';
		}*/

		/*get to mac Address in windows system*/
		//--ob_start();
		//Get the ipconfig details using system commond
		//--system('ipconfig /all');
		 
		// Capture the output into a variable
		//--$mycom=ob_get_contents();
		// Clean (erase) the output buffer
		//--ob_clean();
		 
		//--$findme = "Physical";
		//Search the "Physical" | Find the position of Physical text
		//--$pmac = strpos($mycom, $findme);
		 
		// Get Physical Address
		//--$mac=substr($mycom,($pmac+36),17);
		//Display Mac Address
		//--echo $mac;

		/* End mac system code*/

	/* get current computer mac address */
	//echo substr(exec('getmac'),0,17);
	
	//echo substr("<br>40-8D-5C-B1-B7-7D \Device\Tcpip_{BF6495D7-04E6-4599-99B0-FA6656B57D35}", 0,17)
?>
