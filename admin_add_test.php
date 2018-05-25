<?php
    include_once('inbox.php');
    include_once('head.php');
    $obj_user = new user();
    $obj_admin = new admin();
    if (isset($_GET['out'])) {
        $obj_user->user_logout();
        header('location:login.php');
    }
    $id = $_POST['gender'];
    $num = $_POST['num'];

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
    <link rel="stylesheet" type="text/css" href="css/style.css">
<body>
    <div class="ui brown fixed inverted menu">
        <div class="ui container">
            <a href="admin_index.php" class="header item">
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
        <br>
       <form method="post" action="admin_add_test.php">
            <div class="row">
                <div class='stepwizard'>
                    <div class='stepwizard-row'>
                <?php
                for ($i=1; $i <= $num ; $i++) { 
                echo "
                    <div class='stepwizard-step'>
                        <button type='button' class='btn btn-info btn-circle' data-toggle='tab' href='#menu$i'>$i</button>
                    </div>        
                ";}
                ?>
                    </div>
                </div>
                <div class='tab-content'>
            <?php
                for ($i=1; $i < $num + 1 ; $i++) { 
                    if ($i == 1) {
                        echo "
                    <div id='menu$i' class='tab-pane fade active in'>
                        <h3></h3>
                        <div class='ui orange piled segment'>   
                            <div class='ui form'>
                                <label>Question $i : <textarea rows='2' name='quiz'></textarea></label>
                            </div>
                            <br>
                            <div class='ui input'>
                                <label>Choice 1 <input type='text' name='' value=''></label>
                            </div>
                            <div class='ui input'>
                                <label>Choice 2 <input type='text' name='ans$i' value=''></label>
                            </div>
                            <div class='ui input'>
                                <label>Choice 3 <input type='text' name='ans$i' value=''></label>
                            </div>
                            <div class='ui input'>
                                <label>Choice 4 <input type='text' name='ans$i' value=''></label>
                            </div>
                            <div class='ui input'>
                                <label>Answer <input type='text' name='ans$i' value=''></label>
                            </div>
                        </div>
                        <ul class='list-unstyled list-inline pull-right'>
                            <li><button type='button' class='ui orange button next-step'>Next <i class='fa fa-chevron-right'></i></button></li>
                        </ul>
                    </div>
                    ";
                    }else if ($i == $num) {
                        echo "
                    <div id='menu$i' class='tab-pane fade in'>
                        <h3></h3>
                        <div class='ui orange piled segment'>
                            <div class='ui form'>
                                <label>Question $i : <textarea rows='2' name='quiz'></textarea></label>
                            </div>
                            <br>
                            <div class='ui input'>
                                <label>Choice 1 <input type='text' name='' value=''></label>
                            </div>
                            <div class='ui input'>
                                <label>Choice 2 <input type='text' name='ans$i' value=''></label>
                            </div>
                            <div class='ui input'>
                                <label>Choice 3 <input type='text' name='ans$i' value=''></label>
                            </div>
                            <div class='ui input'>
                                <label>Choice 4 <input type='text' name='ans$i' value=''></label>
                            </div>
                            <div class='ui input'>
                                <label>Answer <input type='text' name='ans$i' value=''></label>
                            </div>
                        </div>
                        <ul class='list-unstyled list-inline pull-right'>
                            
                            <li><button type='button' class='ui basic button prev-step'><i class='fa fa-chevron-left'></i> Back</button></li>
                            <div class='ui left icon input'>
                                <input type='submit' name='submit' class='ui green button next-step' value='Save!'>
                                <i class=' save icon'></i>
                            </div>
                                
                        </ul>
                    </div>";
                    }else{
                        echo "
                    <div id='menu$i' class='tab-pane fade in'>
                        <h3></h3>
                        <div class='ui orange piled segment'>
                            <div class='ui form'>
                                <label>Question $i : <textarea rows='2' name='quiz'></textarea></label>
                            </div>
                            <br>
                            <div class='ui input'>
                                <label>Choice 1 <input type='text' name='' value=''></label>
                            </div>
                            <div class='ui input'>
                                <label>Choice 2 <input type='text' name='ans$i' value=''></label>
                            </div>
                            <div class='ui input'>
                                <label>Choice 3 <input type='text' name='ans$i' value=''></label>
                            </div>
                            <div class='ui input'>
                                <label>Choice 4 <input type='text' name='ans$i' value=''></label>
                            </div>
                            <div class='ui input'>
                                <label>Answer <input type='text' name='ans$i' value=''></label>
                            </div>
                            <i class='fa fa-exclamation-triangle' aria-hidden='true'></i>
                        </div>
                        <ul class='list-unstyled list-inline pull-right'>
                            <li><button type='button' class='ui basic button prev-step'><i class='fa fa-chevron-left'></i> Back</button></li>
                            <li><button type='button' class='ui orange button next-step'>Next <i class='fa fa-chevron-right'></i></button></li>
                        </ul>
                    </div>";
                    }
                }
            ?>
                </div>
            </div>
        </form>
        <?php
        if(isset($_POST['submit'])){
            $ans = array();
            foreach( $_POST as $key=>$val){
                if($key != 'submit'){
                    //echo "$val <br/>";
                    $ans[] = $val;
                }
            }
        }
        $var = $obj_admin->add_test($ans);
        echo "Your Score : $var";
        ?>
    </div>
</body>
    <script type="text/javascript">
        $(function(){
            $('.btn-circle').on('click',function(){
                $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
                $(this).addClass('btn-info').removeClass('btn-default').blur();
            });

            $('.next-step, .prev-step').on('click', function (e){
                var $activeTab = $('.tab-pane.active');

                $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');

                if ( $(e.target).hasClass('next-step') ){
                    var nextTab = $activeTab.next('.tab-pane').attr('id');
                    $('[href="#'+ nextTab +'"]').addClass('btn-info').removeClass('btn-default');
                    $('[href="#'+ nextTab +'"]').tab('show');
                }else{
                    var prevTab = $activeTab.prev('.tab-pane').attr('id');
                    $('[href="#'+ prevTab +'"]').addClass('btn-info').removeClass('btn-default');
                    $('[href="#'+ prevTab +'"]').tab('show');
                }
            });
        });
    </script>
</html>

