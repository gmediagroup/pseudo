<?php
// данный код проверяет, вводил ли абонент верный код доступа

    include 'functions.php';
    session_start();
    if(!check_code($_SESSION['code'])) redirect('index.php');
    
    
// если код доступа верный, абоненту будет показан платный контент. иначе он будет переадресован на главную страницу сайта.

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Пример работы с псевдо-подписками</title>
</head>
<body>
	<h1>Страница  с платным контентом</h1>
  
  Платный контент здесь.
    
    
    

</body>
</html>
