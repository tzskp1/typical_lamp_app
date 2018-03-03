<?php
  require_once('config.php');
  try {
      $pdo = new PDO(DBNAME,DBUSER,DBPASS,
                     array(
                          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                          PDO::ATTR_EMULATE_PREPARES => false,
                     ));
      $st = $pdo->prepare("select length from BBS.topic where id = :topic");
      $st->bindValue(':topic', @$_POST['topic'] ?: 0 , PDO::PARAM_INT);
      $st->execute();
      $number = $st->fetch()['length'];

      $st = $pdo->prepare("update BBS.topic set length = length + 1 where id = :topic");
      $st->bindValue(':topic', @$_POST['topic'] ?: 0 , PDO::PARAM_INT);
      $st->execute();

      $st = $pdo->prepare("insert into BBS.comment(user, topic, content, number) values (:user, :topic, :content, :number)");
      $st->bindValue(':topic', @$_POST['topic'] ?: 0 , PDO::PARAM_INT);
      $st->bindValue(':content', htmlspecialchars(@$_POST['comment'] ?: '') , PDO::PARAM_STR);
      $st->bindValue(':user', htmlspecialchars(@$_POST['name'] ?: '') , PDO::PARAM_STR);
      $st->bindValue(':number', $number , PDO::PARAM_INT);
      $st->execute();
      header("Location: show.php?topic=" . $_POST['topic'], true, 302);
      exit();
  } catch (PDOException $e) {
      echo 'データベース接続エラー';
  }
