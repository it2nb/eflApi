<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$postdata = file_get_contents("php://input");
@$request = json_decode($postdata);

require_once 'connection.php';

$res = array();

if(isset($request->userID)) {
    $query = 'Delete From userinfo Where userID=:userID';
    $userinfoDelete = $conn->prepare($query);
    $userinfoDelete->execute(array(':userID' => @$request->userID));

    if($userinfoDelete->rowCount() > 0) {
        $res = array(
            'status' => 'Success',
            'msg' => 'ลบข้อมูลสำเร็จ',
            'data' => array(
                'userID' => @$request->userID
            )
        );
    } else {
        $res = array(
            'status' => 'Fail',
            'msg' => 'ลบข้อมูลไม่สำเร็จ',
        );
    }
}
echo json_encode($res);
?>