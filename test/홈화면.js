document.addEventListener('DOMContentLoaded', function () {
    // 로컬 스토리지에서 사용자 MBTI 정보 가져오기 (예: 회원 가입 페이지에서 저장된 정보)
    const userMBTI = localStorage.getItem('userMBTI') || 'ENFP'; // 기본값을 ENFP로 설정
    
    const movieList = document.getElementById('movie-list');
    const movies = Array.from(movieList.getElementsByClassName('movie'));
    
    // 사용자 MBTI와 동일한 영화 목록을 맨 위로 이동
    const userMBTIMovies = movies.filter(movie => movie.getAttribute('data-mbti') === userMBTI);
    const otherMBTIMovies = movies.filter(movie => movie.getAttribute('data-mbti') !== userMBTI);
    
    // 영화 목록을 비웁니다.
    movieList.innerHTML = '';

    // 사용자 MBTI 영화 목록을 먼저 추가
    userMBTIMovies.forEach(movie => movieList.appendChild(movie));
    // 나머지 MBTI 영화 목록을 추가
    otherMBTIMovies.forEach(movie => movieList.appendChild(movie));

    // 영화 이미지를 클릭하면 구글 검색으로 이동
    const movieImages = movieList.getElementsByTagName('img');
    Array.from(movieImages).forEach(img => {
        img.addEventListener('click', function () {
            const movieTitle = this.getAttribute('data-title');
            window.open(`https://www.google.com/search?q=${encodeURIComponent(movieTitle)}`, '_blank');
        });
    });
});