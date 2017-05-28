<?php
define('DB_DATABASE','dotinstall_db');
define('DB_USERNAME','dbuser');
define('DB_PASSWORD','disorder');
define('PDO_DSN','mysql:dbhost=localhost;dbname=' . DB_DATABASE);


$date = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $date = $_POST['cal'];
  $err = false;
  if ($date != null) {
    $err =true;
  }
}

try {
  $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $db->prepare("insert into users (datelimit) values ('$date')");
$stmt->execute();
echo "inserted:" . $db->lastInsertId();

}catch(PDOException $e) {
  echo $e->getMessage();
  exit;
}
?>

 <!DOCTYPE html>
<html lang=“ja”>

<head>
  <meta charset=“utf-8”>
  <title>カレンダーから選択した日付を表示</title>
</head>

<body>
  <form action="" method="POST">
    <input type="date" name="cal">
    <input type="submit" value="送信">
  </form>
<?php if($err) {echo $date;} ?>
</body>

</html>
