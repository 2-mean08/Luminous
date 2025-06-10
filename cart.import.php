<?php

require_once("inc/db.php");


//로그인 되어 있는 사용자의 아이디 가져오기
require_once("inc/session.php");
$user_id =$_SESSION['member_id'];

//사용자가 장바구니에 넣은 상품들 정보 가져오기
$result =db_select("select * from cart where user_id= ?", array($user_id));
// print_r($result);

//그 상품코드에 해당하는 상품의 정보 다 가져오기
// foreach($result as $r){
//    $a =db_select("select * from contents where content_code= ?", array($r["content_code"]));
//    echo "<br/>";
//    echo "<br/>";
//    print_r($a[0]["content_img"]);
// }


?>