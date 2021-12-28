<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$postdata = file_get_contents("php://input");
@$request = json_decode($postdata);

require_once 'connection.php';

$res = array();

if(isset($request->userName) && isset($request->userPassword) && isset($request->userType) && isset($request->userStatus)) {
    $query = 'Insert Into user(userName, userPassword, userType, userStatus) Values (:userName, md5(:userPassword), :userType, :userStatus)';
    $userInsert = $conn->prepare($query);
    $userInsert->execute(array(
        ':userName' => $request->userName,
        ':userPassword' => $request->userPassword,
        ':userType' => $request->userType,
        ':userStatus' => $request->userStatus
    ));
    if($userInsert->rowCount() > 0) {
        $res = array(
            'status' => 'Success',
            'msg' => 'บันทึกข้อมูลสำเร็จ',
            'data' => array(
                'userID' => $conn->lastInsertId()
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