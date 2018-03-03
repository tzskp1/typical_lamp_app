<?php
  require_once('config.php');
  try {
      $pdo = new PDO(DBNAME,DBUSER,DBPASS,
                     array(
                          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                          PDO::ATTR_EMULATE_PREPARES => false,
                     ));
      $st = $pdo->prepare("insert into BBS.topic(name,length) values (:name,1)");
      $st->bindValue(':name', @$_GET['name'] ?: "" , PDO::PARAM_STR);
      $st->execute();
      header("Location: index.php", true, 302);
      exit();
  } catch (PDOException $e) {
      echo 'データベース接続エラー';
  }
