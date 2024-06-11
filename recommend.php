<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

if (!isset($_SESSION['userid'])) {
    header("Location: login.html");
    exit();
}

if (isset($_POST['mbti'])) {
    $mbti = strtoupper($_POST['mbti']);
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "login";

    // MySQL 연결
    $connect = mysqli_connect($servername, $username, $password, $dbname);

    // 연결 확인
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // 추천 영화 조회
    $query = "SELECT movie1, movie2, movie3, movie4, movie5 FROM movie WHERE mbti='$mbti'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $recommendations = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $recommendations[] = $row;
        }
        echo json_encode($recommendations);
    } else {
        echo json_encode(array("message" => "유효하지 않은 MBTI 유형이거나 추천 영화가 없습니다."));
    }

    mysqli_close($connect);
}
?>
