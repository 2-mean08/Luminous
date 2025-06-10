<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>관리자 페이지-공지사항</title>
</head>

<body id="manager_body">
    <main class="manager_wrapper notice">
        <div class="main_menu_wrapper">

            <a href="manager_home.php">
                <div class="menu" > 홈 </div>
            </a>
            <a href="manager_notice.php">
                <div class="menu" style="background-color:  rgb(74 173 255);"> 공지사항 관리 </div>
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
                    <span class="title">공지사항 관리</span>
                    <input type="text" class="search">
                    <a href=""><button class="regist"> 등록 </button></a>
                    <a href=""><button class="delete"> 삭제 </button></a>
                </section>
                <article class="scroller">
                    <form action="" method="INQUIRY">
                        <section class="board notice">
                            <div class="table_header">
                                <div class="table_col class">분류</div>
                                <div class="table_col title">제목</div>
                                <div class="table_col writer">글쓴이</div>
                                <div class="table_col views">조회수</div>
                                <div class="table_col date">날짜</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class">1</div>
                                <div class="table_col title">추석연휴 배송 공지</div>
                                <div class="table_col writer">abc123</div>
                                <div class="table_col views">12,522</div>
                                <div class="table_col date">2022-10-20</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class">2</div>
                                <div class="table_col title">추석연휴 배송 공지</div>
                                <div class="table_col writer">abc123</div>
                                <div class="table_col views">12,522</div>
                                <div class="table_col date">2022-10-20</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class">3</div>
                                <div class="table_col title">추석연휴 배송 공지</div>
                                <div class="table_col writer">abc123</div>
                                <div class="table_col views">12,522</div>
                                <div class="table_col date">2022-10-20</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class">4</div>
                                <div class="table_col title">추석연휴 배송 공지</div>
                                <div class="table_col writer">abc123</div>
                                <div class="table_col views">12,522</div>
                                <div class="table_col date">2022-10-20</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class">5</div>
                                <div class="table_col title">추석연휴 배송 공지</div>
                                <div class="table_col writer">abc123</div>
                                <div class="table_col views">12,522</div>
                                <div class="table_col date">2022-10-20</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class">6</div>
                                <div class="table_col title">추석연휴 배송 공지</div>
                                <div class="table_col writer">abc123</div>
                                <div class="table_col views">12,522</div>
                                <div class="table_col date">2022-10-20</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class">7</div>
                                <div class="table_col title">추석연휴 배송 공지</div>
                                <div class="table_col writer">abc123</div>
                                <div class="table_col views">12,522</div>
                                <div class="table_col date">2022-10-20</div>
                            </div>
                        </section>
                    </form>  
                </article>
            </section>
        </div>
    </main>
</body>

</html>