<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "login";

// MySQL 연결
$connect = mysqli_connect($servername, $username, $password, $dbname);

// 로그인 처리
if (isset($_POST['login'])) {
    $input_id = $_POST['id'];
    $input_pw = $_POST['pw'];

    // 입력된 아이디로 회원 정보 조회
    $login_query = "SELECT * FROM usertable WHERE id='$input_id'";
    $result = mysqli_query($connect, $login_query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // 입력된 비밀번호가 일치하는지 확인
        if ($row['pw'] == $input_pw) {
            $_SESSION['userid'] = $input_id;
            if (isset($_SESSION['userid'])) {
                // 로그인 성공 시 recommend.php로 이동
                header("Location: recommend.php");
                exit();
            } else {
                echo "<script>alert('세션 설정 실패'); history.back();</script>";
            }
        } else {
            echo "<script>alert('비밀번호가 일치하지 않습니다'); history.back();</script>";
        }
    } else {
        echo "<script>alert('해당 아이디가 없습니다'); history.back();</script>";
    }
}

mysqli_close($connect);
?>
