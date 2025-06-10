<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>고객센터</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* 공통 스타일 */
        body {
            margin: 0;
            font-family: 'Noto Sans KR', sans-serif;
            background-color: #fdf8e3;
            color: #333;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
        header {
            background-color: #000;
            color: #fff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .logo {
            font-size: 24px;
            font-weight: bold;
        }
        header .logo a {
            color: #fff;
        }
        header nav {
            display: flex;
            gap: 20px;
        }
        header nav a {
            color: #fff;
            font-size: 14px;
        }
        header nav a.active {
            color: #007bff;
        }
        header nav a.home {
            color: #fff; /* 홈 색상 하얀색으로 설정 */
        }
        .container {
            padding: 40px 20px;
            max-width: 900px; /* 컨테이너 폭 조정 */
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .search-bar {
            margin-bottom: 20px;
            display: flex;
        }
        .search-bar input {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .search-bar button {
            padding: 10px 15px;
            background-color: #000; /* 검은색 배경 */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 5px;
        }
        .search-bar button:hover {
            background-color: #333; /* 어두운 검정색 */
        }
        .filter-section {
            margin-bottom: 20px;
        }
        .filter-section select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .faq-list, .guide-section {
            margin: 20px 0;
        }
        .faq-list h3, .guide-section h3 {
            font-size: 20px;
            margin-bottom: 15px;
        }
        .faq-list ul, .guide-section ul {
            list-style: none;
            padding: 0;
        }
        .faq-list ul li, .guide-section ul li {
            margin: 10px 0;
            padding: 15px;
            background: #f1f1f1;
            border-radius: 4px;
        }
        .chat-button, .new-inquiry-button {
            display: inline-block;
            padding: 15px 30px;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            margin-top: 20px;
        }
        .chat-button {
            background-color: #28a745;
        }
        .new-inquiry-button {
            background-color: #ffc107;
        }
        .contact-info {
            margin-top: 40px;
            font-size: 14px;
            color: #555;
        }
        .contact-info span {
            display: block;
            margin-bottom: 10px;
        }
        .social-links {
            margin-top: 20px;
            text-align: center;
        }
        .social-links a {
            margin: 0 15px;
            color: #007bff;
            text-decoration: none;
            font-size: 18px;
        }
        /* 반응형 */
        @media (max-width: 768px) {
            .search-bar {
                flex-direction: column;
            }
            .search-bar button {
                margin-left: 0;
                margin-top: 10px;
            }
        }
    </style>
    <script>
        function setActiveLink(link) {
            const links = document.querySelectorAll('header nav a');
            links.forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        }
    </script>
</head>
<body>
    <!-- 헤더 -->
    <header>
        <div class="logo">
            <a href="index.php" class="home" onclick="setActiveLink(this)">DewAura 고객센터</a>
        </div>
        <nav>
            <a href="index.php" class="home active" onclick="setActiveLink(this)">홈</a>
            <a href="#" onclick="setActiveLink(this)">고객센터</a>
            <a href="#" onclick="setActiveLink(this)">문의 등록</a>
        </nav>
    </header>

    <!-- 컨테이너 -->
    <div class="container">
        <!-- 검색창 -->
        <div class="search-bar">
            <input type="text" placeholder="무엇을 도와드릴까요?">
            <button>검색</button>
        </div>

        <!-- 카테고리 필터 -->
        <div class="filter-section">
            <select>
                <option value="all">전체 카테고리</option>
                <option value="account">계정 관련</option>
                <option value="payment">결제 관련</option>
                <option value="products">상품 관련</option>
            </select>
        </div>

        <!-- 자주 묻는 질문 -->
        <div class="faq-list">
            <h3>자주 묻는 질문</h3>
            <ul>
                <li>Q1. 계정을 어떻게 변경하나요?</li>
                <li>Q2. 비밀번호를 잊어버렸어요.</li>
                <li>Q3. 결제 관련 문제가 발생했어요.</li>
                <li>Q4. 향수를 구매했는데, 제가 원하는 향이 아니예요.</li>
            </ul>
        </div>

        <!-- 이용 가이드 -->
        <div class="guide-section">
            <h3>이용 가이드</h3>
            <ul>
                <li>고객센터 운영 시간을 확인해주세요.</li>
                <li>문의 등록 시 상세 정보를 작성해주세요.</li>
                <li>문제가 발생할 경우 FAQ를 먼저 확인하세요.</li>
            </ul>
        </div>

        <!-- 상담 버튼 -->
        <a href="#" class="chat-button">실시간 상담사 연결</a>
        <a href="#" class="new-inquiry-button">문의 등록</a>

        <!-- 연락처 및 운영 정보 -->
        <div class="contact-info">
            <span>운영 시간: 월~금 9:00 - 18:00</span>
            <span>전화: (02)415-9712</span>
            <span>이메일: dewAura@shingu.ac.kr</span>
        </div>

        <!-- 소셜 미디어 링크 -->
        <div class="social-links">
            <a href="#" target="_blank">Facebook</a> 
            <a href="#" target="_blank">Instagram</a> 
            <a href="#" target="_blank">Twitter</a>
        </div>
    </div>
</body>
</html>
