<?php
require_once("inc/db.php");

$content_code = $_GET["content_code"];

$result = db_select("select * from defuser where content_code= ?", array("$content_code"));
$review = db_select("select * from review where content_code= ? ", array("$content_code"));
$photo_review = db_select("select * from review where content_code= ? and photo IS NOT NULL ", array("content_code")); //사진이 있는 리뷰

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luminous</title>
    <!-- jQuery 추가 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    body {
        background-color: #f8f8f8;
        font-family: 'Arial', sans-serif;
        color: #333;
    }

    .main_wrapper_contents_detail {
        max-width: 1000px;
        margin: auto;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .top {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .top_left .main-img img {
        width: 100%;
        max-width: 350px;
        border-radius: 10px;
    }

    .top_right {
        flex: 1;
        padding: 20px;
    }

    .product-title {
        font-size: 26px;
        font-weight: bold;
        color: #000;
    }

    .price-section {
        margin: 10px 0;
        font-size: 18px;
    }

    .original-price {
        text-decoration: line-through;
        color: #888;
    }

    .discount-price {
        color: #d32f2f;
        font-weight: bold;
    }

    .price_final {
        font-size: 22px;
        font-weight: bold;
        color: #000;
    }

    .buttons.choice {
        margin: 15px 0;
    }

    .op_button select {
        padding: 8px;
        font-size: 16px;
        background-color: #ffffff;
        border: 1px solid #ddd;
        cursor: pointer;
    }

    .total_price_wrapper {
        font-size: 20px;
        font-weight: bold;
        color: #000;
        margin-top: 20px;
    }

    .purchase-section button {
        background-color: #000;
        color: #fff;
        padding: 12px 24px;
        border: none;
        cursor: pointer;
        font-size: 18px;
        margin-right: 10px;
        transition: 0.3s ease-in-out;
    }

    .purchase-section button:hover {
        background-color: #333;
    }

    .review-item {
        padding: 15px;
        background-color: #fff;
        border-radius: 5px;
        margin-bottom: 10px;
        box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
    }

    .review-author {
        font-weight: bold;
        color: #000;
    }

    .review-rating {
        color: #ff9800;
    }

    .top_left .main-img {
        width: 100%;
        max-width: 500px;
        /* 기존보다 더 넓게 설정 */
        height: 400px;
        /* 일정한 높이 유지 */
        background-color: #e0e0e0;
        /* 빈 공간이 보이지 않도록 배경 설정 */
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }

    .top_left .main-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* 이미지가 비율을 유지하면서 꽉 차게 설정 */
    }

    .tab-menu {
        max-width: 800px;
        margin: 40px auto;
        position: relative;
    }

    .tabs {
        display: flex;
        justify-content: center;
        gap: 15px;
        padding: 10px;
        position: relative;
    }

    .tab-btn {
        flex: 1;
        background-color: transparent;
        color: #000;
        padding: 14px 28px;
        border: 2px solid #ccc;
        /* 기본 회색 테두리 (상, 좌, 우) */
        border-bottom: none;
        /* 아래쪽 테두리 제거 */
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
        transition: 0.3s;
    }

    .tab-btn:hover,
    .tab-btn.active {
        border-color: #000;
        /* 선택된 탭은 검은색 테두리 */
        border-bottom: none;
        /* 아래쪽 테두리 제거 */
        color: #000;
    }

    /* 검은색 긴 줄을 메뉴 버튼 아래에 추가 */
    .tabs::after {
        content: "";
        width: 100%;
        height: 2px;
        /* 검은 줄 두께 */
        background-color: #000;
        position: absolute;
        bottom: 0;
        left: 0;
    }

    .tab-content {
        background-color: #fff;
        padding: 30px;
        border-radius: 0;
        /* 기존에 둥근 모서리를 제거 */
        box-shadow: none;
        /* 그림자를 없애서 깔끔하게 연결 */
        margin-top: 0;
        /* 위쪽 여백을 줄여서 자연스럽게 연결 */
        text-align: left;
        display: none;
    }

    /* 기본적으로 상품 상세정보가 보이도록 설정 */
    #details {
        display: block;
    }
</style>

<body class="detail">
    <?php require_once("inc/header.php"); ?>

    <main class="main_wrapper_contents_detail">
        <form class="top" action="cart_insert.php?content_code=<?php echo $content_code; ?>" name="contents_form" method="POST">
            <section class="top_left">
                <div class="main-img">
                    <img src="<?php echo $result[0]['content_img']; ?>" alt="" />
                </div>
            </section>

            <section class="top_right">
                <h1 class="product-title"><?php echo $result[0]['content_name']; ?></h1>
                <div class="price-section">
                     <span class="price_final"><?php echo $result[0]['content_price']; ?>원</span>
                </div>

                <div class="buttons choice">
                    <span class="choice_title">색상</span>
                    <div class="op_button">
                        <select id="size_select" name="selected_capacity" onchange="SelectOption()">
                            <option value="30ml"><?php echo $result[0]['capacity_1']; ?></option>
                            <option value="60ml"><?php echo $result[0]['capacity_2']; ?></option>
                            <option value="100ml"><?php echo $result[0]['capacity_3']; ?></option>
                        </select>
                    </div>
                </div>

                <div class="buttons choice">
                    <span class="choice_title">패키지</span>
                    <div class="op_button">
                        <select id="gift_select" name="selected_package" onchange="SelectOption()">
                            <option value="기본구성">기본구성</option>
                            <option value="선물용">선물용</option>
                        </select>
                    </div>
                </div>

                <div class="total_price_wrapper">
                    <span class="total_price_title">총 결제 금액: </span>
                    <span class="total_price">0</span>원
                </div>
                <div class="insert_contents">
                    <div class="content content1">
                        <section class="option1">
                            <span class="color option1_color"></span>
                            <span class="size option1_size"></span>
                            <input type="hidden" name="content_options" value="none" />
                        </section>
                        <section class="option2">
                            <span class="amount_label">수량:</span> <!-- 수량 텍스트 추가 -->
                            <input type="number" onchange="AmountChange()" name="option2_amount" min="1" class="amount" value="1">
                        </section>
                        <section class="option3">
                            <span class="option3_price"></span>
                            <span>원</span>
                        </section>
                    </div>
                </div>
                <div class="purchase-section">
                    <button type="button" class="buy-now-btn" onclick="addToCartAndRedirect();"><span>구매하기</span></button>
                    <button type="button" class="add-cart-btn" onclick="cart_insert()"><span>장바구니</span></button>
                    <button type="button" class="user-btn"onclick="location.href='test.php'"><span>커스텀 디자인</span></button>
                    <button type="button" class="like-btn" id="likeBtn"><span>찜</span></button>
                </div>
            </section>
        </form>
        <section class="tab-menu">
            <div class="tabs">
                <button class="tab-btn active" onclick="showTab('details', this)">상품 상세정보</button>
                <button class="tab-btn" onclick="showTab('reviews', this)">상품 리뷰</button>
                <button class="tab-btn" onclick="showTab('inquiry', this)">상품 문의</button>
            </div>

            <div class="tab-content" id="details">
                <h2>📌 상품 상세정보</h2>
                <p>상품의 특징, 재료, 사용법 등을 설명하는 공간입니다.</p>
            </div>

            <div class="tab-content" id="reviews">
                <h2>📝 상품 리뷰</h2>
                <section class="reviews-section">
                    <section class="review-write-section">
                        <h2>리뷰 작성하기</h2>
                        <form class="review-write-form" action="review.insert.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="content_code" value="<?php echo $content_code; ?>">

                            <div class="form-group">
                                <label for="review_contents">리뷰 내용</label>
                                <textarea id="review_contents" name="review_contents" placeholder="리뷰를 입력하세요" rows="5" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="review_photo">리뷰 사진 업로드</label>
                                <input type="file" id="review_photo" name="photo" accept="image/*">
                            </div>

                            <div class="form-group">
                                <label for="rating">평점</label>
                                <select id="rating" name="rating" required>
                                    <option value="5">★★★★★ (5점)</option>
                                    <option value="4">★★★★☆ (4점)</option>
                                    <option value="3">★★★☆☆ (3점)</option>
                                    <option value="2">★★☆☆☆ (2점)</option>
                                    <option value="1">★☆☆☆☆ (1점)</option>
                                </select>
                            </div>

                            <div class="writeBtn">
                                <input class="upload" type="submit" name="action" value="등록">
                                <input type="button" value="취소" onclick="history.back(1)">
                            </div>
                        </form>
                    </section>

                    <section class="review-list-section">
                        <h2>작성된 리뷰</h2>
                        <?php if (!empty($review)): ?>
                            <div class="review-list">
                                <?php foreach ($review as $r): ?>
                                    <div class="review-item">
                                        <div class="review-header">
                                            <span class="review-author"><?php echo htmlspecialchars($r['writer_id']); ?></span>
                                            <span class="review-rating">
                                                <?php echo str_repeat('★', $r['star']); ?>
                                                <?php echo str_repeat('☆', 5 - $r['star']); ?>
                                            </span>
                                        </div>
                                        <div class="review-content">
                                            <p><?php echo nl2br(htmlspecialchars($r['review_contents'])); ?></p>
                                        </div>

                                        <?php if ($r['photo']): ?>
                                            <div class="review-photo">
                                                <img src="uploads/<?php echo htmlspecialchars($r['photo']); ?>" alt="리뷰 이미지" />
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p>아직 작성된 리뷰가 없습니다.</p>
                        <?php endif; ?>
                    </section>
                </section>
            </div>

            <div class="tab-content" id="inquiry">
                <h2>❓ 상품 문의</h2>
                <p>상품에 대한 궁금한 사항을 질문하는 공간입니다.</p>
            </div>
        </section>





    </main>

    <?php require_once("inc/footer.php"); ?>

    <!-- JavaScript 코드 추가 -->
    <script>
        function addToCartAndRedirect() {
            var formData = $("form[name='contents_form']").serialize(); // 폼 데이터를 직렬화

            $.ajax({
                url: "cart_insert.php?content_code=<?php echo $content_code; ?>", // 장바구니 추가 URL
                method: "POST",
                data: formData, // 폼 데이터 전송
                success: function(response) {
                    // 장바구니 추가가 성공하면 pay.php로 이동
                    window.location.href = 'pay.php';
                },
                error: function() {
                    alert('장바구니에 추가하는 데 실패했습니다.');
                }
            });
        }

        // 상품 금액, 옵션 금액 업데이트
        let ContentPrice = document.querySelector('.price_final'); // 상품 금액
        let TotalPrice = document.querySelector('.total_price'); // 총 금액
        let Option3Price = document.querySelector('.option3_price'); // 옵션 금액

        // 초기 ContentPrice 값 가져오기
        let contentPriceValue = parseInt(ContentPrice.textContent.replace(',', '').trim()); // 상품 가격을 숫자로 변환

        // 가격에 콤마 추가
        ContentPrice.innerHTML = contentPriceValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); // 가격에 콤마 추가

        let Price = 0; // 상품금액 * 상품수량 계산값

        // 옵션 선택 시 호출되는 함수
        function SelectOption() {
            let CheckedSize = document.getElementById("size_select").value; // 선택된 용량
            let Option1Size = document.querySelector('.option1_size');
            let Option2Amount = $('input[name=option2_amount]'); // 상품 수량

            // 용량 선택에 따른 가격 변환 (기본 가격에 추가 금액 적용)
            let additionalPrice = 0;

            // 용량 선택에 따른 가격 설정
            if (CheckedSize === "30ml") {
                additionalPrice = 0; // 30ml 가격
            } else if (CheckedSize === "60ml") {
                additionalPrice = 5000; // 60ml 가격
            } else if (CheckedSize === "100ml") {
                additionalPrice = 10000; // 100ml 가격
            }

            // 선물용을 선택하면 2000원 추가
            let giftOptionPrice = 0;
            if (document.getElementById("gift_select").value === "선물용") {
                giftOptionPrice = 2000; // 선물용 추가 금액
            }

            // 가격 계산 (상품 금액 + 용량 추가 금액 + 선물용 추가 금액) * 상품 수량
            Price = (contentPriceValue + additionalPrice + giftOptionPrice) * Number(Option2Amount.val()); // 상품금액 + 용량 추가금액 + 선물용 추가금액 * 수량 계산

            // 가격에 콤마 추가 (잘못된 콤마 위치 수정)
            Price = Price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            // 선택된 용량 표시 (용량 표시를 없앰)
            Option1Size.innerHTML = '';

            // 최종 가격 갱신
            Option3Price.innerHTML = Price;

            // 총 결제 금액을 갱신
            TotalPrice.innerHTML = Price;

            // 숨겨진 옵션 필드 갱신
            document.querySelector('.content').style.display = 'flex';
            $('input:hidden[name=content_options]').attr('value', CheckedSize);
        }

        // 수량 변경 시 호출되는 함수
        function AmountChange() {
            let Option2Amount = $('input[name=option2_amount]'); // 상품 수량
            let CheckedSize = document.getElementById("size_select").value; // 선택된 용량

            // 용량 선택에 따른 추가 금액
            let additionalPrice = 0;

            // 용량 선택에 따른 가격 설정
            if (CheckedSize === "30ml") {
                additionalPrice = 0; // 30ml 가격
            } else if (CheckedSize === "60ml") {
                additionalPrice = 5000; // 60ml 가격
            } else if (CheckedSize === "100ml") {
                additionalPrice = 10000; // 100ml 가격
            }

            // 선물용을 선택하면 2000원 추가
            let giftOptionPrice = 0;
            if (document.getElementById("gift_select").value === "선물용") {
                giftOptionPrice = 2000; // 선물용 추가 금액
            }

            // 가격 계산 (상품 금액 + 용량 추가 금액 + 선물용 추가 금액) * 상품 수량
            Price = (contentPriceValue + additionalPrice + giftOptionPrice) * Number(Option2Amount.val()); // 상품금액 + 용량 추가금액 + 선물용 추가금액 * 수량 계산

            // 가격에 콤마 추가 (잘못된 콤마 위치 수정)
            Price = Price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            // 최종 가격 갱신
            Option3Price.innerHTML = Price;

            // 총 결제 금액을 갱신
            TotalPrice.innerHTML = Price;
        }

        // 찜하기 버튼 클릭 이벤트
        document.getElementById('likeBtn').addEventListener('click', function() {
            // 찜하기 기능을 위한 AJAX 호출을 여기서 처리
            alert('찜하기 기능은 아직 구현되지 않았습니다.');
        });

        function cart_insert() {
            alert('장바구니에 추가되었습니다');
            document.contents_form.submit();
        }

        function showTab(tabId, element) {
            let tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => {
                tab.style.display = 'none';
            });

            document.getElementById(tabId).style.display = 'block';

            let buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(btn => {
                btn.classList.remove('active');
            });

            element.classList.add('active');
        }
    </script>
</body>

</html>