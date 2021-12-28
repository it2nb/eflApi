<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$postdata = file_get_contents("php://input");
@$request = json_decode($postdata);

require_once 'connection.php';

$res = array();

if(isset($request->userID) && isset($request->userinfoFullname) && isset($request->userinfoPhone) && isset($request->userinfoEmail)) {
    $query = 'Insert Into userinfo(userID, userinfoGender, userinfoPrefix, userinfoFullname, userinfoBirthday, userinfoAddress, userinfoPhone, userinfoEmail, userinfoWebsite, userinfoTalent, userinfoHobby, userinfoGoal) Values (:userID, :userinfoGender, :userinfoPrefix, :userinfoFullname, :userinfoBirthday, :userinfoAddress, :userinfoPhone, :userinfoEmail, :userinfoWebsite, :userinfoTalent, :userinfoHobby, :userinfoGoal)';
    $userinfoInsert = $conn->prepare($query);
    $userinfoInsert->execute(array(
        ':userID' => @$request->userID,
        ':userinfoGender' => @$request->userinfoGender,
        ':userinfoPrefix' => @$request->userinfoPrefix,
        ':userinfoFullname' => @$request->userinfoFullname,
        ':userinfoBirthday' => @$request->userinfoBirthday,
        ':userinfoAddress' => @$request->userinfoAddress,
        ':userinfoPhone' => @$request->userinfoPhone,
        ':userinfoEmail' => @$request->userinfoEmail,
        ':userinfoWebsite' => @$request->userinfoWebsite,
        ':userinfoTalent' => @$request->userinfoTalent,
        ':userinfoHobby' => @$request->userinfoHobby,
        ':userinfoGoal' => @$request->userinfoGoal
    ));
    if($userinfoInsert->rowCount() > 0) {
        $res = array(
            'status' => 'Success',
            'msg' => 'บันทึกข้อมูลสำเร็จ',
            'data' => array(
                'userID' => $request->userID
            )
        );
    } else {
        $res = array(
            'status' => 'Fail',
            'msg' => 'บันทึกข้อมูลผิดพลาด'
        );
    }
} else {
    $res = array(
        'status' => 'Fail',
        'msg' => 'ข้อมูลไม่ครบถ้วน'
    );
}

echo json_encode($res);
?>