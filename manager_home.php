<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>관리자 페이지-홈</title>
</head>

<body id="manager_body">
    <main class="manager_wrapper home">
        <div class="main_menu_wrapper">

            <a href="manager_home.php">
                <div class="menu" style="background-color:  rgb(74 173 255);"> 홈 </div>
            </a>
            <a href="manager_notice.php">
                <div class="menu"> 공지사항 관리 </div>
            </a>
            <a href="manager_product.php">
                <div class="menu"> 상품 관리 </div>
            </a>
            <a href="manager_event.php">
                <div class="menu"> 이벤트 관리 </div>
            </a>
            <a href="manager_inquiry.php">
                <div class="menu"> 고객 문의 관리 </div>
            </a>
        </div>

        <div class="main_display">
            <header>
                <div class="login_info">
                    <span class="on_id"> 접속 아이디: avbs345 </span>
                    <span class="on_dep"> 부서: 웹팀 </span>

                </div>
                <a href=""><button class="logout"> logout </button></a>

            </header>
            <section class="contents">
                <section class="contents_header">
                    <span class="title">알림</span>
                    <div class="notification">4</div>
                </section>
                <section class="board">
                    <div class="message"> 고객 문의: "사이즈 교환 문의합니다. 같은 색 다..." </div>
                    <div class="message"> 관리자 공지: 오늘 회의가 있습니다. 3회의실로 14:00까지 오시길 바랍니다. </div>
                    <div class="message"> 고객 문의: "이 상품 재고는 언제 채워지나요?..." </div>
                    <div class="message"> 기획 팀장님: "내일까지 해당 보고서 제출해주세요." </div>
                    <div class="message"> 기획 팀장님: "내일까지 해당 보고서 제출해주세요." </div>
                    <div class="message"> 기획 팀장님: "내일까지 해당 보고서 제출해주세요." </div>
                    <div class="message"> 고객 문의: "이 상품 재고는 언제 채워지나요?..." </div>
                    <div class="message"> 고객 문의: "이 상품 재고는 언제 채워지나요?..." </div>
                    <div class="message"> 고객 문의: "이 상품 재고는 언제 채워지나요?..." </div>
                    <div class="message"> 고객 문의: "이 상품 재고는 언제 채워지나요?..." </div>
                </section>
            </section>
        </div>
    </main>
</body>

</html>