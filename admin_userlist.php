<?php
    include_once('inbox.php');
    include_once('head.php');
    $obj_user = new user();
    $obj_index = new admin();
    if (isset($_GET['out'])) {
        $obj_user->user_logout();
        header('location:login.php');
    }
    $var = $obj_index->userlist();
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
            margin-top: 7em;
        }
    </style>
<body>
    <div class="ui brown fixed inverted menu">
        <div class="ui container">
            <a href="#" class="header item">
            <img class="logo" src="https://bwatwood.edublogs.org/files/2015/07/icon-e-learning-1b72z9p.png">
                E-learning
            </a>
            <?php
                if (isset($_SESSION['admin'])) {
                    $idu = "admin";
                    echo "<a href='index.php?out=logout' class='item right menu'><i class='sign out icon'></i>Logout</a>";
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
        <h1 class="ui header">Welcome <?php if (isset($_SESSION['login'])) {
                                            echo "".$_SESSION['first']."";
                                        }else echo "Administrator";  ?></h1>
        <p>User Management.</p>
        <table class="ui brown single line table">
          <thead>
            <tr>
              <th>Name</th>
              <th>E-mail address</th>
              <th>Telephone Number</th>
              <th>Gender</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while ($variable = $var->fetch_assoc()) {
                $name = $variable['firstname'];
                $email = $variable['email'];
                $tel = $variable['tel'];
                if ($variable['gender'] == 1) {
                  $gender = 'Male';
                }else{
                  $gender = 'Female';
                }
              echo "
                <tr>
                  <td>$name ".$variable['lastname']."</td>
                  <td>$email</td>
                  <td>$tel</td>
                  <td>$gender</td>
                </tr>
              ";}
            ?>
            
          </tbody>
        </table> 
        <center>
          <a class="ui brown basic button" href="admin_index.php">
                <i class="fa fa-home"> </i> Main Menu
            </a>
        </center>
        
    </div>
</body>
</html>


