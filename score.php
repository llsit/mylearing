'<?php
    include_once('inbox.php');
    include_once('head.php');
    $obj_user = new user();
    $obj_index = new Lesson();
    $obj_score = new score();
    $obj_ans = new answer();
    if (isset($_GET['out'])) {
        $obj_user->user_logout();
        header('location:login.php');
    }

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
    <div class="ui orange fixed inverted menu">
        <div class="ui container">
            <a href="index.php" class="header item">
            <img class="logo" src="https://bwatwood.edublogs.org/files/2015/07/icon-e-learning-1b72z9p.png">
                E-learning
            </a>
            <?php
                if (isset($_SESSION['login'])) {
                    $idu = $_SESSION['uid'];
                    echo "<div class='ui simple dropdown item right'>".$_SESSION['first']."<i class='dropdown icon'></i>
                        <div class='menu'>
                            <a href='edit_profile.php?id=$idu' class='item'><i class='user icon'></i>Edite Profile</a>
                            <a href='index.php?out=logout' class='item'><i class='sign out icon'></i>sign out</a>
                        </div>
                        </div>";    
                }else{
                    echo "<a href='login.php' class='item right menu'><i class='sign in icon'></i>Sign in</a>
                            <a href='signup.php' class='item'><i class='add user icon'></i>Sign up</a>";
                }
            ?>
        </div>
    </div>

    <div class="ui main text container">
        <h1 class="ui header">Score <?php if (isset($_SESSION['login'])) {
                                            echo "".$_SESSION['first']."";
                                        }else echo "User";  ?></h1>

                <?php
                if(isset($_POST['submit'])){
                    $ans = array();
                    foreach( $_POST as $key=>$val){
                        if($key != 'submit'){
                            //echo "$val <br/>";
                            $ans[] = $val;
                        }
                    }

                    $var = $obj_ans->checkanswer($ans,$_SESSION['id']);
                    $obj_score->scoretest($var,$_SESSION['id'],$_SESSION['uid'],$_SESSION['status']);
                    $show = $obj_score->ShowScore($_SESSION['id'],$_SESSION['uid']);
                        //echo $show['status'];
                        if ($show['status'] == '0') {   
                            $con = '2';
                            echo "
                            <div class='ui raised segment'>
                                <p>
                                    Your Score : ".$show['score']."
                                </p>
                            </div>
                        ";
                        }else{
                            $con = '3';
                            echo "
                            <div class='ui raised segment'>
                                <p>
                                    Your Score : ".$show['score']."
                                </p>
                            </div>
                        ";
                        }
                    }
                ?>
                <a href="intro.php?id=<?php echo $_SESSION['id']; ?>&&con=<?php echo "$con";?>" class="ui right floated pagination button menu">main</a>
    </div>
</body>

</html>

