document.getElementById('login').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const id = document.getElementById('id').value;
    const password = document.getElementById('password').value;

    if (!id || !password) {
        alert('아이디와 비밀번호를 입력해주세요.');
        return;
    }

    // Perform login (this is just a placeholder, replace with actual login logic)
    if (id === 'testuser' && password === 'testpassword') {
        alert('로그인 성공!');
        window.location.href = 'home.html';
    } else {
        alert('아이디 또는 비밀번호가 잘못되었습니다.');
    }
});