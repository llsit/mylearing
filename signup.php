<!DOCTYPE html>
<?php
    include_once('inbox.php');
    include_once('head.php');
    $obj = new user();
    if (isset($_POST['signup'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $first = $_POST['first'];
        $last = $_POST['last'];
        $gender = $_POST['gender'];
        $tel = $_POST['tel'];
        $emailis = $obj->isuser($email);
        if (!$emailis) {
            $register = $obj->signup($email,$pass,$first,$last,$gender,$tel);
            if ($register) {
                echo "<script>alert('Registration Successful')</script>";
                header("location:login.php");
            }else{
                echo "<script>alert('Registration Not Successful')</script>";
            }
        }else {  
            echo "<script>alert('Email Already Exist')</script>";  
        } 
    }
?>
<html>
    <head>
        <style type="text/css">
            body > .grid {
                height: 100%;
            }
            .image {
                margin-top: -100px;
            }
            .column {
                max-width: 450px;
            }
        </style>
    </head>
    <body>
    <div class="ui grid">
        <div class="row">
        <div class="five wide column"></div>
            <div class="six wide column">
                <h2 class="ui center aligned header">
                <div class="content" style="margin: 30px auto;">
                    Welcome
                    <div class="sub header">Sign up here</div>
                </div>
                </h2>
                <div class="ui form segment">
                    <form method="post">
                        <div class="field">
                            <label>E-mail</label>
                            <input type="text" placeholder="E-mail" name="email" required="">
                        </div>
                        <div class="field">
                            <label>Password</label>
                            <input type="password" placeholder="Password" name="pass" required="">
                        </div>
                        <div class="field">
                            <label>First name</label>
                            <input type="text" placeholder="First Name" name="first" required="">
                        </div>
                        <div class="field">
                            <label>Last name</label>
                            <input type="text" placeholder="Last Name" name="last" required="">
                        </div>
                        <div class="field" >
                            <label>Gender</label>
                            <select class="ui dropdown" name="gender">
                                <option value="1">Male</option>
                                <option value="0">Female</option>
                            </select>
                        </div>
                        <div class="field">
                            <label>Telephone number</label>
                            <input type="text" placeholder="Telephone number" name="tel" required="">
                        </div>
                        <div style="text-align: center;"><input type="submit" name="signup" class="ui green submit button" value="Signup"></div>
                    </form>
                    <div class="ui horizontal divider" style="margin: 10px 0;">
                        Or
                    </div>
                    <div style="text-align: center;">
                        <a  href="login.php" class="ui black large labeled icon button" >Login
                            <i class="signup icon"></i>
                        </a>
                    </div>
                </div>    <br>
            </div>
            <div class="five wide column"></div>    
        </div>
    </div>

    </body>
</html>
