<!DOCTYPE html>
<meta charset="UTF-8">
<title>掲示板</title>

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
         while ($row = $st->fetch()) {
             $name = htmlspecialchars($row['name']);
             $id = htmlspecialchars($row['id']);
             echo "<li><a href=\"show_commits.php?topic=$id\"> $name </a></ly>";
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
  <p>名前:<input type="text" name="name"></p>
  <p><input type="submit" value="作成"></p>
</form>
</section>
          
<?php include_once ('footer.html'); ?>
