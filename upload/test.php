<?php include 'functions.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Пример работы с псевдо-подписками</title>
</head>
<body>
	<h1>Тестирование установки</h1>

ТЕСТ: Соединение с удаленным сервером:&nbsp;
<?php

    $f=file_get_contents('http://profit-bill.com/pseudo_subscription.php');
    if(!strstr($f,'reply')) echo('ОШИБКА');
    else { echo('УСПЕШНО'); $score++; }
    
?>

<br/><br/>
ТЕСТ: Соединение с базой данных:&nbsp;
<?php
        
		$status=1;
		try{
			$db=new PDO($CONFIG['dsn'], $CONFIG['db_user'], $CONFIG['db_pass']);
		} catch(PDOException $error)
		{
			echo('Database error:<br/>');
		    $status=0;
		}

        
    if(!strstr($f,'reply')) echo('ОШИБКА. Проверьте правильность настройки базы данных в config.php');
    else {echo('УСПЕШНО');$score++;}
    
?>






<br/><br/>
ТЕСТ:   Попытка выполнения INSERT в БД:&nbsp;
<?php
        
	if(!$status) echo('ОШИБКА. Соединение с БД должно быть установлено. Разберитесь с предыдущей ошибкой');
    else {
        $db->query("INSERT INTO  `codes` ( `expires`, `code`)  VALUES('0', '12345')");
        
        $i=$db->errorInfo();
        
        
        if(!$i[1]) {echo('УСПЕШНО');$score++;}
        else echo("ОШИБКА. Если вы используете sqlite, проверьте, поставили ли вы права 777 на папку sqlite и на файл database.sqlite");
    }
    
  
    
?>


<br/><br/>
<?php if($score==3): ?>Установка успешна. <?php else: ?>Во время установки возникли ошибки <?php endif; ?>
    
</body>
</html>
