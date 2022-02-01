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

if(isset($request->userinfoGender)) {
    $query .= 'userinfoGender=:userinfoGender'; // Update userinfo Set userinfoGender=:userinfoGender
    $bind[':userinfoGender'] = @$request->userinfoGender;
    $n = 1;
}

if(isset($request->userinfoPrefix)) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoPrefix=:userinfoPrefix';
    //Update userinfo Set userinfoGender=:userinfoGender, userinfoPrefix=:userinfoPrefix
    //Update userinfo Set userinfoPrefix=:userinfoPrefix
    $bind[':userinfoPrefix'] = @$request->userinfoPrefix;
    $n = 1;
}

if(isset($request->userinfoFullname)) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoFullname=:userinfoFullname';
    $bind[':userinfoFullname'] = $request->userinfoFullname;
    $n = 1;
}

if(isset($request->userinfoBirthday)) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoBirthday=:userinfoBirthday';
    $bind[':userinfoBirthday'] = @$request->userinfoBirthday;
    $n = 1;
}

if(isset($request->userinfoAddress)) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoAddress=:userinfoAddress';
    $bind[':userinfoAddress'] = @$request->userinfoAddress;
    $n = 1;
}

if(isset($request->userinfoPhone)) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoPhone=:userinfoPhone';
    $bind[':userinfoPhone'] = @$request->userinfoPhone;
    $n = 1;
}

if(isset($request->userinfoEmail)) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoEmail=:userinfoEmail';
    $bind[':userinfoEmail'] = @$request->userinfoEmail;
    $n = 1;
}

if(isset($request->userinfoWebsite)) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoWebsite=:userinfoWebsite';
    $bind[':userinfoWebsite'] = @$request->userinfoWebsite;
    $n = 1;
}

if(isset($request->userinfoTalent)) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoTalent=:userinfoTalent';
    $bind[':userinfoTalent'] = @$request->userinfoTalent;
    $n = 1;
}

if(isset($request->userinfoHobby)) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoHobby=:userinfoHobby';
    $bind[':userinfoHobby'] = @$request->userinfoHobby;
    $n = 1;
}

if(isset($request->userinfoGoal)) {
    if($n == 1) {
        $query .= ', ';
    }
    $query .= 'userinfoGoal=:userinfoGoal';
    $bind[':userinfoGoal'] = @$request->userinfoGoal;
    $n = 1;
}

$query .= ' Where userID=:userID';
$bind[':userID'] = @$request->userID;

$userinfoUpdate = $conn->prepare($query);
$userinfoUpdate->execute($bind);

if($userinfoUpdate->rowCount() > 0) {
    $res = array(
        'status' => 'Success',
        'msg' => 'แก้ไขข้อมูลสำเร็จ',
        'data' => array(
            'userID' => @$request->userID
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