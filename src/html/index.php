<!DOCTYPE html>
<meta charset="UTF-8">
<title>掲示板</title>

<head>
  <link rel="stylesheet" href="bbs.css" type="text/css">
</head>

<?php include_once ('header.html'); ?>

<section>
<h1> 話題 </h1>
  <ul> 
    <?php
      require_once('config.php');
      try {
          $pdo = new PDO(DBNAME,DBUSER,DBPASS,
                         array(
                             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                             PDO::ATTR_EMULATE_PREPARES => false,
                         ));
          $st = $pdo->query("select name, id from BBS.topic");
          foreach ($st->fetchAll() as $row) {
              $name = htmlspecialchars($row['name']);
              $id = htmlspecialchars($row['id']);
              echo "<li><a href=\"show_comments.php?topic=$id\"> $name </a></li>";
          }
      } catch (PDOException $e) {
         echo 'データベース接続エラー';
      }
    ?>
  </ul>
</section>

<section>
<h1> 新規作成 </h1>
<form method="GET" action="make_topic.php">
  <div>
    <label for="user_name">名前</label>
    <input type="text" id="user_name" name="name" required>
  </div>
  <input type="submit" value="作成">
</form>
</section>
          
<?php include_once ('footer.html'); ?>
