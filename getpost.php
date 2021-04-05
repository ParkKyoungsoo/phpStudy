<?php
if ($_POST['id'] == "pks" && $_POST['pw'] == "pks") {
    echo $_POST['id'] . "," . $_POST["pw"];
} else {
    echo "<script>alert('ID 또는 비밀번호를 확인해 주세요.');</script>";
    echo "<script>window.location = 'mysqltest.php'</script>";
}