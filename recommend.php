<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['userid'])) {
    header("Location: login.html");
    exit();
}

$response = [];

if (isset($_POST['mbti'])) {
    $mbti = strtoupper($_POST['mbti']);
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "login";

    // MySQL 연결
    $connect = new mysqli($servername, $username, $password, $dbname);

    // 연결 확인
    if ($connect->connect_error) {
        die(json_encode(["error" => "Connection failed: " . $connect->connect_error]));
    }

    // 추천 영화 조회
    $query = "SELECT movie1, movie2, movie3, movie4, movie5 FROM movie WHERE mbti='$mbti'";
    $result = $connect->query($query);

    if ($result->num_rows > 0) {
        $recommendations = [];
        while ($row = $result->fetch_assoc()) {
            $recommendations[] = $row;
        }
        $response['recommendations'] = $recommendations;
    } else {
        $response['message'] = "유효하지 않은 MBTI 유형이거나 추천 영화가 없습니다.";
    }

    // 사용자 이름 조회 (예시로 ID가 1인 사용자)
    $sql = "SELECT name FROM usertable WHERE id = 1"; // 특정 ID 또는 조건에 따라 이름 가져오기
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response['name'] = $row["name"];
    } else {
        $response['name'] = "이름 없음"; // 데이터가 없을 경우 기본값 설정
    }
    $connect->close();

    echo json_encode($response);
}
?>
