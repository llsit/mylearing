<?php
    include_once('inbox.php');
    include_once('head.php');

    $id = $_GET['id'];
    $obj_user = new user();
    $obj_index = new lesson();
    if (isset($_GET['out'])) {
        $obj_user->user_logout();
        header('location:login.php');
    }
    $variable = $obj_index->lesson_list($id);
    $id = $variable['id'];
    $name = $variable['lesson_name'];
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
        .visibles {
            visibility: hidden; 
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

    <div class="ui main  container">
        <h1 class="ui header">บทเรียน วิชา : <?php echo "$name"; ?></h1>
        <div class="ui orange raised segment">
            <?php
                $con = 3;
                $text = $obj_index->contents($id);
                echo "$text";
            ?>
        </div>
        <div>
            <center>
            <h1 class=""></h1>
            </center>
        <br>
        </div>
        <br>
        
    </div>
    <center>
            <a class="ui brown basic button" href="intro.php?id=<?php echo "$id"; ?>&&con=<?php echo "$con"; ?>"><i class="fa fa-home"></i> HOME</a>
        </center><br>
</body>

</html>

