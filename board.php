<?php
// MySQL 데이터베이스에 연결
$servername = "localhost"; 
$username = "root"; 
$password = "1234"; 
$dbname = "login"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

if(isset($_GET['id'])) {
    // 특정 글 내용 조회
    $post_id = $_GET['id'];
    $sql = "SELECT title, content FROM board WHERE id=$post_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // JSON 형식으로 출력
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        echo "해당 글을 찾을 수 없습니다.";
    }
} else {
    // 글 목록 조회
    $sql = "SELECT id, title FROM board";
    $result = $conn->query($sql);

    $posts = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
    }

    // MySQL 연결 종료
    $conn->close();

    // JSON 형식으로 출력
    header('Content-Type: application/json');
    echo json_encode($posts);
}
?>
