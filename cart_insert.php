<?php
    $content_code=$_GET["content_code"];
    $content_options=$_POST["content_options"];
    $option2_amount=$_POST["option2_amount"];
    $cart_id=date("YmdHis");
    echo "$content_code";
    echo "$content_options";
    echo "$option2_amount";

    require_once("inc/db.php");
    

    //로그인 되어 있는 사용자의 아이디 가져오기
    require_once("inc/session.php");
    $user_id =$_SESSION['member_id'];

    // 데이터 저장
    db_insert("insert into cart (cart_id, content_code ,content_options ,content_amount , user_id) values (:cart_id, :content_code, :content_options , :content_amount , :user_id )",
        array(
            'cart_id' => $cart_id,
            'content_code' => $content_code,
            'content_options' => $content_options,
            'content_amount' => $option2_amount,
            'user_id' => $user_id,

        )
    );

    $prevPage = $_SERVER['HTTP_REFERER'];
    // 변수에 이전페이지 정보를 저장

    header('location:'.$prevPage);
?>
