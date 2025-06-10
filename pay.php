<?php 
    require_once("inc/session.php"); 
    require_once("inc/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>dewaura</title>
</head>

<body>
    <?php require_once("inc/header.php"); ?>

    <main class="cart_wrapper pay">
        <section class="pay_header">
            <span class="pay_title">주문/결제</span>
            <div class="back_buttons">
                <a href="cart.php"><button>< 이전 페이지</button></a>
            </div>
        </section>

        <section class="table">
            <table>
                <tr class="table_header">
                    <td>이미지</td>
                    <td>상품정보</td>
                    <td>가격</td>
                    <td>수량</td>
                    <td>배송비</td>
                    <td>합계</td>
                </tr>
                <?php 
                    $total_price = 0;
                    // 세션에서 장바구니 데이터를 가져옴
                    if (isset($_SESSION['shopping_cart']) && count($_SESSION['shopping_cart']) > 0): 
                ?>
                    <?php foreach ($_SESSION['shopping_cart'] as $r): ?>
                        <?php
                            // 상품의 content_code로 여러 테이블에서 상품 정보를 가져옵니다.
                            $content_result = db_select("SELECT * FROM contents WHERE content_code = ?", array($r['content_code']));
                            if (!$content_result) {
                                // female_perfume 테이블에서 상품 정보 가져오기
                                $content_result = db_select("SELECT * FROM female_perfume WHERE content_code = ?", array($r['content_code']));
                            }
                            if (!$content_result) {
                                // male_perfume 테이블에서 상품 정보 가져오기
                                $content_result = db_select("SELECT * FROM male_perfume WHERE content_code = ?", array($r['content_code']));
                            }
                            if (!$content_result) {
                                // defuser 테이블에서 상품 정보 가져오기
                                $content_result = db_select("SELECT * FROM defuser WHERE content_code = ?", array($r['content_code']));
                            }
                        ?>
                        <tr>
                            <td><div class="img_wrapper"><img src="<?php echo $content_result[0]['content_img']; ?>" alt=""/></div></td>
                            <td class="content_info">
                                <span class="content_options"><?php echo $r['content_options']; ?></span>
                                <input type="hidden" value="<?php echo $content_result[0]['content_code']; ?>"/>
                                <span class="content_name"><?php echo $content_result[0]['content_name']; ?></span>
                            </td>
                            <td>
                                <?php 
                                    $price = $content_result[0]['content_price'];
                                    echo number_format($price) . "원";
                                ?>
                            </td>
                            <td class="content_info">
                                <input type="hidden" name="content_amount" value="<?php echo $r['content_amount']; ?>"/>
                                <?php 
                                    $amount = $r['content_amount'];
                                    echo number_format($amount) . "개";
                                ?>
                            </td>
                            <td>무료배송</td>
                            <td>
                                <?php 
                                    $total = $price * $amount;
                                    echo number_format($total) . "원";
                                ?>
                            </td>
                        </tr>
                        <?php $total_price += $total; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">장바구니에 상품이 없습니다.</td></tr>
                <?php endif; ?>
                
                <tr class="order_receipt">
                    <td class="title font_weight">합계</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <span class="total_price">
                            <?php echo number_format($total_price); ?>원
                        </span>
                    </td>
                </tr>
            </table>
        </section>

        <form action="pay.insert.php" method="POST">
            <section class = "order_info">
                <table>
                    <tr class = "table_info">
                        <td> 주문 정보 </td>
                        <td class = "import_text"> * 필수 입력 사항 </td>
                    </tr>
                </table>
                <div class = "custom_ord_info">
                    <div class="ord_info">
                        <div class="custom_info"> 01. 주문자 정보 </div>
                        <div class="ord_name"> 이름: <input name="orderer_name" required type="ord_text_name" maxlength="25" class="ord_text_info_name" /> </div>
                        <div class="ord_email_wrapper"> 
                            <ul class="ord_email">
                                이메일:  
                                <div class="ord_email_write">
                                    <input name="orderer_email1" required type="text" class = "info_text_email" maxlength="20">
                                    @
                                </div>
                                <li>
                                    <select class="ord_text_info_email" id="info_email" name="orderer_email2">
                                        <option value=""> 선택 </option>
                                        <option value="gmail.com"> gmail.com </option>
                                        <option value="naver.com"> naver.com </option>
                                        <option value="daum.net"> daum.net </option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                        <div class="ord_number_wrapper">
                            <ul class="ord_phone_number">
                                휴대전화: 
                                <li>
                                    <select id="info01" class="ord_text_info_number" name="orderer_phone1">
                                        <option value = ""> 선택 </option>
                                        <option value = "010"> 010 </option>
                                        <option value = "010"> 011 </option>
                                        <option value = "010"> 016 </option>
                                        <option value = "010"> 017 </option>
                                    </select>
                                </li>
                                <li>
                                    -
                                    <input name="orderer_phone2" required type="text" id="info02" class = "ord_info_center_number" size="4" onkeypress="onlyNumber();" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                </li>
                                <li>
                                    -
                                    <input name="orderer_phone3" required type="text" id="info03" class = "ord_info_last_number" size="4" onkeypress="onlyNumber();" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="deliv_info">
                        <div class="delivery_info"> 02. 배송 정보 </div>
                        <div class = "dest_choose">
                            배송지 선택
                            <div class="choose_imp"> * </div>
                        </div>
                        <div class="deliv_name"> 받는분: <input name="Recipient_name" required type="deliv_text_name" maxlength="25" class="deliv_text_info_name" /> </div>


                        <div class="deliv_address_wrapper">
                            <div class="deliv_address"> 주소: </div>
                            <div class="deliv_check"> 
                                    <div class="form">
                                        <div class="deliv_do_fore">
                                            <input type="radio" name="domestic" checked> 국내
                                            <input type="radio" name="domestic"> 해외
                                        </div>
                                    </div>
                                <div class="deliv_post_code">
                                    <input name="zip_code" type="text" class="deliv_text_post_code" id="postcode" placeholder="우편번호" readonly />
                                    <div class="deliv_search_code">
                                        <button type="button" class="deliv_search_post_code" onclick=""> 우편번호 </button>
                                    </div>
                                </div>
                                <div class="deliv_road_name">
                                    <input name="address1" type="text" class="deliv_search_road_name" id="address" placeholder="주소" readonly />
                                </div>
                                <div class="deliv_detail_post">
                                    <input name="address2" type="text" class="deliv_detail_address" placeholder="상세 주소 입력" required />
                                </div>
                            </div>
                        </div>
                        <div class="deliv_number_wrapper">
                            <ul class="deliv_phone_number">
                                휴대전화: 
                                <li>
                                    <select name="Recipient_phone1" id="info001" class="deliv_text_info_number">
                                        <option value = ""> 선택 </option>
                                        <option value = "010"> 010 </option>
                                        <option value = "010"> 011 </option>
                                        <option value = "010"> 016 </option>
                                        <option value = "010"> 017 </option>
                                    </select>
                                </li>
                                <li>
                                    -
                                    <input name="Recipient_phone2" required type="text" id="info002" class = "deliv_info_center_number" size="4" onkeypress="onlyNumber();" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                </li>
                                <li>
                                    -
                                    <input name="Recipient_phone3" required type="text" id="info003" class = "deliv_info_last_number" size="4" onkeypress="onlyNumber();" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                </li>
                            </ul>
                        </div>
                        <div class="deliv_message"> 배송 메시지: <input name="message" type="deliv_text_message" maxlength="30" class="deliv_text_info_message" /> </div>
                    </div>
                </div>

            </section>
            <section class="order_buttons">
                <button class="order_total"> 주문하기 </button>
            </section>
        </form>
        
        

    </main>

    <?php require_once("inc/footer.php"); ?>

    <script src="https://kit.fontawesome.com/73fbcb87e6.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="js/hot_issue.js"></script>
    <script src="js/member.js"></script>
    
</body>

</html>
