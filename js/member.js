function check_input() {
	console.log('check_input()');
	document.member_form.submit();
}


function login() {
	console.log('login()');
	document.login_form.submit();
}

function checkDuplicate() {
    var login_id = $("#login_id").val().trim();
    if (login_id === "") {
        $("#result").css("color", "red").text("아이디를 입력하세요.");
        return;
    }
    $.ajax({
        type: "GET", // 또는 POST, 서버 구현에 맞게
        url: "/checkId", // 서버의 중복체크 엔드포인트
        data: { login_id: login_id },
        success: function(response) {
            if (response.exists) {
                $("#result").css("color", "red").text("이미 사용 중인 아이디입니다.");
            } else {
                $("#result").css("color", "green").text("사용 가능한 아이디입니다.");
            }
        },
        error: function() {
            $("#result").css("color", "red").text("오류가 발생했습니다.");
        }
    });
}
