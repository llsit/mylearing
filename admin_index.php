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

        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading" style="color: brown">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Management Student</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <a class='ui brown basic button' href='admin_userlist.php'><i class='fa fa-list'></i> Management Student</a>
                    </div>

                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" style="color: brown">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Management Lesson</a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                    <a class='ui brown basic button' data-toggle="modal" data-target="#myModal3"><i class='fa fa-plus'></i> Add lesson</a>
                    <a class='ui brown basic button' href="admin_add_lesson.php"><i class='fa fa-list'></i> lesson</a>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" style="color: brown">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Management Pre-test and Post-test</a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <a class='ui brown basic button' data-toggle="modal" data-target="#myModal"><i class='fa fa-plus'></i> Add Test</a>
                        <a class='ui brown basic button' data-toggle="modal" data-target="#myModal2"><i class='fa fa-pencil-square-o'></i> Manage Test</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Test</h4>
                </div>
                <div class="modal-body">
                <form class="ui form" method="post" action="admin_add_test.php">
                <table class="ui celled brown table">
                <tbody>
                    <tr>
                        <td>Lesson Name</td>
                        <td><select class="ui dropdown" name="gender">
                                <?php
                                $variable = $obj_index->lesson_all();
                                while ($var = $variable->fetch_assoc()) {
                                    echo "
                                    <option value='".$var['id']."'>".$var['lesson_name']."</option>
                                    ";
                                }
                                ?>
                            </select> 
                        </td>
                    </tr>
                    <tr>
                        <td>จำนวนข้อสอบ</td>
                        <td>
                            <div class="ui mini input fluid">
                                <input type="text" name="num" pattern = "[2-9]" data-tooltip="Add users to your feed"required>
                            </div>
                            <div class="ui info message">
                                <div class="header">
                                    Please enter 2 or more.
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
                </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="ui basic button" data-dismiss="modal">Close</button>
                    <div class='ui left icon input'>
                        <input type='submit' name='submit' class='ui right brown basic  button' value="Next">
                        <i class='save icon'></i>
                    </div>
                </div>
            </div>
            </div>
        </div>
            </form>
        <!-- Modal2 -->
        <div id="myModal2" class="modal fade" role="dialog">
            <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Manage Test</h4>
                </div>
                <div class="modal-body">
                <form class="ui form" method="post" action="admin_add_test.php">
                <table class="ui celled brown table">
                <tbody>
                    <tr>
                        <td>Lesson Name</td>
                        <td><select class="ui dropdown" name="gender">
                                <?php
                                $variable = $obj_index->lesson_all();
                                while ($var = $variable->fetch_assoc()) {
                                    echo "
                                    <option value='".$var['id']."'>".$var['lesson_name']."</option>
                                    ";
                                }
                                ?>
                            </select> 
                        </td>
                    </tr>
                </tbody>
                </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="ui basic button" data-dismiss="modal">Close</button>
                    <div class='ui left icon input'>
                        <input type='submit' name='submit' class='ui right  brown basic  button' value="Next">
                        <i class='save icon'></i>
                    </div>
                </div>
            </div>
            </div>
        </div>
            </form>         
        <!-- Modal3-->
        <div id="myModal3" class="modal fade" role="dialog">
            <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Test</h4>
                </div>
                <div class="modal-body">
                <form class="ui form" method="post" action="admin_add_lesson.php">
                <table class="ui celled brown table">
                <tbody>
                    <tr>
                        <td>Lesson Name</td>
                        <td>
                        <div class="ui mini input fluid">
                                <input type="text" name="name" placeholder="lesson name .." required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="ui info message">
                                <div class="header">
                                    Please enter 2 or more.
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
                </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="ui basic button" data-dismiss="modal">Close</button>
                    <div class='ui left icon input'>
                        <input type='submit' name='submit' class='ui right brown basic  button' value="Next">
                        <i class='save icon'></i>
                    </div>
                </div>
            </div>
            </div>
        </div>
            
        
    </div>
</body>
</html>

