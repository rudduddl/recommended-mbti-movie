document.getElementById("sign").addEventListener("submit", function (event) {
  event.preventDefault(); // Prevent the default form submission

  const id = document.getElementById("id").value;
  const password = document.getElementById("password").value;
  const passwordCheck = document.getElementById("password-check").value;
  const mbti = document.querySelector(
    'input[name="mbti-choice"]:checked'
  ).value;

  // Regular expression for password validation
  const passwordRegex =
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#\$%\^&\*])[A-Za-z\d!@#\$%\^&\*]{8,16}$/;

  if (!id || !password || !passwordCheck) {
    alert("모든 필드를 입력해주세요.");
    return;
  }

  if (password !== passwordCheck) {
    alert("비밀번호가 일치하지 않습니다.");
    return;
  }

  if (!passwordRegex.test(password)) {
    alert(
      "비밀번호는 8~16자 영문 대/소문자를 사용하면서 숫자 혹은 특수문자를 반드시 사용해야 합니다."
    );
    return;
  }

  // Display success message
  alert(`회원가입이 완료되었습니다.\n아이디: ${id}\nMBTI: ${mbti}`);

  // Optionally, redirect to another page
  location.href = "login-page.html";
});
