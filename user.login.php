<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$postdata = file_get_contents("php://input");
@$request = json_decode($postdata);

require_once 'connection.php';

$res = array();

if(isset($request->userName) && isset($request->userPassword)) {
    $query = 'Select * From user Left Join userinfo On user.userID=userinfo.userID Where userName=:userName and userPassword=md5(:userPassword)';
    $userQuery = $conn->prepare($query);
    $userQuery->execute(array(
        ':userName'=>$request->userName,
        ':userPassword'=>$request->userPassword
    ));

    if($userQuery->rowCount() > 0) {
        $res = array(
            'status' => 'Success',
            'msg' => 'สำเร็จ',
            'data' => $userQuery->fetch()
        );
    } else {
        $res = array(
            'status' => 'Fail',
            'msg' => 'ไม่พบข้อมูล'
        );
    }
} else {
    $res = array(
        'status' => 'Fail',
        'msg' => 'ข้อมูลไม่ครบ'
    );
}

echo json_encode($res);
?>