<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Luminous</title>
  <style>
    header.header#mainHeader {
      background-color: white !important;
    }

    body {
      background-color: #fff;
      color: #000;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
    }

    .main_wrapper {
      max-width: 900px;
      margin: 40px auto;
      padding: 0 10px;
      box-sizing: border-box;
    }

    .progress {
      display: flex;
      justify-content: space-between;
      margin-bottom: 30px;
    }

    .progress_step {
      flex: 1;
      text-align: center;
      padding: 10px;
      border-bottom: 2px solid #ccc;
      color: #666;
      font-weight: 600;
    }

    .progress_step.step1 {
      border-bottom-color: #000;
      color: #000;
    }

    .join_us_title {
      display: block;
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 24px;
      text-align: center;
      letter-spacing: 1px;
      color: #000;
    }

    .ref {
      font-size: 12px;
      color: #666;
      margin-bottom: 10px;
      font-weight: 600;
    }

    .required {
      color: red;
      margin-right: 4px;
      font-weight: bold;
    }

    .member_form_row {
      margin-bottom: 24px;
    }

    .form {
      display: flex;
      margin-bottom: 20px;
      align-items: center;
    }

    .col1 {
      width: 130px;
      font-weight: 600;
      color: #222;
      margin-right: 15px;
    }

    .col2 input[type="text"],
    .col2 input[type="password"] {
      width: 100%;
      max-width: 600px;
      padding: 14px 16px;
      border: 1.5px solid #ccc;
      border-radius: 0;
      font-size: 16px;
      color: #000;
      box-sizing: border-box;
      transition: border-color 0.3s;
    }

    .col2 input[type="text"]:focus,
    .col2 input[type="password"]:focus {
      border-color: #000;
      outline: none;
    }

    .email .col2 {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .email .col2 input[type="text"] {
      width: 48%;
    }

    .at-symbol {
      font-weight: bold;
      font-size: 16px;
    }

    section {
      margin-top: 40px;
      display: flex;
      justify-content: center;
      gap: 30px;
      padding: 0 10px;
    }

    button {
      border-radius: 0;
      padding: 16px 40px;
      font-size: 18px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      width: 260px;
      border: 1px solid #ccc;
    }

    .button_cancel {
      background-color: #fff;
      color: #000;
    }

    .button_cancel:hover {
      background-color: #eee;
      border-color: #aaa;
      color: #333;
    }

    .button_join {
      background-color: #000;
      color: #fff;
      border: none;
    }

    .button_join:hover {
      background-color: #333;
    }
    /* 중복체크 버튼 크기 조절 */
.small-btn {
  padding: 2px 10px;
  font-size: 13px;
  height: 14px;
  line-height: 1.2;
  margin-left: 5px;
  border-radius: 4px;
  background: #eee;
  border: 1px solid #ccc;
  cursor: pointer;
}
  </style>
</head>

<body>
  <?php require_once("inc/header.php"); ?>
  <main class="main_wrapper sign_up">
    <div class="progress">
      <div class="progress_step">
        <span class="title">STEP 1</span>
        <span>이용약관 동의</span>
      </div>
      <div class="progress_step step1">
        <span class="title">STEP 2</span>
        <span>회원정보 입력</span>
      </div>
      <div class="progress_step">
        <span class="title">STEP 3</span>
        <span>회원가입 완료</span>
      </div>
    </div>
    <span class="join_us_title">Luminous 회원가입</span>
    <div class="join_box">
<form name="member_form" method="POST" action="member_insert.php" class="member_form" autocomplete="off">
  <div class="member_form_col">
    <div class="ref">필수입력</div>
    <div class="member_form_row row1">
      <!-- 로그인 아이디 -->
      <div class="form id">
        <div class="col1"><span class="required">*</span>아이디</div>
        <div class="col2">
          <input type="text" name="id" required>
          <!-- 중복체크 버튼 및 결과 표시 -->
          <button type="button" class="small-btn" onclick="checkDuplicate('id')">중복확인</button>
          <span id="id_check_result"></span>
        </div>
      </div>
      <!-- 비밀번호 -->
      <div class="form">
        <div class="col1"><span class="required">*</span>비밀번호</div>
        <div class="col2">
          <input type="password" name="pass" required>
        </div>
      </div>
      <!-- 비밀번호 확인 -->
      <div class="form">
        <div class="col1"><span class="required">*</span>비밀번호 확인</div>
        <div class="col2">
          <input type="password" name="pass_confirm" required>
        </div>
      </div>
      <!-- 이름 -->
      <div class="form">
        <div class="col1"><span class="required">*</span>이름</div>
        <div class="col2">
          <input type="text" name="name" required>
        </div>
      </div>
      <!-- 휴대전화 -->
      <div class="form">
        <div class="col1"><span class="required">*</span>휴대전화</div>
        <div class="col2">
          <input type="text" name="phone" required>
        </div>
      </div>
      <!-- 이메일 -->
      <div class="form email">
        <div class="col1"><span class="required">*</span>이메일</div>
        <div class="col2">
          <input type="text" name="email1" required>
          <span class="at-symbol">@</span>
          <input type="text" name="email2" required>
          <span id="email_check_result"></span>
        </div>
      </div>
      <!-- 닉네임 -->
      <div class="form">
        <div class="col1"><span class="required">*</span>닉네임</div>
        <div class="col2">
          <input type="text" name="nickname" required>
          <span id="nickname_check_result"></span>
        </div>
      </div>
      <!-- 주소 -->
      <div class="form">
        <div class="col1"><span class="required">*</span>주소</div>
        <div class="col2">
          <input type="text" name="address" required>
        </div>
      </div>
      <!-- 성별 -->
      <div class="form">
        <div class="col1"><span class="required">*</span>성별</div>
        <div class="col2">
          <label><input type="radio" name="gender" value="MALE" required>남자</label>
          <label><input type="radio" name="gender" value="FEMALE">여자</label>
        </div>
      </div>
    </div>
    <div class="member_form_row row2">
      <!-- 생년월일 등 기타 선택 입력 -->
      <div class="form">
        <div class="col1"><span class="required">*</span>생년월일</div>
        <div class="col2">
          <input type="text" name="birth">
        </div>
      </div>
    </div>
      </div>
    </div>
  </div>
</form>

    </div>
    <section>
      <button class="button_cancel">취소</button>
      <button class="button_join" onclick="check_input()">가입</button>
    </section>
  </main>
  <script src="js/member.js"></script>
</body>
<?php require_once("inc/footer.php"); ?>

</html>
