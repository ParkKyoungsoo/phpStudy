<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Document</title>
</head>

<body>
  <div class="header">
    자유게시판 <br />
  </div>
  <div class="content">
    <div class="list_option">
      <form method="GET" action="articleList.php">
        <select name="search_option">
          <option value="title" selected="selected">글 제목</option>
          <option value="no">글 번호</option>
          <option value="writer">작성자</option>
        </select>
        <input class="search_form" type="text" name="value">
        <button>검색</button>
      </form>
    </div>
    <table>
      <thead>
        <tr>
          <th class="table_no">No.</th>
          <th class="table_title">제목</th>
          <th class="table_writer">작성자</th>
          <th class="table_write_time">작성시간</th>
        </tr>
      </thead>
      <tbody class="table_content">
        <?php
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$str = file_get_contents('articles.json');
$json = json_decode($str, true);

if (isset($_GET['search_option']) && isset($_GET['value'])) {
    // json에서 title로 추출 후 재가공
    $resultArr = array();

    for ($i = 0; $i < count($json); $i++) {
        if (strpos($json[$i]['title'], $_GET['value'])) {
            echo $json[$i]['title'];
            array_push($resultArr, $json[$i]);
        }
    }

    if (count($resultArr) != 0) {
        $json = $resultArr;
    }

    var_dump($resultArr);

    echo $_GET['search_option'];
    echo var_dump($_GET['value']);

} else if (isset($_GET['writer'])) {
    // json에서 writer로 추출 후 재가공
} else {

}

$totalCnt = count($json);

$list = 5;
$block_cnt = 5;
// $block_num = ceil($page / $block_cnt);
$block_num = $page;
$block_start = $totalCnt - (($block_num - 1) * $block_cnt);
$block_end = $block_start - $block_cnt;

$total_page = ceil($totalCnt / $list);

if ($block_end < 1) {
    $block_end = 1;
}

$total_block = ceil($total_page / $block_cnt);
$page_start = ($page - 1) * $list;

if ($block_start - $block_cnt < 1) {
    $arrStart = 0;
    $arrCnt = $totalCnt % $block_cnt;
} else {
    $arrStart = $block_end;
    $arrCnt = 5;
}

$sliceArray = array_slice($json, $arrStart, $arrCnt);

for ($i = count($sliceArray) - 1; $i >= 0; $i--) {
    ?>
        <tr>
          <td class="table_no"><?php echo $sliceArray[$i]['no'] ?></td>
          <td class="table_title"
            onClick='location.href="article.php?no=<?php echo $sliceArray[$i]['no'] ?>&pageNum=<?php echo $page ?>"'>
            <?php echo $sliceArray[$i]['title'] ?>
          </td>
          <td class="table_writer"><?php echo $sliceArray[$i]['writer'] . "<br />" ?></td>
          <td class="table_write_time"><?php echo $sliceArray[$i]['regTime'] ?></td>
        </tr>
        <?php
}
?>
      </tbody>
    </table>
    <div class="pageNum" style="text-align: center;">
      <?php

echo "<a href='articleList.php?page=1'>처음 </a>";

if ($page <= 1) {

} else {
    $pre = $page - 1;
    echo "<a href='articleList.php?page=$pre'>◀ 이전</a>";
}

for ($i = 1; $i <= $total_page; $i++) {
    if ($page == $i) {
        echo "<div> $i </div>";
    } else {
        echo "<a href='articleList.php?page=$i'> $i </a>";
    }
}

if ($page >= $total_page) {

} else {
    $next = $page + 1;
    echo "<a href='articleList.php?page=$next'>다음 ▶</a>";
}

echo "<a href='articleList.php?page=$total_page'> 마지막</a>";

?>
    </div>
  </div>
</body>

</html>