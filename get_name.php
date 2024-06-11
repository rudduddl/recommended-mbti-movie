<?php
session_start();
if (!isset($_SESSION['userid'])) {
    echo "이름 없음";
    exit();
}

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "login";

// MySQL 연결
$connect = mysqli_connect($servername, $username, $password, $dbname);

// 연결 확인
if (!$connect) {
    echo "이름 없음";
    exit();
}

// 사용자 이름 가져오기
$id = $_SESSION['userid'];
$query = "SELECT name FROM usertable WHERE id = '$id'";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo $row["name"];
} else {
    echo "이름 없음";
}

mysqli_close($connect);
?>
