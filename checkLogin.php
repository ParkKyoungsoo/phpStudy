<?php
if ($_POST['id'] == "pks" && $_POST['pw'] == "pks") {
    // 로그인 성공시 게시판 페이지로 이동
    // echo $_POST['id'] . "," . $_POST["pw"];
    header("Location: articleList.php");
} else {
    // 실패시 경고창
    echo "<script>alert('ID 또는 비밀번호를 확인해 주세요.');</script>";
    // 이후 로그인 화면으로 이동
    echo "<script>window.location = 'loginPage.php'</script>";
}