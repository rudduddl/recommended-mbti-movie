<?php
// MySQL 데이터베이스에 연결
header('Content-Type: text/html; charset=utf-8');
$servername = "localhost"; 
$username = "root"; 
$password = "1234"; 
$dbname = "login"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

// 글 쓰기 폼으로부터 데이터 수신
$title = $_POST['title'];
$content = $_POST['content'];

// 데이터베이스에 새 글 추가
$sql = "INSERT INTO board (title, content) VALUES ('$title', '$content')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('새 글이 성공적으로 작성되었습니다.');</script>";
    echo "<script>window.location.href = 'board.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// MySQL 연결 종료
$conn->close();
?>
