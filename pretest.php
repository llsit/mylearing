<?php
    include_once('inbox.php');
    include_once('head.php');
    
    $id = $_GET['id'];
    $_SESSION['id'] = $id;
    $_SESSION['status'] = '0';
    
    //----------------------------------------
    $obj_user = new user();
    $obj_index = new lesson();
    $obj_ans = new answer();
    $obj_score = new score();
    $obj_test = new pretest();

    if (isset($_GET['out'])) {
        $obj_user->user_logout();
        header('location:login.php');
    }
    $test = $obj_test->display($id);
    $count_test = $test->num_rows;

    //-----------------------------------------
    $variable = $obj_index->lesson_list($id);
    $id = $variable['id'];
    $name = $variable['lesson_name'];
?>

<html>
    <style type="text/css">
        body {
            background-color: #FFFFFF;
            margin:40px;
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
    <div class="ui main text container ">
        <h1 class="ui header">Pre-test วิชา : <?php echo "$name"; ?></h1>
            <br>
            <br>
            <form method="post" action="score.php">
            <div class="row">
                <div class='stepwizard'>
                    <div class='stepwizard-row'>
                <?php
                for ($i=1; $i <= $count_test ; $i++) { 
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
            $i = 1;
                while ($result = $test->fetch_assoc()) {
                    $question = $result['question'];
                    $choice1 = $result['choice1'];
                    $choice2 = $result['choice2'];
                    $choice3 = $result['choice3'];
                    $choice4 = $result['choice4'];
                    if ($i == 1) {
                        echo "
                    <div id='menu$i' class='tab-pane fade active in'>
                        <h3></h3>
                        <div class='ui orange piled segment'>
                            <p>Question $i : $question</p>
                            <div class='radio'>
                                <label><input type='radio' name='ans$i' value='$choice1' required>A . $choice1</label>
                            </div>
                            <div class='radio'>
                                <label><input type='radio' name='ans$i' value='$choice2' required>B . $choice2</label>
                            </div>
                            <div class='radio'>
                                <label><input type='radio' name='ans$i' value='$choice3' required>C . $choice3</label>
                            </div>
                            <div class='radio'>
                                <label><input type='radio' name='ans$i' value='$choice4' required>D . $choice4</label>
                            </div>
                        </div>
                        <ul class='list-unstyled list-inline pull-right'>
                            <li><button type='button' class='ui orange button next-step'>Next <i class='fa fa-chevron-right'></i></button></li>
                        </ul>
                    </div>
                    ";$i++;
                    }else if ($i == $count_test) {
                        echo "
                    <div id='menu$i' class='tab-pane fade in'>
                        <h3></h3>
                        <div class='ui orange piled segment'>
                            <p>Question $i : $question</p>
                            <div class='radio'>
                                <label><input type='radio' name='ans$i' value='$choice1' required>A . $choice1</label>
                            </div>
                            <div class='radio'>
                                <label><input type='radio' name='ans$i' value='$choice2' required>B . $choice2</label>
                            </div>
                            <div class='radio'>
                                <label><input type='radio' name='ans$i' value='$choice3' required>C . $choice3</label>
                            </div>
                            <div class='radio'>
                                <label><input type='radio' name='ans$i' value='$choice4' required>D . $choice4</label>
                            </div>
                        </div>
                        <ul class='list-unstyled list-inline pull-right'>
                            
                            <li><button type='button' class='ui basic button prev-step'><i class='fa fa-chevron-left'></i> Back</button></li>
                            <div class='ui left icon input'>
                                <input type='submit' name='submit' class='ui green button next-step' value='Done!'>
                                <i class='inverted checkmark icon'></i>
                            </div>
                                
                        </ul>
                    </div>";
                    }else{
                        echo "
                    <div id='menu$i' class='tab-pane fade in'>
                        <h3></h3>
                        <div class='ui orange piled segment'>
                            <p>Question $i : $question</p>
                            <div class='radio'>
                                <label><input type='radio' name='ans$i' value='$choice1' required>A . $choice1</label>
                            </div>
                            <div class='radio'>
                                <label><input type='radio' name='ans$i' value='$choice2' required>B . $choice2</label>
                            </div>
                            <div class='radio'>
                                <label><input type='radio' name='ans$i' value='$choice3' required>C . $choice3</label>
                            </div>
                            <div class='radio'>
                                <label><input type='radio' name='ans$i' value='$choice4' required>D . $choice4</label>
                            </div>
                        </div>
                        <ul class='list-unstyled list-inline pull-right'>
                            <li><button type='button' class='ui basic button prev-step'><i class='fa fa-chevron-left'></i> Back</button></li>
                            <li><button type='button' class='ui orange button next-step'>Next <i class='fa fa-chevron-right'></i></button></li>
                        </ul>
                    </div>";
                    $i++;
                    }
                }
            ?>
            </div>
        </form>
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

