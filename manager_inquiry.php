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
                <div class="menu"> 공지사항 관리 </div>
            </a>
            <a href="manager_product.php">
                <div class="menu"> 상품 관리 </div>
            </a>
            <a href="manager_event.php">
                <div class="menu"> 이벤트 관리 </div>
            </a>
            <a href="manager_inquiry.php">
                <div class="menu" style="background-color:  rgb(74 173 255);"> 고객 문의 관리 </div>
            </a>
        </div>


        <div class="main_display">
            <header>
                <div class="login_info">
                    <span class="on_id"> 접속 아이디: avbs345 </span>
                    <span class="on_dep"> 부서: 웹팀 </span>
                </div>
                <a href="index.php"><button class="logout"> logout </button></a>
            </header>
            <section class="contents">
                <section class="contents_header">
                    <span class="title"> 고객 문의 관리 </span>
                    <div class="notification">3</div>
                    <input type="text" class="search_inquiry">
                </section>
                <article class="scroller">
                    <form action="" method="INQUIRY">
                        <section class="board inquiry">
                            <div class="table_header">
                                <div class="table_col class">분류</div>
                                <div class="table_col title">제목</div>
                                <div class="table_col writer">글쓴이</div>
                                <div class="table_col views">조회수</div>
                                <div class="table_col date">날짜</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class"> 교환 </div>
                                <div class="table_col title"> 사이즈 교환 문의 </div>
                                <div class="table_col writer"> avbs345 </div>
                                <div class="table_col views"> 345 </div>
                                <div class="table_col date"> 2022-08-26 </div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class"> 반품 </div>
                                <div class="table_col title"> 반품 문의 </div>
                                <div class="table_col writer"> avbs345 </div>
                                <div class="table_col views"> 345 </div>
                                <div class="table_col date"> 2022-08-26 </div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class"> 배송 </div>
                                <div class="table_col title"> 배송 문의 </div>
                                <div class="table_col writer"> avbs345 </div>
                                <div class="table_col views"> 345 </div>
                                <div class="table_col date"> 2022-08-26 </div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class"> 결제 </div>
                                <div class="table_col title"> 결제 문의 </div>
                                <div class="table_col writer"> avbs345 </div>
                                <div class="table_col views"> 345 </div>
                                <div class="table_col date"> 2022-08-26 </div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class"> 교환 </div>
                                <div class="table_col title"> 색상 교환 문의 </div>
                                <div class="table_col writer"> avbs345 </div>
                                <div class="table_col views"> 345 </div>
                                <div class="table_col date"> 2022-08-26 </div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class"> 반품 </div>
                                <div class="table_col title"> 반품 문의 </div>
                                <div class="table_col writer"> avbs345 </div>
                                <div class="table_col views"> 345 </div>
                                <div class="table_col date"> 2022-08-26 </div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class"> 결제 </div>
                                <div class="table_col title"> 결제 문의 </div>
                                <div class="table_col writer"> avbs345 </div>
                                <div class="table_col views"> 345 </div>
                                <div class="table_col date"> 2022-08-26 </div>
                            </div>
                        </section>
                    </form>  
                </article>
            </section>
        </div>
    </main>
</body>

</html>