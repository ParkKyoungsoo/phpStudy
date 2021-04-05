<!DOCTYPE html>
<html lang="en">

<?php
$str = file_get_contents('articles.json');
$json = json_decode($str, true);
$pageNum = $_GET['pageNum'];

for ($i = 0; $i < count($json); $i++) {
    if ($_GET['no'] == $json[$i]['no']) {
        ?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="articleStyle.css">
  <title><?php echo $json[$i]['title'] ?></title>
</head>

<body>

  <div class="header">
    <div class="article_title">
      <?php echo $json[$i]['title'] ?>
    </div>
    <div class="article_info">
      <div class="writer"><?php echo $json[$i]['writer'] ?></div>
      <div class="write_time"><?php echo $json[$i]['regTime'] ?></div>
    </div>
  </div>
  <div class="content">
    <?php echo $json[$i]['contents'] ?>
  </div>
  <div class="footer">
    <button onClick="location.href='articleList.php?page=<?php echo $pageNum ?>'">목록으로</button>
  </div>
  <?php
}
}
?>
</body>

</html>