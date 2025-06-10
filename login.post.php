<?php
echo("<script>alert('login.post.php로 들어옴');</script>");
require_once("inc/db.php");

$login_id = isset($_POST['id']) ? $_POST['id'] : null;
$login_pw = isset($_POST['pass']) ? $_POST['pass'] : null;

// 파라미터 체크
if ($login_id == null || $login_pw == null){    
    echo("<script>alert('모두 입력하여 주세요.');</script>");
    // header("Location: login.php");
    exit();
}

echo ("<script>alert('입력한 아이디 :'+$login_id +'입력한 비번 :'+$login_pw);</script>");


// 회원 데이터
$member_data = db_select("select * from members where id = ?", array($login_id));
// var_dump($member_data);

// 회원 데이터가 없다면
if ($member_data == null || count($member_data) == 0){
    // header("Location: login.php");
    echo("<script>alert('회원가입을 먼저하세요');</script>");
    exit();
}

// 비밀번호 일치 여부 검증
$is_match_password = password_verify($login_pw, $member_data[0]['pass']);
// var_dump($member_data[0]['pass']);
// var_dump($login_pw);

// var_dump($is_match_password);

// 비밀번호 불일치
if ($is_match_password === false){
    header("Location: login.php");
    exit();
}

require_once("inc/session.php");
$_SESSION['member_id'] = $member_data[0]['id'];

// var_dump($_SESSION['member_id']);

// 메인페이지로 이동
header("Location: index.php");

?>