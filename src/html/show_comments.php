<!DOCTYPE html>
<meta charset="UTF-8">
<title>掲示板</title>

<head>
  <link rel="stylesheet" href="bbs.css" type="text/css">
</head>

<?php include_once ('header.html'); ?>

<section>
  <?php
    require_once('config.php');
    try {
        $pdo = new PDO(DBNAME,DBUSER,DBPASS,
                       array(
                           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                           PDO::ATTR_EMULATE_PREPARES => false,
                       ));
        $st = $pdo->prepare("select name from BBS.topic where id = :topic");
        $st->bindValue(':topic', @$_GET['topic'] ?: 0 , PDO::PARAM_INT);
        $st->execute();
        $name = $st->fetch()['name'];
        echo "<h1> $name </h1>";

        $st = $pdo->prepare("select number, user, content from BBS.comment where topic = :topic order by number");
        $st->bindValue(':topic', @$_GET['topic'] ?: 0 , PDO::PARAM_INT);
        $st->execute();
        foreach ($st->fetchAll() as $row) {
            $user = htmlspecialchars_decode($row['user']);
            $comment = htmlspecialchars_decode($row['content']);
            $number = $row['number'];
            echo "<div class=\"comment-box\">\n";
            echo "<div>\n";
            echo "<span class=\"usernumber\">$number</span><span>$user</span>\n";
            echo "</div>\n";
            echo "<div>\n";
            echo "<pre>\n";
            echo "$comment";
            echo "</pre></div></div>\n";
        }
    } catch (PDOException $e) {
        echo 'データベース接続エラー';
    }
  ?>
</section>

<section>
<h1> 投稿 </h1>
<form method="POST" action="submit_comment.php">
  <div>
    <label for="username-input">名前</label>
    <input type="text" id="username-input" name="name">
  </div>
  <div>
    <label for="comment-input">コメント</label>
    <textarea id="comment-input" name="comment" cols="100" rows="8" required></textarea>
  </div>
  <input type="hidden" name="topic" value=<?php echo $_GET['topic'] ?>>
  <input type="submit" value="作成">
</form>
</section>
          
<?php include_once ('footer.html'); ?>
