<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$postdata = file_get_contents("php://input");
@$request = json_decode($postdata);

require_once 'connection.php';

$res = array();
$bind= array();
$n = 0;

$query = 'Update userinfo Set ';

if(isset($_POST['userinfoGender'])) {
    $query .= 'userinfoGender=:userinfoGender'; // Update userinfo Set userinfoGender=:userinfoGender
    $bind[':userinfoGender'] = $_POST['userinfoGender'];
    $n = 1;
}

if(isset($_POST['userinfoPrefix'])) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoPrefix=:userinfoPrefix';
    //Update userinfo Set userinfoGender=:userinfoGender, userinfoPrefix=:userinfoPrefix
    //Update userinfo Set userinfoPrefix=:userinfoPrefix
    $bind[':userinfoPrefix'] = $_POST['userinfoPrefix'];
    $n = 1;
}

if(isset($_POST['userinfoFullname'])) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoFullname=:userinfoFullname';
    $bind[':userinfoFullname'] = $_POST['userinfoFullname'];
    $n = 1;
}

if(isset($_POST['userinfoBirthday'])) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoBirthday=:userinfoBirthday';
    $bind[':userinfoBirthday'] = $_POST['userinfoBirthday'];
    $n = 1;
}

if(isset($_POST['userinfoAddress'])) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoAddress=:userinfoAddress';
    $bind[':userinfoAddress'] = $_POST['userinfoAddress'];
    $n = 1;
}

if(isset($_POST['userinfoPhone'])) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoPhone=:userinfoPhone';
    $bind[':userinfoPhone'] = $_POST['userinfoPhone'];
    $n = 1;
}

if(isset($_POST['userinfoEmail'])) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoEmail=:userinfoEmail';
    $bind[':userinfoEmail'] = $_POST['userinfoEmail'];
    $n = 1;
}

if(isset($_POST['userinfoWebsite'])) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoWebsite=:userinfoWebsite';
    $bind[':userinfoWebsite'] = $_POST['userinfoWebsite'];
    $n = 1;
}

if(isset($_POST['userinfoTalent'])) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoTalent=:userinfoTalent';
    $bind[':userinfoTalent'] = $_POST['userinfoTalent'];
    $n = 1;
}

if(isset($_POST['userinfoHobby'])) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoHobby=:userinfoHobby';
    $bind[':userinfoHobby'] = $_POST['userinfoHobby'];
    $n = 1;
}

if(isset($_POST['userinfoGoal'])) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoGoal=:userinfoGoal';
    $bind[':userinfoGoal'] = $_POST['userinfoGoal'];
    $n = 1;
}

$query .= ' Where userID=:userID';
$bind[':userID'] = $_POST['userID'];

$userinfoUpdate = $conn->prepare($query);
$userinfoUpdate->execute($bind);

if($userinfoUpdate->rowCount() > 0) {
    $res = array(
        'status' => 'Success',
        'msg' => 'แก้ไขข้อมูลสำเร็จ',
        'data' => array(
            'userID' => $_POST['userID']
        )
    );
} else {
    $res = array(
        'status' => 'Fail',
        'msg' => 'แก้ไขข้อมูลไม่สำเร็จ'
    );
}

echo json_encode($res);
?>