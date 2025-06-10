<?php
require_once("inc/db.php");

$content_code = $_GET["content_code"];

$result = db_select("select * from contents where content_code= ?", array("$content_code"));
$review = db_select("select * from review where content_code= ? ", array("$content_code"));
$photo_review = db_select("select * from review where content_code= ? and photo IS NOT NULL ", array("$content_code")); //사진이 있는 리뷰
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/new.css">
    <title>Product Detail</title>
</head>

<body>
    <?php require_once("inc/header.php"); ?>

    <main class="product-detail-container">
        <section class="top_left">

            <div class="main-img">
                <img src="<?php echo $result[0]["content_img"]; ?>" alt="" />
            </div>
            <div class="imgs">
                <div class="img"><img src="<?php echo $result[0]["content_img1"]; ?>" alt="" /></div>
                <div class="img"><img src="<?php echo $result[0]["content_img2"]; ?>" alt="" /></div>
                <div class="img"><img src="<?php echo $result[0]["content_img3"]; ?>" alt="" /></div>
                <div class="img"><img src="<?php echo $result[0]["content_img4"]; ?>" alt="" /></div>
            </div>
        </section>



        <section class="top_right">

            <h1 class="product-title"><?php echo $result[0]["content_name"]; ?></h1>
            <p class="product-brand"><?php echo $result[0]["brand_name"]; ?></p> <!-- 브랜드 이름 -->
            <div class="price-section">
                <p class="original-price"><?php echo number_format($result[0]["content_cost"]); ?>원</p>
                <p class="discount-price"><?php echo number_format($result[0]["content_price"]); ?>원 <span class="discount-percent"><?php echo $result[0]["discount_rate"]; ?>%</span></p>
                <p class="reward">적립혜택: <span><?php echo number_format($result[0]["content_price"] * 0.01); ?>원 (1%)</span></p> <!-- 2% 적립 -->
            </div>

            <fieldset class="ID_field-container">
                <p class="lables">용량</p>
                <div class="op_button">
                    <button class="option-btn" onclick="selectOption(this)">100ml</button>
                    <button class="option-btn" onclick="selectOption(this)">50ml (-35,800원)</button>
                    <button class="option-btn" onclick="selectOption(this)">[품절] 30ml (-59,800원)</button>
                </div>
            </fieldset>

            <div class="options-section">
                <fieldset class="ID_field-container">
                    <p class="lables">패키지</p>
                    <button class="option-btn" onclick="selectOption(this)">선물용 포장</button>
            </div>
            </fieldset>


            <div class="delivery-section">
                
                <p>배송비: <span>2,500원</span> (97,000원 이상 구매 시 무료)</p>
                <p>배송일정: 2시 이전 주문 시 <span>당일출고</span> (주말, 공휴일 제외)</p>
                <p>배송방법: 퍼퓸그라피 / 본사 직배송</p>
            </div>

            <div class="purchase-section">
                <button class="buy-now-btn">구매하기</button>
                <button class="add-cart-btn">장바구니</button>
                <button class="like-btn">찜</button>
            </div>
            </div>
        </section>

        <section class="reviews-section">
        <section class="review-write-section">
                <h2>리뷰 작성하기</h2>
                <form class="review-write-form" action="submit_review.php" method="POST" enctype="multipart/form-data">
                    <!-- 숨겨진 필드: 제품 코드 -->
                    <input type="hidden" name="content_code" value="<?php echo $content_code; ?>">

                    <!-- 작성자 -->
                    <div class="form-group">
                        <label for="writer_id">작성자 ID</label>
                        <input type="text" id="writer_id" name="writer_id" placeholder="작성자 ID를 입력하세요" required>
                    </div>

                    <!-- 리뷰 내용 -->
                    <div class="form-group">
                        <label for="review_contents">리뷰 내용</label>
                        <textarea id="review_contents" name="review_contents" placeholder="리뷰를 입력하세요" rows="5" required></textarea>
                    </div>

                    <!-- 리뷰 사진 -->
                    <div class="form-group">
                        <label for="review_photo">리뷰 사진 업로드</label>
                        <input type="file" id="review_photo" name="review_photo" accept="image/*">
                    </div>

                    <!-- 평점 -->
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

                    <!-- 작성 버튼 -->
                    <button type="submit" class="submit-review-btn">리뷰 작성</button>
                </form>
            </section>
            <form class="review_view" action="" method="REVIEW">
                <div class="center_title">
                    <div class="review_click" id="review"> 리뷰(<?php echo (count($review)); ?>) </div>
                </div>
                <div class="review_detail_wrapper">
                    <div class="review_title_one"> 상품 후기 </div>
                    <div class="review_title_two"> <?php echo (count($review)); ?> </div>
                </div>

                <div class="review_photos_wrapper">
                    <div class="rev_pho_all">
                        <div class="review_photo_one"> 포토(<?php echo (count($photo_review)); ?>) </div>
                    </div>
                    <div class="photos_wrapper">
                        <div class="photos">
                            <?php foreach ($photo_review as $r) { ?>
                                <div class="photo"><img src="<?php echo $r['photo']; ?>" alt="포토 리뷰"></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="review_gather_wrapper">
                    ...
                </div>
            </form>
            
        </section>



    </main>

    <script>
        function selectOption(button) {
            // 모든 옵션 버튼에서 'active' 클래스를 제거
            const allButtons = document.querySelectorAll('.option-btn');
            allButtons.forEach(btn => btn.classList.remove('active'));

            // 클릭된 버튼에 'active' 클래스 추가
            button.classList.add('active');
        }
    </script>

    <?php require_once("inc/footer.php"); ?>

    <script src="https://kit.fontawesome.com/73fbcb87e6.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/55083c7425.js" crossorigin="anonymous"></script>
    <script src="js/hot_issue.js"></script>
    <script src="js/app.js"></script>
    <script src="js/option.js"></script>
    <script src="js/star.js"></script>
</body>

</html>