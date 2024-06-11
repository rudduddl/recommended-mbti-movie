<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MBTI 영화 추천기 - 추천 받기</title>
</head>
<body>
    <div class="container">
        <h1>MBTI 영화 추천기</h1>
        <!-- MBTI 입력 폼 -->
        <form method="POST" action="recommend.php">
            <label for="mbti">당신의 MBTI를 입력하세요:</label>
            <input type="text" id="mbti" name="mbti" required>
            <button type="submit">추천 받기</button>
        </form>

        <!-- 추천 결과 표시 영역 -->
        <?php
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
                echo "<div id='recommendations'>";
                echo "<h2>$mbti 유형을 위한 영화 추천</h2>";
                echo "<ul id='movieList'>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>" . $row['movie1'] . "</li>";
                    echo "<li>" . $row['movie2'] . "</li>";
                    echo "<li>" . $row['movie3'] . "</li>";
                    echo "<li>" . $row['movie4'] . "</li>";
                    echo "<li>" . $row['movie5'] . "</li>";
                }
                echo "</ul>";
                echo "</div>";
            } else {
                echo "<script>alert('유효하지 않은 MBTI 유형이거나 추천 영화가 없습니다.');</script>";
            }

            mysqli_close($connect);
        }
        ?>
    </div>
</body>
</html>
