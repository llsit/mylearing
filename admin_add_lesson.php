<?php
include_once('inbox.php');
include_once('head.php');
$obj_user = new user();
$obj_index = new admin();
$obj_lesson = new lesson();
if (isset($_GET['out'])) {
    $obj_user->user_logout();
    header('location:login.php');
}
$name = $_POST['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Language" content="en-us">
  <title>Rich Text Editor</title>
  <meta charset="utf-8">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="js/jquery.js"></script> 
  <script type="text/javascript" src="js/bootstrap.js"></script> 
  <script type="text/javascript" src="js/bootstrap-wysiwyg.js"></script> 

  <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
  <link href="css/font-awesome.css" rel="stylesheet">
  <style>
      .content{
        width: 80%;
        margin: 0 auto;
        margin-top: 50px;
    }

    #editor {
        max-height: 250px;
        height: 250px;
        background-color: white;
        border-collapse: separate; 
        border: 1px solid rgb(204, 204, 204); 
        padding: 10px; 
        box-sizing: content-box; 
        -webkit-box-shadow: rgba(0, 0, 0, 0.0745098) 0px 1px 1px 0px inset; 
        box-shadow: rgba(0, 0, 0, 0.0745098) 0px 1px 1px 0px inset;
        border-top-right-radius: 3px; border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px; border-top-left-radius: 3px;
        overflow: auto;
        outline: none;
    }

    #voiceBtn {
        width: 20px;
        color: transparent;
        background-color: transparent;
        transform: scale(2.0, 2.0);
        -webkit-transform: scale(2.0, 2.0);
        -moz-transform: scale(2.0, 2.0);
        border: transparent;
        cursor: pointer;
        box-shadow: none;
        -webkit-box-shadow: none;
    }

    div[data-role="editor-toolbar"] {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .dropdown-menu a {
        cursor: pointer;
    }

</style>
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

<script src="external/jquery.hotkeys.js"></script>
<script src="external/google-code-prettify/prettify.js"></script>
<script src="js/bootstrap-wysiwyg.js"></script>
<script language="javascript">
    function loadVal(){
      desc = $("#editor").html();
      document.form1.desc.value = desc;
  }
</script>
</head>
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
<?php if (isset($name)) {
    ?>
    <form method="post" name="form1" action="admin_add_lesson.php" onsubmit="loadVal();">
        <div class="ui main container">
            <div class="content">
              <div class="ui form">
                <div class="inline fields">
                  <div class="field">
                    <label>Lesson Name</label>
                    <input type="text" name="name" value="<?php echo "$name"; ?>">
                </div>
            </div>
        </div>
        <div id="alerts"></div>
        <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">
          <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="icon-font"></i><b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a data-edit="font Arial"><font size="5">Arial</font></a></li>
          </ul>
      </div>
      <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="icon-text-height"></i>&nbsp;  <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
          <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
          <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
      </ul>
  </div>
  <div class="btn-group">
    <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i></a>
    <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i></a>
    <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="icon-strikethrough"></i></a>
    <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i></a>
</div>
<div class="btn-group">
    <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="icon-list-ul"></i></a>
    <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="icon-list-ol"></i></a>
    <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="icon-indent-left"></i></a>
    <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="icon-indent-right"></i></a>
</div>
<div class="btn-group">
    <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="icon-align-left"></i></a>
    <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="icon-align-center"></i></a>
    <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="icon-align-right"></i></a>
    <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="icon-align-justify"></i></a>
</div>
<div class="btn-group">
    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="icon-link"></i></a>
    <div class="dropdown-menu input-append">
        <input class="span2" placeholder="URL" type="text" data-edit="createLink"/>
        <button class="btn" type="button">Add</button>
    </div>
    <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="icon-cut"></i></a>
</div>
<div class="btn-group">
    <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="icon-picture"></i></a>
    <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
</div>
<div class="btn-group">
    <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="icon-undo"></i></a>
    <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="icon-repeat"></i></a>
</div>
<input type="text" data-edit="inserttext" name="text" id="voiceBtn" x-webkit-speech="">
</div>

<div id="editor" placeholder="Enter your text here.."></div>

<textarea rows="2" name="desc" cols="20" style="display:none; " placeholder="Enter your text here.." >  </textarea>
<br/>
<input type="submit" value="Submit" name="B1" class="btn btn-primary btn-large">
</div>    
</form>
</div>
<?php }else{
    ?>
    <div class="ui main text container">
        <h1 class="ui header">Welcome Administrator</h1>
        <p>Lesson List.</p>
        <table class="ui brown single line table">
          <thead>
            <tr>
              <th>Lesson Name</th>
              <th>Edit</th>
              <th>Delete</th>
          </tr>
      </thead>
      <tbody>
        <?php
        $var = $obj_lesson->lesson_all();
        while ($variable = $var->fetch_assoc()) {
            $name = $variable['lesson_name'];
            echo "
            <tr>
              <td>$name</td>
              <td>edit</td>
              <td>delete</td>
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
<?php }?>
<?php 
if (isset($_POST['desc'])) {
  $text = $_POST['desc'];
  $id = $obj_index->add_lesson($name);
  $content = $obj_index->add_content($id,$text);
  if ($content == 'true') {
    echo "<script type='text/javascript'>window.location = 'admin_index.php'</script>";
}
}
?>
</body>
<script>
  $(function(){
    function initToolbarBootstrapBindings() {
      var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier', 
      'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
      'Times New Roman', 'Verdana'],
      fontTarget = $('[title=Font]').siblings('.dropdown-menu');
      $.each(fonts, function (idx, fontName) {
          fontTarget.append($('<li><a data-edit="fontName ' + fontName +'" style="font-family:\''+ fontName +'\'">'+fontName + '</a></li>'));
      });
      $('a[title]').tooltip({container:'body'});
      $('.dropdown-menu input').click(function() {return false;})
      .change(function () {$(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');})
      .keydown('esc', function () {this.value='';$(this).change();});

      $('[data-role=magic-overlay]').each(function () { 
        var overlay = $(this), target = $(overlay.data('target')); 
        overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
    });
      if ("onwebkitspeechchange"  in document.createElement("input")) {
        var editorOffset = $('#editor').offset();
        $('#voiceBtn').css('position','absolute').offset({top: editorOffset.top, left: editorOffset.left+$('#editor').innerWidth()-35});
    } else {
        $('#voiceBtn').hide();
    }
};
function showErrorAlert (reason, detail) {
    var msg='';
    if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
    else {
        console.log("error uploading file", reason, detail);
    }
    $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
       '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
};
initToolbarBootstrapBindings();  
$('#editor').wysiwyg({ fileUploadError: showErrorAlert} );
window.prettyPrint && prettyPrint();
});
</script>
</html>