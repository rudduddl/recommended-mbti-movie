document.getElementById('signupForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const mbti1 = document.querySelector('input[name="mbti1"]:checked').value;
    const mbti2 = document.querySelector('input[name="mbti2"]:checked').value;
    const mbti3 = document.querySelector('input[name="mbti3"]:checked').value;
    const mbti4 = document.querySelector('input[name="mbti4"]:checked').value;

    if (password !== confirmPassword) {
        document.getElementById('message').innerText = '비밀번호가 일치하지 않습니다.';
        return;
    }

    // 비밀번호 유효성 검사 (8~16자, 영문 대/소문자 및 숫자 또는 특수문자 포함)
    const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d|(?=.*[!@#$%^&*])).{8,16}$/;
    if (!passwordPattern.test(password)) {
        document.getElementById('message').innerText = '비밀번호는 8~16자 영문 대/소문자, 숫자 또는 특수문자를 포함해야 합니다.';
        return;
    }

    const mbti = mbti1 + mbti2 + mbti3 + mbti4;

    if (localStorage.getItem(username)) {
        document.getElementById('message').innerText = '이미 존재하는 아이디입니다.';
    } else {
        const userData = { password: password, mbti: mbti };
        localStorage.setItem(username, JSON.stringify(userData));
        document.getElementById('message').innerText = '회원가입이 완료되었습니다.';
    }
});