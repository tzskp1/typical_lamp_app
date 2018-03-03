<!DOCTYPE html>
<meta charset="UTF-8">
<title>掲示板</title>

<?php include_once ('header.html'); ?>

<section>
  <h1> ログ </h1>
  <?php
    require_once('config.php');
    try {
        $pdo = new PDO(DBNAME,DBUSER,DBPASS,
                       array(
                           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                           PDO::ATTR_EMULATE_PREPARES => false,
                       ));
        $st = $pdo->prepare("select number, user, content from BBS.comment where topic = :topic order by number");
        $st->bindValue(':topic', @$_GET['topic'] ?: 0 , PDO::PARAM_INT);
        $st->execute();
        while ($row = $st->fetch()) {
            $user = htmlspecialchars($row['user']);
            $comment = htmlspecialchars($row['content']);
            $number = $row['number'];
            echo "<div>";
            echo "<p> $number $user </p>";
            echo "\t<div>";
            echo "<p> $comment </p>";
            echo "\t</div>";
            echo "</div>";
        }
    } catch (PDOException $e) {
        echo 'データベース接続エラー';
    }
  ?>
</section>
<section>
<h1> 投稿 </h1>
<form method="POST" action="submit_comment.php">
  <p>名前:<input type="text" name="name"></p>
  <p>コメント:<textarea name="comment"></textarea></p>
  <p><input type="hidden" name="topic" value=<?php echo $_GET['topic'] ?>></p>
  <p><input type="submit" value="作成"></p>
</form>
</section>
          
<?php include_once ('footer.html'); ?>
