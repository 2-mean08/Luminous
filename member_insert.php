<?php
    // POST로 전달된 값 받기
    $login_id   = $_POST["id"];             // 로그인 ID
    $password   = $_POST["pass"];           // 비밀번호
    $name       = $_POST["name"];           // 이름
    $phone      = $_POST["phone"];          // 전화번호
    $birth      = $_POST["birth"];          // 생년월일 (필드 없음, 별도 처리 필요)
    $email1     = $_POST["email1"];         // 이메일 앞부분
    $email2     = $_POST["email2"];         // 이메일 뒷부분
    $email      = $email1."@".$email2;      // 전체 이메일
    $nickname   = $_POST["nickname"];       // 닉네임
    $address    = $_POST["address"];        // 주소
    $gender     = $_POST["gender"];         // 성별(MALE/FEMALE)
    $admin      = isset($_POST["admin"]) ? 1 : 0; // 관리자 여부(체크박스 등)

    // 가입일시 현재로 설정
    $time_rgst = date("Y-m-d H:i:s");

    // MySQL 연결
    $con = mysqli_connect("localhost", "root", "", "luminous_db", 3309);

    // 비밀번호 암호화 (BCRYPT 사용)
    $bcrypt_pw = password_hash($password, PASSWORD_BCRYPT);

    // INSERT 쿼리 생성 (birth, refferer 등은 테이블에 없으므로 제외)
    $sql = "INSERT INTO Member (login_id, password, name, address, phone_number, email, nickname, time_rgst, gender, admin) ";
    $sql .= "VALUES ('$login_id', '$bcrypt_pw', '$name', '$address', '$phone', '$email', '$nickname', '$time_rgst', '$gender', $admin)";

    // 쿼리 실행
    mysqli_query($con, $sql);

    // 연결 종료
    mysqli_close($con);

    // 성공 시 이동
    echo "
        <script>
            location.href = 'success.php';
        </script>
    ";
?>
