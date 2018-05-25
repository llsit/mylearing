<?php
    include_once('inbox.php');
    include_once('head.php');
    $con = $_GET['con'];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }else{
        $id = $_SESSION['id'];
    }
    
    $obj_user = new user();
    $obj_index = new lesson();
    if (isset($_GET['out'])) {
        $obj_user->user_logout();
        header('location:login.php');
    }
    $variable = $obj_index->lesson_list($id);
    
    $name = $variable['lesson_name'];
    //echo "$name $id";
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
        a.disabled {
            pointer-events: none;
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
        
        <h1 class="ui header">ยินดีต้อนรับเข้าสู่เรื่อง <?php echo "$name";?></h1>
        <p></p>
        <br>
        <center>
        <div class="ui compact labeled icon menu orange raised segment">
        <?php
            if ($con == 1) {
                echo "
                <a class='item'  data-toggle='modal' data-target='#myModal'>
                    <i class='edit icon'><img src=''></i>
                    Pretest
                </a>
                <a class='item disabled' href='content.php?id=$id?'>
                    <i class='book icon'></i>
                    lesson
                </a>
                <a class='item disabled' data-toggle='modal' data-target='#myModal2'>
                    <i class='write square icon'></i>
                    Post test
                </a>
            ";
            }else if ($con == 2) {
                echo "
                <a class='item'  data-toggle='modal' data-target='#myModal'>
                    <i class='edit icon'><img src=''></i>
                    Pretest
                </a>
                <a class='item' href='content.php?id=$id?'>
                    <i class='book icon'></i>
                    lesson
                </a>
                <a class='item disabled' data-toggle='modal' data-target='#myModal2'>
                    <i class='write square icon'></i>
                    Post test
                </a>
            ";
            }else{
                echo "
                <a class='item'  data-toggle='modal' data-target='#myModal'>
                    <i class='edit icon'><img src=''></i>
                    Pretest
                </a>
               <a class='item' href='content.php?id=$id?'>
                    <i class='book icon'></i>
                    lesson
                </a>
                <a class='item' data-toggle='modal' data-target='#myModal2'>
                    <i class='write square icon'></i>
                    Post test
                </a>
            ";                
            }
            
        ?>
        </div>
        </center>
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Start Pre-Test</h4>
                    </div>
                    <div class="modal-body">
                        <center>
                            <?php
                            if(isset($_SESSION['uid'])){
                                echo "
                                <a href='pretest.php?id=$id' class='ui right orange basic icon button'><i class='right arrow icon'></i>Start</a>
                                ";
                            }else{
                                echo "
                                <h3>Please login</h3>
                                <a href='login.php' class='ui right orange basic icon button'><i class='right arrow icon'></i>Start</a>
                                ";
                            }
                            
                            ?>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal2 -->
        <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Start Post-Test</h4>
                    </div>
                    <div class="modal-body">
                        <center>
                            <a href="pretest.php?id=<?php echo "$id";?>" class="ui right orange basic icon button"><i class="right arrow icon"></i>Start</a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>