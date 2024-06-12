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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // POST로부터 데이터 수신
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];

    // 쿼리 작성 및 실행
    $sql = "INSERT INTO comments (post_id, comment) VALUES ('$post_id', '$comment')";

    if ($conn->query($sql) === TRUE) {
        // 성공적으로 댓글이 작성되었음을 클라이언트에게 알림
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error));
    }
} else {
    // GET 요청일 때 (댓글 목록을 가져오는 요청)
    $post_id = $_GET['id'];

    // 해당 게시물에 대한 모든 댓글 가져오기
    $sql = "SELECT comment FROM comments WHERE post_id = '$post_id'";
    $result = $conn->query($sql);

    // HTML 형식의 댓글 목록 생성
    $comments_html = "<ul>";

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $comment = htmlspecialchars($row['comment']);
            $comments_html .= "<li>$comment</li>";
        }
    }

    $comments_html .= "</ul>";

    // HTML 형식으로 출력
    echo $comments_html;
}

// MySQL 연결 종료
$conn->close();
?>

