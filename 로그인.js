document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    const userData = JSON.parse(localStorage.getItem(username));

    if (userData && userData.password === password) {
        document.getElementById('message').innerText = '로그인에 성공했습니다!';
    } else {
        document.getElementById('message').innerText = '아이디 또는 비밀번호가 올바르지 않습니다.';
    }
});