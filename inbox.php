<?php
include_once('config.php');
session_start();

class conn
{
    public $conn;
    function __construct()
    {
        $this->conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        mysqli_set_charset($this->conn, "utf8");
        if (mysqli_connect_errno()) {
            die("Connection failed: " . $conn->connect_error);
        } 
    }
}
class user extends conn
{
    function redirect($url)
    {
        header("Location: $url");
    }
    function signup($email,$pass,$first,$last,$gender,$tel){
        $sql = "INSERT INTO member (email,firstname,lastname,pass,tel,gender) 
                values ('$email','$first','$last','$pass','$tel','$gender')";
        $result = mysqli_query($this->conn,$sql);
        return $result;
    }
    function isuser($email){
        $sql = "SELECT * FROM member WHERE email = '".$email."'";  
        $row = $this->conn->query($sql) ;
        $count_row = $row->num_rows;  
            if($count_row > 0){  
                return true;  
            } else {  
                return false;  
            }  
    }
    function editprofile($name,$last,$tel,$gender,$id){
        $sql = "UPDATE member
                SET firstname = $name, lastname = $last, tel = $tel ,gender = $gender
                WHERE id = $id;";
        $row = $this->conn->query($sql) ;
    }
    function userprofile($id){
        $sql = "SELECT * FROM member WHERE Id = '$id'";
        $result = mysqli_query($this->conn,$sql);
        $user_profile = mysqli_fetch_assoc($result);
        return $user_profile;
    }
    function user_logout() {
        $_SESSION['login'] = FALSE;
        session_destroy();
    }
}

class login extends conn
{
    function validate($email,$pass){
        $_SESSION['uid'] = null;
        if ($email == "admin" and $pass == "admin") {
            $_SESSION['admin'] = true;
            return "admin";
        }else{
            $sql2 = "SELECT * FROM member WHERE email = '$email' and pass = '$pass'";
            $result = mysqli_query($this->conn,$sql2);
            $user_data = mysqli_fetch_assoc($result);
            $count_row = $result->num_rows;
            if ($count_row == 1) {
                $_SESSION['login'] = true;
                $_SESSION['uid'] = $user_data['id'];  
                $_SESSION['first'] = $user_data['firstname'];  
                $_SESSION['email'] = $user_data['email'];
                $_SESSION['statusu'] = $user_data['status'];
                return "user";
            }else{
                $_SESSION['uid'] = null;
                return "false";
            }
        }
    }
}


class pretest extends conn
{
    function display($id){
        $sql ="SELECT * FROM test WHERE id_l = '$id'";
        $row = $this->conn->query($sql);
        // $result = $row->fetch_assoc();
        // $count_row = $row->num_rows; 
        //     while ($result = $row->fetch_assoc()) {
        //         echo "<br>".$result['question']."<br>";
        //     }   
        return $row;
    }
}

//check answer 
class answer extends conn
{
    function checkanswer($ans,$id){
        $sql = "SELECT answer FROM answer WHERE id_l = '$id' ORDER BY id_a";
        $row = mysqli_query($this->conn,$sql);
        // set array
        $array = array();
        // look through row
        while($result = mysqli_fetch_assoc($row)){
            // add each row returned into an array
            $array[] = $result['answer'];
        }
        $len = count($array);
        $lenA = count($ans);
        $score = 0;
        for ($i=0; $i < $len; $i++) { 
            if (in_array($ans[$i], $array)) {
                $score++;
            }
        }
        //echo "your score = $score";
        return $score;

        // foreach ($ans as $key => $value) {
        //     echo "$value<br>";
        // }
    }
}

class lesson extends conn
{
    function lesson_list($id){
        $sql = "SELECT * FROM lesson WHERE id = '$id'";
        $row = mysqli_query($this->conn,$sql);
        $result = mysqli_fetch_assoc($row);
        return $result;
    }

    function lesson_all(){
        $sql = "SELECT * FROM lesson";
        $row = mysqli_query($this->conn,$sql);
        return $row;
    }
    function contents($id){
        $sql = "SELECT * FROM content WHERE id_l = '$id'";
        $row = mysqli_query($this->conn,$sql);
        $result = mysqli_fetch_assoc($row);
        return $result['contents'];
    }
    
}

class score extends conn
{
    function ShowScore($id_l,$id_u){
        $sql = "SELECT * FROM score WHERE id_l = '$id_l' ORDER BY id_s DESC";
        //echo "$sql";
        $row = mysqli_query($this->conn,$sql);
        $result = mysqli_fetch_assoc($row);
        return $result;
    }
    function scoretest($score,$id_l,$id_u,$status){
        $sql = "INSERT INTO score (id_l,id_user,score,status)
                VALUES ('".$id_l."','".$id_u."','".$score."','".$status."') ";
        $row = mysqli_query($this->conn,$sql);
    }
}

class admin extends conn
{
    function add_lesson($name){
        $sql = "INSERT INTO lesson (lesson_name)
                VALUES ('".$name."')";
        $row = mysqli_query($this->conn,$sql);

        $sql2 = "SELECT id FROM lesson WHERE lesson_name = '".$name."'";        
        $row2 = mysqli_query($this->conn,$sql2);
        $result = mysqli_fetch_assoc($row2);
        return $result['id'];
    }

    function add_content($id,$text){
        $sql = "INSERT INTO content (id_l,contents)
                VALUES ('".$id."','".$text."')";
        $row = mysqli_query($this->conn,$sql);
        return true;
    }

    function add_test(){

    }

    function userlist(){
        $sql = "SELECT * FROM member ";
        $row = mysqli_query($this->conn,$sql);
        return $row;
    }
}

