<?php
    $result ="";
    if(isset($_GET['msg'])) 
    {
        $result=$_GET['msg'];
    }
?>
<!DOCTYPE html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<meta charset="UTF-8">

<title>Employee Login - EFBBI EMPLOYEE</title>
<style>
    html{
        min-height: 100%;
        width:100%;
    }
body {
    min-height: 100vh;
    font-family: Montserrat;
    margin: unset;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-image: url('../image/efbibg.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}

.logo {
    width: 213px;
    height: 36px;
    background: url(' ') no-repeat;
    margin: 30px auto;
}

.login-block {
    width: 320px;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 5px solid #324341;
    margin: 0 auto;
}

.login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
}

.login-block input {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}

.login-block input#username {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#password {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input:active, .login-block input:focus {
    border: 1px solid #4e6865;
}

.login-block button {
    width: 100%;
    height: 40px;
    background: #ff656c;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #e15960;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
}

.login-block button:hover {
    background: #4e6865;
}

.login-block button{
        border:unset;
		background-color: #010101;
    	background-image: linear-gradient(160deg, #010101 0%, #4e6865 100%);
}
.text-white{
    color: #fff;
}

.password-container {
    position: relative;
    width: 100%;
}

.password-container input {
    margin-bottom: 0 !important;
}

.toggle-password {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #999;
}

.caps-warning {
    color: red;
    font-size: 12px;
    margin-top: 5px;
    display: none;
    position: absolute;
    width: 100%;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <h1 class="text-white">EAGLE FLY BUILDERS INC. - Employee Side</h1>
    <br>
    <br>
<div class="login-block">
    <h1>Login</h1>
    <form class="form" method="POST" Action="../controller/login.php">
    <input type="text" name="name" value="" placeholder="Username" id="username" />
    <div class="password-container">
        <input type="password" 
               name="password" 
               value="" 
               placeholder="Password" 
               id="password" 
               onkeyup="checkCapsLock(event)"
               onkeypress="return preventCapsLock(event)"/>
        <i class="toggle-password fa fa-eye" onclick="togglePassword()" id="togglePassword"></i>
        <div id="capsLockWarning" class="caps-warning">Warning: Caps Lock is ON - Please turn it off</div>
    </div>
    <h4 style="color: #FF0000; font-weight: normal;"><?php echo $result; ?></h3>
    <button type="submit" name="clientlogin">Submit</button>
    </form>
</div>
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('togglePassword');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

function preventCapsLock(e) {
    if (e.getModifierState('CapsLock')) {
        e.preventDefault();
        document.getElementById('capsLockWarning').style.display = 'block';
        return false;
    }
    document.getElementById('capsLockWarning').style.display = 'none';
    return true;
}

function checkCapsLock(event) {
    const warning = document.getElementById('capsLockWarning');
    if (event.getModifierState('CapsLock')) {
        warning.style.display = 'block';
    } else {
        warning.style.display = 'none';
    }
}

document.getElementById('password').addEventListener('focus', function(e) {
    if (e.getModifierState('CapsLock')) {
        document.getElementById('capsLockWarning').style.display = 'block';
    }
});
</script>
</body>

</html>