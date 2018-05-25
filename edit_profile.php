<?php
    include_once('inbox.php');
    include_once('head.php');
    $obj_user = new user();
    $id = $_GET['id'];
    $var = $obj_user->userprofile($id);
    if (isset($_GET['out'])) {
        $obj_user->user_logout();
        header('location:login.php');
    }
    $email = $var['email'];
    $first = $var['firstname'];
    $last = $var['lastname'];
    $tel = $var['tel'];
    $gender = $var['gender'];
    
?>

<html>
    <style type="text/css">
        body {
            background-color: #FFFFFF;
        }
        .ui.menu .item img.logo {
            margin-right: 1.5em;
        }
        .main.container {
            margin-top: 4.5em;
        }
    </style>
<body>
    <div class="ui orange fixed inverted menu">
        <div class="ui container">
            <a href="index.php" class="header item">
            <img class="logo" src="https://bwatwood.edublogs.org/files/2015/07/icon-e-learning-1b72z9p.png">
                E-learning
            </a>
            <?php
                if (isset($_SESSION['login'])) {
                    $idu = $_SESSION['uid'];
                    echo "<a href='edit_profile.php?id=$idu' class='item right menu'><i class='user icon'></i>Edite Profile</a> ";
                    echo "<a href='index.php?out=logout' class='item'><i class='sign out icon'></i>Logout</a>";
                }else{
                    echo "
                        <a href='login.php' class='right Menu item'>Login</a>
                        <a href='signup.php' class='item'>Sign up</a>
                    ";
                }
            ?>
        </div>
    </div>

    <div class="ui main text container">
        
        <h1 class="ui header">Edit Your Profile</h1>
        <br>
        <form class="ui form" method="post" action="edit_profile.php">
            <table class="ui celled orange table">
                <tbody>
                    <tr>
                        <td>E-mail</td>
                        <td>
                            <div class="ui mini input fluid">
                                <input type="text" name="email" value="<?php echo "$email";?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td>
                            <div class="ui mini input fluid">
                                <input type="text" name="first" value="<?php echo "$first";?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td>
                            <div class="ui mini input fluid">
                                <input type="text" name="last" value="<?php echo "$last";?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Telephone Number</td>
                        <td>
                            <div class="ui mini input fluid">
                                <input type="text" name="tel" value="<?php echo "$tel";?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>
                            <select class="ui dropdown" required name="gender">
                                <option value="">Gender</option>
                                <option value="1">Male</option>
                                <option value="0">Female</option>
                            </select>  
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" name="submit" class="ui right floated medium primary icon button" value="Save">
        </form>
        <?php
            if (isset($_POST['submit'])) {
                $name = $_POST['first'];
                $last = $_POST['last'];
                $tel = $_POST['tel'];
                $gender = $_POST['gender'];
                $obj_user->editprofile($name,$last,$tel,$gender,$_SESSION['uid']);
                echo "<script type='text/javascript'>window.location = 'index.php'</script>";
            }
        ?>
    </div>
</body>

</html>

