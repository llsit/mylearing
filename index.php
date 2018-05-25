<?php
    include_once('inbox.php');
    include_once('head.php');
    $obj_user = new user();
    $obj_index = new Lesson();
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
        <h1 class="ui header">Welcome <?php if (isset($_SESSION['login'])) {
                                            echo "".$_SESSION['first']."";
                                        }else echo "User";  ?></h1>
        <p>บทเรียนออนไลน์ สำหรับการเรียนรู้วิชาสังคมศึกษา 
         กลุ่มสาระการเรียนรู้วิชาสังคมศึกษา ชั้นมัธยมศึกษาตอนปลาย และเพื่อการเรียนรู้ของนักเรียนและผู้ใช้ทั่วไป</p>
        <table class="ui celled orange  raised segment table">
            <thead>
                <tr>
                    <th>Lesson Name</th>
                    <th>Let Start</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $con = '1';
                    $row = $obj_index->lesson_all();
                    $i = 1;
                    while ($result = $row->fetch_assoc()) {
                        echo "
                <tr>
                    <td>เรื่อง $i : ".$result['lesson_name']."</td>
                    <td class='selectable'>
                        <a href='intro.php?id=".$result['id']."&&con=$con'>Start</a>
                    </td>
                </tr>
                ";
                $i++;
                    }
                
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

