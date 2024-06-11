<?php
header('Content-Type: text/html; charset=utf-8');
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "login";

// MySQL 연결
$connect = mysqli_connect($servername, $username, $password, $dbname);

// 회원가입 처리
if (isset($_POST['signup'])) {
    $input_id = $_POST['id'];
    $input_pw = $_POST['pw'];
    $input_name = $_POST['name'];

    // 입력된 아이디가 이미 존재하는지 확인
    $check_query = "SELECT * FROM usertable WHERE id='$input_id'";
    $check_result = mysqli_query($connect, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // 이미 존재하는 아이디일 경우
        echo "<script>alert('이미 존재하는 아이디입니다.'); history.back();</script>";
    } else {
        // 회원가입 정보 삽입
        $signup_query = "INSERT INTO usertable (id, pw, name) VALUES ('$input_id', '$input_pw', '$input_name')";

        if (mysqli_query($connect, $signup_query)) {
            echo "<script>alert('회원가입 성공!'); location.href='login-page.html';</script>";
        } else {
            echo "회원가입 실패: " . mysqli_error($connect);
        }
    }
}

mysqli_close($connect);
?>
