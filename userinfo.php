<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'connection.php';

$res = array();

if(isset($_GET['userID'])) {
    $query = 'Select * From userinfo Where userID=:userID';
    $userinfoQuery = $conn->prepare($query);
    $userinfoQuery->execute(array(
        ':userID' => $_GET['userID']
    ));
    if($userinfoQuery->rowCount() > 0) {
        $userinfo = $userinfoQuery->fetch();
        $res = array(
            'status' => 'Success',
            'msg' => 'สำเร็จ',
            'data' => $userinfo
        );
    }
} else {
    $query = 'Select * From userinfo';
    $userinfoQuery = $conn->prepare($query);
    $userinfoQuery->execute();
    $res = array(
        'status' => 'Success',
        'msg' => 'สำเร็จ',
        'data' => $userinfoQuery->fetchAll()
    );
}

echo json_encode($res);
?>